<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;

class AdminController extends Controller
{
    // Dashboard Page
    public function index()
    {
        $stats = [
            'products' => [
                'total' => Product::count(),
                'available' => Product::count(), 
            ],
            'orders' => [
                'total' => \App\Models\Order::count(),
                'revenue' => \App\Models\Order::sum('total_amount'), 
                'pending' => \App\Models\Order::where('status', 'pending')->count(), 
            ],
            'users' => [
                'total' => User::count(),
            ]
        ];

        // Fetch products with their category for the dashboard table
        $products = Product::with('category')->get();

        return view('admin.dashboard', compact('stats', 'products'));
    }

    // Show the Add Product Form
    public function create()
    {
        $categories = Category::all();
        return view('admin.create', compact('categories'));
    }

    // Save the Product to Database
    public function store(Request $request)
    {
        // ... (Existing Store Logic) ...
        // 1. Validate inputs (Ignoring extra fields as requested)
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id', 
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        // 2. Upload Image
        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $imagePath = 'images/' . $filename;
        }

        // 3. Create Product using core fields only
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Product added successfully!');
    }

    // --- NEW METHODS FOR FULL CRUD ---

    // 1. List / Search / Filter Products
    public function products(Request $request)
    {
        // Decoupled Architecture Requirement:
        // Do NOT fetch products from DB here.
        // Instead, provide the View with an API Token so JS can fetch data.
        
        $apiToken = $request->user()->createToken('frontend_access')->plainTextToken;
        $categories = Category::all(); // Keeping this for the filter dropdown to avoid breaking UI layout immediately
        
        // Pass token to view, NO products variable.
        return view('admin.products.index', compact('apiToken', 'categories'));
    }

    // 2. Edit Form
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    // 3. Update Action
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image is optional on update
        ]);

        // Handle Image Upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path($product->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images'), $filename);
            $product->image = 'images/' . $filename;
        }

        // Update fields
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->category_id = $request->category_id;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    // 4. Delete Action
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete Image
        if ($product->image && file_exists(public_path($product->image))) {
            unlink(public_path($product->image));
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }

    // --- ORDERS MANAGEMENT ---

    // 1. List / Search / Filter Orders
    public function orders(Request $request)
    {
        $query = \App\Models\Order::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhere('first_name', 'like', "%{$search}%")
                  ->orWhere('last_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by Status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Pagination
        $orders = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        // API Token for Frontend Fetch Requests
        $apiToken = $request->user()->createToken('frontend_access')->plainTextToken;

        return view('admin.orders.index', compact('orders', 'apiToken'));
    }

    // 2. Delete Order
    public function destroyOrder($id)
    {
        $order = \App\Models\Order::findOrFail($id);
        $order->delete();

        return redirect()->route('orders.index')->with('success', 'Order deleted successfully!');
    }

    // 3. Update Order Status
    public function updateStatus(Request $request, $id)
    {
        $order = \App\Models\Order::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,confirmed,preparing,ready,completed,cancelled',
        ]);

        $order->status = $request->status;
        $order->save();

        return redirect()->route('orders.index')->with('success', 'Order status updated successfully!');
    }

    // --- USERS MANAGEMENT ---

    // 1. List / Search / Filter Users
    public function users(Request $request)
    {
        $query = \App\Models\User::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by Role (user_type)
        if ($request->filled('role')) {
            $query->where('user_type', $request->role);
        }

        // Pagination
        $users = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    // 2. Delete User
    public function destroyUser($id)
    {
        // Prevent deleting self
        if (auth()->id() == $id) {
            return redirect()->route('users.index')->with('error', 'You cannot delete your own account.');
        }

        $user = \App\Models\User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully!');
    }
}