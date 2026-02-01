<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class OrderHistoryController extends Controller
{
    /**
     * Display a listing of the user's orders.
     */
    public function index()
    {
        // 1. Get the logged-in user's ID
        $userId = Auth::id();

        // 2. Fetch orders with their items, sorted by newest first
        $orders = Order::where('user_id', $userId)
                       ->with('items')
                       ->latest()
                       ->get();

        // 3. Return the view
        return view('orders.index', compact('orders'));
    }
}
