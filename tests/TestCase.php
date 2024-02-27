<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\WithFaker;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;
    use WithFaker;
    use RefreshDatabase;
    protected User $user;
    protected $seed = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();

        $this->actingAsUser($this->createUser());
    }

    protected function createUser(): User
    {
        $user = app(User::class);

        $user->id = mt_rand(1, 9999);
        $user->name = 'test user';
        $user->email = 'test@test.test';
        $user->username = 'test';

        return $user;
    }

    public function actingAsUser($user): void
    {
        $guard = 'api';
        $this->app['auth']->guard($guard)->setUser($user);
        $this->app['auth']->shouldUse($guard);
        $this->user = $user;
    }

    protected function request(): self
    {
        $this->withHeaders(
            [
                'Accept' => 'application/json',
            ]
        );

        return $this;
    }
}
