<x-app-layout>
    <div class="min-h-screen bg-gray-50">
        <!-- Admin Header -->
        <div class="bg-white shadow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-6">
                    <div class="flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="text-amber-600 hover:text-amber-500 mr-4">
                            <i class="fas fa-arrow-left"></i> Back to Dashboard
                        </a>
                        <h1 class="text-2xl font-bold text-gray-900">Orders Management</h1>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Search and Filter -->
            <div class="bg-white shadow rounded-lg mb-6">
                <div class="px-4 py-5 sm:p-6">
                    <form method="GET" action="{{ route('orders.index') }}" class="flex flex-col sm:flex-row gap-4">
                        
                        <div class="flex-1">
                            <input type="text" name="search" placeholder="Search orders..." value="{{ request('search') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                        </div>
                        
                        <div>
                            <select name="status" class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                                <option value="">All Statuses</option>
                                @foreach(['pending', 'confirmed', 'preparing', 'ready', 'completed', 'cancelled'] as $status)
                                    <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <button type="submit" class="px-4 py-2 bg-amber-600 text-white rounded-md hover:bg-amber-700">
                            <i class="fas fa-search mr-2"></i>Search
                        </button>
                    </form>
                </div>
            </div>

            <!-- Success Message -->
            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Orders Table -->
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <div class="px-4 py-5 sm:p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Order Details</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Customer</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($orders as $order)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">#{{ $order->id }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $order->first_name }} {{ $order->last_name }}</div>
                                        <div class="text-sm text-gray-500">{{ $order->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ ucfirst($order->delivery_method ?? 'pickup') }}
                                        </div>
                                        @if(($order->delivery_method ?? 'pickup') === 'delivery')
                                            <div class="text-xs text-gray-500 text-wrap max-w-xs">{{ $order->address }}</div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        ${{ number_format($order->total_amount, 2) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <select onchange="updateOrderStatus({{ $order->id }}, this.value)" class="text-xs border-gray-300 rounded-md focus:border-amber-500 focus:ring-amber-500 py-1 pl-2 pr-6">
                                            @foreach(['pending', 'confirmed', 'preparing', 'ready', 'completed', 'cancelled'] as $status)
                                                <option value="{{ $status }}" {{ $order->status == $status ? 'selected' : '' }}>
                                                    {{ ucfirst($status) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                         @php
                                            $paymentClasses = [
                                                'pending' => 'bg-yellow-100 text-yellow-800',
                                                'paid' => 'bg-green-100 text-green-800',
                                                'failed' => 'bg-red-100 text-red-800',
                                                'refunded' => 'bg-gray-100 text-gray-800',
                                            ];
                                             $class = $paymentClasses[$order->payment_status ?? 'pending'] ?? 'bg-gray-100 text-gray-800';
                                        @endphp
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $class }}">
                                            {{ ucfirst($order->payment_status ?? 'pending') }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $order->created_at->format('M j, Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this order?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">No orders found</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $orders->links() }}
            </div>
        </div>
    </div>

    <script>
        function updateOrderStatus(orderId, newStatus) {
            
            axios.patch(`/api/orders/${orderId}/status`, {
                status: newStatus
            }, {
                headers: {
                    'Authorization': 'Bearer {{ $apiToken }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                const data = response.data;
                // Success feedback
                const toast = document.createElement('div');
                toast.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded shadow-lg z-50';
                toast.innerText = data.message;
                document.body.appendChild(toast);
                setTimeout(() => toast.remove(), 3000);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Failed to update status. Please try again.');
                location.reload(); 
            });
        }
    </script>
</x-app-layout>
