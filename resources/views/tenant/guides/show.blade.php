<x-layouts.app>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Detail Pemandu</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/admin/guides">
                                Pemandu
                            </a>
                        </li>
                        <li class="breadcrumb-item active">{{ $guide->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <!-- Guide Information Card -->
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-1">{{ $guide->name }}</h4>
                            <div class="d-flex align-items-center gap-2">
                                <span class="badge rounded-pill badge-{{ $guide->status_color }}">
                                    {{ $guide->status_label }}
                                </span>
                                @if($guide->hasDiscount())
                                    <span class="badge rounded-pill badge-warning">
                                        Diskon {{ $guide->discount_percent }}%
                                    </span>
                                @endif
                                <small class="text-muted">ID: #{{ $guide->id }}</small>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="/admin/guides/{{ $guide->slug }}/edit" class="btn btn-primary">
                                <i class="fa fa-edit me-1"></i> Edit
                            </a>
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                    <i class="fa fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="#" onclick="confirmToggle()">
                                            <i class="fa fa-toggle-{{ $guide->is_active ? 'off' : 'on' }} me-2"></i>
                                            {{ $guide->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <a class="dropdown-item text-danger" href="#" onclick="confirmDelete()">
                                            <i class="fa fa-trash me-2"></i> Hapus Pemandu
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Basic Information -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="border-bottom pb-2 mb-3">🧑‍🏫 Informasi Pemandu</h5>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label text-muted small">Deskripsi</label>
                                <div class="guide-description">
                                    {{ $guide->description }}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label text-muted small">Alamat</label>
                                <div class="guide-address">
                                    <i class="fa fa-map-marker-alt text-danger me-2"></i>
                                    {{ $guide->address }}
                                </div>
                            </div>
                        </div>
                        
                        <!-- Contact Information -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="border-bottom pb-2 mb-3">📞 Informasi Kontak</h5>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small">Nomor Telepon</label>
                                <div class="contact-item">
                                    <i class="fa fa-phone text-success me-2"></i>
                                    <a href="tel:{{ $guide->phone }}" class="text-decoration-none">
                                        {{ $guide->phone }}
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small">Email</label>
                                <div class="contact-item">
                                    @if($guide->email)
                                        <i class="fa fa-envelope text-primary me-2"></i>
                                        <a href="mailto:{{ $guide->email }}" class="text-decoration-none">
                                            {{ $guide->email }}
                                        </a>
                                    @else
                                        <span class="text-muted">Tidak ada email</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        <!-- Pricing Information -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h5 class="border-bottom pb-2 mb-3">💰 Informasi Harga</h5>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-muted small">Harga Per Hari</label>
                                <div class="price-display">
                                    @if($guide->hasDiscount())
                                        <span class="original-price text-decoration-line-through text-muted">
                                            {{ $guide->formatted_price }}
                                        </span>
                                        <div class="discounted-price text-success fw-bold fs-5">
                                            {{ $guide->formatted_discounted_price }}
                                        </div>
                                        <small class="text-success">
                                            <i class="fa fa-tag me-1"></i>
                                            Hemat {{ $guide->formatted_price - $guide->formatted_discounted_price }}
                                        </small>
                                    @else
                                        <div class="normal-price fw-bold fs-5">
                                            {{ $guide->formatted_price }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @if($guide->hasDiscount())
                            <div class="col-md-6">
                                <label class="form-label text-muted small">Diskon</label>
                                <div class="discount-display">
                                    <span class="badge badge-warning fs-6">
                                        {{ $guide->discount_percent }}% OFF
                                    </span>
                                    <div class="text-muted small mt-1">
                                        Diskon berlaku untuk pemesanan
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        
                        <!-- Meta Information -->
                        <div class="row">
                            <div class="col-12">
                                <h5 class="border-bottom pb-2 mb-3">📊 Informasi Meta</h5>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-muted small">Slug URL</label>
                                <div class="meta-item">
                                    <code>{{ $guide->slug }}</code>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-muted small">Dibuat</label>
                                <div class="meta-item">
                                    <i class="fa fa-calendar text-primary me-2"></i>
                                    {{ $guide->created_at->format('d/m/Y H:i') }}
                                    <small class="text-muted d-block">
                                        {{ $guide->created_at->diffForHumans() }}
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-muted small">Terakhir Diperbarui</label>
                                <div class="meta-item">
                                    <i class="fa fa-clock text-warning me-2"></i>
                                    {{ $guide->updated_at->format('d/m/Y H:i') }}
                                    <small class="text-muted d-block">
                                        {{ $guide->updated_at->diffForHumans() }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Images Card -->
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            📸 Foto Pemandu 
                            <span class="badge bg-info">{{ $guide->images->count() }}</span>
                        </h5>
                        @if($guide->images->count() > 0)
                            <button class="btn btn-outline-primary btn-sm" onclick="openImageGallery()">
                                <i class="fa fa-expand me-1"></i> Galeri
                            </button>
                        @endif
                    </div>
                    <div class="card-body">
                        @if($guide->images->count() > 0)
                            <div class="guide-images">
                                <!-- Main Image -->
                                <div class="main-image-container mb-3">
                                    <img src="{{ $guide->main_image_url }}" 
                                         alt="{{ $guide->name }}" 
                                         class="main-image"
                                         id="mainImage">
                                </div>
                                
                                <!-- Thumbnail Images -->
                                @if($guide->images->count() > 1)
                                <div class="thumbnail-images">
                                    <div class="row g-2">
                                        @foreach($guide->images as $index => $image)
                                        <div class="col-4">
                                            <div class="thumbnail-item {{ $index === 0 ? 'active' : '' }}" 
                                                 onclick="changeMainImage('{{ $image->url }}', {{ $index }})">
                                                <img src="{{ $image->url }}" 
                                                     alt="Foto {{ $index + 1 }}" 
                                                     class="thumbnail-image">
                                                <div class="thumbnail-overlay">
                                                    <span class="thumbnail-number">{{ $index + 1 }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>
                        @else
                            <div class="no-images text-center py-4">
                                <div class="no-image-icon mb-3">
                                    <i class="fa fa-image text-muted" style="font-size: 3rem;"></i>
                                </div>
                                <h6 class="text-muted">Belum Ada Foto</h6>
                                <p class="text-muted small mb-3">
                                    Pemandu ini belum memiliki foto. Tambahkan foto untuk meningkatkan daya tarik.
                                </p>
                                <a href="/admin/guides/{{ $guide->slug }}/edit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-plus me-1"></i> Tambah Foto
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                
                <!-- Quick Actions Card -->
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="mb-0">⚡ Aksi Cepat</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="/admin/guides/{{ $guide->slug }}/edit" class="btn btn-outline-primary">
                                <i class="fa fa-edit me-2"></i> Edit Pemandu
                            </a>
                            <button class="btn btn-outline-{{ $guide->is_active ? 'warning' : 'success' }}" 
                                    onclick="confirmToggle()">
                                <i class="fa fa-toggle-{{ $guide->is_active ? 'off' : 'on' }} me-2"></i>
                                {{ $guide->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                            <a href="/admin/guides" class="btn btn-outline-secondary">
                                <i class="fa fa-arrow-left me-2"></i> Kembali ke Daftar
                            </a>
                            <hr>
                            <button class="btn btn-outline-danger" onclick="confirmDelete()">
                                <i class="fa fa-trash me-2"></i> Hapus Pemandu
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
    
    <!-- Image Gallery Modal -->
    @if($guide->images->count() > 0)
    <div class="modal fade" id="imageGalleryModal" tabindex="-1">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Galeri Foto - {{ $guide->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        @foreach($guide->images as $index => $image)
                        <div class="col-md-6 col-lg-4">
                            <div class="gallery-item">
                                <img src="{{ $image->url }}" 
                                     alt="Foto {{ $index + 1 }}" 
                                     class="gallery-image"
                                     onclick="openImageViewer('{{ $image->url }}')">
                                <div class="gallery-overlay">
                                    <div class="gallery-info">
                                        <span class="gallery-number">{{ $index + 1 }} / {{ $guide->images->count() }}</span>
                                        <span class="gallery-name">{{ $image->filename }}</span>
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
    @endif
    
    <!-- Hidden forms for actions -->
    <form id="toggle-form" action="/admin/guides/{{ $guide->slug }}/toggle-status" method="POST" style="display: none;">
        @csrf
        @method('PATCH')
    </form>
    
    <form id="delete-form" action="/admin/guides/{{ $guide->slug }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
    
    @push('script')
    <script>
        // Change main image
        function changeMainImage(imageUrl, index) {
            document.getElementById('mainImage').src = imageUrl;
            
            // Update active thumbnail
            document.querySelectorAll('.thumbnail-item').forEach((item, i) => {
                if (i === index) {
                    item.classList.add('active');
                } else {
                    item.classList.remove('active');
                }
            });
        }
        
        // Open image gallery modal
        function openImageGallery() {
            const modal = new bootstrap.Modal(document.getElementById('imageGalleryModal'));
            modal.show();
        }
        
        // Open image in full screen viewer
        function openImageViewer(imageUrl) {
            window.open(imageUrl, '_blank');
        }
        
        // Confirm toggle status
        function confirmToggle() {
            const action = {{ $guide->is_active ? 'false' : 'true' }} ? 'mengaktifkan' : 'menonaktifkan';
            if (confirm(`Apakah Anda yakin ingin ${action} pemandu ini?`)) {
                document.getElementById('toggle-form').submit();
            }
        }
        
        // Confirm delete
        function confirmDelete() {
            if (confirm(`Apakah Anda yakin ingin menghapus pemandu "${{{ json_encode($guide->name) }}}"? Semua foto terkait juga akan dihapus. Tindakan ini tidak dapat dibatalkan.`)) {
                document.getElementById('delete-form').submit();
            }
        }
    </script>
    
    <style>
        .guide-description {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #007bff;
            line-height: 1.6;
        }
        
        .guide-address {
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 6px;
            font-size: 0.95rem;
        }
        
        .contact-item {
            font-size: 1rem;
            padding: 8px 0;
        }
        
        .contact-item a {
            color: #495057;
            font-weight: 500;
        }
        
        .contact-item a:hover {
            color: #007bff;
        }
        
        .price-display {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #28a745;
        }
        
        .original-price {
            font-size: 0.9rem;
        }
        
        .discounted-price {
            font-size: 1.25rem;
        }
        
        .discount-display {
            background-color: #fff3cd;
            padding: 15px;
            border-radius: 8px;
            border-left: 4px solid #ffc107;
        }
        
        .meta-item {
            background-color: #f8f9fa;
            padding: 8px;
            border-radius: 6px;
            font-size: 0.9rem;
        }
        
        .meta-item code {
            background-color: #e9ecef;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 0.85rem;
        }
        
        /* Image Gallery Styles */
        .main-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        
        .main-image:hover {
            transform: scale(1.02);
        }
        
        .thumbnail-item {
            position: relative;
            cursor: pointer;
            border-radius: 6px;
            overflow: hidden;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }
        
        .thumbnail-item.active {
            border-color: #007bff;
        }
        
        .thumbnail-item:hover {
            border-color: #007bff;
            transform: scale(1.05);
        }
        
        .thumbnail-image {
            width: 100%;
            height: 60px;
            object-fit: cover;
        }
        
        .thumbnail-overlay {
            position: absolute;
            top: 4px;
            right: 4px;
            background-color: rgba(0,0,0,0.7);
            color: white;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 0.7rem;
        }
        
        .no-images {
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            background-color: #f8f9fa;
        }
        
        /* Gallery Modal Styles */
        .gallery-item {
            position: relative;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.3s ease;
        }
        
        .gallery-item:hover {
            transform: scale(1.05);
        }
        
        .gallery-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        
        .gallery-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0,0,0,0.8));
            color: white;
            padding: 15px 10px 10px;
            font-size: 0.8rem;
        }
        
        .gallery-number {
            font-weight: bold;
        }
        
        .gallery-name {
            display: block;
            font-size: 0.7rem;
            opacity: 0.8;
            margin-top: 2px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .main-image {
                height: 200px;
            }
            
            .gallery-image {
                height: 150px;
            }
        }
    </style>
    @endpush
</x-layouts.app>