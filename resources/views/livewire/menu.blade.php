<div x-data="coffeeShop()">
    
    {{-- HEADER SECTION --}}
    <section class="bg-gradient-to-br from-amber-50 to-orange-100 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Our Menu</h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Discover our handcrafted beverages and delicious treats.</p>
        </div>
    </section>

    {{-- FILTERS & SEARCH --}}
    <section class="py-8 bg-white border-b border-gray-200 sticky top-16 z-30 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-6 items-center justify-between">
                
                {{-- Search Box --}}
                <div class="relative w-full lg:w-96">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input wire:model.live="search" type="text" placeholder="Search for your favorite drink..." 
                           class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-1 focus:ring-amber-500 focus:border-amber-500">
                </div>
                
                {{-- Category Buttons --}}
                <div class="flex flex-wrap gap-2 justify-center">
                    <button wire:click="filter('all')"
                            class="px-4 py-2 rounded-full text-sm font-medium transition-colors 
                            {{ $activeCategory === 'all' ? 'bg-amber-800 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                        All Items
                    </button>

                    @foreach($categories as $category)
                        {{-- UPDATED: Now passes $category->id instead of slug --}}
                        <button wire:click="filter({{ $category->id }})"
                                class="px-4 py-2 rounded-full text-sm font-medium transition-colors 
                                {{ $activeCategory == $category->id ? 'bg-amber-800 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }}">
                            {{ $category->name }}
                        </button>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- MENU GRID --}}
    <section class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                
                @foreach($menuItems as $item)
                <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 flex flex-col h-full">
                    <div class="relative h-48 overflow-hidden group">
                        <img src="{{ asset($item['image']) }}" 
                             alt="{{ $item['name'] }}" 
                             onerror="this.onerror=null; this.src='https://placehold.co/600x400?text=No+Image';"
                             class="w-full h-full object-cover transition duration-500 group-hover:scale-110">
                        @if(!empty($item['badge']))
                            <div class="absolute top-3 right-3 bg-amber-500 text-white px-2 py-1 rounded-full text-xs font-semibold shadow">
                                {{ $item['badge'] }}
                            </div>
                        @endif
                    </div>

                    <div class="p-4 flex flex-col flex-grow">
                        <h3 class="text-lg font-bold text-gray-900 mb-1">{{ $item['name'] }}</h3>
                        <p class="text-gray-500 text-sm mb-4 flex-grow">{{ $item['description'] }}</p>
                        
                        <div class="flex items-center justify-between mt-auto">
                            <span class="text-xl font-bold text-amber-700">${{ number_format($item['price'], 2) }}</span>
                            <button @click="addToCart({{ json_encode($item) }})" 
                                    class="text-white px-4 py-2 rounded-full text-sm font-bold transition-transform active:scale-95 hover:bg-amber-900 shadow-md flex items-center gap-2" 
                                    style="background-color: #893A17;">
                                <i class="fas fa-plus"></i> Add
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            @if(count($menuItems) === 0)
            <div class="text-center py-12">
                <i class="fas fa-mug-hot text-gray-300 text-6xl mb-4"></i>
                <p class="text-gray-500 text-lg">No items match your search.</p>
            </div>
            @endif
        </div>
    </section>

    {{-- SHOPPING CART SIDEBAR --}}
    <div class="fixed inset-0 overflow-hidden z-50 pointer-events-none">
        <div class="absolute inset-0 overflow-hidden">
            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                <div x-show="cartOpen" 
                     x-transition:enter="transform transition ease-in-out duration-300 sm:duration-500"
                     x-transition:enter-start="translate-x-full"
                     x-transition:enter-end="translate-x-0"
                     x-transition:leave="transform transition ease-in-out duration-300 sm:duration-500"
                     x-transition:leave-start="translate-x-0"
                     x-transition:leave-end="translate-x-full"
                     class="pointer-events-auto w-screen max-w-md bg-white shadow-xl flex flex-col h-full">
                     
                    <div class="flex items-start justify-between px-4 py-6 border-b border-gray-200">
                        <h2 class="text-lg font-medium text-gray-900">Your Order</h2>
                        <button @click="cartOpen = false" class="text-gray-400 hover:text-gray-500">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>

                    <div class="flex-1 overflow-y-auto px-4 py-6">
                        <ul role="list" class="-my-6 divide-y divide-gray-200">
                            <template x-for="item in cart" :key="item.id">
                                <li class="flex py-6">
                                    <div class="h-16 w-16 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                                        <img :src="'{{ asset('') }}' + item.image" class="h-full w-full object-cover">
                                    </div>
                                    <div class="ml-4 flex flex-1 flex-col">
                                        <div class="flex justify-between text-base font-medium text-gray-900">
                                            <h3 x-text="item.name"></h3>
                                            <p x-text="'$' + (item.price * item.quantity).toFixed(2)"></p>
                                        </div>
                                        <div class="flex flex-1 items-end justify-between text-sm">
                                            <div class="flex items-center border border-gray-300 rounded">
                                                <button @click="updateQty(item.id, -1)" class="px-2 py-1 hover:bg-gray-100">-</button>
                                                <span class="px-2 font-medium" x-text="item.quantity"></span>
                                                <button @click="updateQty(item.id, 1)" class="px-2 py-1 hover:bg-gray-100">+</button>
                                            </div>
                                            <button @click="removeFromCart(item.id)" type="button" class="font-medium text-red-600 hover:text-red-500">Remove</button>
                                        </div>
                                    </div>
                                </li>
                            </template>
                        </ul>
                    </div>

                    <div class="border-t border-gray-200 px-4 py-6">
                        <div class="flex justify-between text-base font-medium text-gray-900">
                            <p>Total</p>
                            <p x-text="'$' + cartTotal.toFixed(2)"></p>
                        </div>
                        <div class="mt-6">
                            <a href="{{ route('checkout') }}" 
                               class="flex w-full items-center justify-center rounded-md px-6 py-3 text-base font-medium text-white shadow-sm"
                               style="background-color: #893A17;">
                                Checkout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- FLOATING CART BUTTON --}}
    <button @click="cartOpen = !cartOpen" 
            class="fixed bottom-6 right-6 z-40 p-4 rounded-full shadow-lg text-white"
            style="background-color: #893A17;">
        <i class="fas fa-shopping-cart text-xl"></i>
        <span x-show="cartCount > 0" x-text="cartCount" class="absolute -top-2 -right-2 bg-red-600 text-white text-xs font-bold rounded-full h-6 w-6 flex items-center justify-center border-2 border-white"></span>
    </button>

    {{-- ALPINE.JS LOGIC --}}
    <script>
        function coffeeShop() {
            return {
                cartOpen: false,
                // UPDATED: Consistently use 'cart' key to match Checkout page
                cart: JSON.parse(localStorage.getItem('cart')) || [],
                
                get cartCount() {
                    return this.cart.reduce((sum, item) => sum + item.quantity, 0);
                },

                get cartTotal() {
                    return this.cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
                },

                addToCart(item) {
                    const existing = this.cart.find(i => i.id === item.id);
                    if (existing) {
                        existing.quantity++;
                    } else {
                        this.cart.push({...item, quantity: 1});
                    }
                    this.saveCart();
                    this.cartOpen = true; 
                },

                updateQty(id, change) {
                    const item = this.cart.find(i => i.id === id);
                    if (item) {
                        item.quantity += change;
                        if (item.quantity <= 0) this.removeFromCart(id);
                    }
                    this.saveCart();
                },

                removeFromCart(id) {
                    this.cart = this.cart.filter(item => item.id !== id);
                    this.saveCart();
                },

                saveCart() {
                    localStorage.setItem('cart', JSON.stringify(this.cart));
                }
            }
        }
    </script>
</div>