<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => ['json.response']], function () {
    Route::post('/login', [AuthenticationController::class, 'login'])->name('login');
    Route::post('/register', [AuthenticationController::class, 'register'])->name('register');

    Route::group(['middleware' => ['auth:api']], function () {
        Route::apiResource('/users', UserController::class);
        Route::apiResource('/products', ProductController::class);
        Route::apiResource('/orders', OrderController::class)->only(['index', 'store', 'show']);
    });
});

Route::post('/fake-payment', function () {
    return new JsonResponse(['message' => 'Payment Successful.', 'code' => 200], 200);
});
