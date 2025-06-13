<x-layouts.app>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Pengaturan Keamanan</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/tenant">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">Pengaturan</li>
                        <li class="breadcrumb-item active">Keamanan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        
        <div class="card">
            <div class="card-header pb-0">
                <h5 class="card-title mb-0">Pengaturan Kata Sandi</h5>
            </div>
            
            <form class="card-body" action="/tenant/settings/security" method="POST">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Panjang Minimum Kata Sandi</label>
                        <div class="input-group">
                            <input type="number" class="form-control @error('min_password_length') is-invalid @enderror" 
                                   name="min_password_length" 
                                   value="{{ old('min_password_length', $settings['min_password_length']->value ?? 8) }}"
                                   min="6" max="20">
                            <span class="input-group-text">karakter</span>
                        </div>
                        @error('min_password_length')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Panjang minimum yang diperlukan untuk kata sandi pengguna.</small>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Masa Berlaku Kata Sandi</label>
                        <div class="input-group">
                            <input type="number" class="form-control @error('password_expiry_days') is-invalid @enderror" 
                                   name="password_expiry_days" 
                                   value="{{ old('password_expiry_days', $settings['password_expiry_days']->value ?? 90) }}"
                                   min="0" max="365">
                            <span class="input-group-text">hari</span>
                        </div>
                        @error('password_expiry_days')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Jumlah hari sebelum kata sandi kedaluwarsa. Gunakan 0 untuk tidak ada kedaluwarsa.</small>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" 
                                   name="require_special_chars" 
                                   id="requireSpecialChars"
                                   value="1"
                                   {{ old('require_special_chars', $settings['require_special_chars']->value ?? 0) ? 'checked' : '' }}>
                            <label class="form-check-label" for="requireSpecialChars">
                                Memerlukan Karakter Khusus
                            </label>
                        </div>
                        <small class="form-text text-muted">
                            Jika diaktifkan, kata sandi harus mengandung setidaknya satu karakter khusus.
                        </small>
                    </div>
                </div>
                
                <hr class="my-4">
                
                <div class="row">
                    <div class="col-12 mb-3">
                        <h5>Keamanan Login</h5>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Waktu Habis Sesi</label>
                        <div class="input-group">
                            <input type="number" class="form-control @error('session_timeout_minutes') is-invalid @enderror" 
                                   name="session_timeout_minutes" 
                                   value="{{ old('session_timeout_minutes', $settings['session_timeout_minutes']->value ?? 120) }}"
                                   min="1" max="1440">
                            <span class="input-group-text">menit</span>
                        </div>
                        @error('session_timeout_minutes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Jumlah menit ketidakaktifan sebelum pengguna keluar.</small>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Maks Login Attempts</label>
                        <div class="input-group">
                            <input type="number" class="form-control @error('login_attempts_before_lockout') is-invalid @enderror" 
                                   name="login_attempts_before_lockout" 
                                   value="{{ old('login_attempts_before_lockout', $settings['login_attempts_before_lockout']->value ?? 5) }}"
                                   min="1" max="10">
                            <span class="input-group-text">attempts</span>
                        </div>
                        @error('login_attempts_before_lockout')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Jumlah percobaan login yang gagal sebelum akun dikunci.</small>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <label class="form-label">Durasi Penguncian</label>
                        <div class="input-group">
                            <input type="number" class="form-control @error('lockout_minutes') is-invalid @enderror" 
                                   name="lockout_minutes" 
                                   value="{{ old('lockout_minutes', $settings['lockout_minutes']->value ?? 30) }}"
                                   min="1" max="1440">
                            <span class="input-group-text">menit</span>
                        </div>
                        @error('lockout_minutes')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Durasi akun tetap terkunci setelah terlalu banyak percobaan login yang gagal.</small>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" 
                                   name="two_factor_enabled" 
                                   id="twoFactorEnabled"
                                   value="1"
                                   {{ old('two_factor_enabled', $settings['two_factor_enabled']->value ?? 0) ? 'checked' : '' }}>
                            <label class="form-check-label" for="twoFactorEnabled">
                                Enable Two-Factor Authentication
                            </label>
                        </div>
                        <small class="form-text text-muted">
                            If enabled, users will have the option to set up two-factor authentication.
                        </small>
                    </div>
                </div>
                
                <hr class="my-4">
                
                <div class="row">
                    <div class="col-12 mb-3">
                        <h5>IP Restrictions</h5>
                    </div>
                    
                    <div class="col-md-12 mb-4">
                        <label class="form-label">Allowed IP Addresses</label>
                        <textarea class="form-control @error('allowed_ip_addresses') is-invalid @enderror" 
                                 name="allowed_ip_addresses" 
                                 rows="3"
                                 placeholder="Leave empty to allow all IPs. Enter one IP address per line.">{{ old('allowed_ip_addresses', $settings['allowed_ip_addresses']->value ?? '') }}</textarea>
                        @error('allowed_ip_addresses')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">
                            Batasi akses aplikasi ke alamat IP tertentu. Biarkan kosong untuk mengizinkan semua IP.
                            Masukkan satu alamat IP per baris. Contoh: 192.168.1.1
                        </small>
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