<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Orders') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                
                <div class="mb-6 border-b border-gray-200 pb-4">
                    <h3 class="text-2xl font-serif font-bold text-gray-900">Order History</h3>
                    <p class="text-gray-500 text-sm mt-1">Track your past purchases and current order status.</p>
                </div>

                @if($orders->isEmpty())
                    <div class="text-center py-12 bg-gray-50 rounded-lg border-2 border-dashed border-gray-200">
                        <i class="fas fa-shopping-basket text-4xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500 text-lg">You haven't placed any orders yet.</p>
                        <a href="{{ route('menu') }}" class="mt-4 inline-block px-6 py-2 bg-amber-600 text-white font-medium rounded-full hover:bg-amber-700 transition">
                            Start Shopping
                        </a>
                    </div>
                @else
                    <div class="space-y-6">
                        @foreach($orders as $order)
                            <div x-data="{ open: false }" class="border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                                {{-- Order Header --}}
                                <div class="bg-gray-50 px-6 py-4 flex items-center justify-between cursor-pointer" @click="open = !open">
                                    <div class="space-y-1">
                                        <div class="flex items-center gap-3">
                                            <span class="font-bold text-gray-900">#{{ $order->id }}</span>
                                            <span class="text-xs font-mono text-gray-500">{{ $order->created_at->format('M d, Y h:i A') }}</span>
                                        </div>
                                        <div class="text-sm font-medium text-gray-600">
                                            Total: <span class="text-amber-700 font-bold">${{ number_format($order->total_amount, 2) }}</span>
                                        </div>
                                    </div>

                                    <div class="flex items-center gap-4">
                                        {{-- Status Badge --}}
                                        <span class="px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-full 
                                            {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : 
                                              ($order->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                            {{ $order->status }}
                                        </span>
                                        <i class="fas fa-chevron-down text-gray-400 transform transition-transform" :class="{'rotate-180': open}"></i>
                                    </div>
                                </div>

                                {{-- Order Items (Collapsible) --}}
                                <div x-show="open" 
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 -translate-y-2"
                                     x-transition:enter-end="opacity-100 translate-y-0"
                                     class="px-6 py-4 bg-white border-t border-gray-100">
                                    
                                    <h4 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-3">Order Details</h4>
                                    
                                    <ul class="divide-y divide-gray-100">
                                        @foreach($order->items as $item)
                                            <li class="py-3 flex justify-between items-center text-sm">
                                                <div class="flex items-center gap-3">
                                                    {{-- <img src="..." class="w-10 h-10 object-cover rounded" /> (Optional if you have images) --}}
                                                    <div>
                                                        <span class="font-medium text-gray-800">{{ $item->product_name }}</span>
                                                        <div class="text-gray-500 text-xs">Qty: {{ $item->quantity }}</div>
                                                    </div>
                                                </div>
                                                <span class="font-medium text-gray-900">${{ number_format($item->price * $item->quantity, 2) }}</span>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <div class="mt-4 pt-4 border-t border-gray-100 flex justify-between items-center text-sm">
                                        <span class="text-gray-600">Method: {{ ucfirst($order->payment_method) }}</span>
                                        {{-- Optional Action Buttons (reorder, invoice, etc) --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
