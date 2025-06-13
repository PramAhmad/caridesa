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
                            🎨 Warisan Budaya Nusantara
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
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                                    </svg>
                                    Jelajahi Budaya
                                </span>
                            </button>
                            <button class="bg-white hover:bg-amber-50 border-2 border-amber-300 text-amber-700 px-8 py-4 rounded-lg font-semibold transition-all duration-300 shadow-md hover:shadow-lg">
                                <span class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                    </svg>
                                    Kerajinan Lokal
                                </span>
                            </button>
                        </div>
                        
                        <!-- Traditional elements showcase -->
                        <div class="grid grid-cols-3 gap-4">
                            <div class="text-center p-4 bg-white bg-opacity-80 rounded-lg shadow-sm">
                                <div class="text-2xl font-bold text-amber-600">50+</div>
                                <div class="text-sm text-gray-600">Kerajinan</div>
                            </div>
                            <div class="text-center p-4 bg-white bg-opacity-80 rounded-lg shadow-sm">
                                <div class="text-2xl font-bold text-orange-600">15+</div>
                                <div class="text-sm text-gray-600">Budaya</div>
                            </div>
                            <div class="text-center p-4 bg-white bg-opacity-80 rounded-lg shadow-sm">
                                <div class="text-2xl font-bold text-red-600">100+</div>
                                <div class="text-sm text-gray-600">Tahun</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Visual -->
                    <div class="animate-on-scroll">
                        @if($hero->image)
                            <div class="relative">
                                <div class="border-8 border-amber-200 rounded-2xl overflow-hidden shadow-2xl">
                                    <img src="{{ asset('image/themes/' . $hero->image) }}"
                                         alt="{{ $hero->title }}" 
                                         class="w-full h-96 object-cover">
                                </div>
                                <!-- Traditional ornament corner -->
                                <div class="absolute -top-4 -left-4 w-16 h-16 bg-amber-500 rounded-full flex items-center justify-center shadow-lg">
                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </div>
                            </div>
                        @else
                            <!-- Traditional craft illustration -->
                            <div class="relative">
                                <div class="bg-gradient-to-br from-amber-400 to-red-500 rounded-2xl p-8 shadow-2xl">
                                    <div class="bg-white rounded-xl p-8 text-center">
                                        <svg class="w-24 h-24 mx-auto text-amber-600 mb-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h4a1 1 0 010 2H6.414l2.293 2.293a1 1 0 01-1.414 1.414L5 6.414V8a1 1 0 01-2 0V4zm9 1a1 1 0 010-2h4a1 1 0 011 1v4a1 1 0 01-2 0V6.414l-6.293 6.293a1 1 0 01-1.414-1.414L13.586 5H12z" clip-rule="evenodd"/>
                                        </svg>
                                        <h3 class="text-xl font-bold text-gray-800">Seni & Budaya</h3>
                                        <p class="text-gray-600">Warisan leluhur yang lestari</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endif

<style>
@keyframes float {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-15px) rotate(5deg); }
}

@keyframes float-delayed {
    0%, 100% { transform: translateY(0px) rotate(45deg); }
    50% { transform: translateY(-10px) rotate(50deg); }
}

@keyframes float-slow {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-8px) rotate(3deg); }
}

.animate-float { animation: float 8s ease-in-out infinite; }
.animate-float-delayed { animation: float-delayed 10s ease-in-out infinite; }
.animate-float-slow { animation: float-slow 12s ease-in-out infinite; }

.clip-triangle { clip-path: polygon(50% 0%, 0% 100%, 100% 100%); }

.bg-traditional-pattern {
    background-image: url("data:image/svg+xml,%3csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3e%3cg fill='none' fill-rule='evenodd'%3e%3cg fill='%23d97706' fill-opacity='0.3'%3e%3cpath d='M30 30c0-16.569 13.431-30 30-30v60c-16.569 0-30-13.431-30-30z'/%3e%3c/g%3e%3c/g%3e%3c/svg%3e");
}
</style>
</x-layouts.tenant>