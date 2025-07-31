{{-- resources/views/pic_fktps/create.blade.php --}}
<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-8">
        <div class="container mx-auto px-4 max-w-2xl">
            <!-- Header Section -->
            <div class="bg-white rounded-2xl shadow-xl p-8 mb-6">
                <div class="flex items-center space-x-4 mb-6">
                    <div class="bg-gradient-to-r from-blue-500 to-indigo-600 p-3 rounded-xl">
                        <i class="fa fa-user-plus text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">Tambah PIC FKTP</h1>
                        <p class="text-gray-600">Tambahkan informasi PIC FKTP yang baru</p>
                    </div>
                </div>
            </div>

            <!-- Form Section -->
            <div class="bg-white rounded-2xl shadow-xl p-8">
                <form action="{{ route('pic-fktps.store', $pic_prb_id) }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- Nama FKTP -->
                    <div class="form-group">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa fa-hospital-o mr-2 text-blue-500"></i>
                            Nama FKTP
                        </label>
                        <div class="relative">
                            <input type="text" 
                                   name="nama_faskes" 
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 @error('nama_faskes') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror" 
                                   value="{{ old('nama_faskes') }}"
                                   placeholder="Masukkan nama FKTP">
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
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 @error('kab_kota') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror" 
                                   value="{{ old('kab_kota') }}"
                                   placeholder="Masukkan kabupaten/kota">
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
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 @error('nama_pic') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror" 
                                   value="{{ old('nama_pic') }}"
                                   placeholder="Masukkan nama PIC">
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
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 @error('no_hp') border-red-400 focus:border-red-500 focus:ring-red-100 @enderror" 
                                   value="{{ old('no_hp') }}"
                                   placeholder="Masukkan nomor HP">
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
                        <button type="submit" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-xl transition-all duration-200 text-center">
                            <i class="fa fa-save mr-2"></i>
                            Simpan Data
                        </button>
                        <a href="{{ route('pic-fktps.index', $pic_prb_id) }}" class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold py-3 px-6 rounded-xl transition-all duration-200 text-center">
                            <i class="fa fa-arrow-left mr-2"></i>
                            Kembali
                        </a>

                    </div>
                </form>
            </div>

            <!-- Info Card -->
            <div class="bg-blue-50 border-l-4 border-blue-400 p-4 rounded-r-xl mt-6">
                <div class="flex items-center">
                    <i class="fa fa-info-circle text-blue-400 mr-3"></i>
                    <p class="text-blue-800 text-sm">
                        <strong>Tips:</strong> Pastikan semua data yang dimasukkan sudah benar sebelum menyimpan.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        .form-group input:focus {
            transform: translateY(-1px);
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.15);
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
    </style>
</x-app-layout>