<?php

namespace Controllers\PaperApi;

use Repositories\BlogRepository;
use Repositories\UserRepository;

use Predis\Client as RedisClient;

class PostController extends \Controllers\BaseController
{
    private BlogRepository $blog;

    private UserRepository $user;

    private RedisClient $redis;

    public function __construct()
    {
        parent::__construct();

        $this->blog = new BlogRepository();
        $this->user = new UserRepository();

        $this->redis = new RedisClient([ // TODO: trait instead of putting in every controller
            'scheme' => $_ENV['REDIS_SCHEME'], // tcp
            'host' =>  $_ENV['REDIS_HOST'], // use "redis" if developing with Docker
            'port' => $_ENV['REDIS_PORT'] // 6379
        ]);
    }

    public function getPosts(): void
    {
        performance()::measure();
        $posts = $this->blog->getPublicPosts();
        // TODO: $posts = cache($this->redis)->getSetReturn('getAllPublic', 60, fn () => $this->repo->getAllPublic()});
        performance()::measure();

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'time' => performance()::result(),
            'posts' => $posts,
        ]);
    }

    public function getSinglePost(string $postId): void
    {
        performance()::measure();
        $post = $this->blog->getPostById($postId);
        $postAuthor = $this->user->getProfileByAccountId($post['publisher_account_id']);
        performance()::measure();

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'time' => performance()::result(),
            'post' => $post,
            'postAuthor' => $postAuthor,
            'stars' => 0, // TODO: remove
        ]);
    }

    public function getComments(string $postId): void
    {
        performance()::measure();
        $comments = $this->blog->getCommentsByPostId($postId);
        performance()::measure();

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'time' => performance()::result(),
            'comments' => $comments,
        ]);
    }

    public function rate(string $id)
    {
        $sessionId = $_POST['sessionId'] ?? null;
        $value = $_POST['value'] ?? null;

        // TODO: Add validation

        performance()::measure();
        $this->blog->upsertPostRating([
            'session_id' => $sessionId,
            'post_id' => $id,
            'value' => $value,
        ]);
        $rating = $this->blog->getRatingAverageAndCount($id);
        $this->blog->updatePost($id, [
            'rating_average' => $rating['rating_average'] ?? 0,
            'rating_count' => $rating['rating_count'] ?? 0,
        ]);
        performance()::measure();

        response([
            'status' => 'ok',
            'average' => floatval($rating['rating_average'] ?? 0),
            'time' => performance()::result(),
        ])->status(200);
    }

    public function comment(string $id): void
    {
        // TODO
    }
}
