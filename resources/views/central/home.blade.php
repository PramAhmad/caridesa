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
              <a href="#welcome" class="btn-primary">
                <span class="relative z-10">Mulai Sekarang</span>
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
            Portofolio Website Desa
          </h2>
          <p class="text-xl max-w-3xl mx-auto" style="color: #666;">
            Lihat hasil karya website desa yang telah kami buat dengan desain modern dan fungsional
          </p>
        </div>

        <!-- Portfolio Cards Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
          @for($i = 1; $i <= 4; $i++)
          <div class="portfolio-card group">
            <!-- Image -->
            <div class="portfolio-image">
              <img src="{{ asset('img/project/' . $i . '.jpg') }}" alt="Website Desa {{ $i }}" />
              <div class="absolute inset-0" style="background: linear-gradient(to top, rgba(0,0,0,0.5), transparent);"></div>
              
              <!-- Status Badge -->
              <div class="portfolio-badge">
                <i class="fas fa-check-circle mr-1"></i>
                Live
              </div>
            </div>
            
            <!-- Content -->
            <div class="p-6 relative z-10">
              <h3 class="text-xl font-bold mb-3 transition-colors duration-300" style="color: #333;">
                Website Desa {{ $i == 1 ? 'Sukamaju' : ($i == 2 ? 'Makmur Sejahtera' : ($i == 3 ? 'Wisata Alam' : 'Digital Village')) }}
              </h3>
              <p class="mb-4 leading-relaxed" style="color: #666;">
                Website desa modern dengan fitur lengkap termasuk profil desa, 
                informasi UMKM, dan sistem pelayanan online yang user-friendly.
              </p>
              
              <!-- Features -->
              <div class="flex items-center space-x-4 mb-6 text-sm" style="color: #999;">
                <div class="flex items-center">
                  <i class="fas fa-calendar mr-1"></i>
                  <span>2024</span>
                </div>
                <div class="flex items-center">
                  <i class="fas fa-code mr-1"></i>
                  <span>Laravel</span>
                </div>
              </div>
              
              <!-- Action Button -->
              <a href="#" class="btn-primary w-full justify-center">
                <span>Lihat Website</span>
                <i class="fas fa-external-link-alt ml-2 transition-transform duration-300 group-hover:translate-x-1"></i>
              </a>
            </div>
          </div>
          @endfor
        </div>
        
        <!-- View All Button -->
        <div class="text-center mt-12">
          <a href="#" class="btn-secondary">
            <span>Lihat Semua Portofolio</span>
            <i class="fas fa-folder-open ml-2"></i>
          </a>
        </div>
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
    </script>
  </body>
</html>