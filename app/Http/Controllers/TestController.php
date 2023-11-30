<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TestController extends Controller
{
    public function index(){
        $reviews = Review::all();

        return Inertia::render('Test', [
            'reviews' => $reviews,
        ]);
    }

    public function get(){
        $reviews = Review::all();

        return response()->json($reviews);
    }

    public function store(Request $request)
    {
        $review = new Review;
        $review->rating = $request->input('rating');
        $review->comment = $request->input('comment');
        $review->user_id = $request->input('user_id');
        $review->product_id = $request->input('product_id');
        $review->save();

        return response()->json($review);
    }
}
