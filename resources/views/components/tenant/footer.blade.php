@props([
    'theme' => 'art', // default theme
    'variant' => 'default' // default, minimal, extended
])

@php
    $themes = [
        'art' => [
            'primary' => 'from-amber-600 to-orange-600',
            'secondary' => 'from-amber-500 to-orange-500',
            'accent' => 'text-amber-600',
            'bg' => 'from-amber-50 to-orange-50',
            'text' => 'text-amber-800',
            'border' => 'border-amber-200'
        ],
        'nature' => [
            'primary' => 'from-green-600 to-emerald-600',
            'secondary' => 'from-green-500 to-emerald-500',
            'accent' => 'text-green-600',
            'bg' => 'from-green-50 to-emerald-50',
            'text' => 'text-green-800',
            'border' => 'border-green-200'
        ],
        'modern' => [
            'primary' => 'from-blue-600 to-indigo-600',
            'secondary' => 'from-blue-500 to-indigo-500',
            'accent' => 'text-blue-600',
            'bg' => 'from-blue-50 to-indigo-50',
            'text' => 'text-blue-800',
            'border' => 'border-blue-200'
        ]
    ];
    
    $currentTheme = $themes[$theme] ?? $themes['art'];
@endphp

<footer class="bg-gradient-to-br {{ $currentTheme['bg'] }} relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 bg-traditional-pattern opacity-5"></div>
    
    @if($variant !== 'minimal')
    <!-- Main Footer Content -->
    <div class="relative z-10 py-16 lg:py-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
                
                <!-- Brand & Description -->
                <div class="lg:col-span-2">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-12 h-12 bg-gradient-to-r {{ $currentTheme['primary'] }} rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-7 h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                            </svg>
                        </div>
                        <div>
                            <div class="text-2xl font-bold {{ $currentTheme['text'] }}">
                                {{ config('app.name', 'Desa Wisata') }}
                            </div>
                            <div class="text-sm text-gray-600">
                                Portal Budaya & Wisata
                            </div>
                        </div>
                    </div>
                    
                    <p class="text-gray-700 mb-6 leading-relaxed max-w-lg">
                        Jelajahi keindahan budaya dan wisata lokal yang memukau. Temukan pengalaman tak terlupakan 
                        bersama produk-produk unggulan, destinasi wisata menawan, dan keramahan masyarakat lokal.
                    </p>
                    
                    <!-- Newsletter Signup -->
                    <div class="bg-white rounded-2xl p-6 shadow-lg border {{ $currentTheme['border'] }}">
                        <h4 class="font-bold {{ $currentTheme['text'] }} mb-3">
                            📧 Dapatkan Update Terbaru
                        </h4>
                        <div class="flex gap-3">
                            <input type="email" placeholder="Email Anda..." 
                                   class="flex-1 px-4 py-3 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-{{ str_replace(['from-', 'to-'], '', $currentTheme['primary']) }} focus:border-transparent">
                            <button class="px-6 py-3 bg-gradient-to-r {{ $currentTheme['primary'] }} text-white font-medium rounded-lg hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                                Subscribe
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-bold {{ $currentTheme['text'] }} mb-6">
                        🔗 Tautan Cepat
                    </h3>
                    <ul class="space-y-3">
                        <li>
                            <a href="/" class="footer-link">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                Beranda
                            </a>
                        </li>
                        <li>
                            <a href="/products" class="footer-link">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                                Produk Budaya
                            </a>
                        </li>
                        <li>
                            <a href="/wisata" class="footer-link">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                                Destinasi Wisata
                            </a>
                        </li>
                        <li>
                            <a href="/homestay" class="footer-link">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v4H8V5z"></path>
                                </svg>
                                Homestay
                            </a>
                        </li>
                        <li>
                            <a href="/events" class="footer-link">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Acara & Festival
                            </a>
                        </li>
                        <li>
                            <a href="/guides" class="footer-link">
                                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Pemandu Wisata
                            </a>
                        </li>
                    </ul>
                </div>
                
                <!-- Contact & Social -->
                <div>
                    <h3 class="text-lg font-bold {{ $currentTheme['text'] }} mb-6">
                        📞 Hubungi Kami
                    </h3>
                    
                    <!-- Contact Info -->
                    <div class="space-y-4 mb-6">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 {{ $currentTheme['accent'] }} mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <div class="text-sm text-gray-700">
                                <div class="font-medium">Alamat:</div>
                                <div>Jl. Desa Wisata No. 123<br>Kabupaten Budaya, Indonesia</div>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <svg class="w-5 h-5 {{ $currentTheme['accent'] }} mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <div class="text-sm text-gray-700">
                                <div class="font-medium">+62 123 456 789</div>
                            </div>
                        </div>
                        
                        <div class="flex items-center">
                            <svg class="w-5 h-5 {{ $currentTheme['accent'] }} mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                            <div class="text-sm text-gray-700">
                                <div class="font-medium">info@desawisata.com</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Social Media -->
                    <div>
                        <h4 class="font-medium {{ $currentTheme['text'] }} mb-3">
                            🌐 Ikuti Kami
                        </h4>
                        <div class="flex space-x-3">
                            <a href="#" class="social-link">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                            </a>
                            <a href="#" class="social-link">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                                </svg>
                            </a>
                            <a href="#" class="social-link">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.097.118.112.222.083.343-.09.377-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.749-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001.012.001z"/>
                                </svg>
                            </a>
                            <a href="#" class="social-link">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12.0048 0C5.3776 0 0.00482178 5.37278 0.00482178 12C0.00482178 17.9895 4.38782 22.954 10.1248 23.8542V15.4688H7.07782V12H10.1248V9.35625C10.1248 6.34875 11.9118 4.6875 14.6588 4.6875C15.9718 4.6875 17.3438 4.92188 17.3438 4.92188V7.875H15.8308C14.3408 7.875 13.8848 8.80008 13.8848 9.75V12H17.2028L16.6718 15.4688H13.8848V23.8542C19.6218 22.954 24.0048 17.9895 24.0048 12C24.0048 5.37278 18.6318 0 12.0048 0Z"/>
                                </svg>
                            </a>
                            <a href="#" class="social-link">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    
    <!-- Bottom Footer -->
    <div class="relative z-10 bg-white/50 backdrop-blur-sm border-t {{ $currentTheme['border'] }} py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="text-sm text-gray-600 mb-4 md:mb-0">
                    <span>&copy; {{ date('Y') }} {{ config('app.name', 'Desa Wisata') }}. </span>
                    <span>Dibuat dengan ❤️ untuk melestarikan budaya Indonesia.</span>
                </div>
                
                <div class="flex items-center space-x-6 text-sm text-gray-600">
                    <a href="/privacy" class="hover:{{ str_replace('text-', '', $currentTheme['accent']) }} transition-colors duration-200">
                        Kebijakan Privasi
                    </a>
                    <a href="/terms" class="hover:{{ str_replace('text-', '', $currentTheme['accent']) }} transition-colors duration-200">
                        Syarat & Ketentuan
                    </a>
                    <a href="/sitemap" class="hover:{{ str_replace('text-', '', $currentTheme['accent']) }} transition-colors duration-200">
                        Sitemap
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Back to Top Button -->
    <button id="back-to-top" class="fixed bottom-6 right-6 w-12 h-12 bg-gradient-to-r {{ $currentTheme['primary'] }} text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:scale-110 opacity-0 invisible z-50">
        <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
    </button>
</footer>

<style>
    /* Footer Styles */
    .footer-link {
        @apply flex items-center text-gray-700 hover:text-gray-900 hover:{{ str_replace('text-', '', $currentTheme['accent']) }} transition-colors duration-200 py-1;
    }
    
    .social-link {
        @apply w-10 h-10 bg-white rounded-full flex items-center justify-center text-gray-600 hover:text-white hover:bg-gradient-to-r {{ $currentTheme['primary'] }} transition-all duration-300 transform hover:scale-110 shadow-md hover:shadow-lg;
    }
    
    /* Traditional Pattern Background */
    .bg-traditional-pattern {
        background-image: 
            radial-gradient(circle at 25% 25%, #f59e0b 2px, transparent 2px),
            radial-gradient(circle at 75% 75%, #ea580c 2px, transparent 2px);
        background-size: 50px 50px;
    }
    
    /* Back to top button animation */
    #back-to-top.show {
        @apply opacity-100 visible;
    }
</style>

<script>
    // Back to top functionality
    document.addEventListener('DOMContentLoaded', function() {
        const backToTopButton = document.getElementById('back-to-top');
        
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                backToTopButton.classList.add('show');
            } else {
                backToTopButton.classList.remove('show');
            }
        });
        
        backToTopButton.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    });
</script>