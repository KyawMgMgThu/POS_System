<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();



Route::prefix('admin')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::resource('products', ProductController::class);
    Route::get('product/delete/{id}', [ProductController::class, 'destroy'])->name('product#delete');
});
