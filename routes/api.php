<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\OrderItemController;

// --- Public Routes (No Login Required) ---
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// View Products & Categories
Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::get('/categories', [CategoryController::class, 'index']);

// --- Protected Routes (Login Required) ---
Route::middleware('auth:sanctum')->group(function () {
    
    // User Info (Current Person)
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // --- NEW: All Users (Required for Admin Dashboard) ---
    Route::get('/users', function () {
        return \App\Models\User::all();
    });

    // Orders
    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    
    // Order Items
    Route::get('/order-items/{id}', [OrderItemController::class, 'show']);

    // Update Order Status (Admin/Staff)
    Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus']);

    // --- Product Management (Admin) ---
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
});