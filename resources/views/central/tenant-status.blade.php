<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Status Pendaftaran - CariDesa</title>
  @vite('resources/css/app.css')
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Volkhov:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
  <link rel="stylesheet" href="{{ asset('css/home.css') }}" />
</head>
<body class="font-poppins bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <nav class="max-w-7xl mx-auto px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <img src="{{ asset('img/CariDesa - no bg.png') }}" alt="CariDesa Logo" class="w-10 h-10 lg:w-12 lg:h-12 transition-transform duration-300 group-hover:scale-110" />
                    <span class="text-lg lg:text-xl font-volkhov font-bold text-gradient">CariDesa</span>
                </a>
                
                <div class="flex items-center space-x-4">
                    <span class="text-sm text-gray-600">ID: {{ $tenant->id }}</span>
                    <button onclick="window.location.reload()" class="p-2 text-gray-400 hover:text-green-600 transition-colors">
                        <i class="fas fa-sync-alt"></i>
                    </button>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="min-h-screen py-12">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            <!-- Status Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl lg:text-4xl font-bold text-gradient mb-4">
                    Status Pendaftaran Desa
                </h1>
                <p class="text-lg text-gray-600">
                    Pantau progress pendaftaran website desa Anda
                </p>
            </div>

            <!-- Status Card -->
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden mb-8">
                <!-- Status Header -->
                <div class="px-8 py-6 border-b border-gray-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-800">{{ $tenant->nama_desa ?? 'N/A' }}</h2>
                            <p class="text-gray-600">{{ $tenant->alamat_lengkap }}</p>
                        </div>
                        <div class="text-right">
                            @if($tenant->is_active)
                                <div class="inline-flex items-center px-4 py-2 bg-green-100 text-green-800 rounded-full font-medium">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    Aktif
                                </div>
                            @elseif(isset($tenant->data['status']) && $tenant->data['status'] === 'rejected')
                                <div class="inline-flex items-center px-4 py-2 bg-red-100 text-red-800 rounded-full font-medium">
                                    <i class="fas fa-times-circle mr-2"></i>
                                    Ditolak
                                </div>
                            @else
                                <div class="inline-flex items-center px-4 py-2 bg-yellow-100 text-yellow-800 rounded-full font-medium">
                                    <i class="fas fa-clock mr-2"></i>
                                    Pending
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Progress Timeline -->
                <div class="p-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Progress Pendaftaran</h3>
                    
                    <div class="relative">
                        <!-- Progress Line -->
                        <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-gray-200"></div>
                        
                        <!-- Active Progress Line -->
                        <div class="absolute left-4 top-0 w-0.5 bg-green-500 transition-all duration-1000" 
                             style="height: {{ $tenant->is_active ? '100%' : (isset($tenant->data['status']) && $tenant->data['status'] === 'rejected' ? '50%' : '25%') }}"></div>
                        
                        <div class="space-y-8">
                            <!-- Step 1: Pendaftaran -->
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 w-8 h-8 bg-green-500 rounded-full flex items-center justify-center z-10">
                                    <i class="fas fa-check text-white text-sm"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-semibold text-gray-800">Pendaftaran Diterima</h4>
                                    <p class="text-sm text-gray-600 mb-2">Data pendaftaran telah berhasil diterima</p>
                                    <p class="text-xs text-green-600 font-medium">
                                        ✓ {{ $tenant->created_at->format('d M Y, H:i') }}
                                    </p>
                                </div>
                            </div>

                            <!-- Step 2: Verifikasi -->
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center z-10
                                    {{ $tenant->is_active || (isset($tenant->data['status']) && $tenant->data['status'] === 'rejected') ? 'bg-green-500' : 'bg-yellow-500' }}">
                                    @if($tenant->is_active || (isset($tenant->data['status']) && $tenant->data['status'] === 'rejected'))
                                        <i class="fas fa-check text-white text-sm"></i>
                                    @else
                                        <i class="fas fa-clock text-white text-sm"></i>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-semibold text-gray-800">Verifikasi Dokumen</h4>
                                    <p class="text-sm text-gray-600 mb-2">Tim admin sedang memverifikasi dokumen KTP dan surat desa</p>
                                    @if($tenant->is_active || (isset($tenant->data['status']) && $tenant->data['status'] === 'rejected'))
                                        <p class="text-xs text-green-600 font-medium">✓ Selesai</p>
                                    @else
                                        <p class="text-xs text-yellow-600 font-medium">⏳ Sedang Berlangsung</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Step 3: Approval -->
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center z-10
                                    {{ $tenant->is_active ? 'bg-green-500' : (isset($tenant->data['status']) && $tenant->data['status'] === 'rejected' ? 'bg-red-500' : 'bg-gray-300') }}">
                                    @if($tenant->is_active)
                                        <i class="fas fa-check text-white text-sm"></i>
                                    @elseif(isset($tenant->data['status']) && $tenant->data['status'] === 'rejected')
                                        <i class="fas fa-times text-white text-sm"></i>
                                    @else
                                        <i class="fas fa-user-check text-gray-400 text-sm"></i>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-semibold text-gray-800">
                                        {{ isset($tenant->data['status']) && $tenant->data['status'] === 'rejected' ? 'Pendaftaran Ditolak' : 'Approval Admin' }}
                                    </h4>
                                    <p class="text-sm text-gray-600 mb-2">
                                        {{ isset($tenant->data['status']) && $tenant->data['status'] === 'rejected' ? 'Pendaftaran tidak dapat disetujui' : 'Persetujuan final dari admin untuk aktivasi akun' }}
                                    </p>
                                    @if($tenant->is_active)
                                        <p class="text-xs text-green-600 font-medium">
                                            ✓ {{ isset($tenant->data['approved_at']) ? \Carbon\Carbon::parse($tenant->data['approved_at'])->format('d M Y, H:i') : 'Disetujui' }}
                                        </p>
                                    @elseif(isset($tenant->data['status']) && $tenant->data['status'] === 'rejected')
                                        <p class="text-xs text-red-600 font-medium">
                                            ✗ {{ isset($tenant->data['rejected_at']) ? \Carbon\Carbon::parse($tenant->data['rejected_at'])->format('d M Y, H:i') : 'Ditolak' }}
                                        </p>
                                    @else
                                        <p class="text-xs text-gray-500 font-medium">⏳ Menunggu</p>
                                    @endif
                                </div>
                            </div>

                            <!-- Step 4: Aktivasi -->
                            @if($tenant->is_active)
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 w-8 h-8 bg-green-500 rounded-full flex items-center justify-center z-10">
                                    <i class="fas fa-globe text-white text-sm"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <h4 class="font-semibold text-gray-800">Website Aktif</h4>
                                    <p class="text-sm text-gray-600 mb-2">Website desa telah aktif dan dapat diakses</p>
                                    <p class="text-xs text-green-600 font-medium">✓ Aktif</p>
                                    @if($tenant->domains->first())
                                        <p class="text-sm text-blue-600 mt-2">
                                            <i class="fas fa-link mr-1"></i>
                                            Domain: 
                                            <a href="http://{{ $tenant->domains->first()->domain }}" target="_blank" class="font-medium hover:underline">
                                                {{ $tenant->domains->first()->domain }}
                                            </a>
                                        </p>
                                    @endif
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Information -->
            <div class="grid lg:grid-cols-2 gap-8 mb-8">
                <!-- Contact Information -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-user text-green-600 mr-2"></i>
                        Informasi Kontak
                    </h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Nama:</span>
                            <span class="font-medium">{{ $tenant->nama }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Email:</span>
                            <span class="font-medium">{{ $tenant->email }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Telepon:</span>
                            <span class="font-medium">{{ $tenant->phone }}</span>
                        </div>
                    </div>
                </div>

                <!-- Registration Details -->
                <div class="bg-white rounded-2xl shadow-lg p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                        <i class="fas fa-info-circle text-green-600 mr-2"></i>
                        Detail Pendaftaran
                    </h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">ID Tenant:</span>
                            <span class="font-medium text-green-600">{{ $tenant->id }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Tanggal Daftar:</span>
                            <span class="font-medium">{{ $tenant->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Waktu Daftar:</span>
                            <span class="font-medium">{{ $tenant->created_at->format('H:i') }} WIB</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Rejection Reason (if rejected) -->
            @if(isset($tenant->data['status']) && $tenant->data['status'] === 'rejected' && isset($tenant->data['rejection_reason']))
            <div class="bg-red-50 border border-red-200 rounded-2xl p-6 mb-8">
                <h3 class="text-lg font-bold text-red-800 mb-4 flex items-center">
                    <i class="fas fa-exclamation-triangle text-red-600 mr-2"></i>
                    Alasan Penolakan
                </h3>
                <div class="bg-white rounded-lg p-4">
                    <p class="text-red-700">{{ $tenant->data['rejection_reason'] }}</p>
                </div>
                <div class="mt-4 p-4 bg-red-100 rounded-lg">
                    <p class="text-sm text-red-800">
                        <i class="fas fa-info-circle mr-1"></i>
                        Anda dapat mendaftar ulang setelah memperbaiki masalah yang disebutkan di atas.
                    </p>
                </div>
            </div>
            @endif

            <!-- Tujuan Pendaftaran -->
            <div class="bg-white rounded-2xl shadow-lg p-6 mb-8">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center">
                    <i class="fas fa-target text-green-600 mr-2"></i>
                    Tujuan Pembuatan Website
                </h3>
                <div class="bg-gray-50 rounded-lg p-4">
                    <p class="text-gray-700 leading-relaxed">{{ $tenant->tujuan }}</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="text-center">
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @if($tenant->is_active && $tenant->domains->first())
                        <a href="http://{{ $tenant->domains->first()->domain }}" target="_blank" 
                           class="inline-flex items-center justify-center px-8 py-4 bg-green-600 text-white font-semibold rounded-xl hover:bg-green-700 transition-colors duration-300 shadow-lg">
                            <i class="fas fa-external-link-alt mr-2"></i>
                            Kunjungi Website Desa
                        </a>
                    @endif
                    
                    @if(isset($tenant->data['status']) && $tenant->data['status'] === 'rejected')
                        <a href="{{ route('tenant.registration') }}" 
                           class="inline-flex items-center justify-center px-8 py-4 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition-colors duration-300 shadow-lg">
                            <i class="fas fa-redo mr-2"></i>
                            Daftar Ulang
                        </a>
                    @endif
                    
                    <a href="{{ route('home') }}" 
                       class="inline-flex items-center justify-center px-8 py-4 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-colors duration-300">
                        <i class="fas fa-home mr-2"></i>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-white border-t">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-8">
            <div class="text-center">
                <div class="flex items-center justify-center space-x-3 mb-4">
                    <img src="{{ asset('img/CariDesa - no bg.png') }}" alt="CariDesa Logo" class="w-8 h-8" />
                    <span class="text-lg font-volkhov font-bold text-gradient">CariDesa</span>
                </div>
                <p class="text-sm text-gray-600">
                    &copy; 2024 CariDesa. Platform Website Desa Terpercaya Indonesia.
                </p>
            </div>
        </div>
    </footer>

    <!-- Auto Refresh Script -->
    <script>
        // Auto refresh every 30 seconds if status is pending
        @if(!$tenant->is_active && (!isset($tenant->data['status']) || $tenant->data['status'] !== 'rejected'))
        setInterval(function() {
            window.location.reload();
        }, 30000); // 30 seconds
        @endif
    </script>
</body>
</html>