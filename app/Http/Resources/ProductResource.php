<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
{
    return [
        'id' => $this->id,
        'name' => $this->name,
        'price' => (float) $this->price, // Ensure it is a number
        'description' => $this->description,
        // Show the category name instead of just the ID number
        'category' => $this->whenLoaded('category', function () {
            return $this->category->name;
        }),
        'image' => asset($this->image), // Full URL (e.g., http://10.0.2.2:8000/images/latte.png)
        'image_path' => $this->image,   // Raw Database Path (e.g., images/latte.png)
    ];
}
}
