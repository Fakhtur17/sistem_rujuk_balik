<x-app-layout>
    <div class="min-vh-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #fecfef 100%);">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <!-- Header Card -->
                    <div class="card border-0 shadow-lg mb-4" style="border-radius: 20px; backdrop-filter: blur(10px); background: rgba(255, 255, 255, 0.95);">
                        <div class="card-body text-center py-4">
                            <div class="mb-3">
                                <div class="d-inline-flex align-items-center justify-content-center bg-warning rounded-circle mb-3" style="width: 60px; height: 60px;">
                                    <i class="fa fa-edit text-white" style="font-size: 24px;"></i>
                                </div>
                            </div>
                            <h4 class="fw-bold text-dark mb-2">Edit Obat</h4>
                            <p class="text-muted mb-0">
                                <i class="fa fa-map-marker-alt me-2 text-warning"></i>
                                <strong>{{ $obat->apotek->nama_apotek }}</strong>
                            </p>
                            <div class="mt-3">
                                <span class="badge bg-light text-dark px-3 py-2 rounded-pill">
                                    <i class="fa fa-pills me-1 text-primary"></i>
                                    {{ $obat->nama_obat }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Form Card -->
                    <div class="card border-0 shadow-lg" style="border-radius: 20px; backdrop-filter: blur(10px); background: rgba(255, 255, 255, 0.95);">
                        <div class="card-body p-4">
                            <form action="{{ route('obats.update', $obat->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                
                                <!-- Hidden Apotek ID -->
                                <input type="hidden" name="apotek_id" value="{{ $obat->apotek_id }}">
                                
                                <!-- Nama Obat Field -->
                                <div class="mb-4">
                                    <label class="form-label fw-semibold text-dark mb-2">
                                        <i class="fa fa-pills me-2 text-primary"></i>Nama Obat
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0" style="border-radius: 12px 0 0 12px;">
                                            <i class="fa fa-capsules text-muted"></i>
                                        </span>
                                        <input type="text" 
                                               name="nama_obat" 
                                               class="form-control border-start-0 ps-0" 
                                               style="border-radius: 0 12px 12px 0; padding: 12px 16px;"
                                               value="{{ $obat->nama_obat }}" 
                                               placeholder="Masukkan nama obat..."
                                               required>
                                    </div>
                                    @error('nama_obat')
                                        <div class="text-danger small mt-1">
                                            <i class="fa fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <!-- Kategori/Tersediaan Field -->
                                <div class="mb-4">
                                    <label class="form-label fw-semibold text-dark mb-2">
                                        <i class="fa fa-tag me-2 text-success"></i>Kategori/Tersediaan
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0" style="border-radius: 12px 0 0 12px;">
                                            <i class="fa fa-list-alt text-muted"></i>
                                        </span>
                                        <input type="text" 
                                               name="kategori" 
                                               class="form-control border-start-0 ps-0" 
                                               style="border-radius: 0 12px 12px 0; padding: 12px 16px;"
                                               value="{{ $obat->kategori }}" 
                                               placeholder="Contoh: Obat Keras, Obat Bebas, dll...">
                                    </div>
                                    @error('kategori')
                                        <div class="text-danger small mt-1">
                                            <i class="fa fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                
                                <!-- Stok Field -->
                                <div class="mb-4">
                                    <label class="form-label fw-semibold text-dark mb-2">
                                        <i class="fa fa-boxes me-2 text-info"></i>Stok Saat Ini
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0" style="border-radius: 12px 0 0 12px;">
                                            <i class="fa fa-cube text-muted"></i>
                                        </span>
                                        <input type="number" 
                                               name="stok" 
                                               class="form-control border-start-0 ps-0" 
                                               style="border-radius: 0 12px 12px 0; padding: 12px 16px; background-color: #f8f9fa;"
                                               value="{{ $obat->stok }}" 
                                               readonly 
                                               required>
                                        <span class="input-group-text bg-info text-white border-start-0" style="border-radius: 0 12px 12px 0;">
                                            <i class="fa fa-box"></i>
                                        </span>
                                    </div>
                                    <div class="form-text mt-1">
                                        <i class="fa fa-info-circle me-1 text-info"></i>
                                        Stok tidak dapat diubah dari halaman ini. Gunakan fitur manajemen stok untuk mengubah jumlah stok.
                                    </div>
                                </div>

                                <!-- Info Box -->
                                <div class="alert alert-info border-0 mb-4" style="border-radius: 12px; background: linear-gradient(135deg, rgba(13, 202, 240, 0.1), rgba(13, 202, 240, 0.05));">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0 me-3">
                                            <i class="fa fa-lightbulb text-info" style="font-size: 24px;"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="alert-heading fw-bold mb-1">Tips Mengedit Obat</h6>
                                            <small class="mb-0">Pastikan nama obat dan kategori sudah sesuai dengan ketentuan apotek. Perubahan akan tersimpan secara permanen.</small>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Action Buttons -->
                                <div class="d-flex flex-column flex-sm-row gap-3 mt-4">
                                    <button type="submit" 
                                            class="btn btn-warning btn-lg flex-fill d-flex align-items-center justify-content-center gap-2"
                                            style="border-radius: 12px; padding: 14px 24px; font-weight: 600; background: linear-gradient(135deg, #ffc107, #e0a800); border: none; color: #212529; transition: all 0.3s ease;"
                                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(255, 193, 7, 0.4)'"
                                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0, 0, 0, 0.1)'">
                                        <i class="fa fa-save"></i>
                                        <span>Simpan Perubahan</span>
                                    </button>
                                    
                                    <a href="{{ route('obats.byApotek', $obat->apotek_id) }}" 
                                       class="btn btn-outline-secondary btn-lg flex-fill d-flex align-items-center justify-content-center gap-2"
                                       style="border-radius: 12px; padding: 14px 24px; font-weight: 600; transition: all 0.3s ease;"
                                       onmouseover="this.style.transform='translateY(-2px)'; this.style.backgroundColor='#6c757d'; this.style.color='white'; this.style.borderColor='#6c757d'"
                                       onmouseout="this.style.transform='translateY(0)'; this.style.backgroundColor='transparent'; this.style.color='#6c757d'; this.style.borderColor='#6c757d'">
                                        <i class="fa fa-arrow-left"></i>
                                        <span>Kembali</span>
                                    </a>
                                </div>

                                <!-- Danger Zone (Optional) -->
                                <div class="mt-5 pt-4 border-top">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <h6 class="text-danger mb-1">
                                                <i class="fa fa-exclamation-triangle me-2"></i>Zona Berbahaya
                                            </h6>
                                            <small class="text-muted">Aksi ini tidak dapat dibatalkan</small>
                                        </div>
                                        <button type="button" 
                                                class="btn btn-outline-danger btn-sm"
                                                style="border-radius: 8px;"
                                                onclick="if(confirm('Apakah Anda yakin ingin menghapus obat ini?')) { window.location.href='#'; }">
                                            <i class="fa fa-trash me-1"></i>Hapus Obat
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Footer Info -->
                    <div class="text-center mt-4">
                        <small class="text-white" style="text-shadow: 0 1px 3px rgba(0,0,0,0.3);">
                            <i class="fa fa-clock me-1"></i>
                            Terakhir diubah: <strong>{{ $obat->updated_at ? $obat->updated_at->format('d M Y, H:i') : 'Belum pernah diubah' }}</strong>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>