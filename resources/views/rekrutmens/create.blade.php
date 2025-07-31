<x-app-layout>
    <div class="container mt-4">
        <!-- Form Header -->
        <div class="form-header text-center mb-5">
            <div class="header-icon">
                <i class="fas fa-user-plus"></i>
            </div>
            <h2 class="form-title">Tambah Data Rekrutmen PRB</h2>
            <p class="form-subtitle">Lengkapi formulir di bawah ini untuk menambahkan data rekrutmen Program Rujuk Balik</p>
        </div>

        <!-- Main Form Card -->
        <div class="form-card">
            <form action="{{ route('rekrutmens.store') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
                @csrf
                
                <div class="row">
                    <!-- Left Column -->
                    <div class="col-lg-6">
                        <!-- Tanggal PRB -->
                        <div class="form-group">
                            <label for="tanggal_prb" class="form-label">
                                <i class="fas fa-calendar-alt me-2"></i>
                                Tanggal PRB
                            </label>
                            <input type="date" 
                                   name="tanggal_prb" 
                                   id="tanggal_prb"
                                   class="form-control modern-input" 
                                   required>
                            <div class="invalid-feedback">
                                Tanggal PRB wajib diisi
                            </div>
                        </div>

                        <!-- Nama FKRTL -->
                        <div class="form-group">
                            <label for="nama_fkrtl" class="form-label">
                                <i class="fas fa-hospital me-2"></i>
                                Nama FKRTL (RS + Kota)
                            </label>
                            <select name="nama_fkrtl" 
                                    id="nama_fkrtl"
                                    class="form-select modern-select select2" 
                                    required>
                                <option value="">-- Pilih Rumah Sakit / Klinik --</option>
                                @foreach ($farmasis as $farmasi)
                                    <option value="{{ $farmasi->nama_rs }} - {{ $farmasi->kota }}">
                                        {{ $farmasi->nama_rs }} - {{ $farmasi->kota }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Pilih rumah sakit atau klinik
                            </div>
                        </div>

                        <!-- Nama Peserta -->
                        <div class="form-group">
                            <label for="nama_peserta" class="form-label">
                                <i class="fas fa-user me-2"></i>
                                Nama Peserta
                            </label>
                            <input type="text" 
                                   name="nama_peserta" 
                                   id="nama_peserta"
                                   class="form-control modern-input" 
                                   placeholder="Masukkan nama lengkap peserta"
                                   required>
                            <div class="invalid-feedback">
                                Nama peserta wajib diisi
                            </div>
                        </div>

                        <!-- Nomor Kartu JKN -->
                        <div class="form-group">
                            <label for="nomor_kartu_jkn" class="form-label">
                                <i class="fas fa-id-card me-2"></i>
                                Nomor SEP
                            </label>
                            <input type="text" 
                                name="nomor_kartu_jkn" 
                                id="nomor_kartu_jkn"
                                class="form-control modern-input" 
                                placeholder="Contoh: 0001A234567B89"
                                pattern="^\d{4}[A-Za-z]\d{7}[A-Za-z]\d{6}$"
                                maxlength="19"
                                required>
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Format: 19 karakter, karakter ke-5 dan ke-13 harus huruf, sisanya angka.
                            </div>
                            <div class="invalid-feedback">
                                Format salah: Gunakan 19 karakter, huruf di posisi ke-5 dan ke-13
                            </div>
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="col-lg-6">
                        <!-- Nomor HP -->
                        <div class="form-group">
                            <label for="nomor_hp" class="form-label">
                                <i class="fas fa-phone me-2"></i>
                                Nomor HP
                            </label>
                            <input type="tel" 
                                   name="nomor_hp" 
                                   id="nomor_hp"
                                   class="form-control modern-input" 
                                   placeholder="Contoh: 08123456789"
                                   pattern="[0-9]{10,13}"
                                   required>
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Masukkan nomor HP yang aktif
                            </div>
                            <div class="invalid-feedback">
                                Nomor HP tidak valid
                            </div>
                        </div>

                        <!-- FKTP Apotek -->
                        <div class="form-group">
                            <label for="fktp_id" class="form-label">
                                <i class="fas fa-clinic-medical me-2"></i>
                                FKTP (Nama dan Kota)
                            </label>
                            <select name="fktp_id" 
                                    id="fktp_id" 
                                    class="form-select modern-select select2" 
                                    required>
                                <option value="">-- Pilih FKTP --</option>
                                @foreach ($fktps as $fktp)
                                    <option value="{{ $fktp->id }}">
                                        {{ $fktp->nama_fktp }} ({{ $fktp->kabupaten_kota }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Pilih FKTP (Nama dan Kota)
                            </div>
                        </div>

                        <!-- Upload SRB -->
                        <div class="form-group">
                            <label class="form-label">
                                <i class="fas fa-upload me-2"></i>
                                Upload SRB (Gambar/PDF)
                            </label>
                            <div class="file-upload-wrapper">
                                <input type="file" 
                                       name="link_srb" 
                                       id="link_srb"
                                       class="form-control modern-file" 
                                       accept="image/*,application/pdf" 
                                       required>
                                <label for="link_srb" class="file-upload-text">
                                    <i class="fas fa-cloud-upload-alt me-2"></i>
                                    <span>Pilih file gambar atau PDF</span>
                                </label>
                            </div>
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Format: JPG, PNG, PDF (Max: 5MB)
                            </div>
                            <div class="invalid-feedback">
                                File SRB wajib diunggah
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('rekrutmens.index') }}" class="btn btn-outline-secondary btn-lg">
                            <i class="fas fa-arrow-left me-2"></i>
                            Kembali
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-save me-2"></i>
                            Simpan Data
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <style>
        /* Form Styling */
        .form-header { margin-bottom: 3rem; position: relative; }
        .header-icon { width: 80px; height: 80px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3); }
        .header-icon i { font-size: 2rem; color: white; }
        .form-title { color: #2c3e50; font-weight: 700; font-size: 2.2rem; margin-bottom: 0.5rem; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; }
        .form-subtitle { color: #7f8c8d; font-size: 1.1rem; margin-bottom: 0; line-height: 1.6; }
        .form-card { background: white; border-radius: 20px; padding: 3rem; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08); border: 1px solid rgba(0, 0, 0, 0.05); position: relative; overflow: hidden; }
        .form-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 4px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .form-group { margin-bottom: 2rem; }
        .form-label { font-weight: 600; color: #2c3e50; margin-bottom: 0.75rem; font-size: 1rem; display: flex; align-items: center; }
        .form-label i { color: #667eea; }
        .modern-input, .modern-select { border: 2px solid #e9ecef; border-radius: 12px; padding: 0.875rem 1.25rem; font-size: 1rem; transition: all 0.3s ease; background: #f8f9fa; }
        .modern-input:focus, .modern-select:focus { border-color: #667eea; box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15); background: white; outline: none; }
        .modern-input:valid, .modern-select:valid { border-color: #28a745; background: #f8fff9; }
        .modern-input::placeholder { color: #a0a6aa; font-style: italic; }
        
        /* Select2 Custom Styling */
        .select2-container--default .select2-selection--single {
            border: 2px solid #e9ecef !important;
            border-radius: 12px !important;
            padding: 0.5rem 1.25rem !important;
            font-size: 1rem !important;
            background: #f8f9fa !important;
            height: auto !important;
            min-height: 50px !important;
            display: flex !important;
            align-items: center !important;
            transition: all 0.3s ease !important;
        }
        
        .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: #667eea !important;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.15) !important;
            background: white !important;
            outline: none !important;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            color: #495057 !important;
            line-height: 1.5 !important;
            padding: 0 !important;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__placeholder {
            color: #a0a6aa !important;
            font-style: italic !important;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 100% !important;
            right: 15px !important;
        }
        
        .select2-dropdown {
            border: 2px solid #667eea !important;
            border-radius: 12px !important;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
        }
        
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #667eea !important;
        }
        
        .select2-container {
            width: 100% !important;
        }
        
        .file-upload-wrapper { position: relative; overflow: hidden; display: inline-block; width: 100%; }
        .modern-file { position: absolute; left: -9999px; opacity: 0; }
        .file-upload-text { display: flex; align-items: center; justify-content: center; padding: 1.5rem; border: 2px dashed #667eea; border-radius: 12px; background: linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%); color: #667eea; font-weight: 500; cursor: pointer; transition: all 0.3s ease; }
        .file-upload-text:hover { border-color: #764ba2; background: linear-gradient(135deg, #f0f2ff 0%, #f8f9ff 100%); transform: translateY(-2px); }
        .form-text { color: #6c757d; font-size: 0.875rem; margin-top: 0.5rem; }
        .form-actions { margin-top: 3rem; padding-top: 2rem; border-top: 1px solid #e9ecef; }
        .btn-lg { padding: 0.875rem 2rem; font-size: 1.1rem; font-weight: 600; border-radius: 12px; transition: all 0.3s ease; }
        .btn-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; color: white; }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4); }
        .btn-outline-secondary { border: 2px solid #6c757d; color: #6c757d; }
        .btn-outline-secondary:hover { background: #6c757d; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3); }
        .invalid-feedback { display: block; color: #dc3545; font-size: 0.875rem; margin-top: 0.5rem; }
        @media (max-width: 768px) {
            .form-card { padding: 2rem 1.5rem; }
            .form-title { font-size: 1.8rem; }
            .header-icon { width: 60px; height: 60px; }
            .header-icon i { font-size: 1.5rem; }
            .form-actions .d-flex { flex-direction: column; gap: 1rem; }
        }
        .form-card { animation: slideUp 0.6s ease-out; }
        @keyframes slideUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
    </style>
    
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <!-- jQuery (required) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Inisialisasi -->
    <script>
        $(document).ready(function() {
            $('#fktp_id').select2({
                placeholder: "-- Pilih FKTP --",
                allowClear: true,
                width: '100%'
            });

            $('#nama_fkrtl').select2({
                placeholder: "-- Pilih Rumah Sakit / Klinik --",
                allowClear: true,
                width: '100%'
            });
        });
    </script>

    <script>
        // Form validation
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();

        // File upload handler
        document.getElementById('link_srb').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const uploadText = document.querySelector('.file-upload-text span');
            
            if (file) {
                uploadText.textContent = file.name;
                uploadText.parentElement.style.borderColor = '#28a745';
                uploadText.parentElement.style.background = '#f8fff9';
            } else {
                uploadText.textContent = 'Pilih file gambar atau PDF';
                uploadText.parentElement.style.borderColor = '#667eea';
                uploadText.parentElement.style.background = 'linear-gradient(135deg, #f8f9ff 0%, #ffffff 100%)';
            }
        });

        // Auto-format phone number
        document.getElementById('nomor_hp').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 13) { value = value.slice(0, 13); }
            e.target.value = value;
        });

        // Auto-format JKN number
        document.getElementById('nomor_kartu_jkn').addEventListener('input', function(e) {
            let value = e.target.value;

            // Hapus semua karakter kecuali huruf dan angka
            value = value.replace(/[^a-zA-Z0-9]/g, '');

            // Batasi maksimum 19 karakter
            if (value.length > 19) {
                value = value.slice(0, 19);
            }

            // Validasi posisi ke-5 dan ke-13
            const char5 = value.charAt(4);
            const char13 = value.charAt(12);

            // Tambahkan class is-invalid jika salah
            const input = e.target;
            if ((value.length === 19) && (!/[a-zA-Z]/.test(char5) || !/[a-zA-Z]/.test(char13))) {
                input.classList.add('is-invalid');
            } else {
                input.classList.remove('is-invalid');
            }

            e.target.value = value;
        });
    </script>
</x-app-layout>