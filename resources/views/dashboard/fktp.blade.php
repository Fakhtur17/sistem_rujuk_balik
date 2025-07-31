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
                                    <i class="fas fa-hospital fa-3x"></i>
                                </div>
                            </div>
                            <div>
                                <h2 class="mb-1 fw-bold">Selamat datang, {{ Auth::user()->name }}!</h2>
                                <p class="mb-0 opacity-85 fs-5">Dashboard FKTP - {{ $fktpName }}</p>
                                <p class="mb-0 opacity-75">{{ now()->translatedFormat('l, d F Y') }}</p>
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
                        <div class="stats-icon bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                            <i class="fas fa-users text-primary fa-2x"></i>
                        </div>
                        <h3 class="fw-bold text-primary mb-1 counter" data-target="{{ $jumlahPeserta }}">0</h3>
                        <p class="text-muted mb-0 fw-medium">Total Peserta PRB</p>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 mb-3">
                <div class="stats-card card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="stats-icon bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                            <i class="fas fa-calendar-check text-success fa-2x"></i>
                        </div>
                        <h3 class="fw-bold text-success mb-1 counter" data-target="{{ $pesertaBulanIni }}">0</h3>
                        <p class="text-muted mb-0 fw-medium">Peserta Bulan Ini</p>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: {{ $pesertaBulanIni > 0 ? '100' : '0' }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-3 mb-3">
                <div class="stats-card card border-0 shadow-sm h-100">
                    <div class="card-body text-center p-4">
                        <div class="stats-icon bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
                            <i class="fas fa-chart-line text-warning fa-2x"></i>
                        </div>
                        <h3 class="fw-bold text-warning mb-1 counter" data-target="{{ $pesertaMingguIni }}">0</h3>
                        <p class="text-muted mb-0 fw-medium">Peserta Minggu Ini</p>
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
                            <i class="fas fa-user-plus text-info fa-2x"></i>
                        </div>
                        <h3 class="fw-bold text-info mb-1 counter" data-target="{{ $pesertaHariIni }}">0</h3>
                        <p class="text-muted mb-0 fw-medium">Peserta Hari Ini</p>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 60%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik Jumlah Peserta -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><i class="fas fa-chart-bar me-2"></i>Grafik Peserta PRB per FKRTL</h5>
                        <span class="badge bg-white text-primary">{{ count($chartLabels) }} FKRTL</span>
                    </div>
                    <div class="card-body p-4">
                        <!-- Debug info (hapus di production) -->
                        <div class="alert alert-info mb-3" id="debugInfo" style="display: none;">
                            <strong>Debug Info:</strong><br>
                            Labels: {{ json_encode($chartLabels) }}<br>
                            Data: {{ json_encode($chartData) }}
                        </div>
                        
                        <!-- Loading indicator -->
                        <div id="chartLoading" class="text-center p-4">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-2">Memuat grafik...</p>
                        </div>

                        <!-- Canvas untuk chart -->
                        <div style="position: relative; height: 250px; display: none;" id="chartContainer">
                            <canvas id="chartPesertaFktp"></canvas>
                        </div>

                        <!-- Pesan jika tidak ada data -->
                        @if($jumlahPeserta == 0)
                            <div class="alert alert-warning text-center" id="noDataMessage">
                                <i class="fas fa-info-circle fa-2x mb-3 text-warning"></i>
                                <h5><strong>Belum ada data peserta PRB</strong></h5>
                                <p class="mb-0">Grafik akan muncul setelah ada data peserta yang terdaftar di FKTP Anda.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Data Peserta -->
        @if($rekrutmenBaru->count() > 0)
        <div class="card shadow-sm mb-5">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fas fa-list me-2"></i>Data Peserta PRB</h5>
                <span class="badge bg-light text-dark">{{ $rekrutmenBaru->count() }} Total</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped table-hover mb-0">
                        <thead class="table-light sticky-top">
                            <tr>
                                <th class="text-center">No</th>
                                <th>Nama Peserta</th>
                                <th>No. SEP</th>
                                <th>FKTP</th>
                                <th>FKRTL Tujuan</th>
                                <th>Tanggal PRB</th>
                                <th>Waktu Relatif</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Aksi</th> <!-- Tambahan -->
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rekrutmenBaru as $index => $peserta)
                                <tr class="clickable-row" onclick="showPesertaDetail({{ $peserta->id }}, '{{ $peserta->nama_peserta }}', '{{ $peserta->nomor_kartu_jkn }}', '{{ $peserta->nama_fkrtl }}', '{{ $peserta->tanggal_prb }}')">
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle bg-primary text-white me-3">
                                                {{ substr($peserta->nama_peserta, 0, 1) }}
                                            </div>
                                            <strong>{{ $peserta->nama_peserta }}</strong>
                                        </div>
                                    </td>
                                    <td>{{ $peserta->nomor_kartu_jkn ?? '-' }}</td>
                                    <td>{{ $peserta->fktp->nama_fktp ?? '-' }}</td>
                                    <td>
                                        <span class="badge bg-primary">{{ $peserta->nama_fkrtl ?? '-' }}</span>
                                    </td>
                                    <td>
                                        @if($peserta->tanggal_prb)
                                            {{ \Carbon\Carbon::parse($peserta->tanggal_prb)->translatedFormat('d M Y') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-muted">
                                        @if($peserta->tanggal_prb)
                                            {{ \Carbon\Carbon::parse($peserta->tanggal_prb)->diffForHumans() }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $status = $peserta->status;
                                            $statusMap = [
                                                'baru' => ['label' => 'Baru', 'class' => 'bg-primary'],
                                                'sedang_fktp' => ['label' => 'Sedang FKTP', 'class' => 'bg-warning text-dark'],
                                                'sedang_apotek' => ['label' => 'Sedang Apotek', 'class' => 'bg-orange text-white'],
                                                'selesai' => ['label' => 'Selesai', 'class' => 'bg-success'],
                                            ];
                                            $statusClass = $statusMap[$status]['class'] ?? 'bg-secondary';
                                            $statusLabel = $statusMap[$status]['label'] ?? ucfirst($status);
                                        @endphp
                                        <span class="badge {{ $statusClass }} px-3 py-2">
                                            {{ $statusLabel }}
                                        </span>
                                    </td>
                                    <td class="text-center">
    <a href="{{ route('rekrutmens.index', ['q' => $peserta->nomor_kartu_jkn]) }}" class="btn btn-sm btn-info">
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

        <!-- Modal Detail Peserta -->
        <div class="modal fade" id="detailPesertaModal" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">
                            <i class="fas fa-user me-2"></i>
                            Detail Peserta PRB
                        </h5>
                        <button type="button" class="btn-close btn-close-white" onclick="closeDetailPesertaModal()"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-item mb-3">
                                    <label class="fw-bold text-muted">Nama Peserta:</label>
                                    <div id="detailNamaPeserta" class="fs-5 fw-bold text-primary"></div>
                                </div>
                                <div class="info-item mb-3">
                                    <label class="fw-bold text-muted">No. Kartu JKN:</label>
                                    <div id="detailNomorKartu" class="fs-6"></div>
                                </div>
                                <div class="info-item mb-3">
                                    <label class="fw-bold text-muted">FKRTL Tujuan:</label>
                                    <div id="detailFkrtl" class="fs-6"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item mb-3">
                                    <label class="fw-bold text-muted">Tanggal PRB:</label>
                                    <div id="detailTanggalPrb" class="fs-6"></div>
                                </div>
                                <div class="info-item mb-3">
                                    <label class="fw-bold text-muted">ID Peserta:</label>
                                    <div id="detailIdPeserta" class="fs-6"></div>
                                </div>
                                <div class="info-item mb-3">
                                    <label class="fw-bold text-muted">Status:</label>
                                    <div id="detailStatusPeserta" class="fs-6"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="closeDetailPesertaModal()">
                            <i class="fas fa-times me-2"></i>Tutup
                        </button>
                        <button type="button" class="btn btn-primary" onclick="editPeserta()">
                            <i class="fas fa-edit me-2"></i>Edit Data
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
        
        .clickable-row {
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .clickable-row:hover {
            background-color: rgba(0,123,255,0.1) !important;
            transform: scale(1.01);
        }

        .avatar-circle {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 14px;
        }

        .counter {
            font-size: 2.5rem;
        }

        .modal-content {
            border-radius: 15px;
        }

        .info-item {
            padding: 10px;
            background: rgba(0,0,0,0.02);
            border-radius: 8px;
        }

        .progress {
            border-radius: 10px;
        }
        
        .progress-bar {
            border-radius: 10px;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0,123,255,0.05);
            transition: all 0.2s ease;
        }

        .loading {
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>

    <!-- Enhanced JavaScript -->
    <script>
        // Global variables
        let currentPesertaId = null;
        let isModalOpen = false;

        // Document ready
        document.addEventListener('DOMContentLoaded', function() {
            initializeCounters();
            initializeChart();
            
            // Show debug info (remove in production)
            // document.getElementById('debugInfo').style.display = 'block';
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

        // Initialize chart
        function initializeChart() {
            // Data dari controller
            const chartLabels = @json($chartLabels);
            const chartData = @json($chartData);
            const jumlahPeserta = {{ $jumlahPeserta }};
            
            console.log('=== CHART DEBUG ===');
            console.log('Chart Labels:', chartLabels);
            console.log('Chart Data:', chartData);
            console.log('Jumlah Peserta:', jumlahPeserta);
            console.log('===================');

            // Sembunyikan loading
            const loadingElement = document.getElementById('chartLoading');
            const chartContainer = document.getElementById('chartContainer');
            const noDataMessage = document.getElementById('noDataMessage');

            setTimeout(() => {
                if (loadingElement) {
                    loadingElement.style.display = 'none';
                }

                // Jika tidak ada data, tampilkan pesan
                if (jumlahPeserta === 0 || chartData.length === 0 || chartData.every(val => val === 0)) {
                    if (noDataMessage) {
                        noDataMessage.style.display = 'block';
                    }
                    return;
                }

                // Tampilkan chart container
                if (chartContainer) {
                    chartContainer.style.display = 'block';
                }

                // Inisialisasi chart
                const ctx = document.getElementById('chartPesertaFktp');
                if (ctx) {
                    try {
                        const myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: chartLabels,
                                datasets: [{
                                    label: 'Jumlah Peserta',
                                    data: chartData,
                                    backgroundColor: [
                                        'rgba(13, 110, 253, 0.8)',
                                        'rgba(25, 135, 84, 0.8)',
                                        'rgba(255, 193, 7, 0.8)',
                                        'rgba(220, 53, 69, 0.8)',
                                        'rgba(111, 66, 193, 0.8)',
                                        'rgba(13, 202, 240, 0.8)',
                                        'rgba(255, 133, 27, 0.8)',
                                        'rgba(25, 135, 84, 0.8)',
                                        'rgba(253, 126, 20, 0.8)',
                                        'rgba(214, 51, 132, 0.8)'
                                    ],
                                    borderColor: [
                                        'rgba(13, 110, 253, 1)',
                                        'rgba(25, 135, 84, 1)',
                                        'rgba(255, 193, 7, 1)',
                                        'rgba(220, 53, 69, 1)',
                                        'rgba(111, 66, 193, 1)',
                                        'rgba(13, 202, 240, 1)',
                                        'rgba(255, 133, 27, 1)',
                                        'rgba(25, 135, 84, 1)',
                                        'rgba(253, 126, 20, 1)',
                                        'rgba(214, 51, 132, 1)'
                                    ],
                                    borderWidth: 2,
                                    borderRadius: 6,
                                    borderSkipped: false
                                }]
                            },
                            options: {
                                indexAxis: 'x', // Grafik horizontal
                                responsive: true,
                                maintainAspectRatio: false,
                                plugins: {
                                    legend: {
                                        display: false
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function(context) {
                                                return `${context.parsed.x} peserta`;
                                            }
                                        }
                                    }
                                },
                                scales: {
                                    x: {
                                        beginAtZero: true,
                                        ticks: {
                                            stepSize: 1,
                                            callback: function(value) {
                                                if (Math.floor(value) === value) {
                                                                                                        return value;
                                                }
                                            }
                                        },
                                        title: {
                                            display: true,
                                            text: 'Jumlah Peserta',
                                            color: '#6c757d',
                                            font: {
                                                weight: 'bold'
                                            }
                                        },
                                        grid: {
                                            color: 'rgba(0,0,0,0.05)'
                                        }
                                    },
                                    y: {
                                        title: {
                                            display: true,
                                            text: 'FKRTL',
                                            color: '#6c757d',
                                            font: {
                                                weight: 'bold'
                                            }
                                        },
                                        grid: {
                                            color: 'rgba(0,0,0,0.03)'
                                        },
                                        ticks: {
                                            color: '#343a40',
                                            font: {
                                                weight: 'bold'
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    } catch (error) {
                        console.error('Gagal membuat chart:', error);
                    }
                }
            }, 1000); // Delay untuk loading animasi
        }

        // Modal Detail Peserta
        function showPesertaDetail(id, nama, kartu, fkrtl, tanggal) {
            currentPesertaId = id;
            isModalOpen = true;

            document.getElementById('detailIdPeserta').textContent = id;
            document.getElementById('detailNamaPeserta').textContent = nama;
            document.getElementById('detailNomorKartu').textContent = kartu;
            document.getElementById('detailFkrtl').textContent = fkrtl;
            document.getElementById('detailTanggalPrb').textContent = tanggal;

            const statusText = tanggal ? 'Aktif' : 'Pending';
            const statusColor = tanggal ? 'text-success' : 'text-warning';
            document.getElementById('detailStatusPeserta').innerHTML = `<span class="${statusColor}">${statusText}</span>`;

            const modal = new bootstrap.Modal(document.getElementById('detailPesertaModal'));
            modal.show();
        }

        function closeDetailPesertaModal() {
            isModalOpen = false;
            const modalElement = document.getElementById('detailPesertaModal');
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            modalInstance.hide();
        }

        function editPeserta() {
            if (currentPesertaId) {
                window.location.href = `/rekrutmens/${currentPesertaId}/edit`;
            }
        }
    </script>
    <!-- Tambahkan CDN Chart.js di bagian paling bawah -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</x-app-layout>
