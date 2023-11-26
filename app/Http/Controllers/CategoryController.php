<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories()
    {
        $categories = Category::all();

        return response()->json(['categories' => $categories]);
    }
    public function getSubCategories()
    {
        $subcategories = Subcategory::all();

        return response()->json(['subcategories' => $subcategories]);
    }
}
