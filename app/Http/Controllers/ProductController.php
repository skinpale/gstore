<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function getProducts(Request $request, Category $category, Subcategory $subcategory = null)
    {
        $productsQuery = $subcategory
            ? $subcategory->products()
            : $category->products();

        $products = $productsQuery->paginate(4);

        return Inertia::render('Products', [
            'products' => $products,
            'category' => $category,
            'subcategory' => $subcategory
        ])->with([
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register')
        ]);
    }

    public function show($code){
        $product = Product::where('vendor_code', $code)->first();

        if(!$product){
            abort(404);
        }

        return Inertia::render('Product', [
            'product' => $product,
            'category' => $product->category,
            'subcategory' => $product->subcategory
        ])->with([
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register')
        ]);
    }

    public function getNumberOfImages($vendorCode){
        $directory = storage_path("app/public/hardware/monitors/{$vendorCode}");

        // Check if the directory exists
        if (File::isDirectory($directory)) {
            $images = File::files($directory);
            $numberOfImages = count($images);

            return response()->json(['numberOfImages' => $numberOfImages]);
        } else {
            return response()->json(['numberOfImages' => 0]);
        }
    }
}
