<?php

/**
 * common-api.localhost
 * common-api.necodeo.com
 */

// TESTING
$r->addRoute('GET', '/api/v1/test[/]', Controllers\CommonApi\TestController::class . '@test');
$r->addRoute('GET', '/api/v1/page[/]', Controllers\CommonApi\PageController::class . '@single');
$r->addRoute('POST', '/api/v1/images[/]', Controllers\CommonApi\ImageController::class . '@upload');
