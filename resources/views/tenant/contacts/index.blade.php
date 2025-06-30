<x-layouts.app>
    @push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('tenant/css/vendors/datatables.css') }}">
    @endpush
    
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Kelola Pesan Kontak</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Pesan Kontak</li>
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
                        <h4>Daftar Pesan Kontak</h4>
                        <span>Kelola semua pesan yang masuk dari formulir kontak website Anda.</span>
                        <div class="header-right text-end mt-2">
                            <button class="btn btn-success me-2" onclick="markAllAsRead()" title="Tandai Semua Sudah Dibaca">
                                <i class="fa fa-check-double me-2"></i> Tandai Semua Dibaca
                            </button>
                            <button class="btn btn-info" onclick="refreshTable()" title="Refresh Data">
                                <i class="fa fa-refresh me-2"></i> Refresh
                            </button>
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

                        <!-- Statistics Cards -->
                        <div class="row mb-4">
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-muted fw-medium mb-2">Total Pesan</p>
                                                <h4 class="mb-0">{{ $contacts->total() }}</h4>
                                            </div>
                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                                    <span class="avatar-title">
                                                        <i class="fa fa-envelope font-size-16"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-muted fw-medium mb-2">Hari Ini</p>
                                                <h4 class="mb-0">{{ $contacts->where('created_at', '>=', today())->count() }}</h4>
                                            </div>
                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="mini-stat-icon avatar-sm rounded-circle bg-success">
                                                    <span class="avatar-title">
                                                        <i class="fa fa-calendar font-size-16"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-muted fw-medium mb-2">Minggu Ini</p>
                                                <h4 class="mb-0">{{ $contacts->where('created_at', '>=', now()->startOfWeek())->count() }}</h4>
                                            </div>
                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="mini-stat-icon avatar-sm rounded-circle bg-warning">
                                                    <span class="avatar-title">
                                                        <i class="fa fa-chart-bar font-size-16"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xl-3 col-md-6">
                                <div class="card mini-stats-wid">
                                    <div class="card-body">
                                        <div class="d-flex">
                                            <div class="flex-grow-1">
                                                <p class="text-muted fw-medium mb-2">Bulan Ini</p>
                                                <h4 class="mb-0">{{ $contacts->where('created_at', '>=', now()->startOfMonth())->count() }}</h4>
                                            </div>
                                            <div class="flex-shrink-0 align-self-center">
                                                <div class="mini-stat-icon avatar-sm rounded-circle bg-info">
                                                    <span class="avatar-title">
                                                        <i class="fa fa-chart-line font-size-16"></i>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="table-responsive custom-scrollbar">
                            <table class="display" id="contactTable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>WhatsApp</th>
                                        <th>Subjek</th>
                                        <th>Pesan</th>
                                        <th>Tanggal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($contacts as $contact)
                                    <tr data-contact-id="{{ $contact->id }}">
                                        <td>#{{ $contact->id }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="contact-icon me-2">
                                                    👤
                                                </div>
                                                <div>
                                                    <strong>{{ $contact->name }}</strong>
                                                    <br><small class="text-muted">{{ $contact->created_at->diffForHumans() }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <span class="me-2">📧</span>
                                                <div>
                                                    <a href="mailto:{{ $contact->email }}" class="text-primary text-decoration-none">
                                                        {{ $contact->email }}
                                                    </a>
                                                    <br><small class="text-muted">Klik untuk email</small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            @if($contact->phone)
                                                <div class="d-flex align-items-center">
                                                    <span class="me-2">📱</span>
                                                    <div>
                                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact->phone) }}" 
                                                           target="_blank" 
                                                           class="text-success text-decoration-none">
                                                            {{ $contact->phone }}
                                                        </a>
                                                        <br><small class="text-muted">Klik untuk WhatsApp</small>
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($contact->subject)
                                                <span class="badge rounded-pill badge-primary">
                                                    {{ Str::limit($contact->subject, 20) }}
                                                </span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="message-preview" style="max-width: 300px;">
                                                <p class="mb-1">
                                                    {{ Str::limit($contact->message, 100) }}
                                                </p>
                                                @if(strlen($contact->message) > 100)
                                                    <button class="btn btn-sm btn-outline-info" 
                                                            onclick="showFullMessage('{{ $contact->id }}', `{{ addslashes($contact->message) }}`)"
                                                            title="Lihat Pesan Lengkap">
                                                        <i class="fa fa-expand"></i> Lihat Lengkap
                                                    </button>
                                                @endif
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <strong>{{ $contact->created_at->format('d/m/Y') }}</strong>
                                                <br><small class="text-muted">{{ $contact->created_at->format('H:i') }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-sm btn-secondary dropdown-toggle" type="button" 
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa fa-ellipsis-v"></i>
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" 
                                                           href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject ?? 'Pesan dari Website' }}&body=Halo {{ $contact->name }},%0D%0A%0D%0ATerima kasih telah menghubungi kami.%0D%0A%0D%0A">
                                                            <i class="fa fa-reply me-2"></i> Balas Email
                                                        </a>
                                                    </li>
                                                    @if($contact->phone)
                                                    <li>
                                                        <a class="dropdown-item" 
                                                           href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $contact->phone) }}?text=Halo {{ $contact->name }}, terima kasih telah menghubungi kami melalui website." 
                                                           target="_blank">
                                                            <i class="fa fa-whatsapp me-2"></i> Balas WhatsApp
                                                        </a>
                                                    </li>
                                                    @endif
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li>
                                                        <button class="dropdown-item" 
                                                                onclick="showContactDetails('{{ $contact->id }}', `{{ addslashes(json_encode($contact)) }}`)">
                                                            <i class="fa fa-info-circle me-2"></i> Detail Lengkap
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <button class="dropdown-item" 
                                                                onclick="copyContactInfo('{{ $contact->name }}', '{{ $contact->email }}', '{{ $contact->phone }}')">
                                                            <i class="fa fa-copy me-2"></i> Salin Info Kontak
                                                        </button>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $contacts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    <!-- Modal untuk Pesan Lengkap -->
    <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="messageModalLabel">
                        <i class="fa fa-envelope me-2"></i> Pesan Lengkap
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div id="fullMessageContent" style="white-space: pre-wrap; word-wrap: break-word;">
                        <!-- Content will be inserted here -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Detail Kontak -->
    <div class="modal fade" id="contactDetailModal" tabindex="-1" aria-labelledby="contactDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="contactDetailModalLabel">
                        <i class="fa fa-user me-2"></i> Detail Kontak Lengkap
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body">
                    <div id="contactDetailContent">
                        <!-- Content will be inserted here -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
    
    @push('script')
    <script src="{{ asset('tenant/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('tenant/js/datatable/datatables/datatable.custom.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#contactTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                },
                "order": [[ 0, "desc" ]],
                "pageLength": 25,
                "columnDefs": [
                    { "orderable": false, "targets": [7] } // Disable sorting on action column
                ]
            });
        });
        
        // Show full message in modal
        function showFullMessage(contactId, message) {
            document.getElementById('fullMessageContent').textContent = message;
            new bootstrap.Modal(document.getElementById('messageModal')).show();
        }

        // Show contact details in modal
        function showContactDetails(contactId, contactJson) {
            try {
                const contact = JSON.parse(contactJson);
                const detailContent = `
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0">
                                        <i class="fa fa-user me-2"></i> Informasi Kontak
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <table class="table table-borderless">
                                        <tr>
                                            <td><strong>ID:</strong></td>
                                            <td>#${contact.id}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Nama:</strong></td>
                                            <td>${contact.name}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Email:</strong></td>
                                            <td>
                                                <a href="mailto:${contact.email}" class="text-primary">
                                                    ${contact.email}
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>WhatsApp:</strong></td>
                                            <td>
                                                ${contact.phone ? 
                                                    `<a href="https://wa.me/${contact.phone.replace(/[^0-9]/g, '')}" target="_blank" class="text-success">${contact.phone}</a>` : 
                                                    '<span class="text-muted">-</span>'
                                                }
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><strong>Subjek:</strong></td>
                                            <td>${contact.subject || '<span class="text-muted">-</span>'}</td>
                                        </tr>
                                        <tr>
                                            <td><strong>Tanggal:</strong></td>
                                            <td>${new Date(contact.created_at).toLocaleString('id-ID')}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="mb-0">
                                        <i class="fa fa-envelope me-2"></i> Pesan Lengkap
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="border rounded p-3" style="background-color: #f8f9fa; white-space: pre-wrap; word-wrap: break-word; max-height: 300px; overflow-y: auto;">
                                        ${contact.message}
                                    </div>
                                </div>
                            </div>
                            <div class="card mt-3">
                                <div class="card-header">
                                    <h6 class="mb-0">
                                        <i class="fa fa-reply me-2"></i> Aksi Cepat
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <a href="mailto:${contact.email}?subject=Re: ${contact.subject || 'Pesan dari Website'}&body=Halo ${contact.name},%0D%0A%0D%0ATerima kasih telah menghubungi kami.%0D%0A%0D%0A" 
                                           class="btn btn-primary">
                                            <i class="fa fa-reply me-2"></i> Balas via Email
                                        </a>
                                        ${contact.phone ? 
                                            `<a href="https://wa.me/${contact.phone.replace(/[^0-9]/g, '')}?text=Halo ${contact.name}, terima kasih telah menghubungi kami melalui website." 
                                               target="_blank" class="btn btn-success">
                                                <i class="fa fa-whatsapp me-2"></i> Balas via WhatsApp
                                            </a>` : ''
                                        }
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                
                document.getElementById('contactDetailContent').innerHTML = detailContent;
                new bootstrap.Modal(document.getElementById('contactDetailModal')).show();
            } catch (error) {
                console.error('Error parsing contact data:', error);
                alert('Gagal menampilkan detail kontak');
            }
        }

        // Copy contact info to clipboard
        function copyContactInfo(name, email, phone) {
            const contactInfo = `Nama: ${name}\nEmail: ${email}\nWhatsApp: ${phone || '-'}`;
            
            if (navigator.clipboard) {
                navigator.clipboard.writeText(contactInfo).then(() => {
                    showToast('Info kontak berhasil disalin ke clipboard!', 'success');
                });
            } else {
                // Fallback for older browsers
                const textArea = document.createElement('textarea');
                textArea.value = contactInfo;
                document.body.appendChild(textArea);
                textArea.select();
                document.execCommand('copy');
                document.body.removeChild(textArea);
                showToast('Info kontak berhasil disalin ke clipboard!', 'success');
            }
        }

        // Mark all as read (placeholder function)
        function markAllAsRead() {
            if (confirm('Tandai semua pesan sebagai sudah dibaca?')) {
                showToast('Semua pesan telah ditandai sebagai sudah dibaca!', 'success');
                // Here you can implement actual marking logic if needed
            }
        }

        // Refresh table
        function refreshTable() {
            location.reload();
        }

        // Show toast notification
        function showToast(message, type = 'info') {
            // Create toast element
            const toast = document.createElement('div');
            toast.className = `alert alert-${type} alert-dismissible fade show position-fixed`;
            toast.style.cssText = 'top: 20px; right: 20px; z-index: 9999; max-width: 350px;';
            toast.innerHTML = `
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            
            document.body.appendChild(toast);
            
            // Auto remove after 3 seconds
            setTimeout(() => {
                if (toast.parentNode) {
                    toast.parentNode.removeChild(toast);
                }
            }, 3000);
        }
    </script>
    
    <style>
        .contact-icon {
            font-size: 1.2rem;
        }
        
        .mini-stats-wid {
            border: none;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }
        
        .mini-stats-wid:hover {
            transform: translateY(-2px);
        }
        
        .mini-stat-icon {
            background: linear-gradient(45deg, #007bff, #0056b3) !important;
        }
        
        .mini-stat-icon.bg-success {
            background: linear-gradient(45deg, #28a745, #1e7e34) !important;
        }
        
        .mini-stat-icon.bg-warning {
            background: linear-gradient(45deg, #ffc107, #e0a800) !important;
        }
        
        .mini-stat-icon.bg-info {
            background: linear-gradient(45deg, #17a2b8, #117a8b) !important;
        }
        
        .message-preview {
            line-height: 1.4;
        }
        
        .table td {
            vertical-align: middle;
        }
        
        .dropdown-item:hover {
            background-color: #f8f9fa;
        }
        
        /* Custom scrollbar for message modal */
        .modal-body {
            max-height: 60vh;
            overflow-y: auto;
        }
        
        /* Responsive table */
        @media (max-width: 768px) {
            .table-responsive {
                font-size: 0.9rem;
            }
            
            .message-preview {
                max-width: 200px !important;
            }
        }
    </style>
    @endpush
</x-layouts.app>