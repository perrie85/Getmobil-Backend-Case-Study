<?php

namespace App\Services;

use App\Exceptions\ProductNotAvailableException;
use App\Exceptions\SalesTransactionException;
use App\Models\Order;
use App\Models\Product;
use App\Repositories\OrderRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class OrderService extends BaseService
{
    public function __construct(
        OrderRepository $repository,
        private readonly PaymentService $paymentService,
        private readonly ProductService $productService
    ) {
        parent::__construct($repository);
    }

    public function store(array $data): Model
    {
        if ($this->redisTransaction($data['product_id'], $data['quantity']) === false) {
            throw new SalesTransactionException;
        }

        DB::beginTransaction();
        $product = $this->productService->show($data['product_id']);

        try {
            $data['payment']['amount'] = $product->price * $data['quantity'];

            $payment = $this->paymentService->store($data['payment']);
            unset($data['payment']);

            $product->stock = $product->stock - $data['quantity'];
            $product->save();

            $data['payment_id'] = $payment->id;
            $data['user_id'] = auth()->user()->id;

            $order = parent::store($data);
            DB::commit();

            return $order;
        } catch (\Throwable $th) {
            Redis::hset($this->productService::HASH . ':' . $product->id, 'stock', $product->stock);
            DB::rollBack();

            throw $th;
        }
    }

    private function redisTransaction(int $productId, int $quantity)
    {
        $maxRetries = 3;
        $attempt = 0;

        do {
            $attempt++;

            $lockKey = $this->productService::HASH . ':' . $productId . ':lock';

            $lockAcquired = Redis::set($lockKey, true, 'NX', 'EX', 3);

            if ($lockAcquired) {
                $stock = Redis::hget($this->productService::HASH . ':' . $productId, 'stock');

                if ($stock === false || $stock < $quantity) {
                    Redis::del($lockKey);
                    throw new ProductNotAvailableException;
                }

                $newStock = $stock - $quantity;

                Redis::hset($this->productService::HASH . ':' . $productId, 'stock', $newStock);

                Redis::del($lockKey);
                return true;
            } else {
                usleep(10000);
            }
        } while ($attempt < $maxRetries);

        return false;
    }
}
