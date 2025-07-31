<x-app-layout>
<div class="view-container">
    <div class="container py-5">
        <!-- Header -->
        <div class="header-card mb-4">
            <h2 class="fw-bold mb-1">Dashboard FKTL</h2>
            <p class="mb-0">Halo {{ Auth::user()->name }}, Anda login sebagai <strong>FKTL</strong>.</p>
        </div>

        <!-- Kartu Ringkasan -->
        <div class="row g-4 mb-4">
            <div class="col-md-4">
                <div class="summary-card">
                    <div class="card-icon" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="text-end">
                        <h6 class="text-muted mb-1">Total Peserta PRB</h6>
                        <h3 class="fw-bold mb-0">{{ $totalPeserta }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="summary-card">
                    <div class="card-icon" style="background: linear-gradient(135deg, #17ead9 0%, #6078ea 100%);">
                        <i class="fas fa-clinic-medical"></i>
                    </div>
                    <div class="text-end">
                        <h6 class="text-muted mb-1">Jumlah FKTP</h6>
                        <h3 class="fw-bold mb-0">{{ $fktpCount }}</h3>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="summary-card">
                     <div class="card-icon" style="background: linear-gradient(135deg, #ff9a9e 0%, #fecfef 100%);">
                        <i class="fas fa-hospital-user"></i>
                    </div>
                    <div class="text-end">
                        <h6 class="text-muted mb-1">FKTL Anda</h6>
                        <h3 class="fw-bold mb-0">{{ $fkrtlName }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Data Card -->
        <div class="data-card shadow-lg">
            <!-- Chart Section -->
            <div class="data-section">
                <h5 class="fw-bold mb-3"><i class="fas fa-chart-bar me-2"></i>Grafik Jumlah Peserta per FKTP</h5>
                <canvas id="chartPesertaFktp"></canvas>
            </div>

            <!-- Table Section -->
            <div class="data-section">
                <h5 class="fw-bold mb-3"><i class="fas fa-table me-2"></i>Data Peserta PRB di FKTL Anda</h5>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Nama Peserta</th>
                                <th>No. SEP</th>
                                <th>FKTP</th>
                                <th>Tanggal PRB</th>
                                <th>Status</th> {{-- Tambahkan ini --}}
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pesertaFktrl as $item)
                                <tr>
                                    <td>
                                        <div class="fw-bold">{{ $item->nama_peserta }}</div>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary-light">{{ $item->nomor_kartu_jkn ?? 'N/A' }}</span>
                                    </td>
                                    <td>{{ $item->fktp->nama_fktp ?? 'N/A' }}</td>
                                    <td>{{ $item->tanggal_prb ? \Carbon\Carbon::parse($item->tanggal_prb)->translatedFormat('d M Y') : '-' }}</td>
                                    <td>
                                        @php
                                            $statusClass = [
                                                'baru' => 'primary',
                                                'sedang_fktp' => 'warning',
                                                'sedang_apotek' => 'orange',
                                                'selesai' => 'success'
                                            ];
                                            $class = $statusClass[$item->status] ?? 'secondary';
                                        @endphp
                                       <span class="badge bg-{{ $class }} text-capitalize px-3 py-2">
                                            {{ str_replace('_', ' ', $item->status) }}
                                        </span>

                                    </td>
                                    <td class="text-center">
                                        <!-- TOMBOL AKSI INFO -->
                                        <a href="{{ route('rekrutmens.index', ['q' => $item->nomor_kartu_jkn]) }}" class="btn btn-sm btn-info-custom" title="Lihat Detail Peserta">
                                            <i class="fa fa-info-circle"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="text-center py-5">
                                            <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                                            <h6 class="text-muted">Belum ada data peserta.</h6>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .view-container {
        background-color: #f4f6f9;
        min-height: 100vh;
    }
    .header-card {
        background: linear-gradient(90deg, #6a7ee1 0%, #8a6ae1 100%);
        color: white;
        padding: 2rem;
        border-radius: 1rem;
    }
    .summary-card {
        background-color: white;
        border-radius: 1rem;
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: 1px solid #e9ecef;
    }
    .card-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
    }
    .data-card {
        background-color: white;
        border-radius: 1rem;
        overflow: hidden;
        border: 1px solid #e9ecef;
    }
    .data-section {
        padding: 2rem;
    }
    .data-section + .data-section {
        border-top: 1px solid #e9ecef;
    }
    .table {
        border-collapse: separate;
        border-spacing: 0 8px;
    }
    .table th, .table td {
        border-bottom: 1px solid #e9ecef;
        padding: 1rem;
    }
    .table thead { background-color: #f2f3ff; }
    .table th {
        font-weight: 600;
        color: #495057;
        text-transform: uppercase;
        font-size: 0.8rem;
    }
    .table tbody tr:hover {
        background-color: #f8f9fa;
        transform: scale(1.01);
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        z-index: 10;
        position: relative;
    }
    .btn-sm {
        width: 35px;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.5rem;
    }
    .btn-info-custom { background-color: #eef1ff; color: #6a7ee1; border: none; }
    .badge.bg-primary-light {
        background-color: rgba(106, 126, 225, 0.15) !important;
        color: #6a7ee1 !important;
        font-weight: 600;
        border-radius: 0.5rem;
        padding: 0.4rem 0.8rem;
    }
</style>

{{-- Chart Script --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chartPesertaFktp').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                label: 'Jumlah Peserta',
                data: @json($chartData),
                backgroundColor: 'rgba(106, 126, 225, 0.7)',
                borderColor: 'rgba(106, 126, 225, 1)',
                borderWidth: 1,
                borderRadius: 5
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>
</x-app-layout>
