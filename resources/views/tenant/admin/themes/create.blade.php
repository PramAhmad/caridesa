<x-layouts.app>
    @push('css')
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('tenant/css/vendors/dropzone/dropzone.min.css') }}">
    @endpush
    
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Buat Theme Baru</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/admin/themes">Theme</a>
                        </li>
                        <li class="breadcrumb-item active">Buat Baru</li>
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
                        <h4>Informasi Theme</h4>
                        <span>Masukkan detail informasi untuk theme baru Anda.</span>
                    </div>
                    <div class="card-body">
                        <form action="/admin/themes" method="POST" enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Theme <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                               name="name" value="{{ old('name') }}" 
                                               placeholder="Contoh: Modern Business Theme" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label class="form-label">Deskripsi</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                                  name="description" rows="4" 
                                                  placeholder="Jelaskan tentang theme ini...">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label class="form-label">Preview Image</label>
                                        <div class="preview-upload">
                                            <input type="file" class="form-control @error('preview_image') is-invalid @enderror" 
                                                   name="preview_image" accept="image/*" id="preview_image">
                                            @error('preview_image')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <div class="preview-container mt-3" id="preview_container" style="display: none;">
                                                <img id="image_preview" src="" alt="Preview" class="img-fluid rounded" style="max-height: 200px;">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Theme Configuration -->
                            <div class="row">
                                <div class="col-12">
                                    <h5 class="mb-3">Konfigurasi Theme</h5>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Primary Color</label>
                                                <input type="color" class="form-control form-control-color" 
                                                       name="config[primary_color]" value="{{ old('config.primary_color', '#3b82f6') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Secondary Color</label>
                                                <input type="color" class="form-control form-control-color" 
                                                       name="config[secondary_color]" value="{{ old('config.secondary_color', '#64748b') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label class="form-label">Font Family</label>
                                                <select class="form-select" name="config[font_family]">
                                                    <option value="font-sans" {{ old('config.font_family') == 'font-sans' ? 'selected' : '' }}>Sans Serif</option>
                                                    <option value="font-serif" {{ old('config.font_family') == 'font-serif' ? 'selected' : '' }}>Serif</option>
                                                    <option value="font-mono" {{ old('config.font_family') == 'font-mono' ? 'selected' : '' }}>Monospace</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="text-end">
                                <a href="/admin/themes" class="btn btn-secondary me-2">
                                    <i class="fa fa-times me-1"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save me-1"></i> Simpan Theme
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
    
    @push('script')
    <script>
        // Image preview
        document.getElementById('preview_image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('image_preview').src = e.target.result;
                    document.getElementById('preview_container').style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                document.getElementById('preview_container').style.display = 'none';
            }
        });
    </script>
    @endpush
</x-layouts.app>