<x-app-layout>
    <!-- Full Width dan Hilangkan Padding Atas -->
    <div class="container-fluid px-4" style="padding-top: 20px;">
        <main>
            <h1 class="fw-bold display-4">Selamat Datang, {{ Auth::user()->name }}!</h1>
            <p class="text-muted">Anda login sebagai <strong>{{ Auth::user()->role }}</strong>.</p>

            @if(Auth::user()->role === 'admin')
                <h2 class="h4 fw-semibold">Dashboard Admin</h2>
                <p>Halaman ini menampilkan data manajemen pengguna dan kontrol sistem.</p>

            @elseif(Auth::user()->role === 'fktp')
                <h2 class="h4 fw-semibold">Dashboard FKTP</h2>
                <p>Halaman ini berisi data peminjaman dan laporan di FKTP.</p>

            @elseif(Auth::user()->role === 'fkrtl')
                <h2 class="h4 fw-semibold">Dashboard FKRTL</h2>
                <p>Data khusus FKRTL ditampilkan di sini.</p>

            @elseif(Auth::user()->role === 'apotek')
                <h2 class="h4 fw-semibold">Dashboard Apotek</h2>
                <p>Kelola peminjaman alat di unit Apotek.</p>

            @else
                <h2 class="h4 fw-semibold">Dashboard Umum</h2>
                <p>Selamat datang di sistem peminjaman barang.</p>
            @endif
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Tambahan Styling -->
    <style>
        h1, h2, h3, h4, h5 {
            font-family: 'Segoe UI', sans-serif;
        }

        main {
            margin-top: 0 !important;
            padding-top: 0 !important;
        }

        .feature-card {
            border: none;
            transition: transform 0.2s ease, box-shadow 0.3s ease;
            border-radius: 1rem;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.1);
        }

        .barang-card {
            transition: transform 0.2s ease;
            border-radius: 0.75rem;
            overflow: hidden;
        }

        .barang-card:hover {
            transform: scale(1.02);
            box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.08);
        }

        .card-img-top {
            border-top-left-radius: 0.75rem;
            border-top-right-radius: 0.75rem;
        }

        .card-body {
            padding: 1rem;
        }

        .text-decoration-underline:hover {
            text-decoration: none;
        }

        body {
            padding-top: 0 !important;
        }
    </style>
</x-app-layout>
