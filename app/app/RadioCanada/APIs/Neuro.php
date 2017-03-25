<?php

namespace App\RadioCanada\APIs;

class Neuro extends API
{
    public function call($uri, $params = [], $method = 'GET')
    {
        if (!config('radiocanada.client_key')) {
            throw new \Exception('Missing Radio-Canada client key.');
        }

        $uri = ltrim($uri, '/');

        $response = app('guzzle')->request($method, 'hackathon2017/neuro/v1/' . $uri, [
            'headers' => [
                'Authorization' => 'Client-Key ' . config('radiocanada.client_key'),
            ],
            'query' => $params,
        ]);

        if ($response->getStatusCode() == 200) {
            return \GuzzleHttp\json_decode($response->getBody()->getContents(), true);
        } else {
            return false;
        }
    }
}
