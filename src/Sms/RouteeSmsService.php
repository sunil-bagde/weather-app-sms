<?php

namespace App\Sms;

use App\Domain\Weather;
use App\Domain\Location;
use App\Http\CurlClient;
use App\Domain\Temperature;
use App\Contracts\Weatherable;
use App\Exceptions\LocationNotFoundExeption;

class RouteeSmsService
{
    private $client;
    private $apiKey;

    /**
      * @param  App\Http\CurlClient  $client
      * @param  string $token
      * @return void
      */
    public function __construct(CurlClient $client, $token)
    {
        $this->client = $client;
        $this->token = $token;
    }

    /**
    *
    *
    * @param  string  $token
    * @param  array $data
    * @return void
    */
    public function send(array $data = [
        'to' => '+30 6978745957',
        'body' => '',
        'from' => ''
    ]): ?array
    {
        try {
            // Keep URL in config
            $url = 'https://connect.routee.net/sms';

            $options['headers'] = [
                "authorization: Bearer {$this->token}",
                'content-type: application/json'
            ];
            $response = $this->client->fetch($url, 'POST', $data, $options);
            $response = json_decode($response, true);
            return $response;
        } catch (\Exception $e) {
            // Logger::log($e->getMessage());
            var_dump($e->getMessage());
        }
    }
}
