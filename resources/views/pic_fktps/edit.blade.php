{{-- resources/views/pic_fktps/edit.blade.php --}}
<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-amber-50 to-orange-100 py-8">
        <div class="container mx-auto px-4 max-w-2xl">
            <!-- Header Section -->
            <div class="bg-white rounded-2xl shadow-xl p-8 mb-6">
                <div class="flex items-center space-x-4 mb-6">
                    <div class="bg-gradient-to-r from-amber-500 to-orange-600 p-3 rounded-xl">
                        <i class="fa fa-edit text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Edit PIC FKTP</h1>
                        <p class="text-gray-600">Perbarui informasi PIC FKTP yang sudah ada</p>
                    </div>
                </div>
                
                <!-- Data Preview Card -->
                <div class="bg-gradient-to-r from-amber-50 to-orange-50 border border-amber-200 rounded-xl p-4">
                    <div class="flex items-center text-amber-800">
                        <i class="fa fa-info-circle mr-2"></i>
                        <span class="font-medium">Sedang mengedit data: {{ $data->nama_pic }} - {{ $data->nama_faskes }}</span>
                    </div>
                </div>
            </div>

            <!-- Form Section -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <form action="{{ route('pic-fktps.update', ['picPrb' => $data->pic_prb_id, 'id' => $data->id]) }}" method="POST" class="space-y-6">
                    @csrf 
                    @method('PUT')

                    <!-- Nama FKTP -->
                    <div class="form-group">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa fa-hospital-o mr-2 text-blue-500"></i>
                            Nama FKTP
                        </label>
                        <div class="relative">
                            <input type="text" 
                                   name="nama_faskes" 
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-100 transition-all duration-200 @error('nama_faskes') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror" 
                                   value="{{ old('nama_faskes', $data->nama_faskes) }}"
                                   placeholder="Masukkan nama FKTP">
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
                    </div>

                    <!-- Kab/Kota -->
                    <div class="form-group">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa fa-map-marker mr-2 text-green-500"></i>
                            Kabupaten/Kota
                        </label>
                        <div class="relative">
                            <input type="text" 
                                   name="kab_kota" 
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-100 transition-all duration-200 @error('kab_kota') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror" 
                                   value="{{ old('kab_kota', $data->kab_kota) }}"
                                   placeholder="Masukkan kabupaten/kota">
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
                    </div>

                    <!-- Nama PIC -->
                    <div class="form-group">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa fa-user mr-2 text-purple-500"></i>
                            Nama PIC
                        </label>
                        <div class="relative">
                            <input type="text" 
                                   name="nama_pic" 
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-100 transition-all duration-200 @error('nama_pic') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror" 
                                   value="{{ old('nama_pic', $data->nama_pic) }}"
                                   placeholder="Masukkan nama PIC">
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
                    </div>

                    <!-- No HP -->
                    <div class="form-group">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa fa-phone mr-2 text-orange-500"></i>
                            Nomor HP
                        </label>
                        <div class="relative">
                            <input type="text" 
                                   name="no_hp" 
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-amber-500 focus:ring-4 focus:ring-amber-100 transition-all duration-200 @error('no_hp') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror" 
                                   value="{{ old('no_hp', $data->no_hp) }}"
                                   placeholder="Masukkan nomor HP">
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
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6">
                        <button type="submit" class="flex-1 bg-gradient-to-r from-yellow-400 to-yellow-500 hover:from-yellow-500 hover:to-yellow-600 text-gray-800 font-semibold py-3 px-6 rounded-xl transition-all duration-200 transform hover:scale-105 shadow-md hover:shadow-xl">
                            <i class="fa fa-save mr-2"></i>
                            Update Data
                        </button>

                        <a href="{{ route('pic-fktps.index', $data->pic_prb_id) }}"
                        class="flex-1 bg-blue-100 hover:bg-blue-200 text-blue-700 font-semibold py-3 px-6 rounded-xl transition-all duration-200 text-center border border-blue-300">
                            <i class="fa fa-arrow-left mr-2"></i>
                            Batal
                        </a>
                    </div>


                    <!-- Changes Detection -->
                    <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 mt-6" id="changes-indicator" style="display: none;">
                        <div class="flex items-center text-amber-800">
                            <i class="fa fa-exclamation-triangle mr-2"></i>
                            <span class="font-medium">Ada perubahan yang belum disimpan</span>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Info Card -->
            <div class="bg-amber-50 border-l-4 border-amber-400 p-4 rounded-r-xl mt-6">
                <div class="flex items-center">
                    <i class="fa fa-lightbulb-o text-amber-400 mr-3"></i>
                    <p class="text-amber-800 text-sm">
                        <strong>Tips:</strong> Perubahan akan otomatis tersimpan setelah Anda menekan tombol "Update Data".
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Styles & Scripts -->
    <style>
        .form-group input:focus {
            transform: translateY(-1px);
            box-shadow: 0 10px 25px rgba(245, 158, 11, 0.15);
        }
        
        .form-group label {
            position: relative;
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
        
        .input-changed {
            border-color: #f59e0b !important;
            background-color: #fffbeb;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const inputs = form.querySelectorAll('input[type="text"]');
            const changesIndicator = document.getElementById('changes-indicator');
            let originalValues = {};
            let hasChanges = false;

            // Store original values
            inputs.forEach(input => {
                originalValues[input.name] = input.value;
            });

            // Monitor changes
            inputs.forEach(input => {
                input.addEventListener('input', function() {
                    const checkIcon = document.getElementById(this.name + '_check');
                    
                    if (this.value !== originalValues[this.name]) {
                        this.classList.add('input-changed');
                        hasChanges = true;
                        if (checkIcon) checkIcon.style.opacity = '1';
                    } else {
                        this.classList.remove('input-changed');
                        if (checkIcon) checkIcon.style.opacity = '0';
                    }

                    // Check if any input has changes
                    hasChanges = Array.from(inputs).some(inp => inp.value !== originalValues[inp.name]);
                    changesIndicator.style.display = hasChanges ? 'block' : 'none';
                });
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
        });
    </script>
</x-app-layout>