<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\TransactionTypeController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\SubscriptionTypeController;
use App\Http\Controllers\Admin\SubscriptionStatusController;
use App\Http\Controllers\Admin\PaymentMethodTypeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


//Route::get('/', function () {
//    return view('welcome');
//});
//
//Auth::routes();


Route::redirect('/', '/login');


Auth::routes(['register' => false]);


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'role:Admin']], function () {
    Route::get('/', [AdminController::class, 'index'])->name('home');
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('transactions', TransactionController::class);
    Route::resource('transactionTypes', TransactionTypeController::class);
    Route::resource('subscriptions', SubscriptionController::class);
    Route::resource('subscriptionTypes', SubscriptionTypeController::class);
    Route::resource('subscriptionStatuses', SubscriptionStatusController::class);
    Route::resource('paymentMethodTypes', PaymentMethodTypeController::class);


});

Route::group(['prefix' => 'customer', 'as' => 'customer.', 'middleware' => ['auth', 'role:Customer']], function () {
    Route::get('/', [CustomerController::class, 'index'])->name('home');
});
