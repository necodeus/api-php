<?php

/**
 * paper-api.necodeo.com
 * paper-api.localhost
 */

use Controllers\PaperApi\PostController;
use Controllers\PaperApi\PostRatingController;
use Controllers\PaperApi\TestController;

$r->addRoute('GET', '/api/v1/posts/rating/sync[/]', PostRatingController::class . '@sync');
$r->addRoute('GET', '/api/v1/posts/rating/clear[/]', PostRatingController::class . '@clear');
$r->addRoute('GET', '/api/v1/posts/{id}/rating[/]', PostRatingController::class . '@single');
$r->addRoute('GET', '/api/v1/posts/{id}/rating/set[/]', PostRatingController::class . '@rate');

$r->addRoute('GET', '/api/v1/posts[/]', PostController::class . '@index');
$r->addRoute('GET', '/api/v1/posts/{id}[/]', PostController::class . '@single');

$r->addRoute('GET', '/api/v1/add[/]', TestController::class . '@add');
$r->addRoute('GET', '/api/v1/process[/]', TestController::class . '@process');
