<?php 

use Controllers\PaperApi\PostController;

$r->addRoute('GET', '/api/v1/posts[/]', PostController::class . '@index');
$r->addRoute('GET', '/api/v1/posts/{id}[/]', PostController::class . '@single');
