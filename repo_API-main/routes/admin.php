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

    // Order routes
    Route::get('/order', [OrderController::class, 'index'])->name('admin.order.index');
    Route::get('/order/data', [OrderController::class, 'data'])->name('admin.order.data');
    Route::get('/order/{orderId}', [OrderController::class, 'show'])->name('admin.order.show');
    Route::get('/order/{orderId}/update-canceled', [OrderController::class, 'updateCanceled'])->name('admin.order.update-canceled');
    Route::get('/order/{orderId}/update-completed', [OrderController::class, 'updateCompleted'])->name('admin.order.update-completed');

    // Product routes
    Route::get('/product', [ProductController::class, 'index'])->name('admin.product.index');
    Route::get('/product/data', [ProductController::class, 'data'])->name('admin.product.data');
    Route::get('/product/create', [ProductController::class, 'create'])->name('admin.product.create');
    Route::post('/product/store', [ProductController::class, 'store'])->name('admin.product.store');
    Route::get('/product/{productId}', [ProductController::class, 'show'])->name('admin.product.show');
    Route::post('/product/{productId}/update', [ProductController::class, 'update'])->name('admin.product.update');
    Route::get('/product/{productId}/delete', [ProductController::class, 'destroy'])->name('admin.product.destroy');

    // Category routes
    Route::get('/category', [CategoryController::class, 'index'])->name('admin.category.index');
    Route::get('/category/data', [CategoryController::class, 'data'])->name('admin.category.data');
    Route::get('/category/create', [CategoryController::class, 'create'])->name('admin.category.create');
    Route::post('/category/store', [CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/category/{categoryId}', [CategoryController::class, 'show'])->name('admin.category.show');
    Route::post('/category/{categoryId}/update', [CategoryController::class, 'update'])->name('admin.category.update');
    Route::get('/category/{categoryId}/delete', [CategoryController::class, 'destroy'])->name('admin.category.destroy');

    // Shipping routes
    Route::get('/shipping', [ShippingController::class, 'index'])->name('admin.shipping.index');
    Route::get('/shipping/data', [ShippingController::class, 'data'])->name('admin.shipping.data');
    Route::get('/shipping/create', [ShippingController::class, 'create'])->name('admin.shipping.create');
    Route::post('/shipping/store', [ShippingController::class, 'store'])->name('admin.shipping.store');
    Route::get('/shipping/{shippingId}', [ShippingController::class, 'show'])->name('admin.shipping.show');
    Route::post('/shipping/{shippingId}/update', [ShippingController::class, 'update'])->name('admin.shipping.update');
    Route::get('/shipping/{shippingId}/delete', [ShippingController::class, 'destroy'])->name('admin.shipping.destroy');

    // Promo routes
    Route::get('/promo', [PromoController::class, 'index'])->name('admin.promo.index');
    Route::get('/promo/data', [PromoController::class, 'data'])->name('admin.promo.data');
    Route::get('/promo/create', [PromoController::class, 'create'])->name('admin.promo.create');
    Route::post('/promo/store', [PromoController::class, 'store'])->name('admin.promo.store');
    Route::get('/promo/{promoId}', [PromoController::class, 'show'])->name('admin.promo.show');
    Route::post('/promo/{promoId}/update', [PromoController::class, 'update'])->name('admin.promo.update');
    Route::get('/promo/{promoId}/delete', [PromoController::class, 'destroy'])->name('admin.promo.destroy');

    // Customer routes
    Route::get('/customer', [CustomerController::class, 'index'])->name('admin.customer.index');
    Route::get('/customer/data', [CustomerController::class, 'data'])->name('admin.customer.data');
    Route::get('/customer/{customerId}/data-order', [CustomerController::class, 'dataOrder'])->name('admin.customer.data-order');
    Route::get('/customer/{customerId}', [CustomerController::class, 'show'])->name('admin.customer.show');
    Route::get('/customer/{customerId}/delete', [CustomerController::class, 'destroy'])->name('admin.customer.destroy');

    // User routes
    Route::get('/user', [UserController::class, 'index'])->name('admin.user.index');
    Route::post('/user', [UserController::class, 'update'])->name('admin.user.update');
});
