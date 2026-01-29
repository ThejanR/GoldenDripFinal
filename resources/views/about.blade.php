<x-app-layout>
    
    {{-- About Header --}}
    <section class="bg-gradient-to-br from-amber-50 to-orange-100 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Our Story</h1>
            <p class="text-lg text-gray-600">Crafting the perfect cup since 2019</p>
        </div>
    </section>

    {{-- Story Section --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div class="space-y-6">
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900">The Golden Drip Journey</h2>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Founded in 2019, Golden Drip began as a small coffee cart with a big dream. What started as a passion project has grown into a beloved community gathering place.
                    </p>
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Our founder, Sarah Chen, discovered her love for coffee while traveling through Italy. The rich aromas and the community inspired her to bring that experience back home.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-amber-600">5</div>
                            <div class="text-gray-600 mt-2">Years of Excellence</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-amber-600">500+</div>
                            <div class="text-gray-600 mt-2">Happy Customers</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-amber-600">50+</div>
                            <div class="text-gray-600 mt-2">Coffee Varieties</div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-center">
                    <img src="https://images.unsplash.com/photo-1442512595331-e89e73853f31?auto=format&fit=crop&w=500&q=80" alt="Coffee Shop Interior" class="rounded-lg shadow-lg">
                </div>
            </div>
        </div>
    </section>

    {{-- Team Section --}}
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Meet Our Team</h2>
                <p class="text-lg text-gray-600">The passionate people behind every perfect cup</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($team as $member)
                <div class="text-center bg-white p-6 rounded-lg shadow-sm">
                    <div class="mb-6">
                        <img src="{{ $member['image'] }}" alt="{{ $member['name'] }}" class="w-32 h-32 rounded-full mx-auto object-cover shadow-lg">
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $member['name'] }}</h3>
                    <span class="text-amber-600 font-medium mb-3 block">{{ $member['role'] }}</span>
                    <p class="text-gray-600">{{ $member['description'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Timeline Section --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Our Journey</h2>
                <p class="text-lg text-gray-600">Key milestones in our coffee adventure</p>
            </div>
            <div class="space-y-8 max-w-3xl mx-auto">
                @foreach ($timeline as $item)
                <div class="flex items-start space-x-6">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-amber-500 rounded-full flex items-center justify-center shadow-lg">
                            <span class="text-white font-bold text-lg">{{ $item['year'] }}</span>
                        </div>
                    </div>
                    <div class="flex-1 pt-2">
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $item['title'] }}</h3>
                        <p class="text-gray-600">{{ $item['description'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Testimonials Section --}}
    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">What Our Customers Say</h2>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach ($testimonials as $testimonial)
                <div class="bg-white rounded-xl p-8 shadow-sm relative">
                    <div class="absolute top-4 left-6 text-6xl text-amber-200 opacity-50">"</div>
                    <div class="mb-6 relative z-10 pt-4">
                        <p class="text-gray-600 italic text-lg leading-relaxed">{{ $testimonial['content'] }}</p>
                    </div>
                    <div class="flex items-center mt-6 border-t pt-6 border-gray-100">
                        <img src="{{ $testimonial['image'] }}" alt="{{ $testimonial['author'] }}" class="w-12 h-12 rounded-full object-cover mr-4 ring-2 ring-amber-100">
                        <div>
                            <h4 class="font-bold text-gray-900">{{ $testimonial['author'] }}</h4>
                            <span class="text-amber-600 text-sm font-medium">{{ $testimonial['role'] }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

</x-app-layout>