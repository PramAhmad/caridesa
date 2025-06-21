<x-layouts.tenant>
    <!-- Product Detail Header -->
    <section class="relative bg-gradient-to-br from-amber-50 via-orange-50 to-red-50 py-16 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0">
            <div class="absolute top-10 left-10 w-24 h-24 bg-gradient-to-r from-amber-400 to-orange-500 rounded-full mix-blend-multiply opacity-20 animate-float"></div>
            <div class="absolute bottom-10 right-10 w-32 h-32 bg-gradient-to-r from-red-400 to-pink-500 transform rotate-45 mix-blend-multiply opacity-20 animate-float-delayed"></div>
            <div class="absolute inset-0 bg-traditional-pattern opacity-5"></div>
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4">
            <!-- Breadcrumb -->
            <nav class="mb-8" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2 text-sm">
                    <li>
                        <a href="/" class="text-amber-600 hover:text-amber-700 transition-colors">Beranda</a>
                    </li>
                    <li>
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </li>
                    <li>
                        <a href="/products" class="text-amber-600 hover:text-amber-700 transition-colors">Produk</a>
                    </li>
                    <li>
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </li>
                    <li class="text-gray-500">{{ Str::limit($product->name, 30) }}</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Product Detail Content -->
    <section class="py-16 bg-gradient-to-b from-white to-amber-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-12">
                <!-- Product Images -->
                <div class="space-y-4">
                    <!-- Main Image -->
                    <div class="relative bg-white rounded-2xl shadow-lg overflow-hidden border border-amber-100">
                        <div class="aspect-w-1 aspect-h-1">
                            <img src="{{ asset($product->image) }}" 
                                 alt="{{ $product->name }}"
                                 class="w-full h-96 object-cover object-center"
                                 id="mainProductImage"
                                 onerror="this.src='https://storage.googleapis.com/download/storage/v1/b/xooply-static-production/o/dev%2Fdefault_image.png-ME607j.png?generation=1675570406581666&alt=media'">
                        </div>
                        
                        <!-- Image Badges -->
                        <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
                            @if($product->discount && $product->discount > 0)
                            <div class="bg-gradient-to-r from-red-500 to-pink-500 text-white px-4 py-2 rounded-full text-sm font-bold shadow-lg">
                                HEMAT {{ $product->discount }}%
                            </div>
                            @else
                            <div></div>
                            @endif
                            
                            <span class="px-4 py-2 rounded-full text-sm font-medium text-white bg-amber-500 shadow-lg">
                                {{ $product->stock_label ?? 'Tersedia' }}
                            </span>
                        </div>
                        
                        <!-- Share Button -->
                        <div class="absolute bottom-4 right-4">
                            <button onclick="shareProduct()" class="w-12 h-12 bg-white bg-opacity-90 rounded-full flex items-center justify-center shadow-lg hover:bg-amber-50 transition-colors">
                                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Cultural Pattern Overlay -->
                        <div class="absolute inset-0 bg-traditional-pattern opacity-10 mix-blend-overlay"></div>
                    </div>
                </div>

                <!-- Product Information -->
                <div class="space-y-6">
                    <!-- Category -->
                    <div class="flex items-center gap-3">
                        <span class="px-4 py-2 bg-amber-100 text-amber-700 rounded-full text-sm font-medium border border-amber-200">
                            {{ $product->category->name ?? 'Produk Umum' }}
                        </span>
                        <div class="flex items-center text-amber-500">
                            @for($i = 1; $i <= 5; $i++)
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            @endfor
                            <span class="ml-2 text-sm text-gray-600">(4.8)</span>
                        </div>
                    </div>

                    <!-- Product Title -->
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-2">{{ $product->name }}</h1>
                        <div class="flex items-center gap-4 text-sm text-gray-500">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                {{ $product->views ?? 0 }} dilihat
                            </span>
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $product->created_at->format('d M Y') }}
                            </span>
                        </div>
                    </div>

                    <!-- Price -->
                    <div class="bg-gradient-to-r from-amber-50 to-orange-50 p-6 rounded-2xl border border-amber-200">
                        <div class="flex items-center justify-between">
                            <div>
                                @if($product->discount && $product->discount > 0)
                                <div class="flex items-center gap-3">
                                    <span class="text-3xl font-bold text-amber-600">{{ $product->formatted_discounted_price }}</span>
                                    <span class="text-lg text-gray-400 line-through">{{ $product->formatted_price }}</span>
                                </div>
                                <div class="text-sm text-green-600 font-medium">
                                    Hemat Rp {{ number_format($product->price - $product->discounted_price, 0, ',', '.') }}
                                </div>
                                @else
                                <span class="text-3xl font-bold text-amber-600">{{ $product->formatted_price }}</span>
                                @endif
                            </div>
                            
                            <div class="text-right">
                                <div class="text-sm text-gray-500">Status</div>
                                <div class="text-lg font-bold text-gray-800">{{ $product->stock_label ?? 'Tersedia' }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Product Description -->
                    <div class="prose prose-amber max-w-none">
                        <h3 class="text-xl font-bold text-gray-800 mb-3">Deskripsi Produk</h3>
                        <div class="text-gray-700 leading-relaxed">
                            {!! nl2br(e($product->description)) !!}
                        </div>
                    </div>

                    <!-- Product Links -->
                    @if($product->links && is_array(json_decode($product->links, true)) && count(json_decode($product->links, true)) > 0)
                    <div class="bg-white p-6 rounded-2xl border border-amber-100 shadow-sm">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">Link Terkait</h3>
                        <div class="space-y-3 py-4">
                            @foreach(json_decode($product->links, true) as $link)
                            <a href="{{ $link }}" 
                               target="_blank" 
                               rel="noopener noreferrer"
                               class="flex items-center p-3 my-4 bg-amber-50 rounded-lg hover:bg-amber-100 transition-colors group">
                                <svg class="w-5 h-5 text-amber-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                                <span class="text-amber-700 group-hover:text-amber-800 transition-colors">{{ $link }}</span>
                            </a>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Action Buttons -->
                    <div class="flex gap-4">
                        <button onclick="contactSeller()" class="flex-1 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white py-4 px-6 rounded-xl font-medium transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <span class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                Hubungi Penjual
                            </span>
                        </button>
                        
                        <button onclick="addToFavorites()" class="bg-white border-2 border-amber-500 text-amber-600 hover:bg-amber-50 py-4 px-6 rounded-xl font-medium transition-all duration-300 transform hover:scale-105">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.828a4 4 0 010-5.656z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                        
                        <button onclick="shareProduct()" class="bg-white border-2 border-amber-500 text-amber-600 hover:bg-amber-50 py-4 px-6 rounded-xl font-medium transition-all duration-300 transform hover:scale-105">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Products Section -->
    @if($relatedProducts->count() > 0)
    <section class="py-16 bg-gradient-to-b from-amber-50 to-orange-50">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Produk Terkait</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Temukan produk lainnya yang mungkin Anda sukai
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($relatedProducts as $relatedProduct)
                <div class="product-card mb-10 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden border border-amber-100 group">
                    <!-- Product Image -->
                    <div class="relative overflow-hidden bg-gradient-to-br from-amber-100 to-orange-100">
                        <div class="w-full h-48 relative">
                            <img src="{{ asset($relatedProduct->image) }}" 
                                 alt="{{ $relatedProduct->name }}"
                                 class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-110"
                                 onerror="this.src='https://storage.googleapis.com/download/storage/v1/b/xooply-static-production/o/dev%2Fdefault_image.png-ME607j.png?generation=1675570406581666&alt=media'">
                        </div>
                        
                        <!-- Badges -->
                        <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
                            @if($relatedProduct->discount && $relatedProduct->discount > 0)
                            <div class="bg-gradient-to-r from-red-500 to-pink-500 text-white px-3 py-1 rounded-full text-sm font-bold shadow-lg">
                                -{{ $relatedProduct->discount }}%
                            </div>
                            @else
                            <div></div>
                            @endif
                            
                            <span class="px-3 py-1 rounded-full text-xs font-medium text-white bg-amber-500 shadow-lg">
                                {{ $relatedProduct->stock_label ?? 'Tersedia' }}
                            </span>
                        </div>
                    </div>

                    <!-- Product Info -->
                    <div class="p-5">
                        <!-- Category -->
                        <div class="flex items-center justify-between mb-3">
                            <span class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-xs font-medium border border-amber-200">
                                {{ $relatedProduct->category->name ?? 'Umum' }}
                            </span>
                        </div>
                        
                        <!-- Product Name -->
                        <h3 class="text-lg font-bold text-gray-800 mb-2 line-clamp-2 group-hover:text-amber-700 transition-colors">
                            {{ $relatedProduct->name }}
                        </h3>
                        
                        <!-- Price -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex flex-col">
                                @if($relatedProduct->discount && $relatedProduct->discount > 0)
                                <span class="text-lg font-bold text-amber-600">{{ $relatedProduct->formatted_discounted_price }}</span>
                                <span class="text-sm text-gray-400 line-through">{{ $relatedProduct->formatted_price }}</span>
                                @else
                                <span class="text-lg font-bold text-amber-600">{{ $relatedProduct->formatted_price }}</span>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Action Button -->
                        <a href="/product/{{ $relatedProduct->slug }}" 
                           class="block w-full bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white py-3 px-4 rounded-lg font-medium transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg text-center">
                            Lihat Detail
                        </a>
                    </div>

                    <!-- Traditional border pattern -->
                    <div class="h-2 bg-gradient-to-r from-amber-400 via-orange-400 to-red-400 transform group-hover:scale-x-110 transition-transform duration-500 origin-center"></div>
                </div>
                @endforeach
            </div>

            <div class="text-center pt-10">
                <a href="/products" 
                   class="inline-flex mt-10 items-center bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-700 hover:to-orange-700 text-white px-8 py-4 rounded-xl font-medium transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    Lihat Semua Produk
                </a>
            </div>
        </div>
    </section>
    @endif

    @push('styles')
    <style>
        /* Traditional Pattern Background */
        .bg-traditional-pattern {
            background-image: 
                radial-gradient(circle at 25% 25%, #f59e0b 2px, transparent 2px),
                radial-gradient(circle at 75% 75%, #ea580c 2px, transparent 2px);
            background-size: 50px 50px;
        }
        
        /* Animation Classes */
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(-10px) rotate(2deg); }
            66% { transform: translateY(5px) rotate(-1deg); }
        }
        
        @keyframes float-delayed {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            33% { transform: translateY(8px) rotate(-2deg); }
            66% { transform: translateY(-12px) rotate(1deg); }
        }
        
        .animate-float { animation: float 6s ease-in-out infinite; }
        .animate-float-delayed { animation: float-delayed 8s ease-in-out infinite; }
        
        /* Card Hover Effects */
        .product-card:hover {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
        }
        
        /* Text Utilities */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .prose {
            max-width: none;
        }
        
        .prose h3 {
            margin-top: 0;
            margin-bottom: 0.75rem;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .animate-float, .animate-float-delayed {
                animation: none;
            }
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        // Share Product Function
        function shareProduct() {
            if (navigator.share) {
                navigator.share({
                    title: '{{ $product->name }}',
                    text: '{{ Str::limit($product->description, 100) }}',
                    url: window.location.href
                }).catch(console.error);
            } else {
                // Fallback for browsers that don't support Web Share API
                const url = window.location.href;
                navigator.clipboard.writeText(url).then(() => {
                    alert('Link produk telah disalin ke clipboard!');
                });
            }
        }

        // Contact Seller Function
        function contactSeller() {
            const message = `Halo, saya tertarik dengan produk *{{ $product->name }}* dengan harga {{ $product->formatted_price }}. Bisakah saya mendapatkan informasi lebih lanjut?`;
            const whatsappUrl = `https://wa.me/?text=${encodeURIComponent(message)}`;
            window.open(whatsappUrl, '_blank');
        }

        // Add to Favorites Function
        function addToFavorites() {
            // This would typically save to localStorage or make an API call
            const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
            const productId = {{ $product->id }};
            
            if (!favorites.includes(productId)) {
                favorites.push(productId);
                localStorage.setItem('favorites', JSON.stringify(favorites));
                alert('Produk telah ditambahkan ke favorit!');
                
                // Update button appearance
                const button = event.target.closest('button');
                button.classList.add('bg-amber-100', 'text-amber-700');
                button.classList.remove('bg-white', 'text-amber-600');
            } else {
                alert('Produk sudah ada di favorit!');
            }
        }

        // Check if product is already in favorites on page load
        document.addEventListener('DOMContentLoaded', function() {
            const favorites = JSON.parse(localStorage.getItem('favorites') || '[]');
            const productId = {{ $product->id }};
            
            if (favorites.includes(productId)) {
                const favoriteButton = document.querySelector('button[onclick="addToFavorites()"]');
                if (favoriteButton) {
                    favoriteButton.classList.add('bg-amber-100', 'text-amber-700');
                    favoriteButton.classList.remove('bg-white', 'text-amber-600');
                }
            }

            // Smooth scroll animation
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);
            
            // Observe all product cards
            document.querySelectorAll('.product-card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'opacity 0.6s ease-out, transform 0.6s ease-out';
                observer.observe(card);
            });
        });
    </script>
    @endpush
</x-layouts.tenant>