<?php


namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();
        $cartItems = $request->input('cartItems');
        $total = $request->input('total');

        $order = Order::create([
            'user_id' => $user->id,
            'total' => $total,
            'status' => 'Pending'
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price']
            ]);
        }

        return response()->json([
            'message' => 'Order placed successfully!',
            'order' => $order
        ], 201);
    }

    public function index()
    {
        $orders = Auth::user()->orders()->with('orderItems.product')->get();
        return response()->json($orders);
    }

    public function show($id)
    {
        $order = Auth::user()->orders()->with('orderItems.product')->findOrFail($id);
        return response()->json($order);
    }
}

