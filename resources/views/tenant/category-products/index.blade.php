<x-layouts.app>
    @push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('tenant/css/vendors/datatables.css') }}">
    @endpush
    
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Kelola Kategori Produk</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Kategori Produk</li>
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
                        <h4>Daftar Kategori Produk</h4>
                        <span>Kelola semua kategori produk untuk mengorganisir produk UMKM Anda.</span>
                        <div class="header-right text-end mt-2">
                            <a href="{{ route('category-products.create') }}" class="btn btn-primary">
                                <i class="fa fa-plus-circle me-2"></i> Tambah Kategori Baru
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
                            <table class="display" id="categoryTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama Kategori</th>
                                        <th>Slug</th>
                                        <th>Jumlah Produk</th>
                                        <th>Status</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $category)
                                    <tr>
                                        <td>#{{ $category->id }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="category-icon me-2">
                                                    📦
                                                </div>
                                                <div>
                                                    <strong>{{ $category->name }}</strong>
                                                    @if($category->description)
                                                        <br><small class="text-muted">{{ Str::limit($category->description, 50) }}</small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <code class="text-primary">{{ $category->slug }}</code>
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill badge-info">
                                                {{ $category->products_count }} produk
                                            </span>
                                        </td>
                                        <td>
                                            @if($category->is_active)
                                                <span class="badge rounded-pill badge-success">Aktif</span>
                                            @else
                                                <span class="badge rounded-pill badge-secondary">Tidak Aktif</span>
                                            @endif
                                        </td>
                                        <td>{{ $category->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <ul class="action">
                                                <li class="view">
                                                    <a href="{{ route('category-products.show', $category->id) }}" title="Lihat Detail">
                                                        <i class="icon-eye"></i>
                                                    </a>
                                                </li>
                                                <li class="edit">
                                                    <a href="{{ route('category-products.edit', $category->id) }}" title="Edit">
                                                        <i class="icon-pencil-alt"></i>
                                                    </a>
                                                </li>
                                                <li class="delete">
                                                    <a href="#" onclick="confirmDelete({{ $category->id }})" title="Hapus">
                                                        <i class="icon-trash"></i>
                                                    </a>
                                                    <form id="delete-form-{{ $category->id }}" 
                                                          action="{{ route('category-products.destroy', $category->id) }}" 
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
            $('#categoryTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                },
                "order": [[ 0, "desc" ]]
            });
        });
        
        function confirmDelete(categoryId) {
            if (confirm('Apakah Anda yakin ingin menghapus kategori ini? Pastikan tidak ada produk yang menggunakan kategori ini.')) {
                document.getElementById('delete-form-' + categoryId).submit();
            }
        }
    </script>
    
    <style>
        .category-icon {
            font-size: 1.2rem;
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
            padding: 5px;
            border-radius: 3px;
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
    </style>
    @endpush
</x-layouts.app>