<x-layouts.tenant>
    <!-- Events Hero Section - Amber Theme Style -->
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
                        Event & Acara
                    </span>
                    <br>
                    <span class="text-gray-800">Terbaik</span>
                </h1>
                <p class="text-xl md:text-2xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                    Temukan berbagai acara menarik dan event spektakuler.<br>
                    <span class="text-amber-600 font-semibold">Bergabunglah dalam momen-momen tak terlupakan bersama kami.</span>
                </p>
            </div>

            <!-- Enhanced Search & Filter Section -->
            <div class="max-w-5xl mx-auto">
                <div class="bg-white/95 backdrop-blur-sm rounded-3xl p-8 shadow-2xl border border-amber-200/50">
                    <form method="GET" action="/events" id="eventFilterForm">
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            <!-- Search Input -->
                            <div class="relative group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Cari Event</label>
                                <div class="relative">
                                    <input type="text" 
                                           name="search" 
                                           value="{{ request('search') }}"
                                           placeholder="Nama event..." 
                                           class="w-full pl-12 pr-4 py-4 bg-white border-2 border-amber-200 rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-500/20 transition-all duration-300 text-gray-700">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Date Filter -->
                            <div class="relative group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Status Event</label>
                                <div class="relative">
                                    <select name="date_filter" 
                                            class="w-full pl-12 pr-4 py-4 bg-white border-2 border-amber-200 rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-500/20 transition-all duration-300 text-gray-700 appearance-none cursor-pointer">
                                        <option value="">Semua Event</option>
                                        <option value="upcoming" {{ request('date_filter') == 'upcoming' ? 'selected' : '' }}>Akan Datang</option>
                                        <option value="ongoing" {{ request('date_filter') == 'ongoing' ? 'selected' : '' }}>Sedang Berlangsung</option>
                                        <option value="past" {{ request('date_filter') == 'past' ? 'selected' : '' }}>Sudah Selesai</option>
                                    </select>
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
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

                            <!-- Sort Options -->
                            <div class="relative group">
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Urutkan</label>
                                <div class="relative">
                                    <select name="sort" 
                                            class="w-full pl-4 pr-12 py-4 bg-white border-2 border-amber-200 rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-500/20 transition-all duration-300 text-gray-700 appearance-none cursor-pointer">
                                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                                        <option value="start_date" {{ request('sort') == 'start_date' ? 'selected' : '' }}>Tanggal Mulai</option>
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
                                @if(isset($events))
                                    Menampilkan {{ $events->count() }} dari {{ $events->total() }} event
                                @else
                                    Siap mencari event
                                @endif
                            </div>
                            
                            <div class="flex gap-3">
                                <button type="submit" 
                                        class="group bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white px-8 py-3 rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                    <span class="flex items-center">
                                        <svg class="w-5 h-5 mr-2 group-hover:animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                        Cari Event
                                    </span>
                                </button>
                                
                                <a href="/events" 
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

    <!-- Events Main Content Section -->
    <section class="py-20 bg-gradient-to-b from-white via-amber-50/30 to-orange-50/50">
        <div class="max-w-7xl mx-auto px-6">
            @if(isset($events) && $events->count() > 0)
                <!-- Section Title -->
                <div class="text-center mb-16">
                    <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                        Event <span class="text-amber-600">Terpilih</span>
                    </h2>
                    <div class="w-24 h-1 bg-gradient-to-r from-amber-500 to-orange-500 mx-auto rounded-full"></div>
                </div>

                <!-- Events Cards Grid - Mixed Layout -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($events as $index => $event)
                    @php
                        // Generate different card styles based on index
                        $cardVariants = ['standard', 'featured', 'minimal', 'premium'];
                        $variant = $cardVariants[$index % 4];
                        
                        // Get status colors
                        $statusColors = [
                            'upcoming' => ['bg' => 'bg-blue-500', 'text' => 'text-blue-600', 'border' => 'border-blue-200'],
                            'ongoing' => ['bg' => 'bg-green-500', 'text' => 'text-green-600', 'border' => 'border-green-200'],
                            'past' => ['bg' => 'bg-gray-500', 'text' => 'text-gray-600', 'border' => 'border-gray-200']
                        ];
                        $statusColor = $statusColors[$event->status] ?? $statusColors['upcoming'];
                    @endphp

                    @if($variant === 'featured')
                    <!-- Featured Card - Large with overlay -->
                    <div class="event-card group {{ $index % 6 === 0 ? 'md:col-span-2' : '' }} bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 overflow-hidden border border-amber-100/50">
                        <!-- Large Image with Overlay Content -->
                        <div class="relative overflow-hidden h-80">
                            <img src="{{ $event->main_image_url }}" 
                                 alt="{{ $event->name }}"
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                 onerror="this.src='https://via.placeholder.com/600x400/f59e0b/ffffff?text=Event'">
                            
                            <!-- Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                            
                            <!-- Content Overlay -->
                            <div class="absolute inset-0 p-6 flex flex-col justify-between">
                                <!-- Top badges -->
                                <div class="flex justify-between items-start">
                                    <span class="px-3 py-1.5 {{ $statusColor['bg'] }} text-white rounded-full text-xs font-bold shadow-lg backdrop-blur-sm">
                                        {{ $event->status_label }}
                                    </span>
                                    <button onclick="toggleEventFavorite({{ $event->id }})" 
                                            class="w-12 h-12 bg-white/20 backdrop-blur-sm rounded-full flex items-center justify-center hover:bg-white/30 transition-all duration-300">
                                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                        </svg>
                                    </button>
                                </div>
                                
                                <!-- Bottom content -->
                                <div class="text-white">
                                    <h3 class="text-2xl font-bold mb-2">{{ $event->name }}</h3>
                                    <div class="flex items-center text-white/80 text-sm mb-3">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ $event->human_date_range }}
                                    </div>
                                    <div class="flex items-center text-white/80 text-sm mb-4">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 616 0z"></path>
                                        </svg>
                                        {{ Str::limit($event->location, 30) }}
                                    </div>
                                    <a href="/events/{{ $event->slug }}" 
                                       class="inline-flex items-center bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white py-3 px-6 rounded-xl font-bold transition-all duration-300 transform hover:scale-105 shadow-lg">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 616 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            Lihat Detail
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- Decorative Border -->
                        <div class="h-2 bg-gradient-to-r from-amber-400 via-orange-400 to-red-400"></div>
                    </div>

                    @elseif($variant === 'minimal')
                    <!-- Minimal Card - Clean Design -->
                    <div class="event-card group bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-500 transform hover:-translate-y-2 border-l-4 {{ $statusColor['border'] }}">
                        <div class="p-6">
                            <!-- Header -->
                            <div class="flex justify-between items-start mb-4">
                                <span class="px-3 py-1 {{ $statusColor['bg'] }} text-white rounded-full text-xs font-bold">
                                    {{ $event->status_label }}
                                </span>
                                <button onclick="toggleEventFavorite({{ $event->id }})" 
                                        class="w-8 h-8 rounded-full flex items-center justify-center hover:bg-gray-100 transition-all duration-300">
                                    <svg class="w-5 h-5 text-gray-400 hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </button>
                            </div>
                            
                            <!-- Content -->
                            <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2">{{ $event->name }}</h3>
                            
                            <div class="space-y-2 text-sm text-gray-600 mb-4">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 {{ $statusColor['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    {{ $event->formatted_start_date }}
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 616 0z"></path>
                                    </svg>
                                    {{ Str::limit($event->location, 25) }}
                                </div>
                            </div>
                            
                            <p class="text-gray-600 text-sm mb-6 line-clamp-3">{{ Str::limit($event->description, 120) }}</p>
                            
                            <a href="/events/{{ $event->slug }}" 
                               class="block w-full text-center {{ $statusColor['text'] }} hover:{{ $statusColor['bg'] }} hover:text-white py-2 px-4 rounded-lg font-medium transition-all duration-300 border-2 {{ $statusColor['border'] }} hover:{{ $statusColor['border'] }}">
                                Lihat Detail
                            </a>
                        </div>
                    </div>

                    @elseif($variant === 'premium')
                    <!-- Premium Card - Luxury Design -->
                    <div class="event-card group bg-gradient-to-br from-white to-amber-50 rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-4 overflow-hidden border border-amber-200">
                        <!-- Image with overlay effects -->
                        <div class="relative overflow-hidden h-56">
                            <img src="{{ $event->main_image_url }}" 
                                 alt="{{ $event->name }}"
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                 onerror="this.src='https://via.placeholder.com/400x300/f59e0b/ffffff?text=Event'">
                            
                            <!-- Status badge with glow effect -->
                            <div class="absolute top-4 left-4">
                                <span class="px-4 py-2 {{ $statusColor['bg'] }} text-white rounded-full text-xs font-bold shadow-2xl backdrop-blur-sm animate-pulse">
                                    {{ $event->status_label }}
                                </span>
                            </div>
                            
                            <!-- Favorite with premium styling -->
                            <div class="absolute top-4 right-4">
                                <button onclick="toggleEventFavorite({{ $event->id }})" 
                                        class="w-12 h-12 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg hover:shadow-xl hover:scale-110 transition-all duration-300">
                                    <svg class="w-6 h-6 text-amber-600 hover:text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </button>
                            </div>
                            
                            <!-- Duration badge -->
                            <div class="absolute bottom-4 left-4">
                                <span class="px-3 py-1 bg-black/70 text-white rounded-full text-xs font-medium backdrop-blur-sm">
                                    {{ $event->formatted_duration }}
                                </span>
                            </div>
                        </div>

                        <!-- Premium content area -->
                        <div class="p-8">
                            <h3 class="text-2xl font-bold text-gray-800 mb-4 line-clamp-2 group-hover:text-amber-700 transition-colors">
                                {{ $event->name }}
                            </h3>
                            
                            <!-- Event details with icons -->
                            <div class="space-y-3 text-sm mb-6">
                                <div class="flex items-center text-gray-600">
                                    <div class="w-8 h-8 bg-gradient-to-r from-amber-500 to-orange-500 rounded-full flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <div class="font-medium">{{ $event->formatted_start_date }}</div>
                                        @if($event->is_multi_day)
                                        <div class="text-xs text-gray-500">sampai {{ $event->formatted_end_date }}</div>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="flex items-center text-gray-600">
                                    <div class="w-8 h-8 bg-gradient-to-r from-orange-500 to-red-500 rounded-full flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 616 0z"></path>
                                        </svg>
                                    </div>
                                    <span class="font-medium">{{ Str::limit($event->location, 30) }}</span>
                                </div>
                                
                                @if($event->organizer)
                                <div class="flex items-center text-gray-600">
                                    <div class="w-8 h-8 bg-gradient-to-r from-red-500 to-pink-500 rounded-full flex items-center justify-center mr-3">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                    </div>
                                    <span class="font-medium">{{ $event->organizer }}</span>
                                </div>
                                @endif
                            </div>
                            
                            <p class="text-gray-600 text-sm mb-6 line-clamp-2">{{ Str::limit($event->description, 100) }}</p>
                            
                            <!-- Premium action button -->
                            <a href="/events/{{ $event->slug }}" 
                               class="block w-full bg-gradient-to-r from-amber-500 via-orange-500 to-red-500 hover:from-amber-600 hover:via-orange-600 hover:to-red-600 text-white py-4 px-6 rounded-xl font-bold text-center transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                <span class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 616 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Lihat Detail Event
                                </span>
                            </a>
                        </div>
                        
                        <!-- Premium bottom border with animation -->
                        <div class="h-3 bg-gradient-to-r from-amber-400 via-orange-400 via-red-400 to-pink-400 transform group-hover:scale-x-110 transition-transform duration-500 origin-center"></div>
                    </div>

                    @else
                    <!-- Standard Card - Default Design -->
                    <div class="event-card group bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 overflow-hidden border border-amber-100/50">
                        <!-- Standard Image Container -->
                        <div class="relative overflow-hidden">
                            <div class="aspect-[4/3] relative">
                                <img src="{{ $event->main_image_url }}" 
                                     alt="{{ $event->name }}"
                                     class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                     onerror="this.src='https://via.placeholder.com/400x300/f59e0b/ffffff?text=Event'">
                            </div>
                            
                            <!-- Overlay Badges -->
                            <div class="absolute top-4 left-4 right-4 flex justify-between items-start">
                                <span class="px-3 py-1.5 {{ $statusColor['bg'] }} text-white rounded-full text-xs font-bold shadow-lg backdrop-blur-sm">
                                    {{ $event->status_label }}
                                </span>
                                
                                <button onclick="toggleEventFavorite({{ $event->id }})" 
                                        class="w-12 h-12 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg hover:bg-white hover:scale-110 transition-all duration-300 group/fav">
                                    <svg class="w-6 h-6 text-amber-600 group-hover/fav:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Standard Card Content -->
                        <div class="p-6">
                            <!-- Event Name -->
                            <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2 group-hover:text-amber-700 transition-colors">
                                {{ $event->name }}
                            </h3>
                            
                            <!-- Event Details -->
                            <div class="space-y-2 text-sm text-gray-600 mb-4">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="font-medium">{{ $event->date_range }}</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 616 0z"></path>
                                    </svg>
                                    <span class="font-medium">{{ Str::limit($event->location, 30) }}</span>
                                </div>
                                @if($event->organizer)
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-2 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    <span class="font-medium">{{ $event->organizer }}</span>
                                </div>
                                @endif
                            </div>
                            
                            <!-- Description -->
                            <p class="text-gray-600 text-sm mb-6 line-clamp-3 leading-relaxed">
                                {{ Str::limit($event->description, 120) }}
                            </p>
                            
                            <!-- Action Button -->
                            <a href="/events/{{ $event->slug }}" 
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
                    @endif
                    @endforeach
                </div>

                <!-- Enhanced Pagination -->
                @if($events->hasPages())
                    <div class="mt-20 flex justify-center">
                        <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow-xl border border-amber-200/50 p-6">
                            <div class="flex items-center justify-center space-x-2">
                                {{ $events->appends(request()->query())->links('pagination::tailwind') }}
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-800 mb-4">Belum Ada Event</h3>
                        <p class="text-gray-600 mb-8 leading-relaxed">
                            Maaf, belum ada event yang tersedia saat ini atau sesuai dengan filter pencarian Anda. 
                            Silakan coba kata kunci lain atau periksa kembali nanti.
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <a href="/events" class="inline-flex items-center bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white px-8 py-4 rounded-xl font-bold transition-all duration-300 transform hover:scale-105 shadow-lg">
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
        .event-card {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .event-card:hover {
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
            const form = document.getElementById('eventFilterForm');
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
            updateEventFavoriteButtons();
        });

        // Enhanced favorite toggle function
        function toggleEventFavorite(eventId) {
            try {
                const favorites = JSON.parse(localStorage.getItem('event_favorites') || '[]');
                const index = favorites.indexOf(eventId);
                
                if (index === -1) {
                    favorites.push(eventId);
                    showNotification('🎉 Event ditambahkan ke favorit!', 'success');
                } else {
                    favorites.splice(index, 1);
                    showNotification('💔 Event dihapus dari favorit!', 'info');
                }
                
                localStorage.setItem('event_favorites', JSON.stringify(favorites));
                updateEventFavoriteButtons();
            } catch (error) {
                console.error('Error toggling favorite:', error);
                showNotification('❌ Terjadi kesalahan!', 'error');
            }
        }

        // Update favorite button appearances
        function updateEventFavoriteButtons() {
            const favorites = JSON.parse(localStorage.getItem('event_favorites') || '[]');
            document.querySelectorAll('[onclick^="toggleEventFavorite"]').forEach(button => {
                const eventId = parseInt(button.getAttribute('onclick').match(/\d+/)[0]);
                const icon = button.querySelector('svg');
                
                if (favorites.includes(eventId)) {
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