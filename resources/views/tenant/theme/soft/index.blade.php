<x-layouts.tenant>
@if($activeTheme && $activeTheme->activeContents->where('section', 'hero')->first())
    @php $hero = $activeTheme->activeContents->where('section', 'hero')->first(); @endphp
    <!-- Soft Theme Hero Section - Portal Desa Modern -->
    <section class="relative min-h-screen bg-gradient-to-br from-green-50 via-blue-50 to-indigo-50 overflow-hidden">
        <!-- Background Decorations -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-gradient-to-br from-green-200 to-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-gradient-to-br from-blue-200 to-indigo-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-2000"></div>
            <div class="absolute top-40 left-40 w-80 h-80 bg-gradient-to-br from-yellow-200 to-green-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-blob animation-delay-4000"></div>
        </div>
        
        <!-- Content -->
        <div class="relative z-10 flex items-center min-h-screen px-4">
            <div class="max-w-7xl mx-auto">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <!-- Left Content -->
                    <div class="animate-on-scroll">
                        <div class="inline-block px-4 py-2 bg-green-100 rounded-full text-sm font-medium text-green-700 mb-6">
                            🏘️ Portal Desa Digital
                        </div>
                        <h1 class="text-5xl md:text-6xl font-bold text-gray-800 mb-6 leading-tight">
                            {{ $hero->title }}
                        </h1>
                        <p class="text-xl text-gray-600 mb-8 max-w-xl leading-relaxed">
                            {!! $hero->content !!}
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 mb-8">
                            <button class="bg-gradient-to-r from-green-500 to-blue-600 hover:from-green-600 hover:to-blue-700 text-white px-8 py-4 rounded-full text-lg font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                <span class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    Jelajahi Desa
                                </span>  
                            </button>
                            <button class="bg-white bg-opacity-90 backdrop-blur-sm border border-green-200 text-green-700 px-8 py-4 rounded-full text-lg font-semibold transition-all duration-300 hover:bg-opacity-100 shadow-md hover:shadow-lg">
                                <span class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                                    </svg>
                                    UMKM Lokal
                                </span>
                            </button>
                        </div>
                        
                        <!-- Quick Stats Desa -->
                        <div class="grid grid-cols-3 gap-4 text-center">
                            <div class="bg-white bg-opacity-70 backdrop-blur-sm rounded-lg p-4">
                                <div class="text-2xl font-bold text-green-600">150+</div>
                                <div class="text-sm text-gray-600">UMKM Desa</div>
                            </div>
                            <div class="bg-white bg-opacity-70 backdrop-blur-sm rounded-lg p-4">
                                <div class="text-2xl font-bold text-blue-600">2K+</div>
                                <div class="text-sm text-gray-600">Warga</div>
                            </div>
                            <div class="bg-white bg-opacity-70 backdrop-blur-sm rounded-lg p-4">
                                <div class="text-2xl font-bold text-indigo-600">20+</div>
                                <div class="text-sm text-gray-600">Layanan</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Image/Visual -->
                    <div class="animate-on-scroll">
                        @if($hero->image)
                            <div class="relative">
                                <img  src="{{ asset('image/themes/' . $hero->image) }}"
                                     alt="{{ $hero->title }}" 
                                     class="w-full h-96 object-cover rounded-2xl shadow-2xl">
                                <!-- Overlay decoration -->
                                <div class="absolute -bottom-4 -right-4 w-20 h-20 bg-green-500 rounded-full flex items-center justify-center shadow-lg">
                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                        @else
                            <!-- Default illustration untuk desa -->
                            <div class="relative">
                                <div class="bg-gradient-to-br from-green-400 to-blue-500 rounded-2xl p-8 shadow-2xl">
                                    <div class="bg-white rounded-xl p-6 text-center">
                                        <svg class="w-20 h-20 mx-auto text-green-500 mb-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm12 12V8l-3.5-2-4.5 2.5L4 7v7h12z" clip-rule="evenodd"/>
                                        </svg>
                                        <h3 class="text-lg font-semibold text-gray-800">Desa Digital</h3>
                                        <p class="text-gray-600">Portal informasi dan layanan desa</p>
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

<!-- Existing sections with UMKM focus -->
@if($activeTheme && $activeTheme->activeContents->where('section', 'about')->first())
    @php $about = $activeTheme->activeContents->where('section', 'about')->first(); @endphp
    <!-- About Section - Tentang Desa -->
    <section class="py-16 px-4 bg-white">
        <div class="container mx-auto">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">{{ $about->title }}</h2>
                    <div class="text-gray-600 leading-relaxed prose">
                        {!! $about->content !!}
                    </div>
                </div>
                <div class="bg-gradient-to-br from-green-100 to-blue-100 h-64 rounded-lg flex items-center justify-center">
                    @if($about->image)
                        <img src="{{ asset('storage/' . $about->image) }}" alt="{{ $about->title }}" class="w-full h-full object-cover rounded-lg">
                    @else
                        <div class="text-center">
                            <svg class="w-16 h-16 mx-auto text-green-500 mb-4" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm12 12V8l-3.5-2-4.5 2.5L4 7v7h12z" clip-rule="evenodd"/>
                            </svg>
                            <span class="text-green-600 font-medium">Profil Desa</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endif

<!-- Add custom styles -->
<style>
@keyframes blob {
    0% { transform: translate(0px, 0px) scale(1); }
    33% { transform: translate(30px, -50px) scale(1.1); }
    66% { transform: translate(-20px, 20px) scale(0.9); }
    100% { transform: translate(0px, 0px) scale(1); }
}

.animate-blob { animation: blob 7s infinite; }
.animation-delay-2000 { animation-delay: 2s; }
.animation-delay-4000 { animation-delay: 4s; }

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

.animate-fadeInUp { animation: fadeInUp 0.8s ease-out; }
</style>
</x-layouts.tenant>