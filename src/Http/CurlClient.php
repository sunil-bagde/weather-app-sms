<?php

namespace App\Http;

use App\Contracts\Client;

class CurlClient implements Client
{
    /**
    *
    *
    * @param  string  $url
    * @param  string $method
    * @param  string $data
    * @return string|null
    */
    public function fetch(string $url, string $method = 'GET', array $data = [], array $options = [
        'headers' => [],
    ]): ?string
    {
        try {
            $curl = curl_init();
            $curlOptions = [
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => $method,
                CURLOPT_HTTPHEADER => $options['headers'] ?? [],
                CURLOPT_POSTFIELDS => json_encode($data)
            ];

            curl_setopt_array($curl, $curlOptions);

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if (!empty($err)) {
                throw new \Exception($err, 500);
            }
            return $response;
        } catch (\Exception $e) {
            // log $e->getMessage();
            return null;
        }
    }
}
