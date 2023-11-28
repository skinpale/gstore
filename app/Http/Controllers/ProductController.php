<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use phpDocumentor\Reflection\Types\Integer;

class ProductController extends Controller
{
    public function index(Request $request, Category $category, Subcategory $subcategory = null)
    {
        $sortColumn = $request->query('by', 'rating');
        $sortOrder = $request->query('as', 'desc');

        $productsQuery = $subcategory
            ? $subcategory->products()
            : $category->products();

        $products_amount = $productsQuery->count();
        $allProducts = $productsQuery->orderBy($sortColumn, $sortOrder);
        $products = $allProducts->paginate(1);

        $products->appends(['by' => $sortColumn, 'as' => $sortOrder]);
        return Inertia::render('Products', [
            'products' => $products,
            'category' => $category,
            'subcategory' => $subcategory,
            'amount' => $products_amount
        ])->with([
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register')
        ]);
    }

    public function search(Request $request){
        $keyword = $request->query('q');
        $sortColumn = $request->query('by', 'rating');
        $sortOrder = $request->query('as', 'desc');

        $allProducts = Product::where('name', 'LIKE', '%' . $keyword . '%')
            ->orderBy($sortColumn, $sortOrder)
            ->paginate(1);

        $products_amount = $allProducts->total();

        $allProducts->appends(['q' => $keyword, 'by' => $sortColumn, 'as' => $sortOrder]);
        return Inertia::render('SearchResults', [
            'products' => $allProducts,
            'amount' => $products_amount,
            'search' => $keyword
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
