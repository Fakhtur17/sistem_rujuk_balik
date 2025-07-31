<x-app-layout>
    <div class="min-vh-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-xl-6">
                    <!-- Header Card -->
                    <div class="card border-0 shadow-lg mb-4" style="border-radius: 20px; backdrop-filter: blur(10px); background: rgba(255, 255, 255, 0.95);">
                        <div class="card-body text-center py-4">
                            <div class="mb-3">
                                <div class="d-inline-flex align-items-center justify-content-center bg-primary rounded-circle mb-3" style="width: 60px; height: 60px;">
                                    <i class="fa fa-plus-circle text-white" style="font-size: 24px;"></i>
                                </div>
                            </div>
                            <h4 class="fw-bold text-dark mb-2">Tambah Obat Baru</h4>
                            <p class="text-muted mb-0">
                                <i class="fa fa-map-marker-alt me-2 text-primary"></i>
                                <strong>{{ $selectedApotek->nama_apotek }}</strong>
                            </p>
                        </div>
                    </div>

                    <!-- Form Card -->
                    <div class="card border-0 shadow-lg" style="border-radius: 20px; backdrop-filter: blur(10px); background: rgba(255, 255, 255, 0.95);">
                        <div class="card-body p-4">
                            <form action="{{ route('obats.store') }}" method="POST">
                                @csrf
                                
                                <!-- Hidden Apotek ID -->
                                <input type="hidden" name="apotek_id" value="{{ $selectedApotek->id }}">
                                
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
                                               value="{{ old('nama_obat') }}" 
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
                                        <i class="fa fa-tag me-2 text-success"></i>sediaan
                                    </label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0" style="border-radius: 12px 0 0 12px;">
                                            <i class="fa fa-list-alt text-muted"></i>
                                        </span>
                                        <input type="text" 
                                               name="kategori" 
                                               class="form-control border-start-0 ps-0" 
                                               style="border-radius: 0 12px 12px 0; padding: 12px 16px;"
                                               value="{{ old('kategori') }}" 
                                               placeholder="Contoh: Obat Keras, Obat Bebas, dll...">
                                    </div>
                                    @error('kategori')
                                        <div class="text-danger small mt-1">
                                            <i class="fa fa-exclamation-circle me-1"></i>{{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            
                                
                                <!-- Action Buttons -->
                                <div class="d-flex flex-column flex-sm-row gap-3 mt-4">
                                    <button type="submit" 
                                            class="btn btn-primary btn-lg flex-fill d-flex align-items-center justify-content-center gap-2"
                                            style="border-radius: 12px; padding: 14px 24px; font-weight: 600; background: linear-gradient(135deg, #007bff, #0056b3); border: none; transition: all 0.3s ease;"
                                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(0, 123, 255, 0.3)'"
                                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0, 0, 0, 0.1)'">
                                        <i class="fa fa-save"></i>
                                        <span>Simpan Obat</span>
                                    </button>
                                    
                                    <a href="{{ route('obats.byApotek', $selectedApotek->id) }}" 
                                       class="btn btn-outline-secondary btn-lg flex-fill d-flex align-items-center justify-content-center gap-2"
                                       style="border-radius: 12px; padding: 14px 24px; font-weight: 600; transition: all 0.3s ease;"
                                       onmouseover="this.style.transform='translateY(-2px)'; this.style.backgroundColor='#6c757d'; this.style.color='white'; this.style.borderColor='#6c757d'"
                                       onmouseout="this.style.transform='translateY(0)'; this.style.backgroundColor='transparent'; this.style.color='#6c757d'; this.style.borderColor='#6c757d'">
                                        <i class="fa fa-arrow-left"></i>
                                        <span>Kembali</span>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Footer Info -->
                    <div class="text-center mt-4">
                        <small class="text-white-50">
                            <i class="fa fa-shield-alt me-1"></i>
                            Data obat akan tersimpan dengan aman dalam sistem
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>