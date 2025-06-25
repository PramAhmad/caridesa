<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pendaftaran Berhasil - CariDesa</title>
  @vite('resources/css/app.css')
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800;900&family=Volkhov:wght@400;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
  <link rel="stylesheet" href="{{ asset('css/home.css') }}" />
</head>
<body class="font-poppins bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <nav class="max-w-7xl mx-auto px-6 lg:px-8 py-4">
            <div class="flex items-center justify-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <img src="{{ asset('img/CariDesa - no bg.png') }}" alt="CariDesa Logo" class="w-10 h-10 lg:w-12 lg:h-12 transition-transform duration-300 group-hover:scale-110" />
                    <span class="text-lg lg:text-xl font-volkhov font-bold text-gradient">CariDesa</span>
                </a>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="min-h-screen py-12">
        <div class="max-w-3xl mx-auto px-6 lg:px-8">
            <!-- Success Card -->
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden">
                <!-- Header Section -->
                <div class="bg-gradient-to-r from-green-500 to-green-600 px-8 py-12 text-center text-white">
                    <div class="mx-auto w-24 h-24 bg-white bg-opacity-20 rounded-full flex items-center justify-center mb-6">
                        <i class="fas fa-check-circle text-4xl"></i>
                    </div>
                    <h1 class="text-3xl lg:text-4xl font-bold mb-4">Pendaftaran Berhasil!</h1>
                    <p class="text-lg opacity-90">Terima kasih telah mendaftar di platform CariDesa</p>
                    <p class="text-lg opacity-90">Email konfirmasi akan segera dikirim.</p>
                </div>

                <!-- Content Section -->
                <div class="p-8">
                    <!-- Registration Info -->
                    <div class="bg-gray-50 rounded-xl p-6 mb-8">
                        <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-info-circle text-green-600 mr-3"></i>
                            Detail Pendaftaran
                        </h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600 font-medium">ID Tenant:</span>
                                    <span class="font-bold text-green-600">{{ $tenant->id }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 font-medium">Nama Desa:</span>
                                    <span class="font-semibold">{{ $tenant->data['nama_desa'] ?? 'N/A' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 font-medium">Penanggung Jawab:</span>
                                    <span class="font-semibold">{{ $tenant->nama }}</span>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <div class="flex justify-between">
                                    <span class="text-gray-600 font-medium">Email:</span>
                                    <span class="font-semibold">{{ $tenant->email }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 font-medium">Status:</span>
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm font-medium">
                                        <i class="fas fa-clock mr-1"></i>
                                        Menunggu Approval
                                    </span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600 font-medium">Tanggal Daftar:</span>
                                    <span class="font-semibold">{{ $tenant->created_at->format('d M Y, H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Timeline Section -->
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-tasks text-green-600 mr-3"></i>
                            Tahapan Selanjutnya
                        </h3>
                        <div class="space-y-6">
                            <!-- Step 1 -->
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-check text-green-600 text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-800">Pendaftaran Diterima</h4>
                                    <p class="text-sm text-gray-600">Data Anda telah berhasil tersimpan di sistem kami</p>
                                    <p class="text-xs text-green-600 font-medium">✓ Selesai</p>
                                </div>
                            </div>

                            <!-- Step 2 -->
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-search text-yellow-600 text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-800">Verifikasi Dokumen</h4>
                                    <p class="text-sm text-gray-600">Tim admin sedang memverifikasi dokumen KTP dan surat desa</p>
                                    <p class="text-xs text-yellow-600 font-medium">⏳ Sedang Berlangsung</p>
                                </div>
                            </div>

                            <!-- Step 3 -->
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user-check text-gray-400 text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-600">Approval Admin</h4>
                                    <p class="text-sm text-gray-500">Persetujuan final dari admin untuk aktivasi akun</p>
                                    <p class="text-xs text-gray-500 font-medium">⏳ Menunggu</p>
                                </div>
                            </div>

                            <!-- Step 4 -->
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0 w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-globe text-gray-400 text-sm"></i>
                                </div>
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-600">Aktivasi Website</h4>
                                    <p class="text-sm text-gray-500">Website desa akan diaktifkan dan dapat diakses</p>
                                    <p class="text-xs text-gray-500 font-medium">⏳ Menunggu</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Estimated Timeline -->
                    <div class="bg-blue-50 rounded-xl p-6 mb-8">
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-calendar-alt text-blue-600 text-lg mt-1"></i>
                            <div>
                                <h4 class="font-semibold text-blue-800 mb-2">Estimasi Waktu Proses</h4>
                                <p class="text-sm text-blue-700 mb-2">
                                    Proses verifikasi dan approval biasanya memakan waktu <strong>1-3 hari kerja</strong>
                                </p>
                                <p class="text-xs text-blue-600">
                                    Kami akan mengirimkan notifikasi melalui email ketika status berubah
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div class="bg-gray-50 rounded-xl p-6 mb-8">
                        <h4 class="font-semibold text-gray-800 mb-4 flex items-center">
                            <i class="fas fa-headset text-gray-600 mr-2"></i>
                            Butuh Bantuan?
                        </h4>
                        <div class="grid md:grid-cols-2 gap-4 text-sm">
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-envelope text-green-600"></i>
                                <div>
                                    <p class="font-medium text-gray-800">Email Support</p>
                                    <a href="mailto:caridesa@gmail.com" class="text-green-600 hover:underline">
                                        caridesa@gmail.com
                                    </a>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <i class="fab fa-whatsapp text-green-600"></i>
                                <div>
                                    <p class="font-medium text-gray-800">WhatsApp</p>
                                    <a href="https://wa.me/6282113372046" class="text-green-600 hover:underline" target="_blank">
                                        +62 821 1337 2046
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('tenant.status', $tenant->id) }}" 
                           class="inline-flex items-center justify-center px-6 py-3 bg-green-600 text-white font-semibold rounded-xl hover:bg-green-700 transition-colors duration-300">
                            <i class="fas fa-search mr-2"></i>
                            Cek Status Pendaftaran
                        </a>
                        <a href="{{ route('home') }}" 
                           class="inline-flex items-center justify-center px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-colors duration-300">
                            <i class="fas fa-home mr-2"></i>
                            Kembali ke Beranda
                        </a>
                    </div>
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
</body>
</html>