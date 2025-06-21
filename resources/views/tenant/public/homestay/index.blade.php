<x-layouts.tenant>
    <!-- Homestay Hero Section - Amber Theme Style -->
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-amber-50 via-orange-50 to-red-50">
        <!-- Decorative Elements -->
        <div class="absolute inset-0">
            <!-- Geometric Patterns -->
            <div class="absolute top-20 left-10 w-32 h-32 bg-gradient-to-br from-amber-400/20 to-orange-500/20 rounded-full blur-xl animate-pulse"></div>
            <div class="absolute bottom-20 right-10 w-40 h-40 bg-gradient-to-br from-red-400/20 to-pink-500/20 rounded-full blur-xl animate-pulse delay-1000"></div>
            
            <!-- Traditional Pattern Overlay -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-amber-100 to-transparent transform -skew-y-6"></div>
                <div class="absolute inset-0 bg-gradient-to-l from-transparent via-orange-100 to-transparent transform skew-y-6"></div>
            </div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 text-center">
            <!-- Main Title -->
            <div class="mb-12">
                <h1 class="text-5xl md:text-7xl font-bold mb-6">
                    <span class="bg-gradient-to-r from-amber-600 via-orange-500 to-red-500 bg-clip-text text-transparent">
                        Homestay
                    </span>
                    <br>
                    <span class="text-gray-800">Terbaik</span>
                </h1>
                <p class="text-xl md:text-2xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                    Temukan pengalaman menginap yang autentik dan nyaman.<br>
                    <span class="text-amber-600 font-semibold">Rasakan kehangatan rumah di setiap sudut perjalanan Anda.</span>
                </p>
            </div>

            <!-- Enhanced Search & Filter Section -->
            <div class="max-w-5xl mx-auto">
                <div class="bg-white/95 backdrop-blur-sm rounded-3xl p-8 shadow-2xl border border-amber-200/50">
                    <form method="GET" action="/homestay" id="homestayFilterForm">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            <!-- Search Input -->
                            <div class="relative group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Cari Homestay</label>
                                <div class="relative">
                                    <input type="text" 
                                           name="search" 
                                           value="{{ request('search') }}"
                                           placeholder="Nama homestay..." 
                                           class="w-full pl-12 pr-4 py-4 bg-white border-2 border-amber-200 rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-500/20 transition-all duration-300 text-gray-700">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Location Filter -->
                            <div class="relative group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Lokasi</label>
                                <div class="relative">
                                    <input type="text" 
                                           name="location" 
                                           value="{{ request('location') }}"
                                           placeholder="Cari lokasi..." 
                                           class="w-full pl-12 pr-4 py-4 bg-white border-2 border-amber-200 rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-500/20 transition-all duration-300 text-gray-700">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Price Range -->
                            <div class="relative group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Harga Maksimal</label>
                                <div class="relative">
                                    <input type="number" 
                                           name="max_price" 
                                           value="{{ request('max_price') }}"
                                           placeholder="Rp 0" 
                                           class="w-full pl-12 pr-4 py-4 bg-white border-2 border-amber-200 rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-500/20 transition-all duration-300 text-gray-700">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Sort Options -->
                            <div class="relative group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Urutkan</label>
                                <div class="relative">
                                    <select name="sort" 
                                            class="w-full pl-4 pr-12 py-4 bg-white border-2 border-amber-200 rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-500/20 transition-all duration-300 text-gray-700 appearance-none cursor-pointer">
                                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga Terendah</option>
                                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga Tertinggi</option>
                                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>A-Z</option>
                                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Z-A</option>
                                    </select>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex flex-col sm:flex-row justify-between items-center mt-8 pt-6 border-t border-amber-200">
                            <div class="text-sm text-gray-600 mb-4 sm:mb-0">
                                @if(isset($homestays))
                                    Menampilkan {{ $homestays->count() }} dari {{ $homestays->total() }} homestay
                                @else
                                    Siap mencari homestay
                                @endif
                            </div>
                            
                            <div class="flex gap-3">
                                <button type="submit" 
                                        class="group bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white px-8 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                    <span class="flex items-center">
                                        <svg class="w-5 h-5 mr-2 group-hover:animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                        Cari Homestay
                                    </span>
                                </button>
                                
                                <a href="/homestay" 
                                   class="bg-white border-2 border-amber-300 text-amber-700 hover:bg-amber-50 px-8 py-3 rounded-xl font-semibold transition-all duration-300 hover:shadow-md">
                                    Reset Filter
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Scroll Indicator -->
            <div class="mt-16 animate-bounce">
                <svg class="w-6 h-6 mx-auto text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </div>
        </div>
    </section>

    <!-- Homestay Main Content Section -->
    <section class="py-20 bg-gradient-to-b from-white via-amber-50/30 to-orange-50/50">
        <div class="max-w-7xl mx-auto px-6">
            @if(isset($homestays) && $homestays->count() > 0)
                <!-- Section Title -->
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                        Homestay <span class="text-amber-600">Pilihan</span>
                    </h2>
                    <div class="w-24 h-1 bg-gradient-to-r from-amber-500 to-orange-500 mx-auto rounded-full"></div>
                </div>

                <!-- Homestay Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach($homestays as $homestay)
                    <div class="homestay-card group bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 overflow-hidden border border-amber-100/50">
                        <!-- Image Container -->
                        <div class="relative overflow-hidden ">
                            <div class="aspect-[4/3] relative">
                                <img src="{{ $homestay->main_image_url }}" 
                                     alt="{{ $homestay->name }}"
                                     class="w-full h-full object-cover z-10 transition-transform duration-700 group-hover:scale-110"
                                     onerror="this.src='https://via.placeholder.com/400x300/f59e0b/ffffff?text=Homestay'">
                            </div>
                            
                            <!-- Overlay Badges -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-black/10"></div>
                            
                            <!-- Top Badges -->
                            <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
                                @if($homestay->has_discount)
                                <span class="px-3 py-1.5 bg-gradient-to-r from-red-500 to-pink-500 text-white rounded-full text-xs font-bold shadow-lg backdrop-blur-sm">
                                    -{{ $homestay->discount_percent }}%
                                </span>
                                @else
                                <span class="px-3 py-1.5 bg-gradient-to-r from-amber-500 to-orange-500 text-white rounded-full text-xs font-bold shadow-lg backdrop-blur-sm">
                                    {{ $homestay->status_badge }}
                                </span>
                                @endif
                                
                                <div class="flex items-center bg-white/90 backdrop-blur-sm rounded-full px-3 py-1.5 shadow-lg">
                                    <svg class="w-3 h-3 text-amber-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    <span class="text-xs font-bold text-gray-700">{{ $homestay->rating }}</span>
                                </div>
                            </div>
                            
                            <!-- Favorite Button -->
                            <div class="absolute bottom-4 right-4">
                                <button onclick="toggleHomestayFavorite({{ $homestay->id }})" 
                                        class="w-12 h-12 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg hover:bg-white hover:scale-110 transition-all duration-300 group/fav">
                                    <svg class="w-6 h-6 text-amber-600 group-hover/fav:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="p-6">
                            <!-- Views & Contact -->
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center text-gray-500 text-xs">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 616 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    <span class="font-medium">{{ $homestay->views }} dilihat</span>
                                </div>
                                
                                @if($homestay->phone)
                                <div class="flex items-center text-green-600 text-xs">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    <span class="font-medium">Kontak</span>
                                </div>
                                @endif
                            </div>
                            
                            <!-- Homestay Name -->
                            <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2 group-hover:text-amber-700 transition-colors">
                                {{ $homestay->name }}
                            </h3>
                            
                            <!-- Address -->
                            @if($homestay->address)
                            <div class="flex items-center text-gray-500 text-sm mb-3">
                                <svg class="w-4 h-4 mr-2 text-amber-500 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 616 0z"></path>
                                </svg>
                                <span class="truncate font-medium">{{ Str::limit($homestay->address, 40) }}</span>
                            </div>
                            @endif
                            
                            <!-- Description -->
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3 leading-relaxed">
                                {{ Str::limit($homestay->description, 100) }}
                            </p>
                            
                            <!-- Price -->
                            <div class="mb-6">
                                @if($homestay->has_discount)
                                <div class="flex items-center gap-3 mb-1">
                                    <span class="text-xl font-bold bg-gradient-to-r from-amber-600 to-orange-600 bg-clip-text text-transparent">
                                        {{ $homestay->formatted_discounted_price }}
                                    </span>
                                    <span class="text-sm text-gray-400 line-through">{{ $homestay->formatted_price }}</span>
                                </div>
                                <div class="text-xs text-green-600 font-medium">
                                    Hemat {{ $homestay->formatted_discount_amount }} per malam
                                </div>
                                @else
                                <div class="text-xl font-bold bg-gradient-to-r from-amber-600 to-orange-600 bg-clip-text text-transparent">
                                    {{ $homestay->formatted_price }}
                                </div>
                                @endif
                                <div class="text-xs text-gray-500 mt-1">per malam</div>
                            </div>
                            
                            <!-- Action Button -->
                            <a href="/homestay/{{ $homestay->id }}" 
                               class="block w-full bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white py-4 px-6 rounded-xl font-bold text-center transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl group">
                                <span class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 616 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Lihat Detail
                                </span>
                            </a>
                        </div>

                        <!-- Decorative Border -->
                        <div class="h-2 bg-gradient-to-r from-amber-400 via-orange-400 to-red-400 transform group-hover:scale-x-110 transition-transform duration-500 origin-center"></div>
                    </div>
                    @endforeach
                </div>

                <!-- Enhanced Pagination -->
                @if($homestays->hasPages())
                    <div class="mt-20 flex justify-center">
                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-amber-200/50 p-6">
                            <div class="flex items-center justify-center space-x-2">
                                {{ $homestays->appends(request()->query())->links('pagination::tailwind') }}
                            </div>
                        </div>
                    </div>
                @endif
            @else
                <!-- Enhanced Empty State -->
                <div class="text-center py-20">
                    <div class="max-w-md mx-auto">
                        <div class="w-40 h-40 mx-auto mb-8 bg-gradient-to-br from-amber-100 to-orange-100 rounded-full flex items-center justify-center">
                            <svg class="w-20 h-20 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-800 mb-4">Belum Ada Homestay</h3>
                        <p class="text-gray-600 mb-8 leading-relaxed">
                            Maaf, belum ada homestay yang tersedia saat ini atau sesuai dengan filter pencarian Anda. 
                            Silakan coba kata kunci lain atau hubungi kami untuk informasi lebih lanjut.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="/homestay" class="inline-flex items-center bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white px-8 py-4 rounded-xl font-bold transition-all duration-300 transform hover:scale-105 shadow-lg">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Reset Pencarian
                            </a>
                            <a href="/" class="inline-flex items-center bg-white border-2 border-amber-300 text-amber-700 hover:bg-amber-50 px-8 py-4 rounded-xl font-bold transition-all duration-300 hover:shadow-md">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                Kembali ke Beranda
                            </a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>

    @push('styles')
    <style>
        /* Enhanced Card Hover Effects */
        .homestay-card {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .homestay-card:hover {
            box-shadow: 0 25px 50px -12px rgba(245, 158, 11, 0.3);
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
    </style>
    @endpush

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-submit form on filter change
            const form = document.getElementById('homestayFilterForm');
            const selects = form.querySelectorAll('select');
            
            selects.forEach(select => {
                select.addEventListener('change', function() {
                    const submitBtn = form.querySelector('button[type="submit"]');
                    if (submitBtn) {
                        submitBtn.classList.add('btn-loading');
                    }
                    form.submit();
                });
            });
            
            // Initialize favorites
            updateHomestayFavoriteButtons();
        });

        // Enhanced favorite toggle function
        function toggleHomestayFavorite(homestayId) {
            try {
                const favorites = JSON.parse(localStorage.getItem('homestay_favorites') || '[]');
                const index = favorites.indexOf(homestayId);
                
                if (index === -1) {
                    favorites.push(homestayId);
                    showNotification('🏠 Homestay ditambahkan ke favorit!', 'success');
                } else {
                    favorites.splice(index, 1);
                    showNotification('💔 Homestay dihapus dari favorit!', 'info');
                }
                
                localStorage.setItem('homestay_favorites', JSON.stringify(favorites));
                updateHomestayFavoriteButtons();
            } catch (error) {
                console.error('Error toggling favorite:', error);
                showNotification('❌ Terjadi kesalahan!', 'error');
            }
        }

        // Update favorite button appearances
        function updateHomestayFavoriteButtons() {
            const favorites = JSON.parse(localStorage.getItem('homestay_favorites') || '[]');
            document.querySelectorAll('[onclick^="toggleHomestayFavorite"]').forEach(button => {
                const homestayId = parseInt(button.getAttribute('onclick').match(/\d+/)[0]);
                const icon = button.querySelector('svg');
                
                if (favorites.includes(homestayId)) {
                    icon.setAttribute('fill', 'currentColor');
                    button.classList.add('text-red-500');
                    button.classList.remove('text-amber-600');
                } else {
                    icon.setAttribute('fill', 'none');
                    button.classList.add('text-amber-600');
                    button.classList.remove('text-red-500');
                }
            });
        }

        // Enhanced notification system (same as wisata)
        function showNotification(message, type = 'info') {
            const notification = document.createElement('div');
            const typeStyles = {
                success: 'bg-gradient-to-r from-green-500 to-emerald-500 text-white',
                error: 'bg-gradient-to-r from-red-500 to-rose-500 text-white',
                info: 'bg-gradient-to-r from-blue-500 to-cyan-500 text-white',
                warning: 'bg-gradient-to-r from-yellow-500 to-amber-500 text-white'
            };
            
            notification.className = `fixed top-6 right-6 z-50 px-6 py-4 rounded-xl shadow-2xl transform translate-x-full transition-all duration-500 ${typeStyles[type] || typeStyles.info} max-w-sm`;
            notification.innerHTML = `
                <div class="flex items-center">
                    <div class="flex-1">${message}</div>
                    <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white/80 hover:text-white">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            setTimeout(() => notification.classList.remove('translate-x-full'), 100);
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    if (notification.parentElement) {
                        notification.parentElement.removeChild(notification);
                    }
                }, 500);
            }, 4000);
        }
    </script>
    @endpush
</x-layouts.tenant>