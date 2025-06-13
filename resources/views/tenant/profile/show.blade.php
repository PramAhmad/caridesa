<x-layouts.app>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Edit Profil</h4>
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
                        <li class="breadcrumb-item active">Edit</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="edit-profile">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header pb-0">
                            <h5 class="card-title mb-0">Ringkasan Profil</h5>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <div class="avatar mb-3">
                                    @if($user->avatar)
                                        <img class="rounded-circle img-90" src="{{ Storage::url($user->avatar) }}" alt="avatar pengguna">
                                    @else
                                        <img class="rounded-circle img-90" src="{{ asset('tenant/images/user/default-avatar.png') }}" alt="avatar pengguna">
                                    @endif
                                </div>
                                <h5 class="mb-1">{{ $user->name }}</h5>
                                <p class="text-muted">
                                    @if($user->roles->isNotEmpty())
                                        {{ $user->roles->pluck('name')->join(', ') }}
                                    @else
                                        Pengguna
                                    @endif
                                </p>
                            </div>
                            
                            <div class="mb-3">
                                <label class="fw-bold d-block">Email</label>
                                <span>{{ $user->email }}</span>
                            </div>
                            
                            <div class="mb-3">
                                <label class="fw-bold d-block">Anggota Sejak</label>
                                <span>{{ $user->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-8">
                    <form class="card" action="/tenant/profile" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-header pb-0">
                            <h5 class="card-title mb-0">Edit Informasi Profil</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name', $user->name) }}" placeholder="Nama lengkap Anda">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Email</label>
                                    <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email', $user->email) }}" placeholder="email-anda@domain.com">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Telepon</label>
                                    <input class="form-control @error('phone') is-invalid @enderror" type="text" name="phone" value="{{ old('phone', $user->phone) }}" placeholder="Nomor telepon Anda">
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-12 mb-3">
                                    <label class="form-label">Lokasi</label>
                                    <input class="form-control @error('location') is-invalid @enderror" type="text" name="location" value="{{ old('location', $user->location) }}" placeholder="Lokasi Anda">
                                    @error('location')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-12 mb-3">
                                    <label class="form-label">Bio</label>
                                    <textarea class="form-control @error('bio') is-invalid @enderror" rows="3" name="bio" placeholder="Tulis sesuatu tentang diri Anda">{{ old('bio', $user->bio) }}</textarea>
                                    @error('bio')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-12">
                                    <label class="form-label">Unggah Avatar</label>
                                    <input class="form-control @error('avatar') is-invalid @enderror" type="file" name="avatar" accept="image/*">
                                    <small class="form-text text-muted">Ukuran file maksimal: 2MB. Jenis yang diizinkan: jpg, jpeg, png.</small>
                                    @error('avatar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <a href="/tenant/profile" class="btn btn-light">Batal</a>
                            <button class="btn btn-primary" type="submit">Simpan Perubahan</button>
                        </div>
                    </form>
                    
                    <div class="card mt-4">
                        <div class="card-header pb-0">
                            <h5 class="card-title mb-0">Pengaturan Keamanan</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h6 class="fw-bold mb-1">Kata Sandi</h6>
                                    <p class="text-muted small mb-0">Perbarui kata sandi akun Anda</p>
                                </div>
                                <a href="/tenant/profile/password" class="btn btn-outline-primary btn-sm">
                                    <i class="fa fa-key me-1"></i> Ubah
                                </a>
                            </div>
                            
                            <hr>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="fw-bold mb-1">Autentikasi Dua Faktor</h6>
                                    <p class="text-muted small mb-0">Tambahkan keamanan ekstra ke akun Anda</p>
                                </div>
                                <button class="btn btn-outline-secondary btn-sm" disabled>Segera Hadir</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</x-layouts.app>