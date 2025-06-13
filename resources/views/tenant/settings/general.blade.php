<x-layouts.app>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Pengaturan Umum</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">Pengaturan</li>
                        <li class="breadcrumb-item active">Umum</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
        @endif
        
        <div class="card">
            <div class="card-header pb-0">
                <h5 class="card-title mb-0">Pengaturan Aplikasi</h5>
            </div>
            
            <form class="card-body" action="/settings/general" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <!-- Basic Information Section -->
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Nama Aplikasi</label>
                        <input type="text" class="form-control @error('app_name') is-invalid @enderror" 
                               name="app_name" 
                               value="{{ old('app_name', $settings['app_name']->value ?? '') }}">
                        @error('app_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Nama aplikasi Anda.</small>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Warna Utama</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-palette"></i></span>
                            <input type="color" class="form-control form-control-color" 
                                   name="primary_color" 
                                   value="{{ old('primary_color', $settings['primary_color']->value ?? 'oklch(50.8% 0.118 165.612)') }}">
                            <input type="text" class="form-control @error('primary_color') is-invalid @enderror" 
                                   value="{{ old('primary_color', $settings['primary_color']->value ?? 'oklch(50.8% 0.118 165.612)') }}"
                                   oninput="document.getElementsByName('primary_color')[0].value = this.value">
                        </div>
                        @error('primary_color')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Warna tema utama untuk aplikasi Anda.</small>
                    </div>
                    
                    <div class="col-md-12 mb-4">
                        <label class="form-label">Deskripsi Aplikasi</label>
                        <textarea class="form-control @error('app_description') is-invalid @enderror" 
                                 name="app_description" 
                                 rows="3">{{ old('app_description', $settings['app_description']->value ?? '') }}</textarea>
                        @error('app_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Deskripsi singkat aplikasi Anda.</small>
                    </div>
                </div>
                
                <!-- Organization Information Section -->
                <h6 class="card-title mt-4 mb-3">Informasi Organisasi</h6>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Nomor Badan Hukum</label>
                        <input type="text" class="form-control @error('nomor_badan_hukum') is-invalid @enderror" 
                               name="nomor_badan_hukum" 
                               value="{{ old('nomor_badan_hukum', $settings['nomor_badan_hukum']->value ?? '') }}"
                               placeholder="Masukkan nomor badan hukum">
                        @error('nomor_badan_hukum')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Nomor badan hukum koperasi atau organisasi.</small>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Mata Uang</label>
                        <select class="form-select @error('mata_uang') is-invalid @enderror" name="mata_uang">
                            @php $currentCurrency = old('mata_uang', $settings['mata_uang']->value ?? 'IDR'); @endphp
                            <option value="IDR" {{ $currentCurrency == 'IDR' ? 'selected' : '' }}>Rupiah Indonesia (IDR)</option>
                            <option value="USD" {{ $currentCurrency == 'USD' ? 'selected' : '' }}>Dolar AS (USD)</option>
                            <option value="EUR" {{ $currentCurrency == 'EUR' ? 'selected' : '' }}>Euro (EUR)</option>
                            <option value="MYR" {{ $currentCurrency == 'MYR' ? 'selected' : '' }}>Ringgit Malaysia (MYR)</option>
                            <option value="SGD" {{ $currentCurrency == 'SGD' ? 'selected' : '' }}>Dolar Singapura (SGD)</option>
                            <option value="THB" {{ $currentCurrency == 'THB' ? 'selected' : '' }}>Baht Thailand (THB)</option>
                        </select>
                        @error('mata_uang')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Mata uang yang digunakan dalam sistem.</small>
                    </div>
                </div>
                
                <!-- Logo and Favicon Section -->
                <h6 class="card-title mt-4 mb-3">Merek</h6>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Logo Aplikasi</label>
                        <div class="d-flex align-items-center mb-2">
                            @if(!empty($settings['app_logo']->value ?? ''))
                                <img src="{{ Storage::url($settings['app_logo']->value) }}" alt="Logo" 
                                     class="img-thumbnail me-3" style="max-height: 60px; max-width: 200px;">
                            @endif
                            <input type="file" class="form-control @error('app_logo') is-invalid @enderror" 
                                   name="app_logo" accept="image/*">
                        </div>
                        @error('app_logo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Ukuran disarankan: 200x60 piksel. Maksimal 2MB.</small>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Favicon</label>
                        <div class="d-flex align-items-center mb-2">
                            @if(!empty($settings['app_favicon']->value ?? ''))
                                <img src="{{ Storage::url($settings['app_favicon']->value) }}" alt="Favicon" 
                                     class="img-thumbnail me-3" style="max-height: 32px; max-width: 32px;">
                            @endif
                            <input type="file" class="form-control @error('app_favicon') is-invalid @enderror" 
                                   name="app_favicon" accept="image/*">
                        </div>
                        @error('app_favicon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Ukuran disarankan: 32x32 piksel. Maksimal 1MB.</small>
                    </div>
                </div>
                
                <!-- Localization Section -->
                <h6 class="card-title mt-4 mb-3">Lokalisasi</h6>
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Zona Waktu</label>
                        <select class="form-select @error('timezone') is-invalid @enderror" name="timezone">
                            @php $currentTimezone = old('timezone', $settings['timezone']->value ?? 'Asia/Jakarta'); @endphp
                            <option value="Asia/Jakarta" {{ $currentTimezone == 'Asia/Jakarta' ? 'selected' : '' }}>Jakarta (WIB)</option>
                            <option value="Asia/Makassar" {{ $currentTimezone == 'Asia/Makassar' ? 'selected' : '' }}>Makassar (WITA)</option>
                            <option value="Asia/Jayapura" {{ $currentTimezone == 'Asia/Jayapura' ? 'selected' : '' }}>Jayapura (WIT)</option>
                            <option value="UTC" {{ $currentTimezone == 'UTC' ? 'selected' : '' }}>UTC</option>
                            <option value="America/New_York" {{ $currentTimezone == 'America/New_York' ? 'selected' : '' }}>Waktu Timur (AS & Kanada)</option>
                            <option value="America/Chicago" {{ $currentTimezone == 'America/Chicago' ? 'selected' : '' }}>Waktu Tengah (AS & Kanada)</option>
                            <option value="America/Denver" {{ $currentTimezone == 'America/Denver' ? 'selected' : '' }}>Waktu Gunung (AS & Kanada)</option>
                            <option value="America/Los_Angeles" {{ $currentTimezone == 'America/Los_Angeles' ? 'selected' : '' }}>Waktu Pasifik (AS & Kanada)</option>
                            <option value="Asia/Singapore" {{ $currentTimezone == 'Asia/Singapore' ? 'selected' : '' }}>Singapura</option>
                            <option value="Asia/Tokyo" {{ $currentTimezone == 'Asia/Tokyo' ? 'selected' : '' }}>Tokyo</option>
                            <option value="Europe/London" {{ $currentTimezone == 'Europe/London' ? 'selected' : '' }}>London</option>
                            <option value="Europe/Paris" {{ $currentTimezone == 'Europe/Paris' ? 'selected' : '' }}>Paris</option>
                        </select>
                        @error('timezone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Zona waktu default untuk aplikasi Anda.</small>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Format Tanggal</label>
                        <select class="form-select @error('date_format') is-invalid @enderror" name="date_format">
                            @php $currentFormat = old('date_format', $settings['date_format']->value ?? 'd/m/Y'); @endphp
                            <option value="d/m/Y" {{ $currentFormat == 'd/m/Y' ? 'selected' : '' }}>TT/BB/TTTT (25/05/2023)</option>
                            <option value="Y-m-d" {{ $currentFormat == 'Y-m-d' ? 'selected' : '' }}>TTTT-BB-TT (2023-05-25)</option>
                            <option value="m/d/Y" {{ $currentFormat == 'm/d/Y' ? 'selected' : '' }}>BB/TT/TTTT (05/25/2023)</option>
                            <option value="d-M-Y" {{ $currentFormat == 'd-M-Y' ? 'selected' : '' }}>TT-BBB-TTTT (25-Mei-2023)</option>
                            <option value="F j, Y" {{ $currentFormat == 'F j, Y' ? 'selected' : '' }}>Bulan T, TTTT (Mei 25, 2023)</option>
                        </select>
                        @error('date_format')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Format tanggal default untuk aplikasi Anda.</small>
                    </div>
                    
                    <div class="col-md-12 mb-4">
                        <label class="form-label">Teks Footer</label>
                        <input type="text" class="form-control @error('footer_text') is-invalid @enderror" 
                               name="footer_text" 
                               value="{{ old('footer_text', $settings['footer_text']->value ?? '© ' . date('Y') . ' Perusahaan Anda. Semua hak dilindungi.') }}">
                        @error('footer_text')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Teks yang muncul di footer aplikasi Anda.</small>
                    </div>
                </div>
                
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-save me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>