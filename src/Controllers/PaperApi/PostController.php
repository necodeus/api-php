<?php

namespace Controllers\PaperApi;

use Controllers\BaseController;

use Repositories\Blog\BlogPostsRepo;
use Repositories\Blog\BlogPostRatingsSummaryRepo;

class PostController extends BaseController
{
    private BlogPostsRepo $repo;

    private BlogPostRatingsSummaryRepo $ratingsSummary;

    public function __construct()
    {
        parent::__construct();

        $this->repo = new BlogPostsRepo();
        $this->ratingsSummary = new BlogPostRatingsSummaryRepo();
    }

    public function index(): void
    {
        performance()::measure();
        $posts = $this->repo->getAll();
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
        $ratingsSummary = $this->ratingsSummary->getRatingsSummaryById($id);
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
