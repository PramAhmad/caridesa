<x-layouts.app>
    @push('css')
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('tenant/css/vendors/datatables.css') }}">
    @endpush
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Roles Management</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <x-tenant-link route="home.tenant">
                                <i data-feather="home"></i>
                            </x-tenant-link>
                        </li>
                        <li class="breadcrumb-item active">Roles</li>
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
                        <h4>Roles List</h4>
                        <span>Manage all roles and their permissions in your tenant account.</span>
                        <div class="header-right text-end mt-2">
                            <a href="{{ route('tenant.roles.create')}}" class="btn btn-primary">
                                <i class="fa fa-plus-circle me-2"></i> Add New Role
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        
                        <div class="table-responsive custom-scrollbar">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Permissions</th>
                                        <th>Created Date</th>
                                        <th>Action</th>
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
                                                    <span class="badge rounded-pill badge-light">+{{ $role->permissions->count() - 3 }} more</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td>{{ $role->created_at->format('Y/m/d') }}</td>
                                        <td>
                                            <ul class="action">
                                                <li class="edit">
                                                    <a href="{{ route('tenant.roles.edit', $role->id) }}">
                                                        <i class="icon-pencil-alt"></i>
                                                    </a>
                                                </li>
                                                <li class="delete">
                                                    <a href="#" onclick="confirmDelete({{ $role->id }})">
                                                        <i class="icon-trash"></i>
                                                    </a>
                                                    <form id="delete-form-{{ $role->id }}" action="{{ route('tenant.roles.destroy', $role->id) }}" method="POST" style="display: none;">
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
            $('#basic-1').DataTable();
        });
        
        function confirmDelete(roleId) {
            if (confirm('Are you sure you want to delete this role?')) {
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
            background-color: #7366ff;
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