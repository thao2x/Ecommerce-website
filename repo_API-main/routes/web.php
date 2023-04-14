<?php

use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function() {
    Route::get('login', [App\Http\Controllers\Admin\LoginController::class, 'loginForm'])->name('admin.loginForm');
    Route::post('login', [App\Http\Controllers\Admin\LoginController::class, 'login'])->name('admin.login');
    Route::get('logout', [App\Http\Controllers\Admin\LoginController::class, 'logout'])->name('admin.logout');
});

Route::group(['prefix' => 'admin'], function() {

    /**
    * Orders Routes
    */
    Route::group(['prefix' => 'orders'], function() {
        Route::get('/', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders.index');
        Route::get('/{order}/show',  [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
        Route::patch('/{order}/update', [App\Http\Controllers\Admin\OrderController::class, 'update'])->name('orders.update');
        Route::patch('/{order}/cancel', [App\Http\Controllers\Admin\OrderController::class, 'cancel'])->name('orders.cancel');
    });

    /**
    * Product Routes
    */
    Route::group(['prefix' => 'products'], function() {
        Route::get('/', [App\Http\Controllers\Admin\ProductController::class, 'index'])->name('products.index');
        Route::get('/create',  [App\Http\Controllers\Admin\ProductController::class, 'create'])->name('products.create');
        Route::post('/store',  [App\Http\Controllers\Admin\ProductController::class, 'store'])->name('products.store');
        Route::get('/{product}',  [App\Http\Controllers\Admin\ProductController::class, 'detail'])->name('products.detail');
        Route::get('/{product}/show',  [App\Http\Controllers\Admin\ProductController::class, 'show'])->name('products.show');
        Route::patch('/{product}/update', [App\Http\Controllers\Admin\ProductController::class, 'update'])->name('products.update');
        Route::get('/{product}/destroy', [App\Http\Controllers\Admin\ProductController::class, 'destroy'])->name('products.destroy');
    });

    /**
    * Category Routes
    */
    Route::group(['prefix' => 'categories'], function() {
        Route::get('/', [App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('categories.index');
        Route::get('/{category}/show',  [App\Http\Controllers\Admin\CategoryController::class, 'show'])->name('categories.show');
        Route::get('/create',  [App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('categories.create');
        Route::patch('/{category}/update', [App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('categories.update');
        Route::post('/store',  [App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('categories.store');
        Route::get('/{category}/destroy', [App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('categories.destroy');
    });

    /**
    * Shipping Routes
    */
    Route::group(['prefix' => 'shipping'], function() {
        Route::get('/', [App\Http\Controllers\Admin\ShippingController::class, 'index'])->name('shipping.index');
        Route::get('/{shipping}/show',  [App\Http\Controllers\Admin\ShippingController::class, 'show'])->name('shipping.show');
        Route::get('/create',  [App\Http\Controllers\Admin\ShippingController::class, 'create'])->name('shipping.create');
        Route::patch('/{shipping}/update', [App\Http\Controllers\Admin\ShippingController::class, 'update'])->name('shipping.update');
        Route::post('/store',  [App\Http\Controllers\Admin\ShippingController::class, 'store'])->name('shipping.store');
        Route::get('/{shipping}/destroy', [App\Http\Controllers\Admin\ShippingController::class, 'destroy'])->name('shipping.destroy');
    });

    /**
    * Promo Routes
    */
    Route::group(['prefix' => 'promo'], function() {
        Route::get('/', [App\Http\Controllers\Admin\PromoController::class, 'index'])->name('promo.index');
        Route::get('/{promo}/show',  [App\Http\Controllers\Admin\PromoController::class, 'show'])->name('promo.show');
        Route::get('/create',  [App\Http\Controllers\Admin\PromoController::class, 'create'])->name('promo.create');
        Route::patch('/{promo}/update', [App\Http\Controllers\Admin\PromoController::class, 'update'])->name('promo.update');
        Route::post('/store',  [App\Http\Controllers\Admin\PromoController::class, 'store'])->name('promo.store');
        Route::get('/{promo}/destroy', [App\Http\Controllers\Admin\PromoController::class, 'destroy'])->name('promo.destroy');
    });

     /**
    * Variant Routes
    */
    Route::group(['prefix' => 'variants'], function() {
        Route::post('/store',  [App\Http\Controllers\Admin\VariantController::class, 'store'])->name('variants.store');
        Route::get('/{variant}/show',  [App\Http\Controllers\Admin\VariantController::class, 'show'])->name('variants.show');
        Route::patch('/{variant}/update', [App\Http\Controllers\Admin\VariantController::class, 'update'])->name('variants.update');
        Route::get('/{variant}/destroy', [App\Http\Controllers\Admin\VariantController::class, 'destroy'])->name('variants.destroy');
    });

    /**
    * Customer Routes
    */
    Route::group(['prefix' => 'customers'], function() {
        Route::get('/', [App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('customers.index');
        Route::post('/store',  [App\Http\Controllers\Admin\CustomerController::class, 'store'])->name('customers.store');
        Route::get('/{customer}/show',  [App\Http\Controllers\Admin\CustomerController::class, 'show'])->name('customers.show');
        Route::patch('/{customer}/update', [App\Http\Controllers\Admin\CustomerController::class, 'update'])->name('customers.update');
        Route::delete('/{customer}/destroy', [App\Http\Controllers\Admin\CustomerController::class, 'destroy'])->name('customers.destroy');
    });

    /**
    * Users Routes
    */
    Route::group(['prefix' => 'users'], function() {
        Route::get('/', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
        Route::patch('/{user}/update', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
    });

    /**
    * Dashbroad Routes
    */
    Route::group(['prefix' => 'dashbroad'], function() {
        Route::get('/', [App\Http\Controllers\Admin\DashbroadController::class, 'index'])->name('dashbroad.index');
    });
});

Route::fallback(function () {
    return redirect()->route('dashbroad.index');
});
