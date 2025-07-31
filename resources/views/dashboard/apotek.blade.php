<x-app-layout>
    <div class="container-fluid mt-4">
        <!-- Header Welcome dengan animasi -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="welcome-card card border-0 shadow-lg bg-gradient-primary text-white overflow-hidden">
                    <div class="card-body py-5 position-relative">
                        <div class="floating-shapes">
                            <div class="shape shape-1"></div>
                            <div class="shape shape-2"></div>
                            <div class="shape shape-3"></div>
                        </div>
                        <div class="d-flex align-items-center position-relative">
                            <div class="me-4">
                                <div class="icon-wrapper">
                                    <i class="fas fa-user-md fa-3x"></i>
                                </div>
                            </div>
                            <div>
                                <h2 class="mb-1 fw-bold">Selamat datang, {{ Auth::user()->name }}!</h2>
                                <p class="mb-0 opacity-85 fs-5">Dashboard Apotek PRB - {{ now()->format('l, d F Y') }}</p>
                                <div class="mt-2">
                                    <span class="badge bg-white text-primary px-3 py-2">
                                        <i class="fas fa-clock me-1"></i>
                                        {{ now()->format('H:i') }} WIB
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Stats Cards -->
        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <div class="stats-card card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="stats-icon bg-danger bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                            <i class="fas fa-pills text-danger fa-2x"></i>
                        </div>
                        <h3 class="fw-bold text-danger mb-1 counter" data-target="{{ $jumlahObatKosong }}">0</h3>
                        <p class="text-muted mb-0 fw-medium">Obat Stok Kosong</p>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>

            
            <div class="col-md-3 mb-3">
                <div class="stats-card card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="stats-icon bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                            <i class="fas fa-stethoscope text-success fa-2x"></i>
                        </div>
                        <h3 class="fw-bold text-success mb-1 counter" data-target="{{ $kunjunganFktp->count() }}">0</h3>
                        <p class="text-muted mb-0 fw-medium">Daftar Kunjungan Apotek</p>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $kunjunganFktp->count() > 0 ? '100' : '0' }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-3">
                <div class="stats-card card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="stats-icon bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                            <i class="fas fa-calendar-check text-warning fa-2x"></i>
                        </div>
                        <h3 class="fw-bold text-warning mb-1 counter" data-target="{{ $kunjunganFktp->where('tanggal_kunjungan', '>=', now()->startOfMonth())->count() }}">0</h3>
                        <p class="text-muted mb-0 fw-medium">Kunjungan Bulan Ini</p>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 75%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="stats-card card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="stats-icon bg-info bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                            <i class="fas fa-chart-line text-info fa-2x"></i>
                        </div>
                        <h3 class="fw-bold text-info mb-1 counter" data-target="{{ $kunjunganFktp->where('tanggal_kunjungan', '>=', now()->subDays(7))->count() }}">0</h3>
                        <p class="text-muted mb-0 fw-medium">Kunjungan Minggu Ini</p>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 60%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

  @if($kunjunganFktp->count())
<div class="card shadow-sm mb-5">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="fas fa-list me-2"></i>Daftar Kunjungan </h5>
        <span class="badge bg-light text-dark">{{ $kunjunganFktp->count() }} Total</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Nama Peserta</th>
                        <th>No. SEP</th>
                        <th>No. HP</th>
                        <th>FKTP</th>
                        <th>FKRTL</th>
                        <th>Kunjungan Ke</th>
                        <th>Tanggal</th>
                        <th>Hari</th>
                        <th>Waktu Relatif</th>
                        <th class="text-center">Status PRB</th>
                        <th>Peserta</th> <!-- Tambahan -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($kunjunganFktp as $index => $kunjungan)
                        @php
                            $tanggal = \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan);
                            $isRecent = $tanggal->isAfter(now()->subDays(7));
                            $status = $kunjungan->rekrutmen->status ?? '-';
                            $badgeClass = match($status) {
                                'baru' => 'secondary',
                                'sedang_fkrtl' => 'warning',
                                'sedang_apotek' => 'info',
                                'selesai' => 'success',
                                default => 'dark',
                            };
                        @endphp
                        <tr>
                            <td class="text-center">{{ $index + 1 }}</td>
                            <td>{{ $kunjungan->rekrutmen->nama_peserta ?? '-' }}</td>
                            <td>{{ $kunjungan->rekrutmen->nomor_kartu_jkn ?? '-' }}</td>
                            <td>{{ $kunjungan->rekrutmen->nomor_hp ?? '-' }}</td>
                            <td>{{ $kunjungan->rekrutmen->fktp->nama_fktp ?? '-' }}</td>
                            <td>{{ $kunjungan->rekrutmen->nama_fkrtl ?? '-' }}</td>
                            <td><span class="badge bg-primary fs-6">{{ $kunjungan->kunjungan_ke }}</span></td>
                            <td>{{ $tanggal->format('d/m/Y') }}</td>
                            <td>{{ $tanggal->translatedFormat('l') }}</td>
                            <td class="text-muted">{{ $tanggal->diffForHumans() }}</td>
                            <td class="text-center">
                                <span class="badge bg-{{ $badgeClass }} px-3 py-2">
                                    {{ ucfirst(str_replace('_', ' ', $status)) }}
                                </span>
                            </td>
                            {{-- Tombol Detail --}}
                                    <td>
                                        <a href="{{ route('rekrutmens.index', ['q' => $kunjungan->rekrutmen->nomor_kartu_jkn ?? '']) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-info-circle me-1"></i> Detail
                                        </a>

                                    </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif


    <!-- Enhanced Custom Styles -->
    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .welcome-card {
            border-radius: 20px;
            overflow: hidden;
            position: relative;
        }
        
        .floating-shapes {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            pointer-events: none;
            z-index: 1;
        }
        
        .shape {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }
        
        .shape-1 {
            width: 80px;
            height: 80px;
            top: 20%;
            right: 10%;
            animation-delay: 0s;
        }
        
        .shape-2 {
            width: 60px;
            height: 60px;
            top: 60%;
            right: 20%;
            animation-delay: 2s;
        }
        
        .shape-3 {
            width: 40px;
            height: 40px;
            top: 80%;
            right: 30%;
            animation-delay: 4s;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        
        .icon-wrapper {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            padding: 20px;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        .stats-card {
            transition: all 0.3s ease;
            border-radius: 15px;
        }
        
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
        }
        
        .stats-icon {
            transition: transform 0.3s ease;
        }
        
        .stats-card:hover .stats-icon {
            transform: scale(1.1) rotate(5deg);
        }
        
        .visit-card {
            border-radius: 15px;
            border-left: 4px solid #007bff;
            transition: all 0.3s ease;
            animation: slideInUp 0.6s ease-out;
        }
        
        .visit-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
            border-left-color: #0056b3;
        }

        .clickable-card {
            cursor: pointer;
        }

        .clickable-card:hover {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .clickable-row {
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .clickable-row:hover {
            background-color: rgba(0,123,255,0.1) !important;
            transform: scale(1.01);
        }
        
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .modal-content {
            border-radius: 20px;
        }
        
        .modal-header {
            border-top-left-radius: 20px;
            border-top-right-radius: 20px;
        }
        
        .table-hover tbody tr:hover {
            background-color: rgba(0,123,255,0.05);
            transition: all 0.2s ease;
        }
        
        .counter {
            font-size: 2.5rem;
        }
        
        .btn {
            transition: all 0.3s ease;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        
        .progress {
            border-radius: 10px;
        }
        
        .progress-bar {
            border-radius: 10px;
        }
        
        .card {
            border-radius: 15px;
        }
        
        .badge {
            font-size: 0.8em;
        }
        
        .alert {
            border-radius: 12px;
        }

        /* Modal backdrop fix */
        .modal-backdrop {
            z-index: 1040;
        }
        
        .modal {
            z-index: 1050;
        }

        /* Animasi untuk modal */
        .modal.fade .modal-dialog {
            transform: scale(0.8);
            transition: transform 0.3s ease-out;
        }
        
        .modal.show .modal-dialog {
            transform: scale(1);
        }

        /* Hover effect untuk cards */
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        /* Loading animation */
        .loading {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive improvements */
        @media (max-width: 768px) {
            .stats-card {
                margin-bottom: 1rem;
            }
            
            .welcome-card .card-body {
                padding: 2rem 1rem;
            }
            
            .modal-dialog {
                margin: 1rem;
            }
        }

        /* Notification styles */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
        }

        /* Interactive elements */
        .interactive-element {
            position: relative;
            overflow: hidden;
        }

        .interactive-element::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
            transition: left 0.5s;
        }

        .interactive-element:hover::before {
            left: 100%;
        }
    </style>

    <!-- Enhanced JavaScript -->
    <script>
        // Global variables
        let currentKunjunganId = null;
        let isModalOpen = false;

        // Document ready
        document.addEventListener('DOMContentLoaded', function() {
            initializeCounters();
            initializeTooltips();
            initializeModals();
            
            // Add escape key listener
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeAllModals();
                }
            });
        });

        // Counter animation
        function initializeCounters() {
            const counters = document.querySelectorAll('.counter');
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                let current = 0;
                const increment = target / 50;
                
                const updateCounter = () => {
                    if (current < target) {
                        current += increment;
                        counter.textContent = Math.ceil(current);
                        setTimeout(updateCounter, 30);
                    } else {
                        counter.textContent = target;
                    }
                };
                
                updateCounter();
            });
        }

        // Initialize tooltips
        function initializeTooltips() {
            const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        }

        // Initialize modals
        function initializeModals() {
            // Add click outside to close
            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('modal')) {
                    closeAllModals();
                }
            });
        }

        // Modal functions
        function openKunjunganModal() {
            const modal = document.getElementById('kunjunganModal');
            if (modal) {
                modal.classList.add('show');
                modal.style.display = 'block';
                document.body.classList.add('modal-open');
                
                // Create backdrop
                const backdrop = document.createElement('div');
                backdrop.className = 'modal-backdrop fade show';
                backdrop.id = 'kunjunganModalBackdrop';
                document.body.appendChild(backdrop);
                
                isModalOpen = true;
                
                // Add animation
                setTimeout(() => {
                    modal.querySelector('.modal-dialog').style.transform = 'scale(1)';
                }, 10);
            }
        }

        function closeKunjunganModal() {
            const modal = document.getElementById('kunjunganModal');
            const backdrop = document.getElementById('kunjunganModalBackdrop');
            
            if (modal) {
                modal.classList.remove('show');
                modal.style.display = 'none';
                document.body.classList.remove('modal-open');
                
                if (backdrop) {
                    backdrop.remove();
                }
                
                isModalOpen = false;
            }
        }

        function openStatistikModal() {
            const modal = document.getElementById('statistikModal');
            if (modal) {
                modal.classList.add('show');
                modal.style.display = 'block';
                document.body.classList.add('modal-open');
                
                // Create backdrop
                const backdrop = document.createElement('div');
                backdrop.className = 'modal-backdrop fade show';
                backdrop.id = 'statistikModalBackdrop';
                document.body.appendChild(backdrop);
                
                isModalOpen = true;
            }
        }

        function closeStatistikModal() {
            const modal = document.getElementById('statistikModal');
            const backdrop = document.getElementById('statistikModalBackdrop');
            
            if (modal) {
                modal.classList.remove('show');
                modal.style.display = 'none';
                document.body.classList.remove('modal-open');
                
                if (backdrop) {
                    backdrop.remove();
                }
                
                isModalOpen = false;
            }
        }

        function showKunjunganDetail(id, kunjunganKe, tanggal, hari) {
            currentKunjunganId = id;
            
            // Close previous modal if open
            closeKunjunganModal();
            
            // Populate detail modal
            document.getElementById('detailKunjunganKe').innerHTML = `<span class="badge bg-primary fs-5">${kunjunganKe}</span>`;
            document.getElementById('detailTanggal').innerHTML = `<span class="text-primary fw-bold">${tanggal}</span>`;
            document.getElementById('detailHari').innerHTML = `<span class="text-success">${hari}</span>`;
            document.getElementById('detailId').innerHTML = `<code>#${id}</code>`;
            
            // Calculate status
            const now = new Date();
            const kunjunganDate = new Date(tanggal);
            const diffTime = Math.abs(now - kunjunganDate);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            
            let statusBadge = '';
            let waktuRelatif = '';
            
            if (diffDays <= 7) {
                statusBadge = '<span class="badge bg-success fs-6 px-3 py-2">Baru</span>';
                waktuRelatif = `${diffDays} hari yang lalu`;
            } else if (diffDays <= 30) {
                statusBadge = '<span class="badge bg-warning fs-6 px-3 py-2">Sedang</span>';
                waktuRelatif = `${diffDays} hari yang lalu`;
            } else {
                statusBadge = '<span class="badge bg-secondary fs-6 px-3 py-2">Lama</span>';
                waktuRelatif = `${Math.floor(diffDays/30)} bulan yang lalu`;
            }
            
            document.getElementById('detailStatus').innerHTML = statusBadge;
            document.getElementById('detailWaktuRelatif').innerHTML = waktuRelatif;
            
            // Open detail modal
            const modal = document.getElementById('detailKunjunganModal');
            if (modal) {
                modal.classList.add('show');
                modal.style.display = 'block';
                document.body.classList.add('modal-open');
                
                // Create backdrop
                const backdrop = document.createElement('div');
                backdrop.className = 'modal-backdrop fade show';
                backdrop.id = 'detailKunjunganModalBackdrop';
                document.body.appendChild(backdrop);
                
                isModalOpen = true;
            }
        }

        function closeDetailKunjunganModal() {
            const modal = document.getElementById('detailKunjunganModal');
            const backdrop = document.getElementById('detailKunjunganModalBackdrop');
            
            if (modal) {
                modal.classList.remove('show');
                modal.style.display = 'none';
                document.body.classList.remove('modal-open');
                
                if (backdrop) {
                    backdrop.remove();
                }
                
                isModalOpen = false;
                currentKunjunganId = null;
            }
        }

        function closeAllModals() {
            closeKunjunganModal();
            closeStatistikModal();
            closeDetailKunjunganModal();
        }

        function editKunjungan() {
            if (currentKunjunganId) {
                showNotification('Fitur edit akan segera tersedia!', 'info');
                // Here you can add logic to redirect to edit page
                // window.location.href = `/kunjungan/${currentKunjunganId}/edit`;
            }
        }

        // Notification system
        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `alert alert-${type} alert-dismissible fade show notification`;
            notification.innerHTML = `
                <strong>${type === 'success' ? 'Berhasil!' : type === 'info' ? 'Info!' : 'Peringatan!'}</strong>
                ${message}
                <button type="button" class="btn-close" onclick="this.parentElement.remove()"></button>
            `;
            
            document.body.appendChild(notification);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.remove();
                }
            }, 5000);
        }

        // Add smooth scrolling
        function smoothScrollTo(element) {
            element.scrollIntoView({ behavior: 'smooth' });
        }

        // Add loading state
        function showLoading(button) {
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="fas fa-spinner loading me-2"></i>Loading...';
            button.disabled = true;
            
            setTimeout(() => {
                button.innerHTML = originalText;
                button.disabled = false;
            }, 1000);
        }

        // Add interactive effects
        function addInteractiveEffects() {
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                    this.style.boxShadow = '0 10px 30px rgba(0,0,0,0.15)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = '';
                });
            });
        }

        // Initialize interactive effects when DOM is loaded
        document.addEventListener('DOMContentLoaded', addInteractiveEffects);

        // Add keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (isModalOpen) {
                if (e.key === 'Enter') {
                    const activeModal = document.querySelector('.modal.show');
                    if (activeModal) {
                        const primaryButton = activeModal.querySelector('.btn-primary');
                        if (primaryButton) {
                            primaryButton.click();
                        }
                    }
                }
            }
        });

        // Performance optimization
        function debounce(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // Optimized resize handler
        const handleResize = debounce(() => {
            // Handle responsive changes
            const cards = document.querySelectorAll('.stats-card');
            cards.forEach(card => {
                if (window.innerWidth < 768) {
                    card.style.marginBottom = '1rem';
                } else {
                    card.style.marginBottom = '';
                }
            });
        }, 250);

        window.addEventListener('resize', handleResize);
    </script>
</x-app-layout>