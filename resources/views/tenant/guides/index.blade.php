<x-layouts.app>
    @push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('tenant/css/vendors/datatables.css') }}">
    @endpush
    
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Kelola Pemandu</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Pemandu</li>
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
                        <h4>Daftar Pemandu Wisata</h4>
                        <span>Kelola semua pemandu wisata desa Anda dengan mudah dan efisien.</span>
                        <div class="header-right text-end mt-2">
                            <a href="/admin/guides/create" class="btn btn-primary">
                                <i class="fa fa-plus-circle me-2"></i> Tambah Pemandu Baru
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

                        <!-- Filter Controls -->
                        <div class="row mb-4">
                            <div class="col-md-3">
                                <select class="form-select" id="statusFilter">
                                    <option value="">Semua Status</option>
                                    <option value="active">Aktif</option>
                                    <option value="inactive">Nonaktif</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <input type="number" class="form-control" id="minPriceFilter" placeholder="Harga Minimum" min="0">
                            </div>
                            <div class="col-md-3">
                                <input type="number" class="form-control" id="maxPriceFilter" placeholder="Harga Maksimum" min="0">
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="searchFilter" placeholder="Cari nama, alamat, atau telepon...">
                                    <button class="btn btn-outline-secondary" type="button" onclick="clearSearchFilter()">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="table-responsive custom-scrollbar">
                            <table class="display" id="guideTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Pemandu</th>
                                        <th>Kontak</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                        <th>Foto</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($guides as $guide)
                                    <tr>
                                        <td>#{{ $guide->id }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="guide-icon me-2">
                                                    🧑‍🏫
                                                </div>
                                                <div>
                                                    <strong>{{ $guide->name }}</strong>
                                                    <br><small class="text-info">{{ Str::limit($guide->description, 60) }}</small>
                                                    <br><small class="text-muted">📍 {{ Str::limit($guide->address, 40) }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="contact-info">
                                                @if($guide->phone)
                                                    <div class="phone">📞 {{ $guide->phone }}</div>
                                                @endif
                                                @if($guide->email)
                                                    <div class="email mt-1">✉️ {{ $guide->email }}</div>
                                                @endif
                                                @if(!$guide->phone && !$guide->email)
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="price-info">
                                                <div class="current-price">
                                                    @if($guide->hasDiscount())
                                                        <span class="text-decoration-line-through text-muted small">{{ $guide->formatted_price }}</span>
                                                        <div class="discounted-price text-success fw-bold">{{ $guide->formatted_discounted_price }}</div>
                                                        <div class="discount-badge mt-1">
                                                            <span class="badge badge-danger">-{{ $guide->discount_percent }}%</span>
                                                        </div>
                                                    @else
                                                        <div class="normal-price fw-bold">{{ $guide->formatted_price }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="status-badges">
                                                <!-- Active Status -->
                                                @if($guide->is_active)
                                                    <span class="badge rounded-pill badge-success">Aktif</span>
                                                @else
                                                    <span class="badge rounded-pill badge-secondary">Nonaktif</span>
                                                @endif
                                                
                                                <!-- Discount Status -->
                                                @if($guide->hasDiscount())
                                                <div class="mt-1">
                                                    <span class="badge rounded-pill badge-warning">Diskon</span>
                                                </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="image-preview">
                                                @if($guide->main_image)
                                                    <img src="{{ $guide->main_image_url }}" alt="{{ $guide->name }}" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                                @else
                                                    <div class="no-image">
                                                        <i class="fa fa-image text-muted"></i>
                                                    </div>
                                                @endif
                                                <small class="text-muted d-block">
                                                    {{ $guide->images_count }} foto
                                                </small>
                                            </div>
                                        </td>
                                        <td>
                                            <ul class="action">
                                                <li class="view">
                                                    <a href="/admin/guides/{{ $guide->id }}" title="Lihat Detail">
                                                        <i class="icon-eye"></i>
                                                    </a>
                                                </li>
                                                <li class="edit">
                                                    <a href="/admin/guides/{{ $guide->id }}/edit" title="Edit">
                                                        <i class="icon-pencil-alt"></i>
                                                    </a>
                                                </li>
                                                <li class="toggle">
                                                    <a href="#" onclick="confirmToggle({{ $guide->id }})" title="{{ $guide->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                                        <i class="icon-toggle"></i>
                                                    </a>
                                                    <form id="toggle-form-{{ $guide->id }}" 
                                                          action="/admin/guides/{{ $guide->id }}/toggle-status" 
                                                          method="POST" style="display: none;">
                                                        @csrf
                                                        @method('PATCH')
                                                    </form>
                                                </li>
                                                <li class="delete">
                                                    <a href="#" onclick="confirmDelete({{ $guide->id }})" title="Hapus">
                                                        <i class="icon-trash"></i>
                                                    </a>
                                                    <form id="delete-form-{{ $guide->id }}" 
                                                          action="/admin/guides/{{ $guide->id }}" 
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
            $('#guideTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json",
                    "emptyTable": "Tidak ada pemandu yang ditemukan",
                    "zeroRecords": "Tidak ada pemandu yang cocok dengan pencarian"
                },
                "order": [[ 1, "asc" ]], // Order by name
                "columnDefs": [
                    { "orderable": false, "targets": [5, 6] }, // Disable ordering for images and actions
                    { "width": "50px", "targets": 0 }, // ID column width
                    { "width": "120px", "targets": 6 }, // Action column width
                ],
                "responsive": true,
                "autoWidth": false
            });
        });
        
        function confirmDelete(guideId) {
            if (confirm('Apakah Anda yakin ingin menghapus pemandu ini? Semua foto terkait juga akan dihapus.')) {
                document.getElementById('delete-form-' + guideId).submit();
            }
        }
        
        function confirmToggle(guideId) {
            if (confirm('Apakah Anda yakin ingin mengubah status pemandu ini?')) {
                document.getElementById('toggle-form-' + guideId).submit();
            }
        }
        
        function clearSearchFilter() {
            document.getElementById('searchFilter').value = '';
            // Trigger filter update
        }
    </script>
    
    <style>
        .guide-icon {
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
        
        .contact-info .phone,
        .contact-info .email {
            font-size: 0.85rem;
        }
        
        .price-info {
            min-width: 120px;
        }
        
        .status-badges {
            min-width: 80px;
        }
        
        .image-preview {
            text-align: center;
        }
        
        .discount-badge .badge {
            font-size: 0.7rem;
        }
    </style>
    @endpush
</x-layouts.app>