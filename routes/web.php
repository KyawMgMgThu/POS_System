<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\PrivacyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SuppliersController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CartDetailController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\TermsOfServiceController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::user();






Route::prefix('admin')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product#delete');
    Route::get('/customers/delete/{id}', [CustomerController::class, 'destroy'])->name('customers#delete');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings/store', [SettingController::class, 'store'])->name('settings.store');
    Route::post('/cart/store', [CartController::class, 'store'])->name('cart.store');
    Route::post('/cart/changeQuantity', [CartController::class, 'changeQuantity'])->name('cart.changeQuantity');
    Route::delete('/cart/empty', [CartController::class, 'empty'])->name('cart.empty');
    Route::post('/order/store', [OrderController::class, 'store']);
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/report', [ReportController::class, 'index'])->name('report.index');
    Route::get('/fetch-chart-data/{timeframe}', [OrderController::class, 'fetchChartData'])->name('fetch.chart.data');
    Route::get('/privacy-policy', [PrivacyController::class, 'index'])->name('privacy#privacy-policy');
    Route::get('/terms-of-service', [TermsOfServiceController::class, 'index'])->name('terms-of-service');


    Route::resource('products', ProductController::class);
    Route::resource('customers', CustomerController::class);
    Route::resource('cart', CartController::class);
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
