<x-layouts.app>
    @push('css')
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('tenant/css/vendors/summernote/summernote.css') }}">
    @endpush
    
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Edit Konten Theme</h4>
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
                        <li class="breadcrumb-item active">Edit Konten</li>
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
                        <h4>Edit Konten - {{ $theme->name }}</h4>
                        <span>Kelola konten untuk setiap section pada theme {{ $theme->name }}.</span>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Tutup"></button>
                            </div>
                        @endif

                        <form action="/admin/themes/{{ $theme->id }}/update-content" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            @php
                                $sections = [
                                    'hero' => ['name' => 'Hero Section', 'icon' => 'fa-home'],
                                    'about' => ['name' => 'Tentang Kami', 'icon' => 'fa-info-circle'],
                                    'services' => ['name' => 'Layanan', 'icon' => 'fa-cogs'],
                                    'contact' => ['name' => 'Kontak', 'icon' => 'fa-phone']
                                ];
                            @endphp

                            <div class="accordion" id="contentAccordion">
                                @foreach($sections as $sectionKey => $sectionInfo)
                                    @php
                                        $content = $contents->where('section', $sectionKey)->first();
                                    @endphp
                                    
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="heading{{ ucfirst($sectionKey) }}">
                                            <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" 
                                                    type="button" 
                                                    data-bs-toggle="collapse" 
                                                    data-bs-target="#collapse{{ ucfirst($sectionKey) }}" 
                                                    aria-expanded="{{ $loop->first ? 'true' : 'false' }}" 
                                                    aria-controls="collapse{{ ucfirst($sectionKey) }}">
                                                <i class="fa {{ $sectionInfo['icon'] }} me-2"></i>
                                                {{ $sectionInfo['name'] }}
                                                @if($content && $content->is_active)
                                                    <span class="badge badge-success ms-2">Aktif</span>
                                                @else
                                                    <span class="badge badge-secondary ms-2">Tidak Aktif</span>
                                                @endif
                                            </button>
                                        </h2>
                                        <div id="collapse{{ ucfirst($sectionKey) }}" 
                                             class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" 
                                             aria-labelledby="heading{{ ucfirst($sectionKey) }}" 
                                             data-bs-parent="#contentAccordion">
                                            <div class="accordion-body">
                                                <input type="hidden" 
                                                       name="contents[{{ $content->id ?? 'new_'.$sectionKey }}][section]" 
                                                       value="{{ $sectionKey }}">
                                                
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="mb-3">
                                                            <label class="form-label">Judul Section</label>
                                                            <input type="text" 
                                                                   class="form-control" 
                                                                   name="contents[{{ $content->id ?? 'new_'.$sectionKey }}][title]" 
                                                                   value="{{ $content->title ?? '' }}"
                                                                   placeholder="Masukkan judul untuk {{ $sectionInfo['name'] }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="mb-3">
                                                            <label class="form-label">Status</label>
                                                            <select class="form-select" 
                                                                    name="contents[{{ $content->id ?? 'new_'.$sectionKey }}][is_active]">
                                                                <option value="1" {{ ($content->is_active ?? true) ? 'selected' : '' }}>
                                                                    Aktif
                                                                </option>
                                                                <option value="0" {{ !($content->is_active ?? true) ? 'selected' : '' }}>
                                                                    Tidak Aktif
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="mb-3">
                                                    <label class="form-label">Konten</label>
                                                    <textarea class="form-control summernote" 
                                                              name="contents[{{ $content->id ?? 'new_'.$sectionKey }}][content]" 
                                                              rows="5"
                                                              placeholder="Masukkan konten untuk {{ $sectionInfo['name'] }}">{{ $content->content ?? '' }}</textarea>
                                                </div>
                                                
                                                @if($sectionKey === 'hero')
                                                <div class="alert alert-info">
                                                    <i class="fa fa-info-circle me-2"></i>
                                                    <strong>Tips:</strong> Hero section adalah bagian pertama yang dilihat pengunjung. Buat konten yang menarik dan menjelaskan value proposition Anda.
                                                </div>
                                                @endif

                                                <div class="mb-3">
                                                    <label class="form-label">Gambar Hero (Opsional)</label>
                                                    <input type="file" class="form-control" 
                                                           name="contents[{{ $content->id ?? 'new_'.$sectionKey }}][image]" 
                                                           accept="image/*">
                                                    @if($content && $content->image)
                                                        <div class="mt-2">
                                                            <img src="{{ tenant_asset('image/themes/' . $content->image) }}" alt="Current image" class="img-thumbnail" style="max-height: 100px;">
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="text-end mt-4">
                                <a href="/admin/themes" class="btn btn-secondary me-2">
                                    <i class="fa fa-arrow-left me-1"></i> Kembali
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-save me-1"></i> Simpan Perubahan
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
    <script src="{{ asset('tenant/js/editor/summernote/summernote.js') }}"></script>
    <script src="{{ asset('tenant/js/editor/summernote/summernote.custom.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 200,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'underline', 'clear']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });
        });
    </script>
    @endpush
</x-layouts.app>