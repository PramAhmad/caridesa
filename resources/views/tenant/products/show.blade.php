<x-layouts.app>
    @push('css')
    <style>
        .product-image-large {
            max-height: 400px;
            object-fit: cover;
            border-radius: 12px;
        }
        
        .product-info-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 12px;
        }
        
        .price-section {
            background: white;
            border-radius: 8px;
            padding: 1.5rem;
            margin: 1rem 0;
        }
        
        .links-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }
        
        .link-card {
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 1rem;
            text-align: center;
            transition: all 0.3s ease;
            text-decoration: none;
            color: inherit;
        }
        
        .link-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            text-decoration: none;
            color: inherit;
        }
        
        .badge-large {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
        }
    </style>
    @endpush
    
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Detail Produk</h4>
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
                        <li class="breadcrumb-item active">{{ $product->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <!-- Product Image -->
            <div class="col-xl-5 col-lg-6">
                <div class="card">
                    <div class="card-body text-center">
                        @if($product->image)
                            <img src="{{ $product->image_url }}" 
                                 alt="{{ $product->name }}" 
                                 class="img-fluid product-image-large">
                        @else
                            <div class="no-image-large d-flex align-items-center justify-content-center" 
                                 style="height: 400px; background: #f8f9fa; border-radius: 12px;">
                                <div class="text-center">
                                    <i class="fa fa-image" style="font-size: 4rem; color: #6c757d;"></i>
                                    <p class="mt-3 text-muted">Tidak ada gambar</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Product Info -->
            <div class="col-xl-7 col-lg-6">
                <div class="card product-info-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h3 class="text-white mb-2">{{ $product->name }}</h3>
                                <p class="text-white-50 mb-0">
                                    <i class="fa fa-tag me-1"></i> {{ $product->category->name }}
                                </p>
                            </div>
                            <div class="text-end">
                                <span class="badge {{ $product->stock_badge_class }} badge-large">
                                    {{ $product->stock_label }}
                                </span>
                                @if(!$product->is_active)
                                    <br>
                                    <span class="badge bg-secondary badge-large mt-1">Tidak Aktif</span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="price-section">
                            @if($product->hasDiscount())
                                <div class="d-flex align-items-center gap-3">
                                    <h2 class="text-success mb-0">{{ $product->formatted_discounted_price }}</h2>
                                    <div>
                                        <span class="text-muted text-decoration-line-through">{{ $product->formatted_price }}</span>
                                        <span class="badge bg-danger ms-2">{{ $product->discount }}% OFF</span>
                                    </div>
                                </div>
                                <small class="text-success">
                                    <i class="fa fa-save"></i> 
                                    Hemat Rp{{ number_format($product->price - $product->discounted_price, 0, ',', '.') }}
                                </small>
                            @else
                                <h2 class="text-success mb-0">{{ $product->formatted_price }}</h2>
                            @endif
                        </div>
                        
                        @if($product->description)
                            <div class="mt-3">
                                <h6 class="text-white">Deskripsi Produk</h6>
                                <p class="text-white-50 mb-0">{{ $product->description }}</p>
                            </div>
                        @endif
                        
                        <div class="mt-4">
                            <div class="d-flex gap-2 flex-wrap">
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">
                                    <i class="fa fa-edit me-1"></i> Edit Produk
                                </a>
                                <a href="{{ route('products.index') }}" class="btn btn-light">
                                    <i class="fa fa-arrow-left me-1"></i> Kembali
                                </a>
                                <button onclick="confirmDelete({{ $product->id }})" class="btn btn-danger">
                                    <i class="fa fa-trash me-1"></i> Hapus
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
                </div>
            </div>
        </div>
        
        <!-- Product Links -->
        @if($product->links && count(array_filter($product->getLinksArray())))
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Link Marketplace</h4>
                        <p class="f-m-light mt-1">Produk ini tersedia di marketplace berikut:</p>
                    </div>
                    <div class="card-body">
                        <div class="links-grid">
                            @php $links = $product->getLinksArray(); @endphp
                            
                            @if(!empty($links['tokopedia']))
                                <a href="{{ $links['tokopedia'] }}" target="_blank" class="link-card">
                                    <i class="fa fa-shopping-bag text-success" style="font-size: 2rem;"></i>
                                    <h6 class="mt-2 mb-1">Tokopedia</h6>
                                    <small class="text-muted">Beli di Tokopedia</small>
                                </a>
                            @endif
                            
                            @if(!empty($links['shopee']))
                                <a href="{{ $links['shopee'] }}" target="_blank" class="link-card">
                                    <i class="fa fa-shopping-cart text-warning" style="font-size: 2rem;"></i>
                                    <h6 class="mt-2 mb-1">Shopee</h6>
                                    <small class="text-muted">Beli di Shopee</small>
                                </a>
                            @endif
                            
                            @if(!empty($links['lazada']))
                                <a href="{{ $links['lazada'] }}" target="_blank" class="link-card">
                                    <i class="fa fa-store text-primary" style="font-size: 2rem;"></i>
                                    <h6 class="mt-2 mb-1">Lazada</h6>
                                    <small class="text-muted">Beli di Lazada</small>
                                </a>
                            @endif
                            
                            @if(!empty($links['blibli']))
                                <a href="{{ $links['blibli'] }}" target="_blank" class="link-card">
                                    <i class="fa fa-gift text-info" style="font-size: 2rem;"></i>
                                    <h6 class="mt-2 mb-1">Blibli</h6>
                                    <small class="text-muted">Beli di Blibli</small>
                                </a>
                            @endif
                            
                            @if(!empty($links['whatsapp']))
                                <a href="https://wa.me/{{ preg_replace('/\D/', '', $links['whatsapp']) }}" target="_blank" class="link-card">
                                    <i class="fa fa-phone text-success" style="font-size: 2rem;"></i>
                                    <h6 class="mt-2 mb-1">WhatsApp</h6>
                                    <small class="text-muted">Hubungi via WA</small>
                                </a>
                            @endif
                            
                            @if(!empty($links['website']))
                                <a href="{{ $links['website'] }}" target="_blank" class="link-card">
                                    <i class="fa fa-globe text-dark" style="font-size: 2rem;"></i>
                                    <h6 class="mt-2 mb-1">Website</h6>
                                    <small class="text-muted">Kunjungi Website</small>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        
        <!-- Product Details -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Informasi Detail</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="150"><strong>ID Produk:</strong></td>
                                        <td>#{{ $product->id }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Slug:</strong></td>
                                        <td><code>{{ $product->slug }}</code></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Kategori:</strong></td>
                                        <td>{{ $product->category->name }}</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Status Stok:</strong></td>
                                        <td>
                                            <span class="badge {{ $product->stock_badge_class }}">
                                                {{ $product->stock_label }}
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-borderless">
                                    <tr>
                                        <td width="150"><strong>Harga Asli:</strong></td>
                                        <td>{{ $product->formatted_price }}</td>
                                    </tr>
                                    @if($product->hasDiscount())
                                    <tr>
                                        <td><strong>Diskon:</strong></td>
                                        <td>{{ $product->discount }}%</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Harga Setelah Diskon:</strong></td>
                                        <td class="text-success">{{ $product->formatted_discounted_price }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td><strong>Status:</strong></td>
                                        <td>
                                            @if($product->is_active)
                                                <span class="badge bg-success">Aktif</span>
                                            @else
                                                <span class="badge bg-secondary">Tidak Aktif</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Dibuat:</strong></td>
                                        <td>{{ $product->created_at->format('d F Y, H:i') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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