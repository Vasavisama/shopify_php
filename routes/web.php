<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Store;

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

use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CartController;

Route::get('/customer/stores', [CustomerController::class, 'index'])->name('customer.stores.index');
Route::get('/customer/stores/{store}', [CustomerController::class, 'show'])->name('customer.stores.show');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');

Route::middleware(['auth:api', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('themes', ThemeController::class);
    Route::resource('stores', StoreController::class);
    Route::resource('products', ProductController::class);
    // Add other admin routes here
});

Route::middleware(['auth:api'])->group(function () {
    Route::get('/dashboard/admin', function () {
        return view('dashboard.admin');
    })->middleware('role:admin')->name('dashboard.admin');

    Route::get('/dashboard/user', function (Request $request) {
        $stores = Store::whereHas('user', function ($query) {
            $query->where('role', 'admin');
        })->get();
        $addresses = $request->user()->addresses;
        return view('dashboard.user', compact('stores', 'addresses'));
    })->middleware('role:user')->name('dashboard.user');

    Route::get('/customer/address/create', [CustomerController::class, 'createAddress'])->name('customer.address.create');
    Route::post('/customer/address', [CustomerController::class, 'storeAddress'])->name('customer.address.store');
    Route::post('/customer/address/select', [CustomerController::class, 'selectAddress'])->name('customer.address.select');
});
