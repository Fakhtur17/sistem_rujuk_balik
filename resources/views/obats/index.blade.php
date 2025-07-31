<x-app-layout>
    <div class="min-vh-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="container py-4">
            <!-- Header Card -->
            <div class="card border-0 shadow-sm mb-4" style="border-radius: 15px; backdrop-filter: blur(10px); background: rgba(255, 255, 255, 0.95);">
                <div class="card-body py-3">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center gap-3">
                        <div>
                            <h4 class="fw-bold text-dark mb-1">
                                <i class="fa fa-pills me-2 text-primary"></i>Daftar Obat
                            </h4>
                            <p class="text-muted mb-0 small">Kelola semua obat dalam sistem apotek</p>
                        </div>
                        <a href="{{ route('obats.create') }}" 
                           class="btn btn-success d-flex align-items-center gap-2"
                           style="border-radius: 10px; padding: 8px 20px; font-weight: 600; transition: all 0.3s ease;"
                           onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 6px 20px rgba(40, 167, 69, 0.3)'"
                           onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none'">
                            <i class="fa fa-plus"></i>
                            <span>Tambah Obat</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Success Alert -->
            @if(session('success'))
                <div class="alert alert-success border-0 shadow-sm mb-4" 
                     style="border-radius: 12px; background: linear-gradient(135deg, rgba(25, 135, 84, 0.1), rgba(25, 135, 84, 0.05));">
                    <div class="d-flex align-items-center">
                        <i class="fa fa-check-circle text-success me-3" style="font-size: 20px;"></i>
                        <div>
                            <strong>Berhasil!</strong> {{ session('success') }}
                        </div>
                    </div>
                </div>
            @endif

            <!-- Table Card -->
            <div class="card border-0 shadow-sm" style="border-radius: 15px; backdrop-filter: blur(10px); background: rgba(255, 255, 255, 0.95);">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead style="background: linear-gradient(135deg, #495057, #343a40); border-radius: 15px 15px 0 0;">
                                <tr>
                                    <th class="text-center text-white py-3" style="border: none; font-weight: 600; font-size: 14px; width: 60px;">
                                        <i class="fa fa-hashtag"></i>
                                    </th>
                                    <th class="text-white py-3" style="border: none; font-weight: 600; font-size: 14px;">
                                        <i class="fa fa-pills me-2"></i>Nama Obat
                                    </th>
                                    <th class="text-white py-3 d-none d-md-table-cell" style="border: none; font-weight: 600; font-size: 14px;">
                                        <i class="fa fa-store me-2"></i>Apotek
                                    </th>
                                    <th class="text-white py-3 d-none d-lg-table-cell" style="border: none; font-weight: 600; font-size: 14px;">
                                        <i class="fa fa-tag me-2"></i>Kategori
                                    </th>
                                    <th class="text-center text-white py-3" style="border: none; font-weight: 600; font-size: 14px; width: 80px;">
                                        <i class="fa fa-boxes"></i>
                                    </th>
                                    <th class="text-center text-white py-3" style="border: none; font-weight: 600; font-size: 14px; width: 120px;">
                                        <i class="fa fa-cog"></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($obats as $index => $obat)
                                    <tr style="border-bottom: 1px solid #f8f9fa; transition: all 0.3s ease;"
                                        onmouseover="this.style.backgroundColor='#f8f9fa'"
                                        onmouseout="this.style.backgroundColor='transparent'">
                                        
                                        <!-- Number -->
                                        <td class="text-center py-3" style="border: none;">
                                            <div class="badge bg-light text-dark rounded-circle d-flex align-items-center justify-content-center"
                                                 style="width: 32px; height: 32px; font-weight: 600; font-size: 12px;">
                                                {{ $index + 1 }}
                                            </div>
                                        </td>
                                        
                                        <!-- Nama Obat -->
                                        <td class="py-3" style="border: none;">
                                            <div class="d-flex flex-column">
                                                <span class="fw-semibold text-dark mb-1" style="font-size: 14px;">
                                                    {{ $obat->nama_obat }}
                                                </span>
                                                <!-- Mobile view: Show apotek and kategori -->
                                                <div class="d-md-none">
                                                    <small class="text-muted">
                                                        <i class="fa fa-store me-1"></i>{{ $obat->apotek->nama_apotek ?? '-' }}
                                                    </small>
                                                    @if($obat->kategori)
                                                        <br><small class="text-muted">
                                                            <i class="fa fa-tag me-1"></i>{{ $obat->kategori }}
                                                        </small>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        
                                        <!-- Apotek (Hidden on mobile) -->
                                        <td class="py-3 d-none d-md-table-cell" style="border: none;">
                                            <span class="text-muted" style="font-size: 14px;">
                                                {{ $obat->apotek->nama_apotek ?? '-' }}
                                            </span>
                                        </td>
                                        
                                        <!-- Kategori (Hidden on mobile/tablet) -->
                                        <td class="py-3 d-none d-lg-table-cell" style="border: none;">
                                            @if($obat->kategori)
                                                <span class="badge bg-info bg-opacity-10 text-info px-3 py-2 rounded-pill" style="font-size: 12px;">
                                                    {{ $obat->kategori }}
                                                </span>
                                            @else
                                                <span class="text-muted" style="font-size: 14px;">-</span>
                                            @endif
                                        </td>
                                        
                                        <!-- Stok -->
                                        <td class="text-center py-3" style="border: none;">
                                            <div class="d-flex align-items-center justify-content-center">
                                                @if($obat->stok > 10)
                                                    <span class="badge bg-success bg-opacity-20 text-success px-3 py-2 rounded-pill fw-semibold">
                                                        {{ $obat->stok }}
                                                    </span>
                                                @elseif($obat->stok > 0)
                                                    <span class="badge bg-warning bg-opacity-20 text-warning px-3 py-2 rounded-pill fw-semibold">
                                                        {{ $obat->stok }}
                                                    </span>
                                                @else
                                                    <span class="badge bg-danger bg-opacity-20 text-danger px-3 py-2 rounded-pill fw-semibold">
                                                        {{ $obat->stok }}
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                        
                                        <!-- Actions -->
                                        <td class="text-center py-3" style="border: none;">
                                            <div class="d-flex gap-1 justify-content-center">
                                                <!-- Edit Button -->
                                                <a href="{{ route('obats.edit', $obat->id) }}" 
                                                   class="btn btn-sm btn-warning d-flex align-items-center justify-content-center"
                                                   style="width: 32px; height: 32px; border-radius: 8px; transition: all 0.3s ease;"
                                                   title="Edit Obat"
                                                   onmouseover="this.style.transform='scale(1.1)'"
                                                   onmouseout="this.style.transform='scale(1)'">
                                                    <i class="fa fa-edit" style="font-size: 12px;"></i>
                                                </a>
                                                
                                                <!-- Delete Button -->
                                                <form action="{{ route('obats.destroy', $obat->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-danger d-flex align-items-center justify-content-center"
                                                            style="width: 32px; height: 32px; border-radius: 8px; transition: all 0.3s ease;"
                                                            title="Hapus Obat"
                                                            onclick="return confirm('Apakah Anda yakin ingin menghapus obat {{ $obat->nama_obat }}?')"
                                                            onmouseover="this.style.transform='scale(1.1)'"
                                                            onmouseout="this.style.transform='scale(1)'">
                                                        <i class="fa fa-trash" style="font-size: 12px;"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center py-5" style="border: none;">
                                            <div class="d-flex flex-column align-items-center gap-3">
                                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center"
                                                     style="width: 80px; height: 80px;">
                                                    <i class="fa fa-pills text-muted" style="font-size: 32px;"></i>
                                                </div>
                                                <div>
                                                    <h6 class="text-muted mb-1">Belum Ada Data Obat</h6>
                                                    <p class="text-muted small mb-3">Mulai dengan menambahkan obat pertama Anda</p>
                                                    <a href="{{ route('obats.create') }}" 
                                                       class="btn btn-primary btn-sm">
                                                        <i class="fa fa-plus me-1"></i>Tambah Obat Sekarang
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Stats Card -->
            @if($obats->count() > 0)
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card border-0 shadow-sm" style="border-radius: 15px; backdrop-filter: blur(10px); background: rgba(255, 255, 255, 0.9);">
                            <div class="card-body py-3">
                                <div class="d-flex flex-wrap justify-content-center gap-4">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                             style="width: 32px; height: 32px;">
                                            <i class="fa fa-pills text-primary"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Total Obat</small>
                                            <strong class="text-dark">{{ $obats->count() }}</strong>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="bg-success bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                             style="width: 32px; height: 32px;">
                                            <i class="fa fa-check text-success"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Stok Tersedia</small>
                                            <strong class="text-dark">{{ $obats->where('stok', '>', 0)->count() }}</strong>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="bg-danger bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center"
                                             style="width: 32px; height: 32px;">
                                            <i class="fa fa-exclamation text-danger"></i>
                                        </div>
                                        <div>
                                            <small class="text-muted d-block">Stok Habis</small>
                                            <strong class="text-dark">{{ $obats->where('stok', '<=', 0)->count() }}</strong>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>