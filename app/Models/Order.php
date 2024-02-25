<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Order extends Model
{
    protected $connection = 'mongodb';

    protected $fillable = [
        'product_id',
        'user_id',
        'payment_id',
        'address',
    ];
}
