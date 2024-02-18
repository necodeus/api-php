<?php

/**
 * blog-api.localhost
 * blog-api.necodeo.com
 */

use Controllers\Blog\PostController;

$r->addRoute('GET', '/api/v1/posts[/]', PostController::class . '@getPosts');
$r->addRoute('POST', '/api/v1/posts/{id}/rate[/]', PostController::class . '@rate'); // TODO
$r->addRoute('POST', '/api/v1/posts/{id}/comment[/]', PostController::class . '@comment'); // TODO
$r->addRoute('GET', '/api/v1/posts/{postId}/comments[/]', PostController::class . '@getComments');
$r->addRoute('GET', '/api/v1/page[/]', PostController::class . '@getInitialPageData');
