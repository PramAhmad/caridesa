<x-layouts.app>
    @push('css')
          <!-- Plugins css start-->

    <link rel="stylesheet" type="text/css" href="{{ asset('tenant/css/vendors/datatables.css') }}">
    @endpush
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Kelola Pengguna</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Pengguna</li>
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
                        <h4>Daftar Pengguna</h4>
                        <span>Kelola semua pengguna dan peran mereka dalam akun tenant Anda.</span>
                        <div class="header-right text-end mt-2">
                            <a href="{{ route('users.create')}}" class="btn btn-primary">
                                <i class="fa fa-plus-circle me-2"></i> Tambah Pengguna Baru
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
                            <table class="display" id="userTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Peran</th>
                                        <th>Tanggal Dibuat</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>#{{ $user->id }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="user-avatar me-2">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </div>
                                                {{ $user->name }}
                                            </div>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @foreach($user->roles as $role)
                                                <span class="badge rounded-pill  badge-primary">{{ $role->name }}</span>
                                            @endforeach
                                        </td>
                                        <td>{{ $user->created_at->format('Y/m/d') }}</td>
                                        <td>
                                            @if($user->verified)
                                                <span class="badge rounded-pill badge-success">Aktif</span>
                                            @else
                                                <span class="badge rounded-pill badge-danger">Menunggu</span>
                                            @endif
                                        </td>
                                        <td>
                                            <ul class="action">
                                                <li class="edit">
                                                    <a href="{{ route('users.edit', $user->id) }}">
                                                        <i class="icon-pencil-alt"></i>
                                                    </a>
                                                </li>
                                                <li class="delete">
                                                    <a href="#" onclick="confirmDelete({{ $user->id }})">
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
            $('#userTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                }
            });
        });
        
        function confirmDelete(userId) {
            if (confirm('Apakah Anda yakin ingin menghapus pengguna ini?')) {
                document.getElementById('delete-form-' + userId).submit();
            }
        }
    </script>
    
    <style>
        /* User Avatar */
        .user-avatar {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background-color: #6c5ce7;
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
    </style>
    @endpush
</x-layouts.app>