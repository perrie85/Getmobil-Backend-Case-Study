<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    protected function model()
    {
        return User::class;
    }

    public function getByEmail(string $email): ?User
    {
        return $this->model()::where('email', $email)->first();
    }
}
