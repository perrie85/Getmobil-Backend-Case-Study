<?php

namespace App\APIClients;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class BankApiClient extends BaseApiClient
{
    public function getClient(): PendingRequest
    {
        if (isset($this->client)) {
            return $this->client;
        }

        $this->client = Http::baseUrl(config('services.bank.base_url') ?? '');
        $this->client = $this->client->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ]);

        return $this->client;
    }
}
