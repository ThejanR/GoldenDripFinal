<?php

use Illuminate\Support\Facades\Route;

// LIVEWIRE
use App\Livewire\UserLogin;
use App\Livewire\UserDashboard;
use App\Livewire\Menu;
use App\Livewire\AdminLogin;

// CONTROLLERS
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController; 
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CheckoutController; 

Route::redirect('/', '/login');

// --- AUTH ROUTES ---
Route::get('/login', UserLogin::class)->name('login');
Route::get('/admin/login', AdminLogin::class)->name('admin.login');

// --- PROTECTED ROUTES ---
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/user/dashboard', UserDashboard::class)->name('user.dashboard');
    Route::get('/menu', Menu::class)->name('menu');
    Route::get('/about', [HomeController::class, 'about'])->name('about');
    
    // Contact
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.submit');
    
    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    // Dashboard Redirection
    Route::get('/dashboard', function () {
        // Uses the centralized isAdmin() method from your User model
        if (auth()->user() && auth()->user()->isAdmin()) { 
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('user.dashboard');
    })->name('dashboard');

    // Admin Panel
    // Protected by 'auth' and the 'access-admin' Gate
    Route::prefix('admin')->middleware(['auth', 'can:access-admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        
        // Product Management
        Route::get('/products', [AdminController::class, 'products'])->name('products.index'); // List
        Route::get('/products/create', [AdminController::class, 'create'])->name('products.create'); // Create Form
        Route::post('/products', [AdminController::class, 'store'])->name('products.store'); // Store Action
        Route::get('/products/{id}/edit', [AdminController::class, 'edit'])->name('products.edit'); // Edit Form
        Route::put('/products/{id}', [AdminController::class, 'update'])->name('products.update'); // Update Action
        Route::delete('/products/{id}', [AdminController::class, 'destroy'])->name('products.destroy'); // Delete Action

        // Order Management
        Route::get('/orders', [AdminController::class, 'orders'])->name('orders.index'); // List
        Route::delete('/orders/{id}', [AdminController::class, 'destroyOrder'])->name('orders.destroy'); // Delete Action
        Route::patch('/orders/{id}/status', [AdminController::class, 'updateStatus'])->name('orders.updateStatus'); // Update Status Action

        // User Management
        Route::get('/users', [AdminController::class, 'users'])->name('users.index'); // List
        Route::delete('/users/{id}', [AdminController::class, 'destroyUser'])->name('users.destroy'); // Delete Action
    });


});