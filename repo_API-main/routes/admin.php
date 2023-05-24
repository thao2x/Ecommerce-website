<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\PromoController;
use App\Http\Controllers\Admin\VariantController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['auth'])->group(function () {

    // Auth routes
    Route::view('/login', 'layout.auth')->name('guest')->withoutMiddleware(['auth']);
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login')->withoutMiddleware(['auth']);
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');

    // Home routes
    Route::get('/home', [HomeController::class, 'index'])->name('admin.home');

    // Order routes
    Route::get('/order', [OrderController::class, 'index'])->name('admin.order.index');
    Route::get('/order/{orderId}', [OrderController::class, 'show'])->name('admin.order.show');
    Route::post('/order/{orderId}', [OrderController::class, 'update'])->name('admin.order.update');
    Route::delete('/order/{orderId}', [OrderController::class, 'destroy'])->name('admin.order.destroy');
    
    // Product routes
    Route::get('/product', [ProductController::class, 'index'])->name('admin.product.index');
    Route::get('/product/new-product', [ProductController::class, 'store'])->name('admin.product.store');
    Route::get('/product/{productId}', [ProductController::class, 'show'])->name('admin.product.show');
    Route::post('/product/{productId}', [ProductController::class, 'update'])->name('admin.product.update');
    Route::get('/productssss/{productId}/delete', [ProductController::class, 'destroy'])->name('admin.product.destroy');

    // Category routes
    Route::get('/category', [CategoryController::class, 'index'])->name('admin.category.index');
    Route::post('/category', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/category/{categoryId}', [CategoryController::class, 'show'])->name('admin.category.show');
    Route::post('/category/{categoryId}', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::delete('/category/{categoryId}', [CategoryController::class, 'destroy'])->name('admin.category.destroy');

    // Shipping routes
    Route::get('/shipping', [ShippingController::class, 'index'])->name('admin.shipping.index');
    Route::post('/shipping', [ShippingController::class, 'store'])->name('admin.shipping.store');
    Route::get('/shipping/{shippingId}', [ShippingController::class, 'show'])->name('admin.shipping.show');
    Route::post('/shipping/{shippingId}', [ShippingController::class, 'update'])->name('admin.shipping.update');
    Route::delete('/shipping/{shippingId}', [ShippingController::class, 'destroy'])->name('admin.shipping.destroy');

    // Promo routes
    Route::get('/promo', [PromoController::class, 'index'])->name('admin.promo.index');
    Route::post('/promo', [PromoController::class, 'store'])->name('admin.promo.store');
    Route::get('/promo/{promoId}', [PromoController::class, 'show'])->name('admin.promo.show');
    Route::post('/promo/{promoId}', [PromoController::class, 'update'])->name('admin.promo.update');
    Route::delete('/promo/{promoId}', [PromoController::class, 'destroy'])->name('admin.promo.destroy');

    // Variant routes
    Route::get('/variant', [VariantController::class, 'index'])->name('admin.variant.index');
    Route::post('/variant', [VariantController::class, 'store'])->name('admin.variant.store');
    Route::get('/variant/{variantId}', [VariantController::class, 'show'])->name('admin.variant.show');
    Route::post('/variant/{variantId}', [VariantController::class, 'update'])->name('admin.variant.update');
    Route::delete('/variant/{variantId}', [VariantController::class, 'destroy'])->name('admin.variant.destroy');

    // Customer routes
    Route::get('/customer', [CustomerController::class, 'index'])->name('admin.customer.index');
    Route::get('/customer/{customerId}', [CustomerController::class, 'show'])->name('admin.customer.show');

    // User routes
    Route::get('/user', [UserController::class, 'index'])->name('admin.user.index');
    Route::post('/user', [UserController::class, 'update'])->name('admin.user.update');
});
