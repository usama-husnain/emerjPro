<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;


//Route::get('/', function () {
//    return view('welcome');
//});
//
//Auth::routes();


Route::redirect('/', '/login');


Auth::routes(['register' => false]);


Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth', 'role:Admin']], function () {
    Route::get('/', [AdminController::class, 'index'])->name('home');


});

Route::group(['prefix' => 'user', 'as' => 'user.', 'namespace' => 'User', 'middleware' => ['auth', 'role:User']], function () {
    Route::get('/', [UserController::class, 'index'])->name('home');
});
