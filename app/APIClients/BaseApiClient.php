<?php

namespace App\APIClients;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Response;

abstract class BaseApiClient
{
    public PendingRequest $client;

    public function __construct()
    {
        $this->client = $this->getClient();
    }

    public function get(string $uri, array $data): Response
    {
        return $this->client->get($uri, $data);
    }

    public function post(string $uri, array $data): Response
    {
        return $this->client->post($uri, $data);
    }

    abstract public function getClient(): PendingRequest;
}
