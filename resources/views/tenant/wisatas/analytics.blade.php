<x-layouts.app>
    @push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('tenant/css/vendors/chartist.css') }}">
    <style>
        .analytics-card {
            transition: transform 0.2s ease-in-out;
        }
        .analytics-card:hover {
            transform: translateY(-2px);
        }
        .metric-icon {
            font-size: 2.5rem;
            opacity: 0.8;
        }
        .chart-container {
            height: 300px;
        }
        .progress-thin {
            height: 8px;
        }
        .table-analytics {
            font-size: 0.9rem;
        }
        .export-buttons .btn {
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }
    </style>
    @endpush
    
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Analytics Wisata</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/admin/wisatas">Wisata</a>
                        </li>
                        <li class="breadcrumb-item active">Analytics</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <!-- Filter Row -->
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="GET" class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label">Periode Waktu</label>
                                <select name="period" class="form-select">
                                    <option value="7" {{ $period == 7 ? 'selected' : '' }}>7 Hari Terakhir</option>
                                    <option value="30" {{ $period == 30 ? 'selected' : '' }}>30 Hari Terakhir</option>
                                    <option value="90" {{ $period == 90 ? 'selected' : '' }}>90 Hari Terakhir</option>
                                    <option value="365" {{ $period == 365 ? 'selected' : '' }}>1 Tahun Terakhir</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Filter Kategori</label>
                                <select name="category_id" class="form-select">
                                    <option value="">Semua Kategori</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $categoryId == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary me-2">
                                    <i class="fa fa-filter me-1"></i> Filter
                                </button>
                                <a href="/admin/wisatas/analytics" class="btn btn-light">
                                    <i class="fa fa-refresh me-1"></i> Reset
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Overview Cards -->
        <div class="row">
            <div class="col-xl-3 col-sm-6">
                <div class="card analytics-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="metric-icon me-3">🏞️</div>
                            <div>
                                <div class="font-weight-bold h4 mb-0">{{ number_format($totalWisata) }}</div>
                                <div class="text-muted">Total Wisata</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-sm-6">
                <div class="card analytics-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="metric-icon me-3">📸</div>
                            <div>
                                <div class="font-weight-bold h4 mb-0">{{ number_format($wisataWithImages) }}</div>
                                <div class="text-muted">Dengan Gambar</div>
                                <div class="text-success small">
                                    {{ $totalWisata > 0 ? round(($wisataWithImages / $totalWisata) * 100, 1) : 0 }}% dari total
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-sm-6">
                <div class="card analytics-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="metric-icon me-3">📈</div>
                            <div>
                                <div class="font-weight-bold h4 mb-0">{{ number_format($performanceMetrics['wisata_this_month']) }}</div>
                                <div class="text-muted">Bulan Ini</div>
                                @if($growthPercentage > 0)
                                    <div class="text-success small">+{{ $growthPercentage }}% dari bulan lalu</div>
                                @elseif($growthPercentage < 0)
                                    <div class="text-danger small">{{ $growthPercentage }}% dari bulan lalu</div>
                                @else
                                    <div class="text-muted small">Tidak ada perubahan</div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-sm-6">
                <div class="card analytics-card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="metric-icon me-3">🎯</div>
                            <div>
                                <div class="font-weight-bold h4 mb-0">{{ $performanceMetrics['completion_rate'] }}%</div>
                                <div class="text-muted">Tingkat Kelengkapan</div>
                                <div class="progress progress-thin mt-2">
                                    <div class="progress-bar bg-success" role="progressbar" 
                                         style="width: {{ $performanceMetrics['completion_rate'] }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Charts Row -->
        <div class="row">
            <!-- Monthly Growth Chart -->
            <div class="col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <h5>Tren Pertumbuhan Wisata (12 Bulan Terakhir)</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="monthlyChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Category Distribution -->
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Distribusi Kategori</h5>
                    </div>
                    <div class="card-body">
                        <div class="chart-container">
                            <canvas id="categoryChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Statistics Tables -->
        <div class="row">
            <!-- Top Categories -->
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Top 5 Kategori Wisata</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-analytics">
                                <thead>
                                    <tr>
                                        <th>Kategori</th>
                                        <th>Jumlah Wisata</th>
                                        <th>Persentase</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($topCategories as $category)
                                    <tr>
                                        <td>
                                            <strong>{{ $category->name }}</strong>
                                            @if($category->description)
                                                <br><small class="text-muted">{{ Str::limit($category->description, 40) }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill badge-primary">{{ $category->wisatas_count }}</span>
                                        </td>
                                        <td>
                                            @php
                                                $percentage = $totalWisata > 0 ? round(($category->wisatas_count / $totalWisata) * 100, 1) : 0;
                                            @endphp
                                            {{ $percentage }}%
                                            <div class="progress progress-thin mt-1">
                                                <div class="progress-bar bg-info" style="width: {{ $percentage }}%"></div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($category->is_active)
                                                <span class="badge rounded-pill badge-success">Aktif</span>
                                            @else
                                                <span class="badge rounded-pill badge-secondary">Tidak Aktif</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Recent Wisata -->
            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Wisata Terbaru</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-analytics">
                                <thead>
                                    <tr>
                                        <th>Nama Wisata</th>
                                        <th>Kategori</th>
                                        <th>Gambar</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentWisata as $wisata)
                                    <tr>
                                        <td>
                                            <strong>{{ $wisata->name }}</strong>
                                            <br><code class="small">{{ $wisata->slug }}</code>
                                        </td>
                                        <td>
                                            @if($wisata->category)
                                                <span class="badge rounded-pill badge-info">{{ $wisata->category->name }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge rounded-pill badge-secondary">{{ $wisata->images->count() }}</span>
                                        </td>
                                        <td>
                                            <small>{{ $wisata->created_at->format('d/m/Y') }}</small>
                                            <br><small class="text-muted">{{ $wisata->created_at->diffForHumans() }}</small>
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
        
        <!-- Additional Stats -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Statistik Detail</h5>
                        <div class="export-buttons">
                            <a href="/admin/analytics/wisatas/export?format=csv" class="btn btn-success btn-sm">
                                <i class="fa fa-download me-1"></i> Export CSV
                            </a>
                            <a href="/admin/analytics/wisatas/export?format=json" class="btn btn-info btn-sm">
                                <i class="fa fa-code me-1"></i> Export JSON
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="text-center p-3 border rounded">
                                    <div class="h4 text-primary">{{ number_format($imageStats['total_images']) }}</div>
                                    <div class="text-muted">Total Gambar</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center p-3 border rounded">
                                    <div class="h4 text-success">{{ $imageStats['avg_images_per_wisata'] }}</div>
                                    <div class="text-muted">Rata-rata Gambar/Wisata</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center p-3 border rounded">
                                    <div class="h4 text-info">{{ number_format($imageStats['wisata_with_multiple_images']) }}</div>
                                    <div class="text-muted">Wisata Multi-gambar</div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center p-3 border rounded">
                                    <div class="h4 text-warning">{{ number_format($performanceMetrics['avg_description_length']) }}</div>
                                    <div class="text-muted">Rata-rata Panjang Deskripsi</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
    
    @push('script')
    <script src="{{ asset('tenant/js/chart/chartjs/chart.min.js') }}"></script>
    <script>
        // Monthly Growth Chart
        const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
        const monthlyChart = new Chart(monthlyCtx, {
            type: 'line',
            data: {
                labels: {!! json_encode(collect($monthlyData)->pluck('month_short')) !!},
                datasets: [{
                    label: 'Jumlah Wisata',
                    data: {!! json_encode(collect($monthlyData)->pluck('count')) !!},
                    backgroundColor: 'rgba(115, 102, 255, 0.1)',
                    borderColor: 'rgba(115, 102, 255, 1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
        
        // Category Distribution Chart
        const categoryCtx = document.getElementById('categoryChart').getContext('2d');
        const categoryChart = new Chart(categoryCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($categoryStats->pluck('name')) !!},
                datasets: [{
                    data: {!! json_encode($categoryStats->pluck('wisatas_count')) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 205, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)',
                        'rgba(255, 159, 64, 0.8)'
                    ],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true
                        }
                    }
                }
            }
        });
        
        // Auto refresh every 5 minutes
        setTimeout(function() {
            location.reload();
        }, 300000);
    </script>
    @endpush
</x-layouts.app>