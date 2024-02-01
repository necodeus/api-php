<?php

/**
 * shop-api.necodeo.com
 * shop-api.localhost
 */

use Controllers\ShopApi\OrderController;

$r->addRoute('POST', '/api/v1/order[/]', OrderController::class . '@order');
