<?php

namespace Controllers\ShopApi;

use Controllers\BaseController;

class IndexController extends BaseController
{
    public function index(): void
    {
        performance()::measure();
        performance()::measure();

        header('Content-Type: application/json');
        print json_encode([
            'status' => 'ok',
            'time' => performance()::result(),
            'index' => [],
        ]);
    }
}
