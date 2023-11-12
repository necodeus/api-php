<?php

/**
 * paper-api.necodeo.com
 * paper-api.localhost
 */

use Controllers\PaperApi\PostController;
use Controllers\PaperApi\PostRatingController;

$r->addRoute('GET', '/api/v1/posts[/]', PostController::class . '@index');
$r->addRoute('GET', '/api/v1/posts/{id}[/]', PostController::class . '@single');
$r->addRoute('GET', '/api/v1/posts/{id}/rate[/]', PostRatingController::class . '@rate');
