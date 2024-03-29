<?php

namespace App\Services;

use App\Exceptions\LoginException;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthenticationService
{
    public function __construct(private readonly UserRepository $repository)
    {
    }

    public function login(array $data): string
    {
        $user = $this->repository->getByEmail($data['email']);

        if ($user) {
            if (Hash::check($data['password'], $user->password)) {
                return $user->createToken('Laravel Password Grant Client')->accessToken;
            }

            throw new LoginException;
        }

        throw new ModelNotFoundException('User does not exist');
    }

    public function register(array $data): User
    {
        $request['remember_token'] = Str::random(10);
        return $this->repository->store($data);
    }
}
