<?php

namespace Controllers\CommonApi;

use Repositories\CommonRepository;

class PageController
{
    private CommonRepository $common;

    public function __construct()
    {
        $this->common = new CommonRepository();
    }

    public function single(): void
    {
        $slug = $_GET['slug'] ?? '';

        performance()::measure();
        $pages = $this->common->getPageBySlug($slug);
        performance()::measure();

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'time' => performance()::result(),
            'page' => $pages,
        ]);
    }
}