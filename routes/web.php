<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;

Route::middleware(['auth:api', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('themes', ThemeController::class);
    Route::resource('stores', StoreController::class);
    Route::resource('products', ProductController::class);
});

Route::middleware(['auth:api'])->group(function () {
    Route::get('/dashboard/admin', function () {
        return view('dashboard.admin');
    })->middleware('role:admin')->name('dashboard.admin');

    Route::get('/dashboard/user', function () {
        return view('dashboard.user');
    })->middleware('role:user')->name('dashboard.user');
});
