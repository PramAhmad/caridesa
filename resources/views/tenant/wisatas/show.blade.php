<x-layouts.app>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Detail Wisata</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/wisatas">
                                Wisata
                            </a>
                        </li>
                        <li class="breadcrumb-item active">{{ $wisata->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <!-- Wisata Info -->
            <div class="col-xl-4 col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <h4>Informasi Wisata</h4>
                    </div>
                    <div class="card-body">
                        <div class="wisata-details">
                            <div class="text-center mb-4">
                                <div class="wisata-icon-large">
                                    🏞️
                                </div>
                                <h5 class="mt-3">{{ $wisata->name }}</h5>
                                @if($wisata->category)
                                    <p class="text-muted">
                                        <span class="badge rounded-pill badge-info">{{ $wisata->category->name }}</span>
                                    </p>
                                @endif
                            </div>
                            
                            <div class="info-list">
                                <div class="info-item">
                                    <strong>Slug:</strong>
                                    <code class="text-primary">{{ $wisata->slug }}</code>
                                </div>
                                
                                <div class="info-item">
                                    <strong>Kategori:</strong>
                                    @if($wisata->category)
                                        <span class="badge rounded-pill badge-info">{{ $wisata->category->name }}</span>
                                    @else
                                        <span class="text-muted">Tidak ada kategori</span>
                                    @endif
                                </div>
                                
                                <div class="info-item">
                                    <strong>Lokasi:</strong>
                                    <span>{{ $wisata->coordinates }}</span>
                                </div>
                                
                                <div class="info-item">
                                    <strong>Jumlah Gambar:</strong>
                                    <span class="badge rounded-pill badge-success">{{ $wisata->images->count() }} gambar</span>
                                </div>
                                
                                <div class="info-item">
                                    <strong>Dibuat:</strong>
                                    {{ $wisata->created_at->format('d F Y') }}
                                </div>
                                
                                <div class="info-item">
                                    <strong>Terakhir Diperbarui:</strong>
                                    {{ $wisata->updated_at->format('d F Y') }}
                                </div>
                                
                                <div class="info-item">
                                    <strong>Deskripsi:</strong>
                                    <p class="mb-0">{{ $wisata->description }}</p>
                                </div>
                            </div>
                            
                            <div class="action-buttons mt-4">
                                <a href="/wisatas/{{ $wisata->slug }}/edit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit me-1"></i> Edit Wisata
                                </a>
                                <a href="{{ $wisata->google_maps_url }}" target="_blank" class="btn btn-success btn-sm">
                                    <i class="fa fa-map-marker-alt me-1"></i> Lihat di Maps
                                </a>
                                <a href="/wisatas" class="btn btn-light btn-sm">
                                    <i class="fa fa-arrow-left me-1"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Images Gallery -->
            <div class="col-xl-8 col-lg-7">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h4>Galeri Gambar</h4>
                            <span class="text-muted">{{ $wisata->images->count() }} gambar</span>
                        </div>
                        <a href="/admin/wisatas/{{ $wisata->slug }}/edit" class="btn btn-primary btn-sm">
                            <i class="fa fa-plus me-1"></i> Tambah Gambar
                        </a>
                    </div>
                    <div class="card-body">
                        @if($wisata->images && $wisata->images->count() > 0)
                            <div class="row">
                                @foreach($wisata->images as $image)
                                <div class="col-md-6 col-lg-4 mb-3">
                                    <div class="image-card">
                                        <div class="image-container">
                                            <img src="{{ asset($image->name) }}" alt="{{ $wisata->name }}" class="img-fluid" onclick="openModal('{{ $image->url }}', '{{ $wisata->name }}')">
                                            <div class="image-overlay">
                                                <button class="btn btn-sm btn-light" onclick="openModal('{{ $image->url }}', '{{ $wisata->name }}')">
                                                    <i class="fa fa-eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="image-info">
                                            <small class="text-muted">{{ $image->created_at->format('d/m/Y') }}</small>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state text-center py-5">
                                <div class="empty-icon mb-3">
                                    📸
                                </div>
                                <h5>Belum Ada Gambar</h5>
                                <p class="text-muted">Destinasi wisata ini belum memiliki gambar. Tambahkan gambar untuk menarik lebih banyak pengunjung!</p>
                                <a href="/admin/wisatas/{{ $wisata->slug }}/edit" class="btn btn-primary">
                                    <i class="fa fa-plus me-1"></i> Tambah Gambar
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
    
    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Gambar Wisata</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
    
    @push('script')
    <script>
        function openModal(imageUrl, altText) {
            document.getElementById('modalImage').src = imageUrl;
            document.getElementById('modalImage').alt = altText;
            document.getElementById('imageModalLabel').textContent = altText;
            
            var imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
            imageModal.show();
        }
    </script>
    @endpush
    
    <style>
        .wisata-icon-large {
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
        
        .image-card {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        
        .image-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .image-container {
            position: relative;
            height: 200px;
            overflow: hidden;
        }
        
        .image-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        
        .image-container:hover img {
            transform: scale(1.05);
        }
        
        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .image-container:hover .image-overlay {
            opacity: 1;
        }
        
        .image-info {
            padding: 0.75rem;
            text-align: center;
        }
        
        .empty-state .empty-icon {
            font-size: 3rem;
            opacity: 0.5;
        }
        
        .action-buttons .btn {
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }
    </style>
</x-layouts.app>