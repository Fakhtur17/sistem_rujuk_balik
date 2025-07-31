<x-app-layout>
    <div class="container mt-4">
        <h5 class="mb-3">Detail PIC PRB</h5>

        <div class="card">
            <div class="card-body">
                <h6>Nama PIC: {{ $pic->nama_pic }}</h6>
                {{-- Tambah field lain jika ada --}}
            </div>
        </div>

        <a href="{{ route('pic-prbs.index') }}" class="btn btn-secondary mt-3">
            <i class="fa fa-arrow-left me-1"></i> Kembali
        </a>
    </div>
</x-app-layout>
