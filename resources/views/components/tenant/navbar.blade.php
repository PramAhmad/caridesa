@props([
    'theme' => 'art', // default theme
    'transparent' => false,
    'fixed' => true
])

@php
    $themes = [
        'art' => [
            'primary' => 'from-amber-600 to-orange-600',
            'secondary' => 'from-amber-500 to-orange-500',
            'accent' => 'text-amber-600',
            'bg' => 'bg-amber-50',
            'border' => 'border-amber-200'
        ],
        'nature' => [
            'primary' => 'from-green-600 to-emerald-600',
            'secondary' => 'from-green-500 to-emerald-500',
            'accent' => 'text-green-600',
            'bg' => 'bg-green-50',
            'border' => 'border-green-200'
        ],
        'modern' => [
            'primary' => 'from-blue-600 to-indigo-600',
            'secondary' => 'from-blue-500 to-indigo-500',
            'accent' => 'text-blue-600',
            'bg' => 'bg-blue-50',
            'border' => 'border-blue-200'
        ]
    ];
    
    $currentTheme = $themes[$theme] ?? $themes['art'];
    $navClasses = $transparent 
        ? 'bg-white/95 backdrop-blur-md border-white/20' 
        : 'bg-white border-gray-200';
    $navClasses .= $fixed ? ' fixed top-0 left-0 right-0 z-50' : '';
    
    // Get current route for active states
    $currentRoute = request()->route()->getName() ?? '';
    $currentPath = request()->path();
@endphp

<nav class="{{ $navClasses }} border-b shadow-sm transition-all duration-300" id="main-navbar">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16 lg:h-20">
            <!-- Logo & Brand -->
            <div class="flex items-center">
                <a href="/" class="flex items-center space-x-3 group">
                    <!-- Logo -->
                    <div class="w-10 h-10 lg:w-12 lg:h-12 bg-gradient-to-r bg-amber-600 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-xl transition-all duration-300 transform group-hover:scale-105">
                        <svg class="w-6 h-6 lg:w-7 lg:h-7 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                        </svg>
                    </div>
                    
                    <!-- Brand Text -->
                    <div class="hidden sm:block">
                        <div class="text-xl lg:text-2xl font-bold bg-gradient-to-r bg-amber-600 bg-clip-text text-transparent">
                            Wave
                        </div>
                        <div class="text-xs text-gray-500 -mt-1">
                            Portal Budaya & Wisata
                        </div>
                    </div>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center space-x-8">
                <a href="/" class="nav-link {{ $currentRoute === 'home' || $currentPath === '/' ? 'active' : '' }}">
                 
                    Beranda
                </a>
                
                <!-- a products -->
                 <a href="/products" class="nav-link {{ $currentRoute === 'public.products' || str_contains($currentPath, 'product') ? 'active' : '' }}">
           
                    Produk
                </a>

                <a href="/wisatas" class="nav-link {{ $currentRoute === 'public.wisata' || str_contains($currentPath, 'wisata') ? 'active' : '' }}">
                  
                    Wisata
                </a>

                <a href="/homestays" class="nav-link {{ $currentRoute === 'public.homestay' || str_contains($currentPath, 'homestay') ? 'active' : '' }}">
         
                    Homestay
                </a>

                <a href="/events" class="nav-link {{ $currentRoute === 'public.events' || str_contains($currentPath, 'events') ? 'active' : '' }}">
                 
                    Acara
                </a>

                <a href="/guides" class="nav-link {{ $currentRoute === 'public.guides' || str_contains($currentPath, 'guides') ? 'active' : '' }}">
               
                    Pemandu
                </a>
            </div>

            <!-- Search & CTA -->
            <div class="hidden lg:flex items-center space-x-4">
                <!-- Search Button -->
                <button class="p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors duration-200" onclick="toggleSearch()">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>

                <!-- Contact CTA -->
                <a href="#contact" class="cta-button">
                  
                    Hubungi Kami
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <div class="lg:hidden">
                <button class="mobile-menu-button p-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                    <svg class="w-6 h-6 menu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg class="w-6 h-6 close-icon hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Search Overlay -->
    <div id="search-overlay" class="fixed inset-0 bg-black/50 z-40 hidden" onclick="toggleSearch()">
        <div class="absolute top-20 left-1/2 transform -translate-x-1/2 w-full max-w-2xl px-4">
            <div class="bg-white rounded-2xl shadow-2xl p-6" onclick="event.stopPropagation()">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400 mr-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    <input type="text" placeholder="Cari produk, wisata, homestay..." class="flex-1 text-lg border-none outline-none" autofocus id="search-input">
                    <button onclick="toggleSearch()" class="ml-4 p-2 text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="lg:hidden hidden">
        <div class="px-4 pt-2 pb-4 space-y-2 bg-white border-t">
            <a href="/" class="mobile-nav-link {{ $currentRoute === 'home' || $currentPath === '/' ? 'active' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                </svg>
                Beranda
            </a>
            
            <!-- Mobile Products Dropdown -->
            <div class="mobile-dropdown">
                <button class="mobile-nav-link dropdown-toggle w-full text-left {{ str_contains($currentPath, 'product') ? 'active' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    Produk
                    <svg class="w-4 h-4 ml-auto transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div class="mobile-dropdown-menu hidden ml-8 mt-2 space-y-2">
                    <a href="/products" class="mobile-nav-link">
                        <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        Semua Produk
                    </a>
               
                </div>
            </div>
            
            <a href="/wisatas" class="mobile-nav-link {{ $currentRoute === 'public.wisata' || str_contains($currentPath, 'wisata') ? 'active' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Wisata
            </a>
            <a href="/homestays" class="mobile-nav-link {{ $currentRoute === 'public.homestay' || str_contains($currentPath, 'homestay') ? 'active' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2-2z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5a2 2 0 012-2h4a2 2 0 012 2v4H8V5z"></path>
                </svg>
                Homestay
            </a>
            <a href="/events" class="mobile-nav-link {{ $currentRoute === 'public.events' || str_contains($currentPath, 'events') ? 'active' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Acara
            </a>
            <a href="/guides" class="mobile-nav-link {{ $currentRoute === 'public.guides' || str_contains($currentPath, 'guides') ? 'active' : '' }}">
                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                Pemandu
            </a>
            
            <!-- Mobile Search -->
            <div class="pt-4 border-t">
                <button onclick="toggleSearch()" class="w-full flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition-colors duration-200">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Cari
                </button>
                <a href="#contact" class="w-full flex items-center px-4 py-3 bg-gradient-to-r bg-amber-600 text-white rounded-lg mt-2 hover:shadow-lg transition-all duration-300">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    Hubungi Kami
                </a>
            </div>
        </div>
    </div>
</nav>

@push('styles')
<style>
    /* Navigation Styles */
    .nav-link {
        @apply flex items-center px-4 py-2 text-gray-700 hover:text-gray-900 font-medium transition-all duration-200 rounded-lg hover:bg-gray-100 relative;
    }
    
    .nav-link.active {
        @apply {{ $currentTheme['accent'] }} bg-gradient-to-r bg-amber-600 border {{ $currentTheme['border'] }};
    }
    
    .nav-link.active::after {
        content: '';
        @apply absolute bottom-0 left-1/2 transform -translate-x-1/2 w-1/2 h-0.5 bg-gradient-to-r bg-amber-600 rounded-full;
    }
    
    .mobile-nav-link {
        @apply flex items-center px-4 py-3 text-gray-700 hover:text-gray-900 font-medium transition-all duration-200 rounded-lg hover:bg-gray-100;
    }
    
    .mobile-nav-link.active {
        @apply {{ $currentTheme['accent'] }} bg-gradient-to-r {{ $currentTheme['bg'] }} border {{ $currentTheme['border'] }};
    }
    
    .dropdown-menu {
        @apply absolute top-full left-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-gray-200 py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50;
    }
    
    .dropdown-item {
        @apply flex items-center px-4 py-3 text-gray-700 hover:text-gray-900 hover:bg-gray-100 transition-colors duration-200;
    }
    
    .cta-button {
        @apply inline-flex items-center px-6 py-2.5 bg-gradient-to-r bg-amber-600 text-white font-medium rounded-lg hover:shadow-lg transform hover:scale-105 transition-all duration-300;
    }
    
    .mobile-dropdown-toggle.active svg {
        @apply rotate-180;
    }
    
    /* Responsive adjustments */
    @media (max-width: 1024px) {
        .dropdown-menu {
            @apply relative opacity-100 visible shadow-none border-none mt-0 w-full bg-transparent;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mobile menu toggle
        const mobileMenuButton = document.querySelector('.mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const menuIcon = document.querySelector('.menu-icon');
        const closeIcon = document.querySelector('.close-icon');
        
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        });
        
        // Mobile dropdown toggle
        const mobileDropdownToggles = document.querySelectorAll('.mobile-dropdown .dropdown-toggle');
        mobileDropdownToggles.forEach(toggle => {
            toggle.addEventListener('click', function(e) {
                e.preventDefault();
                const dropdown = this.parentElement;
                const menu = dropdown.querySelector('.mobile-dropdown-menu');
                const arrow = this.querySelector('svg:last-child');
                
                menu.classList.toggle('hidden');
                arrow.classList.toggle('rotate-180');
            });
        });
    });
    
    // Search toggle
    function toggleSearch() {
        const searchOverlay = document.getElementById('search-overlay');
        const searchInput = document.getElementById('search-input');
        
        searchOverlay.classList.toggle('hidden');
        
        if (!searchOverlay.classList.contains('hidden')) {
            setTimeout(() => {
                searchInput.focus();
            }, 300);
        }
    }
    
    // Search functionality
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('search-input');
        
        if (searchInput) {
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    const searchTerm = this.value.trim();
                    if (searchTerm) {
                        window.location.href = `/products?search=${encodeURIComponent(searchTerm)}`;
                    }
                }
            });
        }
    });
    
    // Navbar scroll effect
    window.addEventListener('scroll', function() {
        const navbar = document.getElementById('main-navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('shadow-lg');
            navbar.classList.remove('shadow-sm');
        } else {
            navbar.classList.remove('shadow-lg');
            navbar.classList.add('shadow-sm');
        }
    });
</script>
@endpush