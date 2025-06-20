<x-layouts.app>
    @push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('tenant/css/vendors/datatables.css') }}">
    @endpush
    
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Kelola Acara</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Acara</li>
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
                        <h4>Daftar Acara</h4>
                        <span>Kelola semua acara desa Anda dengan mudah dan efisien.</span>
                        <div class="header-right text-end mt-2">
                            <a href="/admin/events/create" class="btn btn-primary">
                                <i class="fa fa-plus-circle me-2"></i> Tambah Acara Baru
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
                                    <option value="upcoming">Akan Datang</option>
                                    <option value="ongoing">Sedang Berlangsung</option>
                                    <option value="past">Selesai</option>
                                    <option value="active">Aktif</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group">
                                    <input type="date" class="form-control" id="dateFilter" placeholder="Pilih Tanggal">
                                    <button class="btn btn-outline-secondary" type="button" onclick="clearDateFilter()">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="searchFilter" placeholder="Cari nama acara, lokasi, atau penyelenggara...">
                                    <button class="btn btn-outline-secondary" type="button" onclick="clearSearchFilter()">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="table-responsive custom-scrollbar">
                            <table class="display" id="eventTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Acara</th>
                                        <th>Tanggal & Waktu</th>
                                        <th>Lokasi</th>
                                        <th>Penyelenggara</th>
                                        <th>Status</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($events as $event)
                                    <tr>
                                        <td>#{{ $event->id }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="event-icon me-2">
                                                    📅
                                                </div>
                                                <div>
                                                    <strong>{{ $event->name }}</strong>
                                                    <br><small class="text-info">{{ Str::limit($event->description, 60) }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="date-info">
                                                <div class="start-date">
                                                    <strong>{{ $event->start_date->format('d M Y') }}</strong>
                                                    <small class="text-muted d-block">{{ $event->start_date->format('H:i') }}</small>
                                                </div>
                                                @if(!$event->start_date->isSameDay($event->end_date))
                                                <div class="text-muted small">s/d</div>
                                                <div class="end-date">
                                                    <strong>{{ $event->end_date->format('d M Y') }}</strong>
                                                    <small class="text-muted d-block">{{ $event->end_date->format('H:i') }}</small>
                                                </div>
                                                @else
                                                <div class="text-muted small">s/d {{ $event->end_date->format('H:i') }}</div>
                                                @endif
                                                
                                                <div class="duration-badge mt-1">
                                                    <span class="badge badge-light">{{ $event->formatted_duration }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="location-info">
                                                <div class="location">📍 {{ Str::limit($event->location, 30) }}</div>
                                                @if($event->contact_email || $event->contact_phone)
                                                <div class="contact-info mt-1">
                                                    @if($event->contact_phone)
                                                        <small class="text-muted">📞 {{ $event->contact_phone }}</small>
                                                    @endif
                                                    @if($event->contact_email)
                                                        <br><small class="text-muted">✉️ {{ $event->contact_email }}</small>
                                                    @endif
                                                </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="organizer-info">
                                                @if($event->organizer)
                                                    <strong>{{ $event->organizer }}</strong>
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="status-badges">
                                                <!-- Event Status -->
                                                <span class="badge rounded-pill badge-{{ $event->status_color }}">
                                                    {{ $event->status_label }}
                                                </span>
                                                
                                                <!-- Active Status -->
                                                <div class="mt-1">
                                                    @if($event->is_active)
                                                        <span class="badge rounded-pill badge-success">Aktif</span>
                                                    @else
                                                        <span class="badge rounded-pill badge-secondary">Nonaktif</span>
                                                    @endif
                                                </div>
                                                
                                                <!-- Time until event -->
                                                @if($event->time_until_start)
                                                <div class="mt-1">
                                                    <small class="text-muted">{{ $event->time_until_start }}</small>
                                                </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div class="image-preview">
                                                @if($event->main_image)
                                                    <img src="{{ $event->main_image_url }}" alt="{{ $event->name }}" class="img-thumbnail" style="width: 60px; height: 60px; object-fit: cover;">
                                                @else
                                                    <div class="no-image">
                                                        <i class="fa fa-image text-muted"></i>
                                                    </div>
                                                @endif
                                                <small class="text-muted d-block">
                                                    {{ $event->images_count }} gambar
                                                </small>
                                            </div>
                                        </td>
                                        <td>
                                            <ul class="action">
                                                <li class="view">
                                                    <a href="/admin/events/{{ $event->slug }}" title="Lihat Detail">
                                                        <i class="icon-eye"></i>
                                                    </a>
                                                </li>
                                                <li class="edit">
                                                    <a href="/admin/events/{{ $event->slug }}/edit" title="Edit">
                                                        <i class="icon-pencil-alt"></i>
                                                    </a>
                                                </li>
                                                <li class="toggle">
                                                    <a href="#" onclick="confirmToggle({{ $event->id }})" title="{{ $event->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                                        <i class="icon-toggle"></i>
                                                    </a>
                                                    <form id="toggle-form-{{ $event->id }}" 
                                                          action="/admin/events/{{ $event->slug }}/toggle-status" 
                                                          method="POST" style="display: none;">
                                                        @csrf
                                                        @method('PATCH')
                                                    </form>
                                                </li>
                                                <li class="delete">
                                                    <a href="#" onclick="confirmDelete({{ $event->id }})" title="Hapus">
                                                        <i class="icon-trash"></i>
                                                    </a>
                                                    <form id="delete-form-{{ $event->id }}" 
                                                          action="/admin/events/{{ $event->slug }}" 
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
            $('#eventTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json",
                    "emptyTable": "Tidak ada acara yang ditemukan",
                    "zeroRecords": "Tidak ada acara yang cocok dengan pencarian"
                },
                "order": [[ 2, "asc" ]], // Order by start date
                "columnDefs": [
                    { "orderable": false, "targets": [6, 7] }, // Disable ordering for images and actions
                    { "width": "50px", "targets": 0 }, // ID column width
                    { "width": "200px", "targets": 2 }, // Date column width
                    { "width": "120px", "targets": 7 }, // Action column width
                ],
                "responsive": true,
                "autoWidth": false
            });
        });
        
        function confirmDelete(eventId) {
            if (confirm('Apakah Anda yakin ingin menghapus acara ini? Semua gambar terkait juga akan dihapus.')) {
                document.getElementById('delete-form-' + eventId).submit();
            }
        }
        
        function confirmToggle(eventId) {
            if (confirm('Apakah Anda yakin ingin mengubah status acara ini?')) {
                document.getElementById('toggle-form-' + eventId).submit();
            }
        }
        
        function clearDateFilter() {
            document.getElementById('dateFilter').value = '';
            // Trigger filter update
        }
        
        function clearSearchFilter() {
            document.getElementById('searchFilter').value = '';
            // Trigger filter update
        }
    </script>
    
    <style>
        .event-icon {
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
        
        .date-info {
            min-width: 120px;
        }
        
        .location-info {
            min-width: 150px;
        }
        
        .status-badges {
            min-width: 100px;
        }
        
        .image-preview {
            text-align: center;
        }
        
        .duration-badge .badge {
            font-size: 0.7rem;
        }
    </style>
    @endpush
</x-layouts.app>