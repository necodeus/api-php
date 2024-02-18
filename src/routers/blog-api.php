<?php

/**
 * blog-api.localhost
 * blog-api.necodeo.com
 */

use Controllers\Blog\PostController;

// index + widget
$r->addRoute('GET', '/api/v1/posts[/]', PostController::class . '@getPosts');

// post
$r->addRoute('GET', '/api/v1/page[/]', PostController::class . '@getInitialPageData');

// post ratings
$r->addRoute('POST', '/api/v1/posts/{id}/rate[/]', PostController::class . '@rate'); // TODO?

// post comments
$r->addRoute('GET', '/api/v1/posts/{postId}/comments[/]', PostController::class . '@getComments');
$r->addRoute('POST', '/api/v1/posts/{postId}/comments[/]', PostController::class . '@addComment');
$r->addRoute('POST', '/api/v1/posts/{postId}/comments/{commentId}/upvote[/]', PostController::class . '@upvoteComment');
$r->addRoute('POST', '/api/v1/posts/{postId}/comments/{commentId}/downvote[/]', PostController::class . '@downvoteComment');
