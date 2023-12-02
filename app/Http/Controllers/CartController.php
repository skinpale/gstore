<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function getAmount(){
        $user_id = Auth::id();
        $cartAmount = Cart::all()->where('user_id', $user_id)->count();

        return response()->json($cartAmount);
    }
}
