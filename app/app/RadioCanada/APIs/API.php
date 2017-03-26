<?php

namespace App\RadioCanada\APIs;

abstract class API
{
    protected $clientKey;

    public function __construct($clientKey)
    {
        $this->clientKey = $clientKey;
    }

    abstract public function call($uri, $params = [], $method = 'GET');
}
