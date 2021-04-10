<?php

namespace App;

use App\WeatherService;
use App\Domain\Location;
use App\Http\CurlClient;
use PHPUnit\Framework\TestCase;

class WeatherServiceTest extends TestCase
{
    public function test_it_should_return_tempeture(): void
    {
        $weatherApiKey = 'b385aa7d4e568152288b3c9f5c2458a5';
        $location = new Location('Thessaloniki');
        $weatherService = new WeatherService(new CurlClient, $weatherApiKey);
        $temperature = $weatherService->getWeather($location);
        $currentTemperature = $temperature->getTemperature();
        $this->assertNotNull(
            $currentTemperature,
            'variable is null or not'
        );
    }
}
