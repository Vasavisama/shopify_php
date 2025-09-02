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

use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ThemeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Artisan;

Route::get('/run-tests', function () {
    Artisan::call('test');
    return Artisan::output();
});

Route::get('/customer/stores', [CustomerController::class, 'index'])->name('customer.stores.index');
Route::get('/customer/stores/{store}', [CustomerController::class, 'show'])->name('customer.stores.show');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{product}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/cart/increment/{product}', [CartController::class, 'increment'])->name('cart.increment');
Route::post('/cart/decrement/{product}', [CartController::class, 'decrement'])->name('cart.decrement');

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

    Route::get('/dashboard/user', [\App\Http\Controllers\DashboardController::class, 'userDashboard'])->middleware('role:user')->name('dashboard.user');

    // Wishlist Routes
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::delete('/wishlist/{wishlist}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
});
