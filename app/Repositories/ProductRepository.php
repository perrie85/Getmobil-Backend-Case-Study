<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Contracts\Database\Eloquent\Builder;

class ProductRepository
{
    public function builder(): Builder
    {
        return Product::query();
    }
}
