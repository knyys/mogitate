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

Route::get('/products', [ProductController::class,'index']);
//あとで修正//
Route::get('/products/1',[ProductController::class,'product']);
Route::post('/products/1',[ProductController::class,'update']);
Route::get('/products/register',[ProductController::class,'registerform']);
Route::post('/products/register',[ProductController::class,'register']);