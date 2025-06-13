<x-layouts.app>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Database Backups</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/tenant">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">Settings</li>
                        <li class="breadcrumb-item active">Backups</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Tambah Backup</h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <p class="mb-0">Buat backup baru dari database atau seluruh aplikasi Anda. Backup akan disimpan dengan aman dan dapat diunduh atau dipulihkan nanti.</p>
                                <div class="alert alert-warning mt-3">
                                    <i class="fa fa-exclamation-triangle me-2"></i>
                                    Membuat backup mungkin memerlukan waktu dan dapat sementara mempengaruhi kinerja aplikasi.
                                </div>
                            </div>
                            <div class="col-md-4 text-end">
                                <form action="/tenant/settings/backups/create" method="POST">
                                    @csrf
                                    <div class="d-grid gap-2">
                                        <button type="submit" class="btn btn-primary" name="only_db" value="1">
                                            <i class="fa fa-database me-1"></i> Backup Database Saja
                                        </button>
                                        <button type="submit" class="btn btn-outline-primary">
                                            <i class="fa fa-save me-1"></i> Backup Files & Database
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">Backup Tersedia</h5>
                            <div>
                                <button type="button" class="btn btn-sm btn-outline-info refresh-btn">
                                    <i class="fa fa-sync-alt me-1"></i> Refresh
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($backups->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama File</th>
                                
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($backups as $backup)
                                    <tr>
                                        <td>{{ basename($backup['name']) }}</td>
                               
                                        <td>
                                            <div class="btn-group" role="group">
                                                <a href="/tenant/settings/backups/download/{{ basename($backup['name']) }}" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="fa fa-download me-1"></i> Download
                                                </a>
                                                
                                                <button type="button" 
                                                        class="btn btn-sm btn-outline-warning"
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#restoreModal" 
                                                        data-backup-name="{{ basename($backup['name']) }}">
                                                    <i class="fa fa-undo me-1"></i> Restore
                                                </button>
                                                
                                                <button type="button" 
                                                        class="btn btn-sm btn-outline-danger"
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#deleteModal" 
                                                        data-backup-name="{{ basename($backup['name']) }}">
                                                    <i class="fa fa-trash me-1"></i> Delete
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="text-center py-4">
                            <div class="mb-3">
                                <i class="fa fa-database fa-3x text-muted"></i>
                            </div>
                            <h5>Tidak Ada Backup Tersedia</h5>
                            <p class="text-muted">Anda belum membuat backup apapun. Gunakan opsi di atas untuk membuat backup pertama Anda.</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <h5 class="card-title mb-0">Informasi Backup</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="mb-3">Apa yang dibackup?</h6>
                                <ul class="list-unstyled">
                                    <li><i class="fa fa-check-circle text-success me-2"></i> Rekaman dan struktur database</li>
                                    <li><i class="fa fa-check-circle text-success me-2"></i> File yang diunggah pengguna</li>
                                    <li><i class="fa fa-check-circle text-success me-2"></i> Pengaturan aplikasi</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <h6 class="mb-3">Praktik Terbaik Backup</h6>
                                <ul class="list-unstyled">
                                    <li><i class="fa fa-info-circle text-info me-2"></i> Buat backup secara teratur (setidaknya mingguan)</li>
                                    <li><i class="fa fa-info-circle text-info me-2"></i> Unduh dan simpan backup di beberapa lokasi</li>
                                    <li><i class="fa fa-info-circle text-info me-2"></i> Uji pemulihan dari backup secara berkala</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Backup</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the backup <strong id="delete-backup-name"></strong>?</p>
                    <p class="text-danger">This action cannot be undone.</p>
                </div>
                <div class="modal-footer">
                    <form id="delete-form" action="/tenant/settings/backups/delete/" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete Backup</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Restore Modal -->
    <div class="modal fade" id="restoreModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Restore from Backup</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger">
                        <h6 class="alert-heading">Warning: Data Loss Risk!</h6>
                        <p>Restoring from a backup will <strong>replace all current data</strong> with the data from the backup.</p>
                        <p>This operation cannot be undone. For safety, a new backup of the current state will be created before restoring.</p>
                    </div>
                    <p>Are you sure you want to restore from backup <strong id="restore-backup-name"></strong>?</p>
                </div>
                <div class="modal-footer">
                    <form id="restore-form" action="/tenant/settings/backups/restore/" method="POST">
                        @csrf
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning">Yes, Restore</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Delete modal
            $('#deleteModal').on('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const backupName = button.getAttribute('data-backup-name');
                document.getElementById('delete-backup-name').textContent = backupName;
                document.getElementById('delete-form').action = '/tenant/settings/backups/delete/' + backupName;
            });
            
            // Restore modal
            $('#restoreModal').on('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const backupName = button.getAttribute('data-backup-name');
                document.getElementById('restore-backup-name').textContent = backupName;
                document.getElementById('restore-form').action = '/tenant/settings/backups/restore/' + backupName;
            });
            
            // Refresh button
            document.querySelector('.refresh-btn').addEventListener('click', function() {
                window.location.reload();
            });
        });
    </script>
    @endpush
</x-layouts.app>