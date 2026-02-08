<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $orders = $request->user()->orders()->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $orders,
            'message' => 'Orders retrieved successfully'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.name' => 'required|string',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.quantity' => 'required|integer|min:1',
            'total' => 'required|numeric|min:0',
            'payment_method' => 'required|string',
            'delivery_address' => 'nullable|string',
            'delivery_method' => 'nullable|string|in:pickup,delivery',
        ]);

        // Calculate total amount from items to ensure accuracy
        $totalAmount = 0;
        foreach ($validated['items'] as $item) {
            $totalAmount += $item['price'] * $item['quantity'];
        }

        // Get Authenticated User
        $user = $request->user();

        // Split name into first and last name for the database
        $nameParts = explode(' ', $user->name, 2);
        $firstName = $nameParts[0] ?? 'N/A';
        $lastName = $nameParts[1] ?? '';

        // Create the Order
        $order = \App\Models\Order::create([
            'user_id' => $user->id, 
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $user->email,
            'address' => $validated['delivery_address'] ?? null, // Map delivery_address to address
            'city' => 'N/A', // Defaulting as app doesn't send it yet
            'zip_code' => 'N/A', // Defaulting as app doesn't send it yet
            'payment_method' => $validated['payment_method'],
            'delivery_method' => $validated['delivery_method'] ?? 'pickup', // Save delivery method
            'total_amount' => $totalAmount,
            'status' => 'pending',
        ]);

        // Create Order Items
        foreach ($validated['items'] as $item) {
            \App\Models\OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'product_name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Order created successfully!',
            'data' => [
                'order_id' => $order->id,
                'total_amount' => $order->total_amount,
                'status' => $order->status
            ]
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Update Order Status
     */
    public function updateStatus(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,preparing,ready,completed,cancelled',
        ]);

        $order = \App\Models\Order::findOrFail($id);
        $order->status = $request->status;
        $order->save();

        return response()->json([
            'message' => 'Order status updated successfully!',
            'status' => $order->status,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
