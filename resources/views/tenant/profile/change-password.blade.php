<x-layouts.app>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Ubah Kata Sandi</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/tenant">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/tenant/profile">
                                Profil
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Ubah Kata Sandi</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="edit-profile">
            <div class="row">
                <div class="col-lg-6 col-md-10 mx-auto">
                    <form class="card" action="/tenant/profile/password" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="card-header">
                            <h4 class="card-title mb-0">Ubah Kata Sandi Anda</h4>
                        </div>
                        
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Kata Sandi Saat Ini</label>
                                        <input class="form-control @error('current_password') is-invalid @enderror" 
                                               type="password" 
                                               name="current_password" 
                                               placeholder="Masukkan kata sandi saat ini" 
                                               required>
                                        @error('current_password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Kata Sandi Baru</label>
                                        <input class="form-control @error('password') is-invalid @enderror" 
                                               type="password" 
                                               name="password" 
                                               placeholder="Masukkan kata sandi baru" 
                                               required>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <small class="form-text text-muted">
                                            Kata sandi harus minimal 8 karakter dan berbeda dari kata sandi saat ini.
                                        </small>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Konfirmasi Kata Sandi Baru</label>
                                        <input class="form-control" 
                                               type="password" 
                                               name="password_confirmation" 
                                               placeholder="Konfirmasi kata sandi baru" 
                                               required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-footer text-end">
                            <a href="/tenant/profile" class="btn btn-light">Batal</a>
                            <button class="btn btn-primary" type="submit">Perbarui Kata Sandi</button>
                        </div>
                    </form>
                </div>
                
                <div class="col-lg-6 col-md-10 mx-auto mt-4 d-md-none d-lg-block">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Tips Kata Sandi</h4>
                        </div>
                        <div class="card-body">
                            <div class="alert alert-primary" role="alert">
                                <h5 class="alert-heading">Buat kata sandi yang kuat</h5>
                                <ul class="mb-0">
                                    <li>Gunakan minimal 8 karakter</li>
                                    <li>Sertakan huruf besar dan kecil</li>
                                    <li>Gunakan angka dan karakter khusus</li>
                                    <li>Hindari informasi pribadi yang jelas</li>
                                    <li>Jangan gunakan ulang kata sandi dari situs web lain</li>
                                </ul>
                            </div>
                            
                            <div class="alert alert-warning" role="alert">
                                <h5 class="alert-heading">Lindungi akun Anda</h5>
                                <p>Setelah mengubah kata sandi, Anda akan keluar dari semua perangkat lain dan perlu masuk lagi.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</x-layouts.app>