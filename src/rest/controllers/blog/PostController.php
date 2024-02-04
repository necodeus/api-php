<?php

namespace Controllers\Blog;

use Repositories\BlogRepository;
use Repositories\UserRepository;
use Enums\ControllerResponseType;

class PostController extends \Controllers\BaseController
{
    private BlogRepository $blog;

    private UserRepository $user;

    public function __construct()
    {
        $this->blog = new BlogRepository();
        $this->user = new UserRepository();
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

    public function getSinglePost(string $postId): string
    {
        performance()::measure();
        $post = $this->blog->getPostById($postId);
        $postAuthor = $this->user->getProfileByAccountId($post['publisher_account_id']);
        performance()::measure();

        return response(ControllerResponseType::JSON)
            ->status(200)
            ->data([
                'status' => 'ok',
                'time' => performance()::result(),
                'post' => $post,
                'postAuthor' => $postAuthor,
            ]);
    }

    public function getComments(string $postId): string
    {
        performance()::measure();
        $comments = $this->blog->getCommentsByPostId($postId);
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
}
