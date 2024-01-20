<?php

/**
 * giepewu-api.localhost
 * giepewu-api.necodeo.com
 */

$r->addRoute('GET', '/api/v1/indexes[/]', Controllers\GiepewuApi\InstrumentsController::class . '@indexes');
$r->addRoute('GET', '/api/v1/stocks[/]', Controllers\GiepewuApi\InstrumentsController::class . '@stocks');
$r->addRoute('GET', '/api/v1/bonds[/]', Controllers\GiepewuApi\InstrumentsController::class . '@bonds');
$r->addRoute('GET', '/api/v1/pp[/]', Controllers\GiepewuApi\InstrumentsController::class . '@pp');
$r->addRoute('GET', '/api/v1/futures[/]', Controllers\GiepewuApi\InstrumentsController::class . '@futures');
$r->addRoute('GET', '/api/v1/pda[/]', Controllers\GiepewuApi\InstrumentsController::class . '@pda');
$r->addRoute('GET', '/api/v1/investment-certificates[/]', Controllers\GiepewuApi\InstrumentsController::class . '@investmentCertificates');
$r->addRoute('GET', '/api/v1/warrants[/]', Controllers\GiepewuApi\InstrumentsController::class . '@warrants');
$r->addRoute('GET', '/api/v1/index-units[/]', Controllers\GiepewuApi\InstrumentsController::class . '@indexUnits');
$r->addRoute('GET', '/api/v1/options[/]', Controllers\GiepewuApi\InstrumentsController::class . '@options');
$r->addRoute('GET', '/api/v1/structured-products[/]', Controllers\GiepewuApi\InstrumentsController::class . '@structuredProducts');
$r->addRoute('GET', '/api/v1/etf[/]', Controllers\GiepewuApi\InstrumentsController::class . '@etf');
$r->addRoute('GET', '/api/v1/bank-securities[/]', Controllers\GiepewuApi\InstrumentsController::class . '@bankSecurities');
$r->addRoute('GET', '/api/v1/etc[/]', Controllers\GiepewuApi\InstrumentsController::class . '@etc');
$r->addRoute('GET', '/api/v1/final-futures[/]', Controllers\GiepewuApi\InstrumentsController::class . '@finalFutures');
$r->addRoute('GET', '/api/v1/final-options[/]', Controllers\GiepewuApi\InstrumentsController::class . '@finalOptions');

$r->addRoute('GET', '/api/v1/instruments[/]', Controllers\GiepewuApi\InstrumentsController::class . '@types');
$r->addRoute('GET', '/api/v1/instruments/{type}[/]', Controllers\GiepewuApi\InstrumentsController::class . '@instruments');
$r->addRoute('GET', '/api/v1/instruments/{type}/{name}[/]', Controllers\GiepewuApi\InstrumentsController::class . '@data');

$r->addRoute('GET', '/api/v1/fill[/]', Controllers\GiepewuApi\InstrumentsController::class . '@fill');