<x-layouts.app>
    @push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('tenant/css/vendors/datatables.css') }}">
    <style>
        .product-image-small {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 8px;
        }
        
        .product-image-placeholder {
            width: 50px;
            height: 50px;
            background: linear-gradient(45deg, #f8f9fa, #e9ecef);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            font-size: 1.2rem;
        }
        
        .product-name {
            font-weight: 600;
            color: #2c3e50;
            text-decoration: none;
        }
        
        .product-name:hover {
            color: #3498db;
        }
        
        .filter-card {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid #e9ecef;
            box-shadow: 0 2px 4px rgba(0,0,0,0.04);
        }
        
        .action {
            padding: 0;
            margin: 0;
            list-style: none;
            display: flex;
            gap: 8px;
        }
        
        .action li a {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        .action li.view a:hover {
            background: #e3f2fd;
            color: #1976d2;
        }
        
        .action li.edit a:hover {
            background: #fff3e0;
            color: #f57c00;
        }
        
        .action li.delete a:hover {
            background: #ffebee;
            color: #d32f2f;
        }
        
        .price-original {
            text-decoration: line-through;
            color: #6c757d;
            font-size: 0.85rem;
        }
        
        .price-discounted {
            color: #28a745;
            font-weight: 600;
        }
        
        .discount-badge {
            background: linear-gradient(45deg, #ff6b6b, #ee5a52);
            color: white;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .marketplace-links {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
        }
        
        .marketplace-icon {
            width: 20px;
            height: 20px;
            border-radius: 3px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            color: white;
            text-decoration: none;
            transition: transform 0.2s ease;
        }
        
        .marketplace-icon:hover {
            transform: scale(1.1);
        }
        
        .tokopedia { background: #42b549; }
        .shopee { background: #fb5533; }
        .lazada { background: #0f146d; }
        .blibli { background: #0081c9; }
        .whatsapp { background: #25d366; }
        .website { background: #6c757d; }
    </style>
    @endpush
    
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Kelola Produk</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Produk</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <!-- Filter Section -->
        <div class="filter-card">
            <form method="GET" action="{{ route('products.index') }}" class="row g-3">
                <div class="col-md-3">
                    <label for="search" class="form-label">Cari Produk</label>
                    <input type="text" class="form-control" id="search" name="search" 
                           value="{{ request('search') }}" placeholder="Nama produk...">
                </div>
                <div class="col-md-2">
                    <label for="category" class="form-label">Kategori</label>
                    <select class="form-select" id="category" name="category">
                        <option value="">Semua Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" 
                                    {{ request('category') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="stock" class="form-label">Status Stok</label>
                    <select class="form-select" id="stock" name="stock">
                        <option value="">Semua Status</option>
                        @foreach($stockStatuses as $status)
                            <option value="{{ $status->value }}" 
                                    {{ request('stock') == $status->value ? 'selected' : '' }}>
                                {{ $status->label() }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="status" class="form-label">Status Aktif</label>
                    <select class="form-select" id="status" name="status">
                        <option value="">Semua Status</option>
                        <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>Aktif</option>
                        <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-search me-1"></i> Filter
                    </button>
                    <a href="{{ route('products.index') }}" class="btn btn-light">
                        <i class="fa fa-refresh me-1"></i> Reset
                    </a>
                    <a href="{{ route('products.create') }}" class="btn btn-success">
                        <i class="fa fa-plus me-1"></i> Tambah
                    </a>
                </div>
            </form>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header pb-0 card-no-border">
                        <h4>Daftar Produk</h4>
                        <span>Kelola semua produk UMKM Anda dengan mudah dan efisien.</span>
                        <div class="header-right text-end mt-2">
                            <div class="d-flex align-items-center gap-3">
                                <small class="text-muted">
                                    Total: {{ $products->total() }} produk
                                </small>
                                <a href="{{ route('products.create') }}" class="btn btn-primary">
                                    <i class="fa fa-plus-circle me-2"></i> Tambah Produk Baru
                                </a>
                            </div>
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
                            <table class="display" id="productTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Gambar</th>
                                        <th>Nama Produk</th>
                                        <th>Kategori</th>
                                        <th>Harga</th>
                                        <th>Stok</th>
                                        <th>Status</th>
                                        <th>Links</th>
                                        <th>Dibuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                    <tr>
                                        <td>#{{ $product->id }}</td>
                                        <td>
                                            @if($product->image)
                                                <img src="{{  asset(''.$product->image) }}" 
                                                     alt="{{ $product->name }}" 
                                                     class="product-image-small">
                                            @else
                                                <div class="product-image-placeholder">
                                                    <i class="fa fa-image"></i>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('products.show', $product) }}" class="product-name">
                                                {{ $product->name }}
                                            </a>
                                            @if($product->description)
                                                <br>
                                                <small class="text-muted">
                                                    {{ Str::limit($product->description, 50) }}
                                                </small>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill badge-light-primary">
                                                {{ $product->category->name }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($product->hasDiscount())
                                                <div class="price-original">{{ $product->formatted_price }}</div>
                                                <div class="price-discounted">{{ $product->formatted_discounted_price }}</div>
                                                <span class="discount-badge">{{ $product->discount }}% OFF</span>
                                            @else
                                                <div class="price-discounted">{{ $product->formatted_price }}</div>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge {{ $product->stock_badge_class }}">
                                                {{ $product->stock_label }}
                                            </span>
                                        </td>
                                        <td>
                                            @if($product->is_active)
                                                <span class="badge rounded-pill badge-success">Aktif</span>
                                            @else
                                                <span class="badge rounded-pill badge-secondary">Tidak Aktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($product->links)
                                                @php $links = $product->getLinksArray(); @endphp
                                                <div class="marketplace-links">
                                                    @if(!empty($links['tokopedia']))
                                                        <a href="{{ $links['tokopedia'] }}" target="_blank" 
                                                           class="marketplace-icon tokopedia" title="Tokopedia">T</a>
                                                    @endif
                                                    @if(!empty($links['shopee']))
                                                        <a href="{{ $links['shopee'] }}" target="_blank" 
                                                           class="marketplace-icon shopee" title="Shopee">S</a>
                                                    @endif
                                                    @if(!empty($links['lazada']))
                                                        <a href="{{ $links['lazada'] }}" target="_blank" 
                                                           class="marketplace-icon lazada" title="Lazada">L</a>
                                                    @endif
                                                    @if(!empty($links['blibli']))
                                                        <a href="{{ $links['blibli'] }}" target="_blank" 
                                                           class="marketplace-icon blibli" title="Blibli">B</a>
                                                    @endif
                                                    @if(!empty($links['whatsapp']))
                                                        <a href="https://wa.me/{{ preg_replace('/\D/', '', $links['whatsapp']) }}" target="_blank" 
                                                           class="marketplace-icon whatsapp" title="WhatsApp">W</a>
                                                    @endif
                                                    @if(!empty($links['website']))
                                                        <a href="{{ $links['website'] }}" target="_blank" 
                                                           class="marketplace-icon website" title="Website">🌐</a>
                                                    @endif
                                                </div>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>{{ $product->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <ul class="action">
                                                <li class="view">
                                                    <a href="{{ route('products.show', $product) }}" title="Lihat Detail">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </li>
                                                <li class="edit">
                                                    <a href="{{ route('products.edit', $product) }}" title="Edit">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                </li>
                                                <li class="delete">
                                                    <a href="#" onclick="confirmDelete({{ $product->id }})" title="Hapus">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                    <form id="delete-form-{{ $product->id }}" 
                                                          action="{{ route('products.destroy', $product) }}" 
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
                        
                        <!-- Custom Pagination -->
                        @if($products->hasPages())
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="dataTables_info">
                                        Menampilkan {{ $products->firstItem() }} sampai {{ $products->lastItem() }} 
                                        dari {{ $products->total() }} produk
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="dataTables_paginate paging_simple_numbers float-end">
                                        {{ $products->appends(request()->query())->links() }}
                                    </div>
                                </div>
                            </div>
                        @endif
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
            $('#productTable').DataTable({
                "paging": false, // Disable DataTable pagination (using Laravel pagination)
                "info": false,   // Disable DataTable info (using custom info)
                "searching": false, // Disable DataTable search (using custom search form)
                "ordering": true,
                "order": [[0, "desc"]], // Order by ID desc
                "columnDefs": [
                    { "orderable": false, "targets": [1, 7, 9] }, // Disable ordering for image, links, and actions
                    { "width": "50px", "targets": 0 }, // ID column width
                    { "width": "60px", "targets": 1 }, // Image column width
                    { "width": "100px", "targets": 9 }, // Action column width
                ],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json",
                    "emptyTable": "Tidak ada produk yang ditemukan",
                    "zeroRecords": "Tidak ada produk yang cocok dengan filter"
                },
                "responsive": true,
                "autoWidth": false
            });
        });
        
        function confirmDelete(productId) {
            if (confirm('Apakah Anda yakin ingin menghapus produk ini? Tindakan ini tidak dapat dibatalkan.')) {
                document.getElementById('delete-form-' + productId).submit();
            }
        }
        
        // Auto submit form when filter changes
        $('#category, #stock, #status').on('change', function() {
            $(this).closest('form').submit();
        });
    </script>
    @endpush
</x-layouts.app>