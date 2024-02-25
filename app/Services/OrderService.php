<?php

namespace App\Services;

use App\Models\Order;
use App\Repositories\OrderRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        DB::transaction(function () use (&$data) {
            $product = $this->productService->show($data['product_id']);

            $data['payment']['amount'] = $product->price * $data['quantity'];

            $payment = $this->paymentService->store($data['payment']);
            unset($data['payment']);

            $product->stock = $product->stock - $data['quantity'];
            $product->save();

            $data['payment_id'] = $payment->id;
            $data['user_id'] = auth()->user()->id;
        });

        return parent::store($data);
    }
}
