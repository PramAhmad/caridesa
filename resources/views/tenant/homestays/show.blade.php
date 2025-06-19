<x-layouts.app>
    @push('css')
    <style>
        .homestay-icon-large {
            font-size: 4rem;
            color: #28a745;
        }
        .price-display {
            border: 2px solid #e9ecef;
            border-radius: 10px;
            padding: 15px;
            margin: 15px 0;
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        }
        .info-list .info-item {
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #e9ecef;
        }
        .info-list .info-item:last-child {
            border-bottom: none;
        }
        .action-buttons .btn {
            margin-right: 5px;
            margin-bottom: 5px;
        }
        .image-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        }
        .image-item {
            position: relative;
            overflow: hidden;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .image-item:hover {
            transform: translateY(-3px);
        }
        .image-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            cursor: pointer;
        }
        .image-actions {
            position: absolute;
            top: 10px;
            right: 10px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .image-item:hover .image-actions {
            opacity: 1;
        }
        .image-counter {
            position: absolute;
            bottom: 10px;
            left: 10px;
            background: rgba(0,0,0,0.7);
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.8rem;
        }
        .no-images {
            text-align: center;
            padding: 60px 20px;
            background: #f8f9fa;
            border-radius: 8px;
            border: 2px dashed #dee2e6;
        }
        .no-images-icon {
            font-size: 4rem;
            color: #6c757d;
            margin-bottom: 20px;
        }
    </style>
    @endpush
    
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Detail Homestay</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/admin/homestays">
                                Homestay
                            </a>
                        </li>
                        <li class="breadcrumb-item active">{{ $homestay->name }}</li>
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
            <!-- Homestay Info -->
            <div class="col-xl-4 col-lg-5">
                <div class="card">
                    <div class="card-header">
                        <h4>Informasi Homestay</h4>
                    </div>
                    <div class="card-body">
                        <div class="homestay-details">
                            <div class="text-center mb-4">
                                <div class="homestay-icon-large">
                                    🏠
                                </div>
                                <h5 class="mt-3">{{ $homestay->name }}</h5>
                                <div class="price-display">
                                    @if($homestay->has_discount)
                                        <div class="original-price text-decoration-line-through text-muted">
                                            {{ $homestay->formatted_price }}
                                        </div>
                                        <div class="discounted-price text-success h5 mb-0">
                                            {{ $homestay->formatted_discounted_price }}
                                        </div>
                                        <span class="badge rounded-pill badge-warning mt-2">
                                            {{ $homestay->discount_percent }}% OFF
                                        </span>
                                    @else
                                        <div class="price h5 mb-0">
                                            {{ $homestay->formatted_price }}
                                        </div>
                                    @endif
                                    <small class="text-muted d-block mt-2">per malam</small>
                                </div>
                            </div>
                            
                            <div class="info-list">
                                <div class="info-item">
                                    <strong>Status:</strong>
                                    @if($homestay->is_active)
                                        <span class="badge rounded-pill badge-success">Aktif</span>
                                    @else
                                        <span class="badge rounded-pill badge-secondary">Tidak Aktif</span>
                                    @endif
                                </div>
                                
                                <div class="info-item">
                                    <strong>Alamat:</strong>
                                    <span>{{ $homestay->address }}</span>
                                </div>
                                
                                <div class="info-item">
                                    <strong>Kontak:</strong>
                                    <div>
                                        <div>📞 {{ $homestay->phone }}</div>
                                        @if($homestay->email)
                                            <div>✉️ {{ $homestay->email }}</div>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="info-item">
                                    <strong>Jumlah Gambar:</strong>
                                    <span class="badge rounded-pill badge-info">{{ $homestay->images->count() }} gambar</span>
                                </div>
                                
                                <div class="info-item">
                                    <strong>Dibuat:</strong>
                                    {{ $homestay->created_at->format('d F Y') }}
                                </div>
                                
                                <div class="info-item">
                                    <strong>Terakhir Diperbarui:</strong>
                                    {{ $homestay->updated_at->format('d F Y') }}
                                </div>
                                
                                <div class="info-item">
                                    <strong>Deskripsi:</strong>
                                    <p class="mb-0">{{ $homestay->description }}</p>
                                </div>
                            </div>
                            
                            <div class="action-buttons mt-4">
                                <a href="/admin/homestays/{{ $homestay->id }}/edit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-edit me-1"></i> Edit Homestay
                                </a>
                                @if($homestay->whatsapp_url)
                                    <a href="{{ $homestay->whatsapp_url }}" target="_blank" class="btn btn-success btn-sm">
                                        <i class="fab fa-whatsapp me-1"></i> WhatsApp
                                    </a>
                                @endif
                                <button onclick="toggleStatus({{ $homestay->id }})" class="btn btn-warning btn-sm">
                                    <i class="fa fa-toggle-on me-1"></i> {{ $homestay->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                </button>
                                <button onclick="confirmDelete({{ $homestay->id }})" class="btn btn-danger btn-sm">
                                    <i class="fa fa-trash me-1"></i> Hapus
                                </button>
                                
                                <!-- Hidden Forms -->
                                <form id="toggle-status-form-{{ $homestay->id }}" action="/admin/homestays/{{ $homestay->id }}/toggle-status" method="POST" style="display: none;">
                                    @csrf
                                    @method('PATCH')
                                </form>
                                
                                <form id="delete-form-{{ $homestay->id }}" action="/admin/homestays/{{ $homestay->id }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Images Gallery -->
            <div class="col-xl-8 col-lg-7">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Galeri Gambar ({{ $homestay->images->count() }})</h4>
                        <a href="/admin/homestays/{{ $homestay->id }}/edit" class="btn btn-success btn-sm">
                            <i class="fa fa-plus me-1"></i> Tambah Gambar
                        </a>
                    </div>
                    <div class="card-body">
                        @if($homestay->images->count() > 0)
                            <div class="image-gallery">
                                @foreach($homestay->images as $index => $image)
                                    <div class="image-item">
                                        <img src="{{ asset($image->name) }}" 
                                             alt="Homestay {{ $homestay->name }}" 
                                             onclick="showImageModal('{{ asset($image->name) }}', '{{ $homestay->name }}', {{ $index + 1 }})">
                                        
                                        <div class="image-actions">
                                            <button onclick="deleteImage({{ $image->id }})" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                        
                                        <div class="image-counter">
                                            {{ $index + 1 }} / {{ $homestay->images->count() }}
                                        </div>
                                        
                                        <form id="delete-image-form-{{ $image->id }}" action="/admin/homestay-images/{{ $image->id }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="no-images">
                                <div class="no-images-icon">📷</div>
                                <h5>Belum Ada Gambar</h5>
                                <p class="text-muted">Homestay ini belum memiliki gambar. Tambahkan gambar untuk menarik lebih banyak tamu.</p>
                                <a href="/admin/homestays/{{ $homestay->id }}/edit" class="btn btn-success">
                                    <i class="fa fa-plus me-2"></i> Tambah Gambar Pertama
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
                    <h5 class="modal-title" id="imageModalLabel">Gambar Homestay</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="modalImage" src="" alt="" class="img-fluid rounded">
                </div>
                <div class="modal-footer">
                    <span id="modalImageInfo" class="me-auto text-muted"></span>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    
    @push('script')
    <script>
        function showImageModal(imageSrc, homestayName, imageIndex) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('modalImage').alt = `${homestayName} - Gambar ${imageIndex}`;
            document.getElementById('imageModalLabel').textContent = `${homestayName} - Gambar ${imageIndex}`;
            document.getElementById('modalImageInfo').textContent = `Gambar ${imageIndex} dari {{ $homestay->images->count() }}`;
            
            const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
            imageModal.show();
        }
        
        function toggleStatus(homestayId) {
            const currentStatus = {{ $homestay->is_active ? 'true' : 'false' }};
            const action = currentStatus ? 'menonaktifkan' : 'mengaktifkan';
            
            if (confirm(`Apakah Anda yakin ingin ${action} homestay ini?`)) {
                document.getElementById('toggle-status-form-' + homestayId).submit();
            }
        }
        
        function confirmDelete(homestayId) {
            if (confirm('Apakah Anda yakin ingin menghapus homestay ini? Semua gambar terkait juga akan dihapus dan tidak dapat dikembalikan.')) {
                document.getElementById('delete-form-' + homestayId).submit();
            }
        }
        
        function deleteImage(imageId) {
            if (confirm('Apakah Anda yakin ingin menghapus gambar ini?')) {
                document.getElementById('delete-image-form-' + imageId).submit();
            }
        }
        
        // Keyboard navigation for image modal
        document.addEventListener('keydown', function(e) {
            if (document.getElementById('imageModal').classList.contains('show')) {
                if (e.key === 'Escape') {
                    bootstrap.Modal.getInstance(document.getElementById('imageModal')).hide();
                }
            }
        });
        
        @if(session('success') || session('error'))
            setTimeout(function() {
            }, 3000);
        @endif
    </script>
    @endpush
</x-layouts.app>