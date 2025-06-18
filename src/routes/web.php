<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/products', [ProductController::class,'index'])->name('products_list');
Route::get('/products/search', [ProductController::class, 'search'])->name('products_search');
Route::get('/products/register', [ProductController::class, 'registerform']);
Route::delete('/products/{productId}/delete', [ProductController::class, 'destroy'])->name('destroy');

Route::get('/products/{productId}', [ProductController::class, 'product'])->name('product');
Route::patch('/products/{product}/update', [ProductController::class, 'update'])->name('update');

Route::post('/products/register',[ProductController::class,'register'])->name('register');