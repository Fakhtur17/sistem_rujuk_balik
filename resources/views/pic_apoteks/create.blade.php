{{-- resources/views/pic_apoteks/create.blade.php --}}
<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-purple-50 to-pink-100 py-8">
        <div class="container mx-auto px-4 max-w-2xl">
            <!-- Header Section -->
            <div class="bg-white rounded-2xl shadow-xl p-8 mb-6">
                <div class="flex items-center space-x-4 mb-6">
                    <div class="bg-gradient-to-r from-purple-500 to-pink-600 p-3 rounded-xl">
                        <i class="fa fa-plus-circle text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Tambah PIC Apotek</h1>
                        <p class="text-gray-600">Tambahkan informasi Person In Charge Apotek yang baru</p>
                    </div>
                </div>

                <!-- Pharmacy Icon Banner -->
                <div class="bg-gradient-to-r from-purple-100 to-pink-100 border border-purple-200 rounded-xl p-4">
                    <div class="flex items-center justify-center space-x-4">
                        <div class="text-4xl">💊</div>
                        <div class="text-center">
                            <div class="font-semibold text-purple-800">Apotek PRB</div>
                            <div class="text-sm text-purple-600">Program Rujuk Balik - Fasilitas Kefarmasian</div>
                        </div>
                        <div class="text-4xl">🏪</div>
                    </div>
                </div>
            </div>

            <!-- Form Section -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <form action="{{ route('pic-apoteks.store', ['picPrb' => $pic_prb_id]) }}" method="POST" class="space-y-6" id="apotekForm">
                    @csrf

                    <!-- Nama Apotek -->
                    <div class="form-group">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa fa-medkit mr-2 text-purple-500"></i>
                            Nama Apotek
                            <span class="text-red-500 ml-1">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" 
                                   name="nama_faskes" 
                                   class="w-full px-4 py-3 pl-12 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 transition-all duration-200 @error('nama_faskes') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror" 
                                   value="{{ old('nama_faskes') }}"
                                   placeholder="Contoh: Apotek Kimia Farma Sejahtera">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa fa-medkit text-gray-400"></i>
                            </div>
                            <!-- Real-time validation icon -->
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <i class="fa fa-check-circle text-green-500 opacity-0 transition-opacity duration-200" id="nama_faskes_check"></i>
                            </div>
                            @error('nama_faskes') 
                                <div class="flex items-center mt-2 text-red-600 text-sm">
                                    <i class="fa fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </div> 
                            @enderror
                        </div>
                        <div class="mt-1 text-xs text-gray-500">
                            <i class="fa fa-info-circle mr-1"></i>
                            Masukkan nama apotek sesuai dengan izin usaha
                        </div>
                    </div>

                    <!-- Kab/Kota -->
                    <div class="form-group">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa fa-map-marker mr-2 text-pink-500"></i>
                            Kabupaten/Kota
                            <span class="text-red-500 ml-1">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" 
                                   name="kab_kota" 
                                   class="w-full px-4 py-3 pl-12 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 transition-all duration-200 @error('kab_kota') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror" 
                                   value="{{ old('kab_kota') }}"
                                   placeholder="Contoh: Kota Jakarta Selatan">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa fa-map-marker text-gray-400"></i>
                            </div>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <i class="fa fa-check-circle text-green-500 opacity-0 transition-opacity duration-200" id="kab_kota_check"></i>
                            </div>
                            @error('kab_kota') 
                                <div class="flex items-center mt-2 text-red-600 text-sm">
                                    <i class="fa fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </div> 
                            @enderror
                        </div>
                        <div class="mt-1 text-xs text-gray-500">
                            <i class="fa fa-info-circle mr-1"></i>
                            Sesuaikan dengan lokasi apotek beroperasi
                        </div>
                    </div>

                    <!-- Nama PIC -->
                    <div class="form-group">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa fa-user-md mr-2 text-indigo-500"></i>
                            Nama PIC
                            <span class="text-red-500 ml-1">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" 
                                   name="nama_pic" 
                                   class="w-full px-4 py-3 pl-12 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 transition-all duration-200 @error('nama_pic') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror" 
                                   value="{{ old('nama_pic') }}"
                                   placeholder="Contoh: Apt. Dr. Sarah Wijaya, S.Farm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa fa-user-md text-gray-400"></i>
                            </div>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <i class="fa fa-check-circle text-green-500 opacity-0 transition-opacity duration-200" id="nama_pic_check"></i>
                            </div>
                            @error('nama_pic') 
                                <div class="flex items-center mt-2 text-red-600 text-sm">
                                    <i class="fa fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </div> 
                            @enderror
                        </div>
                        <div class="mt-1 text-xs text-gray-500">
                            <i class="fa fa-info-circle mr-1"></i>
                            Nama lengkap apoteker penanggung jawab atau staff yang ditunjuk
                        </div>
                    </div>

                    <!-- No HP -->
                    <div class="form-group">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa fa-phone mr-2 text-orange-500"></i>
                            Nomor HP
                            <span class="text-red-500 ml-1">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" 
                                   name="no_hp" 
                                   class="w-full px-4 py-3 pl-12 border-2 border-gray-200 rounded-xl focus:border-purple-500 focus:ring-4 focus:ring-purple-100 transition-all duration-200 @error('no_hp') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror" 
                                   value="{{ old('no_hp') }}"
                                   placeholder="Contoh: 08123456789"
                                   pattern="[0-9]{10,13}"
                                   title="Nomor HP harus berupa angka 10-13 digit">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa fa-phone text-gray-400"></i>
                            </div>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <i class="fa fa-check-circle text-green-500 opacity-0 transition-opacity duration-200" id="no_hp_check"></i>
                            </div>
                            @error('no_hp') 
                                <div class="flex items-center mt-2 text-red-600 text-sm">
                                    <i class="fa fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </div> 
                            @enderror
                        </div>
                        <div class="mt-1 text-xs text-gray-500">
                            <i class="fa fa-info-circle mr-1"></i>
                            Nomor yang dapat dihubungi untuk koordinasi program PRB
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6">
                        <button type="submit" 
                                class="flex-1 bg-gradient-to-r from-purple-500 to-pink-600 hover:from-purple-600 hover:to-pink-700 text-white font-semibold py-3 px-6 rounded-xl transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center space-x-2"
                                id="submitBtn">
                            <i class="fa fa-save"></i>
                            <span>Simpan Data</span>
                            <div class="hidden ml-2" id="loadingSpinner">
                                <i class="fa fa-spinner fa-spin"></i>
                            </div>
                        </button>
                        <a href="{{ route('pic-apoteks.index', $pic_prb_id) }}" 
                           class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-xl transition-all duration-200 text-center flex items-center justify-center space-x-2">
                            <i class="fa fa-arrow-left"></i>
                            <span>Kembali</span>
                        </a>
                    </div>
                </form>
            </div>

            <!-- Info & Tips Section -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
                <!-- Requirements Card -->
                <div class="bg-purple-50 border border-purple-200 rounded-xl p-6">
                    <div class="flex items-start space-x-3">
                        <i class="fa fa-clipboard-list text-purple-500 text-lg mt-1"></i>
                        <div>
                            <h4 class="font-semibold text-purple-800 mb-3">Persyaratan PIC Apotek</h4>
                            <ul class="text-sm text-purple-700 space-y-2">
                                <li class="flex items-start">
                                    <i class="fa fa-check-circle text-purple-500 mr-2 mt-0.5 text-xs"></i>
                                    <span>Apoteker yang memiliki STRA dan SIPA yang masih berlaku</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fa fa-check-circle text-purple-500 mr-2 mt-0.5 text-xs"></i>
                                    <span>Apotek telah terdaftar dan memiliki izin operasional</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fa fa-check-circle text-purple-500 mr-2 mt-0.5 text-xs"></i>
                                    <span>Bersedia berpartisipasi dalam program PRB</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fa fa-check-circle text-purple-500 mr-2 mt-0.5 text-xs"></i>
                                    <span>Memiliki stok obat PRB yang memadai</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Process Flow Card -->
                <div class="bg-pink-50 border border-pink-200 rounded-xl p-6">
                    <div class="flex items-start space-x-3">
                        <i class="fa fa-cogs text-pink-500 text-lg mt-1"></i>
                        <div>
                            <h4 class="font-semibold text-pink-800 mb-3">Proses Selanjutnya</h4>
                            <div class="space-y-3">
                                <div class="flex items-center space-x-3">
                                    <div class="w-6 h-6 bg-pink-200 rounded-full flex items-center justify-center text-pink-700 text-xs font-bold">1</div>
                                    <span class="text-sm text-pink-700">Verifikasi data apotek dan PIC</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="w-6 h-6 bg-pink-200 rounded-full flex items-center justify-center text-pink-700 text-xs font-bold">2</div>
                                    <span class="text-sm text-pink-700">Koordinasi dengan BPJS Kesehatan</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="w-6 h-6 bg-pink-200 rounded-full flex items-center justify-center text-pink-700 text-xs font-bold">3</div>
                                    <span class="text-sm text-pink-700">Aktivasi sistem dan pelatihan</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <div class="w-6 h-6 bg-pink-200 rounded-full flex items-center justify-center text-pink-700 text-xs font-bold">4</div>
                                    <span class="text-sm text-pink-700">Mulai pelayanan PRB</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="bg-gradient-to-r from-purple-100 to-pink-100 border border-purple-200 rounded-xl p-4 mt-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center text-purple-800">
                        <i class="fa fa-info-circle mr-2"></i>
                        <span class="font-medium">Pastikan semua data sudah benar sebelum menyimpan</span>
                    </div>
                    <div class="text-sm text-purple-600">
                        <i class="fa fa-shield mr-1"></i>
                        Data akan dienkripsi dan disimpan dengan aman
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        .form-group input:focus {
            transform: translateY(-1px);
            box-shadow: 0 10px 25px rgba(168, 85, 247, 0.15);
        }
        
        .container {
            animation: fadeInUp 0.6s ease-out;
        }
        
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
        
        .bg-gradient-to-br {
            background-attachment: fixed;
        }
        
        .form-group input:valid:not(:placeholder-shown) + div .fa-check-circle {
            opacity: 1;
        }
        
        /* Phone number validation styling */
        input[name="no_hp"]:invalid {
            border-color: #f87171;
        }
        
        input[name="no_hp"]:valid {
            border-color: #10b981;
        }
        
        /* Loading animation */
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }
        
        .animate-pulse {
            animation: pulse 2s infinite;
        }
    </style>

    <!-- JavaScript for Form Interactions -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('apotekForm');
            const inputs = form.querySelectorAll('input[type="text"]');
            const submitBtn = document.getElementById('submitBtn');
            const loadingSpinner = document.getElementById('loadingSpinner');

            // Real-time validation for each input
            inputs.forEach(input => {
                const checkIcon = document.getElementById(input.name + '_check');
                
                input.addEventListener('input', function() {
                    if (this.value.trim().length > 0) {
                        if (checkIcon) {
                            checkIcon.style.opacity = '1';
                        }
                        this.classList.add('border-green-300');
                        this.classList.remove('border-gray-200');
                    } else {
                        if (checkIcon) {
                            checkIcon.style.opacity = '0';
                        }
                        this.classList.remove('border-green-300');
                        this.classList.add('border-gray-200');
                    }
                });

                // Phone number specific validation
                if (input.name === 'no_hp') {
                    input.addEventListener('input', function() {
                        // Remove non-numeric characters
                        this.value = this.value.replace(/[^0-9]/g, '');
                        
                        // Validate length and format
                        const isValid = /^[0-9]{10,13}$/.test(this.value);
                        if (isValid && this.value.length >= 10) {
                            this.classList.add('border-green-300');
                            this.classList.remove('border-red-300');
                            if (checkIcon) checkIcon.style.opacity = '1';
                        } else if (this.value.length > 0) {
                            this.classList.add('border-red-300');
                            this.classList.remove('border-green-300', 'border-gray-200');
                            if (checkIcon) checkIcon.style.opacity = '0';
                        }
                    });
                }
            });

            // Form submission with loading state
            form.addEventListener('submit', function(e) {
                // Basic validation
                let isValid = true;
                inputs.forEach(input => {
                    if (input.value.trim() === '') {
                        isValid = false;
                        input.classList.add('border-red-400');
                        input.focus();
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    return;
                }

                // Show loading state
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-75', 'animate-pulse');
                loadingSpinner.classList.remove('hidden');
                
                // Re-enable after timeout to prevent permanent disable
                setTimeout(() => {
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-75', 'animate-pulse');
                    loadingSpinner.classList.add('hidden');
                }, 5000);
            });

            // Add floating label effect
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });
                
                input.addEventListener('blur', function() {
                    if (!this.value) {
                        this.parentElement.classList.remove('focused');
                    }
                });

                // Initialize state for pre-filled inputs
                if (input.value) {
                    input.parentElement.classList.add('focused');
                }
            });

            // Auto-format and validate inputs on paste
            inputs.forEach(input => {
                input.addEventListener('paste', function(e) {
                    setTimeout(() => {
                        this.dispatchEvent(new Event('input'));
                    }, 10);
                });
            });
        });
    </script>
</x-app-layout>