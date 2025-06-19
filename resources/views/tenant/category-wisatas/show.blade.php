<x-layouts.app>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Detail Kategori Wisata</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('category-wisatas.index') }}">
                                Kategori Wisata
                            </a>
                        </li>
                        <li class="breadcrumb-item active">{{ $categoryWisata->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <!-- Category Info -->
            <div class="col-xl-4 col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <h4>Informasi Kategori</h4>
                    </div>
                    <div class="card-body">
                        <div class="category-details">
                            <div class="text-center mb-4">
                                <div class="category-icon-large">
                                    🏞️
                                </div>
                                <h5 class="mt-3">{{ $categoryWisata->name }}</h5>
                                <p class="text-muted">
                                    @if($categoryWisata->is_active)
                                        <span class="badge rounded-pill badge-success">Aktif</span>
                                    @else
                                        <span class="badge rounded-pill badge-secondary">Tidak Aktif</span>
                                    @endif
                                </p>
                            </div>
                            
                            <div class="info-list">
                                <div class="info-item">
                                    <strong>Slug:</strong>
                                    <code class="text-primary">{{ $categoryWisata->slug }}</code>
                                </div>
                                
                                <div class="info-item">
                                    <strong>Jumlah Wisata:</strong>
                                    <span class="badge rounded-pill badge-info">{{ $categoryWisata->wisatas_count ?? 0 }} destinasi</span>
                                </div>
                                
                                <div class="info-item">
                                    <strong>Dibuat:</strong>
                                    {{ $categoryWisata->created_at->format('d F Y') }}
                                </div>
                                
                                <div class="info-item">
                                    <strong>Terakhir Diperbarui:</strong>
                                    {{ $categoryWisata->updated_at->format('d F Y') }}
                                </div>
                                
                                @if($categoryWisata->description)
                                <div class="info-item">
                                    <strong>Deskripsi:</strong>
                                    <p class="mb-0">{{ $categoryWisata->description }}</p>
                                </div>
                                @endif
                            </div>
                            
                            <div class="action-buttons mt-4">
                                <a href="{{ route('category-wisatas.edit', $categoryWisata) }}" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit me-1"></i> Edit Kategori
                                </a>
                                <a href="{{ route('category-wisatas.index') }}" class="btn btn-light btn-sm">
                                    <i class="fa fa-arrow-left me-1"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Wisatas in this category -->
            <div class="col-xl-8 col-lg-7">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h4>Destinasi Wisata dalam Kategori Ini</h4>
                            <span class="text-muted">{{ $categoryWisata->wisatas_count ?? 0 }} total destinasi</span>
                        </div>
                        <a href="{{ route('wisatas.create') }}?category={{ $categoryWisata->id }}" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus me-1"></i> Tambah Wisata
                        </a>
                    </div>
                    <div class="card-body">
                        @if($categoryWisata->wisatas && $categoryWisata->wisatas->count() > 0)
                            <div class="row">
                                @foreach($categoryWisata->wisatas as $wisata)
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <div class="wisata-card">
                                        <div class="wisata-image">
                                            @if($wisata->image)
                                                <img src="{{ $wisata->image_url }}" alt="{{ $wisata->name }}" class="img-fluid">
                                            @else
                                                <div class="no-image">
                                                    <i class="fa fa-image"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="wisata-info">
                                            <h6 class="wisata-name">{{ $wisata->name }}</h6>
                                            @if($wisata->location)
                                                <p class="wisata-location">
                                                    <i class="fa fa-map-marker-alt me-1"></i>
                                                    {{ $wisata->location }}
                                                </p>
                                            @endif
                                            @if($wisata->price)
                                                <p class="wisata-price">{{ $wisata->formatted_price ?? 'Rp ' . number_format($wisata->price) }}</p>
                                            @endif
                                            <span class="badge rounded-pill {{ $wisata->is_active ? 'bg-success' : 'bg-secondary' }}">
                                                {{ $wisata->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            
                            @if($categoryWisata->wisatas_count > 10)
                            <div class="text-center mt-3">
                                <a href="{{ route('wisatas.index') }}?category={{ $categoryWisata->id }}" class="btn btn-outline-primary">
                                    Lihat Semua Wisata ({{ $categoryWisata->wisatas_count }})
                                </a>
                            </div>
                            @endif
                        @else
                            <div class="empty-state text-center py-5">
                                <div class="empty-icon mb-3">
                                    🏞️
                                </div>
                                <h5>Belum Ada Destinasi Wisata</h5>
                                <p class="text-muted">Kategori ini belum memiliki destinasi wisata. Tambahkan wisata pertama sekarang!</p>
                                <a href="{{ route('wisatas.create') }}?category={{ $categoryWisata->id }}" class="btn btn-primary">
                                    <i class="fa fa-plus me-1"></i> Tambah Wisata Pertama
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
    
    <style>
        .category-icon-large {
            font-size: 4rem;
            margin-bottom: 1rem;
        }
        
        .info-list .info-item {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 0.75rem 0;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .info-list .info-item:last-child {
            border-bottom: none;
        }
        
        .info-list .info-item strong {
            min-width: 120px;
            color: #333;
        }
        
        .wisata-card {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .wisata-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .wisata-image {
            height: 150px;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        
        .wisata-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .no-image {
            color: #ccc;
            font-size: 2rem;
        }
        
        .wisata-info {
            padding: 1rem;
        }
        
        .wisata-name {
            font-weight: 600;
            margin-bottom: 0.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .wisata-location {
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }
        
        .wisata-price {
            color: #28a745;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }
        
        .empty-state .empty-icon {
            font-size: 3rem;
            opacity: 0.5;
        }
        
        .action-buttons .btn {
            margin-right: 0.5rem;
        }
    </style>
</x-layouts.app>