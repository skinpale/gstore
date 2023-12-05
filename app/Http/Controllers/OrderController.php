<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function create(){
        // Начать транзакцию для обеспечения атомарности операций
        DB::beginTransaction();
        try {
            // Шаг 1: Получить элементы корзины для пользователя
            $cartItems = Cart::where('user_id', Auth::id())->get();
            // Шаг 2-6: Создать заказ и связанные элементы заказа
            $order = new Order();
            $order->total = 0; // Вы можете установить начальное значение в зависимости от ваших требований
            $order->user_id = Auth::id();
            $order->save();
            foreach ($cartItems as $cartItem) {
                // Шаг 2: Получить продукт для каждого элемента корзины
                $product = Product::find($cartItem->product_id);
                // Шаг 3: Рассчитать subtotal
                $price = $product->discount_price !== null ? (float) $product->discount_price : (float) $product->price;
                $subtotal = (float) $cartItem->quantity * $price;
                // Шаг 4: Создать элемент заказа
                $orderItem = new OrderItem();
                $orderItem->subtotal = $subtotal;
                $orderItem->quantity = $cartItem->quantity;
                $orderItem->product_id = $product->id;
                $orderItem->order_id = $order->id;
                $orderItem->save();
                // Шаг 5: Удалить элемент из корзины
                $cartItem->delete();
                // Шаг 6: Обновить общую сумму заказа
                $order->total += $subtotal;
            }
            // Сохранить изменения в заказе
            $order->save();
            // Подтвердить транзакцию
            DB::commit();
            return response()->json(['message' => 'Order created successfully'], 200);
        } catch (\Exception $e) {
            // Откатить транзакцию в случае ошибки
            DB::rollback();

            return response()->json(['message' => 'Error creating order'], 500);
        }

    }

    public function getOrders(){
        $user_id = Auth::id();
        // Eager load the related OrderItems using the 'orderItems' relationship
        $orders = Order::with('orderItems.product')->where('user_id', $user_id)->get();

        return response()->json($orders);
    }
}
