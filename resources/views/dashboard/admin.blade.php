<x-app-layout>
    <div class="container py-5">
        <h2 class="fw-bold mb-4">📊 Dashboard Admin</h2>

        {{-- Ringkasan Data --}}
        <div class="row g-4 mb-5">
            <div class="col-md-3">
                <div class="card shadow border-0 h-100">
                    <div class="card-body text-center d-flex flex-column justify-content-center">
                        <h6 class="text-muted">Total FKTP</h6>
                        <h3 class="fw-bold">{{ $fktpCount }}</h3>
                        <a href="{{ route('fktps.index') }}" class="btn btn-sm btn-outline-secondary mt-2">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow border-0 h-100">
                    <div class="card-body text-center d-flex flex-column justify-content-center">
                        <h6 class="text-muted">Total Farmasi RS</h6>
                        <h3 class="fw-bold">{{ $farmasiCount }}</h3>
                        <a href="{{ route('farmasis.index') }}" class="btn btn-sm btn-outline-secondary mt-2">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow border-0 h-100">
                    <div class="card-body text-center d-flex flex-column justify-content-center">
                        <h6 class="text-muted">Total Apotek</h6>
                        <h3 class="fw-bold">{{ $apotekCount }}</h3>
                         <a href="{{ route('apoteks.index') }}" class="btn btn-sm btn-outline-secondary mt-2">Lihat Detail</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card shadow border-0 h-100">
                    <div class="card-body text-center d-flex flex-column justify-content-center">
                        <h6 class="text-muted">Total Peserta PRB</h6>
                        <h3 class="fw-bold">{{ $pesertaCount }}</h3>
                        <a href="{{ route('rekrutmens.index') }}" class="btn btn-sm btn-primary mt-2">Lihat Detail</a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Grafik Jumlah Peserta per FKTP --}}
        <div class="card shadow mb-5">
            <div class="card-body">
                <h5 class="mb-4 fw-bold">📈 Grafik Jumlah Peserta per FKTP</h5>
                <canvas id="chartPesertaFKTP" height="100"></canvas>
            </div>
        </div>

        {{-- Tabel Data Terbaru --}}
        <div class="card shadow">
            <div class="card-body">
                <h5 class="mb-4 fw-bold">📝 Data Rekrutmen Terbaru</h5>
                <form method="GET" action="{{ route('dashboard') }}" class="row g-3 mb-3">
                    <div class="col-md-3">
                        <label class="form-label">Dari Tanggal</label>
                        <input type="date" name="from" class="form-control" value="{{ request('from') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Sampai Tanggal</label>
                        <input type="date" name="to" class="form-control" value="{{ request('to') }}">
                    </div>
                    <div class="col-md-6 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fas fa-filter me-1"></i> Filter
                        </button>
                        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
                            Reset
                        </a>
                        @if(request('from') && request('to'))
                            <a href="{{ route('rekrutmen.export', ['from' => request('from'), 'to' => request('to')]) }}" class="btn btn-success ms-2">
                                <i class="fas fa-file-excel me-1"></i> Export Excel Tanggal
                            </a>
                        @endif
                    </div>
                </form>
                <div class="mb-3">
                    <a href="{{ route('rekrutmen.export') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-file-excel me-1"></i> Export Excel semua data 
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>Nama Peserta</th>
                                <th>No. SEP</th>
                                <th>Nomer HP</th> <!-- Tambahan -->
                                <th>FKTP</th>
                                <th>FKRTL</th>
                                <th>Tanggal PRB</th>
                                <!-- KOLOM AKSI DITAMBAHKAN -->
                                <th>Status</th> {{-- Tambahkan ini --}}
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rekrutmenBaru as $r)
                                <tr>
                                    <td>
                                        <a href="{{ route('rekrutmens.index', ['q' => $r->nomor_kartu_jkn]) }}" class="text-decoration-none fw-bold">
                                            {{ $r->nama_peserta }}
                                        </a>
                                    </td>
                                    <td>{{ $r->nomor_kartu_jkn }}</td>
                                    <td>{{ $r->nomor_hp }}</td>
                                    <td>{{ $r->fktp->nama_fktp ?? '-' }}</td>
                                    <td>{{ $r->nama_fkrtl }}</td>
                                    <td>{{ \Carbon\Carbon::parse($r->tanggal_prb)->format('d M Y') }}</td>

                                    {{-- Badge Status --}}
                                    <td>
                                        @php
                                            $statusClass = [
                                                'baru' => 'primary',
                                                'sedang_fktp' => 'warning',
                                                'sedang_apotek' => 'orange',
                                                'selesai' => 'success'
                                            ];
                                            $class = $statusClass[$r->status] ?? 'secondary';
                                        @endphp
                                        <span class="badge bg-{{ $class }} text-capitalize px-3 py-2">
                                            {{ str_replace('_', ' ', $r->status) }}
                                        </span>
                                    </td>

                                    {{-- Tombol Detail --}}
                                    <td>
                                        <a href="{{ route('rekrutmens.index', ['q' => $r->nomor_kartu_jkn]) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-info-circle me-1"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            @if ($rekrutmenBaru->isEmpty())
                                <!-- Colspan disesuaikan menjadi 6 -->
                                <tr><td colspan="6" class="text-center text-muted">Belum ada data rekrutmen.</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Chart JS CDN --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('chartPesertaFKTP').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($chartLabels) !!},
                datasets: [{
                    label: 'Jumlah Peserta',
                    data: {!! json_encode($chartData) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                }
            }
        });
    </script>
</x-app-layout>
