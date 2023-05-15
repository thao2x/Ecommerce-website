<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware(['auth:api-customer'])->group(function () {
	Route::get('/customer', [App\Http\Controllers\Api\CustomerController::class, 'index'])->name('api.customer.index');
	Route::post('/customer', [App\Http\Controllers\Api\CustomerController::class, 'update'])->name('api.customer.update');
	
	Route::get('/address', [App\Http\Controllers\Api\AddressController::class, 'index'])->name('api.address.index');
	Route::post('/address', [App\Http\Controllers\Api\AddressController::class, 'store'])->name('api.address.store');

	Route::get('/cart', [App\Http\Controllers\Api\CartController::class, 'index'])->name('api.cart.index');
	Route::post('/cart', [App\Http\Controllers\Api\CartController::class, 'store'])->name('api.cart.store');
	Route::post('/cart/{itemId}', [App\Http\Controllers\Api\CartController::class, 'update'])->name('api.cart.update');
	Route::delete('/cart/{itemId}', [App\Http\Controllers\Api\CartController::class, 'destroy'])->name('api.cart.destroy');

	Route::get('/order', [App\Http\Controllers\Api\OrderController::class, 'index'])->name('api.order.index');
	Route::post('/order', [App\Http\Controllers\Api\OrderController::class, 'store'])->name('api.order.store');
	Route::get('/order/{orderId}', [App\Http\Controllers\Api\OrderController::class, 'show'])->name('api.order.show');
	
	Route::get('/category', [App\Http\Controllers\Api\CategoryController::class, 'index'])->name('api.category.index')->withoutMiddleware(['auth:api-customer']);
	Route::get('/category/{categoryId}', [App\Http\Controllers\Api\CategoryController::class, 'search'])->name('api.category.search')->withoutMiddleware(['auth:api-customer']);
	
	Route::get('/promos', [App\Http\Controllers\Api\PromoController::class, 'index'])->name('api.promo.index')->withoutMiddleware(['auth:api-customer']);

	Route::get('/shippings', [App\Http\Controllers\Api\ShippingController::class, 'index'])->name('api.shipping.index')->withoutMiddleware(['auth:api-customer']);
	
	Route::get('/product', [App\Http\Controllers\Api\ProductController::class, 'index'])->name('api.product.index')->withoutMiddleware(['auth:api-customer']);
	Route::get('/product/{productId}', [App\Http\Controllers\Api\ProductController::class, 'show'])->name('api.product.show')->withoutMiddleware(['auth:api-customer']);
	
	Route::get('/search', [App\Http\Controllers\Api\ProductController::class, 'search'])->name('api.search.index')->withoutMiddleware(['auth:api-customer']);
	
	Route::get('/popular', [App\Http\Controllers\Api\PopularController::class, 'index'])->name('api.popular.index')->withoutMiddleware(['auth:api-customer']);
	Route::get('/popular/{popularId}', [App\Http\Controllers\Api\PopularController::class, 'show'])->name('api.popular.show')->withoutMiddleware(['auth:api-customer']);
	
	Route::get('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout'])->name('api.logout');
	Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login'])->name('api.login')->withoutMiddleware(['auth:api-customer']);
	Route::post('/register', [App\Http\Controllers\Api\AuthController::class, 'register'])->name('api.register')->withoutMiddleware(['auth:api-customer']);
});