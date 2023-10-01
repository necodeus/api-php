<?php 

$r->addRoute('GET', '/api/v1/page[/]', CommonApi\Pages\Controller::class . '@single');
$r->addRoute('GET', '/api/v1/redirection/{id}[/]', CommonApi\Redirections\Controller::class . '@single');
