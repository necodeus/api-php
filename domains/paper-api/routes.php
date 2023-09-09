<?php 

$r->addRoute('GET', '/api/v1/posts[/]', PaperApi\Posts\Controller::class . '@index');
$r->addRoute('GET', '/api/v1/posts/{uuid}[/]', PaperApi\Posts\Controller::class . '@show');
