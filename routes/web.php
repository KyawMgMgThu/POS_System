<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CartDetailController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\TransactionsController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();



Route::prefix('admin')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product#delete');
    Route::get('/customers/delete/{id}', [CustomerController::class, 'destroy'])->name('customers#delete');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings/store', [SettingController::class, 'store'])->name('settings.store');
    Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');
    Route::post('/cart/changeQuantity', [CartController::class, 'changeQuantity'])->name('cart.changeQuantity');
    Route::delete('/cart/empty', [CartController::class, 'empty'])->name('cart.empty');

    Route::resource('products', ProductController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('cart', CartController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
