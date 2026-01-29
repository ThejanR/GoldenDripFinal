<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'order_id' => $this->id,
            'total_price' => (float) $this->total_price,
            'status' => $this->status,
            'date' => $this->created_at->format('Y-m-d H:i'),
            // This line uses the OrderItemResource we just made!
            'items' => OrderItemResource::collection($this->items),
        ];
    }
}