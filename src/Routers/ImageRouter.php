<?php 

use Controllers\Images\OutputController;

$r->addRoute('GET', '/{id}[/]', OutputController::class . '@load');
