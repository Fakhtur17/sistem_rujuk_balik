{{-- resources/views/apoteks/index.blade.php --}}
<x-app-layout>
<div class="view-container">
    <div class="container-fluid py-4">
        <!-- Main Data Card -->
        <div class="data-card">
            <!-- Enhanced Data Header with Better Gradient -->
            <div class="data-header-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="header-content">
                        <div class="header-icon">
                            <i class="fas fa-clinic-medical"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-1 header-title">Daftar Apotek PRB & Tambah Obat Kosong </h4>
                            <p class="mb-0 header-subtitle">Manajemen data apotek terdaftar di seluruh wilayah</p>
                        </div>
                    </div>
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('apoteks.create') }}" class="btn btn-add-new">
                            <i class="fas fa-plus me-2"></i> 
                            <span>Tambah Apotek</span>
                        </a>
                    @endif
                </div>
            </div>

            <!-- Enhanced Data Body -->
            <div class="data-body-card">
                @if(session('success'))
                    <div class="alert alert-success-custom">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Enhanced Search Form -->
                <div class="search-section">
                    <form action="{{ route('apoteks.index') }}" method="GET" class="search-form">
                        <div class="search-grid">
                            <div class="search-item">
                                <label class="search-label">Nama Apotek</label>
                                <div class="input-group search-input-group">
                                    <span class="input-group-text search-icon">
                                        <i class="fas fa-pills"></i>
                                    </span>
                                    <input type="text" name="nama" class="form-control search-input" 
                                           placeholder="Masukkan nama apotek..." value="{{ request('nama') }}">
                                </div>
                            </div>
                            <div class="search-item">
                                <label class="search-label">Kota/Kabupaten</label>
                                <div class="input-group search-input-group">
                                    <span class="input-group-text search-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                    <input type="text" name="kota" class="form-control search-input" 
                                           placeholder="Masukkan kota/kabupaten..." value="{{ request('kota') }}">
                                </div>
                            </div>
                            <div class="search-item search-button-container">
                                <button type="submit" class="btn btn-search">
                                    <i class="fas fa-search me-2"></i>
                                    <span>Cari Data</span>
                                </button>
                                @if(request('nama') || request('kota'))
                                    <a href="{{ route('apoteks.index') }}" class="btn btn-reset">
                                        <i class="fas fa-times me-2"></i>
                                        <span>Reset</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Enhanced Statistics -->
                <div class="stats-section">
                    <div class="stats-card">
                        <div class="stats-icon">
                            <i class="fas fa-clinic-medical"></i>
                        </div>
                        <div class="stats-content">
                            <h6>Total Apotek</h6>
                            <h4>{{ $apoteks->total() }}</h4>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Table -->
                <div class="table-section">
                    <div class="table-responsive">
                        <table class="table modern-table">
                            <thead>
                                <tr>
                                    <th class="table-number">No</th>
                                    <th class="table-main">Informasi Apotek</th>
                                    <th class="table-location">Wilayah</th>
                                    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'apoteks')
                                        <th class="table-actions">Aksi</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($apoteks as $index => $apotek)
                                    <tr class="table-row">
                                        <td class="number-cell">
                                            <span class="number-badge">{{ $apoteks->firstItem() + $loop->index }}</span>
                                        </td>
                                        <td class="main-cell">
                                            <div class="apotek-info">
                                                <div class="apotek-icon">
                                                    <i class="fas fa-clinic-medical"></i>
                                                </div>
                                                <div class="apotek-details">
                                                    <h6 class="apotek-name">{{ $apotek->nama_apotek }}</h6>
                                                    <span class="apotek-type">Apotek PRB</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="location-cell">
                                            <div class="location-info">
                                                <i class="fas fa-map-marker-alt location-icon"></i>
                                                <span class="location-text">{{ $apotek->kota_kabupaten }}</span>
                                            </div>
                                        </td>
                                        <td class="actions-cell">
                                            <div class="action-buttons">
                                                {{-- Tambah Obat Kosong (hanya untuk admin dan apoteks) --}}
                                                @if(auth()->user()->role === 'admin' || auth()->user()->role === 'apoteks')
                                                    <a href="{{ route('obats.byApotek', $apotek->id) }}" 
                                                    class="btn btn-sm btn-info text-white d-inline-flex align-items-center" 
                                                    title="Lihat Daftar Obat" data-bs-toggle="tooltip">
                                                        <i class="fas fa-info-circle me-1"></i> Tambah Obat Kosong
                                                    </a>
                                                @endif

                                                {{-- Aksi Admin (Edit dan Hapus Apotek) --}}
                                                @if(auth()->user()->role === 'admin')
                                                    {{-- Edit --}}
                                                    <a href="{{ route('apoteks.edit', $apotek->id) }}" 
                                                    class="btn btn-action btn-edit-action" 
                                                    title="Edit Apotek" data-bs-toggle="tooltip">
                                                        <i class="fas fa-edit"></i>
                                                    </a>

                                                    {{-- Hapus --}}
                                                    <form action="{{ route('apoteks.destroy', $apotek->id) }}" 
                                                        method="POST" class="d-inline delete-form" 
                                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus apotek ini?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-action btn-delete-action" 
                                                                title="Hapus Apotek" data-bs-toggle="tooltip">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="empty-state">
                                            <div class="empty-content">
                                                <div class="empty-icon">
                                                    <i class="fas fa-clinic-medical"></i>
                                                </div>
                                                <h5 class="empty-title">Belum Ada Data Apotek</h5>
                                                <p class="empty-subtitle">Data apotek belum tersedia atau tidak ditemukan berdasarkan pencarian Anda</p>
                                                @if(auth()->user()->role === 'admin')
                                                    <a href="{{ route('apoteks.create') }}" class="btn btn-add-first">
                                                        <i class="fas fa-plus me-2"></i>
                                                        Tambah Apotek Pertama
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Enhanced Pagination -->
                    @if($apoteks->hasPages())
                        <div class="pagination-section">
                            <div class="pagination-info">
                                <span>Menampilkan {{ $apoteks->firstItem() }} - {{ $apoteks->lastItem() }} dari {{ $apoteks->total() }} data</span>
                            </div>
                            <div class="pagination-wrapper">
                                {{ $apoteks->appends(request()->query())->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Base Styles */
.view-container {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
    min-height: 100vh;
    padding: 0;
}

.container-fluid {
    max-width: 1400px;
}

/* Main Card */
.data-card {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    border: 1px solid rgba(255,255,255,0.2);
    backdrop-filter: blur(10px);
}

/* Enhanced Header */
.data-header-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    padding: 2rem 2.5rem;
    position: relative;
    overflow: hidden;
}

.data-header-card::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 200px;
    height: 200px;
    background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
    border-radius: 50%;
    transform: translate(50px, -50px);
}

.header-content {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.header-icon {
    width: 60px;
    height: 60px;
    background: rgba(255,255,255,0.2);
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    color: white;
}

.header-title {
    color: white;
    font-size: 1.5rem;
    margin: 0;
}

.header-subtitle {
    color: rgba(255,255,255,0.9);
    font-size: 0.95rem;
    margin: 0;
}

/* Add Button */
.btn-add-new {
    background: rgba(255,255,255,0.2);
    border: 2px solid rgba(255,255,255,0.3);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
    backdrop-filter: blur(10px);
}

.btn-add-new:hover {
    background: white;
    color: #667eea;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
}

/* Data Body */
.data-body-card {
    padding: 2.5rem;
}

/* Success Alert */
.alert-success-custom {
    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
    border: none;
    border-radius: 12px;
    color: #155724;
    padding: 1rem 1.5rem;
    margin-bottom: 2rem;
    border-left: 4px solid #28a745;
}

/* Search Section */
.search-section {
    background: #f8f9ff;
    border-radius: 15px;
    padding: 2rem;
    margin-bottom: 2rem;
    border: 1px solid #e3e6f0;
}

.search-grid {
    display: grid;
    grid-template-columns: 1fr 1fr auto;
    gap: 1.5rem;
    align-items: end;
}

.search-label {
    display: block;
    font-weight: 600;
    color: #495057;
    margin-bottom: 0.5rem;
    font-size: 0.9rem;
}

.search-input-group {
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    border-radius: 10px;
    overflow: hidden;
}

.search-icon {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    width: 45px;
}

.search-input {
    border: 2px solid #e3e6f0;
    border-left: none;
    padding: 0.75rem 1rem;
    font-size: 0.95rem;
    transition: all 0.3s ease;
}

.search-input:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

.search-button-container {
    display: flex;
    gap: 0.5rem;
}

.btn-search {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.3s ease;
    white-space: nowrap;
}

.btn-search:hover {
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
}

.btn-reset {
    background: #6c757d;
    border: none;
    color: white;
    padding: 0.75rem 1rem;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-reset:hover {
    background: #545b62;
    color: white;
    transform: translateY(-2px);
}

/* Stats Section */
.stats-section {
    margin-bottom: 2rem;
}

.stats-card {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 1.5rem;
    border-radius: 15px;
    display: flex;
    align-items: center;
    gap: 1rem;
    max-width: 250px;
}

.stats-icon {
    width: 50px;
    height: 50px;
    background: rgba(255,255,255,0.2);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
}

.stats-content h6 {
    margin: 0;
    opacity: 0.9;
    font-size: 0.9rem;
}

.stats-content h4 {
    margin: 0;
    font-weight: bold;
    font-size: 1.8rem;
}

/* Table Section */
.table-section {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
}

.modern-table {
    margin: 0;
    border-collapse: separate;
    border-spacing: 0;
}

.modern-table thead {
    background: linear-gradient(135deg, #f8f9ff 0%, #e3e6f0 100%);
}

.modern-table th {
    padding: 1.25rem;
    font-weight: 700;
    color: #495057;
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 0.5px;
    border: none;
    position: sticky;
    top: 0;
    z-index: 10;
}

.table-number { width: 80px; text-align: center; }
.table-main { width: 45%; }
.table-location { width: 25%; text-align: center; }
.table-actions { width: 180px; text-align: center; }

/* Table Rows */
.table-row {
    transition: all 0.3s ease;
    border-bottom: 1px solid #f1f3f4;
}

.table-row:hover {
    background: linear-gradient(135deg, #f8f9ff 0%, #f0f2ff 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
}

.table-row td {
    padding: 1.5rem 1.25rem;
    border: none;
    vertical-align: middle;
}

/* Number Cell */
.number-cell {
    text-align: center;
}

.number-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 35px;
    height: 35px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 50%;
    font-weight: 600;
    font-size: 0.9rem;
}

/* Main Cell */
.apotek-info {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.apotek-icon {
    width: 45px;
    height: 45px;
    background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
    color: #1976d2;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    flex-shrink: 0;
}

.apotek-name {
    margin: 0;
    font-weight: 600;
    color: #2c3e50;
    font-size: 1rem;
}

.apotek-type {
    color: #6c757d;
    font-size: 0.85rem;
    font-weight: 500;
}

/* Location Cell */
.location-info {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
}

.location-icon {
    color: #dc3545;
    font-size: 0.9rem;
}

.location-text {
    font-weight: 500;
    color: #495057;
}

/* Action Buttons */
.action-buttons {
    display: flex;
    gap: 0.5rem;
    justify-content: center;
    align-items: center;
}

.btn-action {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    border: none;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    font-size: 0.9rem;
}

.btn-info-action {
    background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
    color: #1976d2;
}

.btn-info-action:hover {
    background: #1976d2;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(25, 118, 210, 0.3);
}

.btn-edit-action {
    background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 100%);
    color: #f57c00;
}

.btn-edit-action:hover {
    background: #f57c00;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(245, 124, 0, 0.3);
}

.btn-delete-action {
    background: linear-gradient(135deg, #ffebee 0%, #ffcdd2 100%);
    color: #d32f2f;
}

.btn-delete-action:hover {
    background: #d32f2f;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(211, 47, 47, 0.3);
}

/* Empty State */
.empty-state {
    padding: 4rem 2rem;
}

.empty-content {
    text-align: center;
}

.empty-icon {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, #f8f9ff 0%, #e3e6f0 100%);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    font-size: 2rem;
    color: #6c757d;
}

.empty-title {
    color: #495057;
    margin-bottom: 0.5rem;
    font-weight: 600;
}

.empty-subtitle {
    color: #6c757d;
    margin-bottom: 1.5rem;
    font-size: 0.95rem;
}

.btn-add-first {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 10px;
    font-weight: 600;
    transition: all 0.3s ease;
}

.btn-add-first:hover {
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
}

/* Pagination */
.pagination-section {
    display: flex;
    justify-content: between;
    align-items: center;
    padding: 1.5rem 2rem;
    background: #f8f9ff;
    border-top: 1px solid #e3e6f0;
    flex-wrap: wrap;
    gap: 1rem;
}

.pagination-info {
    color: #6c757d;
    font-size: 0.9rem;
    flex: 1;
}

.pagination-wrapper {
    flex: 1;
    text-align: right;
}

/* Responsive Design */
@media (max-width: 1200px) {
    .search-grid {
        grid-template-columns: 1fr 1fr;
    }
    
    .search-button-container {
        grid-column: 1 / -1;
        justify-content: center;
    }
}

@media (max-width: 768px) {
    .container-fluid {
        padding: 1rem;
    }
    
    .data-header-card {
        padding: 1.5rem;
    }
    
    .header-content {
        flex-direction: column;
        text-align: center;
        gap: 1rem;
    }
    
    .data-body-card {
        padding: 1.5rem;
    }
    
    .search-section {
        padding: 1.5rem;
    }
    
    .search-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .table-responsive {
        font-size: 0.9rem;
    }
    
    .apotek-info {
        flex-direction: column;
        text-align: center;
        gap: 0.5rem;
    }
    
    .location-info {
        flex-direction: column;
        gap: 0.25rem;
    }
    
    .action-buttons {
        flex-wrap: wrap;
    }
    
    .pagination-section {
        flex-direction: column;
        text-align: center;
    }
}

@media (max-width: 576px) {
    .btn-add-new span,
    .btn-search span,
    .btn-reset span {
        display: none;
    }
    
    .header-title {
        font-size: 1.2rem;
    }
    
    .modern-table th,
    .modern-table td {
        padding: 1rem 0.75rem;
    }
}

/* Animation for loading states */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.table-row {
    animation: fadeInUp 0.5s ease forwards;
}

.table-row:nth-child(n) {
    animation-delay: calc(0.1s * var(--index, 0));
}
</style>

<script>
// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Add animation delay to table rows
    const tableRows = document.querySelectorAll('.table-row');
    tableRows.forEach((row, index) => {
        row.style.setProperty('--index', index);
    });
});

// Enhanced delete confirmation
document.querySelectorAll('.delete-form').forEach(form => {
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: 'Konfirmasi Hapus',
            text: 'Apakah Anda yakin ingin menghapus apotek ini?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
</script>
</x-app-layout>