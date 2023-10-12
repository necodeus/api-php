<?php 

namespace Controllers\PaperApi;

use Controllers\BaseController;

use Repositories\Blog\BlogPostsRepo;

class PostController extends BaseController
{
    private BlogPostsRepo $repo;

    public function __construct()
    {
        parent::__construct();

        $this->repo = new BlogPostsRepo();
    }

    public function index(): void
    {
        performance()::measure();
        $posts = $this->repo->getPosts();
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
        performance()::measure();

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'time' => performance()::result(),
            'post' => $post,
        ]);
    }
}
