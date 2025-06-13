<x-layouts.app>
    @push('css')
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('tenant/css/vendors/datatables.css') }}">
    @endpush
    
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Manajemen Theme</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Theme</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4>Kelola Theme Website</h4>
                                <span>Pilih dan kelola tampilan website Anda dengan berbagai theme yang tersedia.</span>
                            </div>
                            <a href="/admin/themes/create" class="btn btn-primary">
                                <i class="fa fa-plus me-1"></i> Buat Theme Baru
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Tutup"></button>
                            </div>
                        @endif
                        
                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Tutup"></button>
                            </div>
                        @endif
                        
                        <div class="row">
                            @foreach($themes as $theme)
                            <div class="col-xxl-4 col-md-6">
                                <div class="card theme-card {{ $theme->is_active ? 'active-theme' : '' }}">
                                    <div class="card-header pb-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <h5>{{ $theme->name }}</h5>
                                            @if($theme->is_active)
                                                <span class="badge badge-success">Aktif</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="theme-preview mb-3">
                                            @if($theme->preview_image)
                                                <img src="{{ asset('image/themes/' . $theme->preview_image) }}"
                                                     alt="{{ $theme->name }}" class="img-fluid rounded">
                                            @else
                                                <div class="preview-placeholder">
                                                    <i class="fa fa-image fa-3x text-muted"></i>
                                                    <p class="text-muted mt-2">Preview tidak tersedia</p>
                                                </div>
                                            @endif
                                        </div>
                                        <p class="text-muted">{{ $theme->description }}</p>
                                        
                                        <div class="theme-actions">
                                            @if(!$theme->is_active)
                                                <form action="/admin/themes/{{ $theme->id }}/activate" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-success btn-sm">
                                                        <i class="fa fa-check me-1"></i> Aktifkan
                                                    </button>
                                                </form>
                                            @endif
                                            
                                            <a href="/admin/themes/{{ $theme->id }}/edit-content" 
                                               class="btn btn-primary btn-sm">
                                                <i class="fa fa-edit me-1"></i>
                                            </a>
                                            
                                            <a href="/admin/themes/{{ $theme->id }}/edit" 
                                               class="btn btn-secondary btn-sm">
                                                <i class="fa fa-cog me-1"></i> 
                                            </a>
                                            
                                            @if(!$theme->is_active)
                                                <form action="/admin/themes/{{ $theme->id }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" 
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus theme ini?')">
                                                        <i class="fa fa-trash me-1"></i> Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
    
    @push('script')
    <style>
        .theme-card {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        
        .theme-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        
        .active-theme {
            border-color: #007bff;
            background: linear-gradient(145deg, #f8f9ff, #ffffff);
        }
        
        .theme-preview {
            height: 200px;
            overflow: hidden;
            border-radius: 0.375rem;
        }
        
        .preview-placeholder {
            height: 200px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fa;
            border-radius: 0.375rem;
        }
        
        .theme-actions {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
        }
        
        .theme-actions .btn {
            flex: 1;
            min-width: 80px;
        }
    </style>
    @endpush
</x-layouts.app>