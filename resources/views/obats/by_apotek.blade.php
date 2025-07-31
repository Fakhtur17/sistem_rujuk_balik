{{-- resources/views/obats/byApotek.blade.php --}}
<x-app-layout>
<div class="view-container">
    <div class="container py-5">
        <!-- Main Data Card -->
        <div class="data-card shadow-lg">
            <!-- Data Header with Gradient -->
            <div class="data-header-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fw-bold mb-1">Daftar Obat di Apotek</h5>
                        <p class="mb-0">Apotek: <strong>{{ $apotek->nama_apotek }}</strong></p>
                    </div>
                    <a href="{{ route('obats.createForApotek', $apotek->id) }}" class="btn btn-outline-light-custom">
                        <i class="fas fa-plus me-2"></i> Tambah Obat
                    </a>
                </div>
            </div>

            <!-- Data Body -->
            <div class="data-body-card">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">No</th>
                                <th scope="col">Nama Obat</th>
                                <th scope="col">Sediaan</th>
                                <th scope="col" class="text-center">Stok</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($obats as $index => $obat)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="fw-bold">{{ $obat->nama_obat }}</div>
                                    </td>
                                    <td>{{ $obat->kategori ?? '-' }}</td>
                                    <td class="text-center">
                                        <span class="badge bg-stock-custom">{{ $obat->stok }}</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('obats.edit', $obat->id) }}" class="btn btn-sm btn-warning-custom" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('obats.destroy', $obat->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus obat ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger-custom" title="Hapus">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="text-center py-5">
                                            <i class="fas fa-pills fa-3x text-muted mb-3"></i>
                                            <h6 class="text-muted">Belum ada data obat untuk apotek ini.</h6>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                     <a href="{{ route('apoteks.index') }}" class="btn btn-outline-secondary">
                        <i class="fa fa-arrow-left me-1"></i> Kembali ke Daftar Apotek
                    </a>
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
        background: linear-gradient(90deg, #6a7ee1 0%, #8a6ae1 100%);
        padding: 1.5rem 2rem;
        color: white;
    }
    .data-header-card h5 { color: white; }
    .data-header-card p { color: rgba(255, 255, 255, 0.8); }
    .data-body-card { padding: 2rem; }
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
        color: #6a7ee1;
    }
    .btn-sm {
        width: 35px;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 0.5rem;
    }
    .btn-warning-custom { background-color: #fff4e6; color: #ff9f43; border: none; }
    .btn-danger-custom { background-color: #ffe6e6; color: #ea5455; border: none; }
    .badge.bg-stock-custom {
        background-color: #eef1ff !important;
        color: #6a7ee1 !important;
        font-weight: 600;
        border-radius: 0.5rem;
        padding: 0.4rem 0.8rem;
        font-size: 0.9rem;
    }
</style>
</x-app-layout>
