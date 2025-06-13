<x-layouts.app>
    @push('css')
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('tenant/css/vendors/datatables.css') }}">
    @endpush
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Kelola Izin</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Kelola Izin</li>
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
                        <h4>Daftar Izin</h4>
                        <span>Kelola semua izin yang dapat diberikan kepada peran di akun tenant Anda.</span>
                        <div class="header-right text-end mt-2">
                            <a href="{{ route('permissions.create')}}" class="btn btn-primary">
                                <i class="fa fa-plus-circle me-2"></i> Tambah Izin Baru
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
                        
                        <!-- Module tabs for navigation -->
                        <ul class="nav nav-tabs" id="moduleTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="all-tab" data-bs-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="true">
                                    Semua Izin
                                </a>
                            </li>
                            @foreach($permissionsByModule as $module => $permissions)
                                <li class="nav-item">
                                    <a class="nav-link" id="{{ Str::slug($module) }}-tab" data-bs-toggle="tab" href="#{{ Str::slug($module) }}" role="tab" aria-controls="{{ Str::slug($module) }}" aria-selected="false">
                                        {{ $module ?? 'Tidak Dikategorikan' }}
                                        <span class="badge bg-primary rounded-pill ms-1">{{ $permissions->count() }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                        
                        <!-- Tab content -->
                        <div class="tab-content mt-3" id="moduleTabContent">
                            <!-- All permissions tab -->
                            <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                                <div class="table-responsive custom-scrollbar">
                                    <table class="display" id="permissions-table">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Modul</th>
                                                <th>Nama</th>
                                                <th>Deskripsi</th>
                                                <th>Tanggal Dibuat</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($permissionsByModule as $module => $permissions)
                                                @foreach($permissions as $permission)
                                                <tr>
                                                    <td>#{{ $permission->id }}</td>
                                                    <td>
                                                        <span class="badge badge-light-primary">{{ $permission->module ?? 'Tidak Dikategorikan' }}</span>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="permission-avatar me-2">
                                                                {{ strtoupper(substr($permission->name, 0, 1)) }}
                                                            </div>
                                                            {{ $permission->name }}
                                                        </div>
                                                    </td>
                                                    <td>{{ $permission->description ?? 'Tidak ada deskripsi' }}</td>
                                                    <td>{{ $permission->created_at->format('d/m/Y') }}</td>
                                                    <td>
                                                        <ul class="action">
                                                            <li class="edit">
                                                                <a href="{{ route('permissions.edit', $permission->id) }}" title="Edit">
                                                                    <i class="icon-pencil-alt"></i>
                                                                </a>
                                                            </li>
                                                            <li class="delete">
                                                                <a href="#" onclick="confirmDelete({{ $permission->id }})" title="Hapus">
                                                                    <i class="icon-trash"></i>
                                                                </a>
                                                                <form id="delete-form-{{ $permission->id }}" action="{{ route('permissions.destroy', $permission->id) }}" method="POST" style="display: none;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <!-- Module specific tabs -->
                            @foreach($permissionsByModule as $module => $permissions)
                                <div class="tab-pane fade" id="{{ Str::slug($module) }}" role="tabpanel" aria-labelledby="{{ Str::slug($module) }}-tab">
                                    <div class="table-responsive custom-scrollbar">
                                        <table class="display module-table">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Nama</th>
                                                    <th>Deskripsi</th>
                                                    <th>Tanggal Dibuat</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($permissions as $permission)
                                                <tr>
                                                    <td>#{{ $permission->id }}</td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="permission-avatar me-2">
                                                                {{ strtoupper(substr($permission->name, 0, 1)) }}
                                                            </div>
                                                            {{ $permission->name }}
                                                        </div>
                                                    </td>
                                                    <td>{{ $permission->description ?? 'Tidak ada deskripsi' }}</td>
                                                    <td>{{ $permission->created_at->format('d/m/Y') }}</td>
                                                    <td>
                                                        <ul class="action">
                                                            <li class="edit">
                                                                <a href="{{ route('permissions.edit', $permission->id) }}" title="Edit">
                                                                    <i class="icon-pencil-alt"></i>
                                                                </a>
                                                            </li>
                                                            <li class="delete">
                                                                <a href="#" onclick="confirmDelete({{ $permission->id }})" title="Hapus">
                                                                    <i class="icon-trash"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endforeach
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
            // Initialize main datatable
            $('#permissions-table').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                }
            });
            
            // Initialize module datatables
            $('.module-table').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                }
            });
            
            // When clicking on a tab, resize the datatables
            $('a[data-bs-toggle="tab"]').on('shown.bs.tab', function (e) {
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
            });
        });
        
        function confirmDelete(permissionId) {
            if (confirm('Apakah Anda yakin ingin menghapus izin ini?')) {
                document.getElementById('delete-form-' + permissionId).submit();
            }
        }
    </script>
    
    <style>
        /* Permission Avatar */
        .permission-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background-color: #ff6666;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.9rem;
        }
        
        /* Action Buttons */
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
        }
        
        .action li.edit a:hover {
            color: #66a1ff;
        }
        
        .action li.delete a:hover {
            color: #ff6666;
        }
        
        /* Icons */
        .icon-pencil-alt:before {
            content: '✏️';
        }
        
        .icon-trash:before {
            content: '🗑️';
        }
        
        /* Nav tabs styling */
        .nav-tabs {
            border-bottom: 1px solid #dee2e6;
            flex-wrap: nowrap;
            overflow-x: auto;
            white-space: nowrap;
            scrollbar-width: thin;
        }
        
        .nav-tabs::-webkit-scrollbar {
            height: 5px;
        }
        
        .nav-tabs::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 10px;
        }
        
        .nav-tabs .nav-link {
            margin-bottom: -1px;
            border: 1px solid transparent;
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
            color: #495057;
            padding: 0.5rem 1rem;
        }
        
        .nav-tabs .nav-link:hover,
        .nav-tabs .nav-link:focus {
            border-color: #e9ecef #e9ecef #dee2e6;
        }
        
        .nav-tabs .nav-link.active {
            color: #7366ff;
            background-color: #fff;
            border-color: #dee2e6 #dee2e6 #fff;
        }
        
        /* Badge styling */
        .badge.badge-light-primary {
            background-color: rgba(115, 102, 255, 0.15);
            color: #7366ff;
        }
    </style>
    @endpush
</x-layouts.app>