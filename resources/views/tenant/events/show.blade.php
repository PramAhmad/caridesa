<x-layouts.app>
    @push('css')
    <style>
        .event-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem 0;
            margin-bottom: 2rem;
        }
        
        .event-status-badge {
            font-size: 0.9rem;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-weight: 500;
        }
        
        .event-info-card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 12px;
            transition: transform 0.3s ease;
        }
        
        .event-info-card:hover {
            transform: translateY(-2px);
        }
        
        .info-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            margin-right: 1rem;
        }
        
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }
        
        .gallery-item {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        
        .gallery-item:hover {
            transform: scale(1.05);
        }
        
        .gallery-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
        
        .gallery-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.7) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            display: flex;
            align-items: flex-end;
            padding: 1rem;
        }
        
        .gallery-item:hover .gallery-overlay {
            opacity: 1;
        }
        
        .gallery-info {
            color: white;
            font-size: 0.9rem;
        }
        
        .countdown-card {
            background: linear-gradient(135deg, #ff6b6b, #ffa500);
            color: white;
            border-radius: 15px;
            padding: 1.5rem;
            text-align: center;
        }
        
        .countdown-number {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 0.5rem;
        }
        
        .countdown-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }
        
        .description-content {
            line-height: 1.7;
            font-size: 1.1rem;
            color: #4a5568;
        }
        
        .no-images {
            text-align: center;
            padding: 3rem;
            color: #a0aec0;
        }
        
        .no-images i {
            font-size: 4rem;
            margin-bottom: 1rem;
        }
    </style>
    @endpush
    
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Detail Acara</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="/admin/events">
                                Acara
                            </a>
                        </li>
                        <li class="breadcrumb-item active">{{ $event->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <!-- Event Header -->
        <div class="event-header rounded-3 mb-4">
            <div class="container-fluid px-4">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="d-flex align-items-center mb-3">
                            <span class="event-status-badge bg-{{ $event->status_color }} me-3">
                                {{ $event->status_label }}
                            </span>
                            @if($event->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Nonaktif</span>
                            @endif
                        </div>
                        <h1 class="display-5 fw-bold mb-3">{{ $event->name }}</h1>
                        <p class="lead mb-0">{{ $event->human_date_range }}</p>
                        @if($event->time_until_start)
                            <p class="mt-2 mb-0"><strong>{{ $event->time_until_start }}</strong></p>
                        @endif
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <div class="d-flex flex-column gap-2">
                            <a href="/admin/events/{{ $event->slug }}/edit" class="btn btn-warning">
                                <i class="fa fa-edit me-2"></i> Edit Acara
                            </a>
                            <button class="btn btn-outline-light" onclick="confirmToggleStatus()">
                                <i class="fa fa-toggle-{{ $event->is_active ? 'on' : 'off' }} me-2"></i>
                                {{ $event->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <!-- Description -->
                <div class="card event-info-card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">📝 Deskripsi Acara</h5>
                    </div>
                    <div class="card-body">
                        <div class="description-content">
                            {!! nl2br(e($event->description)) !!}
                        </div>
                    </div>
                </div>

                <!-- Image Gallery -->
                <div class="card event-info-card">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">📸 Galeri Foto ({{ $event->images_count }})</h5>
                    </div>
                    <div class="card-body">
                        @if($event->has_images)
                            <div class="gallery-grid">
                                @foreach($event->images as $image)
                                <div class="gallery-item">
                                    <img src="{{ $image->url }}" alt="{{ $event->name }}" loading="lazy">
                                    <div class="gallery-overlay">
                                        <div class="gallery-info">
                                            <div class="fw-semibold">{{ $image->file_name }}</div>
                                            <div class="small">{{ $image->formatted_file_size }}</div>
                                            @if($image->formatted_dimensions)
                                                <div class="small">{{ $image->formatted_dimensions }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="no-images">
                                <i class="fa fa-images"></i>
                                <h5>Belum ada foto</h5>
                                <p class="text-muted">Foto acara belum ditambahkan</p>
                                <a href="/admin/events/{{ $event->slug }}/edit" class="btn btn-primary">
                                    <i class="fa fa-plus me-2"></i> Tambah Foto
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="col-lg-4">
                <!-- Countdown or Duration Info -->
                @if($event->is_upcoming)
                <div class="countdown-card mb-4">
                    <h5 class="mb-3">⏰ Waktu Hingga Acara</h5>
                    <div id="countdown" data-start="{{ $event->start_date->timestamp }}">
                        <div class="row">
                            <div class="col-6">
                                <div class="countdown-number" id="days">0</div>
                                <div class="countdown-label">Hari</div>
                            </div>
                            <div class="col-6">
                                <div class="countdown-number" id="hours">0</div>
                                <div class="countdown-label">Jam</div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="card event-info-card mb-4">
                    <div class="card-body text-center">
                        <h5 class="card-title">⏱️ Durasi Acara</h5>
                        <p class="card-text display-6">{{ $event->formatted_duration }}</p>
                        @if($event->is_multi_day)
                            <small class="text-muted">Acara multi-hari</small>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Event Details -->
                <div class="card event-info-card mb-4">
                    <div class="card-header bg-info text-white">
                        <h6 class="mb-0">ℹ️ Informasi Detail</h6>
                    </div>
                    <div class="card-body">
                        <!-- Date & Time -->
                        <div class="d-flex align-items-center mb-3">
                            <div class="info-icon bg-primary text-white">
                                📅
                            </div>
                            <div>
                                <strong>Tanggal & Waktu</strong>
                                <br>
                                <span class="text-muted">{{ $event->date_range }}</span>
                            </div>
                        </div>

                        <!-- Location -->
                        <div class="d-flex align-items-center mb-3">
                            <div class="info-icon bg-success text-white">
                                📍
                            </div>
                            <div>
                                <strong>Lokasi</strong>
                                <br>
                                <span class="text-muted">{{ $event->location }}</span>
                            </div>
                        </div>

                        <!-- Organizer -->
                        @if($event->organizer)
                        <div class="d-flex align-items-center mb-3">
                            <div class="info-icon bg-warning text-white">
                                👥
                            </div>
                            <div>
                                <strong>Penyelenggara</strong>
                                <br>
                                <span class="text-muted">{{ $event->organizer }}</span>
                            </div>
                        </div>
                        @endif

                        <!-- Contact Phone -->
                        @if($event->contact_phone)
                        <div class="d-flex align-items-center mb-3">
                            <div class="info-icon bg-info text-white">
                                📞
                            </div>
                            <div>
                                <strong>Telepon</strong>
                                <br>
                                <a href="tel:{{ $event->contact_phone }}" class="text-decoration-none">
                                    {{ $event->contact_phone }}
                                </a>
                            </div>
                        </div>
                        @endif

                        <!-- Contact Email -->
                        @if($event->contact_email)
                        <div class="d-flex align-items-center mb-3">
                            <div class="info-icon bg-secondary text-white">
                                ✉️
                            </div>
                            <div>
                                <strong>Email</strong>
                                <br>
                                <a href="mailto:{{ $event->contact_email }}" class="text-decoration-none">
                                    {{ $event->contact_email }}
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Event Meta -->
                <div class="card event-info-card">
                    <div class="card-header bg-dark text-white">
                        <h6 class="mb-0">🔍 Meta Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-6">
                                <div class="fw-bold text-primary">{{ $event->id }}</div>
                                <small class="text-muted">Event ID</small>
                            </div>
                            <div class="col-6">
                                <div class="fw-bold text-success">{{ $event->images_count }}</div>
                                <small class="text-muted">Total Foto</small>
                            </div>
                        </div>
                        <hr>
                        <div class="small text-muted">
                            <div><strong>Slug:</strong> {{ $event->slug }}</div>
                            <div><strong>Dibuat:</strong> {{ $event->created_at->format('d M Y, H:i') }}</div>
                            <div><strong>Diperbarui:</strong> {{ $event->updated_at->format('d M Y, H:i') }}</div>
                            <div><strong>Hari:</strong> {{ $event->start_day_indonesian }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="btn-group" role="group">
                            <a href="/admin/events" class="btn btn-outline-secondary">
                                <i class="fa fa-arrow-left me-2"></i> Kembali ke Daftar
                            </a>
                            <a href="/admin/events/{{ $event->slug }}/edit" class="btn btn-primary">
                                <i class="fa fa-edit me-2"></i> Edit Acara
                            </a>
                            <button class="btn btn-outline-warning" onclick="confirmToggleStatus()">
                                <i class="fa fa-toggle-{{ $event->is_active ? 'on' : 'off' }} me-2"></i>
                                {{ $event->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                            </button>
                            <button class="btn btn-outline-danger" onclick="confirmDelete()">
                                <i class="fa fa-trash me-2"></i> Hapus Acara
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    <!-- Hidden Forms -->
    <form id="toggle-status-form" action="/admin/events/{{ $event->slug }}/toggle-status" method="POST" style="display: none;">
        @csrf
        @method('PATCH')
    </form>

    <form id="delete-form" action="/admin/events/{{ $event->slug }}" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>

    @push('script')
    <script>
        // Countdown Timer (for upcoming events)
        @if($event->is_upcoming)
        function updateCountdown() {
            const startTime = document.getElementById('countdown').dataset.start * 1000;
            const now = new Date().getTime();
            const distance = startTime - now;

            if (distance > 0) {
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                document.getElementById('days').textContent = days;
                document.getElementById('hours').textContent = hours;
            } else {
                document.getElementById('countdown').innerHTML = '<div class="text-center"><h5>🎉 Acara telah dimulai!</h5></div>';
            }
        }

        // Update countdown every second
        updateCountdown();
        setInterval(updateCountdown, 1000);
        @endif

        // Confirm toggle status
        function confirmToggleStatus() {
            const action = {{ $event->is_active ? 'false' : 'true' }};
            const message = action ? 'mengaktifkan' : 'menonaktifkan';
            
            if (confirm(`Apakah Anda yakin ingin ${message} acara ini?`)) {
                document.getElementById('toggle-status-form').submit();
            }
        }

        // Confirm delete
        function confirmDelete() {
            if (confirm('Apakah Anda yakin ingin menghapus acara ini? Semua data dan gambar akan dihapus permanen.')) {
                if (confirm('Konfirmasi sekali lagi: Hapus acara "{{ $event->name }}"?')) {
                    document.getElementById('delete-form').submit();
                }
            }
        }

        // Gallery lightbox effect (simple implementation)
        document.querySelectorAll('.gallery-item img').forEach(img => {
            img.addEventListener('click', function() {
                const modal = document.createElement('div');
                modal.style.cssText = `
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(0,0,0,0.9);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    z-index: 9999;
                    cursor: pointer;
                `;
                
                const modalImg = document.createElement('img');
                modalImg.src = this.src;
                modalImg.style.cssText = `
                    max-width: 90%;
                    max-height: 90%;
                    object-fit: contain;
                    border-radius: 8px;
                `;
                
                modal.appendChild(modalImg);
                document.body.appendChild(modal);
                
                modal.addEventListener('click', () => {
                    document.body.removeChild(modal);
                });
            });
        });
    </script>
    @endpush
</x-layouts.app>