<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\PromoController;
use App\Http\Controllers\Api\ShippingController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\PopularController;
use App\Http\Controllers\Api\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes private
|--------------------------------------------------------------------------
*/
Route::middleware(['auth:api-customer'])->group(function () {
    // Auth routes
    Route::get('/logout', [AuthController::class, 'logout']);

    // Customer routes
    Route::get('/customer', [CustomerController::class, 'index']);
    Route::post('/customer', [CustomerController::class, 'update']);

    // Address routes
    Route::get('/address', [AddressController::class, 'index']);
    Route::post('/address', [AddressController::class, 'store']);
    Route::post('/address/{id}', [AddressController::class, 'update']);

    // Cart routes
    Route::get('/cart', [CartController::class, 'index']);
    Route::post('/cart', [CartController::class, 'store']);
    Route::post('/cart/{id}', [CartController::class, 'update']);
    Route::delete('/cart/{id}', [CartController::class, 'destroy']);

    // Order routes
    Route::get('/orders', [OrderController::class, 'index']);
    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
});

/*
|--------------------------------------------------------------------------
| API Routes public
|--------------------------------------------------------------------------
*/
Route::withoutMiddleware(['auth:api-customer'])->group(function () {
    // Auth routes
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

    // Category routes
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/{id}', [CategoryController::class, 'search']);

    // Promo routes
    Route::get('/promos', [PromoController::class, 'index']);

    // Shipping routes
    Route::get('/shipping', [ShippingController::class, 'index']);

    // Product routes
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::get('/search', [ProductController::class, 'search']);

    // Popular routes
    Route::get('/populars', [PopularController::class, 'index']);
    Route::get('/populars/{id}', [PopularController::class, 'show']);
});
