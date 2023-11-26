<?php

/**
 * common-api.localhost
 * common-api.necodeo.com
 */

// TESTING
$r->addRoute('GET', '/api/v1/test[/]', Controllers\CommonApi\TestController::class . '@test');

// REDIRECTIONS
$r->addRoute('GET', '/api/v1/redirections/{id}[/]', Controllers\CommonApi\RedirectionController::class . '@single');

// TODO: I guess I should move this component under BlogApi namespace
$r->addRoute('GET', '/api/v1/page[/]', Controllers\CommonApi\PageController::class . '@single');

// UPLOADING IMAGES
$r->addRoute('POST', '/api/v1/images[/]', Controllers\CommonApi\ImageController::class . '@upload');
