<x-layouts.app>
    @push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('tenant/css/vendors/datatables.css') }}">
    <style>
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }
        
        .product-card {
            border: 1px solid #e9ecef;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            background: white;
        }
        
        .product-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }
        
        .product-image {
            height: 200px;
            background: linear-gradient(45deg, #f8f9fa, #e9ecef);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }
        
        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .product-image .no-image {
            color: #6c757d;
            font-size: 3rem;
        }
        
        .product-info {
            padding: 1.25rem;
        }
        
        .product-name {
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        
        .product-category {
            color: #6c757d;
            font-size: 0.875rem;
            margin-bottom: 0.75rem;
        }
        
        .product-price {
            color: #28a745;
            font-weight: 700;
            font-size: 1.25rem;
            margin-bottom: 0.5rem;
        }
        
        .product-discount {
            color: #dc3545;
            font-size: 0.875rem;
            text-decoration: line-through;
            margin-right: 0.5rem;
        }
        
        .product-actions {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
        }
        
        .filter-section {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid #e9ecef;
        }
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
        <div class="filter-section">
            <form method="GET" action="{{ route('products.index') }}" class="row g-3">
                <div class="col-md-4">
                    <label for="search" class="form-label">Cari Produk</label>
                    <input type="text" class="form-control" id="search" name="search" 
                           value="{{ request('search') }}" placeholder="Nama produk...">
                </div>
                <div class="col-md-3">
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
                <div class="col-md-3">
                    <label for="stock" class="form-label">Status Stok</label>
                    <select class="form-select" id="stock" name="stock">
                        <option value="">Semua Status</option>
                        @foreach(App\Enum\ProductStockStatus::cases() as $status)
                            <option value="{{ $status->value }}" 
                                    {{ request('stock') == $status->value ? 'selected' : '' }}>
                                {{ $status->label() }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary me-2">Filter</button>
                    <a href="{{ route('products.index') }}" class="btn btn-light">Reset</a>
                </div>
            </form>
        </div>

        <!-- Header with Add Button -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-1">{{ $products->total() }} Produk Ditemukan</h5>
                        <p class="text-muted mb-0">Kelola semua produk UMKM Anda</p>
                    </div>
                    <a href="{{ route('products.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus-circle me-2"></i> Tambah Produk Baru
                    </a>
                </div>
            </div>
        </div>

        <!-- Alerts -->
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

        <!-- Products Grid -->
        @if($products->count() > 0)
            <div class="product-grid">
                @foreach($products as $product)
                <div class="product-card">
                    <div class="product-image">
                        @if($product->image)
                            <img src="{{ $product->image_url }}" alt="{{ $product->name }}">
                        @else
                            <div class="no-image">
                                <i class="fa fa-image"></i>
                            </div>
                        @endif
                        
                        <!-- Status Badges -->
                        <div class="position-absolute top-0 end-0 p-2">
                            @if(!$product->is_active)
                                <span class="badge bg-secondary">Tidak Aktif</span>
                            @endif
                        </div>
                        
                        <div class="position-absolute top-0 start-0 p-2">
                            <span class="badge {{ $product->stock_badge_class }}">
                                {{ $product->stock_label }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="product-info">
                        <h6 class="product-name">{{ $product->name }}</h6>
                        <div class="product-category">
                            📦 {{ $product->category->name }}
                        </div>
                        
                        <div class="product-pricing">
                            @if($product->hasDiscount())
                                <span class="product-discount">{{ $product->formatted_price }}</span>
                                <div class="product-price">{{ $product->formatted_discounted_price }}</div>
                                <small class="text-success">
                                    <i class="fa fa-tag"></i> Diskon {{ $product->discount }}%
                                </small>
                            @else
                                <div class="product-price">{{ $product->formatted_price }}</div>
                            @endif
                        </div>
                        
                        <!-- Links -->
                        @if($product->links)
                            <div class="product-links mt-2">
                                @php $links = $product->getLinksArray(); @endphp
                                @if($links)
                                    <small class="text-muted">
                                        <i class="fa fa-external-link-alt"></i>
                                        {{ count(array_filter($links)) }} link marketplace
                                    </small>
                                @endif
                            </div>
                        @endif
                        
                        <div class="product-actions">
                            <a href="{{ route('products.show', $product) }}" 
                               class="btn btn-sm btn-outline-info flex-fill">
                                <i class="fa fa-eye"></i> Lihat
                            </a>
                            <a href="{{ route('products.edit', $product) }}" 
                               class="btn btn-sm btn-outline-primary flex-fill">
                                <i class="fa fa-edit"></i> Edit
                            </a>
                            <button onclick="confirmDelete({{ $product->id }})" 
                                    class="btn btn-sm btn-outline-danger">
                                <i class="fa fa-trash"></i>
                            </button>
                            <form id="delete-form-{{ $product->id }}" 
                                  action="{{ route('products.destroy', $product) }}" 
                                  method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="row mt-4">
                <div class="col-12">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            </div>
        @else
            <div class="text-center py-5">
                <div class="empty-state">
                    <div class="empty-icon mb-3">
                        <i class="fa fa-box-open" style="font-size: 4rem; color: #6c757d;"></i>
                    </div>
                    <h5>Tidak Ada Produk</h5>
                    <p class="text-muted">Belum ada produk yang ditambahkan. Mulai tambahkan produk pertama Anda!</p>
                    <a href="{{ route('products.create') }}" class="btn btn-primary">
                        <i class="fa fa-plus-circle me-1"></i> Tambah Produk Pertama
                    </a>
                </div>
            </div>
        @endif
    </div>
    <!-- Container-fluid Ends-->
    
    @push('script')
    <script>
        function confirmDelete(productId) {
            if (confirm('Apakah Anda yakin ingin menghapus produk ini? Tindakan ini tidak dapat dibatalkan.')) {
                document.getElementById('delete-form-' + productId).submit();
            }
        }
    </script>
    @endpush
</x-layouts.app>