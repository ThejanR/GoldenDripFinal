<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OrderItem;
use App\Http\Resources\OrderItemResource;

class OrderItemController extends Controller
{
    public function show($id)
    {
        // Find the item or show 404 error
        $item = OrderItem::findOrFail($id);
        return new OrderItemResource($item);
    }
}