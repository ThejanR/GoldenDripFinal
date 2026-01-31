<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            {{-- Header section --}}
            <div class="md:flex md:items-center md:justify-between mb-8">
                <div class="flex-1 min-w-0">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                        Admin Dashboard
                    </h2>
                    <p class="mt-1 text-sm text-gray-500">
                        Welcome back, {{ Auth::user()->name }}
                    </p>
                </div>
                <div class="mt-4 flex md:mt-0 md:ml-4">
                    <a href="{{ route('menu') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none">
                        View Live Site
                    </a>
                </div>
            </div>

            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                {{-- Total Orders Card --}}
                <div class="bg-white overflow-hidden shadow rounded-lg border-l-4 border-green-500">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-shopping-cart text-2xl text-green-600"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Orders</dt>
                                    <dd class="text-lg font-medium text-gray-900">{{ $stats['orders']['total'] }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Revenue Card --}}
                <div class="bg-white overflow-hidden shadow rounded-lg border-l-4 border-purple-500">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-dollar-sign text-2xl text-purple-600"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Total Revenue</dt>
                                    <dd class="text-lg font-medium text-gray-900">${{ number_format($stats['orders']['revenue'], 2) }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Products Card --}}
                <div class="bg-white overflow-hidden shadow rounded-lg border-l-4 border-amber-500">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <i class="fas fa-coffee text-2xl text-amber-600"></i>
                            </div>
                            <div class="ml-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">Active Products</dt>
                                    <dd class="text-lg font-medium text-gray-900">{{ $stats['products']['available'] }} / {{ $stats['products']['total'] }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                {{-- Quick Actions - NOW LINKED --}}
                <div class="bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Quick Actions</h3>
                        <div class="grid grid-cols-2 gap-4">
                            {{-- FIXED: Added route to create product --}}
                            <a href="{{ route('products.create') }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-amber-600 hover:bg-amber-700">
                                <i class="fas fa-plus mr-2"></i> Add Product
                            </a>
                            {{-- Placeholder for future order management --}}
                            <button class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                                <i class="fas fa-list mr-2"></i> Manage Orders
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Status --}}
                <div class="bg-white shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">System Status</h3>
                        <div class="space-y-3">
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-check-circle text-green-400 mr-2"></i>
                                <span>System running normally</span>
                            </div>
                            <div class="flex items-center text-sm text-gray-500">
                                <i class="fas fa-users text-blue-400 mr-2"></i>
                                <span>{{ $stats['users']['total'] }} registered users</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bottom Management Grid - NOW LINKED --}}
            <div class="bg-white shadow rounded-lg">
                <div class="px-4 py-5 sm:p-6">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Management</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        
                        {{-- FIXED: Linked to product creation/list --}}
                        <a href="{{ route('products.index') }}" class="group relative bg-white p-6 focus-within:ring-2 focus-within:ring-inset focus-within:ring-amber-500 rounded-lg border border-gray-200 hover:border-amber-300 transition">
                            <div>
                                <span class="rounded-lg inline-flex p-3 bg-amber-50 text-amber-700 ring-4 ring-white">
                                    <i class="fas fa-coffee text-xl"></i>
                                </span>
                            </div>
                            <div class="mt-4">
                                <h3 class="text-lg font-medium">Products</h3>
                                <p class="mt-2 text-sm text-gray-500">Manage your coffee menu.</p>
                            </div>
                        </a>

                        <a href="{{ route('orders.index') }}" class="group relative bg-white p-6 rounded-lg border border-gray-200 hover:border-green-300 transition">
                            <div>
                                <span class="rounded-lg inline-flex p-3 bg-green-50 text-green-700 ring-4 ring-white">
                                    <i class="fas fa-shopping-cart text-xl"></i>
                                </span>
                            </div>
                            <div class="mt-4">
                                <h3 class="text-lg font-medium">Orders</h3>
                                <p class="mt-2 text-sm text-gray-500">View customer orders.</p>
                            </div>
                        </a>

                        <a href="{{ route('users.index') }}" class="group relative bg-white p-6 rounded-lg border border-gray-200 hover:border-blue-300 transition">
                            <div>
                                <span class="rounded-lg inline-flex p-3 bg-blue-50 text-blue-700 ring-4 ring-white">
                                    <i class="fas fa-users text-xl"></i>
                                </span>
                            </div>
                            <div class="mt-4">
                                <h3 class="text-lg font-medium">Users</h3>
                                <p class="mt-2 text-sm text-gray-500">Manage customer accounts.</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>