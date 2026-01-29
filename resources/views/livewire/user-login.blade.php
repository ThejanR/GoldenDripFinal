
    {{-- OUTER CONTAINER: Gray background, centers the card --}}
    <div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
        
        {{-- CARD CONTAINER: White box, rounded corners, shadow --}}
        <div class="max-w-5xl w-full bg-white rounded-2xl shadow-xl overflow-hidden flex" style="min-height: 600px;">
            
            {{-- LEFT COLUMN: Image (Restricted width) --}}
            <div class="hidden lg:block w-1/2 bg-cover bg-center relative" 
                 style="background-image: url('{{ asset('images/cappuccino.png') }}');">
                 {{-- Dark Overlay for better contrast --}}
                 <div class="absolute inset-0 bg-black bg-opacity-10"></div>
            </div>
        
            {{-- RIGHT COLUMN: Login Form --}}
            <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 py-12 sm:px-12">
                
                {{-- Logo Area --}}
                <div class="flex flex-col items-center mb-6">
                    <img src="{{ asset('images/logo_bg.png') }}" 
                         alt="Golden Drip" 
                         class="h-20 w-auto mb-4 drop-shadow-md">
                    
                    <h2 class="text-2xl font-bold text-gray-900 tracking-tight">Welcome Back</h2>
                    <p class="text-gray-500 mt-1 text-sm">Please login to your account</p>
                </div>
    
                {{-- Toggle Switch --}}
                <div class="flex justify-center mb-6">
                    <div class="flex items-center bg-gray-100 rounded-full p-1 shadow-inner">
                        <span class="px-4 py-1 rounded-full bg-white shadow-sm text-sm font-bold text-gray-800">Customer</span>
                        
                        <a href="{{ route('admin.login') }}" class="px-4 py-1 text-sm font-medium text-gray-500 hover:text-amber-700 transition-colors">
                            Admin
                        </a>

                    </div>
                </div>
    
                {{-- Error Message --}}
                @if (session()->has('error'))
                    <div class="mb-4 bg-red-50 border-l-4 border-red-500 text-red-700 p-3 rounded shadow-sm text-sm text-center">
                        {{ session('error') }}
                    </div>
                @endif
    
                {{-- FORM --}}
                <form wire:submit.prevent="login" class="space-y-4">
                    
                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email address</label>
                        <input type="email" id="email" wire:model="email" 
                               class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-amber-500 transition shadow-sm placeholder-gray-400"
                               placeholder="user@test.com" required>
                        @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
    
                    {{-- Password --}}
                    <div>
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                        <input type="password" id="password" wire:model="password" 
                               class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-lg text-gray-900 focus:outline-none focus:ring-2 focus:ring-amber-500 transition shadow-sm placeholder-gray-400"
                               placeholder="••••••••" required>
                        @error('password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
    
                    {{-- Submit Button --}}
                    <button type="submit" 
                            class="w-full text-white font-bold py-3 px-4 rounded-lg shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition duration-200"
                            style="background-color: #893A17;">
                        Sign In
                    </button>
    
                </form>
    
                {{-- Footer Links --}}
                <div class="mt-6 text-center space-y-3">
                    <p class="text-xs text-gray-500">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="text-amber-700 hover:text-amber-900 font-bold">
                            Sign up
                        </a>
                    </p>
                    
                    {{-- Demo Credentials --}}
                    <div class="mt-4 p-3 bg-amber-50 rounded text-xs text-amber-800 border border-amber-100">
                        <strong>Demo User:</strong> user@test.com / password
                    </div>
                </div>
    
            </div>
        </div>
    </div>