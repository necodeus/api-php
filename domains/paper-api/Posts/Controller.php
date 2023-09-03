<?php 

namespace PaperApi\Posts;

use PaperApi\Posts\Repository;

class Controller
{
    private Repository $repo;

    public function __construct()
    {
        $this->repo = new Repository();
    }

    public function index()
    {
        $start = microtime(true);
        $posts = $this->repo->getPosts();
        $end = microtime(true);

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'posts' => $posts,
            'time' => $end - $start,
        ]);
    }

    public function show(string $uuid)
    {
        print_r($uuid);

        return [
            'status' => 'ok',
            'post' => [],
            'postPublisher' => [],
        ];
    }
}
