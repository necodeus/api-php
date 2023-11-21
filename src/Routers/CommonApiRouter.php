<?php

/**
 * common-api.localhost
 * common-api.necodeo.com
 */

use Controllers\CommonApi\PageController;
use Controllers\CommonApi\RedirectionController;
use Controllers\CommonApi\TestController;

/**
 * Informacja dla przyszłego mnie:
 *
 * To API to ślepy zaułek - jest niepotrzebne.
 * Lepiej będzie tworzyć API dla każdej strony, niż szukać na siłę wspólnych, generycznych elementów,
 * które nie tylko są dla mnie mniej czytelne, ale niepotrzebne generują dodatkowe zapytania.
 *
 * TODO: Usunąć to API. Zastanowić się, jak budować repozytoria.
 */
$r->addRoute('GET', '/api/v1/page[/]', PageController::class . '@single');
$r->addRoute('GET', '/api/v1/redirections/{id}[/]', RedirectionController::class . '@single');
$r->addRoute('GET', '/api/v1/test[/]', TestController::class . '@test');
