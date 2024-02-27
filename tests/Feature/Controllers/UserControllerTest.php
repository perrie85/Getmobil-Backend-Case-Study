<?php

namespace Tests\Feature\Feature\Http\Controllers;

use Tests\TestCase;

class UserControllerTest extends TestCase
{
    public function testIndex(): void
    {
        $response = $this->request()
            ->get(route('users.index'));

        $response->assertStatus(200);
    }

    public function testStore(): void
    {
        $response = $this->request()
            ->post(route('users.store'), [
                'name' => 'User Test',
                'email' => 'test@testing.tester',
                'password' => '123456',
            ]);

        $response->assertStatus(200);
    }

    public function testShow(): void
    {
        $response = $this->request()
            ->get(route('users.show', ['user' => '1']));

        $response->assertStatus(200);
    }
}
