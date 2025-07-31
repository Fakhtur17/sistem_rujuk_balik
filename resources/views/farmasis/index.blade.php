<x-app-layout>
    <style>
        .btn {
            border-radius: 0.75rem;
            padding: 0.5rem 1rem;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-size: 0.875rem;
        }
        
        .btn-lg {
            padding: 0.75rem 1.25rem;
            font-size: 0.875rem;
        }
        
        .btn-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.2);
        }
        
        .btn-gradient-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
            color: white;
        }
        
        .btn-outline-primary {
            border: 2px solid #667eea;
            color: #667eea;
            background-color: transparent;
        }
        
        .btn-outline-primary:hover {
            background-color: #667eea;
            color: white;
            transform: translateY(-1px);
        }
        
        .btn-warning {
            background: linear-gradient(135deg, #f6ad55 0%, #ed8936 100%);
            color: white;
        }
        
        .btn-warning:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(246, 173, 85, 0.3);
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #fc8181 0%, #f56565 100%);
            color: white;
        }
        
        .btn-danger:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(252, 129, 129, 0.3);
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        
        .number-badge {
            width: 2rem;
            height: 2rem;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 0.75rem;
        }
        
        .participant-badge {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 600;
            color: #2d3748;
        }
        
        .participant-icon {
            width: 1.75rem;
            height: 1.75rem;
            background: linear-gradient(135deg, #4299e1, #3182ce);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
        
        .table-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .table-row:hover {
            background: rgba(102, 126, 234, 0.05);
            transform: translateY(-1px);
            transition: all 0.2s ease;
        }
        
        .empty-state {
            padding: 3rem 1rem;
            text-align: center;
            color: #718096;
        }
        
        .empty-icon {
            width: 4rem;
            height: 4rem;
            background: #f7fafc;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
            color: #cbd5e0;
        }
        
        .search-input {
            transition: all 0.3s ease;
        }
        
        .search-input:focus {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.15);
        }
        
        .action-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }
        
        .truncate-text {
            max-width: 200px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .hospital-name {
            font-weight: 600;
            color: #2d3748;
        }
        
        .contact-info {
            color: #4a5568;
            font-size: 0.875rem;
        }
        
        @media (max-width: 768px) {
            .action-buttons {
                flex-direction: column;
                gap: 0.25rem;
            }
            
            .btn {
                font-size: 0.75rem;
                padding: 0.5rem 0.75rem;
            }
        }
    </style>

    <div class="min-h-screen bg-gradient-to-br from-indigo-50 via-purple-50 to-pink-50">
        <div class="container mx-auto px-4 py-6">
            <!-- Header Section -->
            <div class="glass-card rounded-2xl p-6 mb-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl flex items-center justify-center shadow-lg">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                            </svg>
                        </div>
                        <h1 class="text-2xl font-bold text-gray-900">Daftar FKTL</h1>
                    </div>
                    
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('farmasis.create') }}" class="btn btn-gradient-primary btn-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Tambah FKTL
                        </a>
                    @endif
                </div>
            </div>

            <!-- Search Section -->
            <div class="glass-card rounded-2xl p-5 mb-6">
                <form action="{{ route('farmasis.index') }}" method="GET">
                    <div class="flex gap-3">
                        <div class="flex-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input type="text" name="search" 
                                   class="search-input w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent" 
                                   placeholder="Cari berdasarkan Nama FKTL atau Kota..." 
                                   value="{{ request('search') }}">
                        </div>
                        <button type="submit" class="btn btn-gradient-primary">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Cari
                        </button>
                    </div>
                </form>
            </div>

            @if(session('success'))
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-xl mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Table Section -->
            <div class="glass-card rounded-2xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="table-header">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="width: 60px;">No</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="width: 250px;">Nama FKTL</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="width: 200px;">Alamat</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="width: 130px;">Kota</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="width: 120px;">Kontak</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="width: 100px;">Peserta</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider" style="width: 200px;">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @forelse($farmasis as $index => $f)
                                <tr class="table-row">
                                    <!-- No -->
                                    <td class="px-4 py-3">
                                        <div class="number-badge">
                                            {{ $farmasis->firstItem() + $index }}
                                        </div>
                                    </td>

                                    <!-- Nama FKRTL -->
                                    <td class="px-4 py-3">
                                        <div class="hospital-name">{{ $f->nama_rs }}</div>
                                    </td>

                                    <!-- Alamat -->
                                    <td class="px-4 py-3">
                                        <div class="contact-info truncate-text">{{ $f->alamat ?? '-' }}</div>
                                    </td>

                                    <!-- Kota -->
                                    <td class="px-4 py-3">
                                        <div class="contact-info">{{ $f->kota ?? '-' }}</div>
                                    </td>

                                    <!-- Kontak -->
                                    <td class="px-4 py-3">
                                        <div class="contact-info">{{ $f->kontak ?? '-' }}</div>
                                    </td>

                                    <!-- Jumlah Peserta -->
                                    <td class="px-4 py-3">
                                        <div class="participant-badge">
                                            <div class="participant-icon">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                                                </svg>
                                            </div>
                                            <span>{{ $f->jumlah_peserta }}</span>
                                        </div>
                                    </td>

                                    <!-- Aksi -->
                                    <td class="px-4 py-3">
                                        <div class="action-buttons">
                                            <a href="{{ route('farmasis.peserta', $f->id) }}" class="btn btn-outline-primary">
                                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                                Info
                                            </a>

                                            @if(auth()->user()->role === 'admin')
                                                <a href="{{ route('farmasis.edit', $f->id) }}" class="btn btn-warning">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                    </svg>
                                                    Edit
                                                </a>

                                                <form action="{{ route('farmasis.destroy', $f->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">
                                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                        </svg>
                                                        Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">
                                        <div class="empty-state">
                                            <div class="empty-icon">
                                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                                </svg>
                                            </div>
                                            <div class="text-gray-500 text-lg font-medium">Data tidak ditemukan</div>
                                            <div class="text-gray-400 text-sm mt-1">Belum ada data FKRTL yang tersedia</div>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
            <div class="flex justify-center mt-6">
                {{ $farmasis->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-app-layout>