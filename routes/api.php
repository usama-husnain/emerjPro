<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\SubscriptionController;
use App\Http\Controllers\Api\SubscriptionTypeController;
use App\Http\Controllers\Api\SubscriptionStatusController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\TransactionTypeController;
use App\Http\Controllers\Api\PaymentMehtodController;
use App\Http\Controllers\Api\PaymentMethodTypeController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('refresh', [AuthController::class, 'refresh']);

Route::middleware('auth.jwt')->group(function () {
    Route::apiResource('users', UserController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('subscriptions', SubscriptionController::class);
    Route::apiResource('subscriptionTypes', SubscriptionTypeController::class);
    Route::apiResource('subscriptionStatuses', SubscriptionStatusController::class);
    Route::apiResource('transactions', TransactionController::class);
    Route::apiResource('transactionTypes', TransactionTypeController::class);
    Route::apiResource('paymentMethods', PaymentMehtodController::class);
    Route::apiResource('paymentMethodTypes', PaymentMethodTypeController::class);
});
