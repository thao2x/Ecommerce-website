<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {

    Route::get('/admin/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('admin.home');

    Route::view('/admin/login', 'layout.login')->name('guest')->withoutMiddleware(['auth']);
    Route::post('/admin/login', [App\Http\Controllers\Admin\AuthController::class, 'login'])->name('admin.login')->withoutMiddleware(['auth']);
    Route::get('/admin/logout', [App\Http\Controllers\Admin\AuthController::class, 'logout'])->name('admin.logout');

    Route::get('/admin/order', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin.order.index');
    Route::get('/admin/order/{orderId}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('admin.order.show');
    Route::post('/admin/order/{orderId}', [App\Http\Controllers\Admin\OrderController::class, 'update'])->name('admin.order.update');
    Route::delete('/admin/order/{orderId}', [App\Http\Controllers\Admin\OrderController::class, 'destroy'])->name('admin.order.destroy');

    Route::get('/admin/product', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('admin.product.index');
    Route::get('/admin/product/new-product', [App\Http\Controllers\Admin\ProductController::class, 'store'])->name('admin.product.store');
    Route::get('/admin/product/{productId}', [App\Http\Controllers\Admin\ProductController::class, 'show'])->name('admin.product.show');
    Route::post('/admin/product/{productId}', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('admin.product.update');
    Route::get('/admin/productssss/{productId}/delete', [App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('admin.product.destroy');

    Route::get('/admin/category', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('admin.category.index');
    Route::post('/admin/category', [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('admin.category.store');
    Route::get('/admin/category/{categoryId}', [App\Http\Controllers\Admin\CategoryController::class, 'show'])->name('admin.category.show');
    Route::post('/admin/category/{categoryId}', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('admin.category.update');
    Route::delete('/admin/category/{categoryId}', [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('admin.category.destroy');

    Route::get('/admin/shipping', [App\Http\Controllers\Admin\ShippingController::class, 'index'])->name('admin.shipping.index');
    Route::post('/admin/shipping', [App\Http\Controllers\Admin\ShippingController::class, 'store'])->name('admin.shipping.store');
    Route::get('/admin/shipping/{shippingId}', [App\Http\Controllers\Admin\ShippingController::class, 'show'])->name('admin.shipping.show');
    Route::post('/admin/shipping/{shippingId}', [App\Http\Controllers\Admin\ShippingController::class, 'update'])->name('admin.shipping.update');
    Route::delete('/admin/shipping/{shippingId}', [App\Http\Controllers\Admin\ShippingController::class, 'destroy'])->name('admin.shipping.destroy');

    Route::get('/admin/promo', [App\Http\Controllers\Admin\PromoController::class, 'index'])->name('admin.promo.index');
    Route::post('/admin/promo', [App\Http\Controllers\Admin\PromoController::class, 'store'])->name('admin.promo.store');
    Route::get('/admin/promo/{promoId}', [App\Http\Controllers\Admin\PromoController::class, 'show'])->name('admin.promo.show');
    Route::post('/admin/promo/{promoId}', [App\Http\Controllers\Admin\PromoController::class, 'update'])->name('admin.promo.update');
    Route::delete('/admin/promo/{promoId}', [App\Http\Controllers\Admin\PromoController::class, 'destroy'])->name('admin.promo.destroy');

    Route::get('/admin/variant', [App\Http\Controllers\Admin\VariantController::class, 'index'])->name('admin.variant.index');
    Route::post('/admin/variant', [App\Http\Controllers\Admin\VariantController::class, 'store'])->name('admin.variant.store');
    Route::get('/admin/variant/{variantId}', [App\Http\Controllers\Admin\VariantController::class, 'show'])->name('admin.variant.show');
    Route::post('/admin/variant/{variantId}', [App\Http\Controllers\Admin\VariantController::class, 'update'])->name('admin.variant.update');
    Route::delete('/admin/variant/{variantId}', [App\Http\Controllers\Admin\VariantController::class, 'destroy'])->name('admin.variant.destroy');

    Route::get('/admin/customer', [App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('admin.customer.index');
    Route::get('/admin/customer/{customerId}', [App\Http\Controllers\Admin\CustomerController::class, 'show'])->name('admin.customer.show');

    Route::get('/admin/user', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('admin.user.index');
    Route::post('/admin/user', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('admin.user.update');
});