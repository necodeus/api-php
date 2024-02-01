<?php

namespace Services;

use GuzzleHttp\Client;

class OpenWeatherMapService
{
    public static function getWeather(string $lat, string $lon, string $units, string $appid): ?array
    {
        try {
            $client = new Client();

            $response = $client->request('GET', "https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&units={$units}&appid={$appid}");

            $contents = $response->getBody()->getContents();

            return json_decode($contents, true);
        } catch (\Exception $e) {
            return null;
        }
    }
}