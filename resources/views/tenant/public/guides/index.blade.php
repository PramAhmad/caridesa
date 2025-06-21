<x-layouts.tenant>
    <!-- Guides Hero Section - Amber Theme Style -->
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
                        Tour Guide
                    </span>
                    <br>
                    <span class="text-gray-800">Profesional</span>
                </h1>
                <p class="text-xl md:text-2xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                    Temukan pemandu wisata terbaik untuk perjalanan Anda.<br>
                    <span class="text-amber-600 font-semibold">Berpengalaman, terpercaya, dan siap memandu petualangan Anda.</span>
                </p>
            </div>

            <!-- Enhanced Search & Filter Section -->
            <div class="max-w-5xl mx-auto">
                <div class="bg-white/95 backdrop-blur-sm rounded-3xl p-8 shadow-2xl border border-amber-200/50">
                    <form method="GET" action="/guides" id="guideFilterForm">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            <!-- Search Input -->
                            <div class="relative group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Cari Guide</label>
                                <div class="relative">
                                    <input type="text" 
                                           name="search" 
                                           value="{{ request('search') }}"
                                           placeholder="Nama guide..." 
                                           class="w-full pl-12 pr-4 py-4 bg-white border-2 border-amber-200 rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-500/20 transition-all duration-300 text-gray-700">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Specialty Filter -->
                            <div class="relative group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Spesialisasi</label>
                                <div class="relative">
                                    <select name="specialty" 
                                            class="w-full pl-12 pr-4 py-4 bg-white border-2 border-amber-200 rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-500/20 transition-all duration-300 text-gray-700 appearance-none cursor-pointer">
                                        <option value="">Semua Spesialisasi</option>
                                        <option value="wisata_alam" {{ request('specialty') == 'wisata_alam' ? 'selected' : '' }}>Wisata Alam</option>
                                        <option value="wisata_budaya" {{ request('specialty') == 'wisata_budaya' ? 'selected' : '' }}>Wisata Budaya</option>
                                        <option value="wisata_religi" {{ request('specialty') == 'wisata_religi' ? 'selected' : '' }}>Wisata Religi</option>
                                        <option value="wisata_kuliner" {{ request('specialty') == 'wisata_kuliner' ? 'selected' : '' }}>Wisata Kuliner</option>
                                        <option value="wisata_sejarah" {{ request('specialty') == 'wisata_sejarah' ? 'selected' : '' }}>Wisata Sejarah</option>
                                        <option value="wisata_adventure" {{ request('specialty') == 'wisata_adventure' ? 'selected' : '' }}>Wisata Adventure</option>
                                    </select>
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                        </svg>
                                    </div>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Price Range Filter -->
                            <div class="relative group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Rentang Harga</label>
                                <div class="relative">
                                    <select name="price_range" 
                                            class="w-full pl-12 pr-4 py-4 bg-white border-2 border-amber-200 rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-500/20 transition-all duration-300 text-gray-700 appearance-none cursor-pointer">
                                        <option value="">Semua Harga</option>
                                        <option value="0-200000" {{ request('price_range') == '0-200000' ? 'selected' : '' }}>< Rp 200.000</option>
                                        <option value="200000-500000" {{ request('price_range') == '200000-500000' ? 'selected' : '' }}>Rp 200.000 - 500.000</option>
                                        <option value="500000-1000000" {{ request('price_range') == '500000-1000000' ? 'selected' : '' }}>Rp 500.000 - 1.000.000</option>
                                        <option value="1000000-up" {{ request('price_range') == '1000000-up' ? 'selected' : '' }}>> Rp 1.000.000</option>
                                    </select>
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                        </svg>
                                    </div>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
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
                                        <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Terendah</option>
                                        <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Tertinggi</option>
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
                                @if(isset($guides))
                                    Menampilkan {{ $guides->count() }} dari {{ $guides->total() }} guide
                                @else
                                    Siap mencari guide
                                @endif
                            </div>
                            
                            <div class="flex gap-3">
                                <button type="submit" 
                                        class="group bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white px-8 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                    <span class="flex items-center">
                                        <svg class="w-5 h-5 mr-2 group-hover:animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                        Cari Guide
                                    </span>
                                </button>
                                
                                <a href="/guides" 
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

    <!-- Guides Main Content Section -->
    <section class="py-20 bg-gradient-to-b from-white via-amber-50/30 to-orange-50/50">
        <div class="max-w-7xl mx-auto px-6">
            @if(isset($guides) && $guides->count() > 0)
                <!-- Section Title -->
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                        Guide <span class="text-amber-600">Terbaik</span>
                    </h2>
                    <div class="w-24 h-1 bg-gradient-to-r from-amber-500 to-orange-500 mx-auto rounded-full"></div>
                </div>

                <!-- Guides Cards Grid - Mixed Layout -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($guides as $index => $guide)
                    @php
                        // Generate different card styles based on index
                        $cardVariants = ['standard', 'featured', 'compact', 'premium'];
                        $variant = $cardVariants[$index % 4];
                        
                        // Get availability colors
                        $availabilityColors = [
                            'Tersedia' => ['bg' => 'bg-green-500', 'text' => 'text-green-600', 'border' => 'border-green-200'],
                            'Sibuk' => ['bg' => 'bg-red-500', 'text' => 'text-red-600', 'border' => 'border-red-200'],
                            'Tersedia Terbatas' => ['bg' => 'bg-yellow-500', 'text' => 'text-yellow-600', 'border' => 'border-yellow-200']
                        ];
                        $availabilityColor = $availabilityColors[$guide->availability] ?? $availabilityColors['Tersedia'];
                    @endphp

                    @if($variant === 'featured')
                    <!-- Featured Card - Profile Style -->
                    <div class="guide-card group {{ $index % 6 === 0 ? 'md:col-span-2' : '' }} bg-gradient-to-br from-white to-amber-50 rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-4 overflow-hidden border border-amber-200">
                        <div class="p-8">
                            <!-- Profile Header -->
                            <div class="flex items-center space-x-6 mb-6">
                                <div class="relative">
                                    <div class="w-24 h-24 rounded-full overflow-hidden ring-4 ring-amber-200 group-hover:ring-amber-400 transition-all">
                                        <img src="{{ $guide->main_image_url }}" 
                                             alt="{{ $guide->name }}"
                                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                             onerror="this.src='https://via.placeholder.com/200x200/f59e0b/ffffff?text=Guide'">
                                    </div>
                                    <!-- Status indicator -->
                                    <div class="absolute -bottom-1 -right-1 w-8 h-8 {{ $availabilityColor['bg'] }} rounded-full border-4 border-white flex items-center justify-center">
                                        @if($guide->availability === 'Tersedia')
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        @elseif($guide->availability === 'Sibuk')
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                        @else
                                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="flex-1">
                                    <h3 class="text-2xl font-bold text-gray-800 mb-2 group-hover:text-amber-700 transition-colors">
                                        {{ $guide->name }}
                                    </h3>
                                    <p class="text-amber-600 font-semibold mb-1">{{ $guide->specialty }}</p>
                                    <div class="flex items-center text-sm text-gray-600">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        <span class="font-medium">{{ $guide->rating }}</span>
                                        <span class="mx-2">•</span>
                                        <span>{{ $guide->experience_years }} tahun pengalaman</span>
                                    </div>
                                </div>
                                
                                <button onclick="toggleGuideFavorite({{ $guide->id }})" 
                                        class="w-12 h-12 bg-white/80 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg hover:bg-white hover:scale-110 transition-all duration-300 group/fav">
                                    <svg class="w-6 h-6 text-amber-600 group-hover/fav:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </button>
                            </div>
                            
                            <!-- Languages & Skills -->
                            <div class="mb-6">
                                <div class="flex flex-wrap gap-2 mb-3">
                                    @foreach($guide->languages as $language)
                                    <span class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-xs font-medium">
                                        {{ $language }}
                                    </span>
                                    @endforeach
                                </div>
                                
                                <p class="text-gray-600 text-sm leading-relaxed line-clamp-3">
                                    {{ Str::limit($guide->description, 150) }}
                                </p>
                            </div>
                            
                            <!-- Price & Action -->
                            <div class="flex items-center justify-between">
                                <div>
                                    @if($guide->hasDiscount())
                                    <div class="flex items-center space-x-2">
                                        <span class="text-2xl font-bold text-amber-600">{{ $guide->formatted_discounted_price }}</span>
                                        <span class="text-sm text-gray-400 line-through">{{ $guide->formatted_price }}</span>
                                    </div>
                                    <div class="text-xs text-green-600 font-medium">Hemat {{ $guide->discount_percent }}%</div>
                                    @else
                                    <div class="text-2xl font-bold text-amber-600">{{ $guide->formatted_price }}</div>
                                    @endif
                                    <div class="text-xs text-gray-500">per hari</div>
                                </div>

                                <a href="/guide/{{ $guide->id }}" 
                                   class="bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white py-3 px-6 rounded-xl font-bold transition-all duration-300 transform hover:scale-105 shadow-lg">
                                    Lihat Profil
                                </a>
                            </div>
                        </div>
                        
                        <!-- Decorative bottom border -->
                        <div class="h-3 bg-gradient-to-r from-amber-400 via-orange-400 to-red-400 transform group-hover:scale-x-110 transition-transform duration-500 origin-center"></div>
                    </div>

                    @elseif($variant === 'compact')
                    <!-- Compact Card - Horizontal Layout -->
                    <div class="guide-card group bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden border border-amber-100/50">
                        <div class="flex items-center p-6">
                            <div class="relative flex-shrink-0 mr-6">
                                <div class="w-20 h-20 rounded-full overflow-hidden ring-2 ring-amber-200">
                                    <img src="{{ $guide->main_image_url }}" 
                                         alt="{{ $guide->name }}"
                                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                         onerror="this.src='https://via.placeholder.com/150x150/f59e0b/ffffff?text=Guide'">
                                </div>
                                <div class="absolute -bottom-1 -right-1 w-6 h-6 {{ $availabilityColor['bg'] }} rounded-full border-2 border-white"></div>
                            </div>
                            
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-gray-800 mb-2 group-hover:text-amber-700 transition-colors">
                                    {{ $guide->name }}
                                </h3>
                                <p class="text-amber-600 font-medium text-sm mb-2">{{ $guide->specialty }}</p>
                                
                                <div class="flex items-center text-xs text-gray-600 mb-3">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    <span>{{ $guide->rating }}</span>
                                    <span class="mx-2">•</span>
                                    <span>{{ $guide->experience_years }} thn</span>
                                </div>
                                
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="text-lg font-bold text-amber-600">{{ $guide->formatted_discounted_price }}</div>
                                        @if($guide->hasDiscount())
                                        <div class="text-xs text-gray-400 line-through">{{ $guide->formatted_price }}</div>
                                        @endif
                                    </div>
                                    
                                    <a href="/guides/{{ $guide->id }}" 
                                       class="bg-amber-500 hover:bg-amber-600 text-white py-2 px-4 rounded-lg font-medium transition-all duration-300 text-sm">
                                        Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @elseif($variant === 'premium')
                    <!-- Premium Card - Luxury Design -->
                    <div class="guide-card group bg-gradient-to-br from-white via-amber-50/50 to-orange-50 rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-4 overflow-hidden border border-amber-200">
                        <!-- Header with background pattern -->
                        <div class="relative bg-gradient-to-r from-amber-500 to-orange-500 p-6 text-white">
                            <div class="absolute inset-0 bg-black/10"></div>
                            <div class="relative z-10">
                                <div class="flex items-center justify-between mb-4">
                                    <span class="px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-xs font-bold">
                                        {{ $guide->availability }}
                                    </span>
                                    <button onclick="toggleGuideFavorite({{ $guide->id }})" 
                                            class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white/30 transition-all duration-300">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                        </svg>
                                    </button>
                                </div>
                                
                                <div class="flex items-center space-x-4">
                                    <div class="w-16 h-16 rounded-full overflow-hidden ring-4 ring-white/30">
                                        <img src="{{ $guide->main_image_url }}" 
                                             alt="{{ $guide->name }}"
                                             class="w-full h-full object-cover"
                                             onerror="this.src='https://via.placeholder.com/150x150/f59e0b/ffffff?text=Guide'">
                                    </div>
                                    
                                    <div>
                                        <h3 class="text-xl font-bold text-white mb-1">{{ $guide->name }}</h3>
                                        <p class="text-white/90 text-sm font-medium">{{ $guide->specialty }}</p>
                                        <div class="flex items-center text-white/80 text-xs mt-1">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                            <span>{{ $guide->rating }} • {{ $guide->experience_years }} tahun</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Content Area -->
                        <div class="p-6">
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach($guide->languages as $language)
                                <span class="px-2 py-1 bg-amber-100 text-amber-700 rounded-full text-xs font-medium">
                                    {{ $language }}
                                </span>
                                @endforeach
                            </div>
                            
                            <p class="text-gray-600 text-sm mb-6 line-clamp-3 leading-relaxed">
                                {{ Str::limit($guide->description, 120) }}
                            </p>
                            
                            <div class="flex items-center justify-between">
                                <div>
                                    @if($guide->hasDiscount())
                                    <div class="flex items-center space-x-2">
                                        <span class="text-2xl font-bold bg-gradient-to-r from-amber-600 to-orange-600 bg-clip-text text-transparent">
                                            {{ $guide->formatted_discounted_price }}
                                        </span>
                                        <span class="text-sm text-gray-400 line-through">{{ $guide->formatted_price }}</span>
                                    </div>
                                    @else
                                    <div class="text-2xl font-bold bg-gradient-to-r from-amber-600 to-orange-600 bg-clip-text text-transparent">
                                        {{ $guide->formatted_price }}
                                    </div>
                                    @endif
                                    <div class="text-xs text-gray-500">per hari</div>
                                </div>
                                
                                <a href="/guide/{{ $guide->id }}" 
                                   class="bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white py-3 px-6 rounded-xl font-bold transition-all duration-300 transform hover:scale-105 shadow-lg">
                                    Lihat Profil
                                </a>
                            </div>
                        </div>
                    </div>

                    @else
                    <!-- Standard Card -->
                    <div class="guide-card group bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 overflow-hidden border border-amber-100/50">
                        <!-- Image Container -->
                        <div class="relative overflow-hidden">
                            <div class="aspect-[4/3] relative">
                                <img src="{{ $guide->main_image_url }}" 
                                     alt="{{ $guide->name }}"
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                     onerror="this.src='https://via.placeholder.com/400x300/f59e0b/ffffff?text=Guide'">
                            </div>
                            
                            <!-- Overlay Badges -->
                            <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
                                <span class="px-3 py-1.5 {{ $availabilityColor['bg'] }} text-white rounded-full text-xs font-bold shadow-lg backdrop-blur-sm">
                                    {{ $guide->availability }}
                                </span>
                                
                                <button onclick="toggleGuideFavorite({{ $guide->id }})" 
                                        class="w-12 h-12 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg hover:bg-white hover:scale-110 transition-all duration-300 group/fav">
                                    <svg class="w-6 h-6 text-amber-600 group-hover/fav:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </button>
                            </div>
                            
                            <!-- Rating Badge -->
                            <div class="absolute bottom-4 left-4">
                                <div class="flex items-center bg-black/70 backdrop-blur-sm rounded-full px-3 py-1">
                                    <svg class="w-4 h-4 text-yellow-400 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    <span class="text-white text-sm font-medium">{{ $guide->rating }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Card Content -->
                        <div class="p-6">
                            <!-- Guide Name & Specialty -->
                            <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-amber-700 transition-colors">
                                {{ $guide->name }}
                            </h3>
                            <p class="text-amber-600 font-semibold mb-3">{{ $guide->specialty }}</p>
                            
                            <!-- Experience & Languages -->
                            <div class="flex items-center text-sm text-gray-600 mb-4">
                                <svg class="w-4 h-4 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="font-medium">{{ $guide->experience_years }} tahun pengalaman</span>
                            </div>
                            
                            <!-- Languages -->
                            <div class="flex flex-wrap gap-2 mb-4">
                                @foreach($guide->languages as $language)
                                <span class="px-2 py-1 bg-amber-100 text-amber-700 rounded-full text-xs font-medium">
                                    {{ $language }}
                                </span>
                                @endforeach
                            </div>
                            
                            <!-- Description -->
                            <p class="text-gray-600 text-sm mb-6 line-clamp-3 leading-relaxed">
                                {{ Str::limit($guide->description, 120) }}
                            </p>
                            
                            <!-- Price & Action -->
                            <div class="flex items-center justify-between">
                                <div>
                                    @if($guide->hasDiscount())
                                    <div class="flex items-center space-x-2">
                                        <span class="text-xl font-bold text-amber-600">{{ $guide->formatted_discounted_price }}</span>
                                        <span class="text-sm text-gray-400 line-through">{{ $guide->formatted_price }}</span>
                                    </div>
                                    <div class="text-xs text-green-600 font-medium">Hemat {{ $guide->discount_percent }}%</div>
                                    @else
                                    <div class="text-xl font-bold text-amber-600">{{ $guide->formatted_price }}</div>
                                    @endif
                                    <div class="text-xs text-gray-500">per hari</div>
                                </div>
                                
                                <a href="/guide/{{ $guide->id }}" 
                                   class="bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white py-3 px-6 rounded-xl font-bold transition-all duration-300 transform hover:scale-105 shadow-lg group">
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-2 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        Lihat Profil 
                                    </span>
                                </a>
                            </div>
                        </div>

                        <!-- Decorative Border -->
                        <div class="h-2 bg-gradient-to-r from-amber-400 via-orange-400 to-red-400 transform group-hover:scale-x-110 transition-transform duration-500 origin-center"></div>
                    </div>
                    @endif
                    @endforeach
                </div>

                <!-- Enhanced Pagination -->
                @if($guides->hasPages())
                    <div class="mt-20 flex justify-center">
                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-amber-200/50 p-6">
                            <div class="flex items-center justify-center space-x-2">
                                {{ $guides->appends(request()->query())->links('pagination::tailwind') }}
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-800 mb-4">Belum Ada Guide</h3>
                        <p class="text-gray-600 mb-8 leading-relaxed">
                            Maaf, belum ada guide yang tersedia saat ini atau sesuai dengan filter pencarian Anda. 
                            Silakan coba kata kunci lain atau periksa kembali nanti.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="/guides" class="inline-flex items-center bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white px-8 py-4 rounded-xl font-bold transition-all duration-300 transform hover:scale-105 shadow-lg">
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
        .guide-card {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .guide-card:hover {
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
            const form = document.getElementById('guideFilterForm');
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
            updateGuideFavoriteButtons();
        });

        // Enhanced favorite toggle function
        function toggleGuideFavorite(guideId) {
            try {
                const favorites = JSON.parse(localStorage.getItem('guide_favorites') || '[]');
                const index = favorites.indexOf(guideId);
                
                if (index === -1) {
                    favorites.push(guideId);
                    showNotification('👨‍🏫 Guide ditambahkan ke favorit!', 'success');
                } else {
                    favorites.splice(index, 1);
                    showNotification('💔 Guide dihapus dari favorit!', 'info');
                }
                
                localStorage.setItem('guide_favorites', JSON.stringify(favorites));
                updateGuideFavoriteButtons();
            } catch (error) {
                console.error('Error toggling favorite:', error);
                showNotification('❌ Terjadi kesalahan!', 'error');
            }
        }

        // Update favorite button appearances
        function updateGuideFavoriteButtons() {
            const favorites = JSON.parse(localStorage.getItem('guide_favorites') || '[]');
            document.querySelectorAll('[onclick^="toggleGuideFavorite"]').forEach(button => {
                const guideId = parseInt(button.getAttribute('onclick').match(/\d+/)[0]);
                const icon = button.querySelector('svg');
                
                if (favorites.includes(guideId)) {
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

        // Enhanced notification system
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