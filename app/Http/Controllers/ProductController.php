<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
            'products' => $products
        ]);
    }
}
