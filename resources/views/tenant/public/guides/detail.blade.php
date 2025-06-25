<x-layouts.tenant>
    <!-- Guide Detail Hero Section -->
    <section class="relative min-h-screen bg-gradient-to-br from-amber-50 via-orange-50 to-red-50">
        <!-- Animated Background Elements -->
        <div class="absolute inset-0 overflow-hidden">
            <!-- Floating Geometric Shapes -->
            <div class="absolute top-20 left-10 w-20 h-20 bg-gradient-to-br from-amber-300/30 to-orange-400/30 rounded-full blur-xl animate-float"></div>
            <div class="absolute bottom-32 right-20 w-32 h-32 bg-gradient-to-br from-red-300/20 to-pink-400/20 rounded-full blur-xl animate-float-delay"></div>
            <div class="absolute top-1/2 left-1/3 w-16 h-16 bg-gradient-to-br from-yellow-300/25 to-amber-400/25 rounded-full blur-xl animate-float-slow"></div>
            
            <!-- Diagonal Pattern Overlay -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0 bg-gradient-to-br from-transparent via-amber-100 to-transparent transform rotate-12"></div>
                <div class="absolute inset-0 bg-gradient-to-tl from-transparent via-orange-100 to-transparent transform -rotate-12"></div>
            </div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 py-20">
            <!-- Enhanced Breadcrumb -->
            <nav class="mb-8">
                <ol class="flex items-center space-x-2 text-sm">
                    <li>
                        <a href="/" class="text-amber-600 hover:text-amber-700 font-medium transition-colors flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            Beranda
                        </a>
                    </li>
                    <li><span class="text-gray-400">/</span></li>
                    <li>
                        <a href="/guides" class="text-amber-600 hover:text-amber-700 font-medium transition-colors flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Guide
                        </a>
                    </li>
                    <li><span class="text-gray-400">/</span></li>
                    <li><span class="text-gray-700 font-medium">{{ $guide->name }}</span></li>
                </ol>
            </nav>

            <div class="grid lg:grid-cols-5 gap-12 items-start">
                <!-- Guide Profile Section - Unique Card Design -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Main Profile Card -->
                    <div class="relative bg-white/95 backdrop-blur-sm rounded-3xl shadow-2xl border border-amber-200/50 overflow-hidden guide-card">
                        <!-- Profile Header with Gradient -->
                        <div class="relative bg-gradient-to-r from-amber-400 via-orange-400 to-red-400 p-8 text-white">
                            <div class="absolute inset-0 bg-black/20"></div>
                            <div class="relative z-10 text-center">
                                <!-- Profile Image with Special Frame -->
                                <div class="relative inline-block mb-6">
                                    <div class="w-32 h-32 rounded-full overflow-hidden border-4 border-white/50 shadow-2xl mx-auto">
                                        <img src="{{ $guide->main_image_url }}" 
                                             alt="{{ $guide->name }}"
                                             class="w-full h-full object-cover"
                                             onerror="this.src='https://via.placeholder.com/200x200/f59e0b/ffffff?text=Guide'">
                                    </div>
                                    <!-- Status Badge -->
                                    @php
                                        $statusColors = [
                                            'Tersedia' => 'bg-green-500',
                                            'Sibuk' => 'bg-red-500',
                                            'Tersedia Terbatas' => 'bg-yellow-500'
                                        ];
                                        $statusColor = $statusColors[$guide->availability] ?? 'bg-green-500';
                                    @endphp
                                    <div class="absolute -bottom-2 -right-2 w-12 h-12 {{ $statusColor }} rounded-full border-4 border-white flex items-center justify-center shadow-lg">
                                        @if($guide->availability === 'Tersedia')
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                        @elseif($guide->availability === 'Sibuk')
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                        </svg>
                                        @else
                                        <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                        </svg>
                                        @endif
                                    </div>
                                </div>

                                <!-- Guide Info -->
                                <h1 class="text-3xl font-bold text-white mb-2">{{ $guide->name }}</h1>
                                <p class="text-white/90 text-lg font-medium mb-4">{{ $guide->specialty }}</p>
                                
                                <!-- Rating & Experience -->
                                <div class="flex items-center justify-center space-x-6 text-white/90">
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-yellow-300 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        <span class="font-bold">{{ $guide->rating }}</span>
                                    </div>
                                    <div class="w-1 h-1 bg-white/50 rounded-full"></div>
                                    <div class="flex items-center">
                                        <svg class="w-5 h-5 text-white/90 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="font-medium">{{ $guide->experience_years }} tahun</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Profile Content -->
                        <div class="p-8">
                            <!-- Languages -->
                            <div class="mb-6">
                                <h3 class="text-lg font-bold text-gray-800 mb-3 flex items-center">
                                    <svg class="w-5 h-5 text-amber-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                                    </svg>
                                    Bahasa yang Dikuasai
                                </h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($guide->languages as $language)
                                    <span class="px-4 py-2 bg-gradient-to-r from-amber-100 to-orange-100 text-amber-700 rounded-full text-sm font-medium border border-amber-200">
                                        {{ $language }}
                                    </span>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Contact Info -->
                            <div class="mb-6">
                                <h3 class="text-lg font-bold text-gray-800 mb-3 flex items-center">
                                    <svg class="w-5 h-5 text-amber-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    Kontak
                                </h3>
                                <div class="space-y-2 text-sm text-gray-600">
                                    @if($guide->phone)
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-amber-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                        </svg>
                                        {{ $guide->phone }}
                                    </div>
                                    @endif
                                    @if($guide->email)
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-amber-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                        </svg>
                                        {{ $guide->email }}
                                    </div>
                                    @endif
                                    @if($guide->address)
                                    <div class="flex items-start">
                                        <svg class="w-4 h-4 text-amber-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        </svg>
                                        {{ $guide->address }}
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Favorite Button -->
                            <div class="flex justify-center">
                                <button onclick="toggleGuideFavorite({{ $guide->id }})" 
                                        class="w-full bg-gradient-to-r from-amber-100 to-orange-100 hover:from-amber-200 hover:to-orange-200 border-2 border-amber-300 text-amber-700 py-3 px-6 rounded-xl font-bold transition-all duration-300 hover:shadow-md group">
                                    <span class="flex items-center justify-center">
                                        <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                        </svg>
                                        Tambah ke Favorit
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Gallery Carousel -->
                    @if($guide->images && $guide->images->count() > 0)
                    <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-xl border border-amber-200/50 overflow-hidden">
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center">
                                <svg class="w-6 h-6 text-amber-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Galeri
                            </h3>
                            
                            <!-- Main Swiper -->
                            <div class="swiper guide-gallery-swiper mb-4">
                                <div class="swiper-wrapper">
                                    @foreach($guide->images as $index => $image)
                                    <div class="swiper-slide">
                                        <div class="aspect-[4/3] rounded-2xl overflow-hidden">
                                            <img src="{{ $image->url ?? $guide->main_image_url }}" 
                                                 alt="{{ $guide->name }} - Gallery {{ $index + 1 }}"
                                                 class="w-full h-full object-cover"
                                                 onerror="this.src='https://via.placeholder.com/400x300/f59e0b/ffffff?text=Gallery+{{ $index + 1 }}'">
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                
                                <!-- Navigation -->
                                <div class="swiper-button-next !w-10 !h-10 !bg-white/90 !rounded-full !shadow-lg after:!text-amber-600 after:!text-sm after:!font-bold"></div>
                                <div class="swiper-button-prev !w-10 !h-10 !bg-white/90 !rounded-full !shadow-lg after:!text-amber-600 after:!text-sm after:!font-bold"></div>
                                
                                <!-- Pagination -->
                                <div class="swiper-pagination !bottom-4 !left-4 !right-auto !w-auto !bg-black/50 !rounded-full !px-3 !py-1 !text-white !text-xs"></div>
                            </div>
                            
                            <!-- Thumbnail Navigation -->
                            <div class="swiper guide-gallery-thumbs">
                                <div class="swiper-wrapper">
                                    @foreach($guide->images as $index => $image)
                                    <div class="swiper-slide !w-16 !h-16">
                                        <div class="w-full h-full rounded-lg overflow-hidden cursor-pointer border-2 border-transparent hover:border-amber-300 transition-all">
                                            <img src="{{ $image->url ?? $guide->main_image_url }}" 
                                                 alt="{{ $guide->name }} - Thumb {{ $index + 1 }}"
                                                 class="w-full h-full object-cover"
                                                 onerror="this.src='https://via.placeholder.com/100x100/f59e0b/ffffff?text={{ $index + 1 }}'">
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Main Content Section -->
                <div class="lg:col-span-3 space-y-8">
                    <!-- Title & Intro -->
                    <div>
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-2 leading-tight">
                                    Kenali Guide Kami
                                </h2>
                                <p class="text-xl text-gray-600">
                                    Pengalaman wisata yang tak terlupakan bersama <span class="text-amber-600 font-semibold">{{ $guide->name }}</span>
                                </p>
                            </div>
                            
                            <div class="flex items-center space-x-2 text-gray-500 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <span>{{ $guide->views }} kali dilihat</span>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="bg-white/95 backdrop-blur-sm rounded-3xl p-8 shadow-xl border border-amber-200/50">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                            <svg class="w-6 h-6 text-amber-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            Tentang Guide
                        </h3>
                        <div class="prose prose-lg max-w-none">
                            <p class="text-gray-600 leading-relaxed text-lg">
                                {{ $guide->description }}
                            </p>
                        </div>
                    </div>

                    <!-- Tour Packages -->
                    <div class="bg-white/95 backdrop-blur-sm rounded-3xl p-8 shadow-xl border border-amber-200/50">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                            <svg class="w-6 h-6 text-amber-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            Paket Tour
                        </h3>
                        
                        <div class="grid md:grid-cols-3 gap-6">
                            @foreach($guide->tour_packages as $package)
                            <div class="group bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl p-6 border border-amber-200 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
                                <div class="text-center">
                                    <h4 class="text-lg font-bold text-gray-800 mb-2">{{ $package->name }}</h4>
                                    <p class="text-amber-600 font-semibold mb-3">{{ $package->duration }}</p>
                                    <div class="text-2xl font-bold text-gray-800 mb-4">
                                        Rp {{ number_format($package->price, 0, ',', '.') }}
                                    </div>
                                    <button onclick="bookGuide('{{ $package->name }}')" 
                                            class="w-full bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white py-3 px-4 rounded-xl font-bold transition-all duration-300 transform group-hover:scale-105">
                                        Pilih Paket
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Certifications -->
                    <div class="bg-white/95 backdrop-blur-sm rounded-3xl p-8 shadow-xl border border-amber-200/50">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                            <svg class="w-6 h-6 text-amber-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Sertifikat & Kualifikasi
                        </h3>
                        
                        <div class="grid md:grid-cols-2 gap-4">
                            @foreach($guide->certifications as $cert)
                            <div class="flex items-center p-4 bg-gradient-to-r from-green-50 to-emerald-50 rounded-xl border border-green-200">
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-800">{{ $cert->name }}</h4>
                                    <p class="text-sm text-gray-600">Bersertifikat</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button onclick="bookGuide('Custom')" 
                                class="flex-1 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-emerald-600 text-white py-4 px-8 rounded-xl font-bold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <span class="flex items-center justify-center">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Pesan Guide
                            </span>
                        </button>
                        
                        <button onclick="shareGuide()" 
                                class="bg-white border-2 border-amber-300 text-amber-700 hover:bg-amber-50 py-4 px-8 rounded-xl font-bold transition-all duration-300 hover:shadow-md">
                            <span class="flex items-center justify-center">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                </svg>
                                Bagikan Profil
                            </span>
                        </button>
                        
                        <button onclick="contactGuide()" 
                                class="bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-600 hover:to-emerald-600 text-white py-4 px-8 rounded-xl font-bold transition-all duration-300 transform hover:scale-105 shadow-lg">
                            <span class="flex items-center justify-center">
                                <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-2.462-.96-4.779-2.705-6.526-1.746-1.746-4.065-2.707-6.526-2.705-5.452.002-9.886 4.435-9.889 9.887-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.092-.645zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                                </svg>
                                WhatsApp
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pricing Section -->
    <section class="py-20 bg-gradient-to-b from-white to-amber-50/30">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid lg:grid-cols-3 gap-12">
                <!-- Pricing Card -->
                <div class="lg:col-span-1">
                    <div class="sticky top-8 bg-gradient-to-br from-amber-500 to-orange-500 rounded-3xl p-8 text-white shadow-2xl">
                        <h3 class="text-3xl font-bold mb-6 text-center">Harga Guide</h3>
                        
                        <div class="text-center mb-8">
                            @if($guide->hasDiscount())
                            <div class="mb-4">
                                <span class="text-5xl font-bold">{{ $guide->formatted_discounted_price }}</span>
                                <span class="text-xl text-white/80 line-through ml-2">{{ $guide->formatted_price }}</span>
                            </div>
                            <div class="bg-white/20 backdrop-blur-sm rounded-full px-4 py-2 inline-block">
                                <span class="text-sm font-bold">Hemat {{ $guide->discount_percent }}%</span>
                            </div>
                            @else
                            <div class="text-5xl font-bold mb-2">{{ $guide->formatted_price }}</div>
                            @endif
                            <div class="text-white/90 text-lg">per hari</div>
                        </div>

                        <div class="space-y-4 mb-8">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-white/90">Guide profesional berpengalaman</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-white/90">Penguasaan multiple bahasa</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-white/90">Fleksibilitas jadwal</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 mr-3 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="text-white/90">Dokumentasi perjalanan</span>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <button onclick="bookGuide('Full Day')" 
                                    class="w-full bg-white/20 backdrop-blur-sm hover:bg-white/30 border-2 border-white/50 text-white py-4 px-6 rounded-xl font-bold transition-all duration-300 hover:shadow-lg">
                                💬 Konsultasi Gratis
                            </button>
                            
                            <button onclick="contactGuide()" 
                                    class="w-full bg-white text-amber-600 hover:bg-amber-50 py-4 px-6 rounded-xl font-bold transition-all duration-300 transform hover:scale-105 shadow-lg">
                                📞 Hubungi Sekarang
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Guide Stats & Reviews -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Stats Cards -->
                    <div class="grid md:grid-cols-3 gap-6">
                        <div class="bg-white/95 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-amber-200/50 text-center">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-100 to-blue-200 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                            </div>
                            <h4 class="text-2xl font-bold text-gray-800 mb-2">{{ number_format($guide->views) }}</h4>
                            <p class="text-gray-600 font-medium">Profile Views</p>
                        </div>
                        
                        <div class="bg-white/95 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-amber-200/50 text-center">
                            <div class="w-16 h-16 bg-gradient-to-br from-yellow-100 to-yellow-200 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                            </div>
                            <h4 class="text-2xl font-bold text-gray-800 mb-2">{{ $guide->rating }}/5</h4>
                            <p class="text-gray-600 font-medium">Rating</p>
                        </div>
                        
                        <div class="bg-white/95 backdrop-blur-sm rounded-2xl p-6 shadow-lg border border-amber-200/50 text-center">
                            <div class="w-16 h-16 bg-gradient-to-br from-green-100 to-green-200 rounded-full flex items-center justify-center mx-auto mb-4">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h4 class="text-2xl font-bold text-gray-800 mb-2">{{ $guide->experience_years }}</h4>
                            <p class="text-gray-600 font-medium">Tahun Pengalaman</p>
                        </div>
                    </div>

                    <!-- Testimonials -->
                    <div class="bg-white/95 backdrop-blur-sm rounded-3xl p-8 shadow-xl border border-amber-200/50">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                            <svg class="w-6 h-6 text-amber-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-1l-4 4z"></path>
                            </svg>
                            Testimoni Wisatawan
                        </h3>
                        
                        <div class="space-y-6">
                            @for($i = 1; $i <= 3; $i++)
                            <div class="bg-gradient-to-r from-amber-50 to-orange-50 rounded-2xl p-6 border border-amber-200">
                                <div class="flex items-start space-x-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-amber-400 to-orange-400 rounded-full flex items-center justify-center flex-shrink-0">
                                        <span class="text-white font-bold">{{ chr(64 + $i) }}</span>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center mb-2">
                                            <h4 class="font-bold text-gray-800 mr-2">Wisatawan {{ $i }}</h4>
                                            <div class="flex">
                                                @for($j = 1; $j <= 5; $j++)
                                                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                                </svg>
                                                @endfor
                                            </div>
                                        </div>
                                        <p class="text-gray-600 text-sm leading-relaxed">
                                            "{{ $guide->name }} sangat profesional dan membantu. Pengalaman wisata menjadi lebih berkesan dengan penjelasan yang detail dan ramah."
                                        </p>
                                    </div>
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('styles')
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
        /* Fix untuk container utama */
        .main-container {
            min-height: 100vh;
            position: relative;
        }
        
        /* Custom Animations */
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
        
        @keyframes float-delay {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }
        
        @keyframes float-slow {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        
        .animate-float-delay {
            animation: float-delay 8s ease-in-out infinite;
        }
        
        .animate-float-slow {
            animation: float-slow 10s ease-in-out infinite;
        }
        
        /* Fix untuk card styling */
        .guide-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(245, 158, 11, 0.2);
        }
        
        /* Custom Swiper Styles */
        .guide-gallery-swiper {
            --swiper-theme-color: #f59e0b;
            --swiper-navigation-size: 20px;
        }
        
        .guide-gallery-swiper .swiper-button-next,
        .guide-gallery-swiper .swiper-button-prev {
            margin-top: 0;
            transform: translateY(-50%);
            width: 40px !important;
            height: 40px !important;
        }
        
        .guide-gallery-swiper .swiper-button-next::after,
        .guide-gallery-swiper .swiper-button-prev::after {
            font-size: 16px !important;
            font-weight: bold;
        }
        
        .guide-gallery-thumbs .swiper-slide {
            opacity: 0.7;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .guide-gallery-thumbs .swiper-slide-thumb-active {
            opacity: 1;
            transform: scale(1.05);
        }
        
        .guide-gallery-thumbs .swiper-slide-thumb-active > div {
            border-color: #f59e0b !important;
            border-width: 2px !important;
        }
        
        /* Text Utilities */
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, #f59e0b, #ea580c);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        /* Fix untuk responsivitas */
        @media (max-width: 768px) {
            .grid.lg\\:grid-cols-5 {
                grid-template-columns: 1fr;
            }
            
            .lg\\:col-span-2,
            .lg\\:col-span-3 {
                grid-column: span 1;
            }
        }
    </style>
    @endpush

    @push('scripts')
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    <script>
        // Guide-specific functions
        function bookGuide(packageType = 'Custom') {
            const phoneNumber = '6281234567890';
            const guideName = '{{ $guide->name }}';
            const message = `Halo, saya tertarik untuk memesan guide ${guideName} untuk paket ${packageType}. Bisakah saya mendapatkan informasi lebih lanjut tentang jadwal dan harga?`;
            const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
            window.open(whatsappUrl, '_blank');
        }

        function contactGuide() {
            const phoneNumber = '{{ $guide->phone ?? "6281234567890" }}';
            const guideName = '{{ $guide->name }}';
            const message = `Halo ${guideName}, saya tertarik dengan layanan guide Anda. Bisakah kita diskusi lebih lanjut?`;
            const whatsappUrl = `https://wa.me/${phoneNumber.replace(/[^\d]/g, '')}?text=${encodeURIComponent(message)}`;
            window.open(whatsappUrl, '_blank');
        }

        function shareGuide() {
            if (navigator.share) {
                navigator.share({
                    title: 'Guide {{ $guide->name }}',
                    text: 'Lihat profil guide profesional {{ $guide->name }} - {{ $guide->specialty }}',
                    url: window.location.href
                }).catch(console.error);
            } else {
                navigator.clipboard.writeText(window.location.href).then(() => {
                    showNotification('🔗 Link profil berhasil disalin!', 'success');
                }).catch(() => {
                    showNotification('❌ Gagal menyalin link!', 'error');
                });
            }
        }

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

        function updateGuideFavoriteButtons() {
            const favorites = JSON.parse(localStorage.getItem('guide_favorites') || '[]');
            document.querySelectorAll('[onclick^="toggleGuideFavorite"]').forEach(button => {
                const guideId = parseInt(button.getAttribute('onclick').match(/\d+/)[0]);
                const icon = button.querySelector('svg');
                
                if (favorites.includes(guideId)) {
                    icon.setAttribute('fill', 'currentColor');
                    button.classList.add('!text-red-500');
                    button.classList.remove('!text-amber-700');
                    button.querySelector('span').innerHTML = `
                        <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="currentColor" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        Hapus dari Favorit
                    `;
                } else {
                    icon.setAttribute('fill', 'none');
                    button.classList.add('!text-amber-700');
                    button.classList.remove('!text-red-500');
                    button.querySelector('span').innerHTML = `
                        <svg class="w-5 h-5 mr-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        Tambah ke Favorit
                    `;
                }
            });
        }

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