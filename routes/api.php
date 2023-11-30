<?php

use App\Http\Controllers\CategoryController;
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


