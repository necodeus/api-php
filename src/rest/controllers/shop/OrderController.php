<?php

namespace Controllers\ShopApi;

use Controllers\BaseController;
use Enums\ControllerResponseType;

class OrderController extends BaseController
{
    public function order(): string
    {
        performance()::measure();
        $result = [];
        performance()::measure();

        return response(ControllerResponseType::JSON)
            ->data([
                'status' => 'ok',
                'time' => performance()::result(),
                'result' => $result,
            ]);
    }
}
