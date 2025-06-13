<x-layouts.app>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Edit Permission</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('tenant.permissions.index') }}">
                                Permissions
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
                        <h4>Edit Permission: {{ $permission->name }}</h4>
                        <p class="f-m-light mt-1">
                            Update the permission information. All fields with <span class="text-danger">*</span> are required.
                        </p>
                    </div>
                    <div class="card-body">
                        <form class="row g-3 needs-validation custom-input position-relative" 
                            action="{{ route('tenant.permissions.update', $permission) }}" 
                            method="POST" 
                            novalidate>
                            @csrf
                            @method('PUT')
                            
                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltipName">Permission Name <span class="text-danger">*</span></label>
                                <input class="form-control @error('name') is-invalid @enderror" 
                                    id="validationTooltipName" 
                                    type="text" 
                                    name="name"
                                    value="{{ old('name', $permission->name) }}"
                                    placeholder="view-users" 
                                    required>
                                <div class="valid-tooltip">Looks good!</div>
                                @error('name')
                                    <div class="invalid-tooltip">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Permission name should follow a clear pattern like "action-resource" (e.g., create-users, edit-products)</small>
                            </div>
                            
                            <div class="col-md-6 position-relative">
                                <label class="form-label" for="validationTooltipModule">Module <span class="text-danger">*</span></label>
                                <div class="input-group">
                                    <input list="module-list" class="form-control @error('module') is-invalid @enderror" 
                                        id="validationTooltipModule" 
                                        type="text" 
                                        name="module"
                                        value="{{ old('module', $permission->module) }}"
                                        placeholder="users" 
                                        required>
                                    <datalist id="module-list">
                                        @foreach($modules as $module)
                                            <option value="{{ $module }}">
                                        @endforeach
                                    </datalist>
                                </div>
                                <div class="valid-tooltip">Looks good!</div>
                                @error('module')
                                    <div class="invalid-tooltip">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Group permissions by module (e.g., users, roles, settings)</small>
                            </div>
                            
                            <div class="col-md-12 position-relative">
                                <label class="form-label" for="validationTooltipDescription">Description</label>
                                <input class="form-control @error('description') is-invalid @enderror" 
                                    id="validationTooltipDescription" 
                                    type="text" 
                                    name="description"
                                    value="{{ old('description', $permission->description) }}"
                                    placeholder="Allows viewing the list of users">
                                <div class="valid-tooltip">Looks good!</div>
                                @error('description')
                                    <div class="invalid-tooltip">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">A brief description of what this permission allows users to do</small>
                            </div>
                            
                            <div class="col-12 mt-4 border-top pt-3">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('tenant.permissions.index') }}" class="btn btn-light">
                                        Cancel
                                    </a>
                                    <button class="btn btn-primary" type="submit">Update Permission</button>
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
        })()
    </script>
    
    <style>
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
    </style>
    @endpush
</x-layouts.app>