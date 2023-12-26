<?php

/**
 * TODO: zmienić na blog-api.*
 *
 * paper-api.necodeo.com
 * paper-api.localhost
 */

use Controllers\PaperApi\PostController;
use Controllers\PaperApi\PostRatingController;
use Controllers\PaperApi\CommentController;
use Controllers\PaperApi\TestController;

// Ocena wpisu - czyszczenie i synchronizacja (raczej do usunięcia)
$r->addRoute('GET', '/api/v1/posts/rating/sync[/]', PostRatingController::class . '@sync');
$r->addRoute('GET', '/api/v1/posts/rating/clear[/]', PostRatingController::class . '@clear');

// Ocena wpisu - pobranie wpisów i ocena
$r->addRoute('GET', '/api/v1/posts/{id}/rating[/]', PostRatingController::class . '@single');
$r->addRoute('GET', '/api/v1/posts/{id}/rating/set[/]', PostRatingController::class . '@rate');

// Komentarze
// Wpisy (wszystkie i pojedynczy)
$r->addRoute('GET', '/api/v1/posts[/]', PostController::class . '@index');
$r->addRoute('GET', '/api/v1/posts/{id}/comments[/]', CommentController::class . '@index');
$r->addRoute('GET', '/api/v1/posts/{id}[/]', PostController::class . '@single');


// Testowanie kolejki zapytań (wykorzystuje Redis)
$r->addRoute('GET', '/api/v1/add[/]', TestController::class . '@add');
$r->addRoute('GET', '/api/v1/process[/]', TestController::class . '@process');
