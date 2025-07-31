{{-- resources/views/pic-prbs/index.blade.php --}}
<x-app-layout>
<div class="view-container">
    <div class="container py-5">
        <!-- Main Data Card -->
        <div class="data-card shadow-lg">
            <!-- Data Header with Gradient -->
            <div class="data-header-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="fw-bold mb-1">Daftar PIC Program Rujuk Balik</h5>
                        <p class="mb-0">Manajemen data penanggung jawab PRB.</p>
                    </div>
                    @if(auth()->user() && auth()->user()->role === 'admin')
                        <a href="{{ route('pic-prbs.create') }}" class="btn btn-outline-light-custom">
                            <i class="fas fa-plus me-2"></i> Tambah PIC
                        </a>
                    @endif
                </div>
            </div>


            <!-- Data Body -->
            <div class="data-body-card">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <!-- Form Pencarian -->
                <form action="{{ route('pic-prbs.index') }}" method="GET" class="mb-4">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" name="search" class="form-control" placeholder="Cari berdasarkan nama PIC..." value="{{ request('search') }}">
                        <button type="submit" class="btn btn-gradient-primary">
                            Cari
                        </button>
                    </div>
                </form>

                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">No</th>
                                <th scope="col">Nama PIC</th>
                                <th scope="col" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($picPrbs as $index => $pic)
                                <tr>
                                    <td class="text-center">{{ $picPrbs->firstItem() + $index }}</td>
                                    <td>
                                        <div class="fw-bold">{{ $pic->nama_pic }}</div>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('pic-prbs.show', $pic->id) }}" class="btn btn-sm btn-info-custom" title="Lihat Detail Faskes">
                                            <i class="fa fa-info-circle"></i>
                                        </a>

                                        @if(auth()->user() && auth()->user()->role === 'admin')
                                            <a href="{{ route('pic-prbs.edit', $pic->id) }}" class="btn btn-sm btn-warning-custom" title="Edit">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                            <form action="{{ route('pic-prbs.destroy', $pic->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus PIC ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger-custom" title="Hapus">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3">
                                        <div class="text-center py-5">
                                            <i class="fas fa-user-tie fa-3x text-muted mb-3"></i>
                                            <h6 class="text-muted">Belum ada data PIC.</h6>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($picPrbs->hasPages())
                    <div class="d-flex justify-content-center mt-4">
                        {{ $picPrbs->links() }}
                    </div>
                @endif
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
    .btn-gradient-primary {
        background: linear-gradient(90deg, #6a7ee1 0%, #8a6ae1 100%);
        border: none;
        color: white;
        transition: all 0.3s ease;
    }
    .btn-gradient-primary:hover {
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(106, 126, 225, 0.3);
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
    .btn-warning-custom { background-color: #fff4e6; color: #ff9f43; border: none; }
    .btn-danger-custom { background-color: #ffe6e6; color: #ea5455; border: none; }
</style>
</x-app-layout>
