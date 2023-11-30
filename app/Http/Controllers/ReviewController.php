<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ReviewController extends Controller
{
    public function store(Request $request){
        try {
            $data = $request->validate([
                'rating' => 'required|integer|min:1|max:5',
                'comment' => 'required|string',
            ]);

            $data['user_id'] = $request->input('user_id');
            $data['product_id'] = $request->input('product_id');

            $review = Review::create($data);
            $review->username = $review->user->name;

            $product = Product::findOrFail($request->input('product_id'));
            $reviews = Review::where('product_id', $product->id)->get();

            $totalRating = $reviews->sum('rating');
            $averageRating = $reviews->count() > 0 ? round($totalRating / $reviews->count(), 1) : 0;


            // Update the product with the new average rating
            $product->update(['rating' => $averageRating]);

            // Return JSON response with the updated reviews
            return response()->json([
                'review' => $review,
            ]);
        } catch (\Exception $e) {
            // Return JSON response with the error message
            return response()->json([
                'error' => $e->getMessage(),
            ])->setStatusCode(500);
        }
    }
}
