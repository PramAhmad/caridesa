<x-layouts.app>
@push('css')
<style>
    .permission-card {
        box-shadow: 0 0 10px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        margin-bottom: 20px;
    }
    
    .permission-card:hover {
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .permission-card .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 1.25rem;
    }
    
    .permission-card .card-header h5 {
        margin-bottom: 0;
        font-weight: 600;
    }
    
    .permission-list {
        max-height: 250px;
        overflow-y: auto;
    }
    
    .permission-list::-webkit-scrollbar {
        width: 5px;
    }
    
    .permission-list::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    
    .permission-list::-webkit-scrollbar-thumb {
        background: #c1c1c1;
        border-radius: 10px;
    }
    
    .permission-list::-webkit-scrollbar-thumb:hover {
        background: #7366ff;
    }
    
    .permission-item {
        padding: 0.5rem 1rem;
        border-bottom: 1px solid #f1f1f1;
        transition: all 0.2s ease;
    }
    
    .permission-item:hover {
        background-color: #f8f9fa;
    }
    
    .permission-item:last-child {
        border-bottom: none;
    }
    
    .form-check-input:checked {
        background-color: #7366ff;
        border-color: #7366ff;
    }
    
    .select-all-container {
        padding: 0.5rem 1rem;
        background-color: #f8f9fa;
        border-bottom: 1px solid #e9ecef;
    }
    
    .module-title {
        text-transform: capitalize;
        font-weight: 600;
        color: #2c323f;
    }
    
    .permission-description {
        font-size: 0.75rem;
        color: #6c757d;
        margin-top: 0.25rem;
    }
    
    .select-all-label {
        font-weight: 600;
        color: #2c323f;
    }
    
    .custom-input label {
        font-weight: 500;
        margin-bottom: 5px;
    }
    
    .custom-input .form-control,
    .custom-input .form-select {
        border-radius: 6px;
        padding: 0.6rem 0.75rem;
        border-color: #e2e5e8;
        background-color: #f9fbfd;
    }
    
    .custom-input .form-control:focus,
    .custom-input .form-select:focus {
        border-color: #7366ff;
        box-shadow: 0 0 0 0.2rem rgba(115, 102, 255, 0.15);
        background-color: #fff;
    }
    
    .text-muted {
        font-size: 0.75rem;
    }
    
    .was-validated .form-control:valid,
    .form-control.is-valid {
        border-color: #28c76f;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2328c76f' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
    }
    
    .was-validated .form-control:invalid,
    .form-control.is-invalid {
        border-color: #ea5455;
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 12 12' width='12' height='12' fill='none' stroke='%23ea5455'%3e%3ccircle cx='6' cy='6' r='5'/%3e%3cpath stroke-linecap='round' d='M6 3v3'/%3e%3cpath stroke-linecap='round' d='M6 9h.01'/%3e%3c/svg%3e");
    }
    
    /* Role badge styles */
    .role-badge {
        font-size: 0.85rem;
        padding: 0.35rem 0.65rem;
        margin-bottom: 1rem;
        display: inline-block;
        border-radius: 6px;
        font-weight: 500;
    }
    
    .role-badge-info {
        background-color: rgba(0, 123, 255, 0.12);
        color: #007bff;
    }
</style>
@endpush

    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Edit Role</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/tenant">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('roles.index') }}">
                                Role
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Edit</li>
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
                    <div class="card-header">
                        <h4>Edit Role: {{ $role->name }}</h4>
                        <p class="f-m-light mt-1">
                            Ubah detail role dan izin di bawah ini. Semua kolom yang diberi tanda <span class="text-danger">*</span> wajib diisi.
                        </p>
                    </div>
                    <div class="card-body">
                        <form class="row g-3 needs-validation custom-input position-relative" 
                            action="{{ route('roles.update', $role) }}" 
                            method="POST" 
                            novalidate>
                            @csrf
                            @method('PUT')
                            
                            <div class="col-md-12 position-relative">
                                <div class="role-badge role-badge-info">
                                    Dibuat pada: {{ $role->created_at->format('d M Y') }}
                                </div>
                                
                                <label class="form-label" for="validationTooltipName">Nama Role <span class="text-danger">*</span></label>
                                <input class="form-control @error('name') is-invalid @enderror" 
                                    id="validationTooltipName" 
                                    type="text" 
                                    name="name"
                                    value="{{ old('name', $role->name) }}"
                                    placeholder="admin" 
                                    required>
                                <div class="valid-tooltip">Data Valid!</div>
                                @error('name')
                                    <div class="invalid-tooltip">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Nama role harus huruf kecil dan tanpa spasi (contoh: admin, editor, manager)</small>
                            </div>
                            
                            <div class="col-md-12 position-relative mt-4">
                                <label class="form-label mb-3">Izin Role <span class="text-danger">*</span></label>
                                
                                <div class="mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="checkbox" id="selectAllPermissions">
                                        <label class="form-check-label select-all-label" for="selectAllPermissions">
                                            Pilih Semua Izin
                                        </label>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    @foreach($permissionsByModule as $module => $modulePermissions)
                                    <div class="col-lg-4 col-md-6">
                                        <div class="card permission-card">
                                            <div class="card-header bg-light">
                                                <h5 class="module-title">{{ $module ?? 'Tidak Dikategorikan' }}</h5>
                                                <div class="form-check">
                                                    <input class="form-check-input module-checkbox" 
                                                        type="checkbox" 
                                                        id="module-{{ Str::slug($module) }}"
                                                        data-module="{{ Str::slug($module) }}">
                                                    <label class="form-check-label" for="module-{{ Str::slug($module) }}">
                                                        Pilih Semua
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="card-body p-0">
                                                <div class="permission-list">
                                                    @foreach($modulePermissions as $permission)
                                                    <div class="permission-item">
                                                        <div class="form-check">
                                                            <input class="form-check-input permission-checkbox" 
                                                                type="checkbox" 
                                                                id="permission-{{ $permission->id }}" 
                                                                name="permissions[]" 
                                                                value="{{ $permission->name }}"
                                                                data-module="{{ Str::slug($module) }}"
                                                                {{ in_array($permission->name, old('permissions', $rolePermissions)) ? 'checked' : '' }}>
                                                            <label class="form-check-label" for="permission-{{ $permission->id }}">
                                                                {{ $permission->name }}
                                                                <div class="permission-description">
                                                                    {{ $permission->description ?? 'Tidak ada deskripsi tersedia' }}
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                
                                @error('permissions')
                                <div class="text-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-12 mt-4 border-top pt-3">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('roles.index') }}" class="btn btn-light">
                                        Batal
                                    </a>
                                    <button class="btn btn-primary" type="submit">Perbarui Role</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
    
    @push('script')
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
            
            // Check module checkboxes based on current permissions
            function initializeModuleCheckboxes() {
                document.querySelectorAll('.module-checkbox').forEach(function(moduleCheckbox) {
                    var moduleId = moduleCheckbox.dataset.module;
                    var modulePermissions = document.querySelectorAll('.permission-checkbox[data-module="' + moduleId + '"]');
                    
                    // Check if all permissions in this module are checked
                    var allChecked = true;
                    modulePermissions.forEach(function(checkbox) {
                        if (!checkbox.checked) {
                            allChecked = false;
                        }
                    });
                    
                    moduleCheckbox.checked = allChecked;
                });
                
                // Check if all modules are selected to update the "Select All" checkbox
                updateSelectAllCheckbox();
            }
            
            // Run initialization to set up checkboxes based on existing permissions
            initializeModuleCheckboxes();
                
            // Handle "Select All" checkbox for all permissions
            document.getElementById('selectAllPermissions').addEventListener('change', function() {
                var allCheckboxes = document.querySelectorAll('.permission-checkbox');
                var moduleCheckboxes = document.querySelectorAll('.module-checkbox');
                
                allCheckboxes.forEach(function(checkbox) {
                    checkbox.checked = this.checked;
                }, this);
                
                moduleCheckboxes.forEach(function(checkbox) {
                    checkbox.checked = this.checked;
                }, this);
            });
            
            // Handle module-level "Select All" checkboxes
            document.querySelectorAll('.module-checkbox').forEach(function(moduleCheckbox) {
                moduleCheckbox.addEventListener('change', function() {
                    var moduleId = this.dataset.module;
                    var modulePermissions = document.querySelectorAll('.permission-checkbox[data-module="' + moduleId + '"]');
                    
                    modulePermissions.forEach(function(checkbox) {
                        checkbox.checked = this.checked;
                    }, this);
                    
                    // Check if all modules are selected to update the "Select All" checkbox
                    updateSelectAllCheckbox();
                });
            });
            
            // Handle individual permission checkboxes
            document.querySelectorAll('.permission-checkbox').forEach(function(permissionCheckbox) {
                permissionCheckbox.addEventListener('change', function() {
                    var moduleId = this.dataset.module;
                    var modulePermissions = document.querySelectorAll('.permission-checkbox[data-module="' + moduleId + '"]');
                    var moduleCheckbox = document.querySelector('.module-checkbox[data-module="' + moduleId + '"]');
                    
                    // Check if all permissions in this module are checked
                    var allChecked = true;
                    modulePermissions.forEach(function(checkbox) {
                        if (!checkbox.checked) {
                            allChecked = false;
                        }
                    });
                    
                    moduleCheckbox.checked = allChecked;
                    
                    // Check if all modules are selected to update the "Select All" checkbox
                    updateSelectAllCheckbox();
                });
            });
            
            // Function to update the "Select All" checkbox
            function updateSelectAllCheckbox() {
                var allPermissions = document.querySelectorAll('.permission-checkbox');
                var selectAllCheckbox = document.getElementById('selectAllPermissions');
                
                var allChecked = true;
                allPermissions.forEach(function(checkbox) {
                    if (!checkbox.checked) {
                        allChecked = false;
                    }
                });
                
                selectAllCheckbox.checked = allChecked;
            }
        })()
    </script>
    @endpush
</x-layouts.app>