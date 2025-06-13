<x-layouts.app>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Profil</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/tenant">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Profil</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
        @endif
        
        <div class="card">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Informasi Profil</h5>
                    <div>
                        <a href="/tenant/profile/edit" class="btn btn-primary btn-sm">
                            <i class="fa fa-edit me-1"></i> Edit
                        </a>
                        <a href="/tenant/profile/password" class="btn btn-light btn-sm">
                            <i class="fa fa-key me-1"></i> Ubah Kata Sandi
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 col-lg-3 text-center mb-3 mb-md-0">
                        <div class="avatar mb-3">
                            @if($user->avatar)
                                <img src="{{ asset('tenant/images/user/user.png') }}" alt="Gambar Profil" class="img-100 rounded-circle">
                            @else
                                <img src="{{ asset('tenant/images/user/user.png') }}" alt="Avatar Default" class="img-100 rounded-circle">
                            @endif
                        </div>
                        <h5>{{ $user->name }}</h5>
                        <p class="text-muted mb-0">
                            @if($user->roles->isNotEmpty())
                                {{ $user->roles->pluck('name')->join(', ') }}
                            @else
                                Pengguna
                            @endif
                        </p>
                        <p class="text-muted mb-0">
                            <small>Anggota sejak {{ $user->created_at->format('d M Y') }}</small>
                        </p>
                    </div>
                    
                    <div class="col-md-8 col-lg-9">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td width="150"><strong>Email:</strong></td>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Telepon:</strong></td>
                                        <td>{{ $user->phone ?? 'Belum diisi' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Lokasi:</strong></td>
                                        <td>{{ $user->location ?? 'Belum diisi' }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Bio:</strong></td>
                                        <td>{{ $user->bio ?? 'Belum ada informasi bio.' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Recent Activity Card (Optional) -->
        <div class="card mt-4">
            <div class="card-header">
                <h5>Keamanan Akun</h5>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center mb-3">
                    <div class="flex-shrink-0">
                        <div class="bg-light-primary rounded-circle p-2">
                            <i class="fa fa-shield-alt text-primary"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0">Kata Sandi</h6>
                        <small class="text-muted">Terakhir diubah: Belum pernah</small>
                    </div>
                    <div class="flex-shrink-0">
                        <a href="/tenant/profile/password" class="btn btn-outline-primary btn-sm">Ubah</a>
                    </div>
                </div>
                
                <div class="d-flex align-items-center">
                    <div class="flex-shrink-0">
                        <div class="bg-light-warning rounded-circle p-2">
                            <i class="fa fa-lock text-warning"></i>
                        </div>
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h6 class="mb-0">Autentikasi Dua Faktor</h6>
                        <small class="text-muted">Belum diaktifkan</small>
                    </div>
                    <div class="flex-shrink-0">
                        <button class="btn btn-outline-secondary btn-sm" disabled>Segera Hadir</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</x-layouts.app>