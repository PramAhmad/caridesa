<x-layouts.app>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Edit Wisata</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/admin/wisatas">
                                Wisata
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
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Wisata: {{ $wisata->name }}</h4>
                        <p class="f-m-light mt-1">
                            Perbarui informasi destinasi wisata. Semua kolom yang diberi tanda <span class="text-danger">*</span> wajib diisi.
                        </p>
                    </div>
                    <div class="card-body">
                        <form class="row g-3 needs-validation custom-input position-relative" 
                            action="/admin/wisatas/{{ $wisata->slug }}" 
                            method="POST" 
                            enctype="multipart/form-data"
                            novalidate>
                            @csrf
                            @method('PUT')
                            
                            <!-- Basic Information -->
                            <div class="col-12">
                                <h5 class="border-bottom pb-2 mb-3">📋 Informasi Dasar</h5>
                            </div>
                            
                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltipName">Nama Wisata <span class="text-danger">*</span></label>
                                <input class="form-control @error('name') is-invalid @enderror" 
                                    id="validationTooltipName" 
                                    type="text" 
                                    name="name"
                                    value="{{ old('name', $wisata->name) }}"
                                    placeholder="Pantai Indah Kapas" 
                                    required>
                                <div class="valid-tooltip">Terlihat bagus!</div>
                                @error('name')
                                    <div class="invalid-tooltip">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Slug saat ini: <code>{{ $wisata->slug }}</code></small>
                            </div>
                            
                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltipCategory">Kategori Wisata <span class="text-danger">*</span></label>
                                <select class="form-select @error('category_wisata_id') is-invalid @enderror" 
                                        id="validationTooltipCategory" 
                                        name="category_wisata_id" 
                                        required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_wisata_id', $wisata->category_wisata_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="valid-tooltip">Terlihat bagus!</div>
                                @error('category_wisata_id')
                                    <div class="invalid-tooltip">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Kategori saat ini: <span class="fw-bold text-primary">{{ $wisata->category->name ?? 'Tidak ada' }}</span></small>
                            </div>
                            
                            <div class="col-12 position-relative">
                                <label class="form-label" for="validationTooltipDescription">Deskripsi Wisata <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                        id="validationTooltipDescription" 
                                        name="description"
                                        rows="4"
                                        placeholder="Deskripsi lengkap tentang destinasi wisata ini..."
                                        required>{{ old('description', $wisata->description) }}</textarea>
                                <div class="valid-tooltip">Terlihat bagus!</div>
                                @error('description')
                                    <div class="invalid-tooltip">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <!-- Location Information -->
                            <div class="col-12 mt-4">
                                <h5 class="border-bottom pb-2 mb-3">📍 Informasi Lokasi</h5>
                            </div>
                            
                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltipLatitude">Latitude <span class="text-danger">*</span></label>
                                <input class="form-control @error('latitude') is-invalid @enderror" 
                                    id="validationTooltipLatitude" 
                                    type="number" 
                                    name="latitude"
                                    value="{{ old('latitude', $wisata->latitude) }}"
                                    step="any"
                                    placeholder="-7.250445" 
                                    required>
                                <div class="valid-tooltip">Terlihat bagus!</div>
                                @error('latitude')
                                    <div class="invalid-tooltip">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Koordinat saat ini: <span class="fw-bold">{{ $wisata->latitude }}</span></small>
                            </div>
                            
                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltipLongitude">Longitude <span class="text-danger">*</span></label>
                                <input class="form-control @error('longitude') is-invalid @enderror" 
                                    id="validationTooltipLongitude" 
                                    type="number" 
                                    name="longitude"
                                    value="{{ old('longitude', $wisata->longitude) }}"
                                    step="any"
                                    placeholder="112.768845" 
                                    required>
                                <div class="valid-tooltip">Terlihat bagus!</div>
                                @error('longitude')
                                    <div class="invalid-tooltip">{{ $message }}</div>
                                @enderror
                                <small class="text-muted d-block">Koordinat saat ini: <span class="fw-bold">{{ $wisata->longitude }}</span></small>
                                
                                <!-- Map Helper Buttons -->
                                <div class="mt-2">
                                    <button type="button" class="btn btn-outline-info btn-sm me-2" onclick="openMapHelper()">
                                        <i class="fa fa-map-marker-alt me-1"></i> Buka Google Maps
                                    </button>
                                    <button type="button" class="btn btn-outline-success btn-sm" onclick="viewCurrentLocation()">
                                        <i class="fa fa-eye me-1"></i> Lihat Lokasi Saat Ini
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Existing Images Section -->
                            @if($wisata->images->count() > 0)
                            <div class="col-12 mt-4">
                                <h5 class="border-bottom pb-2 mb-3">🖼️ Gambar Saat Ini ({{ $wisata->images->count() }})</h5>
                                <div class="existing-images-grid">
                                    @foreach($wisata->images as $index => $image)
                                    <div class="existing-image-item" id="existing-image-{{ $image->id }}">
                                        <img src="{{ asset($image->name) }}" alt="Wisata {{ $wisata->name }}">
                                        <div class="existing-image-overlay">
                                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDeleteImage({{ $image->id }})">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>
                                        <div class="existing-image-info">
                                            <div class="image-counter">{{ $index + 1 }} / {{ $wisata->images->count() }}</div>
                                        </div>
                                        
                                        <!-- Hidden form for deleting individual images -->
                                        <form method="POST" action="/admin/wisatas/{{ $wisata->slug }}/images/{{ $image->id }}" id="delete-image-form-{{ $image->id }}" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            
                            <!-- New Images Upload Section -->
                            <div class="col-12 mt-4">
                                <h5 class="border-bottom pb-2 mb-3">📸 Tambah Gambar Baru</h5>
                            </div>
                            
                            <div class="col-12 position-relative">
                                <label class="form-label" for="validationTooltipImages">Upload Gambar Baru</label>
                                
                                <!-- Drop Zone -->
                                <div class="upload-drop-zone" id="uploadDropZone">
                                    <div class="upload-drop-zone-content">
                                        <div class="upload-icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                            </svg>
                                        </div>
                                        <h6>Drag & Drop gambar baru di sini</h6>
                                        <p class="text-muted mb-3">atau</p>
                                        <button type="button" class="btn btn-primary" onclick="document.getElementById('validationTooltipImages').click()">
                                            Pilih Gambar
                                        </button>
                                        <p class="text-muted mt-2 mb-0">
                                            <small>Format: JPEG, PNG, JPG, GIF • Maksimal 2MB per foto • Dapat memilih beberapa foto sekaligus</small>
                                        </p>
                                    </div>
                                </div>
                                
                                <input class="form-control d-none @error('images.*') is-invalid @enderror" 
                                    id="validationTooltipImages" 
                                    type="file" 
                                    name="images[]"
                                    multiple
                                    accept="image/jpeg,image/png,image/jpg,image/gif">
                                    
                                @error('images.*')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                                
                                <!-- New Image Preview Container -->
                                <div id="imagePreviewContainer" class="mt-4 d-none">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="mb-0">Preview Gambar Baru (<span id="imageCount">0</span>)</h6>
                                        <button type="button" class="btn btn-outline-danger btn-sm" onclick="clearAllImages()">
                                            <i class="fa fa-trash me-1"></i> Hapus Semua
                                        </button>
                                    </div>
                                    <div class="image-preview-grid" id="imagePreviewGrid"></div>
                                </div>
                            </div>
                            
                            <!-- Submit Buttons -->
                            <div class="col-12 mt-4 border-top pt-3">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="/admin/wisatas" class="btn btn-light">
                                        <i class="fa fa-times me-1"></i> Batal
                                    </a>
                                    <a href="/admin/wisatas/{{ $wisata->slug }}" class="btn btn-info">
                                        <i class="fa fa-eye me-1"></i> Lihat Detail
                                    </a>
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-save me-1"></i> Perbarui Wisata
                                    </button>
                                </div>
                            </div>
                        </form>
                        
                        <!-- Debugging Section -->
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <h5>Validation Errors:</h5>
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">
                                <h5>Error:</h5>
                                {{ session('error') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
    
    @push('script')
    <script>
        // Add CSRF token to meta tag
        const csrfToken = `{{ csrf_token() }}`;
        
        // Global variables for new images
        let selectedFiles = [];
        let fileInput = document.getElementById('validationTooltipImages');
        let dropZone = document.getElementById('uploadDropZone');
        let previewContainer = document.getElementById('imagePreviewContainer');
        let previewGrid = document.getElementById('imagePreviewGrid');
        let imageCount = document.getElementById('imageCount');
        
        // Form validation
        (function () {
            'use strict'

            var forms = document.querySelectorAll('.needs-validation')

            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
        
        // File input change handler
        fileInput.addEventListener('change', function(e) {
            handleFiles(e.target.files);
        });
        
        // Drag and drop handlers
        dropZone.addEventListener('dragover', function(e) {
            e.preventDefault();
            dropZone.classList.add('dragover');
        });
        
        dropZone.addEventListener('dragleave', function(e) {
            e.preventDefault();
            dropZone.classList.remove('dragover');
        });
        
        dropZone.addEventListener('drop', function(e) {
            e.preventDefault();
            dropZone.classList.remove('dragover');
            handleFiles(e.dataTransfer.files);
        });
        
        // Handle selected files
        function handleFiles(files) {
            const validFiles = Array.from(files).filter(file => {
                // Check file type
                if (!file.type.startsWith('image/')) {
                    showAlert('File ' + file.name + ' bukan gambar valid', 'warning');
                    return false;
                }
                
                // Check file size (2MB max)
                if (file.size > 2 * 1024 * 1024) {
                    showAlert('File ' + file.name + ' terlalu besar (max 2MB)', 'warning');
                    return false;
                }
                
                return true;
            });
            
            // Add valid files to selectedFiles array
            validFiles.forEach(file => {
                // Check if file already exists
                const exists = selectedFiles.some(existingFile => 
                    existingFile.name === file.name && 
                    existingFile.size === file.size
                );
                
                if (!exists) {
                    selectedFiles.push(file);
                }
            });
            
            updatePreview();
            updateFileInput();
        }
        
        // Update file input with selected files
        function updateFileInput() {
            const dt = new DataTransfer();
            selectedFiles.forEach(file => dt.items.add(file));
            fileInput.files = dt.files;
        }
        
        // Update new image preview
        function updatePreview() {
            if (selectedFiles.length === 0) {
                previewContainer.classList.add('d-none');
                return;
            }
            
            previewContainer.classList.remove('d-none');
            imageCount.textContent = selectedFiles.length;
            previewGrid.innerHTML = '';
            
            selectedFiles.forEach((file, index) => {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    const imageCard = document.createElement('div');
                    imageCard.className = 'image-preview-card';
                    imageCard.innerHTML = `
                        <div class="image-preview-item">
                            <img src="${e.target.result}" alt="${file.name}">
                            <div class="image-preview-overlay">
                                <button type="button" class="btn btn-danger btn-sm" onclick="removeImage(${index})">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                            <div class="image-preview-info">
                                <div class="image-name">${file.name}</div>
                                <div class="image-size">${formatFileSize(file.size)}</div>
                            </div>
                        </div>
                    `;
                    
                    previewGrid.appendChild(imageCard);
                };
                
                reader.readAsDataURL(file);
            });
        }
        
        // Remove single new image
        function removeImage(index) {
            selectedFiles.splice(index, 1);
            updatePreview();
            updateFileInput();
        }
        
        // Clear all new images
        function clearAllImages() {
            selectedFiles = [];
            updatePreview();
            updateFileInput();
        }
        
        // Format file size
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
        
        // Show alert
        function showAlert(message, type = 'info') {
            const alertDiv = document.createElement('div');
            alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
            alertDiv.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            document.querySelector('.container-fluid').prepend(alertDiv);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                alertDiv.remove();
            }, 5000);
        }
        
        // FIXED: Confirm delete existing image with correct URL
        function confirmDeleteImage(imageId) {
            if (confirm('Apakah Anda yakin ingin menghapus gambar ini? Tindakan ini tidak dapat dibatalkan.')) {
                // Add loading state
                const imageItem = document.getElementById('existing-image-' + imageId);
                if (imageItem) {
                    imageItem.style.opacity = '0.5';
                    imageItem.style.pointerEvents = 'none';
                    
                    // Show loading indicator
                    const overlay = imageItem.querySelector('.existing-image-overlay');
                    if (overlay) {
                        overlay.innerHTML = '<div class="spinner-border spinner-border-sm text-light" role="status"></div>';
                    }
                }
                
                // First try to find and submit the form
                const deleteForm = document.getElementById('delete-image-form-' + imageId);
                if (deleteForm) {
                    deleteForm.submit();
                } else {
                    // Use AJAX as fallback
                    deleteImageWithAjax(imageId);
                }
            }
        }
        
        // FIXED: Delete image with AJAX using correct URL
        function deleteImageWithAjax(imageId) {
            const wisataSlug = '{{ $wisata->slug }}';
            const csrf = '{{ csrf_token() }}';
            
            fetch(`/admin/wisatas/${wisataSlug}/images/${imageId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrf,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                }
                throw new Error('Network response was not ok');
            })
            .then(data => {
                if (data.success) {
                    // Remove the image element from DOM
                    const imageItem = document.getElementById('existing-image-' + imageId);
                    if (imageItem) {
                        imageItem.style.transform = 'scale(0)';
                        imageItem.style.opacity = '0';
                        setTimeout(() => {
                            imageItem.remove();
                            showAlert('Gambar berhasil dihapus', 'success');
                            
                            // Update counter
                            updateImageCounter();
                        }, 300);
                    }
                } else {
                    throw new Error(data.message || 'Gagal menghapus gambar');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('Gagal menghapus gambar: ' + error.message, 'danger');
                
                // Restore image item state
                const imageItem = document.getElementById('existing-image-' + imageId);
                if (imageItem) {
                    imageItem.style.opacity = '1';
                    imageItem.style.pointerEvents = 'auto';
                    
                    // Restore delete button
                    const overlay = imageItem.querySelector('.existing-image-overlay');
                    if (overlay) {
                        overlay.innerHTML = `
                            <button type="button" class="btn btn-danger btn-sm" onclick="confirmDeleteImage(${imageId})">
                                <i class="fa fa-trash"></i>
                            </button>
                        `;
                    }
                }
            });
        }
        
        // Update image counter after deletion
        function updateImageCounter() {
            const remainingImages = document.querySelectorAll('.existing-image-item').length;
            const headerElement = document.querySelector('h5');
            if (headerElement && headerElement.textContent.includes('Gambar Saat Ini')) {
                headerElement.textContent = `🖼️ Gambar Saat Ini (${remainingImages})`;
            }
        }
        
        // Open Google Maps for coordinates
        function openMapHelper() {
            const mapUrl = 'https://www.google.com/maps';
            window.open(mapUrl, '_blank');
        }
        
        // View current location on map
        function viewCurrentLocation() {
            const lat = document.getElementById('validationTooltipLatitude').value;
            const lng = document.getElementById('validationTooltipLongitude').value;
            
            if (lat && lng) {
                const mapUrl = `https://www.google.com/maps?q=${lat},${lng}`;
                window.open(mapUrl, '_blank');
            } else {
                showAlert('Koordinat latitude dan longitude harus diisi terlebih dahulu', 'warning');
            }
        }
        
        // Coordinate validation
        document.getElementById('validationTooltipLatitude').addEventListener('input', function(e) {
            const lat = parseFloat(e.target.value);
            if (lat && (lat < -90 || lat > 90)) {
                e.target.setCustomValidity('Latitude harus antara -90 dan 90');
            } else {
                e.target.setCustomValidity('');
            }
        });
        
        document.getElementById('validationTooltipLongitude').addEventListener('input', function(e) {
            const lng = parseFloat(e.target.value);
            if (lng && (lng < -180 || lng > 180)) {
                e.target.setCustomValidity('Longitude harus antara -180 dan 180');
            } else {
                e.target.setCustomValidity('');
            }
        });
        
        // Auto-refresh alerts
        @if(session('success') || session('error'))
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    if (alert.classList.contains('alert-dismissible')) {
                        alert.style.opacity = '0';
                        setTimeout(() => alert.remove(), 300);
                    }
                });
            }, 5000);
        @endif
    </script>
    
    <style>
        .custom-input label {
            font-weight: 500;
            margin-bottom: 5px;
        }
        
        .custom-input .form-control,
        .custom-input .form-select {
            border-radius: 6px;
            padding: 0.6rem 0.75rem;
            border-color: #e2e5e8;
            background-color: #f9fbfd;
        }
        
        .custom-input .form-control:focus,
        .custom-input .form-select:focus {
            border-color: oklch(50.8% 0.118 165.612);
            box-shadow: 0 0 0 0.2rem rgba(115, 102, 255, 0.15);
            background-color: #fff;
        }
        
        .custom-input .valid-tooltip,
        .custom-input .invalid-tooltip {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
        }
        
        .custom-input .valid-tooltip {
            background-color: rgba(40, 199, 111, 0.9);
        }
        
        .custom-input .invalid-tooltip {
            background-color: rgba(234, 84, 85, 0.9);
        }

        .text-muted {
            font-size: 0.75rem;
        }
        
        /* Existing Images Grid */
        .existing-images-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        
        .existing-image-item {
            position: relative;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            overflow: hidden;
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        
        .existing-image-item:hover {
            transform: translateY(-2px);
        }
        
        .existing-image-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        
        .existing-image-item:hover img {
            transform: scale(1.05);
        }
        
        .existing-image-overlay {
            position: absolute;
            top: 8px;
            right: 8px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .existing-image-item:hover .existing-image-overlay {
            opacity: 1;
        }
        
        .existing-image-info {
            position: absolute;
            bottom: 8px;
            left: 8px;
        }
        
        .image-counter {
            background: rgba(0,0,0,0.7);
            color: white;
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.7rem;
        }
        
        /* Upload Drop Zone */
        .upload-drop-zone {
            border: 2px dashed #dee2e6;
            border-radius: 8px;
            padding: 40px 20px;
            text-align: center;
            background-color: #f8f9fa;
            transition: all 0.3s ease;
            cursor: pointer;
        }
        
        .upload-drop-zone:hover,
        .upload-drop-zone.dragover {
            border-color: #007bff;
            background-color: rgba(0, 123, 255, 0.05);
        }
        
        .upload-drop-zone-content {
            max-width: 400px;
            margin: 0 auto;
        }
        
        .upload-icon {
            width: 48px;
            height: 48px;
            margin: 0 auto 15px;
            color: #6c757d;
        }
        
        .upload-icon svg {
            width: 100%;
            height: 100%;
        }
        
        /* New Image Preview Grid */
        .image-preview-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
        }
        
        .image-preview-card {
            position: relative;
        }
        
        .image-preview-item {
            border: 1px solid #dee2e6;
            border-radius: 8px;
            overflow: hidden;
            background: white;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.2s ease;
        }
        
        .image-preview-item:hover {
            transform: translateY(-2px);
        }
        
        .image-preview-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        
        .image-preview-overlay {
            position: absolute;
            top: 8px;
            right: 8px;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        
        .image-preview-item:hover .image-preview-overlay {
            opacity: 1;
        }
        
        .image-preview-info {
            padding: 10px;
        }
        
        .image-name {
            font-size: 0.8rem;
            font-weight: 500;
            color: #495057;
            margin-bottom: 4px;
            word-break: break-word;
        }
        
        .image-size {
            font-size: 0.7rem;
            color: #6c757d;
        }
        
        /* Loading animations */
        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .existing-images-grid,
            .image-preview-grid {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
                gap: 15px;
            }
            
            .upload-drop-zone {
                padding: 30px 15px;
            }
        }
    </style>
    @endpush
</x-layouts.app>