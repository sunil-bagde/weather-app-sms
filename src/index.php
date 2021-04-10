<?php

use App\SmsService;
use App\WeatherService;
use App\Domain\Location;
use App\Http\CurlClient;
use App\Sms\RouteeSmsService;

require_once 'vendor/autoload.php';
/*
in production pls Keep data in .env
@see https://12factor.net/config
*/
$weatherApiKey = 'b385aa7d4e568152288b3c9f5c2458a5';
$smsToken = 'df2a5e00-53b5-4d9f-b946-39029aa168ac';
$toName = 'Sunil';
$phone = '+30 6978745957';

$client = new CurlClient;
$location = new Location('Thessaloniki');
$weatherService = new WeatherService($client, $weatherApiKey);
$temperature = $weatherService->getWeather($location);
$currentTemperature = $temperature->getTemperature();

 $message = '';
if ($currentTemperature > 20) {
    $message = "{$toName} Temperature more than 20C. {$currentTemperature}C";
} else {
    $message = "{$toName} Temperature less than 20C. {$currentTemperature}C";
}

$sms = new RouteeSmsService($client, $smsToken);

$r = $sms->send(
    [
        'body' => $message,
        'to' => $phone,
        'from' => 'Routee'
    ]
);
var_dump($r);
