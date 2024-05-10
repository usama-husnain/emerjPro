<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\PaymentMehtodController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('refresh', [AuthController::class, 'refresh']);

Route::middleware('auth.jwt')->group(function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('subscriptions', SubscriptionController::class);
    Route::apiResource('transactions', TransactionController::class);
    Route::apiResource('paymentMethods', PaymentMehtodController::class);
});
