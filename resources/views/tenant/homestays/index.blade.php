<x-layouts.app>
    @push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('tenant/css/vendors/datatables.css') }}">
    @endpush
    
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Kelola Homestay</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Homestay</li>
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
                        <h4>Daftar Homestay</h4>
                        <span>Kelola semua homestay desa Anda dengan mudah dan efisien.</span>
                        <div class="header-right text-end mt-2">
                            <a href="/admin/homestays/create" class="btn btn-primary">
                                <i class="fa fa-plus-circle me-2"></i> Tambah Homestay Baru
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
                            <table class="display" id="homestayTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Homestay</th>
                                        <th>Kontak</th>
                                        <th>Harga</th>
                                        <th>Gambar</th>
                                        <th>Status</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($homestays as $homestay)
                                    <tr>
                                        <td>#{{ $homestay->id }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="homestay-icon me-2">
                                                    🏠
                                                </div>
                                                <div>
                                                    <strong>{{ $homestay->name }}</strong>
                                                    <br><small class="text-muted">{{ Str::limit($homestay->address, 40) }}</small>
                                                    <br><small class="text-info">{{ Str::limit($homestay->description, 50) }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="contact-info">
                                                <small class="text-muted">
                                                    📞 {{ $homestay->phone }}
                                                </small>
                                                @if($homestay->email)
                                                    <br><small class="text-muted">✉️ {{ $homestay->email }}</small>
                                                @endif
                                                @if($homestay->whatsapp_url)
                                                    <br><a href="{{ $homestay->whatsapp_url }}" target="_blank" class="btn btn-sm btn-success">
                                                        <i class="fa fa-whatsapp me-1"></i> WhatsApp
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="price-info">
                                                @if($homestay->has_discount)
                                                    <div class="original-price text-decoration-line-through text-muted">
                                                        {{ $homestay->formatted_price }}
                                                    </div>
                                                    <div class="discounted-price text-success fw-bold">
                                                        {{ $homestay->formatted_discounted_price }}
                                                    </div>
                                                    <span class="badge rounded-pill badge-warning">
                                                        {{ $homestay->discount_percent }}% OFF
                                                    </span>
                                                @else
                                                    <div class="price fw-bold">
                                                        {{ $homestay->formatted_price }}
                                                    </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="image-preview">
                                                @if($homestay->main_image)
                                                    <img src="{{ asset($homestay->main_image->name) }}" alt="{{ $homestay->name }}" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                                @else
                                                    <div class="no-image">
                                                        <i class="fa fa-image text-muted"></i>
                                                    </div>
                                                @endif
                                                <small class="text-muted d-block">
                                                    {{ $homestay->images->count() }} gambar
                                                </small>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="status-toggle">
                                                @if($homestay->is_active)
                                                    <span class="badge rounded-pill badge-success">Aktif</span>
                                                @else
                                                    <span class="badge rounded-pill badge-secondary">Tidak Aktif</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ $homestay->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <ul class="action">
                                                <li class="view">
                                                    <a href="/admin/homestays/{{ $homestay->id }}" title="Lihat Detail">
                                                        <i class="icon-eye"></i>
                                                    </a>
                                                </li>
                                                <li class="edit">
                                                    <a href="/admin/homestays/{{ $homestay->id }}/edit" title="Edit">
                                                        <i class="icon-pencil-alt"></i>
                                                    </a>
                                                </li>
                                                <li class="toggle">
                                                    <a href="#" onclick="confirmToggle({{ $homestay->id }})" title="{{ $homestay->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                                        <i class="icon-toggle"></i>
                                                    </a>
                                                    <form id="toggle-form-{{ $homestay->id }}" 
                                                          action="/admin/homestays/{{ $homestay->id }}/toggle-active" 
                                                          method="POST" style="display: none;">
                                                        @csrf
                                                        @method('PATCH')
                                                    </form>
                                                </li>
                                                <li class="delete">
                                                    <a href="#" onclick="confirmDelete({{ $homestay->id }})" title="Hapus">
                                                        <i class="icon-trash"></i>
                                                    </a>
                                                    <form id="delete-form-{{ $homestay->id }}" 
                                                          action="/admin/homestays/{{ $homestay->id }}" 
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
            $('#homestayTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json",
                    "emptyTable": "Tidak ada homestay yang ditemukan",
                    "zeroRecords": "Tidak ada homestay yang cocok dengan pencarian"
                },
                "order": [[ 0, "desc" ]],
                "columnDefs": [
                    { "orderable": false, "targets": [4, 7] }, // Disable ordering for images and actions
                    { "width": "50px", "targets": 0 }, // ID column width
                    { "width": "120px", "targets": 7 }, // Action column width
                ],
                "responsive": true,
                "autoWidth": false
            });
        });
        
        function confirmDelete(homestayId) {
            if (confirm('Apakah Anda yakin ingin menghapus homestay ini? Semua gambar terkait juga akan dihapus.')) {
                document.getElementById('delete-form-' + homestayId).submit();
            }
        }
        
        function confirmToggle(homestayId) {
            if (confirm('Apakah Anda yakin ingin mengubah status homestay ini?')) {
                document.getElementById('toggle-form-' + homestayId).submit();
            }
        }
    </script>
    
    <style>
        .homestay-icon {
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
        
        .action li.toggle a:hover {
            color: #ffc107;
            background-color: rgba(255, 193, 7, 0.1);
        }
        
        .action li.delete a:hover {
            color: #dc3545;
            background-color: rgba(220, 53, 69, 0.1);
        }
        
        .icon-eye:before { content: '👁️'; }
        .icon-pencil-alt:before { content: '✏️'; }
        .icon-toggle:before { content: '🔄'; }
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
        
        .contact-info {
            min-width: 150px;
        }
        
        .price-info {
            min-width: 120px;
        }
        
        .image-preview {
            text-align: center;
        }
        
        .original-price {
            font-size: 0.8rem;
        }
        
        .discounted-price {
            font-size: 0.9rem;
        }
    </style>
    @endpush
</x-layouts.app>