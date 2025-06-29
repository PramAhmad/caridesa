<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CariDesa - Platform Website Desa Indonesia</title>
  @vite('resources/css/app.css')
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Volkhov:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
  <link rel="stylesheet" href="{{ asset('css/home.css') }}" />
</head>
<body class="font-poppins overflow-x-hidden">
    <!-- Hero Section -->
    <section id="home" class="relative min-h-screen overflow-hidden" style="background: linear-gradient(135deg, #f0fdf4, #dcfce7, #bbf7d0);">
      <!-- Background Image -->
      <div class="absolute inset-0 bg-cover bg-center bg-fixed opacity-30" style="background-image: url('{{ asset('img/home-carousel/2.jpg') }}');"></div>
      
      <!-- Floating Background Elements -->
      <div class="floating-element-1"></div>
      <div class="floating-element-2"></div>
      
      <!-- Overlay -->
      <div class="absolute inset-0" style="background: linear-gradient(135deg, rgba(35, 71, 42, 0.2), rgba(108, 154, 118, 0.1), rgba(35, 71, 42, 0.2));"></div>
      
      <div class="relative z-10 min-h-screen flex flex-col">
        <!-- Enhanced Navbar -->
        <nav class="w-full px-6 py-4 lg:px-12 lg:py-6 transition-all duration-300" id="navbar">
          <div class="max-w-7xl mx-auto flex items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center space-x-3 group cursor-pointer">
              <div class="relative">
                <img src="{{ asset('img/CariDesa - no bg.png') }}" alt="CariDesa Logo" class="w-12 h-12 lg:w-16 lg:h-16 transition-transform duration-300 group-hover:scale-110 animate-pulse-glow" />
                <div class="absolute inset-0 rounded-full blur-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300" style="background: linear-gradient(135deg, rgba(108, 154, 118, 0.3), rgba(35, 71, 42, 0.3));"></div>
              </div>
              <span class="text-xl lg:text-2xl font-volkhov font-bold text-gradient">CariDesa</span>
            </div>
            
            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center space-x-8">
              <a href="#home" class="navlink-enhanced">Home</a>
              <a href="#welcome" class="navlink-enhanced">About</a>
              <a href="#service" class="navlink-enhanced">Service</a>
              <a href="#desa" class="navlink-enhanced">Portofolio</a>
              <a href="#contact" class="navlink-enhanced">Contact</a>
            </div>
            
            <!-- Mobile Menu Button -->
            <button class="lg:hidden p-2 rounded-xl glass transition-all duration-300 hover:scale-105" onclick="toggleMobileMenu()" style="color: #23472a;">
              <i class="fas fa-bars text-xl"></i>
            </button>
          </div>
          
          <!-- Mobile Navigation -->
          <div id="mobile-menu" class="lg:hidden hidden mt-4 glass rounded-2xl shadow-2xl overflow-hidden">
            <div class="p-4 space-y-2">
              <a href="#home" class="mobile-navlink">Home</a>
              <a href="#welcome" class="mobile-navlink">About</a>
              <a href="#service" class="mobile-navlink">Service</a>
              <a href="#desa" class="mobile-navlink">Portofolio</a>
              <a href="#contact" class="mobile-navlink">Contact</a>
            </div>
          </div>
        </nav>
        
        <!-- Hero Content -->
        <div class="flex-1 flex items-center justify-center px-6 lg:px-12">
          <div class="max-w-4xl text-center">
            <h1 class="text-4xl md:text-5xl lg:text-7xl font-bold leading-tight mb-6 text-shadow">
              <span class="text-gradient">
                Platform Website Desa
              </span>
              <br>
              <span class="text-gradient">
                Terdepan di Indonesia
              </span>
            </h1>
            
            <p class="text-lg lg:text-xl mb-8 max-w-3xl mx-auto leading-relaxed" style="color: #666;">
              Kami menyediakan solusi website lengkap untuk desa-desa di Indonesia. 
              Dengan fitur pengelolaan UMKM, promosi wisata, dan sistem informasi desa 
              yang mudah digunakan dan profesional.
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
              <a href="{{ route('tenant.registration') }}" class="btn-primary">
                <span class="relative z-10">Daftar Desa</span>
                <i class="fas fa-arrow-right ml-2 transition-transform duration-300 group-hover:translate-x-1"></i>
              </a>
              
              <a href="#service" class="btn-secondary">
                <i class="fas fa-play-circle mr-2 transition-transform duration-300 group-hover:scale-110"></i>
                <span>Lihat Layanan</span>
              </a>
            </div>
          </div>
        </div>
        
        <!-- Scroll Indicator -->
        <div class="text-center pb-8">
          <div class="inline-flex flex-col items-center scroll-indicator">
            <span class="text-sm mb-2" style="color: #666;">Scroll untuk lanjut</span>
            <div class="w-6 h-10 border-2 rounded-full flex justify-center" style="border-color: #999;">
              <div class="w-1 h-3 rounded-full mt-2 animate-pulse" style="background-color: #6c9a76;"></div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- About Section -->
    <section id="welcome" class="py-20 lg:py-32 bg-white relative overflow-hidden">
      <!-- Background Pattern -->
      <div class="absolute inset-0 bg-pattern-dots"></div>
      
      <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16">
          <h2 class="text-4xl lg:text-5xl font-bold mb-6 text-gradient text-shadow">
            Tentang CariDesa
          </h2>
          
          <div class="max-w-4xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
              <div class="order-2 lg:order-1">
                <p class="text-lg leading-relaxed" style="color: #8b888899;">
                  CariDesa adalah platform penyedia website khusus untuk desa-desa di Indonesia. 
                  Kami menyediakan solusi digital lengkap yang membantu desa mengelola informasi, 
                  mempromosikan wisata lokal, dan mengembangkan UMKM melalui website yang modern 
                  dan mudah digunakan. Dengan pengalaman bertahun-tahun, kami telah membantu 
                  puluhan desa memiliki kehadiran digital yang profesional.
                </p>
              </div>
              <div class="order-1 lg:order-2 flex justify-center">
                <div class="relative group">
                  <img src="{{ asset('img/CariDesa - no bg.png') }}" alt="CariDesa Logo" class="w-48 h-48 lg:w-64 lg:h-64 transition-transform duration-500 group-hover:scale-110 animate-pulse-glow" />
                  <div class="absolute inset-0 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500" style="background: linear-gradient(135deg, rgba(108, 154, 118, 0.3), rgba(35, 71, 42, 0.3));"></div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Service Cards -->
        <div id="service" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          <!-- Website Desa Card -->
          <div class="card-enhanced group">
            <div class="relative z-10">
              <div class="icon-container">
                <i class="fa-solid fa-globe text-2xl text-white relative z-10"></i>
              </div>
              <h3 class="text-xl font-bold mb-4 transition-colors duration-300" style="color: #333;">Website Desa Profesional</h3>
              <p class="mb-6 leading-relaxed" style="color: #8b888899;">
                Pembuatan website desa yang modern, responsif, dan mudah dikelola. 
                Dilengkapi dengan fitur informasi desa, berita, dan galeri yang menarik 
                untuk meningkatkan citra desa.
              </p>
              <a href="#" class="inline-flex items-center font-semibold transition-all duration-300 hover:translate-x-1" style="color: #6c9a76;">
                Pelajari Lebih Lanjut
                <i class="fas fa-arrow-right ml-2"></i>
              </a>
            </div>
          </div>

          <!-- CMS UMKM Card -->
          <div class="card-enhanced group">
            <div class="relative z-10">
              <div class="icon-container">
                <i class="fa-solid fa-bag-shopping text-2xl text-white relative z-10"></i>
              </div>
              <h3 class="text-xl font-bold mb-4 transition-colors duration-300" style="color: #333;">Sistem Pengelolaan UMKM</h3>
              <p class="mb-6 leading-relaxed" style="color: #8b888899;">
                Platform terintegrasi untuk mengelola dan mempromosikan produk UMKM desa. 
                Membantu pelaku usaha lokal memasarkan produk mereka dengan mudah 
                melalui dashboard yang user-friendly.
              </p>
              <a href="#" class="inline-flex items-center font-semibold transition-all duration-300 hover:translate-x-1" style="color: #6c9a76;">
                Pelajari Lebih Lanjut
                <i class="fas fa-arrow-right ml-2"></i>
              </a>
            </div>
          </div>

          <!-- Sistem Informasi Card -->
          <div class="card-enhanced group md:col-span-2 lg:col-span-1">
            <div class="relative z-10">
              <div class="icon-container">
                <i class="fa-solid fa-database text-2xl text-white relative z-10"></i>
              </div>
              <h3 class="text-xl font-bold mb-4 transition-colors duration-300" style="color: #333;">Sistem Informasi Desa</h3>
              <p class="mb-6 leading-relaxed" style="color: #8b888899;">
                Sistem informasi lengkap untuk administrasi desa, pengelolaan data 
                penduduk, dan layanan publik. Meningkatkan transparansi dan 
                efisiensi pelayanan kepada masyarakat.
              </p>
              <a href="#" class="inline-flex items-center font-semibold transition-all duration-300 hover:translate-x-1" style="color: #6c9a76;">
                Pelajari Lebih Lanjut
                <i class="fas fa-arrow-right ml-2"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Portfolio Section -->
<section id="desa" class="py-20 lg:py-32 relative overflow-hidden" style="background: linear-gradient(135deg, #efefef, #f0fdf4);">
  <!-- Background Elements -->
  <div class="absolute top-0 left-0 w-full h-full opacity-10">
    <div class="absolute top-20 left-20 w-64 h-64 rounded-full blur-3xl animate-float" style="background: linear-gradient(135deg, #6c9a76, #23472a);"></div>
    <div class="absolute bottom-20 right-20 w-80 h-80 rounded-full blur-3xl animate-float-delay" style="background: linear-gradient(135deg, #23472a, #6c9a76);"></div>
  </div>
  
  <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
    <!-- Section Header -->
    <div class="text-center mb-16">
      <h2 class="text-4xl lg:text-5xl font-bold mb-6 text-gradient text-shadow">
        Fitur Lengkap Website Desa
      </h2>
      <p class="text-xl max-w-3xl mx-auto" style="color: #666;">
        Platform all-in-one untuk mengelola seluruh aspek digital desa Anda dengan mudah dan profesional
      </p>
    </div>

    <!-- Main Features Grid -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
      
      <!-- Theme Management -->
      <div class="feature-card group">
        <div class="feature-icon-container theme">
          <i class="fas fa-palette text-3xl text-white"></i>
        </div>
        <div class="p-6">
          <h3 class="text-xl font-bold mb-3" style="color: #333;">Pengaturan Tema</h3>
          <p class="text-sm mb-4 leading-relaxed" style="color: #666;">
            Kelola tampilan website dengan berbagai tema yang dapat disesuaikan. Edit konten secara dinamis tanpa coding.
          </p>
          <div class="feature-tags">
            <span class="feature-tag">Custom Design</span>
            <span class="feature-tag">Live Editor</span>
            <span class="feature-tag">Responsive</span>
          </div>
        </div>
      </div>

      <!-- Event Management -->
      <div class="feature-card group">
        <div class="feature-icon-container event">
          <i class="fas fa-calendar-alt text-3xl text-white"></i>
        </div>
        <div class="p-6">
          <h3 class="text-xl font-bold mb-3" style="color: #333;">Kelola Acara</h3>
          <p class="text-sm mb-4 leading-relaxed" style="color: #666;">
            Manajemen acara desa lengkap dengan kalender, analytics, dan sistem booking online yang terintegrasi.
          </p>
          <div class="feature-tags">
            <span class="feature-tag">Kalender Event</span>
            <span class="feature-tag">Booking System</span>
            <span class="feature-tag">Analytics</span>
          </div>
        </div>
      </div>

      <!-- Guide Management -->
      <div class="feature-card group">
        <div class="feature-icon-container guide">
          <i class="fas fa-user-tie text-3xl text-white"></i>
        </div>
        <div class="p-6">
          <h3 class="text-xl font-bold mb-3" style="color: #333;">Kelola Pemandu</h3>
          <p class="text-sm mb-4 leading-relaxed" style="color: #666;">
            Sistem manajemen tour guide dengan booking, review, keuangan, dan kalender jadwal yang komprehensif.
          </p>
          <div class="feature-tags">
            <span class="feature-tag">Guide Booking</span>
            <span class="feature-tag">Rating System</span>
            <span class="feature-tag">Finance Track</span>
          </div>
        </div>
      </div>

      <!-- Product Management -->
      <div class="feature-card group">
        <div class="feature-icon-container product">
          <i class="fas fa-shopping-bag text-3xl text-white"></i>
        </div>
        <div class="p-6">
          <h3 class="text-xl font-bold mb-3" style="color: #333;">Kelola Produk UMKM</h3>
          <p class="text-sm mb-4 leading-relaxed" style="color: #666;">
            Platform e-commerce lengkap untuk produk UMKM desa dengan kategori, inventory, dan sistem penjualan online.
          </p>
          <div class="feature-tags">
            <span class="feature-tag">Catalog Online</span>
            <span class="feature-tag">Inventory</span>
            <span class="feature-tag">E-commerce</span>
          </div>
        </div>
      </div>

      <!-- Tourism Management -->
      <div class="feature-card group">
        <div class="feature-icon-container tourism">
          <i class="fas fa-mountain text-3xl text-white"></i>
        </div>
        <div class="p-6">
          <h3 class="text-xl font-bold mb-3" style="color: #333;">Kelola Wisata</h3>
          <p class="text-sm mb-4 leading-relaxed" style="color: #666;">
            Promosi destinasi wisata desa dengan sistem booking, review, analytics, dan galeri foto yang menarik.
          </p>
          <div class="feature-tags">
            <span class="feature-tag">Tourism Booking</span>
            <span class="feature-tag">Photo Gallery</span>
            <span class="feature-tag">Reviews</span>
          </div>
        </div>
      </div>

      <!-- Homestay Management -->
      <div class="feature-card group">
        <div class="feature-icon-container homestay">
          <i class="fas fa-home text-3xl text-white"></i>
        </div>
        <div class="p-6">
          <h3 class="text-xl font-bold mb-3" style="color: #333;">Kelola Homestay</h3>
          <p class="text-sm mb-4 leading-relaxed" style="color: #666;">
            Manajemen penginapan desa dengan sistem reservasi, analytics okupansi, dan review dari tamu.
          </p>
          <div class="feature-tags">
            <span class="feature-tag">Reservation</span>
            <span class="feature-tag">Occupancy</span>
            <span class="feature-tag">Guest Reviews</span>
          </div>
        </div>
      </div>

    </div>

    <!-- Advanced Features -->
    <div class="mb-16">
      <h3 class="text-2xl font-bold text-center mb-8" style="color: #333;">Fitur Lanjutan</h3>
      <div class="grid md:grid-cols-2 gap-8">
        
        <!-- User Management -->
        <div class="advanced-feature-card">
          <div class="flex items-start space-x-4">
            <div class="w-16 h-16 rounded-xl flex items-center justify-center flex-shrink-0 advanced-feature-icon-blue">
              <i class="fas fa-users-cog text-2xl text-white"></i>
            </div>
            <div class="flex-1">
              <h4 class="text-lg font-bold mb-2" style="color: #333;">User Management</h4>
              <p class="text-sm mb-3 leading-relaxed" style="color: #666;">
                Sistem manajemen pengguna dengan roles dan permissions yang fleksibel. Kontrol akses berbasis peran untuk keamanan optimal.
              </p>
              <div class="flex flex-wrap gap-2">
                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">Role Management</span>
                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">Permissions</span>
                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">User Profiles</span>
              </div>
            </div>
          </div>
        </div>

        <!-- System Settings -->
        <div class="advanced-feature-card">
          <div class="flex items-start space-x-4">
            <div class="w-16 h-16 rounded-xl flex items-center justify-center flex-shrink-0 advanced-feature-icon-purple">
              <i class="fas fa-cogs text-2xl text-white"></i>
            </div>
            <div class="flex-1">
              <h4 class="text-lg font-bold mb-2" style="color: #333;">Pengaturan Sistem</h4>
              <p class="text-sm mb-3 leading-relaxed" style="color: #666;">
                Konfigurasi sistem lengkap dengan pengaturan keamanan, backup otomatis, dan monitoring aktivitas sistem.
              </p>
              <div class="flex flex-wrap gap-2">
                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">Security</span>
                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">Auto Backup</span>
                <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">System Logs</span>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>

    <!-- Integration Showcase -->
    <div class="bg-white rounded-3xl p-8 lg:p-12 shadow-xl border border-gray-100">
      <div class="text-center mb-12">
        <h3 class="text-3xl font-bold mb-4" style="color: #333;">Semua Terintegrasi Dalam Satu Dashboard</h3>
        <p class="text-lg max-w-2xl mx-auto" style="color: #666;">
          Kelola seluruh aspek digital desa Anda dari satu tempat dengan interface yang user-friendly dan responsif
        </p>
      </div>
      
      <!-- Dashboard Preview -->
      <div class="relative">
        <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-2xl p-6 shadow-2xl">
          <!-- Mock Dashboard Header -->
          <div class="flex items-center justify-between mb-6">
            <div class="flex items-center space-x-3">
              <img src="{{ asset('img/CariDesa - no bg.png') }}" alt="CariDesa" class="w-8 h-8" />
              <span class="text-white text-lg font-bold">Dashboard Desa</span>
            </div>
            <div class="flex items-center space-x-2">
              <div class="w-2 h-2 bg-red-500 rounded-full"></div>
              <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
              <div class="w-2 h-2 bg-green-500 rounded-full"></div>
            </div>
          </div>
          
          <!-- Mock Dashboard Content -->
          <div class="grid md:grid-cols-3 gap-4 mb-6">
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-4 text-white">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-blue-100 text-sm">Total Wisatawan</p>
                  <p class="text-2xl font-bold">2,847</p>
                </div>
                <i class="fas fa-users text-blue-200 text-2xl"></i>
              </div>
            </div>
            <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg p-4 text-white">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-green-100 text-sm">Produk UMKM</p>
                  <p class="text-2xl font-bold">156</p>
                </div>
                <i class="fas fa-shopping-bag text-green-200 text-2xl"></i>
              </div>
            </div>
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg p-4 text-white">
              <div class="flex items-center justify-between">
                <div>
                  <p class="text-purple-100 text-sm">Acara Aktif</p>
                  <p class="text-2xl font-bold">12</p>
                </div>
                <i class="fas fa-calendar text-purple-200 text-2xl"></i>
              </div>
            </div>
          </div>
          
          <!-- Mock Chart Area -->
          <div class="bg-gray-700 rounded-lg h-32 flex items-center justify-center">
            <p class="text-gray-400">📊 Analytics & Reports</p>
          </div>
        </div>
        
        <!-- Floating Feature Icons -->
        <div class="absolute -top-4 -right-4 w-12 h-12 bg-gradient-to-r from-pink-500 to-rose-500 rounded-full flex items-center justify-center shadow-lg animate-bounce">
          <i class="fas fa-heart text-white"></i>
        </div>
        <div class="absolute -bottom-4 -left-4 w-12 h-12 bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full flex items-center justify-center shadow-lg animate-pulse">
          <i class="fas fa-rocket text-white"></i>
        </div>
      </div>
    </div>

    <!-- CTA Section -->
    <div class="text-center mt-16">
      <h3 class="text-2xl font-bold mb-4" style="color: #333;">Siap Memulai?</h3>
      <p class="text-lg mb-8 max-w-2xl mx-auto" style="color: #666;">
        Bergabunglah dengan puluhan desa yang telah merasakan manfaat digitalisasi dengan platform CariDesa
      </p>
      <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
        <a href="{{ route('tenant.registration') }}" class="btn-primary">
          <i class="fas fa-rocket mr-2"></i>
          <span>Mulai Sekarang</span>
        </a>
        <a href="#contact" class="btn-secondary">
          <i class="fas fa-phone mr-2"></i>
          <span>Konsultasi Gratis</span>
        </a>
      </div>
    </div>
  </div>
</section>

    <!-- List Tenant Section -->
    <section id="tenant-list" class="py-20 lg:py-32 bg-white relative overflow-hidden">
      <!-- Background Pattern -->
      <div class="absolute inset-0 bg-pattern-dots opacity-30"></div>
      
      <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
        <!-- Section Header -->
        <div class="text-center mb-16">
          <h2 class="text-4xl lg:text-5xl font-bold mb-6 text-gradient text-shadow">
            Desa-Desa Terdaftar
          </h2>
          <p class="text-xl max-w-3xl mx-auto" style="color: #666;">
            Daftar desa yang telah bergabung dengan platform CariDesa dan telah memiliki website
          </p>
        </div>

        <!-- Action Buttons -->
        <div class="text-center mb-12">
          <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
            <a href="{{ route('tenant.registration') }}" class="btn-primary">
              <i class="fas fa-plus mr-2"></i>
              <span>Daftarkan Desa Anda</span>
            </a>
            
            <a href="#cek-status" class="btn-secondary" onclick="toggleStatusChecker()">
              <i class="fas fa-search mr-2"></i>
              <span>Cek Status Pendaftaran</span>
            </a>
          </div>
        </div>

        <!-- Status Checker (Hidden by default) -->
        <div id="status-checker" class="hidden mb-12">
          <div class="max-w-md mx-auto bg-white rounded-2xl shadow-lg p-6 border border-gray-200">
            <h3 class="text-lg font-bold mb-4 text-center" style="color: #333;">
              Cek Status Pendaftaran
            </h3>
            <form action="{{ route('tenant.status', '') }}" method="GET" onsubmit="return redirectToStatus(event)">
              <div class="form-group mb-4">
                <label class="form-label">ID Tenant</label>
                <input type="text" 
                       id="tenant-id-input" 
                       class="form-input" 
                       placeholder="Masukan ID Tenant (contoh: desa-sukamaju)"
                       required>
              </div>
              <button type="submit" class="btn-primary w-full justify-center">
                <i class="fas fa-search mr-2"></i>
                Cek Status
              </button>
            </form>
          </div>
        </div>

        <!-- Tenant List Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
          @forelse($activeTenants as $tenant)
          <div class="tenant-card group">
            <!-- Header -->
            <div class="p-6 border-b border-gray-100">
              <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-3">
                  <div class="w-12 h-12 rounded-full flex items-center justify-center" style="background: linear-gradient(135deg, #6c9a76, #23472a);">
                    <i class="fas fa-map-marker-alt text-white"></i>
                  </div>
                  <div>
                    <h3 class="font-bold text-lg" style="color: #333;">{{ $tenant->nama_desa }}</h3>
                    <p class="text-sm" style="color: #666;">{{ $tenant->kecamatan }}, {{ $tenant->kota }}</p>
                  </div>
                </div>
                <div class="flex items-center space-x-1 px-2 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">
                  <i class="fas fa-check-circle"></i>
                  <span>Aktif</span>
                </div>
              </div>
              
              <p class="text-sm leading-relaxed" style="color: #666;">
                {{ Str::limit($tenant->tujuan, 100) }}
              </p>
            </div>
            
            <!-- Info -->
            <div class="p-6">
              <div class="space-y-3 mb-6">
                <div class="flex items-center justify-between text-sm">
                  <span style="color: #666;">Penanggung Jawab:</span>
                  <span class="font-medium" style="color: #333;">{{ $tenant->nama }}</span>
                </div>
                <div class="flex items-center justify-between text-sm">
                  <span style="color: #666;">Provinsi:</span>
                  <span class="font-medium" style="color: #333;">{{ $tenant->provinsi }}</span>
                </div>
                <div class="flex items-center justify-between text-sm">
                  <span style="color: #666;">Terdaftar:</span>
                  <span class="font-medium" style="color: #333;">{{ $tenant->created_at->format('M Y') }}</span>
                </div>
              </div>
              
              <!-- Actions -->
              <div class="flex flex-col sm:flex-row gap-3">
                @if($tenant->domains->first())
                <a href="https://{{ $tenant->domains->first()->domain }}" 
                   target="_blank"
                   class="flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-300 text-sm font-medium">
                  <i class="fas fa-external-link-alt mr-2"></i>
                  Kunjungi Website
                </a>
                @endif
                
                <a href="{{ route('tenant.status', $tenant->id) }}"
                   class="flex items-center justify-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors duration-300 text-sm font-medium">
                  <i class="fas fa-info-circle mr-2"></i>
                  Detail Status
                </a>
              </div>
            </div>
          </div>
          @empty
          <div class="col-span-full text-center py-16">
            <div class="max-w-md mx-auto">
              <i class="fas fa-village text-6xl mb-4" style="color: #6c9a76;"></i>
              <h3 class="text-xl font-bold mb-2" style="color: #333;">Belum Ada Desa Terdaftar</h3>
              <p class="mb-6" style="color: #666;">
                Jadilah desa pertama yang bergabung dengan platform CariDesa
              </p>
              <a href="{{ route('tenant.registration') }}" class="btn-primary">
                <i class="fas fa-plus mr-2"></i>
                Daftarkan Desa Anda
              </a>
            </div>
          </div>
          @endforelse
        </div>
        
        <!-- View All Button -->
        @if($activeTenants->count() > 0)
        <div class="text-center mt-12">
          <a href="/tenants" class="btn-secondary">
            <span>Lihat Semua Desa</span>
            <i class="fas fa-arrow-right ml-2"></i>
          </a>
        </div>
        @endif
      </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 lg:py-32 relative overflow-hidden" style="background: linear-gradient(135deg, #23472a, #6c9a76);">
      <!-- Background Pattern -->
      <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0 transform -skew-y-12" style="background: linear-gradient(to right, transparent, rgba(255,255,255,0.2), transparent);"></div>
        <div class="absolute inset-0 transform skew-y-12" style="background: linear-gradient(to left, transparent, rgba(255,255,255,0.1), transparent);"></div>
      </div>
      
      <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16">
          <!-- Contact Form -->
          <div class="order-2 lg:order-1">
            <div class="form-enhanced">
              <h3 class="text-3xl lg:text-4xl font-bold mb-4" style="color: #333;">
                Kontak Kami
              </h3>
              <p class="mb-8" style="color: #666;">
                Diskusikan jika anda membutuhkan bantuan dalam pembuatan website desa.
              </p>
              
              <form class="space-y-6">
                <div class="grid md:grid-cols-2 gap-6">
                  <div class="form-group">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-input" />
                  </div>
                  <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-input" />
                  </div>
                </div>
               
                
                <div class="form-group">
                  <label class="form-label">Pesan</label>
                  <textarea rows="6" class="form-input form-textarea" placeholder="Masukan Pesan Anda..."></textarea>
                </div>
                
                <button type="submit" class="form-button">
                  Kirim Konsultasi
                </button>
              </form>
            </div>
          </div>
          
          <!-- Map -->
          <div class="order-1 lg:order-2">
            <div class="h-full min-h-[500px] rounded-3xl overflow-hidden shadow-2xl">
              <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3998.4340863241327!2d108.2518990750476!3d-7.329945292678404!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6f59eeb6bda36f%3A0xa9e724a275da6c2d!2sSMK%20Negeri%204%20Tasikmalaya!5e1!3m2!1sid!2sid!4v1750658833901!5m2!1sid!2sid"
                width="100%"
                height="100%"
                style="border: 0; min-height: 500px; filter: grayscale(1); transition: filter 0.5s ease;"
                allowfullscreen=""
                loading="lazy"
                onmouseover="this.style.filter='grayscale(0)'"
                onmouseout="this.style.filter='grayscale(1)'">
              </iframe>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Enhanced Footer -->
    <footer class="py-16 relative overflow-hidden" style="background-color: #1a1a1a; color: white;">
      <!-- Background Pattern -->
      <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0 transform -skew-y-3" style="background: linear-gradient(to right, #6c9a76, #6c9a76, #6c9a76);"></div>
      </div>
      
      <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">
          <!-- Company Info -->
          <div class="lg:col-span-2 space-y-6">
            <div class="flex items-center space-x-3">
              <img src="{{ asset('img/CariDesa - no bg.png') }}" alt="CariDesa Logo" class="w-12 h-12" />
              <span class="text-2xl font-volkhov font-bold">CariDesa</span>
            </div>
            <p class="leading-relaxed max-w-md" style="color: #999;">
              Platform terdepan untuk pembuatan website desa di Indonesia. 
              Kami berkomitmen membantu desa-desa memiliki kehadiran digital 
              yang profesional dan modern.
            </p>
            <div class="flex space-x-4">
              <a href="#" class="w-10 h-10 rounded-full flex items-center justify-center transition-colors duration-300" style="background-color: #6c9a76;" onmouseover="this.style.backgroundColor='#23472a'" onmouseout="this.style.backgroundColor='#6c9a76'">
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="#" class="w-10 h-10 rounded-full flex items-center justify-center transition-colors duration-300" style="background-color: #6c9a76;" onmouseover="this.style.backgroundColor='#23472a'" onmouseout="this.style.backgroundColor='#6c9a76'">
                <i class="fab fa-instagram"></i>
              </a>
              <a href="#" class="w-10 h-10 rounded-full flex items-center justify-center transition-colors duration-300" style="background-color: #6c9a76;" onmouseover="this.style.backgroundColor='#23472a'" onmouseout="this.style.backgroundColor='#6c9a76'">
                <i class="fab fa-linkedin-in"></i>
              </a>
              <a href="#" class="w-10 h-10 rounded-full flex items-center justify-center transition-colors duration-300" style="background-color: #6c9a76;" onmouseover="this.style.backgroundColor='#23472a'" onmouseout="this.style.backgroundColor='#6c9a76'">
                <i class="fab fa-whatsapp"></i>
              </a>
            </div>
          </div>
          
          <!-- Office Address -->
          <div class="space-y-4">
            <h4 class="text-lg font-bold" style="color: #6c9a76;">Alamat Kantor</h4>
            <div class="space-y-2" style="color: #999;">
              <p class="flex items-start">
                <i class="fas fa-map-marker-alt mt-1 mr-2" style="color: #6c9a76;"></i>
                <span>Jl. Pendidikan No. 234<br>Tasikmalaya, Jawa Barat<br>Indonesia 46115</span>
              </p>
            </div>
          </div>
          
          <!-- Contact Info -->
          <div class="space-y-4">
            <h4 class="text-lg font-bold" style="color: #6c9a76;">Kontak</h4>
            <div class="space-y-3" style="color: #999;">
              <a href="tel:+6282113372046" class="flex items-center hover:text-white transition-colors duration-300">
                <i class="fas fa-phone mr-3" style="color: #6c9a76;"></i>
                +62 821 1337 2046
              </a>
              <a href="mailto:caridesa@gmail.com" class="flex items-center hover:text-white transition-colors duration-300">
                <i class="fas fa-envelope mr-3" style="color: #6c9a76;"></i>
                caridesa@gmail.com
              </a>
              <a href="https://wa.me/6282113372046" class="flex items-center hover:text-white transition-colors duration-300">
                <i class="fab fa-whatsapp mr-3" style="color: #6c9a76;"></i>
                WhatsApp Konsultasi
              </a>
            </div>
          </div>
        </div>
        
        <!-- Copyright -->
        <div class="border-t mt-12 pt-8 text-center" style="border-color: #333; color: #999;">
          <p>&copy; 2024 CariDesa. Semua hak dilindungi undang-undang. Platform Website Desa Terpercaya.</p>
        </div>
      </div>
    </footer>

    <!-- Enhanced JavaScript -->
    <script>
      // Mobile Menu Toggle
      function toggleMobileMenu() {
        const mobileMenu = document.getElementById('mobile-menu');
        mobileMenu.classList.toggle('hidden');
      }
      
      // Smooth Scrolling for Navigation Links
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
      
      // Enhanced navbar scroll effect
      window.addEventListener('scroll', function() {
        const navbar = document.getElementById('navbar');
        if (window.scrollY > 100) {
          navbar.style.background = 'rgba(255, 255, 255, 0.95)';
          navbar.style.backdropFilter = 'blur(15px)';
          navbar.style.boxShadow = '0 10px 30px rgba(35, 71, 42, 0.1)';
        } else {
          navbar.style.background = 'transparent';
          navbar.style.backdropFilter = 'none';
          navbar.style.boxShadow = 'none';
        }
      });

      // Close mobile menu when clicking outside
      document.addEventListener('click', function(event) {
        const mobileMenu = document.getElementById('mobile-menu');
        const toggleButton = event.target.closest('button');
        
        if (!toggleButton && !mobileMenu.contains(event.target)) {
          mobileMenu.classList.add('hidden');
        }
      });

      // Enhanced form interactions
      document.querySelectorAll('.form-input').forEach(input => {
        input.addEventListener('focus', function() {
          this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
          this.parentElement.classList.remove('focused');
        });
      });

      // Intersection Observer for animations
      const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
      };

      const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
          }
        });
      }, observerOptions);

      // Observe all cards for animation
      document.querySelectorAll('.card-enhanced, .portfolio-card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(card);
      });

      // JavaScript for status checker
      function toggleStatusChecker() {
        const checker = document.getElementById('status-checker');
        checker.classList.toggle('hidden');
        if (!checker.classList.contains('hidden')) {
          checker.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
      }

      function redirectToStatus(event) {
        event.preventDefault();
        const tenantId = document.getElementById('tenant-id-input').value.trim();
        if (tenantId) {
          window.location.href = `/status-pendaftaran/${tenantId}`;
        }
        return false;
      }
    </script>

    <!-- Additional CSS for tenant cards -->
    <style>
    .tenant-card {
      background: white;
      border-radius: 1.5rem;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
      border: 1px solid #f0f0f0;
      overflow: hidden;
    }

    .tenant-card:hover {
      transform: translateY(-8px);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
      border-color: #6c9a76;
    }

    #status-checker {
      transition: all 0.3s ease;
    }

    #status-checker.show {
      display: block !important;
      animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* New styles for Features Showcase Section */
    #desa {
      background: linear-gradient(135deg, #efefef, #f0fdf4);
    }

    .feature-card {
      background: white;
      border-radius: 1.5rem;
      overflow: hidden;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
      transition: all 0.4s ease;
      border: 1px solid #f0f0f0;
      position: relative;
    }

    .feature-card:hover {
      transform: translateY(-12px);
      box-shadow: 0 25px 50px rgba(108, 154, 118, 0.15);
      border-color: #6c9a76;
    }

    .feature-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, #6c9a76, #23472a);
      transform: scaleX(0);
      transition: transform 0.4s ease;
    }

    .feature-card:hover::before {
      transform: scaleX(1);
    }

    .feature-icon-container {
      width: 80px;
      height: 80px;
      border-radius: 1.5rem;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 2rem auto 1rem;
    }

    /* Semua icon menggunakan gradasi hijau */
    .feature-icon-container.theme {
      background: linear-gradient(135deg, #6c9a76, #23472a);
    }

    .feature-icon-container.event {
      background: linear-gradient(135deg, #52c41a, #389e0d);
    }

    .feature-icon-container.guide {
      background: linear-gradient(135deg, #73d13d, #52c41a);
    }

    .feature-icon-container.product {
      background: linear-gradient(135deg, #10b981, #059669);
    }

    .feature-icon-container.tourism {
      background: linear-gradient(135deg, #16a085, #138d75);
    }

    .feature-icon-container.homestay {
      background: linear-gradient(135deg, #6c9a76, #2d5016);
    }

    .feature-tags {
      display: flex;
      flex-wrap: wrap;
      gap: 0.5rem;
    }

    .feature-tag {
      padding: 0.25rem 0.75rem;
      background: #f6ffed;
      color: #389e0d;
      border: 1px solid #b7eb8f;
      border-radius: 9999px;
      font-size: 0.75rem;
      font-weight: 500;
      transition: all 0.3s ease;
    }

    .feature-card:hover .feature-tag {
      background: #d9f7be;
      color: #135200;
      border-color: #52c41a;
    }

    .advanced-feature-card {
      background: white;
      border-radius: 1.5rem;
      padding: 2rem;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
      border: 1px solid #f0f0f0;
      transition: all 0.3s ease;
    }

    .advanced-feature-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 30px rgba(108, 154, 118, 0.1);
      border-color: #6c9a76;
    }

    /* Update advanced features dengan warna hijau */
    .advanced-feature-icon-blue {
      background: linear-gradient(135deg, #52c41a, #389e0d) !important;
    }

    .advanced-feature-icon-purple {
      background: linear-gradient(135deg, #73d13d, #52c41a) !important;
    }

    /* Animation keyframes tetap sama */
    @keyframes float {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-20px); }
    }

    @keyframes float-delay {
      0%, 100% { transform: translateY(0px); }
      50% { transform: translateY(-15px); }
    }

    .animate-float {
      animation: float 6s ease-in-out infinite;
    }

    .animate-float-delay {
      animation: float-delay 8s ease-in-out infinite;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
      .feature-icon-container {
        width: 60px;
        height: 60px;
        margin: 1.5rem auto 1rem;
      }
      
      .feature-icon-container i {
        font-size: 1.5rem !important;
      }
      
      .advanced-feature-card {
        padding: 1.5rem;
      }
    }
    </style>
  </body>
</html>