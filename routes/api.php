<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/products/{vendorCode}', [ProductController::class, 'getNumberOfImages']);
Route::get('/categories', [CategoryController::class, 'getCategories']);
Route::get('/subcategories', [CategoryController::class, 'getSubCategories']);

Route::get('/reviews', [ReviewController::class, 'get']);
Route::post('/reviews', [ReviewController::class, 'store']);

Route::post('/order', [OrderController::class, 'create'])->middleware('web');
Route::get('/orders', [OrderController::class, 'getOrders'])->middleware('web');

Route::get('/cart/amount', [CartController::class, 'getAmount'])->middleware('web');
Route::post('/cart', [CartController::class, 'addCart'])->middleware('web');
Route::post('/cart/increment/{product_id}', [CartController::class, 'incrementCart'])->middleware('web');
Route::post('/cart/decrement/{product_id}', [CartController::class, 'decrementCart'])->middleware('web');

Route::get('/favorite', [FavoriteController::class, 'checkFavorite'])->middleware('auth')->middleware('web');
Route::post('/favorite', [FavoriteController::class, 'addFavorite'])->middleware('auth')->middleware('web');
Route::delete('/favorite/{product_id}', [FavoriteController::class, 'delete'])->middleware('auth')->middleware('web');


