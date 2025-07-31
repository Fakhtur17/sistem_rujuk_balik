<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-orange-50 to-red-100 py-8">
        <div class="container mx-auto px-4 max-w-2xl">
            <!-- Header Section -->
            <div class="bg-white rounded-2xl shadow-xl p-8 mb-6">
                <div class="flex items-center space-x-4 mb-6">
                    <div class="bg-gradient-to-r from-orange-500 to-red-600 p-3 rounded-xl">
                        <i class="fa fa-edit text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Edit PIC PRB</h1>
                        <p class="text-gray-600">Perbarui informasi Person In Charge Program Rujuk Balik</p>
                    </div>
                </div>
                
                <!-- Current Data Preview -->
                <div class="bg-gradient-to-r from-orange-50 to-red-50 border border-orange-200 rounded-xl p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center text-orange-800">
                            <i class="fa fa-info-circle mr-2"></i>
                            <span class="font-medium">Sedang mengedit: {{ $picPrb->nama_pic }}</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="px-3 py-1 text-xs font-semibold rounded-full
                                @if($picPrb->jenis_pic == 'RS') bg-blue-100 text-blue-800
                                @elseif($picPrb->jenis_pic == 'FKTP') bg-green-100 text-green-800
                                @elseif($picPrb->jenis_pic == 'APOTEK') bg-purple-100 text-purple-800
                                @endif">
                                @if($picPrb->jenis_pic == 'RS') 🏥 RS
                                @elseif($picPrb->jenis_pic == 'FKTP') 👨‍⚕️ FKTP
                                @elseif($picPrb->jenis_pic == 'APOTEK') 💊 APOTEK
                                @endif
                            </span>
                        </div>
                    </div>
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
                <form action="{{ route('pic-prbs.update', $picPrb->id) }}" method="POST" class="space-y-6" id="editForm">
                    @csrf
                    @method('PUT')

                    <!-- Nama PIC -->
                    <div class="form-group">
                        <label for="nama_pic" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa fa-user mr-2 text-orange-500"></i>
                            Nama PIC
                            <span class="text-red-500 ml-1">*</span>
                        </label>
                        <div class="relative">
                            <input type="text" 
                                   name="nama_pic" 
                                   id="nama_pic" 
                                   class="w-full px-4 py-3 pl-12 border-2 border-gray-200 rounded-xl focus:border-orange-500 focus:ring-4 focus:ring-orange-100 transition-all duration-200 @error('nama_pic') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror" 
                                   value="{{ old('nama_pic', $picPrb->nama_pic) }}"
                                   placeholder="Masukkan nama lengkap PIC"
                                   required
                                   data-original="{{ $picPrb->nama_pic }}">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa fa-user text-gray-400"></i>
                            </div>
                            <!-- Change indicator -->
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                <i class="fa fa-check-circle text-green-500 opacity-0 transition-opacity duration-200" id="nama_check"></i>
                                <span class="text-xs text-gray-400 ml-2" id="nama_counter">0/100</span>
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
                            Perbarui nama lengkap sesuai dengan identitas resmi
                        </div>
                    </div>

                    <!-- Jenis PIC -->
                    <div class="form-group">
                        <label for="jenis_pic" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa fa-tags mr-2 text-red-500"></i>
                            Jenis PIC
                            <span class="text-red-500 ml-1">*</span>
                        </label>
                        <div class="relative">
                            <select name="jenis_pic" 
                                    id="jenis_pic" 
                                    class="w-full px-4 py-3 pl-12 border-2 border-gray-200 rounded-xl focus:border-orange-500 focus:ring-4 focus:ring-orange-100 transition-all duration-200 appearance-none bg-white @error('jenis_pic') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror" 
                                    required
                                    data-original="{{ $picPrb->jenis_pic }}">
                                <option value="">-- Pilih Jenis PIC --</option>
                                <option value="RS" {{ old('jenis_pic', $picPrb->jenis_pic) == 'RS' ? 'selected' : '' }}>
                                    🏥 Rumah Sakit (RS)
                                </option>
                                <option value="FKTP" {{ old('jenis_pic', $picPrb->jenis_pic) == 'FKTP' ? 'selected' : '' }}>
                                    👨‍⚕️ Fasilitas Kesehatan Tingkat Pertama (FKTP)
                                </option>
                                <option value="APOTEK" {{ old('jenis_pic', $picPrb->jenis_pic) == 'APOTEK' ? 'selected' : '' }}>
                                    💊 Apotek
                                </option>
                            </select>
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fa fa-tags text-gray-400"></i>
                            </div>
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                <i class="fa fa-check-circle text-green-500 opacity-0 transition-opacity duration-200" id="jenis_check"></i>
                                <i class="fa fa-chevron-down text-gray-400 ml-2"></i>
                            </div>
                            @error('jenis_pic') 
                                <div class="flex items-center mt-2 text-red-600 text-sm">
                                    <i class="fa fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </div> 
                            @enderror
                        </div>
                        
                        <!-- Current vs New Jenis Comparison -->
                        <div class="mt-3 p-3 bg-gray-50 rounded-lg" id="jenis-comparison" style="display: none;">
                            <div class="flex items-center justify-between text-sm">
                                <div class="flex items-center text-gray-600">
                                    <i class="fa fa-arrow-right mr-2"></i>
                                    <span>Perubahan jenis PIC akan mempengaruhi akses menu</span>
                                </div>
                            </div>
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
                            <span>Batal</span>
                        </a>
                        <button type="submit" 
                                class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-xl transition-all duration-200 text-center flex items-center justify-center space-x-2"
                                id="submitBtn">
                            <i class="fa fa-save"></i>
                            <span>Update Data</span>
                            <div class="hidden ml-2" id="loadingSpinner">
                                <i class="fa fa-spinner fa-spin"></i>
                            </div>
                        </button>
                    </div>

                    <!-- Changes Detection -->
                    <div class="bg-orange-50 border border-orange-200 rounded-xl p-4 mt-6" id="changes-indicator" style="display: none;">
                        <div class="flex items-center text-orange-800">
                            <i class="fa fa-exclamation-triangle mr-2"></i>
                            <span class="font-medium">Ada perubahan yang belum disimpan</span>
                            <button type="button" id="reset-changes" class="ml-auto text-orange-600 hover:text-orange-800 text-sm underline">
                                Reset ke data awal
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                <!-- Edit Tips Card -->
                <div class="bg-orange-50 border border-orange-200 rounded-xl p-4">
                    <div class="flex items-start space-x-3">
                        <i class="fa fa-lightbulb-o text-orange-500 text-lg mt-1"></i>
                        <div>
                            <h4 class="font-semibold text-orange-800 mb-2">Tips Edit Data</h4>
                            <ul class="text-sm text-orange-700 space-y-1">
                                <li>• Perubahan akan langsung tersimpan setelah klik Update</li>
                                <li>• Pastikan data baru sudah sesuai dan akurat</li>
                                <li>• Gunakan tombol Reset jika ingin membatalkan</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Impact Warning Card -->
                <div class="bg-red-50 border border-red-200 rounded-xl p-4">
                    <div class="flex items-start space-x-3">
                        <i class="fa fa-exclamation-triangle text-red-500 text-lg mt-1"></i>
                        <div>
                            <h4 class="font-semibold text-red-800 mb-2">Perhatian</h4>
                            <ul class="text-sm text-red-700 space-y-1">
                                <li>• Perubahan jenis PIC akan mempengaruhi akses menu</li>
                                <li>• Data terkait mungkin perlu disesuaikan ulang</li>
                                <li>• Pastikan koordinasi dengan tim terkait</li>
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
            box-shadow: 0 10px 25px rgba(251, 146, 60, 0.15);
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
        
        .input-changed {
            border-color: #f97316 !important;
            background-color: #fff7ed;
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
            const jenisSelect = document.getElementById('jenis_pic');
            const namaCounter = document.getElementById('nama_counter');
            const namaCheck = document.getElementById('nama_check');
            const jenisCheck = document.getElementById('jenis_check');
            const jenisCards = document.querySelectorAll('.jenis-card');
            const jenisComparison = document.getElementById('jenis-comparison');
            const changesIndicator = document.getElementById('changes-indicator');
            const resetButton = document.getElementById('reset-changes');
            const form = document.getElementById('editForm');
            const submitBtn = document.getElementById('submitBtn');
            const loadingSpinner = document.getElementById('loadingSpinner');
            
            let originalValues = {
                nama_pic: namaInput.dataset.original,
                jenis_pic: jenisSelect.dataset.original
            };
            let hasChanges = false;

            // Character counter for nama input
            function updateNameCounter() {
                const length = namaInput.value.length;
                namaCounter.textContent = `${length}/100`;
                
                if (length > 80) {
                    namaCounter.classList.add('text-red-500');
                    namaCounter.classList.remove('text-gray-400');
                } else {
                    namaCounter.classList.add('text-gray-400');
                    namaCounter.classList.remove('text-red-500');
                }
            }

            // Check for changes
            function checkChanges() {
                const namaChanged = namaInput.value !== originalValues.nama_pic;
                const jenisChanged = jenisSelect.value !== originalValues.jenis_pic;
                
                // Visual feedback for nama
                if (namaChanged) {
                    namaInput.classList.add('input-changed');
                    namaCheck.style.opacity = '1';
                } else {
                    namaInput.classList.remove('input-changed');
                    namaCheck.style.opacity = '0';
                }
                
                // Visual feedback for jenis
                if (jenisChanged) {
                    jenisSelect.classList.add('input-changed');
                    jenisCheck.style.opacity = '1';
                    jenisComparison.style.display = 'block';
                } else {
                    jenisSelect.classList.remove('input-changed');
                    jenisCheck.style.opacity = '0';
                    jenisComparison.style.display = 'none';
                }
                
                hasChanges = namaChanged || jenisChanged;
                changesIndicator.style.display = hasChanges ? 'block' : 'none';
            }

            // Show/hide jenis PIC info cards
            function updateJenisCards() {
                const selectedValue = jenisSelect.value;
                
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
            }

            // Event listeners
            namaInput.addEventListener('input', function() {
                updateNameCounter();
                checkChanges();
            });

            jenisSelect.addEventListener('change', function() {
                updateJenisCards();
                checkChanges();
            });

            // Reset changes
            resetButton.addEventListener('click', function() {
                namaInput.value = originalValues.nama_pic;
                jenisSelect.value = originalValues.jenis_pic;
                updateNameCounter();
                updateJenisCards();
                checkChanges();
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

            // Warn before leaving if there are unsaved changes
            window.addEventListener('beforeunload', function(e) {
                if (hasChanges) {
                    e.preventDefault();
                    e.returnValue = '';
                }
            });

            // Don't warn when submitting the form
            form.addEventListener('submit', function() {
                hasChanges = false;
            });

            // Initialize
            updateNameCounter();
            updateJenisCards();
        });
    </script>
</x-app-layout>