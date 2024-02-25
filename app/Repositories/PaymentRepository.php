<?php

namespace App\Repositories;

use App\Models\Payment;

class PaymentRepository extends BaseRepository
{
    protected function model()
    {
        return Payment::class;
    }
}
