<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PageController::class, 'index'])->name('homepage');
Route::get('/category/{id}', [PageController::class, 'getProductsByCategory'])->name('category');
Route::get('/product/{id}', [PageController::class, 'getProduct'])->name('getProduct');
Route::get('/search', [PageController::class, 'searchForProduct'])->name('searchForProduct');
Route::post('/cart/add', [PageController::class, 'addToCart'])->name('addToCart');
Route::get('/cart/fetch', [PageController::class, 'getCart'])->name('getCart');
Route::get('/cart/preview', [PageController::class, 'previewCart'])->name('previewCart');