<?php

/**
 * admin-api.localhost
 * admin-api.necodeo.com
 */

use Controllers\AdminApi\Schemas\IndexController;

$r->addRoute('GET', '/api/v1/schemas/stats[/]', IndexController::class . '@stats');
$r->addRoute('GET', '/api/v1/schemas/{schema}[/]', IndexController::class . '@index');
