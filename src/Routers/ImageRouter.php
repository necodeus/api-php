<?php 

use Controllers\Image\ImageController;

$r->addRoute('GET', '/{id}[/]', ImageController::class . '@load');
