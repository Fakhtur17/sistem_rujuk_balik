{{-- resources/views/pic_fktps/index.blade.php --}}
<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-cyan-100 py-8">
        <div class="container mx-auto px-4 max-w-7xl">
            <!-- Header Section -->
            <div class="bg-white rounded-2xl shadow-xl p-8 mb-6">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between lg:gap-0">
                    <!-- Judul -->
                    <div class="flex items-start space-x-4">
                        <div class="bg-gradient-to-r from-blue-500 to-cyan-600 p-3 rounded-xl">
                            <i class="fa fa-list-alt text-white text-xl"></i>
                        </div>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-800">Daftar PIC FKTP</h1>
                            <p class="text-gray-600">Kelola data Person In Charge Fasilitas Kesehatan Tingkat Pertama</p>
                        </div>
                    </div>

                    <!-- Tombol Tambah & Kembali -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-2">
                        <!-- Tombol Tambah -->
                        @auth
                            @if (auth()->user()->role === 'admin')
                                <a href="{{ route('pic-fktps.create', $pic_prb_id) }}" 
                                class="inline-flex items-center space-x-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-6 rounded-xl transition-all duration-200 transform hover:scale-105 shadow">
                                    <i class="fa fa-plus"></i>
                                    <span>Tambah PIC FKTP</span>
                                </a>
                            @endif
                        @endauth

                        <!-- Tombol Kembali -->
                        <a href="{{ route('pic-prbs.index') }}" 
                        class="inline-flex items-center space-x-2 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-6 rounded-xl transition-all duration-200 transform hover:scale-105 shadow">
                            <i class="fa fa-arrow-left"></i>
                            <span>Kembali</span>
                        </a>
                    </div>
                </div>


                <!-- Stats Banner -->
                <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div class="bg-gradient-to-r from-blue-100 to-blue-200 border border-blue-300 rounded-xl p-4">
                        <div class="flex items-center space-x-3">
                            <div class="text-2xl">🏥</div>
                            <div>
                                <div class="font-semibold text-blue-800">Total FKTP</div>
                                <div class="text-2xl font-bold text-blue-900">{{ count($data) }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gradient-to-r from-cyan-100 to-cyan-200 border border-cyan-300 rounded-xl p-4">
                        <div class="flex items-center space-x-3">
                            <div class="text-2xl">👨‍⚕️</div>
                            <div>
                                <div class="font-semibold text-cyan-800">PIC Aktif</div>
                                <div class="text-2xl font-bold text-cyan-900">{{ count($data) }}</div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gradient-to-r from-teal-100 to-teal-200 border border-teal-300 rounded-xl p-4">
                        <div class="flex items-center space-x-3">
                            <div class="text-2xl">🩺</div>
                            <div>
                                <div class="font-semibold text-teal-800">Program PRB</div>
                                <div class="text-lg font-bold text-teal-900">Aktif</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Success Alert -->
            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-6 py-4 rounded-xl mb-6 flex items-center animate-pulse">
                    <i class="fa fa-check-circle text-green-500 mr-3 text-xl"></i>
                    <div>
                        <div class="font-semibold">Berhasil!</div>
                        <div class="text-sm">{{ session('success') }}</div>
                    </div>
                </div>
            @endif

            <!-- Data Table Section -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- Table Header -->
                <div class="bg-gradient-to-r from-blue-500 to-cyan-600 px-8 py-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">
                        <i class="fa fa-table mr-3"></i>
                        Data PIC FKTP
                    </h2>
                </div>


                <!-- Table Content -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gradient-to-r from-blue-100 to-cyan-100 border-b border-blue-200">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-blue-800 w-16">
                                    <i class="fa fa-hashtag mr-1"></i>No
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-blue-800">
                                    <i class="fa fa-hospital mr-1"></i>Nama FKTP
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-blue-800">
                                    <i class="fa fa-map-marker mr-1"></i>Kab/Kota
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-blue-800">
                                    <i class="fa fa-user-md mr-1"></i>Nama PIC
                                </th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-blue-800">
                                    <i class="fa fa-phone mr-1"></i>No HP
                                </th>
                                @if(auth()->user() && auth()->user()->role === 'admin')
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-blue-800 w-32">
                                        <i class="fa fa-cogs mr-1"></i>Aksi
                                    </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($data as $index => $item)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 text-center text-sm font-medium text-gray-900">
                                        <div class="w-8 h-8 bg-white border border-gray-300 rounded-full flex items-center justify-center text-black text-xs font-bold">
                                            {{ $index + 1 }}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                                <i class="fa fa-hospital text-blue-600"></i>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">{{ $item->nama_faskes }}</div>
                                                <div class="text-xs text-gray-500">FKTP PRB</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-2">
                                            <i class="fa fa-map-marker text-cyan-500"></i>
                                            <span class="text-sm text-gray-900">{{ $item->kab_kota }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-2">
                                            <i class="fa fa-user-md text-teal-500"></i>
                                            <span class="text-sm text-gray-900">{{ $item->nama_pic }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-2">
                                            <i class="fa fa-phone text-orange-500"></i>
                                            <a href="tel:{{ $item->no_hp }}" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                                                {{ $item->no_hp }}
                                            </a>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center justify-center space-x-2">
                                            @if(auth()->user() && auth()->user()->role === 'admin')
                                                <!-- Edit Button -->
                                                <a href="{{ route('pic-fktps.edit', ['picPrb' => $pic_prb_id, 'id' => $item->id]) }}" 
                                                class="inline-flex items-center justify-center w-8 h-8 bg-yellow-100 hover:bg-yellow-200 text-yellow-600 hover:text-yellow-700 rounded-lg transition-all duration-200 transform hover:scale-110"
                                                title="Edit Data">
                                                    <i class="fa fa-edit text-sm"></i>
                                                </a>
                                                
                                                <!-- Delete Button -->
                                                <form action="{{ route('pic-fktps.destroy', ['picPrb' => $pic_prb_id, 'id' => $item->id]) }}" 
                                                    method="POST" 
                                                    class="inline-block"
                                                    onsubmit="return confirmDelete(event, '{{ $item->nama_faskes }}')">
                                                    @csrf 
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="inline-flex items-center justify-center w-8 h-8 bg-red-100 hover:bg-red-200 text-red-600 hover:text-red-700 rounded-lg transition-all duration-200 transform hover:scale-110"
                                                            title="Hapus Data">
                                                        <i class="fa fa-trash text-sm"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-16 text-center">
                                        <div class="flex flex-col items-center space-y-4">
                                            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center">
                                                <i class="fa fa-inbox text-gray-400 text-3xl"></i>
                                            </div>
                                            <div>
                                                <div class="text-lg font-medium text-gray-900">Belum ada data PIC FKTP</div>
                                                <div class="text-sm text-gray-500 mt-1">Klik tombol "Tambah Data" untuk menambahkan PIC FKTP baru</div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Info Cards -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-6">
                <!-- Guidelines Card -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
                    <div class="flex items-start space-x-3">
                        <i class="fa fa-info-circle text-blue-500 text-lg mt-1"></i>
                        <div>
                            <h4 class="font-semibold text-blue-800 mb-3">Panduan Pengelolaan Data FKTP</h4>
                            <ul class="text-sm text-blue-700 space-y-2">
                                <li class="flex items-start">
                                    <i class="fa fa-check-circle text-blue-500 mr-2 mt-0.5 text-xs"></i>
                                    <span>Bisa menambahkan multiple PIC FKTP sesuai kebutuhan</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fa fa-check-circle text-blue-500 mr-2 mt-0.5 text-xs"></i>
                                    <span>FKTP meliputi Puskesmas, Klinik, dan Dokter Keluarga</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fa fa-check-circle text-blue-500 mr-2 mt-0.5 text-xs"></i>
                                    <span>Pastikan PIC memiliki akses ke sistem rujuk balik</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fa fa-check-circle text-blue-500 mr-2 mt-0.5 text-xs"></i>
                                    <span>Koordinasikan dengan FKRTL untuk kontinuitas pelayanan</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Contact Support Card -->
                <div class="bg-cyan-50 border border-cyan-200 rounded-xl p-6">
                    <div class="flex items-start space-x-3">
                        <i class="fa fa-headset text-cyan-500 text-lg mt-1"></i>
                        <div>
                            <h4 class="font-semibold text-cyan-800 mb-3">Butuh Bantuan?</h4>
                            <div class="space-y-3">
                                <div class="flex items-center space-x-3">
                                    <i class="fa fa-phone text-cyan-600"></i>
                                    <span class="text-sm text-cyan-700">Hotline: 1500-400 (24 jam)</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <i class="fa fa-envelope text-cyan-600"></i>
                                    <span class="text-sm text-cyan-700">Email: support@bpjs-kesehatan.go.id</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <i class="fa fa-globe text-cyan-600"></i>
                                    <span class="text-sm text-cyan-700">Portal: www.bpjs-kesehatan.go.id</span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <i class="fa fa-book text-cyan-600"></i>
                                    <span class="text-sm text-cyan-700">Panduan FKTP tersedia di portal</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Info -->
            <div class="bg-gradient-to-r from-blue-100 to-cyan-100 border border-blue-200 rounded-xl p-4 mt-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center text-blue-800">
                        <i class="fa fa-shield mr-2"></i>
                        <span class="font-medium">Data dikelola dengan standar keamanan tinggi</span>
                    </div>
                    <div class="text-sm text-blue-600">
                        <i class="fa fa-clock mr-1"></i>
                        Terakhir diperbarui: {{ date('d M Y, H:i') }} WIB
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
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
        
        /* Table hover effects */
        tbody tr:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }
        
        /* Button hover animations */
        .hover\:scale-105:hover {
            transform: scale(1.05);
        }
        
        .hover\:scale-110:hover {
            transform: scale(1.1);
        }
        
        /* Success alert animation */
        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translate3d(0, -100%, 0);
            }
            to {
                opacity: 1;
                transform: translate3d(0, 0, 0);
            }
        }
        
        .animate-pulse {
            animation: slideInDown 0.5s ease-out;
        }
        
        /* Phone number styling */
        a[href^="tel:"] {
            text-decoration: none;
        }
        
        a[href^="tel:"]:hover {
            text-decoration: underline;
        }
    </style>

    <!-- JavaScript for Enhanced UX -->
    <script>
        // Confirm delete with custom modal
        function confirmDelete(event, fktpName) {
            event.preventDefault();
            
            if (confirm(`Apakah Anda yakin ingin menghapus data "${fktpName}"?\n\nTindakan ini tidak dapat dibatalkan!`)) {
                event.target.submit();
            }
            
            return false;
        }

        // Auto-hide success message
        document.addEventListener('DOMContentLoaded', function() {
            const successAlert = document.querySelector('.animate-pulse');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.style.transition = 'opacity 0.5s ease-out';
                    successAlert.style.opacity = '0';
                    setTimeout(() => {
                        successAlert.remove();
                    }, 500);
                }, 5000);
            }
        });

        // Add loading state to buttons
        document.querySelectorAll('a[href*="create"], a[href*="edit"]').forEach(link => {
            link.addEventListener('click', function() {
                const icon = this.querySelector('i');
                if (icon) {
                    icon.className = 'fa fa-spinner fa-spin';
                }
                this.style.opacity = '0.7';
                this.style.pointerEvents = 'none';
                
                // Reset after page load (fallback)
                setTimeout(() => {
                    this.style.opacity = '1';
                    this.style.pointerEvents = 'auto';
                }, 2000);
            });
        });

        // Table row click to edit (optional enhancement)
        document.querySelectorAll('tbody tr:not(:last-child)').forEach(row => {
            row.style.cursor = 'pointer';
            row.addEventListener('click', function(e) {
                // Don't trigger if clicked on action buttons
                if (!e.target.closest('.fa') && !e.target.closest('button') && !e.target.closest('a')) {
                    const editLink = this.querySelector('a[href*="edit"]');
                    if (editLink) {
                        window.location.href = editLink.href;
                    }
                }
            });
        });
    </script>
</x-app-layout>