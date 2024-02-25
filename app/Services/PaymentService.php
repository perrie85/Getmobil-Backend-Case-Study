<?php

namespace App\Services;

use App\Exceptions\PaymentException;
use App\Repositories\PaymentRepository;
use Illuminate\Database\Eloquent\Model;

class PaymentService extends BaseService
{
    public function __construct(
        PaymentRepository $repository,
        private readonly BankApiService $bankApiService
    ) {
        parent::__construct($repository);
    }

    public function store(array $data): Model
    {
        if (!$this->bankApiService->payment($data)) {
            throw new PaymentException;
        }

        return parent::store($data);
    }
}
