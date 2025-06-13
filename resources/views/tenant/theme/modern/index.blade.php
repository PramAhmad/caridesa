<x-layouts.tenant>
@if($activeTheme && $activeTheme->activeContents->where('section', 'hero')->first())
    @php $hero = $activeTheme->activeContents->where('section', 'hero')->first(); @endphp
    <!-- Modern Theme Hero Section - Portal Desa Professional -->
    <section class="relative min-h-screen bg-white">
        <!-- Grid Background -->
        <div class="absolute inset-0 bg-grid-pattern opacity-5"></div>
        
        <div class="relative z-10 flex items-center min-h-screen">
            <div class="max-w-7xl mx-auto px-4 w-full">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <!-- Left Content -->
                    <div class="animate-on-scroll">
                        <div class="inline-block px-4 py-2 bg-gray-100 rounded-full text-sm font-medium text-gray-600 mb-6">
                            🏛️ Pemerintahan Digital
                        </div>
                        <h1 class="text-5xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                            {{ $hero->title }}
                        </h1>
                        <p class="text-xl text-gray-600 mb-8 leading-relaxed max-w-xl">
                            {!! $hero->content !!}
                        </p>
                        <div class="flex flex-col sm:flex-row gap-4 mb-12">
                            <button class="bg-black text-white px-8 py-4 rounded-lg font-semibold transition-all duration-300 hover:bg-gray-800 transform hover:scale-105">
                                <span class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Layanan Online
                                </span>
                            </button>
                            <button class="border-2 border-gray-300 text-gray-700 px-8 py-4 rounded-lg font-semibold transition-all duration-300 hover:border-gray-400 hover:bg-gray-50">
                                <span class="flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Info Desa
                                </span>
                            </button>
                        </div>
                        
                        <!-- Government Services Stats -->
                        <div class="grid grid-cols-3 gap-6">
                            <div class="text-center">
                                <div class="text-3xl font-bold text-gray-900">24/7</div>
                                <div class="text-sm text-gray-500">Layanan Online</div>
                            </div>
                            <div class="text-center">
                                <div class="text-3xl font-bold text-gray-900">15+</div>
                                <div class="text-sm text-gray-500">Jenis Surat</div>
                            </div>
                            <div class="text-3xl font-bold text-gray-900">99%</div>
                                <div class="text-sm text-gray-500">Kepuasan</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Visual -->
                    <div class="animate-on-scroll">
                        @if($hero->image)
                            <div class="relative">
                                <img src="{{ asset('image/themes/' . $hero->image) }}"
                                     alt="{{ $hero->title }}"
                                     class="w-full h-96 object-cover rounded-2xl shadow-2xl">
                                <!-- Government badge -->
                                <div class="absolute -top-4 -left-4 w-20 h-20 bg-blue-600 rounded-full flex items-center justify-center shadow-lg">
                                    <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 4a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                            </div>
                        @else
                            <!-- Default government building illustration -->
                            <div class="relative">
                                <div class="bg-gradient-to-br from-gray-900 to-gray-700 rounded-2xl p-8 shadow-2xl">
                                    <div class="bg-white rounded-lg p-8 text-center">
                                        <svg class="w-20 h-20 mx-auto text-blue-500 mb-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2H4zm3 2h2v4H7V6zm6 0h2v4h-2V6zM7 12h2v2H7v-2zm6 0h2v2h-2v-2z" clip-rule="evenodd"/>
                                        </svg>
                                        <h3 class="text-lg font-semibold text-gray-800">Kantor Desa Digital</h3>
                                        <p class="text-gray-600">Pelayanan modern & transparan</p>
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
.bg-grid-pattern {
    background-image: url("data:image/svg+xml,%3csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3e%3cg fill='none' fill-rule='evenodd'%3e%3cg fill='%23000000' fill-opacity='1'%3e%3ccircle cx='7' cy='7' r='1'/%3e%3c/g%3e%3c/g%3e%3c/svg%3e");
}
</style>
</x-layouts.tenant>