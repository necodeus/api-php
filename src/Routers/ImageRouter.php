<?php

/**
 * image.localhost
 * image.necodeo.com
 */

use Controllers\Images\OutputController;

$r->addRoute('GET', '/{id}[/]', OutputController::class . '@load');
$r->addRoute('GET', '/{id}/{dimension}[/]', OutputController::class . '@loadThumbnail');
