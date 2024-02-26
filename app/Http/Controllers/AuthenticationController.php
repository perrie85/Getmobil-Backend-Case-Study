<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthenticationService;
use App\Traits\ApiResponseSender;
use Illuminate\Http\JsonResponse;

class AuthenticationController extends Controller
{
    use ApiResponseSender;

    public function __construct(private readonly AuthenticationService $service)
    {
    }

    public function login(LoginRequest $request): JsonResponse
    {
        return $this->successResponse(['token' => $this->service->login($request->validated())]);
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        return $this->successResponse($this->service->register($request->validated()));
    }
}
