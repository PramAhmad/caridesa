<x-layouts.tenant>
    <!-- Products Header Section -->
    <section class="relative bg-gradient-to-br from-amber-50 via-orange-50 to-red-50 py-20 overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0">
            <div class="absolute top-20 left-20 w-32 h-32 bg-gradient-to-r from-amber-400 to-orange-500 rounded-full mix-blend-multiply opacity-30 animate-float"></div>
            <div class="absolute bottom-20 right-20 w-24 h-24 bg-gradient-to-r from-red-400 to-pink-500 transform rotate-45 mix-blend-multiply opacity-30 animate-float-delayed"></div>
            <div class="absolute inset-0 bg-traditional-pattern opacity-5"></div>
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4">
            <div class="text-center">
                <div class="inline-block px-6 py-3 bg-amber-100 rounded-full text-sm font-medium text-amber-800 mb-4 border border-amber-200">
                    🛍️ Produk Budaya Lokal
                </div>
                <h1 class="text-4xl md:text-6xl font-bold mb-6 bg-gradient-to-r from-amber-800 to-red-700 bg-clip-text text-transparent">
                    Kerajinan & Produk Tradisional
                </h1>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed mb-8">
                    Temukan keindahan hasil karya tangan para pengrajin lokal yang melestarikan warisan budaya nenek moyang
                </p>
                
                <!-- Quick Stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-2xl mx-auto">
                    <div class="text-center p-4 bg-white bg-opacity-80 rounded-lg shadow-sm border border-amber-100">
                        <div class="text-2xl font-bold text-amber-600">{{ $products->total() }}</div>
                        <div class="text-sm text-gray-600">Total Produk</div>
                    </div>
                    <div class="text-center p-4 bg-white bg-opacity-80 rounded-lg shadow-sm border border-orange-100">
                        <div class="text-2xl font-bold text-orange-600">{{ $categories->count() }}</div>
                        <div class="text-sm text-gray-600">Kategori</div>
                    </div>
                    <div class="text-center p-4 bg-white bg-opacity-80 rounded-lg shadow-sm border border-red-100">
                        <div class="text-2xl font-bold text-red-600">{{ $products->where('is_active', true)->count() }}</div>
                        <div class="text-sm text-gray-600">Tersedia</div>
                    </div>
                    <div class="text-center p-4 bg-white bg-opacity-80 rounded-lg shadow-sm border border-amber-100">
                        <div class="text-2xl font-bold text-amber-600">4.8</div>
                        <div class="text-sm text-gray-600">Rating</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Main Content Section -->
    <section class="py-16 bg-gradient-to-b from-white to-amber-50">
        <div class="max-w-7xl mx-auto px-4">
            
            <!-- Search & Filter Bar -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-12 border border-amber-100">
                <form method="GET" action="/products" class="space-y-4">
                    <!-- Search Bar -->
                    <div class="relative">
                        <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <input type="text" 
                               name="search" 
                               value="{{ request('search') }}"
                               placeholder="Cari produk budaya..." 
                               class="w-full pl-12 pr-4 py-3 border border-amber-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-transparent bg-amber-50">
                    </div>
                    
                    <!-- Filters Row -->
                    <div class="grid md:grid-cols-4 gap-4">
                        <!-- Category Filter -->
                        <select name="category" class="px-4 py-3 border border-amber-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 bg-white">
                            <option value="all">Semua Kategori</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        
                        <!-- Price Range -->
                        <div class="flex gap-2">
                            <input type="number" 
                                   name="min_price" 
                                   value="{{ request('min_price') }}"
                                   placeholder="Harga Min" 
                                   class="w-full px-3 py-3 border border-amber-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 bg-white">
                            <input type="number" 
                                   name="max_price" 
                                   value="{{ request('max_price') }}"
                                   placeholder="Harga Max" 
                                   class="w-full px-3 py-3 border border-amber-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 bg-white">
                        </div>
                        
                        <!-- Sort By -->
                        <select name="sort" class="px-4 py-3 border border-amber-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 bg-white">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Nama A-Z</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga Terendah</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga Tertinggi</option>
                            <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Populer</option>
                        </select>
                        
                        <!-- Search Button -->
                        <button type="submit" class="bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-700 hover:to-orange-700 text-white px-6 py-3 rounded-lg font-medium transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg">
                            <span class="flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                Cari
                            </span>
                        </button>
                    </div>
                </form>
                
                <!-- Active Filters Display -->
                @if(request('search') || request('category') != 'all' || request('min_price') || request('max_price') || request('sort') != 'latest')
                <div class="mt-4 pt-4 border-t border-amber-100">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="text-sm text-gray-600">Filter aktif:</span>
                        
                        @if(request('search'))
                        <span class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-sm">
                            Pencarian: "{{ request('search') }}"
                            <a href="{{ request()->fullUrlWithoutQuery('search') }}" class="ml-2 text-amber-500 hover:text-amber-700">×</a>
                        </span>
                        @endif
                        
                        @if(request('category') && request('category') != 'all')
                        <span class="px-3 py-1 bg-orange-100 text-orange-700 rounded-full text-sm">
                            Kategori: {{ $categories->find(request('category'))->name ?? 'Unknown' }}
                            <a href="{{ request()->fullUrlWithoutQuery('category') }}" class="ml-2 text-orange-500 hover:text-orange-700">×</a>
                        </span>
                        @endif
                        
                        @if(request('min_price') || request('max_price'))
                        <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-sm">
                            Harga: Rp {{ number_format(request('min_price', 0)) }} - Rp {{ number_format(request('max_price', 999999999)) }}
                            <a href="{{ request()->fullUrlWithoutQuery(['min_price', 'max_price']) }}" class="ml-2 text-red-500 hover:text-red-700">×</a>
                        </span>
                        @endif
                        
                        <a href="/products" class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-sm hover:bg-gray-200 transition-colors">
                            Reset Semua Filter
                        </a>
                    </div>
                </div>
                @endif
            </div>

            <!-- Results Info -->
            <div class="flex justify-between items-center mb-8">
                <div class="text-gray-600">
                    Menampilkan <span class="font-semibold text-amber-700">{{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }}</span> 
                    dari <span class="font-semibold text-amber-700">{{ $products->total() }}</span> produk
                </div>
                <div class="text-sm text-gray-500">
                    Halaman {{ $products->currentPage() }} dari {{ $products->lastPage() }}
                </div>
            </div>

            <!-- Products Grid -->
            @if($products->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-12">
                @foreach($products as $product)
                <div class="product-card bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden border border-amber-100 group h-full flex flex-col">
                    <!-- Product Image -->
                    <div class="relative overflow-hidden bg-gradient-to-br from-amber-100 to-orange-100 flex-shrink-0">
                        <div class="w-full h-48 relative">
                            <img src="{{ asset($product->image) }}" 
                                 alt="{{ $product->name }}"
                                 class="w-full h-full object-cover object-center transition-transform duration-500 group-hover:scale-110"
                                 onerror="this.src='https://storage.googleapis.com/download/storage/v1/b/xooply-static-production/o/dev%2Fdefault_image.png-ME607j.png?generation=1675570406581666&alt=media'">
                        </div>
                        
                        <!-- Badges -->
                        <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
                            @if($product->hasDiscount())
                            <div class="bg-gradient-to-r from-red-500 to-pink-500 text-white px-3 py-1 rounded-full text-sm font-bold shadow-lg">
                                -{{ $product->discount }}%
                            </div>
                            @else
                            <div></div>
                            @endif
                            
                            <span class="px-3 py-1 rounded-full text-xs font-medium text-white bg-amber-500 shadow-lg">
                                {{ $product->stock_label }}
                            </span>
                        </div>
                        
                        <!-- Quick Actions -->
                        <div class="absolute bottom-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <button class="w-10 h-10 bg-white bg-opacity-90 rounded-full flex items-center justify-center shadow-lg hover:bg-amber-50 transition-colors">
                                <svg class="w-5 h-5 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.828a4 4 0 010-5.656z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                        
                        <!-- Cultural Pattern Overlay -->
                        <div class="absolute inset-0 bg-traditional-pattern opacity-10 mix-blend-overlay"></div>
                    </div>

                    <!-- Product Info -->
                    <div class="p-5 flex-grow flex flex-col">
                        <!-- Category -->
                        <div class="flex items-center justify-between mb-3">
                            <span class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-xs font-medium border border-amber-200">
                                {{ $product->category->name ?? 'Umum' }}
                            </span>
                            <div class="flex items-center text-amber-500">
                                @for($i = 1; $i <= 5; $i++)
                                <svg class="w-3 h-3 fill-current" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                @endfor
                            </div>
                        </div>
                        
                        <!-- Product Name -->
                        <h3 class="text-lg font-bold text-gray-800 mb-2 line-clamp-2 group-hover:text-amber-700 transition-colors flex-grow">
                            {{ $product->name }}
                        </h3>
                        
                        <!-- Description -->
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3 flex-grow">
                            {{ Str::limit($product->description, 100) }}
                        </p>
                        
                        <!-- Price -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex flex-col">
                                @if($product->hasDiscount())
                                <span class="text-lg font-bold text-amber-600">{{ $product->formatted_discounted_price }}</span>
                                <span class="text-sm text-gray-400 line-through">{{ $product->formatted_price }}</span>
                                @else
                                <span class="text-lg font-bold text-amber-600">{{ $product->formatted_price }}</span>
                                @endif
                            </div>
                            
                            <!-- Views Info -->
                            <div class="text-xs text-gray-500 flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                {{ $product->views ?? 0 }} dilihat
                            </div>
                        </div>
                        
                        <!-- Action Button -->
                        <a href="/product/{{ $product->slug }}" 
                           class="block w-full bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white py-3 px-4 rounded-lg font-medium transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg text-center">
                            <span class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Lihat Detail
                            </span>
                        </a>
                    </div>

                    <!-- Traditional border pattern -->
                    <div class="h-2 bg-gradient-to-r from-amber-400 via-orange-400 to-red-400 transform group-hover:scale-x-110 transition-transform duration-500 origin-center"></div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="flex justify-center">
                <div class="bg-white rounded-lg shadow-lg p-4 border border-amber-100">
                    {{ $products->links() }}
                </div>
            </div>
            
            @else
            <!-- No Products Found -->
            <div class="text-center py-16">
                <div class="w-32 h-32 mx-auto mb-6 bg-gradient-to-br from-amber-400 to-orange-500 rounded-full flex items-center justify-center">
                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4">Produk Tidak Ditemukan</h3>
                <p class="text-gray-600 mb-6 max-w-md mx-auto">
                    Maaf, tidak ada produk yang sesuai dengan kriteria pencarian Anda. Coba ubah filter atau kata kunci pencarian.
                </p>
                <a href="/products" 
                   class="inline-flex items-center bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-700 hover:to-orange-700 text-white px-6 py-3 rounded-lg font-medium transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                    </svg>
                    Lihat Semua Produk
                </a>
            </div>
            @endif
        </div>
    </section>

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
        
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        /* Fixed Height Cards */
        .product-card {
            min-height: 500px;
        }
        
        /* Pagination Styles */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            margin: 0;
        }
        
        .pagination .page-item .page-link {
            color: #f59e0b;
            border: 1px solid #f3e8ff;
            padding: 0.5rem 1rem;
            margin: 0 0.125rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            background-color: white;
        }
        
        .pagination .page-item.active .page-link {
            background-color: #f59e0b;
            border-color: #f59e0b;
            color: white;
        }
        
        .pagination .page-item:hover .page-link {
            background-color: #fef3c7;
            border-color: #f59e0b;
            color: #92400e;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .animate-float, .animate-float-delayed {
                animation: none;
            }
            
            .product-card {
                min-height: auto;
            }
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        // Smooth scroll animation for product cards
        document.addEventListener('DOMContentLoaded', function() {
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