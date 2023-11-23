<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\JsonResponse;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function getProducts(Category $category, Subcategory $subcategory = null)
//    : JsonResponse
    {
        $productsQuery = $subcategory
            ? $subcategory->products()
            : $category->products();

        $products = $productsQuery->get();

        return Inertia::render('Products', [
            'products' => $products
        ]);

//        return response()->json(['products' => $products]);
    }
}
