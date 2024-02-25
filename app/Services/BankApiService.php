<?php

namespace App\Services;

use App\APIClients\BankApiClient;

class BankApiService
{
    public function __construct(
        private readonly BankApiClient $client
    ) {
    }

    public function payment(array $data): bool
    {
        return $this->client->post(config('services.bank.endpoints.payment'), $data)
            ->successful();
    }
}
