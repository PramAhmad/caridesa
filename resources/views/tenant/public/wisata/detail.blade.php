<x-layouts.tenant>
    <!-- Wisata Detail Hero Section -->
    <section class="relative min-h-screen bg-gradient-to-br from-amber-50 via-orange-50 to-red-50">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-amber-100 to-transparent transform -skew-y-6"></div>
            <div class="absolute inset-0 bg-gradient-to-l from-transparent via-orange-100 to-transparent transform skew-y-6"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-6 py-20">
            <!-- Breadcrumb -->
            <nav class="mb-8">
                <ol class="flex items-center space-x-2 text-sm">
                    <li><a href="/" class="text-amber-600 hover:text-amber-700 font-medium">Beranda</a></li>
                    <li><span class="text-gray-400">/</span></li>
                    <li><a href="/wisatas" class="text-amber-600 hover:text-amber-700 font-medium">Wisata</a></li>
                    <li><span class="text-gray-400">/</span></li>
                    <li><span class="text-gray-700 font-medium">{{ $wisata->name }}</span></li>
                </ol>
            </nav>

            <div class="grid lg:grid-cols-2 gap-12 items-start">
                <!-- Image Gallery Section -->
                <div class="space-y-4">
                    <!-- Main Image -->
                    <div class="relative overflow-hidden rounded-3xl shadow-2xl">
                        <div class="aspect-[4/3] relative">
                            <img id="mainImage" 
                                 src="{{ $wisata->main_image_url }}" 
                                 alt="{{ $wisata->name }}"
                                 class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                 onerror="this.src='https://via.placeholder.com/800x600/f59e0b/ffffff?text=Wisata+Lokal'">
                        </div>
                        
                        <!-- Image Overlay Info -->
                        <div class="absolute top-6 left-6 right-6 flex justify-between items-start">
                            <span class="px-4 py-2 bg-gradient-to-r from-amber-500 to-orange-500 text-white rounded-full text-sm font-bold shadow-lg backdrop-blur-sm">
                                {{ $wisata->status_label }}
                            </span>
                            
                            <div class="flex items-center bg-white/90 backdrop-blur-sm rounded-full px-4 py-2 shadow-lg">
                                <svg class="w-4 h-4 text-amber-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <span class="text-sm font-bold text-gray-700">{{ $wisata->rating }}</span>
                            </div>
                        </div>

                        <!-- Favorite Button -->
                        <div class="absolute bottom-6 right-6">
                            <button onclick="toggleWisataFavorite({{ $wisata->id }})" 
                                    class="w-14 h-14 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg hover:bg-white hover:scale-110 transition-all duration-300 group">
                                <svg class="w-7 h-7 text-amber-600 group-hover:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Thumbnail Gallery -->
                    @if($wisata->images->count() > 1)
                    <div class="grid grid-cols-4 gap-3">
                        @foreach($wisata->images->take(4) as $image)
                        <div class="relative overflow-hidden rounded-xl cursor-pointer hover:opacity-75 transition-opacity"
                             onclick="changeMainImage('{{ asset($image->name) }}')">
                            <div class="aspect-square">
                                <img src="{{ asset($image->name) }}" 
                                     alt="{{ $wisata->name }}"
                                     class="w-full h-full object-cover"
                                     onerror="this.src='https://via.placeholder.com/200x200/f59e0b/ffffff?text=Wisata'">
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>

                <!-- Content Section -->
                <div class="space-y-8">
                    <!-- Title & Category -->
                    <div>
                        <div class="flex items-center gap-3 mb-4">
                            <span class="px-4 py-2 bg-amber-100 text-amber-800 rounded-full text-sm font-semibold border border-amber-200">
                                {{ $wisata->category->name ?? 'Wisata Umum' }}
                            </span>
                            <div class="flex items-center text-gray-500 text-sm">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <span class="font-medium">{{ $wisata->views }} kali dilihat</span>
                            </div>
                        </div>
                        
                        <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 leading-tight">
                            {{ $wisata->name }}
                        </h1>
                        
                        <div class="text-3xl font-bold bg-gradient-to-r from-amber-600 to-orange-600 bg-clip-text text-transparent mb-6">
                            {{ $wisata->formatted_price }}
                        </div>
                    </div>

                    <!-- Quick Info Cards -->
                    <div class="grid grid-cols-2 gap-4">
                        @if($wisata->coordinates)
                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 border border-amber-200/50 shadow-lg">
                            <div class="flex items-center mb-3">
                                <svg class="w-6 h-6 text-amber-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <h3 class="font-bold text-gray-800">Lokasi</h3>
                            </div>
                            <p class="text-gray-600 text-sm">{{ $wisata->coordinates }}</p>
                            @if($wisata->google_maps_url)
                            <a href="{{ $wisata->google_maps_url }}" target="_blank" 
                               class="inline-flex items-center mt-3 text-amber-600 hover:text-amber-700 text-sm font-medium">
                                <span>Lihat di Maps</span>
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                </svg>
                            </a>
                            @endif
                        </div>
                        @endif

                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 border border-amber-200/50 shadow-lg">
                            <div class="flex items-center mb-3">
                                <svg class="w-6 h-6 text-amber-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <h3 class="font-bold text-gray-800">Waktu Kunjungan</h3>
                            </div>
                            <p class="text-gray-600 text-sm">Setiap hari</p>
                            <p class="text-gray-500 text-xs mt-1">08:00 - 17:00 WIB</p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button onclick="bookWisata()" 
                                class="flex-1 bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white py-4 px-8 rounded-xl font-bold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            <span class="flex items-center justify-center">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 0h6m-6 0l-1 12a2 2 0 002 2h6a2 2 0 002-2L16 7M10 11v6m4-6v6"></path>
                                </svg>
                                Kunjungi Sekarang
                            </span>
                        </button>
                        
                        <button onclick="shareWisata()" 
                                class="bg-white border-2 border-amber-300 text-amber-700 hover:bg-amber-50 py-4 px-8 rounded-xl font-bold transition-all duration-300 hover:shadow-md">
                            <span class="flex items-center justify-center">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                                </svg>
                                Bagikan
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Description & Details Section -->
    <section class="py-20 bg-gradient-to-b from-white to-amber-50/30">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid lg:grid-cols-3 gap-12">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Description -->
                    <div class="bg-white rounded-3xl p-8 shadow-lg border border-amber-100/50">
                        <h2 class="text-3xl font-bold text-gray-800 mb-6">Tentang Destinasi</h2>
                        <div class="prose prose-lg max-w-none">
                            <p class="text-gray-600 leading-relaxed text-lg">
                                {{ $wisata->description }}
                            </p>
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="bg-white rounded-3xl p-8 shadow-lg border border-amber-100/50">
                        <h2 class="text-3xl font-bold text-gray-800 mb-6">Informasi Tambahan</h2>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <svg class="w-6 h-6 text-amber-500 mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div>
                                        <h4 class="font-semibold text-gray-800">Fasilitas Tersedia</h4>
                                        <p class="text-gray-600 text-sm">Area parkir, toilet umum, warung makan</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <svg class="w-6 h-6 text-amber-500 mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                    <div>
                                        <h4 class="font-semibold text-gray-800">Biaya Masuk</h4>
                                        <p class="text-gray-600 text-sm">{{ $wisata->formatted_price }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <svg class="w-6 h-6 text-amber-500 mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <div>
                                        <h4 class="font-semibold text-gray-800">Akses Lokasi</h4>
                                        <p class="text-gray-600 text-sm">Dapat diakses dengan kendaraan roda 2 & 4</p>
                                    </div>
                                </div>
                                
                                <div class="flex items-start">
                                    <svg class="w-6 h-6 text-amber-500 mr-3 mt-1 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div>
                                        <h4 class="font-semibold text-gray-800">Jam Operasional</h4>
                                        <p class="text-gray-600 text-sm">08:00 - 17:00 WIB</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-8">
                    <!-- Contact Card -->
                    <div class="bg-gradient-to-br from-amber-500 to-orange-500 rounded-3xl p-8 text-white shadow-xl">
                        <h3 class="text-2xl font-bold mb-6">Butuh Informasi?</h3>
                        <div class="space-y-4">
                            <a href="https://wa.me/6281234567890" target="_blank" 
                               class="flex items-center bg-white/20 backdrop-blur-sm rounded-xl p-4 hover:bg-white/30 transition-colors">
                                <svg class="w-6 h-6 mr-3" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-2.462-.96-4.779-2.705-6.526-1.746-1.746-4.065-2.707-6.526-2.705-5.452.002-9.886 4.435-9.889 9.887-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.092-.645zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                                </svg>
                                <div>
                                    <div class="font-semibold">WhatsApp</div>
                                    <div class="text-sm opacity-90">Chat sekarang</div>
                                </div>
                            </a>
                            
                            <a href="tel:+6281234567890" 
                               class="flex items-center bg-white/20 backdrop-blur-sm rounded-xl p-4 hover:bg-white/30 transition-colors">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <div>
                                    <div class="font-semibold">Telepon</div>
                                    <div class="text-sm opacity-90">+62 812-3456-7890</div>
                                </div>
                            </a>
                        </div>
                    </div>

                    <!-- Quick Stats -->
                    <div class="bg-white rounded-3xl p-8 shadow-lg border border-amber-100/50">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6">Statistik</h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Total Pengunjung</span>
                                <span class="font-bold text-gray-800">{{ number_format($wisata->views) }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Rating</span>
                                <div class="flex items-center">
                                    <span class="font-bold text-gray-800 mr-2">{{ $wisata->rating }}</span>
                                    <div class="flex">
                                        @for($i = 1; $i <= 5; $i++)
                                        <svg class="w-4 h-4 {{ $i <= floor($wisata->rating) ? 'text-amber-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">Kategori</span>
                                <span class="font-bold text-gray-800">{{ $wisata->category->name ?? 'Wisata Umum' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Wisata Section -->
    @if($relatedWisatas && $relatedWisatas->count() > 0)
    <section class="py-20 bg-gradient-to-b from-amber-50/30 to-orange-50/50">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                    Destinasi <span class="text-amber-600">Lainnya</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Jelajahi destinasi wisata menarik lainnya yang tidak kalah memukau
                </p>
                <div class="w-24 h-1 bg-gradient-to-r from-amber-500 to-orange-500 mx-auto rounded-full mt-6"></div>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($relatedWisatas as $related)
                <div class="bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 overflow-hidden border border-amber-100/50 group">
                    <div class="relative overflow-hidden">
                        <div class="aspect-[4/3] relative">
                            <img src="{{ $related->main_image_url }}" 
                                 alt="{{ $related->name }}"
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                 onerror="this.src='https://via.placeholder.com/400x300/f59e0b/ffffff?text=Wisata+Lokal'">
                        </div>
                        
                        <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
                            <span class="px-3 py-1.5 bg-gradient-to-r from-amber-500 to-orange-500 text-white rounded-full text-xs font-bold shadow-lg">
                                {{ $related->status_label }}
                            </span>
                            
                            <div class="flex items-center bg-white/90 backdrop-blur-sm rounded-full px-3 py-1.5 shadow-lg">
                                <svg class="w-3 h-3 text-amber-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                <span class="text-xs font-bold text-gray-700">{{ $related->rating }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <span class="px-3 py-1 bg-amber-100 text-amber-800 rounded-full text-xs font-semibold border border-amber-200">
                                {{ $related->category->name ?? 'Wisata Umum' }}
                            </span>
                            <div class="text-lg font-bold text-amber-600">
                                {{ $related->formatted_price }}
                            </div>
                        </div>
                        
                        <h3 class="text-xl font-bold text-gray-800 mb-2 line-clamp-2 group-hover:text-amber-700 transition-colors">
                            {{ $related->name }}
                        </h3>
                        
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
                            {{ Str::limit($related->description, 80) }}
                        </p>
                        
                        <a href="/wisata/{{ $related->slug }}" 
                           class="block w-full bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white py-3 px-4 rounded-xl font-bold text-center transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            Lihat Detail
                        </a>
                    </div>

                    <div class="h-2 bg-gradient-to-r from-amber-400 via-orange-400 to-red-400 transform group-hover:scale-x-110 transition-transform duration-500 origin-center"></div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @push('styles')
    <style>
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

        /* Prose Styling */
        .prose p {
            margin-bottom: 1.25em;
            line-height: 1.75;
        }
        
        /* Custom animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
    </style>
    @endpush

    @push('scripts')
    <script>
        // Change main image function
        function changeMainImage(imageSrc) {
            const mainImage = document.getElementById('mainImage');
            mainImage.src = imageSrc;
        }

        // Book wisata function
        function bookWisata() {
            const phoneNumber = '6281234567890';
            const wisataName = '{{ $wisata->name }}';
            const message = `Halo, saya tertarik untuk mengunjungi ${wisataName}. Bisakah saya mendapatkan informasi lebih lanjut?`;
            const whatsappUrl = `https://wa.me/${phoneNumber}?text=${encodeURIComponent(message)}`;
            window.open(whatsappUrl, '_blank');
        }

        // Share wisata function
        function shareWisata() {
            if (navigator.share) {
                navigator.share({
                    title: '{{ $wisata->name }}',
                    text: '{{ Str::limit($wisata->description, 100) }}',
                    url: window.location.href
                }).catch(console.error);
            } else {
                // Fallback to copying URL
                navigator.clipboard.writeText(window.location.href).then(() => {
                    showNotification('🔗 Link berhasil disalin!', 'success');
                }).catch(() => {
                    showNotification('❌ Gagal menyalin link!', 'error');
                });
            }
        }

        // Toggle favorite function (reuse from index)
        function toggleWisataFavorite(wisataId) {
            try {
                const favorites = JSON.parse(localStorage.getItem('wisata_favorites') || '[]');
                const index = favorites.indexOf(wisataId);
                
                if (index === -1) {
                    favorites.push(wisataId);
                    showNotification('🌟 Destinasi ditambahkan ke favorit!', 'success');
                } else {
                    favorites.splice(index, 1);
                    showNotification('💔 Destinasi dihapus dari favorit!', 'info');
                }
                
                localStorage.setItem('wisata_favorites', JSON.stringify(favorites));
                updateWisataFavoriteButtons();
            } catch (error) {
                console.error('Error toggling favorite:', error);
                showNotification('❌ Terjadi kesalahan!', 'error');
            }
        }

        // Update favorite button appearances
        function updateWisataFavoriteButtons() {
            const favorites = JSON.parse(localStorage.getItem('wisata_favorites') || '[]');
            document.querySelectorAll('[onclick^="toggleWisataFavorite"]').forEach(button => {
                const wisataId = parseInt(button.getAttribute('onclick').match(/\d+/)[0]);
                const icon = button.querySelector('svg');
                
                if (favorites.includes(wisataId)) {
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
            
            // Show notification
            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);
            
            // Auto hide after 4 seconds
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    if (notification.parentElement) {
                        notification.parentElement.removeChild(notification);
                    }
                }, 500);
            }, 4000);
        }

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            updateWisataFavoriteButtons();
            
            // Smooth scroll for anchor links
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
        });
    </script>
    @endpush
</x-layouts.tenant>