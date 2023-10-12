<?php 

namespace Controllers\CommonApi;

use Repositories\Common\PagesRepo;

class PageController
{
    private PagesRepo $repo;

    public function __construct()
    {
        $this->repo = new PagesRepo();
    }

    public function single(): void
    {
        $slug = $_GET['slug'] ?? '';

        performance()::measure();
        $pages = $this->repo->getPageBySlug($slug);
        performance()::measure();

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'time' => performance()::result(),
            'page' => $pages,
        ]);
    }
}