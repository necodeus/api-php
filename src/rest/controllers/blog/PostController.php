<?php

namespace Controllers\Blog;

use Repositories\BlogRepository;
use Repositories\UserRepository;

// use Predis\Client as RedisClient;

class PostController extends \Controllers\BaseController
{
    private BlogRepository $blog;

    private UserRepository $user;

    // private RedisClient $redis;

    public function __construct()
    {
        $this->blog = new BlogRepository();
        $this->user = new UserRepository();

        // $this->redis = new RedisClient([
        //     'scheme' => $_ENV['REDIS_SCHEME'],
        //     'host' =>  $_ENV['REDIS_HOST'],
        //     'port' => $_ENV['REDIS_PORT'],
        // ]);
    }

    public function getPosts(): void
    {
        performance()::measure();
        $posts = $this->blog->getPublicPosts();
        performance()::measure();

        response([
            'status' => 'ok',
            'time' => performance()::result(),
            'posts' => $posts,
        ])->status(200);
    }

    public function getSinglePost(string $postId): void
    {
        performance()::measure();
        $post = $this->blog->getPostById($postId);
        $postAuthor = $this->user->getProfileByAccountId($post['publisher_account_id']);
        performance()::measure();

        response([
            'status' => 'ok',
            'time' => performance()::result(),
            'post' => $post,
            'postAuthor' => $postAuthor,
        ])->status(200);
    }

    public function getComments(string $postId): void
    {
        performance()::measure();
        $comments = $this->blog->getCommentsByPostId($postId);
        performance()::measure();

        response([
            'status' => 'ok',
            'time' => performance()::result(),
            'comments' => $comments,
        ])->status(200);
    }

    public function rate(string $id)
    {
        performance()::measure();

        $sessionId = $_POST['sessionId'] ?? null;
        $value = $_POST['value'] ?? null;

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
