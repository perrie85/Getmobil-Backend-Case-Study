<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Redis;

class ProductService extends BaseService
{
    public const HASH = 'product';

    public function __construct(ProductRepository $repository)
    {
        parent::__construct($repository);
    }

    public function store(array $data): Model
    {
        $product = parent::store($data);

        $this->storeHash($product);

        return $product;
    }

    private function storeHash(Product $product): void
    {
        Redis::hset(
            self::HASH . ':' . $product->id,
            'name',
            $product->name,
            'stock',
            $product->stock,
            'price',
            $product->price,
        );
    }
}
