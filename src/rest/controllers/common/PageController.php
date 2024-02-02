<?php

namespace Controllers\CommonApi;

use Repositories\CommonRepository;
use Enums\ControllerResponseType;

class PageController
{
    private CommonRepository $common;

    public function __construct()
    {
        $this->common = new CommonRepository();
    }

    public function single(): string
    {
        $slug = $_GET['slug'] ?? '';

        performance()::measure();
        $pages = $this->common->getPageBySlug($slug);
        performance()::measure();

        return response(ControllerResponseType::JSON)
            ->status(200)
            ->data([
                'status' => 'ok',
                'time' => performance()::result(),
                'page' => $pages,
            ]);
    }
}