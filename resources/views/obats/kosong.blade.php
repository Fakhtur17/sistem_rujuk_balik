<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50 py-8">
        <div class="container mx-auto px-4 max-w-7xl">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">Daftar Obat Kosong</h1>
                        <p class="text-gray-600">Monitoring stok obat yang perlu segera diisi ulang</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="bg-red-100 text-red-800 px-4 py-2 rounded-full text-sm font-medium">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            {{ $obats->count() }} Obat Kosong
                        </div>
                    </div>
                </div>
            </div>

            @if($obats->count() > 0)
                <!-- Statistics Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-red-100 rounded-lg">
                                <i class="fas fa-pills text-red-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-600 text-sm">Total Obat Kosong</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $obats->count() }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-blue-100 rounded-lg">
                                <i class="fas fa-store text-blue-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-600 text-sm">Apotek Terdampak</p>
                                <p class="text-2xl font-bold text-gray-900">{{ $obats->groupBy('apotek.nama_apotek')->count() }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <div class="flex items-center">
                            <div class="p-3 bg-yellow-100 rounded-lg">
                                <i class="fas fa-chart-line text-yellow-600 text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <p class="text-gray-600 text-sm">Status</p>
                                <p class="text-lg font-bold text-red-600">Perlu Restok</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Search Form -->
                <div class="mb-6">
                    <form method="GET" action="{{ route('obats.kosong') }}" class="flex items-center space-x-2 max-w-md">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}" 
                            placeholder="Cari nama obat atau apotek..." 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                        <button 
                            type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition"
                        >
                            <i class="fas fa-search mr-1"></i> Cari
                        </button>
                    </form>
                </div>

                <!-- Main Table -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-900">Detail Obat Kosong</h3>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <div class="flex items-center space-x-2">
                                            <i class="fas fa-capsules text-gray-400"></i>
                                            <span>Nama Obat</span>
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <div class="flex items-center space-x-2">
                                            <i class="fas fa-tags text-gray-400"></i>
                                            <span>Sediaan</span>
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <div class="flex items-center justify-center space-x-2">
                                            <i class="fas fa-boxes text-gray-400"></i>
                                            <span>Stok</span>
                                        </div>
                                    </th>
                                    <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        <div class="flex items-center space-x-2">
                                            <i class="fas fa-store text-gray-400"></i>
                                            <span>Apotek</span>
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-100">
                                @php
                                    $currentApotek = '';
                                    $rowIndex = 0;
                                @endphp
                                
                                @foreach ($obats as $obat)
                                    @php
                                        $namaApotek = $obat->apotek->nama_apotek ?? '-';
                                        $isNewApotek = $currentApotek !== $namaApotek;
                                        if ($isNewApotek) {
                                            $currentApotek = $namaApotek;
                                        }
                                        $rowIndex++;
                                    @endphp
                                    
                                    <tr class="hover:bg-gray-50 transition-colors duration-200 {{ $isNewApotek ? 'border-l-4 border-l-blue-500 bg-blue-50/30' : '' }}">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="flex-shrink-0 w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center">
                                                    <i class="fas fa-pill text-red-600"></i>
                                                </div>
                                                <div class="ml-4">
                                                    <div class="text-sm font-medium text-gray-900">{{ $obat->nama_obat }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                {{ $obat->kategori }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <div class="flex items-center justify-center">
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-red-100 text-red-800">
                                                    <i class="fas fa-times-circle mr-1"></i>
                                                    {{ $obat->stok }}
                                                </span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($isNewApotek)
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                                        <i class="fas fa-store text-blue-600 text-sm"></i>
                                                    </div>
                                                    <div class="ml-3">
                                                        <div class="text-sm font-bold text-blue-900">{{ $namaApotek }}</div>
                                                        <div class="text-xs text-blue-600">Lokasi Utama</div>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="flex items-center">
                                                    <div class="flex-shrink-0 w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                                        <i class="fas fa-store text-gray-400 text-sm"></i>
                                                    </div>
                                                    <div class="ml-3">
                                                        <div class="text-sm text-gray-600">{{ $namaApotek }}</div>
                                                    </div>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>



            @else
                <!-- Empty State -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 py-16">
                    <div class="text-center">
                        <div class="mx-auto w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mb-6">
                            <i class="fas fa-check-circle text-green-600 text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-2">Semua Stok Tersedia!</h3>
                        <p class="text-gray-600 mb-8 max-w-md mx-auto">
                            Selamat! Saat ini tidak ada obat yang kehabisan stok di seluruh apotek.
                        </p>

                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Custom Styles -->
    <style>
        /* Custom animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .container > * {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Custom scrollbar for table */
        .overflow-x-auto::-webkit-scrollbar {
            height: 8px;
        }

        .overflow-x-auto::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 4px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }

        .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Hover effects */
        .hover\:shadow-lg:hover {
            box-shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        /* Custom gradient background */
        .bg-gradient-to-br {
            background-image: linear-gradient(to bottom right, var(--tw-gradient-stops));
        }
    </style>

    <!-- Font Awesome Icons (add this to your layout if not already included) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</x-app-layout>