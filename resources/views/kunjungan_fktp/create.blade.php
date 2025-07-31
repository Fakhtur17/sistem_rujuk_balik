<x-app-layout>
<div class="view-container">
    <div class="container py-5">
        <!-- Main Form Card -->
        <div class="data-card shadow-lg">
            <!-- Form Header with Gradient -->
            <div class="data-header-card">
                <h5 class="fw-bold mb-1">Tambah Kunjungan FKTP</h5>
                <p class="mb-0">Untuk peserta: <strong>{{ $rekrutmen->nama_peserta }}</strong></p>
            </div>

            <!-- Form Body -->
            <div class="data-body-card">
                <form action="{{ route('kunjungan_fktp.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="rekrutmen_id" value="{{ $rekrutmen->id }}">
                    {{-- Bawa query pencarian sebelumnya jika ada --}}
                    @if(request()->has('q'))
                        <input type="hidden" name="q" value="{{ request('q') }}">
                    @endif

                    <!-- Kunjungan Ke -->
                    <div class="mb-4">
                        <label for="kunjungan_ke" class="form-label">
                            <i class="fas fa-list-ol me-2 text-primary"></i> Kunjungan Ke
                        </label>
                        <input type="number" name="kunjungan_ke" id="kunjungan_ke" class="form-control modern-input" placeholder="Contoh: 1" required>
                    </div>

                    <!-- Tanggal Kunjungan -->
                    <div class="mb-4">
                        <label for="tanggal_kunjungan" class="form-label">
                            <i class="fas fa-calendar-alt me-2 text-primary"></i> Tanggal Kunjungan
                        </label>
                        <input type="date" name="tanggal_kunjungan" id="tanggal_kunjungan" class="form-control modern-input" required>
                    </div>

                    <!-- Pilih Apotek -->
                    <div class="mb-4">
                        <label for="apotek_id" class="form-label">
                            <i class="fas fa-pills me-2 text-primary"></i> Pilih Apotek
                        </label>
                        <select name="apotek_id" id="apotek_id" class="form-select modern-input" required>
                            <option value="" disabled selected>-- Pilih Apotek --</option>
                            @foreach($apoteks as $apotek)
                                <option value="{{ $apotek->id }}">{{ $apotek->nama_apotek }} - {{ $apotek->kota_kabupaten }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="mt-5 d-flex justify-content-end gap-2">
                        <a href="{{ route('rekrutmens.index', ['q' => request('q')]) }}" class="btn btn-outline-secondary btn-lg">
                            <i class="fas fa-arrow-left me-2"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-gradient-primary btn-lg">
                            <i class="fas fa-check me-2"></i> Simpan Kunjungan
                        </button>
                    </div>
                </form>
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
    .modern-input, .form-select.modern-input {
        border-radius: 0.5rem;
        border: 1px solid #ced4da;
        padding: 0.75rem 1rem;
    }
    .modern-input:focus, .form-select.modern-input:focus {
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
</style>
</x-app-layout>
