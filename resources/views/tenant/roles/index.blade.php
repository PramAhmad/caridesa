<x-layouts.app>
    @push('css')
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('tenant/css/vendors/datatables.css') }}">
    @endpush
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Kelola Role</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <!-- admin/dashboard -->
                                 <a href="admin/dashboard">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">
                                <a href="admin/users">Pengguna</a>
                            </li>
                            <li class="breadcrumb-item active">Edit</li>
                        </ol>
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
                        <h4>Daftar Role</h4>
                        <span>Kelola semua role dan izin mereka di akun tenant Anda.</span>
                        <div class="header-right text-end mt-2">
                            <a href="{{ route('roles.create')}}" class="btn btn-primary">
                                <i class="fa fa-plus-circle me-2"></i> Tambah Role Baru
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
                        
                        <div class="table-responsive custom-scrollbar">
                            <table class="display" id="rolesTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Izin</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($roles as $role)
                                    <tr>
                                        <td>#{{ $role->id }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="role-avatar me-2">
                                                    {{ strtoupper(substr($role->name, 0, 1)) }}
                                                </div>
                                                {{ $role->name }}
                                            </div>
                                        </td>
                                        <td>
                                            <div class="permissions-wrapper">
                                                @foreach($role->permissions->take(3) as $permission)
                                                    <span class="badge rounded-pill badge-primary">{{ $permission->name }}</span>
                                                @endforeach
                                                
                                                @if($role->permissions->count() > 3)
                                                    <span class="badge rounded-pill badge-light">+{{ $role->permissions->count() - 3 }} lagi</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ $role->created_at->format('d/m/Y') }}</td>
                                        <td>
                                            <ul class="action">
                                                <li class="edit">
                                                    <a href="{{ route('roles.edit', $role->id) }}" title="Edit">
                                                        <i class="icon-pencil-alt"></i>
                                                    </a>
                                                </li>
                                                <li class="delete">
                                                    <a href="#" onclick="confirmDelete({{ $role->id }})" title="Hapus">
                                                        <i class="icon-trash"></i>
                                                    </a>
                                                    <form id="delete-form-{{ $role->id }}" action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display: none;">
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
            $('#rolesTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                }
            });
        });
        
        function confirmDelete(roleId) {
            if (confirm('Apakah Anda yakin ingin menghapus role ini?')) {
                document.getElementById('delete-form-' + roleId).submit();
            }
        }
    </script>
    
    <style>
        /* Role Avatar */
        .role-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background-color: oklch(50.8% 0.118 165.612);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.9rem;
        }
        
        /* Permissions wrapper */
        .permissions-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 5px;
            max-width: 350px;
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
    </style>
    @endpush
</x-layouts.app>