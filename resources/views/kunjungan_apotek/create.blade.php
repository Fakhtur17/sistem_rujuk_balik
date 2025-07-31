<x-app-layout>
    <div class="container mt-4">
        <h5>Tambah Kunjungan Apotek untuk {{ $rekrutmen->nama_peserta }}</h5>

        <form action="{{ route('kunjungan_apotek.store') }}" method="POST">
            @csrf
            <input type="hidden" name="rekrutmen_id" value="{{ $rekrutmen->id }}">

            <div class="mb-3">
                <label for="tanggal_kunjungan" class="form-label">Tanggal Kunjungan</label>
                <input type="date" name="tanggal_kunjungan" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="nama_apotek" class="form-label">Nama Apotek</label>
                <select name="nama_apotek" class="form-select" required>
                    <option value="">-- Pilih Apotek --</option>
                    @foreach ($apotekList as $apotek)
                        <option value="{{ $apotek->nama_apotek }}">{{ $apotek->nama_apotek }} ({{ $apotek->kota_kabupaten }})</option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-primary">Simpan</button>
        </form>
    </div>
</x-app-layout>
