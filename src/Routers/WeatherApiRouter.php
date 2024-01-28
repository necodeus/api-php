<?php

use Controllers\WeatherApi\WeatherController;

$r->addRoute('GET', '/api/v1/weather[/]', WeatherController::class . '@weather');
