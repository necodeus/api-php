<?php

namespace Controllers\WeatherApi;

use Predis\Client as RedisClient;
use Services\OpenWeatherMapService;

class WeatherController extends \Controllers\BaseController
{
    private RedisClient $redis;

    public function __construct()
    {
        $this->redis = new RedisClient([
            'scheme' => $_ENV['REDIS_SCHEME'],
            'host' =>  $_ENV['REDIS_HOST'],
            'port' => $_ENV['REDIS_PORT'],
        ]);
    }

    public function weather(): void
    {
        performance()::measure();
        $lat = $_GET['lat'] ?? 0;
        $lon = $_GET['lon'] ?? 0;
        $units = $_GET['units'] ?? 'metric';
        $appid = $_GET['appid'] ?? $_ENV['OPENWEATHERMAP_API_TOKEN'];

        $cacheKey = "{$lat}-{$lon}-{$units}-{$appid}";

        $response = [];

        try {
            $cachedResponse = $this->redis->get($cacheKey);

            if ($cachedResponse) {
                $response = json_decode($cachedResponse, true);

                $response['cached'] = true;
            } else {
                $response = OpenWeatherMapService::getWeather($lat, $lon, $units, $appid);

                $this->redis->set($cacheKey, json_encode($response));
                $this->redis->expire($cacheKey, 5);
                
                $response['cached'] = false;
            }
        } catch (\Exception $e) {
            $response = [
                'error' => $e->getMessage(),
            ];
        }
        performance()::measure();

        response($response)->status(200);
    }
}
