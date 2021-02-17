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
Route::get('/cart/count', [PageController::class, 'getCart'])->name('getCart');
Route::get('/cart/preview', [PageController::class, 'previewCart'])->name('previewCart');
Route::get('/cart/fetch', [PageController::class, 'fetchCart'])->name('fetchCart');
Route::post('/cart/update', [PageController::class, 'updateCart'])->name('updateCart');
Route::get('cart/total', [PageController::class, 'getCartTotal'])->name('getCartTotal');
Route::get('cart/payment', [PageController::class, 'initPayment'])->name('initPayment');
Route::get('cart/verify-payment', [PageController::class, 'verifyPayment'])->name('verifyPayment');
Route::delete('cart/delete', [PageController::class, 'deleteCart'])->name('deleteCart');
Route::get('profile/', [PageController::class, 'viewProfile'])->name('viewProfile');