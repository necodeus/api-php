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

        response([
            'status' => 'ok',
            'time' => performance()::result(),
            'page' => $pages,
        ])->status(200);
    }
}