<?php

use App\Http\Controllers\LinksController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', [WelcomeController::class, 'index'])->name('/');

Route::get('/search', [ProductController::class, 'search'])->name('search');

Route::get('/about', [LinksController::class, 'about'])->name('about');
Route::get('/guarantee', [LinksController::class, 'guarantee'])->name('guarantee');
Route::get('/points', [LinksController::class, 'points'])->name('points');

Route::get('/products/{product}', [ProductController::class, 'getProduct'])->name('products.show');

Route::get('/{category}/{subcategory?}', [ProductController::class, 'index'])->name('products');

