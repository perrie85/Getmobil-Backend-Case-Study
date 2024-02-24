<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;

class UserRepository
{
    public function builder(): Builder
    {
        return User::query();
    }
}
