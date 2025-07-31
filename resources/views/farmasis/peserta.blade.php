{{-- resources/views/farmasis/peserta.blade.php --}}
<x-app-layout>
<div class="view-container">
    <div class="container py-5">
        <!-- Main Data Card -->
        <div class="data-card shadow-lg">
            <!-- Data Header with Gradient -->
            <div class="data-header-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fw-bold mb-1">Daftar Peserta PRB</h5>
                        <p class="mb-0">Untuk: <strong>{{ $farmasi->nama_rs }}</strong></p>
                    </div>
                    <a href="{{ route('farmasis.index') }}" class="btn btn-outline-light-custom">
                        <i class="fas fa-arrow-left me-2"></i> Kembali
                    </a>
                </div>
            </div>

            <!-- Data Body -->
            <div class="data-body-card">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama Peserta</th>
                                <th scope="col">FKTP Asal</th>
                                <th scope="col">Nomor HP</th>
                                <th scope="col">Nomor SEP</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pesertas as $peserta)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="fw-bold">{{ $peserta->nama_peserta }}</div>
                                    </td>
                                    <td>{{ $peserta->fktp->nama_fktp ?? '-' }}</td>
                                    <td>{{ $peserta->nomor_hp }}</td>
                                    <td>
                                        <span class="badge bg-primary-light">{{ $peserta->nomor_kartu_jkn }}</span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="text-center py-5">
                                            <i class="fas fa-folder-open fa-3x text-muted mb-3"></i>
                                            <h6 class="text-muted">Belum ada peserta terdaftar.</h6>
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
    .data-card {
        background-color: white;
        border-radius: 1rem;
        overflow: hidden;
        border: 1px solid #e9ecef;
    }
    .data-header-card {
        /* PERUBAHAN: Menggunakan gradasi baru yang lebih lembut */
        background: linear-gradient(90deg, #6a7ee1 0%, #8a6ae1 100%);
        padding: 1.5rem 2rem;
        color: white;
    }
    .data-header-card h5 {
        color: white;
    }
    .data-header-card p {
        color: rgba(255, 255, 255, 0.8);
    }
    .data-body-card {
        padding: 1rem;
    }
    .table {
        border-collapse: separate;
        border-spacing: 0 8px;
    }
    .table th, .table td {
        border-bottom: 1px solid #e9ecef;
        padding: 1rem;
    }
    .table thead {
        /* PERUBAHAN: Warna header tabel disesuaikan */
        background-color: #f2f3ff;
    }
    .table th {
        font-weight: 600;
        color: #495057;
        text-transform: uppercase;
        font-size: 0.8rem;
    }
    .table tbody tr {
        transition: all 0.2s ease-in-out;
    }
    .table tbody tr:hover {
        background-color: #f8f9fa;
        transform: scale(1.01);
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
        z-index: 10;
        position: relative;
    }
    .btn-outline-light-custom {
        border-radius: 0.5rem;
        padding: 0.5rem 1rem;
        font-weight: 600;
        border: 2px solid white;
        color: white;
        transition: all 0.3s ease;
    }
    .btn-outline-light-custom:hover {
        background-color: white;
        /* PERUBAHAN: Warna teks hover disesuaikan */
        color: #6a7ee1;
    }
    .bg-primary-light {
        /* PERUBAHAN: Warna badge disesuaikan dengan gradasi baru */
        background-color: rgba(106, 126, 225, 0.15);
        color: #6a7ee1 !important;
        font-weight: 600;
        border-radius: 0.5rem;
        padding: 0.4rem 0.8rem;
    }
</style>
</x-app-layout>
