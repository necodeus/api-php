<?php 

$r->addRoute('GET', '/{id}[/]', Images\Controller::class . '@load');
