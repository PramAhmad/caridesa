<x-layouts.app>
    @push('css')
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
        
        .image-preview {
            width: 200px;
            height: 200px;
            border: 2px dashed #ddd;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .image-preview:hover {
            border-color: oklch(50.8% 0.118 165.612);
            background: rgba(115, 102, 255, 0.05);
        }
        
        .image-preview img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
            border-radius: 6px;
        }
        
        .links-section {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 1.5rem;
        }
    </style>
    @endpush
    
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Edit Produk</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('products.index') }}">
                                Produk
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
        <form class="row needs-validation custom-input" 
              action="{{ route('products.update', $product) }}" 
              method="POST" 
              enctype="multipart/form-data"
              novalidate>
            @csrf
            @method('PUT')
            
            <!-- Basic Information -->
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit: {{ $product->name }}</h4>
                        <p class="f-m-light mt-1">
                            Perbarui informasi produk sesuai kebutuhan.
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label" for="name">Nama Produk <span class="text-danger">*</span></label>
                                <input class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       type="text" 
                                       name="name"
                                       value="{{ old('name', $product->name) }}"
                                       placeholder="Contoh: Keripik Pisang Original" 
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Slug saat ini: <code>{{ $product->slug }}</code></small>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label" for="category_product_id">Kategori <span class="text-danger">*</span></label>
                                <select class="form-select @error('category_product_id') is-invalid @enderror" 
                                        id="category_product_id" 
                                        name="category_product_id" 
                                        required>
                                    <option value="">Pilih Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" 
                                                {{ old('category_product_id', $product->category_product_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_product_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label" for="description">Deskripsi Produk</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" 
                                          id="description" 
                                          name="description"
                                          rows="4"
                                          placeholder="Jelaskan produk Anda secara detail...">{{ old('description', $product->description) }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Pricing & Stock -->
                <div class="card">
                    <div class="card-header">
                        <h4>Harga & Stok</h4>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label" for="price">Harga <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">Rp</span>
                                    <input class="form-control @error('price') is-invalid @enderror" 
                                           id="price" 
                                           type="number"
                                           step="0.01" 
                                           name="price"
                                           value="{{ old('price', $product->price) }}"
                                           placeholder="25000" 
                                           required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <label class="form-label" for="discount">Diskon (%)</label>
                                <input class="form-control @error('discount') is-invalid @enderror" 
                                       id="discount" 
                                       type="number"
                                       step="0.01"
                                       min="0"
                                       max="100" 
                                       name="discount"
                                       value="{{ old('discount', $product->discount) }}"
                                       placeholder="0">
                                @error('discount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-4">
                                <label class="form-label" for="stock">Status Stok <span class="text-danger">*</span></label>
                                <select class="form-select @error('stock') is-invalid @enderror" 
                                        id="stock" 
                                        name="stock" 
                                        required>
                                    @foreach(App\Enum\ProductStockStatus::cases() as $status)
                                        <option value="{{ $status->value }}" 
                                                {{ old('stock', $product->stock->value) == $status->value ? 'selected' : '' }}>
                                            {{ $status->label() }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('stock')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Marketplace Links -->
                <div class="card">
                    <div class="card-header">
                        <h4>Link Marketplace</h4>
                        <p class="f-m-light mt-1">
                            Tambahkan link marketplace untuk memudahkan pembeli
                        </p>
                    </div>
                    <div class="card-body">
                        <div class="links-section">
                            <div class="row g-3">
                                @php 
                                    $existingLinks = $product->getLinksArray() ?? [];
                                @endphp
                                
                                <div class="col-md-6">
                                    <label class="form-label" for="tokopedia">
                                        <i class="fa fa-shopping-bag text-success"></i> Tokopedia
                                    </label>
                                    <input class="form-control @error('links.tokopedia') is-invalid @enderror" 
                                           id="tokopedia" 
                                           type="url" 
                                           name="links[tokopedia]"
                                           value="{{ old('links.tokopedia', $existingLinks['tokopedia'] ?? '') }}"
                                           placeholder="https://tokopedia.com/...">
                                    @error('links.tokopedia')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label" for="shopee">
                                        <i class="fa fa-shopping-cart text-warning"></i> Shopee
                                    </label>
                                    <input class="form-control @error('links.shopee') is-invalid @enderror" 
                                           id="shopee" 
                                           type="url" 
                                           name="links[shopee]"
                                           value="{{ old('links.shopee', $existingLinks['shopee'] ?? '') }}"
                                           placeholder="https://shopee.co.id/...">
                                    @error('links.shopee')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label" for="lazada">
                                        <i class="fa fa-store text-primary"></i> Lazada
                                    </label>
                                    <input class="form-control @error('links.lazada') is-invalid @enderror" 
                                           id="lazada" 
                                           type="url" 
                                           name="links[lazada]"
                                           value="{{ old('links.lazada', $existingLinks['lazada'] ?? '') }}"
                                           placeholder="https://lazada.co.id/...">
                                    @error('links.lazada')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label" for="whatsapp">
                                        <i class="fab fa-whatsapp text-success"></i> WhatsApp
                                    </label>
                                    <input class="form-control @error('links.whatsapp') is-invalid @enderror" 
                                           id="whatsapp" 
                                           type="text" 
                                           name="links[whatsapp]"
                                           value="{{ old('links.whatsapp', $existingLinks['whatsapp'] ?? '') }}"
                                           placeholder="08123456789">
                                    @error('links.whatsapp')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Image & Settings -->
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Gambar Produk</h4>
                    </div>
                    <div class="card-body text-center">
                        <div class="image-preview" onclick="document.getElementById('image').click()">
                            <div id="imagePreview">
                                @if($product->image)
                                    <img src="{{ $product->image_url }}" alt="Current Image">
                                @else
                                    <i class="fa fa-camera" style="font-size: 2rem; color: #6c757d;"></i>
                                    <p class="mt-2 mb-0">Klik untuk upload gambar</p>
                                    <small class="text-muted">Max: 2MB</small>
                                @endif
                            </div>
                        </div>
                        <input class="form-control @error('image') is-invalid @enderror d-none" 
                               id="image" 
                               type="file" 
                               name="image"
                               accept="image/*"
                               onchange="previewImage(this)">
                        @error('image')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        @if($product->image)
                            <small class="text-muted d-block mt-2">Gambar saat ini akan diganti jika Anda upload gambar baru</small>
                        @endif
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-header">
                        <h4>Pengaturan</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-check form-switch">
                            <input class="form-check-input" 
                                   type="checkbox" 
                                   id="is_active" 
                                   name="is_active" 
                                   value="1" 
                                   {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                <strong>Status Aktif</strong>
                            </label>
                        </div>
                        <small class="text-muted">Produk aktif akan ditampilkan di katalog</small>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="submit">
                                <i class="fa fa-save me-2"></i> Perbarui Produk
                            </button>
                            <a href="{{ route('products.index') }}" class="btn btn-light">
                                <i class="fa fa-arrow-left me-2"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- Container-fluid Ends-->
    
    @push('script')
    <script>
        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    preview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
                }
                
                reader.readAsDataURL(input.files[0]);
            }
        }
        
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
    </script>
    @endpush
</x-layouts.app>