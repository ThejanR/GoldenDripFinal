<div>
    {{-- Hero Section --}}
    <section class="bg-gradient-to-br from-amber-50 to-orange-100 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <h1 class="text-4xl md:text-6xl font-bold text-gray-900 leading-tight">
                        {{ $heroTitle }}
                    </h1>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        {{ $heroSubtitle }}
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        {{--  FIXED: Changed to <a href> so it links to your Menu --}}
                        <a href="/menu" class="inline-flex items-center justify-center px-8 py-3 border border-transparent text-base font-medium rounded-md text-white transition-colors hover:opacity-90 shadow-md" 
                                style="background-color: #893A17;">
                            Explore Menu
                        </a>
                        <button class="inline-flex items-center justify-center px-8 py-3 border text-base font-medium rounded-md bg-transparent hover:bg-amber-50 transition-colors" 
                                style="border-color: #893A17; color: #893A17;">
                            Our Story
                        </button>
                    </div>
                </div>
                
                {{-- Hero Icon/Image --}}
                <div class="flex justify-center">
                    <img src="{{ asset('images/bg homepage.png') }}" class="w-64 h-64 object-contain drop-shadow-lg transform hover:scale-105 transition duration-300" alt="Welcome Coffee">
                </div>
            </div>
            
            {{-- Stats --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-16 border-t border-amber-200 pt-12">
                @foreach ($stats as $stat)
                <div class="text-center">
                    <div class="text-4xl font-bold text-amber-600">{{ $stat['number'] }}</div>
                    <div class="text-gray-600 mt-2 font-medium">{{ $stat['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Featured Drinks --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Our Signature Drinks</h2>
                <p class="text-lg text-gray-600">Discover our handcrafted beverages made with the finest ingredients</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($featuredDrinks as $drink)
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                    <div class="relative">
                        {{-- Image --}}
                        <img src="{{ asset($drink['image']) }}" alt="{{ $drink['name'] }}" class="w-full h-64 object-cover">
                        
                        {{-- Badge --}}
                        @if (!empty($drink['badge']))
                        <div class="absolute top-4 right-4 bg-amber-500 text-white px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider shadow">
                            {{ $drink['badge'] }}
                        </div>
                        @endif
                    </div>
                    
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $drink['name'] }}</h3>
                        <p class="text-gray-500 mb-4 text-sm h-10">{{ $drink['description'] }}</p>
                        
                        <div class="flex items-center justify-between mt-4">
                           
                            <span class="text-2xl font-bold text-amber-700">${{ number_format($drink['price'], 2) }}</span>
                            
                            <div class="flex text-amber-400">
                                
                                @for ($i = 0; $i < 5; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                            </div>
                        </div>
                        {{-- Link to menu instead of empty button --}}
                        <a href="/menu" class="mt-4 block w-full bg-[#893A17] text-white py-2 rounded hover:bg-[#702e12] transition text-center">Order Now</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- About Section --}}
    <section class="py-20 bg-amber-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Our Story</h2>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Founded in 2019, Golden Drip began as a small coffee cart with a big dream. Today, we're proud to serve the finest artisanal coffee to our community, using carefully selected beans and traditional brewing methods.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 pt-4">
                        <div class="text-center p-4 bg-white rounded-lg shadow-sm">
                            <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-seedling text-amber-600"></i>
                            </div>
                            <h4 class="font-semibold text-gray-900">Premium Beans</h4>
                        </div>
                        <div class="text-center p-4 bg-white rounded-lg shadow-sm">
                            <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-clock text-amber-600"></i>
                            </div>
                            <h4 class="font-semibold text-gray-900">Fresh Daily</h4>
                        </div>
                        <div class="text-center p-4 bg-white rounded-lg shadow-sm">
                            <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-3">
                                <i class="fas fa-heart text-amber-600"></i>
                            </div>
                            <h4 class="font-semibold text-gray-900">Made with Love</h4>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center">
                    {{-- Standard fallback image --}}
                    <img src="{{ asset('images/cappuccino.png') }}" alt="Coffee Shop" class="rounded-2xl shadow-2xl transform rotate-2 hover:rotate-0 transition duration-500">
                </div>
            </div>
        </div>
    </section>

    {{-- Contact Section --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Get in Touch</h2>
                <p class="text-lg text-gray-600">Visit us or reach out for any inquiries</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center p-6 border border-gray-100 rounded-lg hover:shadow-md transition">
                    <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-map-marker-alt text-amber-600"></i>
                    </div>
                    <h4 class="font-semibold text-gray-900 mb-2">Location</h4>
                    <p class="text-gray-600 text-sm">{{ $siteInfo['address'] }}</p>
                </div>
                <div class="text-center p-6 border border-gray-100 rounded-lg hover:shadow-md transition">
                    <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-phone text-amber-600"></i>
                    </div>
                    <h4 class="font-semibold text-gray-900 mb-2">Phone</h4>
                    <p class="text-gray-600 text-sm">{{ $siteInfo['phone'] }}</p>
                </div>
                <div class="text-center p-6 border border-gray-100 rounded-lg hover:shadow-md transition">
                    <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-envelope text-amber-600"></i>
                    </div>
                    <h4 class="font-semibold text-gray-900 mb-2">Email</h4>
                    <p class="text-gray-600 text-sm">{{ $siteInfo['email'] }}</p>
                </div>
                <div class="text-center p-6 border border-gray-100 rounded-lg hover:shadow-md transition">
                    <div class="w-12 h-12 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-clock text-amber-600"></i>
                    </div>
                    <h4 class="font-semibold text-gray-900 mb-2">Hours</h4>
                    <p class="text-gray-600 text-sm">{{ $siteInfo['hours'] }}</p>
                </div>
            </div>
        </div>
    </section>
</div>