<x-app-layout>
    <div class="container-fluid px-4 py-4">
        <!-- Modern Header with Gradient -->
        <div class="header-section mb-4">
            <div class="text-center">
                <div class="header-gradient p-4 rounded-3 mb-3">
                    <h2 class="text-white fw-bold mb-1">📊 Data Rekrutmen Peserta PRB</h2>
                    <p class="text-white-50 mb-0">Sistem Manajemen Kota Tegal</p>
                </div>
            </div>
        </div>

        <!-- Enhanced Control Panel -->
        <div class="control-panel-card mb-4">
            <div class="card border-0 shadow-lg">
                <div class="card-body p-4">
                    <div class="row align-items-center">
                        <div class="col-lg-4 col-md-6 mb-3 mb-lg-0">
                            <a href="{{ route('rekrutmens.create') }}" class="btn btn-primary btn-lg px-4 shadow-sm">
                                <i class="fas fa-plus-circle me-2"></i>
                                <span>Tambah Data Baru</span>
                            </a>
                        </div>
                        <div class="col-lg-8 col-md-6">
                            <form action="{{ route('rekrutmens.index') }}" method="GET">
                                <div class="input-group input-group-lg">
                                    <span class="input-group-text bg-light border-0">
                                        <i class="fas fa-search text-primary"></i>
                                    </span>
                                    <input type="text" name="q" class="form-control border-0 shadow-sm" 
                                           placeholder="🔍 Cari berdasarkan nama peserta atau nomor JKN..." 
                                           value="{{ request('q') }}" 
                                           maxlength="13" autofocus>
                                    <button class="btn btn-primary px-4" type="submit">
                                        <i class="fas fa-search me-1"></i> Cari
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Notifications -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-3" role="alert">
                <div class="d-flex align-items-center">
                    <div class="alert-icon me-3">
                        <i class="fas fa-check-circle fa-2x text-success"></i>
                    </div>
                    <div>
                        <h6 class="alert-heading mb-1">Berhasil!</h6>
                        <p class="mb-0">{{ session('success') }}</p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <!-- Enhanced Empty State -->
        @if(!request('q'))
            <div class="empty-state-card">
                <div class="card border-0 bg-gradient-light">
                    <div class="card-body text-center py-5">
                        <div class="empty-state-icon mb-3">
                            <i class="fas fa-search fa-4x text-primary opacity-75"></i>
                        </div>
                        <h5 class="text-dark mb-2">Mulai Pencarian Data</h5>
                        <p class="text-muted mb-0">Masukkan <strong>Nama Peserta</strong> atau <strong>Nomor JKN</strong> pada kolom pencarian di atas</p>
                    </div>
                </div>
            </div>
        @endif

        <!-- Enhanced Search Results -->
        @if(request('q'))
            <div class="search-results-header mb-4">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-filter text-primary me-2"></i>
                        <span class="text-muted">Hasil pencarian untuk: <strong class="text-primary">{{ request('q') }}</strong></span>
                    </div>
                    <div class="text-muted small">
                        <i class="fas fa-list me-1"></i> {{ $rekrutmens->total() }} data ditemukan
                    </div>
                </div>
            </div>

            @forelse ($rekrutmens as $data)
                <div class="patient-card mb-4">
                    <div class="card border-0 shadow-lg hover-card">
                        <div class="card-body p-4">
                            <!-- Enhanced Header -->
                            <div class="patient-header mb-4">
                                <div class="row align-items-center">
                                    <div class="col-md-8">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-circle me-3">
                                                <i class="fas fa-user-md text-white"></i>
                                            </div>
                                            <div>
                                                <h5 class="text-primary mb-1 fw-bold">{{ $data->nama_peserta }}</h5>
                                                <div class="d-flex align-items-center">
                                                    <i class="fas fa-id-card text-muted me-2"></i>
                                                    <span class="text-muted">{{ $data->nomor_kartu_jkn }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <div class="status-badge">
                                            <span class="badge bg-success-gradient px-3 py-2">
                                                <i class="fas fa-calendar-alt me-1"></i>
                                                {{ \Carbon\Carbon::parse($data->tanggal_prb)->format('d M Y') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Enhanced Detail Info -->
                            <div class="patient-details mb-4">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <div class="info-icon">
                                                <i class="fas fa-phone text-success"></i>
                                            </div>
                                            <div class="info-content">
                                                <small class="text-muted">Nomor HP</small>
                                                <div class="fw-medium">{{ $data->nomor_hp }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <div class="info-icon">
                                                <i class="fas fa-clinic-medical text-info"></i>
                                            </div>
                                            <div class="info-content">
                                                <small class="text-muted">FKTP</small>
                                                <div class="fw-medium">{{ $data->fktp }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <div class="info-icon">
                                                <i class="fas fa-hospital text-warning"></i>
                                            </div>
                                            <div class="info-content">
                                                <small class="text-muted">FKRTL</small>
                                                <div class="fw-medium">{{ $data->nama_fkrtl }}</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-item">
                                            <div class="info-icon">
                                                <i class="fas fa-external-link-alt text-primary"></i>
                                            </div>
                                            <div class="info-content">
                                                <small class="text-muted">Link SRB</small>
                                                <div>
                                                    <a href="{{ $data->link_srb }}" target="_blank" class="btn btn-sm btn-outline-primary">
                                                        <i class="fas fa-eye me-1"></i> Lihat SRB
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Enhanced Action Buttons -->
                            <div class="action-buttons mb-4">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('rekrutmens.edit', $data->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit me-1"></i> Edit Data
                                    </a>
                                    <form action="{{ route('rekrutmens.destroy', $data->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Enhanced Kunjungan FKTP Section -->
                            <div class="visit-section mb-4">
                                <div class="section-header">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="section-title">
                                            <i class="fas fa-calendar-check text-info me-2"></i>
                                            Riwayat Kunjungan FKTP
                                        </h6>
                                        <a href="{{ route('kunjungan_fktp.create', ['rekrutmen' => $data->id, 'q' => request('q')]) }}" 
                                           class="btn btn-info btn-sm">
                                            <i class="fas fa-plus me-1"></i> Tambah Kunjungan
                                        </a>
                                    </div>
                                </div>
                                
                                @if ($data->kunjunganFktp->count())
                                    <div class="visit-timeline">
                                        @foreach ($data->kunjunganFktp as $kunjungan)
                                            <div class="visit-item">
                                                <span class="visit-badge bg-info">
                                                    <i class="fas fa-stethoscope me-1"></i>
                                                    Kunjungan ke-{{ $kunjungan->kunjungan_ke }}
                                                </span>
                                                <span class="visit-date">
                                                    {{ \Carbon\Carbon::parse($kunjungan->tanggal_kunjungan)->format('d/m/Y') }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="empty-visits">
                                        <i class="fas fa-info-circle text-muted me-2"></i>
                                        <span class="text-muted">Belum ada kunjungan FKTP tercatat</span>
                                    </div>
                                @endif
                            </div>

                            <!-- Enhanced Kunjungan Apotek Section -->
                            <div class="visit-section">
                                <div class="section-header">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="section-title">
                                            <i class="fas fa-capsules text-danger me-2"></i>
                                            Riwayat Kunjungan Apotek
                                        </h6>
                                        <a href="{{ route('kunjungan_apotek.create', ['rekrutmen' => $data->id, 'q' => request('q')]) }}" 
                                           class="btn btn-danger btn-sm">
                                            <i class="fas fa-plus me-1"></i> Tambah Kunjungan
                                        </a>
                                    </div>
                                </div>

                                @if ($data->kunjunganApotek->count())
                                    <div class="visit-timeline">
                                        @foreach ($data->kunjunganApotek as $ka)
                                            <div class="visit-item">
                                                <span class="visit-badge bg-danger">
                                                    <i class="fas fa-pills me-1"></i>
                                                    {{ $ka->nama_apotek }}
                                                </span>
                                                <span class="visit-date">
                                                    {{ \Carbon\Carbon::parse($ka->tanggal_kunjungan)->format('d/m/Y') }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="empty-visits">
                                        <i class="fas fa-info-circle text-muted me-2"></i>
                                        <span class="text-muted">Belum ada kunjungan apotek tercatat</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="no-results-card">
                    <div class="card border-0 bg-light">
                        <div class="card-body text-center py-5">
                            <div class="no-results-icon mb-3">
                                <i class="fas fa-search-minus fa-4x text-muted opacity-50"></i>
                            </div>
                            <h5 class="text-muted mb-2">Data Tidak Ditemukan</h5>
                            <p class="text-muted mb-0">Coba gunakan kata kunci yang berbeda</p>
                        </div>
                    </div>
                </div>
            @endforelse

            <!-- Enhanced Pagination -->
            @if($rekrutmens->hasPages())
                <div class="pagination-wrapper mt-5">
                    <div class="d-flex justify-content-center">
                        {{ $rekrutmens->appends(['q' => request('q')])->links() }}
                    </div>
                </div>
            @endif
        @endif
    </div>

    <!-- Enhanced Custom CSS -->
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --success-gradient: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            --info-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --warning-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --danger-gradient: linear-gradient(135deg, #fc466b 0%, #3f5efb 100%);
        }

        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .header-gradient {
            background: var(--primary-gradient);
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
        }

        .control-panel-card .card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
        }

        .bg-gradient-light {
            background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
        }

        .patient-card .card {
            border-radius: 20px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
        }

        .hover-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        }

        .avatar-circle {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--primary-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }

        .bg-success-gradient {
            background: var(--success-gradient) !important;
            box-shadow: 0 4px 15px rgba(17, 153, 142, 0.3);
        }

        .info-item {
            display: flex;
            align-items: center;
            padding: 15px;
            background: rgba(248, 249, 250, 0.8);
            border-radius: 15px;
            border-left: 4px solid transparent;
            transition: all 0.3s ease;
        }

        .info-item:hover {
            background: rgba(255, 255, 255, 0.9);
            transform: translateX(5px);
        }

        .info-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            background: rgba(255, 255, 255, 0.9);
            font-size: 16px;
        }

        .section-title {
            font-weight: 600;
            color: #2d3748;
            margin: 0;
        }

        .visit-timeline {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .visit-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 15px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 25px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .visit-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .visit-badge {
            font-size: 12px;
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 500;
            color: white;
        }

        .visit-date {
            font-size: 13px;
            color: #6c757d;
            font-weight: 500;
        }

        .empty-visits {
            padding: 20px;
            background: rgba(248, 249, 250, 0.8);
            border-radius: 15px;
            text-align: center;
        }

        .btn {
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-group .btn {
            border-radius: 8px;
        }

        .btn-group .btn:first-child {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
        }

        .btn-group .btn:last-child {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        .alert {
            border-radius: 15px;
            border: none;
        }

        .alert-icon {
            opacity: 0.8;
        }

        .empty-state-icon, .no-results-icon {
            opacity: 0.6;
        }

        .pagination-wrapper .pagination {
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .pagination .page-link {
            border: none;
            margin: 0 2px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .pagination .page-link:hover {
            background: var(--primary-gradient);
            color: white;
            transform: translateY(-2px);
        }

        .pagination .page-item.active .page-link {
            background: var(--primary-gradient);
            border: none;
        }

        @media (max-width: 768px) {
            .container-fluid {
                padding: 15px;
            }
            
            .patient-header .row {
                text-align: center;
            }
            
            .patient-header .col-md-4 {
                margin-top: 15px;
            }
            
            .visit-timeline {
                flex-direction: column;
            }
            
            .action-buttons .btn-group {
                flex-direction: column;
                width: 100%;
            }
            
            .action-buttons .btn {
                border-radius: 8px !important;
                margin-bottom: 5px;
            }
        }
    </style>
</x-app-layout>