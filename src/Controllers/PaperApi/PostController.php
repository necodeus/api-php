<?php

namespace Controllers\PaperApi;

use Controllers\BaseController;

use Repositories\Blog\BlogPostsRepo;
use Repositories\User\UserProfilesRepo;
use Repositories\Blog\BlogPostRatingsSummaryRepo;

use Predis\Client as RedisClient;

class PostController extends BaseController
{
    private BlogPostsRepo $repo;

    private UserProfilesRepo $userProfiles;

    private BlogPostRatingsSummaryRepo $ratingsSummary;

    private RedisClient $redis;

    public function __construct()
    {
        parent::__construct();

        $this->repo = new BlogPostsRepo();
        $this->userProfiles = new UserProfilesRepo();
        $this->ratingsSummary = new BlogPostRatingsSummaryRepo();

        $this->redis = new RedisClient([
            'scheme' => $_ENV['REDIS_SCHEME'], // tcp
            'host' =>  $_ENV['REDIS_HOST'], // use "redis" if developing with Docker
            'port' => $_ENV['REDIS_PORT'] // 6379
        ]);
    }

    public function index(): void
    {
        performance()::measure();
        $posts = $this->repo->getAllPublic();
        // TODO: $posts = cache($this->redis)->getSetReturn('getAllPublic', 60, fn () => $this->repo->getAllPublic()});
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
        $postAuthor = $this->userProfiles->getPostAuthor($id);

        $ratingsSummary = $this->redis->hget('blog_post_ratings', $id);

        if (!$ratingsSummary) {
            $ratingsSummary = $this->ratingsSummary->getRatingsSummaryById($id);
        } else {
            $ratingsSummary = json_decode($ratingsSummary);
        }

        performance()::measure();

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'time' => performance()::result(),
            'post' => $post,
            'postAuthor' => $postAuthor,
            'stars' => $ratingsSummary,
        ]);
    }
}
