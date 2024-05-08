<?php

use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CustomerController;




Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();



Route::prefix('admin')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product#delete');
    Route::get('/customers/delete/{id}', [CustomerController::class, 'destroy'])->name('customers#delete');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/settings/store', [SettingController::class, 'store'])->name('settings.store');

    Route::resource('products', ProductController::class);
    Route::resource('customers', CustomerController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
