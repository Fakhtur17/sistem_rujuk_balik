{{-- resources/views/apoteks/edit.blade.php --}}
<x-app-layout>
<div class="view-container">
    <div class="container py-5">
        <!-- Main Form Card -->
        <div class="data-card shadow-lg">
            <!-- Form Header with Gradient -->
            <div class="data-header-card">
                <h5 class="fw-bold mb-1">Edit Apotek</h5>
                <p class="mb-0">Perbarui data apotek yang sudah terdaftar.</p>
            </div>

            <!-- Form Body -->
            <div class="data-body-card">
                <form action="{{ route('apoteks.update', $apotek->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Nama Apotek -->
                    <div class="mb-4">
                        <label for="nama_apotek" class="form-label">
                            <i class="fas fa-pills me-2 text-primary"></i> Nama Apotek / Lokasi
                        </label>
                        <input type="text" name="nama_apotek" id="nama_apotek" class="form-control modern-input @error('nama_apotek') is-invalid @enderror" value="{{ old('nama_apotek', $apotek->nama_apotek) }}" placeholder="Masukkan nama apotek" required>
                        @error('nama_apotek') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Kabupaten / Kota -->
                    <div class="mb-4">
                        <label for="kota_kabupaten" class="form-label">
                            <i class="fas fa-map-marked-alt me-2 text-primary"></i> Kabupaten / Kota
                        </label>
                        <input type="text" name="kota_kabupaten" id="kota_kabupaten" class="form-control modern-input @error('kota_kabupaten') is-invalid @enderror" value="{{ old('kota_kabupaten', $apotek->kota_kabupaten) }}" placeholder="Masukkan kabupaten atau kota" required>
                        @error('kota_kabupaten') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="mt-5 d-flex justify-content-end gap-2">
                        <a href="{{ route('apoteks.index') }}" class="btn btn-outline-secondary btn-lg">
                            <i class="fas fa-arrow-left me-2"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-gradient-primary btn-lg">
                            <i class="fas fa-save me-2"></i> Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Panduan Pengisian Card -->
        <div class="guidance-card mt-4">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <i class="fas fa-info-circle text-primary me-3 fs-4"></i>
                    <div>
                        <h6 class="fw-bold mb-1">Panduan Pengisian</h6>
                        <ul class="list-unstyled mb-0 text-muted small">
                            <li>• Pastikan nama apotek dan kota diisi dengan benar.</li>
                            <li>• Data ini akan digunakan untuk referensi pada form lainnya.</li>
                        </ul>
                    </div>
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
    .form-label {
        font-weight: 600;
        color: #495057;
        display: flex;
        align-items: center;
    }
    .modern-input {
        border-radius: 0.5rem;
        border: 1px solid #ced4da;
        padding: 0.75rem 1rem;
    }
    .modern-input:focus {
        border-color: #8A2BE2;
        box-shadow: 0 0 0 0.25rem rgba(138, 43, 226, 0.15);
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
    .btn-outline-secondary {
        border-radius: 0.5rem;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
        border-width: 2px;
    }
    .btn-lg {
        border-radius: 0.5rem;
        padding: 0.75rem 1.5rem;
        font-weight: 600;
    }
    .guidance-card {
        background-color: #e9ecef;
        border-radius: 1rem;
        border: 1px solid #dee2e6;
    }
</style>
</x-app-layout>
