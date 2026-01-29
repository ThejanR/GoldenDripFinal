<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
            'zipCode' => 'required',
            'paymentMethod' => 'required',
            'cartItems' => 'required',
        ]);

        $cartItems = json_decode($request->cartItems, true);
        $subtotal = 0;
        foreach($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }
        $total = $subtotal + ($subtotal * 0.085);

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => Auth::id(),
                'first_name' => $validated['firstName'],
                'last_name' => $validated['lastName'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'city' => $validated['city'],
                'zip_code' => $validated['zipCode'],
                'payment_method' => $validated['paymentMethod'],
                'total_amount' => $total,
                'status' => 'pending'
            ]);

            foreach($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['id'], // Link to the product
                    'product_name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity']
                ]);
            }

            DB::commit();
            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}