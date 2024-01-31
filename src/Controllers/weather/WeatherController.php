<?php

namespace Controllers\WeatherApi;

use Predis\Client as RedisClient;

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
        $appid = $_GET['appid'] ?? $_ENV['OPENWEATHERMAP_API_KEY'];

        $address = "https://api.openweathermap.org/data/2.5/weather?lat={$lat}&lon={$lon}&units={$units}";
        $addressAuth = "{$address}&appid={$appid}";

        $response = [];

        try {
            $cachedResponse = $this->redis->get($address);

            if ($cachedResponse) {
                $response = json_decode($cachedResponse, true);
                $response['cached'] = true;
            } else {
                $response = file_get_contents($addressAuth);
                $this->redis->set($address, $response);
                $this->redis->expire($address, 5);
                $response = json_decode($response, true);
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
