<nav x-data="{ open: false }" class="bg-white text-gray-800 sticky top-0 z-50 shadow-sm border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-24">
            
            {{-- LOGO --}}
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="flex items-center">
                    {{-- Make sure this image exists, otherwise it might look empty --}}
                    <img src="{{ asset('images/logo_bg.png') }}" alt="Golden Drip Logo" class="h-20 w-auto object-contain">
                </a>
            </div>

            {{-- DESKTOP MENU --}}
            <div class="hidden md:flex md:items-center md:space-x-6">
                <a href="{{ route('dashboard') }}" 
                   class="transition-colors hover:text-amber-600 {{ request()->routeIs('dashboard') ? 'text-amber-600 font-bold' : '' }}">
                   Home
                </a>
                
                <a href="{{ route('menu') }}" 
                   class="transition-colors hover:text-amber-600 {{ request()->routeIs('menu') ? 'text-amber-600 font-bold' : '' }}">
                   Menu
                </a>

                <a href="{{ route('about') }}" 
                   class="transition-colors hover:text-amber-600 {{ request()->routeIs('about') ? 'text-amber-600 font-bold' : '' }}">
                   About
                </a>

                {{-- 👇 FIXED CONTACT LINK --}}
                <a href="{{ route('contact') }}" 
                   class="transition-colors hover:text-amber-600 {{ request()->routeIs('contact') ? 'text-amber-600 font-bold' : '' }}">
                   Contact
                </a>
            </div>

            {{-- DESKTOP AUTH BUTTONS --}}
            <div class="hidden md:flex items-center space-x-4">
                @auth
                    <div class="flex items-center space-x-3">
                        <span class="text-sm text-gray-600">
                            Welcome, {{ Auth::user()->name }}
                        </span>
                        
                        {{-- ADMIN DASHBOARD BUTTON --}}
                        @if(Auth::user()->email === 'admin@gmail.com') 
                            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-purple-500 to-purple-600 text-white text-sm font-semibold rounded-lg hover:from-purple-600 hover:to-purple-700 transition-all duration-200">
                                <i class="fas fa-cog mr-1"></i>Admin
                            </a>
                        @endif

                        {{-- PROFILE BUTTON --}}
                        <a href="{{ route('profile.show') }}" class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-gray-500 to-gray-600 text-white text-sm font-semibold rounded-lg hover:from-gray-600 hover:to-gray-700 transition-all duration-200">
                            <i class="fas fa-user mr-1"></i>Profile
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="inline-flex items-center px-3 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white text-sm font-semibold rounded-lg hover:from-red-600 hover:to-red-700 transition-all duration-200">
                                <i class="fas fa-sign-out-alt mr-1"></i>Logout
                            </button>
                        </form>
                    </div>
                @else
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('login') }}" class="text-gray-600 hover:text-amber-600 transition-colors">Login</a>
                        <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-amber-500 to-orange-500 text-white text-sm font-semibold rounded-lg hover:from-amber-600 hover:to-orange-600 transition-all duration-200">
                            Sign Up
                        </a>
                    </div>
                @endauth

                <a href="{{ route('menu') }}" class="inline-flex items-center rounded-md px-4 py-2 text-sm font-semibold text-white hover:opacity-90 transition-colors" style="background-color: #893A17;">
                    Order Now
                </a>
            </div>

            {{-- MOBILE HAMBURGER BUTTON --}}
            <div class="-mr-2 flex md:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-amber-500">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- MOBILE MENU --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden bg-white border-t border-gray-200">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <a href="{{ route('dashboard') }}" class="block px-3 py-2 rounded hover:bg-gray-100">Home</a>
            <a href="{{ route('menu') }}" class="block px-3 py-2 rounded hover:bg-gray-100">Menu</a>
            <a href="{{ route('about') }}" class="block px-3 py-2 rounded hover:bg-gray-100">About</a>
            
            {{-- 👇 FIXED MOBILE CONTACT LINK --}}
            <a href="{{ route('contact') }}" class="block px-3 py-2 rounded hover:bg-gray-100">Contact</a>
        </div>

        <div class="pt-4 pb-4 border-t border-gray-200 px-4">
            @auth
                <div class="mb-3 text-sm text-gray-600">Welcome, {{ Auth::user()->name }}</div>
                
                <a href="{{ route('profile.show') }}" class="block px-3 py-2 rounded hover:bg-gray-100 text-gray-800">
                    <i class="fas fa-user mr-2"></i>Profile
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left block px-3 py-2 rounded hover:bg-gray-100 text-red-600">
                        <i class="fas fa-sign-out-alt mr-2"></i>Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="block px-3 py-2 rounded hover:bg-gray-100">Login</a>
                <a href="{{ route('register') }}" class="block px-3 py-2 rounded hover:bg-gray-100">Sign Up</a>
            @endauth
        </div>
    </div>
</nav>