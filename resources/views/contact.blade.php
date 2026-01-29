<x-app-layout>

    <section class="bg-gradient-to-br from-amber-50 to-orange-100 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Get in Touch</h1>
            <p class="text-lg text-gray-600">We'd love to hear from you. Visit us or reach out for any inquiries.</p>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-map-marker-alt text-amber-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Location</h3>
                    <p class="text-gray-600 mb-4">123 Coffee Street<br>Brew City, BC 12345</p>
                    <a href="https://maps.google.com" target="_blank" class="text-amber-600 hover:text-amber-700 font-medium">Get Directions</a>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-phone text-amber-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Phone</h3>
                    <p class="text-gray-600 mb-4">+94 76 410 3544</p>
                    <a href="tel:+94764103544" class="text-amber-600 hover:text-amber-700 font-medium">Call Now</a>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-envelope text-amber-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Email</h3>
                    <p class="text-gray-600 mb-4">hello@goldendrip.com</p>
                    <a href="mailto:hello@goldendrip.com" class="text-amber-600 hover:text-amber-700 font-medium">Send Email</a>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-clock text-amber-600 text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Hours</h3>
                    <p class="text-gray-600 mb-4">Mon-Fri: 7AM-8PM<br>Sat-Sun: 8AM-9PM</p>
                    <span class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">Open Now</span>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <div class="bg-white rounded-lg shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Send us a Message</h2>
                    <p class="text-gray-600 mb-6">Have a question or feedback? We'd love to hear from you!</p>
                    
                    <form class="contact-form space-y-6" id="contactForm" method="POST" action="{{ route('contact.submit') }}">
                        @csrf {{-- 👈 Crucial for Security --}}
                        
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                            <input type="text" id="name" name="name" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
                            <input type="email" id="email" name="email" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                        </div>
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input type="tel" id="phone" name="phone" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                        </div>
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject *</label>
                            <select id="subject" name="subject" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500">
                                <option value="">Select a subject</option>
                                <option value="general">General Inquiry</option>
                                <option value="feedback">Feedback</option>
                                <option value="reservation">Reservation</option>
                                <option value="catering">Catering</option>
                                <option value="partnership">Partnership</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message *</label>
                            <textarea id="message" name="message" rows="5" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500"></textarea>
                        </div>
                        <div class="flex items-center">
                            <input type="checkbox" id="newsletter" name="newsletter" class="h-4 w-4 text-amber-600 focus:ring-amber-500 border-gray-300 rounded">
                            <label for="newsletter" class="ml-2 block text-sm text-gray-700">
                                Subscribe to our newsletter for updates and special offers
                            </label>
                        </div>
                        <button type="submit" class="w-full text-white font-semibold py-3 px-6 rounded-md transition-colors hover:opacity-90" style="background-color: #893A17;">
                            Send Message
                        </button>
                    </form>
                </div>

                <div class="bg-white rounded-lg shadow-lg p-8 h-fit">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Find Us</h2>
                    <div class="bg-gray-100 rounded-lg p-8 text-center">
                        <i class="fas fa-map-marked-alt text-4xl text-gray-400 mb-4"></i>
                        <p class="text-gray-600 mb-4">Interactive Map Coming Soon</p>
                        <div class="space-y-2">
                            <h4 class="font-semibold text-gray-900">Golden Drip Coffee</h4>
                            <p class="text-gray-600">123 Coffee Street<br>Brew City, BC 12345</p>
                            <a href="https://maps.google.com" target="_blank" class="inline-flex items-center justify-center px-4 py-2 border rounded-md transition-colors hover:opacity-90" style="border-color: #893A17; color: #893A17;">
                                <i class="fas fa-directions mr-2"></i> Get Directions
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Frequently Asked Questions</h2>
                <p class="text-lg text-gray-600">Find answers to common questions about Golden Drip Coffee</p>
            </div>
            <div class="max-w-3xl mx-auto space-y-4" x-data="{ active: null }">
                <div class="bg-gray-50 rounded-lg">
                    <button @click="active = active === 1 ? null : 1" class="w-full text-left p-6 flex justify-between items-center hover:bg-gray-100 transition-colors">
                        <h3 class="text-lg font-semibold text-gray-900">Do you offer delivery services?</h3>
                        <i class="fas fa-chevron-down text-gray-500 transition-transform duration-200" :class="{'rotate-180': active === 1}"></i>
                    </button>
                    <div x-show="active === 1" x-collapse class="px-6 pb-6 text-gray-600">
                        Yes! We offer delivery through our partner platforms. You can also call us directly for large orders.
                    </div>
                </div>

                <div class="bg-gray-50 rounded-lg">
                    <button @click="active = active === 2 ? null : 2" class="w-full text-left p-6 flex justify-between items-center hover:bg-gray-100 transition-colors">
                        <h3 class="text-lg font-semibold text-gray-900">Can I make a reservation?</h3>
                        <i class="fas fa-chevron-down text-gray-500 transition-transform duration-200" :class="{'rotate-180': active === 2}"></i>
                    </button>
                    <div x-show="active === 2" x-collapse class="px-6 pb-6 text-gray-600">
                        Absolutely! We accept reservations for groups of 6 or more. Please call us at least 24 hours in advance.
                    </div>
                </div>

                <div class="bg-gray-50 rounded-lg">
                    <button @click="active = active === 3 ? null : 3" class="w-full text-left p-6 flex justify-between items-center hover:bg-gray-100 transition-colors">
                        <h3 class="text-lg font-semibold text-gray-900">Do you have vegetarian/vegan options?</h3>
                        <i class="fas fa-chevron-down text-gray-500 transition-transform duration-200" :class="{'rotate-180': active === 3}"></i>
                    </button>
                    <div x-show="active === 3" x-collapse class="px-6 pb-6 text-gray-600">
                        Yes, we offer a variety of vegetarian and vegan options, including plant-based milk alternatives and vegan pastries.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const contactForm = document.getElementById('contactForm');
            
            if(contactForm) {
                contactForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const formData = new FormData(this);
                    const submitBtn = this.querySelector('button[type="submit"]');
                    const originalText = submitBtn.textContent;
                    
                    submitBtn.textContent = 'Sending...';
                    submitBtn.disabled = true;
                    
                    fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            // CSRF Token is handled automatically by the FormData because we added @csrf
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            this.reset();
                        } else {
                            alert('Something went wrong. Please check your inputs.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred. Please try again.');
                    })
                    .finally(() => {
                        submitBtn.textContent = originalText;
                        submitBtn.disabled = false;
                    });
                });
            }
        });
    </script>

</x-app-layout>