<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // 1. GET /api/products (List all)
    public function index()
    {
        $products = Product::with('category')->get();
        return ProductResource::collection($products);
    }

    // 2. POST /api/products (Create new) - MISSING BEFORE
    public function store(Request $request)
    {
        // Validation (Required by your PDF guide)
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
        ]);

        $product = Product::create($validated);
        return new ProductResource($product);
    }

    // 3. GET /api/products/{id} (Show one)
    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return new ProductResource($product);
    }

    // 4. PUT /api/products/{id} (Update) - MISSING BEFORE
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'price' => 'sometimes|numeric',
            'category_id' => 'sometimes|exists:categories,id',
            'description' => 'nullable|string',
        ]);

        $product->update($validated);
        return new ProductResource($product);
    }

    // 5. DELETE /api/products/{id} (Delete) - MISSING BEFORE
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        
        // Return 200 OK message as shown in your PDF
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
}