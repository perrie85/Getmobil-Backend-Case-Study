<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService extends BaseService
{
    public function __construct(private readonly UserRepository $repository)
    {
    }
}
