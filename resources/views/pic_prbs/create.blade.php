<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-emerald-50 to-teal-100 py-8">
        <div class="container mx-auto px-4 max-w-2xl">
            <!-- Header Section -->
            <div class="bg-white rounded-2xl shadow-xl p-8 mb-6">
                <div class="flex items-center space-x-4 mb-6">
                    <div class="bg-gradient-to-r from-emerald-500 to-teal-600 p-3 rounded-xl">
                        <i class="fa fa-user-plus text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Tambah PIC PRB</h1>
                        <p class="text-gray-600">Tambahkan Person In Charge Program Rujuk Balik yang baru</p>
                    </div>
                </div>
                
                <!-- Progress Indicator -->
                <div class="flex items-center space-x-2 text-sm text-gray-500">
                    <span class="flex items-center">
                        <div class="w-2 h-2 bg-emerald-500 rounded-full mr-2"></div>
                        Langkah 1 dari 2
                    </span>
                    <span>•</span>
                    <span>Data Dasar PIC</span>
                </div>
            </div>

            <!-- Error Alert -->
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-400 p-6 rounded-r-xl mb-6 animate-shake">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="fa fa-exclamation-triangle text-red-400 text-xl"></i>
                        </div>
                        <div class="ml-3 flex-1">
                            <h3 class="text-sm font-medium text-red-800 mb-2">Terdapat beberapa kesalahan:</h3>
                            <ul class="text-sm text-red-700 space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li class="flex items-center">
                                        <i class="fa fa-times-circle mr-2 text-xs"></i>
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Form Section -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <form action="{{ route('pic-prbs.store') }}" method="POST" class="space-y-6" id="picForm">
                    @csrf

                    <!-- Nama PIC -->
                    <div class="form-group">
                        <label for="nama_pic" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa fa-user mr-2 text-emerald-500"></i>
                            Nama PIC
                            <span class="text-red-500 ml-1">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" 
                                   name="nama_pic" 
                                   id="nama_pic" 
                                   class="w-full px-4 py-3 pl-12 border-2 border-gray-200 rounded-xl focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition-all duration-200 @error('nama_pic') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror" 
                                   value="{{ old('nama_pic') }}"
                                   placeholder="Masukkan nama lengkap PIC"
                                   required>
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa fa-user text-gray-400"></i>
                            </div>
                            <!-- Character counter -->
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <span class="text-xs text-gray-400" id="nama_counter">0/100</span>
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
                            Masukkan nama lengkap sesuai dengan identitas resmi
                        </div>
                    </div>

                    <!-- Jenis PIC -->
                    <div class="form-group">
                        <label for="jenis_pic" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa fa-tags mr-2 text-teal-500"></i>
                            Jenis PIC
                            <span class="text-red-500 ml-1">*</span>
                        </label>
                        <div class="relative">
                            <select name="jenis_pic" 
                                    id="jenis_pic" 
                                    class="w-full px-4 py-3 pl-12 border-2 border-gray-200 rounded-xl focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition-all duration-200 appearance-none bg-white @error('jenis_pic') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror" 
                                    required>
                                <option value="">-- Pilih Jenis PIC --</option>
                                <option value="RS" {{ old('jenis_pic') == 'RS' ? 'selected' : '' }} data-icon="fa-hospital-o" data-color="text-blue-600">
                                    🏥 Rumah Sakit (RS)
                                </option>
                                <option value="FKTP" {{ old('jenis_pic') == 'FKTP' ? 'selected' : '' }} data-icon="fa-user-md" data-color="text-green-600">
                                    👨‍⚕️ Fasilitas Kesehatan Tingkat Pertama (FKTP)
                                </option>
                                <option value="APOTEK" {{ old('jenis_pic') == 'APOTEK' ? 'selected' : '' }} data-icon="fa-medkit" data-color="text-purple-600">
                                    💊 Apotek
                                </option>
                            </select>
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa fa-tags text-gray-400"></i>
                            </div>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fa fa-chevron-down text-gray-400"></i>
                            </div>
                            @error('jenis_pic') 
                                <div class="flex items-center mt-2 text-red-600 text-sm">
                                    <i class="fa fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </div> 
                            @enderror
                        </div>
                        
                        <!-- Jenis PIC Info Cards -->
                        <div class="mt-3 grid grid-cols-1 md:grid-cols-3 gap-3" id="jenis-info">
                            <div class="jenis-card hidden border-2 border-blue-200 bg-blue-50 rounded-lg p-3" data-jenis="RS">
                                <div class="flex items-center space-x-2">
                                    <i class="fa fa-hospital-o text-blue-600"></i>
                                    <div>
                                        <div class="text-sm font-semibold text-blue-800">Rumah Sakit</div>
                                        <div class="text-xs text-blue-600">Pelayanan kesehatan rujukan</div>
                                    </div>
                                </div>
                            </div>
                            <div class="jenis-card hidden border-2 border-green-200 bg-green-50 rounded-lg p-3" data-jenis="FKTP">
                                <div class="flex items-center space-x-2">
                                    <i class="fa fa-user-md text-green-600"></i>
                                    <div>
                                        <div class="text-sm font-semibold text-green-800">FKTP</div>
                                        <div class="text-xs text-green-600">Pelayanan kesehatan primer</div>
                                    </div>
                                </div>
                            </div>
                            <div class="jenis-card hidden border-2 border-purple-200 bg-purple-50 rounded-lg p-3" data-jenis="APOTEK">
                                <div class="flex items-center space-x-2">
                                    <i class="fa fa-medkit text-purple-600"></i>
                                    <div>
                                        <div class="text-sm font-semibold text-purple-800">Apotek</div>
                                        <div class="text-xs text-purple-600">Pelayanan kefarmasian</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-100">
                        <a href="{{ route('pic-prbs.index') }}" 
                           class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-xl transition-all duration-200 text-center flex items-center justify-center space-x-2">
                            <i class="fa fa-arrow-left"></i>
                            <span>Kembali</span>
                        </a>
                        <button type="submit" 
                                class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-xl transition-all duration-200 text-center flex items-center justify-center space-x-2"
                                id="submitBtn">
                            <i class="fa fa-save"></i>
                            <span>Simpan Data</span>
                            <div class="hidden ml-2" id="loadingSpinner">
                                <i class="fa fa-spinner fa-spin"></i>
                            </div>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <!-- Tips Card -->
                <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4">
                    <div class="flex items-start space-x-3">
                        <i class="fa fa-lightbulb-o text-emerald-500 text-lg mt-1"></i>
                        <div>
                            <h4 class="font-semibold text-emerald-800 mb-2">Tips Pengisian</h4>
                            <ul class="text-sm text-emerald-700 space-y-1">
                                <li>• Pastikan nama PIC sesuai dengan identitas resmi</li>
                                <li>• Pilih jenis PIC sesuai dengan institusi</li>
                                <li>• Data dapat diperbarui setelah disimpan</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Next Steps Card -->
                <div class="bg-teal-50 border border-teal-200 rounded-xl p-4">
                    <div class="flex items-start space-x-3">
                        <i class="fa fa-road text-teal-500 text-lg mt-1"></i>
                        <div>
                            <h4 class="font-semibold text-teal-800 mb-2">Langkah Selanjutnya</h4>
                            <ul class="text-sm text-teal-700 space-y-1">
                                <li>• Setelah disimpan, Anda dapat menambah detail FKTP</li>
                                <li>• Kelola data kontak dan informasi tambahan</li>
                                <li>• Monitor aktivitas PRB secara berkala</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        .form-group input:focus, .form-group select:focus {
            transform: translateY(-1px);
            box-shadow: 0 10px 25px rgba(16, 185, 129, 0.15);
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
        
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
            20%, 40%, 60%, 80% { transform: translateX(5px); }
        }
        
        .animate-shake {
            animation: shake 0.5s ease-in-out;
        }
        
        .bg-gradient-to-br {
            background-attachment: fixed;
        }
        
        .jenis-card {
            transition: all 0.3s ease;
        }
        
        .jenis-card.show {
            animation: slideInUp 0.3s ease-out;
        }
        
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <!-- JavaScript for Interactions -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const namaInput = document.getElementById('nama_pic');
            const namaCounter = document.getElementById('nama_counter');
            const jenisSelect = document.getElementById('jenis_pic');
            const jenisCards = document.querySelectorAll('.jenis-card');
            const form = document.getElementById('picForm');
            const submitBtn = document.getElementById('submitBtn');
            const loadingSpinner = document.getElementById('loadingSpinner');

            // Character counter for nama input
            namaInput.addEventListener('input', function() {
                const length = this.value.length;
                namaCounter.textContent = `${length}/100`;
                
                if (length > 80) {
                    namaCounter.classList.add('text-red-500');
                    namaCounter.classList.remove('text-gray-400');
                } else {
                    namaCounter.classList.add('text-gray-400');
                    namaCounter.classList.remove('text-red-500');
                }
            });

            // Show/hide jenis PIC info cards
            jenisSelect.addEventListener('change', function() {
                const selectedValue = this.value;
                
                jenisCards.forEach(card => {
                    card.classList.add('hidden');
                    card.classList.remove('show');
                });
                
                if (selectedValue) {
                    const targetCard = document.querySelector(`[data-jenis="${selectedValue}"]`);
                    if (targetCard) {
                        targetCard.classList.remove('hidden');
                        targetCard.classList.add('show');
                    }
                }
            });

            // Form submission with loading state
            form.addEventListener('submit', function(e) {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-75');
                loadingSpinner.classList.remove('hidden');
                
                // Re-enable after 3 seconds to prevent permanent disable
                setTimeout(() => {
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-75');
                    loadingSpinner.classList.add('hidden');
                }, 3000);
            });

            // Initialize character counter
            if (namaInput.value) {
                namaCounter.textContent = `${namaInput.value.length}/100`;
            }

            // Initialize selected jenis card
            if (jenisSelect.value) {
                const targetCard = document.querySelector(`[data-jenis="${jenisSelect.value}"]`);
                if (targetCard) {
                    targetCard.classList.remove('hidden');
                    targetCard.classList.add('show');
                }
            }

            // Add floating label effect
            const inputs = document.querySelectorAll('input, select');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.classList.add('focused');
                });
                
                input.addEventListener('blur', function() {
                    if (!this.value) {
                        this.parentElement.classList.remove('focused');
                    }
                });
            });
        });
    </script>
</x-app-layout>