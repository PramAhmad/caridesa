<x-layouts.tenant>
@if($activeTheme && $activeTheme->activeContents->where('section', 'hero')->first())
    @php $hero = $activeTheme->activeContents->where('section', 'hero')->first(); @endphp
    <!-- Art Theme Hero Section - Budaya & Seni Tradisional -->
    <section class="relative min-h-screen bg-gradient-to-br from-amber-50 via-orange-50 to-red-50 overflow-hidden">
        <!-- Traditional Pattern Background -->
        <div class="absolute inset-0">
            <!-- Batik-inspired patterns -->
            <div class="absolute top-20 left-20 w-32 h-32 bg-gradient-to-r from-amber-400 to-orange-500 rounded-full mix-blend-multiply opacity-30 animate-float"></div>
            <div class="absolute top-40 right-32 w-24 h-24 bg-gradient-to-r from-red-400 to-pink-500 transform rotate-45 mix-blend-multiply opacity-30 animate-float-delayed"></div>
            <div class="absolute bottom-32 left-32 w-40 h-40 bg-gradient-to-r from-orange-400 to-red-500 clip-triangle mix-blend-multiply opacity-30 animate-float-slow"></div>
            
            <!-- Traditional ornament pattern -->
            <div class="absolute inset-0 bg-traditional-pattern opacity-5"></div>
        </div>
        
        <div class="relative z-10 flex items-center min-h-screen px-4">
            <div class="max-w-7xl mx-auto">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <!-- Left Content -->
                    <div class="animate-on-scroll">
                        <div class="inline-block px-4 py-2 bg-amber-100 rounded-full text-sm font-medium text-amber-800 mb-6 border border-amber-200">
                            🎭 Warisan Budaya Nusantara
                        </div>
                        <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight bg-gradient-to-r from-amber-800 via-orange-700 to-red-700 bg-clip-text text-transparent">
                            {{ $hero->title }}
                        </h1>
                        <p class="text-xl text-gray-700 mb-8 leading-relaxed max-w-xl">
                            {!! $hero->content !!}
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 mb-8">
                            <button class="bg-gradient-to-r from-amber-600 to-orange-600 hover:from-amber-700 hover:to-orange-700 text-white px-8 py-4 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                <span class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                    </svg>
                                    Jelajahi Budaya
                                </span>
                            </button>
                            <button class="bg-white hover:bg-amber-50 border-2 border-amber-300 text-amber-700 px-8 py-4 rounded-lg font-semibold transition-all duration-300 shadow-md hover:shadow-lg">
                                <span class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z"></path>
                                    </svg>
                                    Tradisi Lokal
                                </span>
                            </button>
                        </div>
                        
                        <!-- Cultural elements showcase -->
                        <div class="grid grid-cols-3 gap-4">
                            <div class="text-center p-4 bg-white bg-opacity-80 rounded-lg shadow-sm border border-amber-100">
                                <div class="text-2xl font-bold text-amber-600">25+</div>
                                <div class="text-sm text-gray-600">Kerajinan</div>
                            </div>
                            <div class="text-center p-4 bg-white bg-opacity-80 rounded-lg shadow-sm border border-orange-100">
                                <div class="text-2xl font-bold text-orange-600">8+</div>
                                <div class="text-sm text-gray-600">Budaya</div>
                            </div>
                            <div class="text-center p-4 bg-white bg-opacity-80 rounded-lg shadow-sm border border-red-100">
                                <div class="text-2xl font-bold text-red-600">200+</div>
                                <div class="text-sm text-gray-600">Tahun</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Visual -->
                    <div class="animate-on-scroll">
                       @if($hero->image)
                            <div class="relative">
                                <div class="border-8 border-amber-200 rounded-2xl overflow-hidden shadow-2xl transform rotate-2 hover:rotate-0 transition-transform duration-500">
                                    <img src="{{ asset('image/themes/' . $hero->image) }}"
                                         alt="{{ $hero->title }}" 
                                         class="w-full h-96 object-cover"
                                         onerror="this.parentElement.innerHTML='<div class=\'w-full h-96 bg-gradient-to-br from-amber-400 to-red-500 flex items-center justify-center\'><div class=\'text-center text-white\'><svg class=\'w-16 h-16 mx-auto mb-4\' fill=\'currentColor\' viewBox=\'0 0 20 20\'><path d=\'M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z\'/></svg><h4 class=\'text-xl font-bold\'>{{ $hero->title }}</h4></div></div>'">
                                </div>
                                <div class="absolute -top-4 -left-4 w-16 h-16 bg-gradient-to-r from-amber-500 to-orange-500 rounded-full flex items-center justify-center shadow-lg">
                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="absolute -bottom-4 -right-4 w-20 h-20 bg-gradient-to-r from-red-500 to-pink-500 rounded-lg transform rotate-45 opacity-80"></div>
                            </div>
                        @else
                            <!-- Cultural craft illustration -->
                            <div class="relative">
                                <div class="bg-gradient-to-br from-amber-400 to-red-500 rounded-2xl p-8 shadow-2xl transform rotate-2">
                                    <div class="bg-white rounded-xl p-8 text-center">
                                        <svg class="w-24 h-24 mx-auto text-amber-600 mb-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M3 4a1 1 0 011-1h4a1 1 0 010 2H6.414l2.293 2.293a1 1 0 01-1.414 1.414L5 6.414V8a1 1 0 01-2 0V4zm9 1a1 1 0 010-2h4a1 1 0 011 1v4a1 1 0 01-2 0V6.414l-6.293 6.293a1 1 0 01-1.414-1.414L13.586 5H12z"/>
                                    </svg>
                                    <h3 class="text-xl font-bold text-gray-800">Seni & Budaya</h3>
                                    <p class="text-gray-600">Warisan leluhur yang lestari</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

<!-- Produk Kebudayaan Section -->
<section class="py-20 bg-gradient-to-b from-white to-amber-50">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Section Header -->
        <div class="text-center mb-16">
            <div class="inline-block px-4 py-2 bg-amber-100 rounded-full text-sm font-medium text-amber-800 mb-4 border border-amber-200">
                🛍️ Produk Budaya Lokal
            </div>
            <h2 class="text-4xl md:text-5xl font-bold mb-6 bg-gradient-to-r from-amber-800 to-red-700 bg-clip-text text-transparent">
                Kerajinan & Produk Tradisional
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Temukan keindahan hasil karya tangan para pengrajin lokal yang melestarikan warisan budaya nenek moyang
            </p>
        </div>

        <!-- Product Filter -->
        <div class="flex flex-wrap justify-center gap-4 mb-12">
            <button class="filter-btn active px-6 py-3 rounded-full font-medium transition-all duration-300" data-category="all">
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                    Semua Produk
                </span>
            </button>
            @php
                $categories = App\Models\CategoryProduct::active()->withActiveProducts()->take(5)->get();
            @endphp
            @foreach($categories as $category)
            <button class="filter-btn px-6 py-3 rounded-full font-medium transition-all duration-300" data-category="{{ $category->id }}">
                <span class="flex items-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z"></path>
                    </svg>
                    {{ $category->name }}
                </span>
            </button>
            @endforeach
        </div>

        <!-- Products Grid -->
        <div id="products-grid" class="grid grid-cols-1 md:grid-cols-3  gap-8 mb-12">
            @php
                $products = App\Models\Product::active()->with('category')->take(6)->get();
            @endphp
            @foreach($products as $product)
            <div class="product-card bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden border border-amber-100" data-category="{{ $product->category_product_id }}">
                <!-- Product Image -->
                <div class="relative overflow-hidden bg-gradient-to-br from-amber-100 to-orange-100">
                    <div class="aspect-w-4 aspect-h-3">
                        @if($product->image)
                        <img src="{{ asset($product->image) }}" 
                             alt="{{ $product->name }}"
                             class="w-full h-64 object-cover transition-transform duration-500 hover:scale-110">
                        @else
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQinI_44p5jN05YioLyPBhn_1j5tsl7q85rfA&s" 
                             alt="Default Product Image"
                             class="w-full h-64 object-cover transition-transform duration-500 hover:scale-110">
                        @endif
                    </div>
                    
                    <!-- Discount Badge -->
                    @if($product->hasDiscount())
                    <div class="absolute top-4 left-4 bg-gradient-to-r from-red-500 to-pink-500 text-white px-3 py-1 rounded-full text-sm font-bold shadow-lg">
                        -{{ $product->discount }}%
                    </div>
                    @endif
                    
                    <!-- Stock Status -->
                    <div class="absolute top-4 right-4">
                        <span class="px-3 py-1 rounded-full text-xs font-medium text-white bg-amber-500 shadow-lg">
                            {{ $product->stock_label }}
                        </span>
                    </div>
                    
                    <!-- Cultural Pattern Overlay -->
                    <div class="absolute inset-0 bg-traditional-pattern opacity-10 mix-blend-overlay"></div>
                </div>

                <!-- Product Info -->
                <div class="p-6">
                    <!-- Category -->
                    <div class="flex items-center justify-between mb-3">
                        <span class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-xs font-medium border border-amber-200">
                            {{ $product->category->name ?? 'Umum' }}
                        </span>
                        <div class="flex items-center text-amber-500">
                            @for($i = 1; $i <= 5; $i++)
                            <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            @endfor
                        </div>
                    </div>
                    
                    <!-- Product Name -->
                    <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2 hover:text-amber-700 transition-colors">
                        {{ $product->name }}
                    </h3>
                    
                    <!-- Description -->
                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                        {{ Str::limit($product->description, 120) }}
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
                        
                        <!-- Cultural Icon -->
                        <div class="w-10 h-10 bg-gradient-to-r from-amber-400 to-orange-500 rounded-full flex items-center justify-center shadow-md">
                            <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 4a1 1 0 011-1h4a1 1 0 010 2H6.414l2.293 2.293a1 1 0 01-1.414 1.414L5 6.414V8a1 1 0 01-2 0V4zm9 1a1 1 0 010-2h4a1 1 0 011 1v4a1 1 0 01-2 0V6.414l-6.293 6.293a1 1 0 01-1.414-1.414L13.586 5H12z"/>
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Action Button -->
                    <button class="w-full bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white py-3 px-4 rounded-lg font-medium transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg">
                        <span class="flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                            </svg>
                            Lihat Detail
                        </span>
                    </button>
                </div>

                <!-- Traditional border pattern -->
                <div class="h-2 bg-gradient-to-r from-amber-400 via-orange-400 to-red-400"></div>
            </div>
            @endforeach
        </div>

        <!-- View All Button -->
        <div class="text-center">
            <a href="/products" class="inline-flex items-center bg-gradient-to-r from-amber-600 to-red-600 hover:from-amber-700 hover:to-red-700 text-white px-8 py-4 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                Lihat Semua Produk Budaya
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Acara Budaya Section - Elegant Classic Design -->
<section class="py-20 bg-gradient-to-b from-amber-50 to-orange-50 relative overflow-hidden">
    <!-- Decorative Elements -->
    <div class="absolute top-10 left-10 w-20 h-20 bg-amber-300 rounded-full mix-blend-multiply opacity-20 animate-pulse"></div>
    <div class="absolute bottom-20 right-20 w-32 h-32 bg-orange-300 clip-triangle mix-blend-multiply opacity-20 animate-bounce"></div>
    
    <div class="max-w-7xl mx-auto px-4">
        <!-- Section Header -->
        <div class="text-center mb-16 relative">
            <div class="inline-block px-6 py-3 bg-amber-100 rounded-full text-sm font-medium text-amber-800 mb-4 border border-amber-200">
                🎪 Acara & Festival Budaya
            </div>
            <h2 class="text-4xl md:text-5xl font-bold mb-6 bg-gradient-to-r from-amber-800 to-red-700 bg-clip-text text-transparent">
                Perayaan Tradisi Leluhur
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Saksikan kemeriahan acara budaya yang menghidupkan kembali tradisi dan cerita masa lalu
            </p>
        </div>

        <!-- Events Timeline -->
        <div class="relative">
            <!-- Central Timeline Line -->
            <div class="absolute left-1/2 transform -translate-x-1/2 w-1 h-full bg-gradient-to-b from-amber-300 via-orange-400 to-red-400 rounded-full hidden lg:block"></div>
            
            @php
                $events = App\Models\Event::active()->take(4)->get();
            @endphp
            
            <div class="space-y-12">
                @foreach($events as $index => $event)
                <div class="relative">
                    <!-- Timeline Node -->
                    <div class="absolute left-1/2 transform -translate-x-1/2 w-6 h-6 bg-gradient-to-r from-amber-500 to-orange-500 rounded-full border-4 border-white shadow-lg z-10 hidden lg:block"></div>
                    
                    <!-- Event Card -->
                    <div class="grid lg:grid-cols-2 gap-8 items-center {{ $index % 2 == 0 ? '' : 'lg:grid-cols-2' }}">
                        @if($index % 2 == 0)
                        <!-- Left Side - Content -->
                        <div class="order-2 lg:order-1">
                            <div class="event-card bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 hover:rotate-1 border-l-8 border-amber-400">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-amber-500 to-orange-500 rounded-full flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $event->name }}</h3>
                                        <div class="text-amber-600 font-medium flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            {{ $event->start_date ? $event->start_date->format('d M Y') : 'Segera' }}
                                        </div>
                                    </div>
                                </div>
                                
                                <p class="text-gray-600 mb-6 leading-relaxed">
                                    {{ Str::limit($event->description, 150) }}
                                </p>
                                
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center text-sm text-gray-500">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        {{ Str::limit($event->location, 30) }}
                                    </div>
                                    @if($event->is_active)
                                    <div class="text-amber-600 font-bold">
                                        {{ $event->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                    </div>
                                    @endif
                                </div>
                                
                                <button class="w-full bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white py-3 px-4 rounded-xl font-medium transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                    <span class="flex items-center justify-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        Lihat Detail Acara
                                    </span>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Right Side - Image -->
                        <div class="order-1 lg:order-2">
                            <div class="relative">
                                @if($event->main_image_url)
                                <div class="aspect-w-16 aspect-h-10 rounded-3xl overflow-hidden shadow-2xl transform {{ $index % 2 == 0 ? '-rotate-3 hover:rotate-0' : 'rotate-3 hover:rotate-0' }} transition-transform duration-500">
                                    <img src="{{ $event->main_image_url }}" 
                                         alt="{{ $event->name }}"
                                         class="w-full h-80 object-cover">
                                </div>
                                @else
                                <div class="aspect-w-16 aspect-h-10 bg-gradient-to-br from-amber-400 to-orange-500 rounded-3xl flex items-center justify-center shadow-2xl">
                                    <div class="text-center text-white">
                                        <svg class="w-16 h-16 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10z" clip-rule="evenodd"/>
                                        </svg>
                                        <h4 class="text-xl font-bold">{{ $event->name }}</h4>
                                    </div>
                                </div>
                                @endif
                                
                                <!-- Floating Elements -->
                                <div class="absolute -top-4 -right-4 w-12 h-12 bg-gradient-to-r from-amber-400 to-orange-400 rounded-full flex items-center justify-center shadow-lg animate-bounce">
                                    <span class="text-white font-bold text-sm">{{ $index + 1 }}</span>
                                </div>
                            </div>
                        </div>
                        @else
                        <!-- Reverse Layout -->
                        <div class="order-2 lg:order-2">
                            <div class="relative">
                                @if($event->main_image_url)
                                <div class="aspect-w-16 aspect-h-10 rounded-3xl overflow-hidden shadow-2xl transform rotate-3 hover:rotate-0 transition-transform duration-500">
                                    <img src="{{ $event->main_image_url }}" 
                                         alt="{{ $event->name }}"
                                         class="w-full h-80 object-cover">
                                </div>
                                @else
                                <div class="aspect-w-16 aspect-h-10 bg-gradient-to-br from-amber-400 to-orange-500 rounded-3xl flex items-center justify-center shadow-2xl">
                                    <div class="text-center text-white">
                                        <svg class="w-16 h-16 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10z" clip-rule="evenodd"/>
                                        </svg>
                                        <h4 class="text-xl font-bold">{{ $event->name }}</h4>
                                    </div>
                                </div>
                                @endif
                                
                                <div class="absolute -top-4 -left-4 w-12 h-12 bg-gradient-to-r from-amber-400 to-orange-400 rounded-full flex items-center justify-center shadow-lg animate-bounce">
                                    <span class="text-white font-bold text-sm">{{ $index + 1 }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="order-1 lg:order-1">
                            <div class="event-card bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 hover:-rotate-1 border-r-8 border-orange-400">
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-r from-orange-500 to-red-500 rounded-full flex items-center justify-center mr-4">
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ $event->name }}</h3>
                                        <div class="text-orange-600 font-medium flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                            {{ $event->start_date ? $event->start_date->format('d M Y') : 'Segera' }}
                                        </div>
                                    </div>
                                </div>
                                
                                <p class="text-gray-600 mb-6 leading-relaxed">
                                    {{ Str::limit($event->description, 150) }}
                                </p>
                                
                                <div class="flex items-center justify-between mb-4">
                                    <div class="flex items-center text-sm text-gray-500">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        {{ Str::limit($event->location, 30) }}
                                    </div>
                                    @if($event->price > 0)
                                    <div class="text-orange-600 font-bold">
                                        {{ $event->formatted_price }}
                                    </div>
                                    @else
                                    <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm font-medium">
                                        GRATIS
                                    </span>
                                    @endif
                                </div>
                                
                                <button class="w-full bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white py-3 px-4 rounded-xl font-medium transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                    <span class="flex items-center justify-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        Lihat Detail Acara
                                    </span>
                                </button>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- View All Events Button -->
        <div class="text-center mt-16">
            <a href="/events" class="inline-flex items-center bg-gradient-to-r from-amber-600 to-red-600 hover:from-amber-700 hover:to-red-700 text-white px-10 py-4 rounded-2xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Jelajahi Semua Acara Budaya
                <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Pemandu Wisata Section - Classic Card Design -->
<section class="py-20 bg-gradient-to-b from-orange-50 to-red-50 relative overflow-hidden">
    <!-- Floating Elements -->
    <div class="absolute top-20 left-20 w-16 h-16 bg-amber-300 rounded-2xl transform rotate-45 mix-blend-multiply opacity-30 animate-spin-slow"></div>
    <div class="absolute bottom-20 right-20 w-24 h-24 bg-orange-300 rounded-full mix-blend-multiply opacity-30 animate-ping"></div>

    <div class="max-w-7xl mx-auto px-4">
        <!-- Section Header -->
        <div class="text-center mb-16 relative">
            <div class="inline-block px-6 py-3 bg-amber-100 rounded-full text-sm font-medium text-amber-800 mb-4 border border-amber-200">
                🧭 Pemandu Wisata Lokal
            </div>
            <h2 class="text-4xl md:text-5xl font-bold mb-6 bg-gradient-to-r from-amber-800 to-red-700 bg-clip-text text-transparent">
                Jelajahi Dengan Ahlinya
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Temukan pengalaman tak terlupakan bersama pemandu lokal yang berpengalaman dan ramah
            </p>
        </div>

        <!-- Guide Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3  gap-8 mb-12">
            @php
                $guides = App\Models\Guide::active()->take(6)->get();
            @endphp
            @foreach($guides as $guide)
            <div class="guide-card bg-white rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-4 overflow-hidden border-t-8 border-amber-400 relative group">
                <!-- Guide Avatar -->
                <div class="relative p-8 bg-gradient-to-br from-amber-100 to-orange-100">
                    <div class="relative z-10">
                        @if($guide->main_image_url)
                        <div class="w-32 h-32 mx-auto rounded-full overflow-hidden border-6 border-white shadow-xl transform group-hover:scale-110 transition-transform duration-500">
                            <img src="{{ $guide->main_image_url }}" 
                                 alt="{{ $guide->name }}"
                                 class="w-full h-full object-cover">
                        </div>
                        @else
                        <div class="w-32 h-32 mx-auto rounded-full bg-gradient-to-br from-amber-400 to-orange-500 flex items-center justify-center border-6 border-white shadow-xl transform group-hover:scale-110 transition-transform duration-500">
                            <svg class="w-16 h-16 text-white" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        @endif
                        
                        <!-- Status Badge -->
                        <div class="absolute top-2 right-2">
                            <span class="px-3 py-1 bg-green-500 text-white rounded-full text-xs font-bold shadow-lg animate-pulse">
                                ONLINE
                            </span>
                        </div>
                        
                        <!-- Rating Stars -->
                        <div class="flex justify-center mt-4">
                            @for($i = 1; $i <= 5; $i++)
                            <svg class="w-5 h-5 text-amber-400 fill-current" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                            </svg>
                            @endfor
                            <span class="ml-2 text-sm text-gray-600">(4.9)</span>
                        </div>
                    </div>
                    
                    <!-- Background Pattern -->
                    <div class="absolute inset-0 bg-traditional-pattern opacity-10"></div>
                </div>

                <!-- Guide Info -->
                <div class="p-6">
                    <div class="text-center mb-4">
                        <h3 class="text-2xl font-bold text-gray-800 mb-2 group-hover:text-amber-700 transition-colors">
                            {{ $guide->name }}
                        </h3>
                        <p class="text-amber-600 font-medium flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            {{ Str::limit($guide->address, 25) }}
                        </p>
                    </div>
                    
                    <p class="text-gray-600 text-sm mb-6 text-center leading-relaxed">
                        {{ Str::limit($guide->description, 100) }}
                    </p>
                    
                    <!-- Skills/Languages -->
                    <div class="flex flex-wrap justify-center gap-2 mb-6">
                        <span class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-xs font-medium">
                            Bahasa Indonesia
                        </span>
                        <span class="px-3 py-1 bg-orange-100 text-orange-700 rounded-full text-xs font-medium">
                            English
                        </span>
                        <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-medium">
                            Lokal Guide
                        </span>
                    </div>
                    
                    <!-- Pricing -->
                    <div class="text-center mb-6">
                        @if($guide->hasDiscount())
                        <div class="text-sm text-gray-400 line-through">{{ $guide->formatted_price }}/hari</div>
                        <div class="text-2xl font-bold text-amber-600">{{ $guide->formatted_discounted_price }}/hari</div>
                        <div class="text-xs text-green-600 font-medium">
                            Hemat {{ $guide->discount_percent }}%!
                        </div>
                        @else
                        <div class="text-2xl font-bold text-amber-600">{{ $guide->formatted_price }}/hari</div>
                        @endif
                    </div>
                    
                    <!-- Contact Buttons -->
                    <div class="grid grid-cols-2 gap-3">
                        <button class="bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white py-3 px-4 rounded-xl font-medium transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg text-sm">
                            <span class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                </svg>
                                Chat
                            </span>
                        </button>
                        <a href="/guide/{{ $guide->id }}" class="bg-white border-2 border-amber-300 text-amber-700 hover:bg-amber-50 py-3 px-4 rounded-xl font-medium transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg text-sm">
                            <span class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Detail
                            </span>
                        </a>
                    </div>
                </div>

                <!-- Decorative Bottom Border -->
                <div class="h-3 bg-gradient-to-r from-amber-400 via-orange-400 to-red-400 transform group-hover:scale-x-110 transition-transform duration-500 origin-center"></div>
            </div>
            @endforeach
        </div>

        <!-- View All Guides Button -->
        <div class="text-center">
            <a href="/guides" class="inline-flex items-center bg-gradient-to-r from-amber-600 to-red-600 hover:from-amber-700 hover:to-red-700 text-white px-10 py-4 rounded-2xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                Temukan Pemandu Terbaik
                <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Destinasi Wisata Section - Classic Grid Design -->
<section class="py-20 bg-gradient-to-b from-red-50 to-amber-50 relative overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="absolute top-10 right-10 w-40 h-40 bg-amber-200 rounded-full mix-blend-multiply opacity-20 animate-blob"></div>
    <div class="absolute bottom-10 left-10 w-32 h-32 bg-orange-200 rounded-full mix-blend-multiply opacity-20 animate-blob animation-delay-2000"></div>
    <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-20 h-20 bg-red-200 rounded-full mix-blend-multiply opacity-20 animate-blob animation-delay-4000"></div>

    <div class="max-w-7xl mx-auto px-4">
        <!-- Section Header -->
        <div class="text-center mb-16 relative">
            <div class="inline-block px-6 py-3 bg-amber-100 rounded-full text-sm font-medium text-amber-800 mb-4 border border-amber-200">
                🏔️ Destinasi Wisata Unggulan
            </div>
            <h2 class="text-4xl md:text-5xl font-bold mb-6 bg-gradient-to-r from-amber-800 to-red-700 bg-clip-text text-transparent">
                Keajaiban Alam & Budaya
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Jelajahi keindahan destinasi wisata yang menawarkan pengalaman tak terlupakan di setiap sudutnya
            </p>
        </div>

        <!-- Destination Categories Filter -->
        <div class="flex flex-wrap justify-center gap-4 mb-12">
            <button class="destination-filter-btn active px-6 py-3 rounded-full font-medium transition-all duration-300" data-category="all">
                🗺️ Semua Destinasi
            </button>
            <button class="destination-filter-btn px-6 py-3 rounded-full font-medium transition-all duration-300" data-category="alam">
                🌿 Wisata Alam
            </button>
            <button class="destination-filter-btn px-6 py-3 rounded-full font-medium transition-all duration-300" data-category="budaya">
                🏛️ Wisata Budaya
            </button>
            <button class="destination-filter-btn px-6 py-3 rounded-full font-medium transition-all duration-300" data-category="religi">
                🕌 Wisata Religi
            </button>
            <button class="destination-filter-btn px-6 py-3 rounded-full font-medium transition-all duration-300" data-category="kuliner">
                🍜 Wisata Kuliner
            </button>
        </div>

        <!-- Destinations Classic Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12" id="destinations-grid">
            @php
                $destinations = App\Models\Wisata::take(9)->get();
                $heights = ['h-80', 'h-96', 'h-72', 'h-88', 'h-80', 'h-96', 'h-72', 'h-88', 'h-80'];
            @endphp
            @foreach($destinations as $index => $destination)
            <div class="destination-card {{ $heights[$index % count($heights)] }} relative group overflow-hidden rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-category="{{ strtolower($destination->category ?? 'alam') }}">
                <!-- Background Image -->
                <div class="absolute inset-0">
                    @if($destination->image_one)
                    <img src="{{ asset( $destination->image_one->name) }}" 
                         alt="{{ $destination->name }}"
                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    @else
                    <div class="w-full h-full bg-gradient-to-br from-amber-400 via-orange-500 to-red-600"></div>
                    @endif
                    
                    <!-- Overlay Gradients -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent group-hover:from-black/90 transition-all duration-500"></div>
                    <div class="absolute inset-0 bg-gradient-to-br from-amber-900/20 to-transparent mix-blend-multiply"></div>
                </div>

                <!-- Content -->
                <div class="absolute inset-0 p-6 flex flex-col justify-between">
                    <!-- Top Content -->
                    <div class="flex justify-between items-start">
                        <!-- Category Badge -->
                        <span class="px-3 py-1 bg-white/20 backdrop-blur-sm text-white rounded-full text-xs font-medium border border-white/30">
                            {{ ucfirst($destination->category->name ?? 'Wisata Alam') }}
                        </span>
                        
                        <!-- Favorite Button -->
                        <button class="w-10 h-10 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/30 hover:bg-white/30 transition-all duration-300 group/fav">
                            <svg class="w-5 h-5 text-white group-hover/fav:text-red-400 transition-colors" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.828a4 4 0 010-5.656z" clip-rule="evenodd"/>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Bottom Content -->
                    <div>
                        <!-- Destination Name -->
                        <h3 class="text-2xl font-bold text-white mb-2 line-clamp-2">
                            {{ $destination->name }}
                        </h3>
                        
                        <!-- Description -->
                        <p class="text-white/80 text-sm mb-4 line-clamp-2">
                            {{ Str::limit($destination->description, 80) }}
                        </p>
                        
                        <!-- Location & Rating -->
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center text-white/70 text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ Str::limit($destination->address, 20) }}
                            </div>
                            <div class="flex items-center text-amber-400">
                                <svg class="w-4 h-4 fill-current mr-1" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <span class="text-sm font-medium">4.8</span>
                            </div>
                        </div>
                        
                        <!-- Action Button -->
                        <a href="/wisata/{{ $destination->id }}" class="w-full bg-gradient-to-r from-amber-500/90 to-orange-500/90 hover:from-amber-600 hover:to-orange-600 backdrop-blur-sm text-white py-3 px-4 rounded-xl font-medium transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl border border-white/20">
                            <span class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Jelajahi
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- View All Destinations Button -->
        <div class="text-center">
            <a href="/wisatas" class="inline-flex items-center bg-gradient-to-r from-amber-600 to-red-600 hover:from-amber-700 hover:to-red-700 text-white px-10 py-4 rounded-2xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                Temukan Destinasi Impian
                <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>
    </div>
</section>
<!-- Homestay Section - Traditional Lodge Design -->
<section class="py-20 bg-gradient-to-b from-amber-50 to-white relative overflow-hidden">
    <!-- Background Decorative Elements -->
    <div class="absolute top-16 left-16 w-24 h-24 bg-amber-200 rounded-full mix-blend-multiply opacity-30 animate-pulse"></div>
    <div class="absolute bottom-16 right-16 w-32 h-32 bg-orange-200 transform rotate-45 mix-blend-multiply opacity-30 animate-bounce"></div>
    <div class="absolute top-1/3 right-1/4 w-16 h-16 bg-red-200 rounded-full mix-blend-multiply opacity-30 animate-ping"></div>

    <div class="max-w-7xl mx-auto px-4">
        <!-- Section Header -->
        <div class="text-center mb-16 relative">
            <div class="inline-block px-6 py-3 bg-amber-100 rounded-full text-sm font-medium text-amber-800 mb-4 border border-amber-200">
                🏠 Homestay Tradisional
            </div>
            <h2 class="text-4xl md:text-5xl font-bold mb-6 bg-gradient-to-r from-amber-800 to-red-700 bg-clip-text text-transparent">
                Rasakan Kehangatan Rumah Tradisional
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Nikmati pengalaman menginap autentik di rumah-rumah tradisional yang penuh dengan cerita dan keramahan lokal
            </p>
        </div>

        <!-- Homestay Types Filter -->
        <div class="flex flex-wrap justify-center gap-4 mb-12">
            <button class="homestay-filter-btn active px-6 py-3 rounded-full font-medium transition-all duration-300" data-type="all">
                🏘️ Semua Homestay
            </button>
            <button class="homestay-filter-btn px-6 py-3 rounded-full font-medium transition-all duration-300" data-type="tradisional">
                🏛️ Rumah Tradisional
            </button>
            <button class="homestay-filter-btn px-6 py-3 rounded-full font-medium transition-all duration-300" data-type="modern">
                🏡 Modern Rustic
            </button>
            <button class="homestay-filter-btn px-6 py-3 rounded-full font-medium transition-all duration-300" data-type="vila">
                🏕️ Vila Alam
            </button>
        </div>

        <!-- Homestay Grid (Fixed Layout) -->
        <div class="grid grid-cols-1 md:grid-cols-3  gap-6 mb-12" id="homestay-grid">
            @foreach($homestays as $index => $homestay)
            @php
                // Simulasi tipe homestay berdasarkan index
                $types = ['tradisional', 'modern', 'vila'];
                $homestayType = $types[$index % 3];
                
                // Generate amenities sesuai tipe
                $amenitiesByType = [
                    'tradisional' => ['WiFi', 'AC', 'Sarapan', 'Parkir'],
                    'modern' => ['WiFi', 'Dapur', 'Taman', 'Sepeda'],
                    'vila' => ['Pool', 'WiFi', 'AC', 'Chef']
                ];
                $amenities = $amenitiesByType[$homestayType];
                
                // Generate rating
                $rating = rand(45, 50) / 10; // 4.5 - 5.0
            @endphp
            
            <div class="homestay-card bg-white rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 overflow-hidden border-l-8 border-amber-400 group" data-type="{{ $homestayType }}">
                <!-- Homestay Image -->
                <div class="relative overflow-hidden h-64">
                    @if($homestay->main_image_url && $homestay->main_image_url !== asset('tenant/images/placeholder-homestay.jpg'))
                        <img src="{{ $homestay->main_image_url }}" 
                             alt="{{ $homestay->name }}"
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-amber-300 via-orange-400 to-red-500 relative">
                            <!-- Placeholder Design -->
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="text-center text-white">
                                    <svg class="w-16 h-16 mx-auto mb-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                                    </svg>
                                    <h4 class="text-lg font-bold">{{ Str::limit($homestay->name, 20) }}</h4>
                                </div>
                            </div>
                            
                            <!-- Overlay Gradients -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent group-hover:from-black/70 transition-all duration-500"></div>
                        </div>
                    @endif
                    
                    <!-- Top Badges -->
                    <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
                        <span class="px-3 py-1 bg-white/20 backdrop-blur-sm text-white rounded-full text-xs font-medium border border-white/30">
                            {{ ucfirst($homestayType) }}
                        </span>
                        <div class="flex gap-2">
                            <span class="px-2 py-1 bg-amber-500/90 backdrop-blur-sm text-white rounded-full text-xs font-bold">
                                ⭐ {{ $rating }}
                            </span>
                            <button class="w-8 h-8 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/30 hover:bg-white/30 transition-all duration-300">
                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.828a4 4 0 010-5.656z" clip-rule="evenodd"/>
                            </svg>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Bottom Image Info -->
                    <div class="absolute bottom-4 left-4 right-4">
                        <div class="flex items-center text-white/80 text-sm mb-2">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                {{ Str::limit($homestay->address, 25) }}
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="text-white">
                                @if($homestay->has_discount)
                                    <div class="text-sm line-through opacity-70">{{ $homestay->formatted_price }}</div>
                                    <div class="text-lg font-bold">{{ $homestay->formatted_discounted_price }}</div>
                                @else
                                    <div class="text-lg font-bold">{{ $homestay->formatted_price }}</div>
                                @endif
                                <div class="text-xs opacity-80">per malam</div>
                            </div>
                            <div class="flex items-center text-white/70 text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3  0 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                {{ rand(2, 8) }} tamu
                            </div>
                        </div>
                    </div>
                    
                    <!-- Traditional Pattern Overlay -->
                    <div class="absolute inset-0 bg-traditional-pattern opacity-10 mix-blend-overlay"></div>
                </div>

                <!-- Homestay Content -->
                <div class="p-6">
                    <!-- Title & Quick Info -->
                    <div class="mb-4">
                        <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-amber-700 transition-colors">
                            {{ $homestay->name }}
                        </h3>
                        <p class="text-gray-600 text-sm leading-relaxed mb-3">
                            {{ Str::limit($homestay->description, 120) }}
                        </p>
                        
                        <!-- Room & Guest Info -->
                        <div class="flex items-center gap-4 text-sm text-gray-500 mb-3">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v4H8V5z"></path>
                                </svg>
                                {{ rand(1, 4) }} kamar
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                </svg>
                                {{ $homestayType === 'vila' ? 'Villa' : ($homestayType === 'modern' ? 'Modern' : 'Tradisional') }}
                            </div>
                        </div>
                    </div>
                    
                    <!-- Amenities -->
                    <div class="mb-6">
                        <div class="flex flex-wrap gap-2">
                            @foreach($amenities as $amenity)
                            <span class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-xs font-medium border border-amber-200">
                                {{ $amenity }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Contact Info -->
                    @if($homestay->contact_info)
                    <div class="mb-4 text-sm text-gray-600">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            {{ $homestay->phone ?? 'Hubungi untuk info' }}
                        </div>
                    </div>
                    @endif
                    
                    <!-- Action Buttons -->
                    <div class="grid grid-cols-2 gap-3">
                        @if($homestay->whatsapp_url)
                        <a href="{{ $homestay->whatsapp_url }}" target="_blank" class="bg-gradient-to-r from-green-500 to-green-600 hover:from-green-600 hover:to-green-700 text-white py-3 px-4 rounded-xl font-medium transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg text-sm">
                            <span class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                WhatsApp
                            </span>
                        </a>
                        @else
                        <button class="bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white py-3 px-4 rounded-xl font-medium transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg text-sm">
                            <span class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Booking
                            </span>
                        </button>
                        @endif

                        <a href="/homestays/{{ $homestay->id }}" class="bg-white border-2 border-amber-300 text-amber-700 hover:bg-amber-50 py-3 px-4 rounded-xl font-medium transition-all duration-300 transform hover:scale-105 shadow-md hover:shadow-lg text-sm">
                            <span class="flex items-center justify-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Detail
                            </span>
            </a>
                    </div>
                </div>

                <!-- Discount Badge (if applicable) -->
                @if($homestay->has_discount)
                <div class="absolute top-2 right-2 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-bold">
                    -{{ $homestay->discount_percent }}%
                </div>
                @endif

                <!-- Traditional Bottom Border -->
                <div class="h-3 bg-gradient-to-r from-amber-400 via-orange-400 to-red-400 transform group-hover:scale-x-110 transition-transform duration-500 origin-center"></div>
            </div>
            @endforeach
        </div>

        <!-- View All Homestays Button -->
        <div class="text-center">
            <a href="/homestays" class="inline-flex items-center bg-gradient-to-r from-amber-600 to-red-600 hover:from-amber-700 hover:to-red-700 text-white px-10 py-4 rounded-2xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-xl hover:shadow-2xl">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v4H8V5z"></path>
                </svg>
                Jelajahi Semua Homestay
                <svg class="w-5 h-5 ml-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>
    </div>
</section>

<!-- Contact Section - Traditional Design -->
<section id="contact" class="py-20 bg-gradient-to-b from-white to-amber-50 relative overflow-hidden">
    <!-- Background Decorative Elements -->
    <div class="absolute top-20 left-20 w-32 h-32 bg-amber-200 rounded-full mix-blend-multiply opacity-20 animate-pulse"></div>
    <div class="absolute bottom-20 right-20 w-24 h-24 bg-orange-200 transform rotate-45 mix-blend-multiply opacity-20 animate-bounce"></div>
    <div class="absolute top-1/2 left-1/4 w-16 h-16 bg-red-200 rounded-full mix-blend-multiply opacity-20 animate-ping"></div>

    <div class="max-w-7xl mx-auto px-4">
        <!-- Section Header -->
        <div class="text-center mb-16 relative">
            <div class="inline-block px-6 py-3 bg-amber-100 rounded-full text-sm font-medium text-amber-800 mb-4 border border-amber-200">
                📞 Hubungi Kami
            </div>
            <h2 class="text-4xl md:text-5xl font-bold mb-6 bg-gradient-to-r from-amber-800 to-red-700 bg-clip-text text-transparent">
                Mari Berinteraksi
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Kami siap membantu dan menjawab pertanyaan Anda. Jangan ragu untuk menghubungi kami kapan saja
            </p>
        </div>

        <div class="grid lg:grid-cols-2 gap-12 items-start">
            <!-- Contact Information -->
            <div class="space-y-8">
                <!-- Contact Cards -->
                <div class="space-y-6">
                    <!-- Address Card -->
                    <div class="bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border-l-8 border-amber-400">
                        <div class="flex items-start">
                            <div class="w-16 h-16 bg-gradient-to-r from-amber-500 to-orange-500 rounded-full flex items-center justify-center mr-6 flex-shrink-0">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800 mb-3">Alamat Kantor</h3>
                                <p class="text-gray-600 leading-relaxed">
                                    Jl. Raya Desa No. 123<br>
                                    Kecamatan Sukamaju<br>
                                    Kabupaten Makmur 12345<br>
                                    Jawa Barat, Indonesia
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Phone Card -->
                    <div class="bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border-l-8 border-orange-400">
                        <div class="flex items-start">
                            <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-red-500 rounded-full flex items-center justify-center mr-6 flex-shrink-0">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800 mb-3">Telepon & WhatsApp</h3>
                                <div class="space-y-2">
                                    <div class="flex items-center">
                                        <span class="text-gray-600 mr-3">Telepon:</span>
                                        <a href="tel:+6282113372046" class="text-orange-600 font-semibold hover:text-orange-700 transition-colors">
                                            +62 821 1337 2046
                                        </a>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-gray-600 mr-3">WhatsApp:</span>
                                        <a href="https://wa.me/6282113372046" target="_blank" class="text-green-600 font-semibold hover:text-green-700 transition-colors">
                                            +62 821 1337 2046
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Email Card -->
                    <div class="bg-white rounded-3xl p-8 shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border-l-8 border-red-400">
                        <div class="flex items-start">
                            <div class="w-16 h-16 bg-gradient-to-r from-red-500 to-pink-500 rounded-full flex items-center justify-center mr-6 flex-shrink-0">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-2xl font-bold text-gray-800 mb-3">Email</h3>
                                <div class="space-y-2">
                                    <div class="flex items-center">
                                        <span class="text-gray-600 mr-3">Umum:</span>
                                        <a href="mailto:info@desaku.id" class="text-red-600 font-semibold hover:text-red-700 transition-colors">
                                            info@desaku.id
                                        </a>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-gray-600 mr-3">Admin:</span>
                                        <a href="mailto:admin@desaku.id" class="text-red-600 font-semibold hover:text-red-700 transition-colors">
                                            admin@desaku.id
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Social Media -->
                <div class="bg-gradient-to-r from-amber-400 to-red-500 rounded-3xl p-8 text-white">
                    <h3 class="text-2xl font-bold mb-6 text-center">Ikuti Media Sosial Kami</h3>
                    <div class="flex justify-center space-x-6">
                        <a href="#" class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white/30 transition-all duration-300 transform hover:scale-110">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white/30 transition-all duration-300 transform hover:scale-110">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white/30 transition-all duration-300 transform hover:scale-110">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.174-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.402.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.357-.629-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24.009 12.017 24.009c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z"/>
                            </svg>
                        </a>
                        <a href="#" class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white/30 transition-all duration-300 transform hover:scale-110">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91S17.5 2 12.04 2zm.01 18.05c-1.48 0-2.93-.4-4.2-1.15l-.3-.18-3.12.82.83-3.04-.2-.31c-.8-1.31-1.23-2.83-1.23-4.42 0-4.54 3.7-8.24 8.24-8.24s8.24 3.7 8.24 8.24-3.7 8.28-8.26 8.28z"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="bg-white rounded-3xl shadow-2xl p-8 border-t-8 border-amber-400">
                <div class="mb-8">
                    <h3 class="text-3xl font-bold text-gray-800 mb-4">Kirim Pesan</h3>
                    <p class="text-gray-600">Sampaikan pertanyaan, saran, atau keluhan Anda. Kami akan merespon dengan cepat.</p>
                </div>

                <!-- Contact Form -->
                <form id="tenant-contact-form" class="space-y-6">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="form-group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="name" 
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition-all duration-300" 
                                   placeholder="Masukkan nama lengkap Anda"
                                   required />
                            <div class="error-message text-red-500 text-sm mt-1 hidden" id="name-error"></div>
                        </div>
                        
                        <div class="form-group">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" 
                                   name="email" 
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition-all duration-300" 
                                   placeholder="nama@email.com"
                                   required />
                            <div class="error-message text-red-500 text-sm mt-1 hidden" id="email-error"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Nomor WhatsApp
                        </label>
                        <input type="tel" 
                               name="phone" 
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition-all duration-300" 
                               placeholder="+62 812 3456 7890" />
                        <div class="error-message text-red-500 text-sm mt-1 hidden" id="phone-error"></div>
                    </div>

                    <div class="form-group">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Subjek
                        </label>
                        <input type="text" 
                               name="subject" 
                               class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition-all duration-300" 
                               placeholder="Subjek pesan Anda" />
                        <div class="error-message text-red-500 text-sm mt-1 hidden" id="subject-error"></div>
                    </div>
                    
                    <div class="form-group">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            Pesan <span class="text-red-500">*</span>
                        </label>
                        <textarea rows="6" 
                                  name="message" 
                                  class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-amber-500 focus:ring-2 focus:ring-amber-200 transition-all duration-300 resize-none" 
                                  placeholder="Tulis pesan Anda di sini..." 
                                  required></textarea>
                        <div class="error-message text-red-500 text-sm mt-1 hidden" id="message-error"></div>
                        <div class="text-sm text-gray-500 mt-1">
                            <span id="char-count">0</span>/1000 karakter
                        </div>
                    </div>
                    
                    <!-- Privacy Notice -->
                    <div class="bg-amber-50 border border-amber-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-amber-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            <div>
                                <h4 class="text-sm font-semibold text-amber-800 mb-1">Privasi Terjamin</h4>
                                <p class="text-sm text-amber-700">Data pribadi Anda akan kami jaga kerahasiaannya dan hanya digunakan untuk keperluan komunikasi.</p>
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white py-4 px-6 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl" 
                            id="submit-btn">
                        <span class="btn-text flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            Kirim Pesan
                        </span>
                        <span class="btn-loading hidden">
                            <svg class="animate-spin w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Mengirim...
                        </span>
                    </button>
                </form>

                <!-- Success/Error Messages -->
                <div id="form-messages" class="mt-6 hidden">
                    <div id="success-message" class="hidden p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span id="success-text"></span>
                        </div>
                    </div>
                    
                    <div id="error-message" class="hidden p-4 bg-red-100 border border-red-300 text-red-700 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span id="error-text"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    
    @keyframes float-slow {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-15px) rotate(3deg); }
    }
    
    @keyframes blob {
        0%, 100% { transform: translateY(0px) scale(1); }
        33% { transform: translateY(-30px) scale(1.1); }
        66% { transform: translateY(20px) scale(0.9); }
    }
    
    @keyframes spin-slow {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    .animate-float { animation: float 6s ease-in-out infinite; }
    .animate-float-delayed { animation: float-delayed 8s ease-in-out infinite; }
    .animate-float-slow { animation: float-slow 10s ease-in-out infinite; }
    .animate-blob { animation: blob 7s ease-in-out infinite; }
    .animate-spin-slow { animation: spin-slow 20s linear infinite; }
    .animation-delay-2000 { animation-delay: 2s; }
    .animation-delay-4000 { animation-delay: 4s; }
    
    /* Clip Path Classes */
    .clip-triangle {
        clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
    }
    
    /* Filter Button Styles */
    .filter-btn, .destination-filter-btn, .homestay-filter-btn {
        background: white;
        color: #6b7280;
        border: 2px solid #e5e7eb;
    }
    
    .filter-btn.active, .destination-filter-btn.active, .homestay-filter-btn.active {
        background: linear-gradient(to right, #f59e0b, #ea580c);
        color: white;
        border-color: #f59e0b;
        box-shadow: 0 4px 14px 0 rgba(245, 158, 11, 0.39);
    }
    
    .filter-btn:hover, .destination-filter-btn:hover, .homestay-filter-btn:hover {
        border-color: #f59e0b;
        background: #fef3c7;
        color: #92400e;
    }
    
    /* Card Hover Effects */
    .product-card:hover, .guide-card:hover, .destination-card:hover, .homestay-card:hover {
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    
    /* Responsive Utilities */
    @media (max-width: 768px) {
        .animate-on-scroll {
            animation: none;
        }
        
        .lg\:grid-cols-2 {
            grid-template-columns: 1fr;
        }
        
        .lg\:grid-cols-3 {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    /* Text Utilities */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
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
    
    /* Gradient Text */
    .bg-gradient-to-r {
        background: linear-gradient(to right, var(--tw-gradient-stops));
    }
    .bg-clip-text {
        -webkit-background-clip: text;
        background-clip: text;
    }
    .text-transparent {
        color: transparent;
    }
    
    /* Form Styles */
    .form-group input:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #f59e0b;
        box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
    }
    
    /* Button Loading State */
    .btn-loading svg {
        animation: spin 1s linear infinite;
    }
    
    /* Smooth Scrolling */
    html {
        scroll-behavior: smooth;
    }
    
    /* Image Aspect Ratio */
    .aspect-w-4 {
        position: relative;
        padding-bottom: calc(3 / 4 * 100%);
    }
    .aspect-w-4 > * {
        position: absolute;
        height: 100%;
        width: 100%;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
    }
    .aspect-w-16 {
        position: relative;
        padding-bottom: calc(10 / 16 * 100%);
    }
    .aspect-w-16 > * {
        position: absolute;
        height: 100%;
        width: 100%;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
    }
    
    /* Backdrop Blur */
    .backdrop-blur-sm {
        backdrop-filter: blur(4px);
    }
    
    /* Mix Blend Mode */
    .mix-blend-multiply {
        mix-blend-mode: multiply;
    }
    .mix-blend-overlay {
        mix-blend-mode: overlay;
    }
    
    /* Custom Heights */
    .h-72 { height: 18rem; }
    .h-80 { height: 20rem; }
    .h-88 { height: 22rem; }
    .h-96 { height: 24rem; }
    
    /* Scroll Snap */
    .snap-x {
        scroll-snap-type: x mandatory;
    }
    .snap-center {
        scroll-snap-align: center;
    }
    
    /* Custom Scrollbar */
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Smooth scrolling untuk anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
    
    // Product Filter Functionality
    const productFilterBtns = document.querySelectorAll('.filter-btn');
    const productCards = document.querySelectorAll('.product-card');
    
    productFilterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const category = this.dataset.category;
            
            // Update active button
            productFilterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Filter products
            productCards.forEach(card => {
                if (category === 'all' || card.dataset.category === category) {
                    card.style.display = 'block';
                    card.style.animation = 'fadeIn 0.5s ease-in-out';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
    
    // Destination Filter Functionality
    const destinationFilterBtns = document.querySelectorAll('.destination-filter-btn');
    const destinationCards = document.querySelectorAll('.destination-card');
    
    destinationFilterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const category = this.dataset.category;
            
            // Update active button
            destinationFilterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Filter destinations
            destinationCards.forEach(card => {
                if (category === 'all' || card.dataset.category === category) {
                    card.style.display = 'block';
                    card.style.animation = 'fadeIn 0.5s ease-in-out';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
    
    // Homestay Filter Functionality
    const homestayFilterBtns = document.querySelectorAll('.homestay-filter-btn');
    const homestayCards = document.querySelectorAll('.homestay-card');
    
    homestayFilterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const type = this.dataset.type;
            
            // Update active button
            homestayFilterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Filter homestays
            homestayCards.forEach(card => {
                if (type === 'all' || card.dataset.type === type) {
                    card.style.display = 'block';
                    card.style.animation = 'fadeIn 0.5s ease-in-out';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
    
    // Lazy Loading for Images
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.remove('lazy');
                observer.unobserve(img);
            }
        });
    });
    
    document.querySelectorAll('img[data-src]').forEach(img => {
        imageObserver.observe(img);
    });
    
    // Scroll Animation
    const animatedElements = document.querySelectorAll('.animate-on-scroll');
    const scrollObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.animation = 'fadeInUp 0.8s ease-out forwards';
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });
    
    animatedElements.forEach(el => {
        scrollObserver.observe(el);
    });
    
    // Tenant Contact Form Handler
    const tenantContactForm = document.getElementById('tenant-contact-form');
    
    if (tenantContactForm) {
        const submitBtn = tenantContactForm.querySelector('#submit-btn');
        const btnText = submitBtn.querySelector('.btn-text');
        const btnLoading = submitBtn.querySelector('.btn-loading');
        const formMessages = document.getElementById('form-messages');
        const successMessage = document.getElementById('success-message');
        const errorMessage = document.getElementById('error-message');
        const messageTextarea = tenantContactForm.querySelector('textarea[name="message"]');
        const charCount = document.getElementById('char-count');

        // Character counter
        if (messageTextarea && charCount) {
            messageTextarea.addEventListener('input', function() {
                const count = this.value.length;
                charCount.textContent = count;
                
                if (count > 1000) {
                    charCount.style.color = '#ef4444';
                    this.style.borderColor = '#ef4444';
                } else {
                    charCount.style.color = '#6b7280';
                    this.style.borderColor = '#d1d5db';
                }
            });
        }

        // Form submission
        tenantContactForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            // Clear previous errors
            clearTenantErrors();
            
            // Show loading state
            setTenantLoading(true);
            
            // Get form data
            const formData = new FormData(this);
            
            try {
                const response = await fetch('/contact', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || 
                                       document.querySelector('input[name="_token"]')?.value
                    }
                });

                const data = await response.json();

                if (data.success) {
                    showTenantSuccess(data.message);
                    tenantContactForm.reset();
                    if (charCount) charCount.textContent = '0';
                    
                    // Auto-hide success message after 10 seconds
                    setTimeout(() => {
                        hideTenantMessages();
                    }, 10000);
                    
                } else {
                    if (data.errors) {
                        showTenantErrors(data.errors);
                    } else {
                        showTenantError(data.message || 'Terjadi kesalahan sistem.');
                    }
                }

            } catch (error) {
                console.error('Tenant contact form error:', error);
                showTenantError('Terjadi kesalahan koneksi. Silakan coba lagi atau hubungi kami melalui WhatsApp.');
            } finally {
                setTenantLoading(false);
            }
        });

        function setTenantLoading(loading) {
            if (loading) {
                submitBtn.disabled = true;
                btnText.classList.add('hidden');
                btnLoading.classList.remove('hidden');
            } else {
                submitBtn.disabled = false;
                btnText.classList.remove('hidden');
                btnLoading.classList.add('hidden');
            }
        }

        function showTenantSuccess(message) {
            formMessages.classList.remove('hidden');
            successMessage.classList.remove('hidden');
            errorMessage.classList.add('hidden');
            document.getElementById('success-text').textContent = message;
            
            // Scroll to message
            formMessages.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        function showTenantError(message) {
            formMessages.classList.remove('hidden');
            errorMessage.classList.remove('hidden');
            successMessage.classList.add('hidden');
            document.getElementById('error-text').textContent = message;
            
            // Scroll to message
            formMessages.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }

        function showTenantErrors(errors) {
            // Clear previous errors
            clearTenantErrors();
            
            // Show field-specific errors
            for (const [field, messages] of Object.entries(errors)) {
                const errorElement = document.getElementById(`${field}-error`);
                if (errorElement) {
                    errorElement.textContent = messages[0];
                    errorElement.classList.remove('hidden');
                    
                    // Highlight field
                    const fieldInput = tenantContactForm.querySelector(`[name="${field}"]`);
                    if (fieldInput) {
                        fieldInput.style.borderColor = '#ef4444';
                    }
                }
            }
            
            // Show general error
            showTenantError('Mohon periksa kembali form Anda.');
        }

        function clearTenantErrors() {
            // Clear error messages
            tenantContactForm.querySelectorAll('.error-message').forEach(el => {
                el.textContent = '';
                el.classList.add('hidden');
            });
            
            // Reset field borders
            tenantContactForm.querySelectorAll('input, textarea').forEach(el => {
                el.style.borderColor = '#d1d5db';
            });
        }

        function hideTenantMessages() {
            formMessages.classList.add('hidden');
            successMessage.classList.add('hidden');
            errorMessage.classList.add('hidden');
        }
    }
    
    // Parallax Effect for Hero Section
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const parallaxElements = document.querySelectorAll('.parallax');
        
        parallaxElements.forEach(element => {
            const speed = element.dataset.speed || 0.5;
            element.style.transform = `translateY(${scrolled * speed}px)`;
        });
    });
    
    // Add fade-in animation keyframes if not already present
    if (!document.querySelector('#fadeInAnimation')) {
        const style = document.createElement('style');
        style.id = 'fadeInAnimation';
        style.textContent = `
            @keyframes fadeIn {
                from { opacity: 0; transform: translateY(20px); }
                to { opacity: 1; transform: translateY(0); }
            }
            
            @keyframes fadeInUp {
                from { opacity: 0; transform: translateY(30px); }
                to { opacity: 1; transform: translateY(0); }
            }
            
            .animate-on-scroll {
                opacity: 0;
                transform: translateY(30px);
                transition: all 0.8s ease-out;
            }
            
            .animate-on-scroll.animated {
                opacity: 1;
                transform: translateY(0);
            }
        `;
        document.head.appendChild(style);
    }
});

// Add smooth scrolling for better UX
document.addEventListener('DOMContentLoaded', function() {
    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animated');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe all animated elements
    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        observer.observe(el);
    });
});
</script>
@endpush

</x-layouts.tenant>


