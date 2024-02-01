<?php

/**
 * common-api.localhost
 * common-api.necodeo.com
 */

$r->addRoute('GET', '/api/v1/page[/]', Controllers\CommonApi\PageController::class . '@single');
// TODO: ^ Remove this route. Implement it in blog-api, shop-api, forum-api.
