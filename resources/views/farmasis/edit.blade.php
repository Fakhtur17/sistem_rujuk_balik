{{-- resources/views/farmasis/edit.blade.php --}}
<x-app-layout>
<div class="form-container">
    <div class="container py-5">
        <!-- Main Form Card -->
        <div class="form-card shadow-lg">
            <!-- Form Header -->
            <div class="form-header-card">
                <h5 class="fw-bold">Form Edit Farmasi RS</h5>
                <p class="text-muted mb-0">Perbarui data Farmasi RS di bawah ini.</p>
            </div>

            <!-- Form Body -->
            <div class="form-body-card">
                <form action="{{ route('farmasis.update', $farmasi->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Nama RS -->
                    <div class="mb-4">
                        <label for="nama_rs" class="form-label">
                            <i class="fas fa-hospital me-2 text-primary"></i> Nama RS
                        </label>
                        <input type="text" name="nama_rs" id="nama_rs" class="form-control modern-input @error('nama_rs') is-invalid @enderror" value="{{ old('nama_rs', $farmasi->nama_rs) }}" placeholder="Masukkan nama RS" required>
                        @error('nama_rs') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Alamat -->
                    <div class="mb-4">
                        <label for="alamat" class="form-label">
                            <i class="fas fa-map-marked-alt me-2 text-primary"></i> Alamat
                        </label>
                        <input type="text" name="alamat" id="alamat" class="form-control modern-input @error('alamat') is-invalid @enderror" value="{{ old('alamat', $farmasi->alamat) }}" placeholder="Masukkan alamat lengkap" required>
                        @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Kota -->
                    <div class="mb-4">
                        <label for="kota" class="form-label">
                             <i class="fas fa-city me-2 text-primary"></i> Kota
                        </label>
                        <input type="text" name="kota" id="kota" class="form-control modern-input @error('kota') is-invalid @enderror" value="{{ old('kota', $farmasi->kota) }}" placeholder="Masukkan nama kota" required>
                        @error('kota') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Kontak -->
                    <div class="mb-4">
                        <label for="kontak" class="form-label">
                            <i class="fas fa-phone me-2 text-primary"></i> Kontak (Opsional)
                        </label>
                        <input type="text" name="kontak" id="kontak" class="form-control modern-input @error('kontak') is-invalid @enderror" value="{{ old('kontak', $farmasi->kontak) }}" placeholder="Masukkan nomor kontak">
                        @error('kontak') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="mt-5 d-flex justify-content-end gap-2">
                        <a href="{{ route('farmasis.index') }}" class="btn btn-outline-secondary btn-lg">
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
                            <li>• Pastikan semua kolom yang wajib diisi dengan benar.</li>
                            <li>• Kolom kontak bersifat opsional dan boleh dikosongkan.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .form-container {
        background-color: #f0f2ff;
        min-height: 100vh;
    }
    .form-card {
        background-color: white;
        border-radius: 1rem;
        overflow: hidden;
        border: 1px solid #e9ecef;
    }
    .form-header-card {
        background-color: #f8f9fa;
        padding: 1.5rem 2rem;
        border-bottom: 1px solid #e9ecef;
    }
    .form-body-card {
        padding: 2rem;
    }
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
        background: linear-gradient(135deg, #8A2BE2 0%, #4B0082 100%);
        border: none;
        color: white;
        transition: all 0.3s ease;
    }
    .btn-gradient-primary:hover {
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(138, 43, 226, 0.3);
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
