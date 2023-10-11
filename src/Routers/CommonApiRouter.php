<?php 

use Controllers\CommonApi\PageController;
use Controllers\CommonApi\RedirectionController;
use Controllers\CommonApi\TestController;

$r->addRoute('GET', '/api/v1/page[/]', PageController::class . '@single');
$r->addRoute('GET', '/api/v1/redirection/{id}[/]', RedirectionController::class . '@single');
$r->addRoute('GET', '/api/v1/test[/]', TestController::class . '@test');
