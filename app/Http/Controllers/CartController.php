<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Favorite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class CartController extends Controller
{
    public function index(): Response
    {
        $cartItems = Cart::all()->where('user_id', Auth::id());

        return Inertia::render('Cart', [
            'cartItems' =>  $cartItems->map(function ($cartItem) {
                return [
                    'cartItem' => $cartItem,
                    'product' => $cartItem->product,
                    'category' => $cartItem->product->category,
                    'subcategory' => $cartItem->product->subcategory
                ];
            }),
        ]);
    }

    public function getAmount(){
        $user_id = Auth::id();
        $cartAmount = Cart::all()->where('user_id', $user_id)->count();

        return response()->json($cartAmount);
    }

    public function addCart(Request $request){
        try{
            $data['product_id'] = $request->input('product_id');
            $data['user_id'] = Auth::id();

            $cartItem = Cart::where([
                'product_id' => $data['product_id'],
                'user_id' => $data['user_id'],
            ])->first();

            if ($cartItem) {
                // Если товар уже есть в корзине, увеличиваем его количество на 1
                $cartItem->increment('quantity');
            } else {
                // Если товара нет в корзине, добавляем новую запись
                $data['quantity'] = 1;
                Cart::create($data);
            }

            return response()->json("success");
        }catch (\Exception $e) {
            // Return JSON response with the error message
            return response()->json([
                'error' => $e->getMessage(),
            ])->setStatusCode(500);
        }
    }

    public function incrementCart($id){
        try{
            $cartItem = Cart::findOrFail($id);

            // Increment the quantity
            $cartItem->update([
                'quantity' => $cartItem->quantity + 1,
            ]);

        }catch (\Exception $e) {
            // Return JSON response with the error message
            return response()->json([
                'error' => $e->getMessage(),
            ])->setStatusCode(500);
        }
    }

    public function decrementCart($id){
        try{
            $cartItem = Cart::findOrFail($id);

            $newQuantity = $cartItem->quantity - 1;
            if ($newQuantity > 0) {
                // If the new quantity is greater than 0, update the cart item
                $cartItem->update([
                    'quantity' => $newQuantity,
                ]);
            } else {
                // If the new quantity is 0, delete the cart item
                $cartItem->delete();
            }

        }catch (\Exception $e) {
            // Return JSON response with the error message
            return response()->json([
                'error' => $e->getMessage(),
            ])->setStatusCode(500);
        }
    }
}
