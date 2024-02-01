<?php

namespace Controllers\ShopApi;

use Controllers\BaseController;

class OrderController extends BaseController
{
    public function order(): void
    {
        performance()::measure();
        $result = [];
        performance()::measure();

        response($result)->status(200);
    }
}
