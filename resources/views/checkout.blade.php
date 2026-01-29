<x-app-layout>

    <section class="bg-gradient-to-br from-amber-50 to-orange-100 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Complete Your Order</h1>
            <p class="text-lg text-gray-600">Secure payment gateway for your Golden Drip experience</p>
        </div>
    </section>

    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                
                <div class="bg-white rounded-lg shadow-lg p-8 h-fit">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Order Summary</h3>
                    
                    <div class="order-items space-y-4 mb-6" id="orderItems">
                        <p class="text-gray-500 text-center py-4">Loading cart...</p>
                    </div>

                    <div class="order-total space-y-2 border-t pt-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Subtotal:</span>
                            <span id="subtotal" class="font-medium">$0.00</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tax (8.5%):</span>
                            <span id="tax" class="font-medium">$0.00</span>
                        </div>
                        <div class="flex justify-between text-lg font-bold border-t border-gray-200 pt-2 mt-2">
                            <span>Total:</span>
                            <span id="total" class="text-amber-600">$0.00</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Payment Information</h3>
                    
                    <form id="paymentForm" class="space-y-6">
                        @csrf {{-- 👈 Crucial for Laravel Security --}}
                        
                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Personal Information</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="firstName" class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                                    <input type="text" id="firstName" name="firstName" value="{{ Auth::user()->name }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                                </div>
                                <div>
                                    <label for="lastName" class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                                    <input type="text" id="lastName" name="lastName" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                                </div>
                            </div>
                            <div class="mt-4">
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                                <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                            </div>
                            <div class="mt-4">
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                                <input type="tel" id="phone" name="phone" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                            </div>
                        </div>

                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Delivery Information</h4>
                            <div class="space-y-4">
                                <div>
                                    <label for="address" class="block text-sm font-medium text-gray-700 mb-2">Street Address</label>
                                    <input type="text" id="address" name="address" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                                </div>
                                <div>
                                    <label for="city" class="block text-sm font-medium text-gray-700 mb-2">City</label>
                                    <input type="text" id="city" name="city" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="zipCode" class="block text-sm font-medium text-gray-700 mb-2">ZIP Code</label>
                                        <input type="text" id="zipCode" name="zipCode" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                                    </div>
                                    <div>
                                        <label for="deliveryTime" class="block text-sm font-medium text-gray-700 mb-2">Preferred Delivery Time</label>
                                        <select id="deliveryTime" name="deliveryTime" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                                            <option value="">Select time</option>
                                            <option value="asap">As soon as possible</option>
                                            <option value="30min">30 minutes</option>
                                            <option value="1hour">1 hour</option>
                                            <option value="2hours">2 hours</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-lg font-semibold text-gray-900 mb-4">Payment Method</h4>
                            <div class="space-y-3">
                                <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="paymentMethod" value="card" checked class="h-4 w-4 text-amber-600 focus:ring-amber-500 border-gray-300">
                                    <div class="ml-3 flex items-center">
                                        <i class="fas fa-credit-card text-gray-400 mr-2"></i>
                                        <span class="text-gray-700">Credit/Debit Card</span>
                                    </div>
                                </label>
                                <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="paymentMethod" value="paypal" class="h-4 w-4 text-amber-600 focus:ring-amber-500 border-gray-300">
                                    <div class="ml-3 flex items-center">
                                        <i class="fab fa-paypal text-gray-400 mr-2"></i>
                                        <span class="text-gray-700">PayPal</span>
                                    </div>
                                </label>
                                <label class="flex items-center p-4 border border-gray-300 rounded-lg cursor-pointer hover:bg-gray-50">
                                    <input type="radio" name="paymentMethod" value="cash" class="h-4 w-4 text-amber-600 focus:ring-amber-500 border-gray-300">
                                    <div class="ml-3 flex items-center">
                                        <i class="fas fa-money-bill-wave text-gray-400 mr-2"></i>
                                        <span class="text-gray-700">Cash on Delivery</span>
                                    </div>
                                </label>
                            </div>

                            <div id="cardInfo" class="card-info mt-6 space-y-4">
                                <div>
                                    <label for="cardNumber" class="block text-sm font-medium text-gray-700 mb-2">Card Number</label>
                                    <input type="text" id="cardNumber" name="cardNumber" placeholder="1234 5678 9012 3456" maxlength="19" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                                </div>
                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="expiryDate" class="block text-sm font-medium text-gray-700 mb-2">Expiry Date</label>
                                        <input type="text" id="expiryDate" name="expiryDate" placeholder="MM/YY" maxlength="5" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                                    </div>
                                    <div>
                                        <label for="cvv" class="block text-sm font-medium text-gray-700 mb-2">CVV</label>
                                        <input type="text" id="cvv" name="cvv" placeholder="123" maxlength="4" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <button type="submit" class="w-full text-white font-semibold py-4 px-6 rounded-md transition-colors flex items-center justify-center hover:opacity-90" style="background-color: #893A17;">
                                <i class="fas fa-lock mr-2"></i>
                                Pay Now
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const paymentForm = document.getElementById('paymentForm');
            const paymentMethods = document.querySelectorAll('input[name="paymentMethod"]');
            const cardInfo = document.getElementById('cardInfo');
            const orderItems = document.getElementById('orderItems');
            const subtotal = document.getElementById('subtotal');
            const tax = document.getElementById('tax');
            const total = document.getElementById('total');

            // 1. Load Cart Data from LocalStorage
            function loadCartData() {
                const cart = JSON.parse(localStorage.getItem('cart') || '[]');
                
                if (cart.length === 0) {
                    // Redirect to menu if cart is empty
                    window.location.href = "{{ route('menu') }}";
                    return;
                }

                let subtotalAmount = 0;
                orderItems.innerHTML = '';

                cart.forEach(item => {
                    const itemTotal = item.price * item.quantity;
                    subtotalAmount += itemTotal;
                    
                    const cartItem = document.createElement('div');
                    cartItem.className = 'flex justify-between items-center py-2 border-b border-gray-200';
                    cartItem.innerHTML = `
                        <div>
                            <h4 class="font-medium text-gray-900">${item.name}</h4>
                            <p class="text-sm text-gray-600">$${item.price.toFixed(2)} x ${item.quantity}</p>
                        </div>
                        <span class="font-semibold text-amber-600">$${itemTotal.toFixed(2)}</span>
                    `;
                    orderItems.appendChild(cartItem);
                });

                const taxAmount = subtotalAmount * 0.085; // 8.5% tax
                const totalAmount = subtotalAmount + taxAmount;

                subtotal.textContent = `$${subtotalAmount.toFixed(2)}`;
                tax.textContent = `$${taxAmount.toFixed(2)}`;
                total.textContent = `$${totalAmount.toFixed(2)}`;
            }

            // 2. Toggle Card Info based on Payment Method
            paymentMethods.forEach(method => {
                method.addEventListener('change', function() {
                    if (this.value === 'card') {
                        cardInfo.style.display = 'block';
                    } else {
                        cardInfo.style.display = 'none';
                    }
                });
            });

            // 3. Handle Form Submission
            paymentForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const submitBtn = this.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Processing...';
                submitBtn.disabled = true;
                
                // Get form data and Cart
                const formData = new FormData(paymentForm);
                const cart = JSON.parse(localStorage.getItem('cart') || '[]');
                
                // Append Cart Items to the form data
                formData.append('cartItems', JSON.stringify(cart));
                
                // Send to Laravel Controller
                fetch("{{ route('checkout.store') }}", {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                        // We rely on @csrf token included in the form
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Clear cart
                        localStorage.removeItem('cart');
                        alert('Order confirmed! Your coffee will be ready soon.');
                        // Redirect Home
                        window.location.href = "{{ route('dashboard') }}";
                    } else {
                        alert('Error processing order. Please try again.');
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Something went wrong. Please check your inputs.');
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                });
            });

            // Initialize Page
            loadCartData();
        });
    </script>

</x-app-layout>