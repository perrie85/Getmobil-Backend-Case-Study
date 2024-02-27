<?php

namespace Tests\Feature\Feature\Controllers;

use Tests\TestCase;

class AuthenticationControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testRegister(): void
    {
        $response = $this->request()
            ->post(route('register'), [
                'name' => 'Test Test',
                'email' => 'test@testing.tester',
                'password' => '123456',
                'password_confirmation' => '123456',
            ]);

        $response->assertStatus(200);
    }
}
