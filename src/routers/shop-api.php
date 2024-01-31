<?php

/**
 * shop-api.necodeo.com
 * shop-api.localhost
 */

use Controllers\ShopApi\IndexController;

$r->addRoute('GET', '/api/v1/index[/]', IndexController::class . '@index');