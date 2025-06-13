<x-layouts.app>
    @push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('tenant/css/vendors/tagify.css') }}">
        
    @endpush
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-6">
                        <h4>Edit Pengguna</h4>
                    </div>
                    <div class="col-6">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <x-tenant-link route="home.tenant">
                                    <i data-feather="home"></i>
                                </x-tenant-link>
                            </li>
                            <li class="breadcrumb-item">
                                <x-tenant-link route="users.index">
                                    Pengguna
                                </x-tenant-link>
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
                            <h4>Edit Pengguna: {{ $user->name }}</h4>
                            <p class="f-m-light mt-1">
                                Perbarui informasi pengguna. Semua kolom yang diberi tanda <span class="text-danger">*</span> wajib diisi.
                            </p>
                        </div>
                        <div class="card-body">
                            <form class="row g-3 needs-validation custom-input position-relative" 
                                action="{{ route('users.update', $user) }}" 
                                method="POST" 
                                novalidate>
                                @csrf
                                @method('PUT')
                                
                                <div class="col-md-6 position-relative">
                                    <label class="form-label" for="validationTooltipName">Nama <span class="text-danger">*</span></label>
                                    <input class="form-control @error('name') is-invalid @enderror" 
                                        id="validationTooltipName" 
                                        type="text" 
                                        name="name"
                                        value="{{ old('name', $user->name) }}"
                                        placeholder="John Doe" 
                                        required>
                                    <div class="valid-tooltip">Terlihat bagus!</div>
                                    @error('name')
                                        <div class="invalid-tooltip">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 position-relative">
                                    <label class="form-label" for="validationTooltipEmail">Email <span class="text-danger">*</span></label>
                                    <input class="form-control @error('email') is-invalid @enderror" 
                                        id="validationTooltipEmail" 
                                        type="email" 
                                        name="email"
                                        value="{{ old('email', $user->email) }}"
                                        placeholder="user@example.com" 
                                        required>
                                    <div class="valid-tooltip">Terlihat bagus!</div>
                                    @error('email')
                                        <div class="invalid-tooltip">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 position-relative">
                                    <label class="form-label" for="validationTooltipUsername">Nama Pengguna</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="validationTooltipUsernamePrepend">@</span>
                                        <input class="form-control @error('username') is-invalid @enderror" 
                                            id="validationTooltipUsername" 
                                            type="text" 
                                            name="username"
                                            value="{{ old('username', $user->username) }}"
                                            placeholder="johndoe" 
                                            aria-describedby="validationTooltipUsernamePrepend">
                                        <div class="valid-tooltip">Terlihat bagus!</div>
                                        @error('username')
                                            <div class="invalid-tooltip">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <small class="text-muted">Kosongkan untuk membuat otomatis dari nama</small>
                                </div>
                                
                                <div class="col-md-6 position-relative">
                                    <label class="form-label" for="roles-input">Peran <span class="text-danger">*</span></label>
                                    <input class="@error('roles') is-invalid @enderror" 
                                        name="roles" 
                                        id="roles-input" 
                                        placeholder="Pilih peran pengguna">
                                    <div class="valid-tooltip">Terlihat bagus!</div>
                                    @error('roles')
                                        <div class="invalid-tooltip">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6 position-relative">
                                    <label class="form-label" for="validationTooltipPassword">Kata Sandi</label>
                                    <input class="form-control @error('password') is-invalid @enderror" 
                                        id="validationTooltipPassword" 
                                        type="password" 
                                        name="password"
                                        placeholder="Kosongkan untuk mempertahankan kata sandi saat ini">
                                    <div class="valid-tooltip">Terlihat bagus!</div>
                                    @error('password')
                                        <div class="invalid-tooltip">{{ $message }}</div>
                                    @enderror
                                    <small class="text-muted">Kosongkan untuk mempertahankan kata sandi saat ini</small>
                                </div>
                                
                                <div class="col-md-6 position-relative">
                                    <label class="form-label" for="validationTooltipPasswordConfirm">Konfirmasi Kata Sandi</label>
                                    <input class="form-control" 
                                        id="validationTooltipPasswordConfirm" 
                                        type="password" 
                                        name="password_confirmation"
                                        placeholder="Masukkan ulang kata sandi jika mengubah">
                                    <div class="valid-tooltip">Kata sandi cocok!</div>
                                    <div class="invalid-tooltip">Silakan konfirmasi kata sandi Anda.</div>
                                </div>
                                
                                <div class="col-12 mt-4 border-top pt-3">
                                    <div class="d-flex justify-content-end gap-2">
                                        <a href="{{ route('users.index')}}" class="btn btn-light">
                                            Batal
                                        </a>
                                        <button class="btn btn-primary" type="submit">Perbarui Pengguna</button>
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
        <script src="{{ asset('tenant/js/select2/tagify.js') }}"></script>
        <script src="{{ asset('tenant/js/select2/tagify.polyfills.min.js') }}"></script>
        <script>
            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function () {
                'use strict'
                
                // Get roles input element
                var rolesInput = document.querySelector('#roles-input');
                
                // Create whitelist of role options
                var whitelist = [
                    @foreach($roles as $role)
                        "{{ $role->name }}",
                    @endforeach
                ];
                
                // Initialize Tagify
                var tagify = new Tagify(rolesInput, {
                    whitelist: whitelist,
                    maxTags: 10,
                    enforceWhitelist: true,
                    dropdown: {
                        maxItems: 20,
                        classname: "tags-look",
                        enabled: 0,
                        closeOnSelect: false
                    }
                });
                
                // Set user's current roles
                @if(old('roles'))
                    tagify.addTags([
                        @foreach(old('roles') as $role)
                            "{{ $role }}",
                        @endforeach
                    ]);
                @else
                    tagify.addTags([
                        @foreach($user->roles as $role)
                            "{{ $role->name }}",
                        @endforeach
                    ]);
                @endif
    
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.querySelectorAll('.needs-validation')
    
                // Loop over them and prevent submission
                Array.prototype.slice.call(forms)
                    .forEach(function (form) {
                        form.addEventListener('submit', function (event) {
                            // Only validate password fields if they're not empty
                            var password = document.getElementById('validationTooltipPassword');
                            var confirmPassword = document.getElementById('validationTooltipPasswordConfirm');
                            
                            if (password.value.trim() === '') {
                                // If password is empty, skip validation for password fields
                                password.removeAttribute('required');
                                confirmPassword.removeAttribute('required');
                            } else {
                                // If password is filled, make both fields required
                                password.setAttribute('required', '');
                                confirmPassword.setAttribute('required', '');
                            }
                            
                            if (!form.checkValidity()) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
    
                            form.classList.add('was-validated');
                        }, false);
                    });
                    
                // Check password confirmation match
                const password = document.getElementById('validationTooltipPassword');
                const confirmPassword = document.getElementById('validationTooltipPasswordConfirm');
                
                confirmPassword.addEventListener('input', function() {
                    if (password.value !== confirmPassword.value) {
                        confirmPassword.setCustomValidity("Kata sandi tidak cocok");
                    } else {
                        confirmPassword.setCustomValidity('');
                    }
                });
                
                password.addEventListener('input', function() {
                    if (password.value !== confirmPassword.value && confirmPassword.value !== '') {
                        confirmPassword.setCustomValidity("Kata sandi tidak cocok");
                    } else {
                        confirmPassword.setCustomValidity('');
                    }
                });
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
            
            .custom-input .input-group-text {
                background-color: #f9fbfd;
                border-color: #e2e5e8;
            }
            
            .custom-input .valid-tooltip,
            .custom-input .invalid-tooltip {
                font-size: 0.75rem;
                padding: 0.25rem 0.5rem;
                border-radius: 4px;
            }
            
            .custom-input .valid-tooltip {
                background-color: rgba(40, 199, 111, 0.9);
            }
            
            .custom-input .invalid-tooltip {
                background-color: rgba(234, 84, 85, 0.9);
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
            
            /* Tagify Styling */
            .tagify {
                --tags-border-color: #e2e5e8;
                --tags-hover-border-color: #7366ff;
                --tags-focus-border-color: #7366ff;
                --tag-bg: #7366ff;
                --tag-hover: #5d52cc;
                --tag-text-color: #fff;
                --tag-text-color--edit: #111;
                --tag-pad: 0.3em 0.5em;
                --tag-inset-shadow-size: 1.35em;
                --tag-border-radius: 4px;
                --tag-remove-bg: rgba(255, 255, 255, 0.14);
                --tag-remove-btn-color: white;
                --tag-remove-btn-bg: none;
                display: block;
                width: 100%;
                border-radius: 6px;
                padding: 0.45rem 0.75rem;
                background-color: #f9fbfd;
            }
            
            .tagify__tag {
                margin: 5px 5px 5px 0;
            }
            
            .tagify__tag > div {
                padding: 0.3em 0.5em;
            }
            
            .tagify__tag > div::before {
                box-shadow: 0 0 0 1.1em #7366ff inset;
            }
            
            .tagify__dropdown {
                border-radius: 4px;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            }
            
            .tagify__dropdown__wrapper {
                border-radius: 4px;
                max-height: 250px;
            }
            
            .tagify__dropdown__item {
                padding: 0.5em 0.7em;
                border-radius: 4px;
            }
            
            .tagify__dropdown__item--active {
                background: #7366ff;
                color: white;
            }
            
            .tags-look .tagify__dropdown__item {
                display: inline-block;
                border-radius: 15px;
                padding: 0.3em 0.5em;
                margin: 0.2em;
                font-size: 0.85em;
                color: #333;
                background: #f5f5f5;
                transition: background 0.15s ease;
            }
            
            .tags-look .tagify__dropdown__item:hover {
                background: #7366ff;
                color: white;
            }
        </style>
        @endpush
    </x-layouts.app>