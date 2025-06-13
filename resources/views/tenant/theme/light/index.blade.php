<x-layouts.tenant>
@if($activeTheme && $activeTheme->activeContents->where('section', 'hero')->first())
    @php $hero = $activeTheme->activeContents->where('section', 'hero')->first(); @endphp
    <!-- Light Theme Hero Section - Desa Wisata -->
    <section class="relative min-h-screen bg-gradient-to-br from-sky-50 via-white to-green-50">
        <!-- Nature-inspired decorative elements -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-1/4 left-10 w-3 h-3 bg-sky-400 rounded-full animate-ping"></div>
            <div class="absolute top-1/3 right-20 w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
            <div class="absolute bottom-1/3 left-1/4 w-4 h-4 bg-yellow-400 rounded-full animate-bounce"></div>
            <div class="absolute bottom-1/4 right-1/3 w-2 h-2 bg-pink-400 rounded-full animate-ping"></div>
        </div>
        
        <div class="relative z-10 flex items-center min-h-screen px-4">
            <div class="max-w-7xl mx-auto">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <!-- Left Content -->
                    <div class="animate-on-scroll">
                        <!-- Tourism badge -->
                        <div class="inline-flex items-center px-4 py-2 bg-white rounded-full shadow-sm border border-sky-200 mb-8">
                            <span class="w-2 h-2 bg-green-400 rounded-full mr-2 animate-pulse"></span>
                            <span class="text-sm font-medium text-gray-600">🌿 Desa Wisata Nusantara</span>
                        </div>
                        
                        <h1 class="text-5xl md:text-7xl font-bold bg-gradient-to-r from-sky-600 via-green-600 to-blue-600 bg-clip-text text-transparent mb-6 leading-tight">
                            {{ $hero->title }}
                        </h1>
                        
                        <p class="text-xl md:text-2xl text-gray-600 mb-10 max-w-2xl leading-relaxed">
                            {!! $hero->content !!}
                        </p>
                        
                        <div class="flex flex-col sm:flex-row gap-4 justify-start items-start mb-12">
                            <button class="bg-gradient-to-r from-sky-500 to-green-500 hover:from-sky-600 hover:to-green-600 text-white px-8 py-4 rounded-full text-lg font-semibold transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                <span class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Jelajahi Wisata
                                </span>  
                            </button>
                            <button class="bg-white hover:bg-sky-50 text-sky-700 px-8 py-4 rounded-full text-lg font-semibold transition-all duration-300 shadow-md hover:shadow-lg border border-sky-200">
                                <span class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                    Paket Wisata
                                </span>
                            </button>
                        </div>
                        
                        <!-- Tourism highlights -->
                        <div class="grid grid-cols-3 gap-6">
                            <div class="text-center p-4 bg-white rounded-lg shadow-sm">
                                <div class="w-12 h-12 bg-sky-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-6 h-6 text-sky-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <div class="text-sm font-medium text-gray-600">Destinasi Alam</div>
                            </div>
                            <div class="text-center p-4 bg-white rounded-lg shadow-sm">
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <div class="text-sm font-medium text-gray-600">Kuliner Khas</div>
                            </div>
                            <div class="text-center p-4 bg-white rounded-lg shadow-sm">
                                <div class="w-12 h-12 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-2">
                                    <svg class="w-6 h-6 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                </div>
                                <div class="text-sm font-medium text-gray-600">Penginapan</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Image -->
                    <div class="animate-on-scroll">
                        @if($hero->image)
                            <div class="relative">
                                <div class="rounded-2xl overflow-hidden shadow-2xl">
                                    <img  src="{{ asset('image/themes/' . $hero->image) }}"
                                         alt="{{ $hero->title }}" 
                                         class="w-full h-96 object-cover">
                                </div>
                                <!-- Nature badge -->
                                <div class="absolute -bottom-4 -right-4 w-16 h-16 bg-green-500 rounded-full flex items-center justify-center shadow-lg">
                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                        @else
                            <!-- Tourism illustration -->
                            <div class="relative">
                                <div class="bg-gradient-to-br from-sky-400 to-green-500 rounded-2xl p-8 shadow-2xl">
                                    <div class="bg-white rounded-xl p-8 text-center">
                                        <svg class="w-20 h-20 mx-auto text-green-500 mb-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                                        </svg>
                                        <h3 class="text-xl font-bold text-gray-800">Wisata Desa</h3>
                                        <p class="text-gray-600">Keindahan alam yang memukau</p>
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
</x-layouts.tenant>