<?php

namespace Controllers\PaperApi;

use Controllers\BaseController;

use Predis\Client as RedisClient;
use Repositories\Blog\BlogPostsRepo;
use Repositories\Blog\BlogPostRatingsSummaryRepo;

class PostController extends BaseController
{
    private BlogPostsRepo $repo;

    private BlogPostRatingsSummaryRepo $ratingsSummary;

    private RedisClient $redis;

    public function __construct()
    {
        parent::__construct();

        $this->repo = new BlogPostsRepo();
        $this->ratingsSummary = new BlogPostRatingsSummaryRepo();
        $this->redis = new RedisClient([
            'scheme' => 'tcp',
            'host' => 'redis',
            'port' => 6379
        ]);
    }

    public function index(): void
    {
        performance()::measure();
        $posts = $this->repo->getAllPublic();
        performance()::measure();

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'time' => performance()::result(),
            'posts' => $posts,
        ]);
    }

    public function single(string $id): void
    {
        performance()::measure();
        $post = $this->repo->getPostById($id);

        $ratingsSummary = $this->redis->hget('blog_post_ratings', $id);

        if (!$ratingsSummary) {
            $ratingsSummary = $a = $this->ratingsSummary->getRatingsSummaryById($id);
        } else {
            $ratingsSummary = $b = json_decode($ratingsSummary);
        }

        performance()::measure();

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'time' => performance()::result(),
            'post' => $post,
            'stars' => $ratingsSummary,
        ]);
    }
}
