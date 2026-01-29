<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'product_name' => $this->product->name,
            'quantity' => $this->quantity,
            'price' => (float) $this->price,
            'subtotal' => $this->quantity * $this->price,
        ];
    }
}