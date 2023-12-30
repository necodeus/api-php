<?php

use Controllers\PaperApi\PostController;

$r->addRoute('GET', '/api/v1/posts[/]', PostController::class . '@getPosts');
$r->addRoute('POST', '/api/v1/posts/{id}/rate[/]', PostController::class . '@rate'); // TODO
$r->addRoute('POST', '/api/v1/posts/{id}/comment[/]', PostController::class . '@comment'); // TODO
$r->addRoute('GET', '/api/v1/posts/{postId}/comments[/]', PostController::class . '@getComments');
$r->addRoute('GET', '/api/v1/posts/{postId}[/]', PostController::class . '@getSinglePost');
