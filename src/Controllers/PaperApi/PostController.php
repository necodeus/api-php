<?php 

namespace Controllers\PaperApi;

use Repositories\PostRepository;

class PostController
{
    private PostRepository $repo;

    public function __construct()
    {
        $this->repo = new PostRepository();
    }

    public function index(): void
    {
        $start = microtime(true);
        $posts = $this->repo->getPosts();
        // $pages = $this->repo->getPagesByPostIds($posts->column('id')->all());
        $end = microtime(true);

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'time' => $end - $start,
            'posts' => $posts,
            // 'pages' => $pages,
        ]);
    }

    public function single(string $id): void
    {
        $start = microtime(true);
        $post = $this->repo->getPostById($id);
        // $page = $this->repo->getPagesByPostIds([$post['id']])->first();
        $end = microtime(true);

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'time' => $end - $start,
            'post' => $post,
            // 'page' => $page,
        ]);
    }
}
