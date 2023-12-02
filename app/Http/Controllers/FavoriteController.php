<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function addFavorite(Request $request){
        try{
            $data['product_id'] = $request->input('product_id');
            $data['user_id'] = Auth::id();;

            $favorite = Favorite::create($data);
            return response()->json($favorite);
        }catch (\Exception $e) {
            // Return JSON response with the error message
            return response()->json([
                'error' => $e->getMessage(),
            ])->setStatusCode(500);
        }
    }

    public function checkFavorite(Request $request){
        try{
            $data['product_id'] = $request->input('product_id');
            $data['user_id'] = Auth::id();

            $favoriteExists = Favorite::where([
                'product_id' => $data['product_id'],
                'user_id' => $data['user_id'],
            ])->exists();

            return response()->json($favoriteExists);
        }catch (\Exception $e) {
            // Return JSON response with the error message
            return response()->json([
                'error' => $e->getMessage(),
            ])->setStatusCode(500);
        }
    }

    public function delete($favorite_id){
        try {
            // Find the favorite by ID
            $favorite = Favorite::findOrFail($favorite_id);

            // Delete the favorite
            $favorite->delete();

            return response()->json(['message' => 'Favorite deleted successfully'], Response::HTTP_OK);
        } catch (\Exception $e) {
            // Handle exceptions (e.g., model not found)
            return response()->json(['message' => 'Error deleting favorite'], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
