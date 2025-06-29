<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Desa Terdaftar - CariDesa</title>
  @vite('resources/css/app.css')
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Volkhov:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
  <link rel="stylesheet" href="{{ asset('css/home.css') }}" />
</head>
<body class="font-poppins bg-gray-50">
    <!-- Navigation -->
    <nav class="w-full px-6 py-4 lg:px-12 lg:py-6 bg-white shadow-lg sticky top-0 z-50">
      <div class="max-w-7xl mx-auto flex items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center space-x-3">
          <img src="{{ asset('img/CariDesa - no bg.png') }}" alt="CariDesa Logo" class="w-10 h-10 lg:w-12 lg:h-12" />
          <span class="text-xl lg:text-2xl font-volkhov font-bold text-gradient">CariDesa</span>
        </div>
        
        <!-- Navigation Links -->
        <div class="hidden lg:flex items-center space-x-8">
          <a href="{{ route('home') }}" class="text-gray-600 hover:text-green-600 transition-colors duration-300">Home</a>
          <a href="{{ route('home') }}#welcome" class="text-gray-600 hover:text-green-600 transition-colors duration-300">About</a>
          <a href="{{ route('home') }}#service" class="text-gray-600 hover:text-green-600 transition-colors duration-300">Service</a>
          <a href="{{ route('home') }}#contact" class="text-gray-600 hover:text-green-600 transition-colors duration-300">Contact</a>
        </div>
        
        <!-- CTA Button -->
        <a href="{{ route('tenant.registration') }}" class="btn-primary">
          <i class="fas fa-plus mr-2"></i>
          Daftar Desa
        </a>
      </div>
    </nav>

    <!-- Header Section -->
    <section class="py-16 lg:py-20 bg-gradient-to-br from-green-50 to-emerald-50">
      <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-12">
          <h1 class="text-4xl lg:text-5xl font-bold mb-6 text-gradient text-shadow">
            Daftar Desa Terdaftar
          </h1>
          <p class="text-xl max-w-3xl mx-auto text-gray-600">
            Desa-desa yang telah bergabung dengan platform CariDesa dan memiliki website profesional
          </p>
        </div>

        <!-- Statistics Cards -->
        <div class="grid md:grid-cols-4 gap-6 mb-12">
          <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-gray-500 text-sm font-medium">Total Desa</p>
                <p class="text-3xl font-bold text-green-600">{{ $stats['total_tenants'] }}</p>
              </div>
              <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-village text-green-600 text-xl"></i>
              </div>
            </div>
          </div>

          <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-gray-500 text-sm font-medium">Desa Aktif</p>
                <p class="text-3xl font-bold text-green-600">{{ $stats['active_tenants'] }}</p>
              </div>
              <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-check-circle text-green-600 text-xl"></i>
              </div>
            </div>
          </div>

          <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-gray-500 text-sm font-medium">Menunggu Review</p>
                <p class="text-3xl font-bold text-yellow-600">{{ $stats['pending_tenants'] }}</p>
              </div>
              <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-clock text-yellow-600 text-xl"></i>
              </div>
            </div>
          </div>

          <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
            <div class="flex items-center justify-between">
              <div>
                <p class="text-gray-500 text-sm font-medium">Provinsi</p>
                <p class="text-3xl font-bold text-blue-600">{{ $stats['provinces_count'] }}</p>
              </div>
              <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                <i class="fas fa-map text-blue-600 text-xl"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Tenants Table Section -->
    <section class="py-16">
      <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <!-- Search and Filter -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-100 mb-8">
          <div class="p-6 border-b border-gray-100">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
              <h2 class="text-2xl font-bold text-gray-800">Daftar Lengkap Desa</h2>
              
              <div class="flex flex-col sm:flex-row gap-4">
                <!-- Search Input -->
                <div class="relative">
                  <input type="text" 
                         id="search-input" 
                         placeholder="Cari nama desa, kecamatan, atau kota..." 
                         class="w-full sm:w-80 px-4 py-3 pl-12 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent">
                  <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                
                <!-- Filter -->
                <select id="province-filter" 
                        class="px-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-transparent">
                  <option value="">Semua Provinsi</option>
                  @foreach($tenants->pluck('provinsi')->unique()->sort() as $province)
                    <option value="{{ $province }}">{{ $province }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>

          <!-- Table -->
          <div class="overflow-x-auto">
            <table class="w-full">
              <thead class="bg-gray-50">
                <tr>
                  <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Desa
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Lokasi
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Penanggung Jawab
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Status
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Terdaftar
                  </th>
                  <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Website
                  </th>
                </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200" id="tenants-tbody">
                @forelse($tenants as $tenant)
                <tr class="hover:bg-gray-50 transition-colors duration-200 tenant-row" 
                    data-name="{{ strtolower($tenant->nama_desa) }}" 
                    data-location="{{ strtolower($tenant->kecamatan . ' ' . $tenant->kota) }}" 
                    data-province="{{ strtolower($tenant->provinsi) }}">
                  <!-- Desa Info -->
                  <td class="px-6 py-4">
                    <div class="flex items-center">
                      <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center flex-shrink-0 mr-4">
                        <i class="fas fa-map-marker-alt text-green-600"></i>
                      </div>
                      <div>
                        <div class="text-sm font-medium text-gray-900">{{ $tenant->nama_desa }}</div>
                        <div class="text-sm text-gray-500">ID: {{ $tenant->id }}</div>
                      </div>
                    </div>
                  </td>

                  <!-- Lokasi -->
                  <td class="px-6 py-4">
                    <div class="text-sm text-gray-900">{{ $tenant->kecamatan }}</div>
                    <div class="text-sm text-gray-500">{{ $tenant->kota }}, {{ $tenant->provinsi }}</div>
                  </td>

                  <!-- Penanggung Jawab -->
                  <td class="px-6 py-4">
                    <div class="text-sm text-gray-900">{{ $tenant->nama }}</div>
                    <div class="text-sm text-gray-500">{{ $tenant->email }}</div>
                  </td>

                  <!-- Status -->
                  <td class="px-6 py-4">
                    @if($tenant->status === 'active')
                      <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        <i class="fas fa-check-circle mr-1"></i>
                        Aktif
                      </span>
                    @elseif($tenant->status === 'pending')
                      <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        <i class="fas fa-clock mr-1"></i>
                        Pending
                      </span>
                    @else
                      <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                        <i class="fas fa-pause-circle mr-1"></i>
                        Inactive
                      </span>
                    @endif
                  </td>

                  <!-- Terdaftar -->
                  <td class="px-6 py-4 text-sm text-gray-900">
                    {{ $tenant->created_at->format('d/m/Y') }}
                  </td>

                  <!-- Website -->
                  <td class="px-6 py-4">
                    <div class="flex space-x-2">
                      @if($tenant->domains->first())
                        <a href="https://{{ $tenant->domains->first()->domain }}" 
                           target="_blank"
                           class="inline-flex items-center px-3 py-1.5 bg-green-600 text-white text-xs font-medium rounded-lg hover:bg-green-700 transition-colors">
                          <i class="fas fa-external-link-alt mr-1"></i>
                          Kunjungi
                        </a>
                      @endif
                      
                      <a href="{{ route('tenant.status', $tenant->id) }}"
                         class="inline-flex items-center px-3 py-1.5 bg-gray-100 text-gray-700 text-xs font-medium rounded-lg hover:bg-gray-200 transition-colors">
                        <i class="fas fa-info-circle mr-1"></i>
                        Detail
                      </a>
                    </div>
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="6" class="px-6 py-12 text-center">
                    <div class="text-gray-500">
                      <i class="fas fa-village text-4xl mb-4"></i>
                      <p class="text-lg">Belum ada desa yang terdaftar</p>
                    </div>
                  </td>
                </tr>
                @endforelse
              </tbody>
            </table>
          </div>

          <!-- Pagination -->
          @if($tenants->hasPages())
          <div class="px-6 py-4 border-t border-gray-100">
            <div class="flex items-center justify-between">
              <div class="text-sm text-gray-500">
                Menampilkan {{ $tenants->firstItem() }} sampai {{ $tenants->lastItem() }} 
                dari {{ $tenants->total() }} hasil
              </div>
              
              <div class="flex space-x-1">
                {{-- Previous Page Link --}}
                @if ($tenants->onFirstPage())
                  <span class="px-3 py-2 text-sm text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                    <i class="fas fa-chevron-left"></i>
                  </span>
                @else
                  <a href="{{ $tenants->previousPageUrl() }}" 
                     class="px-3 py-2 text-sm text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-gray-50">
                    <i class="fas fa-chevron-left"></i>
                  </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($tenants->getUrlRange(1, $tenants->lastPage()) as $page => $url)
                  @if ($page == $tenants->currentPage())
                    <span class="px-3 py-2 text-sm text-white bg-green-600 rounded-lg">
                      {{ $page }}
                    </span>
                  @else
                    <a href="{{ $url }}" 
                       class="px-3 py-2 text-sm text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-gray-50">
                      {{ $page }}
                    </a>
                  @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($tenants->hasMorePages())
                  <a href="{{ $tenants->nextPageUrl() }}" 
                     class="px-3 py-2 text-sm text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-gray-50">
                    <i class="fas fa-chevron-right"></i>
                  </a>
                @else
                  <span class="px-3 py-2 text-sm text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">
                    <i class="fas fa-chevron-right"></i>
                  </span>
                @endif
              </div>
            </div>
          </div>
          @endif
        </div>
      </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-br from-green-600 to-emerald-600">
      <div class="max-w-4xl mx-auto text-center px-6 lg:px-8">
        <h2 class="text-3xl lg:text-4xl font-bold text-white mb-6">
          Desa Anda Belum Terdaftar?
        </h2>
        <p class="text-xl text-green-100 mb-8">
          Bergabunglah dengan desa-desa lain yang telah merasakan manfaat digitalisasi
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
          <a href="{{ route('tenant.registration') }}" 
             class="inline-flex items-center justify-center px-8 py-4 bg-white text-green-600 font-bold rounded-2xl hover:bg-gray-50 transition-all duration-300 shadow-lg hover:shadow-xl">
            <i class="fas fa-rocket mr-2"></i>
            Daftar Sekarang
          </a>
          <a href="{{ route('home') }}#contact" 
             class="inline-flex items-center justify-center px-8 py-4 bg-transparent text-white font-bold rounded-2xl border-2 border-white hover:bg-white hover:text-green-600 transition-all duration-300">
            <i class="fas fa-phone mr-2"></i>
            Konsultasi Gratis
          </a>
        </div>
      </div>
    </section>

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


    <!-- JavaScript -->
    <script>
      // Search and Filter Functionality
      const searchInput = document.getElementById('search-input');
      const provinceFilter = document.getElementById('province-filter');
      const tenantRows = document.querySelectorAll('.tenant-row');

      function filterTenants() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedProvince = provinceFilter.value.toLowerCase();

        tenantRows.forEach(row => {
          const name = row.dataset.name;
          const location = row.dataset.location;
          const province = row.dataset.province;

          const matchesSearch = name.includes(searchTerm) || location.includes(searchTerm);
          const matchesProvince = selectedProvince === '' || province.includes(selectedProvince);

          if (matchesSearch && matchesProvince) {
            row.style.display = '';
          } else {
            row.style.display = 'none';
          }
        });

        // Update results count
        const visibleRows = Array.from(tenantRows).filter(row => row.style.display !== 'none');
        console.log(`Showing ${visibleRows.length} of ${tenantRows.length} results`);
      }

      // Event listeners
      searchInput.addEventListener('input', filterTenants);
      provinceFilter.addEventListener('change', filterTenants);

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
    </script>
</body>
</html>