<?php 

namespace CommonApi\Pages;

class Controller
{
    private Repository $repo;

    public function __construct()
    {
        $this->repo = new Repository();
    }

    public function single(): void
    {
        $slug = $_GET['slug'] ?? '';

        $start = microtime(true);
        $pages = $this->repo->getPageBySlug($slug);
        $end = microtime(true);

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'time' => $end - $start,
            'page' => $pages,
        ]);
    }
}