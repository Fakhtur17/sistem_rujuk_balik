<?php

namespace App\Http\Controllers;

use App\Models\Farmasi;
use App\Models\Rekrutmen;
use Illuminate\Http\Request;

class FarmasiController extends Controller
{
    /**
     * Tampilkan semua data farmasi dengan fitur pencarian dan paginasi.
     */
    public function index(Request $request)
    {
        // 1. Mulai dengan query builder, bukan ->all()
        $query = Farmasi::query();

        // 2. Tambahkan logika pencarian jika ada input 'search'
        if ($request->has('search') && $request->input('search') != '') {
            $keyword = $request->input('search');

            // Gunakan closure untuk mengelompokkan kondisi OR
            $query->where(function($q) use ($keyword) {
                $q->where('nama_rs', 'like', '%' . $keyword . '%')
                  ->orWhere('alamat', 'like', '%' . $keyword . '%')
                  ->orWhere('kota', 'like', '%' . $keyword . '%');
            });
        }

        // 3. Ambil data dengan paginasi (misal: 10 data per halaman)
        $farmasis = $query->latest()->paginate(10);

        // 4. Hitung jumlah peserta untuk data di halaman saat ini (logika lama Anda dipertahankan)
        foreach ($farmasis as $farmasi) {
            $namaLengkap = trim(strtolower($farmasi->nama_rs . ' - ' . $farmasi->kota));
            $farmasi->jumlah_peserta = Rekrutmen::whereRaw('LOWER(nama_fkrtl) = ?', [$namaLengkap])->count();
        }

        // 5. Kirim data ke view
        return view('farmasis.index', compact('farmasis'));
    }

    /**
     * Tampilkan form tambah farmasi.
     */
    public function create()
    {
        return view('farmasis.create');
    }

    /**
     * Simpan data farmasi baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_rs' => 'required|string|max:255',
            'alamat'  => 'required|string|max:255',
            'kota'    => 'required|string|max:255',
            'kontak'  => 'nullable|string|max:255',
        ]);

        Farmasi::create($request->only('nama_rs', 'alamat', 'kota', 'kontak'));

        return redirect()->route('farmasis.index')->with('success', 'Data farmasi berhasil ditambahkan');
    }

    /**
     * Tampilkan form edit farmasi.
     */
    public function edit(Farmasi $farmasi)
    {
        return view('farmasis.edit', compact('farmasi'));
    }

    /**
     * Perbarui data farmasi.
     */
    public function update(Request $request, Farmasi $farmasi)
    {
        $request->validate([
            'nama_rs' => 'required|string|max:255',
            'alamat'  => 'required|string|max:255',
            'kota'    => 'required|string|max:255',
            'kontak'  => 'nullable|string|max:255',
        ]);

        $farmasi->update($request->only('nama_rs', 'alamat', 'kota', 'kontak'));

        return redirect()->route('farmasis.index')->with('success', 'Data farmasi berhasil diperbarui');
    }

    /**
     * Hapus data farmasi.
     */
    public function destroy(Farmasi $farmasi)
    {
        $farmasi->delete();

        return redirect()->route('farmasis.index')->with('success', 'Data farmasi berhasil dihapus');
    }

    /**
     * Tampilkan daftar peserta PRB berdasarkan nama FKRTL = nama_rs - kota.
     */
    public function peserta(Farmasi $farmasi)
    {
        $namaLengkap = trim(strtolower($farmasi->nama_rs . ' - ' . $farmasi->kota));
        $pesertas = Rekrutmen::whereRaw('LOWER(nama_fkrtl) = ?', [$namaLengkap])->get();
        return view('farmasis.peserta', compact('farmasi', 'pesertas'));
    }
}
