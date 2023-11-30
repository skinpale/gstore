<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class WelcomeController extends Controller
{
    public function index(){
        $products = Product::whereNotNull('discount_price')->take(8)->get();
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'products' => $products
        ]);
    }
}
