<?php

namespace App\Http\Controllers;

use App\Services\AuthenticationService;
use App\Traits\ApiResponseSender;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    use ApiResponseSender;

    public function __construct(private readonly AuthenticationService $service)
    {
    }

    public function login(Request $request): JsonResponse
    {
        return $this->successResponse(['token' => $this->service->login($request->all())]);
    }
}
