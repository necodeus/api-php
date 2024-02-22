<?php

namespace Controllers\Blog;

use Repositories\CommonRepository;
use Repositories\UserRepository;
use Repositories\BlogRepository;
use Enums\ControllerResponseType;

class PostController extends \Controllers\BaseController
{
    private CommonRepository $common;

    private UserRepository $user;

    private BlogRepository $blog;

    public function __construct()
    {
        $this->blog = new BlogRepository();
        $this->user = new UserRepository();
        $this->common = new CommonRepository();
    }

    public function getPosts(): string
    {
        performance()::measure();
        $posts = $this->blog->getPublicPosts();
        performance()::measure();

        return response(ControllerResponseType::JSON)
            ->status(200)
            ->data([
                'status' => 'ok',
                'time' => performance()::result(),
                'posts' => $posts,
            ]);
    }

    public function getInitialPageData(): string
    {
        performance()::measure();

        $slug = $_GET['slug'] ?? '';

        if (empty($slug)) {
            return response(ControllerResponseType::JSON)
                ->status(400)
                ->data([
                    'status' => 'error',
                    'time' => null,
                    'message' => 'Invalid slug',
                ]);
        }

        $page = $this->common->getPageBySlug($slug);

        if (empty($page)) {
            return response(ControllerResponseType::JSON)
                ->status(404)
                ->data([
                    'status' => 'error',
                    'time' => null,
                    'page' => null,
                    'post' => null,
                    'message' => 'Page not found',
                ]);
        }

        $post = $this->blog->getPostById($page['content_id']);

        if (empty($post)) {
            return response(ControllerResponseType::JSON)
                ->status(404)
                ->data([
                    'status' => 'error',
                    'time' => null,
                    'page' => $page,
                    'post' => null,
                    'message' => 'Post not found',
                ]);
        }

        $profile = $this->user->getProfileByAccountId($post['publisher_account_id'] ?? '');

        performance()::measure();

        return response(ControllerResponseType::JSON)
            ->status(200)
            ->data([
                'status' => 'ok',
                'time' => performance()::result(),
                'page' => $page,
                'post' => $post,
                'postAuthor' => $profile,
            ]);
    }

    public function getComments(string $postId): string
    {
        performance()::measure();
        $comments = $this->blog->getCommentsByPostId($postId);
        $comments = array_reverse($comments); // TODO: We don't want to reverse the comments here (REFACTOR)
        performance()::measure();

        return response(ControllerResponseType::JSON)
            ->status(200)
            ->data([
                'status' => 'ok',
                'time' => performance()::result(),
                'comments' => $comments,
            ]);
    }

    public function rate(string $id): string
    {
        performance()::measure();

        $sessionId = $_POST['sessionId'] ?? null;
        $value = $_POST['value'] ?? null;

        // Update user rating
        $this->blog->upsertPostRating([
            'session_id' => $sessionId,
            'post_id' => $id,
            'value' => $value,
        ]);

        // Get post rating average and count
        $rating = $this->blog->getRatingAverageAndCount($id);

        // Update post rating average and count
        $this->blog->updatePost($id, [
            'rating_average' => $rating['rating_average'] ?? 0,
            'rating_count' => $rating['rating_count'] ?? 0,
        ]);
        performance()::measure();

        return response(ControllerResponseType::JSON)
            ->status(200)
            ->data([
                'status' => 'ok',
                'time' => performance()::result(),
                'average' => floatval($rating['rating_average'] ?? 0),
            ]);
    }

    public function addComment(string $postId): string
    {
        performance()::measure();

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (empty($_COOKIE['sessionId'])) {
            return response(ControllerResponseType::JSON)
                ->status(400)
                ->data([
                    'status' => 'error',
                    'time' => performance()::result(),
                    'message' => 'Session must be set',
                ]);
        }

        if (empty($data['commentText'])) {
            return response(ControllerResponseType::JSON)
                ->status(400)
                ->data([
                    'status' => 'error',
                    'time' => performance()::result(),
                    'message' => 'Comment content must be set',
                ]);
        }

        $data = [
            'id' => uuidv4(),
            'parent_id' => $data['commentId'] ?? null,
            'content' => $data['commentText'] ?? '',
            'post_id' => $postId,
            'author_name' => 'Anonymous',
            'upvotes' => 0,
            'downvotes' => 0,
            'created_at' => date('Y-m-d H:i:s'),
            'session_id' => $_COOKIE['sessionId'],
        ];

        $upserted = $this->blog->addComment($data);
        performance()::measure();

        return response(ControllerResponseType::JSON)
            ->status(200)
            ->data([
                'status' => 'ok',
                'time' => performance()::result(),
                'upserted' => $upserted,
            ]);
    }

    public function upvoteComment(string $postId, string $commentId): string
    {
        performance()::measure();

        if (empty($_COOKIE['sessionId'])) {
            return response(ControllerResponseType::JSON)
                ->status(400)
                ->data([
                    'status' => 'error',
                    'time' => performance()::result(),
                    'message' => 'Session must be set',
                ]);
        }

        $commentActionId = $this->blog->getCommentActionId([
            'session_id' => $_COOKIE['sessionId'],
            'post_id' => $postId,
            'comment_id' => $commentId,
        ]);

        $data = [
            'id' => $commentActionId ?? uuidv4(),
            'session_id' => $_COOKIE['sessionId'],
            'post_id' => $postId,
            'comment_id' => $commentId,
            'type' => 'UPVOTE',
        ];

        $this->blog->upsertCommentAction($data);

        $recalculated = $this->blog->recalculateCommentVotes($postId, $commentId);

        $data['recalculated'] = $recalculated;

        performance()::measure();

        return response(ControllerResponseType::JSON)
            ->status(200)
            ->data([
                'status' => 'ok',
                'time' => performance()::result(),
                'echo' => $data,
            ]);
    }

    public function downvoteComment(string $postId, string $commentId): string
    {
        performance()::measure();

        if (empty($_COOKIE['sessionId'])) {
            return response(ControllerResponseType::JSON)
                ->status(400)
                ->data([
                    'status' => 'error',
                    'time' => performance()::result(),
                    'message' => 'Session must be set',
                ]);
        }

        $commentActionId = $this->blog->getCommentActionId([
            'session_id' => $_COOKIE['sessionId'],
            'post_id' => $postId,
            'comment_id' => $commentId,
        ]);

        $data = [
            'id' => $commentActionId ?? uuidv4(),
            'session_id' => $_COOKIE['sessionId'],
            'post_id' => $postId,
            'comment_id' => $commentId,
            'type' => 'DOWNVOTE',
        ];

        $this->blog->upsertCommentAction($data);

        $recalculated = $this->blog->recalculateCommentVotes($postId, $commentId);

        $data['recalculated'] = $recalculated;

        performance()::measure();

        return response(ControllerResponseType::JSON)
            ->status(200)
            ->data([
                'status' => 'ok',
                'time' => performance()::result(),
                'echo' => $data,
            ]);
    }
}
