<?php

namespace Controllers\CommonApi;

use Repositories\Common\CommonPagesRepo;

class PageController
{
    private CommonPagesRepo $repo;

    public function __construct()
    {
        $this->repo = new CommonPagesRepo();
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