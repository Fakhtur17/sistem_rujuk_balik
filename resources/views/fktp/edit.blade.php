<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-purple-50 to-indigo-50">
        <!-- Header Section -->
        <div class="bg-white shadow-sm border-b border-gray-200">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </div>
                    <h1 class="text-2xl font-bold text-gray-900">Edit Data FKTP</h1>
                </div>
            </div>
        </div>

        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <!-- Form Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-4 bg-gradient-to-r from-purple-50 to-indigo-50 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Form Edit FKTP</h2>
                    <p class="text-sm text-gray-600 mt-1">Perbarui data FKTP yang sudah ada</p>
                </div>

                <form action="{{ route('fktps.update', $fktp->id) }}" method="POST" class="p-6 space-y-6">
                    @csrf 
                    @method('PUT')

                    <!-- Nama FKTP -->
                    <div>
                        <label for="nama_fktp" class="block text-sm font-medium text-gray-700 mb-2">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-purple-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                Nama FKTP
                            </div>
                        </label>
                        <input type="text" 
                               name="nama_fktp" 
                               id="nama_fktp"
                               class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors duration-200 placeholder-gray-400"
                               placeholder="Masukkan nama FKTP"
                               value="{{ old('nama_fktp', $fktp->nama_fktp) }}"
                               required>
                        @error('nama_fktp')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kabupaten/Kota -->
                    <div>
                        <label for="kabupaten_kota" class="block text-sm font-medium text-gray-700 mb-2">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-purple-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                Kabupaten/Kota
                            </div>
                        </label>
                        <input type="text" 
                               name="kabupaten_kota" 
                               id="kabupaten_kota"
                               class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 transition-colors duration-200 placeholder-gray-400"
                               placeholder="Masukkan kabupaten/kota"
                               value="{{ old('kabupaten_kota', $fktp->kabupaten_kota) }}"
                               required>
                        @error('kabupaten_kota')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-3 pt-4">
                        <button type="submit" 
                                class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-purple-500 to-indigo-500 text-white rounded-lg hover:from-purple-600 hover:to-indigo-600 transition-all duration-300 shadow-md hover:shadow-lg font-medium">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                            Update Data
                        </button>
                        
                        <a href="{{ route('fktps.index') }}" 
                           class="flex-1 inline-flex items-center justify-center px-6 py-3 bg-white text-gray-700 border border-gray-300 rounded-lg hover:bg-gray-50 transition-all duration-300 shadow-sm hover:shadow-md font-medium">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali
                        </a>
                    </div>
                </form>
            </div>

            <!-- Current Data Info -->
            <div class="mt-6 bg-indigo-50 border border-indigo-200 rounded-lg p-4">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-indigo-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    <div>
                        <h4 class="text-sm font-medium text-indigo-800">Data Saat Ini</h4>
                        <div class="mt-2 text-sm text-indigo-700">
                            <p><strong>Nama FKTP:</strong> {{ $fktp->nama_fktp }}</p>
                            <p><strong>Kabupaten/Kota:</strong> {{ $fktp->kabupaten_kota }}</p>
                            @if($fktp->jumlah_peserta)
                                <p><strong>Jumlah Peserta PRB:</strong> {{ $fktp->jumlah_peserta }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Help Text -->
            <div class="mt-6 bg-purple-50 border border-purple-200 rounded-lg p-4">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-purple-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h4 class="text-sm font-medium text-purple-800">Panduan Edit</h4>
                        <div class="mt-2 text-sm text-purple-700">
                            <ul class="list-disc list-inside space-y-1">
                                <li>Pastikan nama FKTP diisi dengan lengkap dan benar</li>
                                <li>Kabupaten/Kota harus sesuai dengan lokasi FKTP</li>
                                <li>Klik "Update Data" untuk menyimpan perubahan</li>
                                <li>Data yang sudah diupdate tidak dapat dikembalikan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>