<?php

namespace App;

use App\Domain\Weather;
use App\Domain\Location;
use App\Http\CurlClient;
use App\Domain\Temperature;
use App\Contracts\Weatherable;
use App\Exceptions\LocationNotFoundExeption;

class WeatherService implements Weatherable
{
    private $client;
    private $apiKey;

    public function __construct(CurlClient $client, $apiKey)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
    }

    public function getWeather(Location $location) : ?Temperature
    {
        try {
            $url = 'api.openweathermap.org/data/2.5/weather?' . http_build_query([
                'q' => $location->getCityName(),
                'appid' => $this->apiKey,
                'units' => 'metric'
            ]);
            $response = $this->client->fetch($url);
            $data = json_decode($response, true);
            if (empty($data['main']['temp'])) {
                return null;
            }
            return new Temperature($data['main']['temp']);
        } catch (\Exception $e) {
            /*
              TODO
             Logger::log($e->getMessage())
            */
            var_dump($e->getMessage());
            return null;
        }
    }
}
