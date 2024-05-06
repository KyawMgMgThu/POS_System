<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;




Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();



Route::prefix('admin')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::resource('products', ProductController::class);
    Route::get('product/delete/{id}', [ProductController::class, 'destroy'])->name('product#delete');
    Route::resource('customers', CustomerController::class);
});
