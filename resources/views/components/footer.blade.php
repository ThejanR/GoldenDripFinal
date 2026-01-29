<footer class="bg-gray-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            {{-- BRAND SECTION --}}
            <div class="space-y-4">
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}">
                        {{-- Make sure "Logo gold color.png" is in your public/images folder --}}
                        {{-- If you don't have it, switch this to 'images/logo_bg.png' --}}
                        <img src="{{ asset('images/Logo gold color.png') }}" 
                             alt="Golden Drip Logo" 
                             class="h-16 w-auto object-contain"
                             onerror="this.src='{{ asset('images/logo_bg.png') }}'"> 
                    </a>
                </div>
                <p class="text-gray-300">Crafting the perfect cup since 2019</p>
            </div>

            {{-- QUICK LINKS --}}
            <div class="space-y-4">
                <h4 class="text-lg font-semibold">Quick Links</h4>
                <ul class="space-y-2">
                    {{-- Updated to use Laravel Routes --}}
                    <li><a href="{{ route('dashboard') }}" class="text-gray-300 hover:text-amber-400 transition-colors">Home</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-amber-400 transition-colors">Menu</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-amber-400 transition-colors">About</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-amber-400 transition-colors">Contact</a></li>
                </ul>
            </div>

            {{-- SOCIAL MEDIA --}}
            <div class="space-y-4">
                <h4 class="text-lg font-semibold">Connect</h4>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-300 hover:text-amber-400 transition-colors"><i class="fab fa-instagram text-xl"></i></a>
                    <a href="#" class="text-gray-300 hover:text-amber-400 transition-colors"><i class="fab fa-facebook text-xl"></i></a>
                    <a href="#" class="text-gray-300 hover:text-amber-400 transition-colors"><i class="fab fa-twitter text-xl"></i></a>
                    <a href="#" class="text-gray-300 hover:text-amber-400 transition-colors"><i class="fab fa-tiktok text-xl"></i></a>
                </div>
            </div>
        </div>

        {{-- COPYRIGHT --}}
        <div class="border-t border-gray-700 mt-8 pt-8 text-center">
            <p class="text-gray-300">&copy; {{ date('Y') }} Golden Drip Coffee. All rights reserved.</p>
        </div>
    </div>
</footer>