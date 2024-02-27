<?php

namespace Tests\Feature\Feature\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Redis;
use Tests\TestCase;

class OrderControllerTest extends TestCase
{
    public function testIndex(): void
    {
        $response = $this->request()
            ->get(route('orders.index'));

        $response->assertStatus(200);
    }

    public function testStore(): void
    {
        $product = Product::first();

        Redis::hset(
            'product' . ':' . $product->id,
            'name',
            $product->name,
            'stock',
            $product->stock,
            'price',
            $product->price,
        );

        $response = $this->request()
            ->post(route('orders.store'), [
                'product_id' => $product->id,
                'payment' => [
                    'card_number' => '1111222233334444',
                    'cvc' => '333',
                    'full_name' => 'test test',
                ],
                'address' => 'somewhere testy',
                'quantity' => 1,
            ]);

        $response->assertStatus(200);
    }

    public function testShow(): void
    {
        Order::create([
            'product_id' => 1,
            'user_id' => 1,
            'payment_id' => 1,
            'address' => 'Something address',
        ]);

        $response = $this->request()
            ->get(route('orders.show', ['order' => Order::first()->id]));

        $response->assertStatus(200);
    }
}
