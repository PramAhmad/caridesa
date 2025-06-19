<x-layouts.app>
    @push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('tenant/css/vendors/datatables.css') }}">
    @endpush
    
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Kelola Wisata</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Wisata</li>
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
                        <h4>Daftar Destinasi Wisata</h4>
                        <span>Kelola semua destinasi wisata desa Anda dengan mudah dan efisien.</span>
                        <div class="header-right text-end mt-2">
                            <a href="/admin/wisatas/create" class="btn btn-primary">
                                <i class="fa fa-plus-circle me-2"></i> Tambah Wisata Baru
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
                        
                        <div class="table-responsive custom-scrollbar">
                            <table class="display" id="wisataTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Wisata</th>
                                        <th>Kategori</th>
                                        <th>Lokasi</th>
                                        <th>Gambar</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($wisatas as $wisata)
                                    <tr>
                                        <td>#{{ $wisata->id }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="wisata-icon me-2">
                                                    🏞️
                                                </div>
                                                <div>
                                                    <strong>{{ $wisata->name }}</strong>
                                                    <br><small class="text-muted">{{ Str::limit($wisata->description, 50) }}</small>
                                                    <br><code class="text-primary">{{ $wisata->slug }}</code>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($wisata->category)
                                                <span class="badge rounded-pill badge-info">
                                                    {{ $wisata->category->name }}
                                                </span>
                                            @else
                                                <span class="badge rounded-pill badge-secondary">Tidak Ada</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="location-info">
                                                <small class="text-muted">
                                                    📍 {{ $wisata->coordinates }}
                                                </small>
                                                <br>
                                                <a href="{{ $wisata->google_maps_url }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                    <i class="fa fa-map-marker-alt me-1"></i> Lihat di Maps
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="image-preview">
                                                @if($wisata->image_one)
                                                    <img src="{{ asset($wisata->image_one->name) }}" alt="{{ $wisata->name }}" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                                @else
                                                    <div class="no-image">
                                                        <i class="fa fa-image text-muted"></i>
                                                    </div>
                                                @endif
                                                <small class="text-muted d-block">
                                                    {{ $wisata->images->count() }} gambar
                                                </small>
                                            </div>
                                        </td>
                                        <td>{{ $wisata->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <ul class="action">
                                                <li class="view">
                                                    <a href="/admin/wisatas/{{ $wisata->slug }}" title="Lihat Detail">
                                                        <i class="icon-eye"></i>
                                                    </a>
                                                </li>
                                                <li class="edit">
                                                    <a href="/admin/wisatas/{{ $wisata->slug }}/edit" title="Edit">
                                                        <i class="icon-pencil-alt"></i>
                                                    </a>
                                                </li>
                                                <li class="delete">
                                                    <a href="#" onclick="confirmDelete({{ $wisata->id }})" title="Hapus">
                                                        <i class="icon-trash"></i>
                                                    </a>
                                                    <form id="delete-form-{{ $wisata->id }}" 
                                                          action="/wisatas/{{ $wisata->slug }}" 
                                                          method="POST" style="display: none;">
                                                        @csrf
                                                        @method('DELETE')
                                                    </form>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
    
    @push('script')
    <script src="{{ asset('tenant/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('tenant/js/datatable/datatables/datatable.custom.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#wisataTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json",
                    "emptyTable": "Tidak ada wisata yang ditemukan",
                    "zeroRecords": "Tidak ada wisata yang cocok dengan pencarian"
                },
                "order": [[ 0, "desc" ]],
                "columnDefs": [
                    { "orderable": false, "targets": [4, 6] }, // Disable ordering for images and actions
                    { "width": "50px", "targets": 0 }, // ID column width
                    { "width": "100px", "targets": 6 }, // Action column width
                ],
                "responsive": true,
                "autoWidth": false
            });
        });
        
        function confirmDelete(wisataId) {
            if (confirm('Apakah Anda yakin ingin menghapus wisata ini? Semua gambar terkait juga akan dihapus.')) {
                document.getElementById('delete-form-' + wisataId).submit();
            }
        }
    </script>
    
    <style>
        .wisata-icon {
            font-size: 1.5rem;
        }
        
        .action {
            padding: 0;
            margin: 0;
            list-style: none;
            display: flex;
            gap: 10px;
        }
        
        .action li a {
            color: #7e7e7e;
            transition: all 0.3s ease;
            padding: 8px;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
        }
        
        .action li.view a:hover {
            color: #28a745;
            background-color: rgba(40, 167, 69, 0.1);
        }
        
        .action li.edit a:hover {
            color: #007bff;
            background-color: rgba(0, 123, 255, 0.1);
        }
        
        .action li.delete a:hover {
            color: #dc3545;
            background-color: rgba(220, 53, 69, 0.1);
        }
        
        .icon-eye:before { content: '👁️'; }
        .icon-pencil-alt:before { content: '✏️'; }
        .icon-trash:before { content: '🗑️'; }
        
        .table th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            font-weight: 600;
            color: #495057;
        }
        
        .table td {
            vertical-align: middle;
        }
        
        .no-image {
            width: 60px;
            height: 60px;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
            font-size: 1.5rem;
        }
        
        .location-info {
            min-width: 150px;
        }
        
        .image-preview {
            text-align: center;
        }
    </style>
    @endpush
</x-layouts.app>