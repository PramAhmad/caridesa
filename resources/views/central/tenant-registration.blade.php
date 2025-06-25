<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registrasi Desa - CariDesa</title>
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
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <img src="{{ asset('img/CariDesa - no bg.png') }}" alt="CariDesa Logo" class="w-10 h-10 lg:w-12 lg:h-12 transition-transform duration-300 group-hover:scale-110" />
                    <span class="text-lg lg:text-xl font-volkhov font-bold text-gradient">CariDesa</span>
                </a>
                
                <!-- Back Button -->
                <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-600 hover:text-green-600 transition-colors duration-300">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Kembali ke Beranda
                </a>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="min-h-screen py-12">
        <div class="max-w-4xl mx-auto px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="text-center mb-12">
                <h1 class="text-3xl lg:text-4xl font-bold text-gradient mb-4">
                    Daftarkan Desa Anda
                </h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Bergabunglah dengan platform CariDesa dan wujudkan transformasi digital untuk desa Anda. 
                    Isi formulir di bawah ini untuk memulai proses pendaftaran.
                </p>
            </div>

            <!-- Progress Indicator -->
            <div class="mb-8">
                <div class="flex items-center justify-center space-x-4">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-green-600 text-white rounded-full flex items-center justify-center text-sm font-bold">
                            1
                        </div>
                        <span class="ml-2 text-sm text-green-600 font-medium">Pendaftaran</span>
                    </div>
                    <div class="w-8 h-1 bg-gray-300"></div>
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-gray-300 text-gray-500 rounded-full flex items-center justify-center text-sm font-bold">
                            2
                        </div>
                        <span class="ml-2 text-sm text-gray-500">Review Admin</span>
                    </div>
                    <div class="w-8 h-1 bg-gray-300"></div>
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-gray-300 text-gray-500 rounded-full flex items-center justify-center text-sm font-bold">
                            3
                        </div>
                        <span class="ml-2 text-sm text-gray-500">Aktivasi</span>
                    </div>
                </div>
            </div>

            <!-- Alert Messages -->
            @if(session('success'))
            <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>
            </div>
            @endif

            @if(session('error'))
            <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                    {{ session('error') }}
                </div>
            </div>
            @endif

            <!-- Registration Form -->
            <div class="form-enhanced">
                <form action="{{ route('tenant.registration.store') }}" method="POST" enctype="multipart/form-data" id="registrationForm">
                    @csrf
                    @method('POST')
                    <!-- Section 1: Data Desa -->
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-map-marker-alt mr-3 text-green-600"></i>
                            Informasi Desa
                        </h3>
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <!-- Nama Desa -->
                            <div class="form-group">
                                <label for="nama_desa" class="form-label">Nama Desa <span class="text-red-500">*</span></label>
                                <input type="text" 
                                       id="nama_desa" 
                                name="nama_desa" 
                                       class="form-input @error('nama_desa') border-red-500 @enderror" 
                                       value="{{ old('nama_desa') }}" 
                                       placeholder="Contoh: Desa Sukamaju">
                                @error('nama_desa')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Provinsi -->
                            <div class="form-group">
                                <label for="provinsi" class="form-label">Provinsi <span class="text-red-500">*</span></label>
                                <select id="provinsi" 
                                        name="provinsi" 
                                        class="form-input @error('provinsi') border-red-500 @enderror">
                                    <option value="">Pilih Provinsi</option>
                                    <option value="Aceh" {{ old('provinsi') == 'Aceh' ? 'selected' : '' }}>Aceh</option>
                                    <option value="Sumatera Utara" {{ old('provinsi') == 'Sumatera Utara' ? 'selected' : '' }}>Sumatera Utara</option>
                                    <option value="Sumatera Barat" {{ old('provinsi') == 'Sumatera Barat' ? 'selected' : '' }}>Sumatera Barat</option>
                                    <option value="Riau" {{ old('provinsi') == 'Riau' ? 'selected' : '' }}>Riau</option>
                                    <option value="Kepulauan Riau" {{ old('provinsi') == 'Kepulauan Riau' ? 'selected' : '' }}>Kepulauan Riau</option>
                                    <option value="Jambi" {{ old('provinsi') == 'Jambi' ? 'selected' : '' }}>Jambi</option>
                                    <option value="Sumatera Selatan" {{ old('provinsi') == 'Sumatera Selatan' ? 'selected' : '' }}>Sumatera Selatan</option>
                                    <option value="Bangka Belitung" {{ old('provinsi') == 'Bangka Belitung' ? 'selected' : '' }}>Bangka Belitung</option>
                                    <option value="Bengkulu" {{ old('provinsi') == 'Bengkulu' ? 'selected' : '' }}>Bengkulu</option>
                                    <option value="Lampung" {{ old('provinsi') == 'Lampung' ? 'selected' : '' }}>Lampung</option>
                                    <option value="DKI Jakarta" {{ old('provinsi') == 'DKI Jakarta' ? 'selected' : '' }}>DKI Jakarta</option>
                                    <option value="Jawa Barat" {{ old('provinsi') == 'Jawa Barat' ? 'selected' : '' }}>Jawa Barat</option>
                                    <option value="Jawa Tengah" {{ old('provinsi') == 'Jawa Tengah' ? 'selected' : '' }}>Jawa Tengah</option>
                                    <option value="DI Yogyakarta" {{ old('provinsi') == 'DI Yogyakarta' ? 'selected' : '' }}>DI Yogyakarta</option>
                                    <option value="Jawa Timur" {{ old('provinsi') == 'Jawa Timur' ? 'selected' : '' }}>Jawa Timur</option>
                                    <option value="Banten" {{ old('provinsi') == 'Banten' ? 'selected' : '' }}>Banten</option>
                                    <option value="Bali" {{ old('provinsi') == 'Bali' ? 'selected' : '' }}>Bali</option>
                                    <option value="Nusa Tenggara Barat" {{ old('provinsi') == 'Nusa Tenggara Barat' ? 'selected' : '' }}>Nusa Tenggara Barat</option>
                                    <option value="Nusa Tenggara Timur" {{ old('provinsi') == 'Nusa Tenggara Timur' ? 'selected' : '' }}>Nusa Tenggara Timur</option>
                                    <option value="Kalimantan Barat" {{ old('provinsi') == 'Kalimantan Barat' ? 'selected' : '' }}>Kalimantan Barat</option>
                                    <option value="Kalimantan Tengah" {{ old('provinsi') == 'Kalimantan Tengah' ? 'selected' : '' }}>Kalimantan Tengah</option>
                                    <option value="Kalimantan Selatan" {{ old('provinsi') == 'Kalimantan Selatan' ? 'selected' : '' }}>Kalimantan Selatan</option>
                                    <option value="Kalimantan Timur" {{ old('provinsi') == 'Kalimantan Timur' ? 'selected' : '' }}>Kalimantan Timur</option>
                                    <option value="Kalimantan Utara" {{ old('provinsi') == 'Kalimantan Utara' ? 'selected' : '' }}>Kalimantan Utara</option>
                                    <option value="Sulawesi Utara" {{ old('provinsi') == 'Sulawesi Utara' ? 'selected' : '' }}>Sulawesi Utara</option>
                                    <option value="Sulawesi Tengah" {{ old('provinsi') == 'Sulawesi Tengah' ? 'selected' : '' }}>Sulawesi Tengah</option>
                                    <option value="Sulawesi Selatan" {{ old('provinsi') == 'Sulawesi Selatan' ? 'selected' : '' }}>Sulawesi Selatan</option>
                                    <option value="Sulawesi Tenggara" {{ old('provinsi') == 'Sulawesi Tenggara' ? 'selected' : '' }}>Sulawesi Tenggara</option>
                                    <option value="Gorontalo" {{ old('provinsi') == 'Gorontalo' ? 'selected' : '' }}>Gorontalo</option>
                                    <option value="Sulawesi Barat" {{ old('provinsi') == 'Sulawesi Barat' ? 'selected' : '' }}>Sulawesi Barat</option>
                                    <option value="Maluku" {{ old('provinsi') == 'Maluku' ? 'selected' : '' }}>Maluku</option>
                                    <option value="Maluku Utara" {{ old('provinsi') == 'Maluku Utara' ? 'selected' : '' }}>Maluku Utara</option>
                                    <option value="Papua" {{ old('provinsi') == 'Papua' ? 'selected' : '' }}>Papua</option>
                                    <option value="Papua Barat" {{ old('provinsi') == 'Papua Barat' ? 'selected' : '' }}>Papua Barat</option>
                                    <option value="Papua Selatan" {{ old('provinsi') == 'Papua Selatan' ? 'selected' : '' }}>Papua Selatan</option>
                                    <option value="Papua Tengah" {{ old('provinsi') == 'Papua Tengah' ? 'selected' : '' }}>Papua Tengah</option>
                                    <option value="Papua Pegunungan" {{ old('provinsi') == 'Papua Pegunungan' ? 'selected' : '' }}>Papua Pegunungan</option>
                                    <option value="Papua Barat Daya" {{ old('provinsi') == 'Papua Barat Daya' ? 'selected' : '' }}>Papua Barat Daya</option>
                                </select>
                                @error('provinsi')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Kota/Kabupaten -->
                            <div class="form-group">
                                <label for="kota" class="form-label">Kota/Kabupaten <span class="text-red-500">*</span></label>
                                <input type="text" 
                                       id="kota" 
                                       name="kota" 
                                       class="form-input @error('kota') border-red-500 @enderror" 
                                       value="{{ old('kota') }}" 
                                       placeholder="Contoh: Kabupaten Tasikmalaya">
                                @error('kota')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Kecamatan -->
                            <div class="form-group">
                                <label for="kecamatan" class="form-label">Kecamatan <span class="text-red-500">*</span></label>
                                <input type="text" 
                                       id="kecamatan" 
                                       name="kecamatan" 
                                       class="form-input @error('kecamatan') border-red-500 @enderror" 
                                       value="{{ old('kecamatan') }}" 
                                       placeholder="Contoh: Singaparna">
                                @error('kecamatan')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Kelurahan/Desa -->
                            <div class="form-group md:col-span-2">
                                <label for="kelurahan" class="form-label">Kelurahan/Desa <span class="text-red-500">*</span></label>
                                <input type="text" 
                                       id="kelurahan" 
                                       name="kelurahan" 
                                       class="form-input @error('kelurahan') border-red-500 @enderror" 
                                       value="{{ old('kelurahan') }}" 
                                       placeholder="Contoh: Sukamaju">
                                @error('kelurahan')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Data Penanggung Jawab -->
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-user mr-3 text-green-600"></i>
                            Data Penanggung Jawab
                        </h3>
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <!-- Nama Lengkap -->
                            <div class="form-group">
                                <label for="nama" class="form-label">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" 
                                       id="nama" 
                                       name="nama" 
                                       class="form-input @error('nama') border-red-500 @enderror" 
                                       value="{{ old('nama') }}" 
                                       placeholder="Contoh: Budi Santoso">
                                @error('nama')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="form-group">
                                <label for="email" class="form-label">Email <span class="text-red-500">*</span></label>
                                <input type="email" 
                                       id="email" 
                                       name="email" 
                                       class="form-input @error('email') border-red-500 @enderror" 
                                       value="{{ old('email') }}" 
                                       placeholder="contoh@email.com">
                                @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nomor Telepon -->
                            <div class="form-group">
                                <label for="phone" class="form-label">Nomor Telepon <span class="text-red-500">*</span></label>
                                <input type="tel" 
                                       id="phone" 
                                       name="phone" 
                                       class="form-input @error('phone') border-red-500 @enderror" 
                                       value="{{ old('phone') }}" 
                                       placeholder="081234567890">
                                @error('phone')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <label for="password" class="form-label">Password <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <input type="password" 
                                           id="password" 
                                           name="password" 
                                           class="form-input pr-10 @error('password') border-red-500 @enderror" 
                                           placeholder="Minimal 8 karakter">
                                    <button type="button" 
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                            onclick="togglePassword('password')">
                                        <i class="fas fa-eye text-gray-400 hover:text-gray-600" id="password-icon"></i>
                                    </button>
                                </div>
                                @error('password')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Password Confirmation -->
                            <div class="form-group md:col-span-2">
                                <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <input type="password" 
                                           id="password_confirmation" 
                                           name="password_confirmation" 
                                           class="form-input pr-10 @error('password_confirmation') border-red-500 @enderror" 
                                           placeholder="Ulangi password">
                                    <button type="button" 
                                            class="absolute inset-y-0 right-0 pr-3 flex items-center"
                                            onclick="togglePassword('password_confirmation')">
                                        <i class="fas fa-eye text-gray-400 hover:text-gray-600" id="password_confirmation-icon"></i>
                                    </button>
                                </div>
                                @error('password_confirmation')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Tujuan dan Dokumen -->
                    <div class="mb-8">
                        <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-file-alt mr-3 text-green-600"></i>
                            Tujuan dan Dokumen Pendukung
                        </h3>
                        
                        <!-- Tujuan -->
                        <div class="form-group mb-6">
                            <label for="tujuan" class="form-label">Tujuan Pembuatan Website <span class="text-red-500">*</span></label>
                            <textarea id="tujuan" 
                                      name="tujuan" 
                                      rows="4" 
                                      class="form-input form-textarea @error('tujuan') border-red-500 @enderror" 
                                      placeholder="Jelaskan tujuan pembuatan website desa Anda, seperti meningkatkan transparansi, promosi wisata, digitalisasi layanan, dll.">{{ old('tujuan') }}</textarea>
                            @error('tujuan')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-sm text-gray-500 mt-1">Maksimal 1000 karakter</p>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            <!-- Upload KTP -->
                            <div class="form-group">
                                <label for="ktp" class="form-label">Upload KTP <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <input type="file" 
                                           id="ktp" 
                                           name="ktp" 
                                           class="hidden" 
                                           accept=".jpg,.jpeg,.png,.pdf"
                                           onchange="handleFileUpload(this, 'ktp-preview')">
                                    <label for="ktp" 
                                           class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors duration-300 @error('ktp') border-red-500 @enderror">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6" id="ktp-preview">
                                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                            <p class="text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> atau drag & drop</p>
                                            <p class="text-xs text-gray-500">JPEG, JPG, PNG, PDF (Max 2MB)</p>
                                        </div>
                                    </label>
                                </div>
                                @error('ktp')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Upload Surat Desa -->
                            <div class="form-group">
                                <label for="surat_desa" class="form-label">Upload Surat Desa <span class="text-red-500">*</span></label>
                                <div class="relative">
                                    <input type="file" 
                                           id="surat_desa" 
                                           name="surat_desa" 
                                           class="hidden" 
                                           accept=".jpg,.jpeg,.png,.pdf"
                                           onchange="handleFileUpload(this, 'surat-desa-preview')">
                                    <label for="surat_desa" 
                                           class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors duration-300 @error('surat_desa') border-red-500 @enderror">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6" id="surat-desa-preview">
                                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                            <p class="text-sm text-gray-500"><span class="font-semibold">Klik untuk upload</span> atau drag & drop</p>
                                            <p class="text-xs text-gray-500">JPEG, JPG, PNG, PDF (Max 2MB)</p>
                                        </div>
                                    </label>
                                </div>
                                @error('surat_desa')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Terms and Conditions -->
                    <div class="mb-8">
                        <div class="flex items-start">
                            <input type="checkbox" 
                                   id="terms" 
                                   name="terms" 
                                   class="w-4 h-4 text-green-600 bg-gray-100 border-gray-300 rounded focus:ring-green-500 focus:ring-2 mt-1" 
                                   required>
                            <label for="terms" class="ml-2 text-sm text-gray-600">
                                Saya menyetujui <a href="#" class="text-green-600 hover:underline">syarat dan ketentuan</a> 
                                serta <a href="#" class="text-green-600 hover:underline">kebijakan privasi</a> CariDesa. 
                                Data yang saya berikan adalah benar dan dapat dipertanggungjawabkan.
                            </label>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button type="submit" 
                                class="hero-btn-primary inline-flex items-center justify-center px-8 py-3 text-lg font-semibold transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed"
                                id="submitBtn">
                            <i class="fas fa-paper-plane mr-2"></i>
                            <span>Daftar Sekarang</span>
                        </button>
                        
                        <p class="mt-4 text-sm text-gray-500">
                            <i class="fas fa-info-circle mr-1"></i>
                            Pendaftaran akan diverifikasi oleh admin dalam 1-3 hari kerja
                        </p>
                    </div>
                </form>
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

    <!-- JavaScript -->
    <script>
        // Toggle password visibility
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const icon = document.getElementById(fieldId + '-icon');
            
            if (field.type === 'password') {
                field.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Handle file upload preview
        function handleFileUpload(input, previewId) {
            const preview = document.getElementById(previewId);
            const file = input.files[0];
            
            if (file) {
                const fileName = file.name;
                const fileSize = (file.size / 1024 / 1024).toFixed(2);
                const fileType = file.type;
                
                // Check file size (max 2MB)
                if (file.size > 2 * 1024 * 1024) {
                    alert('Ukuran file terlalu besar. Maksimal 2MB.');
                    input.value = '';
                    return;
                }
                
                // Show file info
                preview.innerHTML = `
                    <div class="text-center">
                        <i class="fas fa-file-check text-3xl text-green-500 mb-2"></i>
                        <p class="text-sm text-gray-700 font-medium">${fileName}</p>
                        <p class="text-xs text-gray-500">${fileSize} MB</p>
                        <p class="text-xs text-green-600 mt-1">File berhasil dipilih</p>
                    </div>
                `;
            }
        }

        // Form validation
        document.getElementById('registrationForm').addEventListener('submit', function(e) {
            const submitBtn = document.getElementById('submitBtn');
            const terms = document.getElementById('terms');
            
            if (!terms.checked) {
                e.preventDefault();
                alert('Anda harus menyetujui syarat dan ketentuan');
                return;
            }
            
            // Disable submit button to prevent double submission
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i><span>Sedang Memproses...</span>';
        });

        // Character counter for tujuan field
        const tujuanField = document.getElementById('tujuan');
        if (tujuanField) {
            tujuanField.addEventListener('input', function() {
                const maxLength = 1000;
                const currentLength = this.value.length;
                const remaining = maxLength - currentLength;
                
                // Find or create counter element
                let counter = this.parentElement.querySelector('.char-counter');
                if (!counter) {
                    counter = document.createElement('p');
                    counter.className = 'char-counter text-sm text-gray-500 mt-1';
                    this.parentElement.appendChild(counter);
                }
                
                counter.textContent = `${currentLength}/${maxLength} karakter`;
                
                if (remaining < 50) {
                    counter.classList.add('text-orange-500');
                    counter.classList.remove('text-gray-500');
                } else {
                    counter.classList.add('text-gray-500');
                    counter.classList.remove('text-orange-500');
                }
            });
        }

        // Auto-format phone number
        const phoneField = document.getElementById('phone');
        if (phoneField) {
            phoneField.addEventListener('input', function() {
                // Remove non-numeric characters
                let value = this.value.replace(/\D/g, '');
                
                // Add +62 prefix if starts with 0
                if (value.startsWith('0')) {
                    value = '62' + value.substring(1);
                }
                
                this.value = value;
            });
        }
    </script>
</body>
</html>