<?php

use App\Http\Controllers\Pages\WelcomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

// Test request
Route::get('/test', function (){
    $products = \App\Models\Product::whereNotNull('discount_price')
        ->select('id', 'name', 'discount_price')
        ->get();

    dd($products);
});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', function (){
    $products = Product::whereNotNull('discount_price')->get();

    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'products' => $products
    ]);
})->name('/');

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('/{category}/{subcategory?}', [ProductController::class, 'index'])->name('products');

