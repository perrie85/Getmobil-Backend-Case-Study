<?php

namespace Tests\Feature\Feature\Http\Controllers;

use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    public function testIndex(): void
    {
        $response = $this->request()
            ->get(route('products.index'));

        $response->assertStatus(200);
    }

    public function testStore(): void
    {
        $response = $this->request()
            ->post(route('products.store'), [
                'name' => 'Test Product',
                'price' => 322,
                'stock' => 5,
            ]);

        $response->assertStatus(200);
    }

    public function testShow(): void
    {
        $response = $this->request()
            ->get(route('products.show', ['product' => '1']));

        $response->assertStatus(200);
    }
}
