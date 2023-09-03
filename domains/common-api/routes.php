<?php 

$r->addRoute('GET', '/api/v1/links[/]', CommonApi\Links\Controller::class . '@index');
