<x-layouts.app>
    @push('css')
    <!-- Dashboard specific styles -->
    <style>
        .dashboard-stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 15px;
            color: white;
            border: none;
            overflow: hidden;
            position: relative;
        }
        
        .dashboard-stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            transform: translate(30px, -30px);
        }
        
        .stats-icon {
            font-size: 2.5rem;
            opacity: 0.8;
        }
        
        .activity-item {
            border-left: 3px solid #f8f9fa;
            padding-left: 15px;
            margin-bottom: 15px;
            position: relative;
        }
        
        .activity-item::before {
            content: '';
            position: absolute;
            left: -6px;
            top: 5px;
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: #28a745;
        }
        
        .recent-order-item {
            border-bottom: 1px solid #f8f9fa;
            padding: 15px 0;
        }
        
        .recent-order-item:last-child {
            border-bottom: none;
        }
    </style>
    @endpush

    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Dashboard</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/admin/dashboard">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('tenant/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Container-fluid starts -->
    <div class="container-fluid">
        <!-- Statistics Cards Row -->
        <div class="row">
            @foreach($stats as $index => $stat)
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card height-equal dashboard-stats-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="f-w-500 mb-2 text-white-50">{{ $stat['label'] }}</h6>
                                <h2 class="f-w-600 text-white">{{ number_format($stat['count']) }}</h2>
                                <div class="d-flex align-items-center mt-2">
                                    <i class="fa fa-arrow-up text-success me-1"></i>
                                    <span class="f-12 text-white-50">+{{ rand(5,25) }}% from last week</span>
                                </div>
                            </div>
                            <div class="stats-icon">
                                <i class="fa fa-{{ $stat['icon'] }} text-white"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="row">
            <!-- Charts Section -->
            <div class="col-xxl-8 col-md-12">
                <!-- Sales Chart -->
                <div class="card">
                    <div class="card-header sales-chart card-no-border pb-0">
                        <h4>Data Growth Chart</h4>
                        <div class="sales-chart-dropdown">
                            <ul class="balance-data">
                                <li><span class="circle bg-warning"></span><span class="f-light ms-1">Users</span></li>
                                <li><span class="circle bg-primary"></span><span class="f-light ms-1">Content</span></li>
                            </ul>
                            <div class="sales-chart-dropdown-select">
                                <div class="card-header-right-icon">
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle" data-bs-toggle="dropdown">Last 30 Days</button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <span class="dropdown-item">Last Week</span>
                                            <span class="dropdown-item">Last Month</span>
                                            <span class="dropdown-item">Last Year</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-2 pt-0">
                        <div class="sales-wrapper">
                            <canvas id="userGrowthChart" style="height: 300px;"></canvas>
                        </div>
                    </div>
                </div>

                <!-- System Overview Table -->
                <div class="card mt-4">
                    <div class="card-header total-revenue card-no-border">
                        <h4>System Overview</h4>
                        <a href="#" class="text-primary">View All</a>
                    </div>
                    <div class="card-body pt-0">
                        <div class="table-responsive custom-scrollbar">
                            <table class="table order-table w-100">
                                <thead>
                                    <tr>
                                        <th>Module</th>
                                        <th>Records</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($stats as $stat)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="product-icon bg-light-{{ $stat['color'] }} me-3">
                                                    <i class="fa fa-{{ $stat['icon'] }}"></i>
                                                </div>
                                                <div>
                                                    <a class="f-14 f-w-600" href="#">{{ $stat['label'] }}</a>
                                                    <span class="f-light f-12 d-block">{{ ucfirst($stat['table']) }} management</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h6>{{ number_format($stat['count']) }}</h6>
                                        </td>
                                        <td>
                                            <div class="media">
                                                <div class="media-body text-end switch-sm">
                                                    <label class="switch">
                                                        <input type="checkbox" {{ $stat['count'] > 0 ? 'checked' : '' }}>
                                                        <span class="switch-state"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <div data-bs-toggle="dropdown" aria-expanded="false">
                                                    <svg class="invoice-icon">
                                                        <use href="{{ asset('tenant/svg/icon-sprite.svg#more-horizontal') }}"></use>
                                                    </svg>
                                                </div>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    @switch($stat['table'])
                                                        @case('users')
                                                            <a class="dropdown-item" href="{{ route('users.index') }}">View Users</a>
                                                            <a class="dropdown-item" href="{{ route('users.create') }}">Add User</a>
                                                            @break
                                                        @case('products')
                                                            @if(Route::has('products.index'))
                                                            <a class="dropdown-item" href="{{ route('products.index') }}">View Products</a>
                                                            <a class="dropdown-item" href="{{ route('products.create') }}">Add Product</a>
                                                            @endif
                                                            @break
                                                        @case('wisatas')
                                                            @if(Route::has('wisatas.index'))
                                                            <a class="dropdown-item" href="{{ route('wisatas.index') }}">View Wisata</a>
                                                            <a class="dropdown-item" href="{{ route('wisatas.create') }}">Add Wisata</a>
                                                            @endif
                                                            @break
                                                        @default
                                                            <span class="dropdown-item text-muted">No actions</span>
                                                    @endswitch
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar -->
            <div class="col-xxl-4 col-md-12">
                <!-- Recent Activities -->
                <div class="card height-equal">
                    <div class="card-header total-revenue card-no-border">
                        <h4>Recent Activities</h4>
                        <a href="#" class="text-primary">View All</a>
                    </div>
                    <div class="card-body">
                        @if(count($recentActivities) > 0)
                            @foreach($recentActivities as $activity)
                            <div class="activity-item">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <h6 class="f-14 f-w-500 mb-1">{{ $activity['title'] }}</h6>
                                        <p class="f-12 f-light mb-0">{{ $activity['description'] }}</p>
                                    </div>
                                    <span class="f-12 f-light">{{ \Carbon\Carbon::parse($activity['date'])->diffForHumans() }}</span>
                                </div>
                            </div>
                            @endforeach
                        @else
                            <div class="text-center py-4">
                                <i class="fa fa-inbox fa-3x text-muted mb-3"></i>
                                <p class="text-muted">No recent activities</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="card mt-4">
                    <div class="card-header card-no-border">
                        <h4>Quick Actions</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 mb-3">
                                <div class="card product-widget">
                                    <div class="card-body new-product">
                                        <div class="product-cost">
                                            <div class="add-product">
                                                <div class="product-icon bg-light-primary">
                                                    <svg>
                                                        <use href="{{ asset('tenant/svg/icon-sprite.svg#stroke-user') }}"></use>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">Add User</h6>
                                                    <span class="f-light">Create new user account</span>
                                                </div>
                                            </div>
                                            <div class="product-icon">
                                                <a href="{{ route('users.create') }}">
                                                    <svg>
                                                        <use href="{{ asset('tenant/svg/icon-sprite.svg#arrow-right') }}"></use>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if(Route::has('products.create'))
                            <div class="col-6 mb-3">
                                <div class="card product-widget">
                                    <div class="card-body new-product">
                                        <div class="product-cost">
                                            <div class="add-product">
                                                <div class="product-icon bg-light-success">
                                                    <svg>
                                                        <use href="{{ asset('tenant/svg/icon-sprite.svg#box-add') }}"></use>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">Add Product</h6>
                                                    <span class="f-light">Create new product</span>
                                                </div>
                                            </div>
                                            <div class="product-icon">
                                                <a href="{{ route('products.create') }}">
                                                    <svg>
                                                        <use href="{{ asset('tenant/svg/icon-sprite.svg#arrow-right') }}"></use>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if(Route::has('wisatas.create'))
                            <div class="col-6 mb-3">
                                <div class="card product-widget">
                                    <div class="card-body new-product">
                                        <div class="product-cost">
                                            <div class="add-product">
                                                <div class="product-icon bg-light-info">
                                                    <svg>
                                                        <use href="{{ asset('tenant/svg/icon-sprite.svg#stroke-maps') }}"></use>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">Add Wisata</h6>
                                                    <span class="f-light">Create tourism destination</span>
                                                </div>
                                            </div>
                                            <div class="product-icon">
                                                <a href="{{ route('wisatas.create') }}">
                                                    <svg>
                                                        <use href="{{ asset('tenant/svg/icon-sprite.svg#arrow-right') }}"></use>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif

                            @if(Route::has('events.create'))
                            <div class="col-6 mb-3">
                                <div class="card product-widget">
                                    <div class="card-body new-product">
                                        <div class="product-cost">
                                            <div class="add-product">
                                                <div class="product-icon bg-light-warning">
                                                    <svg>
                                                        <use href="{{ asset('tenant/svg/icon-sprite.svg#stroke-calendar') }}"></use>
                                                    </svg>
                                                </div>
                                                <div>
                                                    <h6 class="mb-1">Add Event</h6>
                                                    <span class="f-light">Create new event</span>
                                                </div>
                                            </div>
                                            <div class="product-icon">
                                                <a href="{{ route('events.create') }}">
                                                    <svg>
                                                        <use href="{{ asset('tenant/svg/icon-sprite.svg#arrow-right') }}"></use>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if(isset($chartData['productsByCategory']) && !empty($chartData['productsByCategory']['labels']))
        <!-- Additional Charts Row -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-no-border">
                        <h4>Content Distribution</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="productsCategoryChart" style="height: 300px;"></canvas>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <!-- Container-fluid Ends -->

    @push('script')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // User Growth Chart with Riho style
        const userGrowthCtx = document.getElementById('userGrowthChart').getContext('2d');
        const userGrowthChart = new Chart(userGrowthCtx, {
            type: 'line',
            data: {
                labels: @json($chartData['users']['labels']),
                datasets: [{
                    label: 'New Users',
                    data: @json($chartData['users']['data']),
                    borderColor: '#667eea',
                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                    tension: 0.4,
                    fill: true,
                    pointBackgroundColor: '#667eea',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 6
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
                        grid: {
                            color: 'rgba(0,0,0,0.1)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                },
                elements: {
                    point: {
                        hoverRadius: 8
                    }
                }
            }
        });

        @if(isset($chartData['productsByCategory']) && !empty($chartData['productsByCategory']['labels']))
        // Products by Category Chart
        const productsCategoryCtx = document.getElementById('productsCategoryChart').getContext('2d');
        const productsCategoryChart = new Chart(productsCategoryCtx, {
            type: 'doughnut',
            data: {
                labels: @json($chartData['productsByCategory']['labels']),
                datasets: [{
                    data: @json($chartData['productsByCategory']['data']),
                    backgroundColor: [
                        '#667eea',
                        '#764ba2',
                        '#f093fb',
                        '#f5576c',
                        '#4facfe',
                        '#43e97b'
                    ],
                    borderWidth: 0,
                    cutout: '70%'
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
        @endif

        // Auto refresh functionality (optional)
        document.addEventListener('DOMContentLoaded', function() {
            const refreshButton = document.createElement('button');
            refreshButton.className = 'btn btn-sm btn-outline-primary';
            refreshButton.innerHTML = '<i class="fa fa-sync-alt me-1"></i> Refresh';
            refreshButton.onclick = function() {
                location.reload();
            };
            
            const pageTitle = document.querySelector('.page-title .col-6:first-child');
            if (pageTitle) {
                refreshButton.style.float = 'right';
                refreshButton.style.marginTop = '5px';
                pageTitle.appendChild(refreshButton);
            }
        });
    </script>
    @endpush
</x-layouts.app>