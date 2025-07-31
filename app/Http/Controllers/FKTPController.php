<?php

namespace App\Http\Controllers;

use App\Models\FKTP;
use Illuminate\Http\Request;
use App\Models\Rekrutmen;

class FKTPController extends Controller
{
    /**
     * Menampilkan semua data FKTP dengan fitur pencarian dan paginasi.
     */
    public function index(Request $request)
    {
        // Mulai dengan query builder dan hitung relasi secara efisien
        // 'withCount' akan membuat kolom 'rekrutmens_count',
        // yang kita beri alias 'jumlah_peserta' agar sesuai dengan view Anda.
        $query = FKTP::withCount(['rekrutmens as jumlah_peserta']);

        // Cek jika ada keyword pencarian
        if ($request->has('search') && $request->input('search') != '') {
            $keyword = $request->input('search');
            
            // Lakukan pencarian pada kolom nama_fktp atau kabupaten_kota
            $query->where(function($q) use ($keyword) {
                $q->where('nama_fktp', 'like', '%' . $keyword . '%')
                  ->orWhere('kabupaten_kota', 'like', '%' . $keyword . '%');
            });
        }

        // Ambil data dengan paginasi.
        // Perulangan 'foreach' tidak lagi diperlukan karena 'withCount' sudah melakukan tugasnya.
        $fktps = $query->latest()->paginate(10);

        return view('fktp.index', compact('fktps'));
    }

    /**
     * Tampilkan form tambah FKTP.
     */
    public function create()
    {
        return view('fktp.create');
    }

    /**
     * Simpan data FKTP baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_fktp' => 'required|string|max:255',
            'kabupaten_kota' => 'required|string|max:255',
        ]);

        FKTP::create([
            'nama_fktp' => $request->nama_fktp,
            'kabupaten_kota' => $request->kabupaten_kota,
        ]);

        return redirect()->route('fktps.index')->with('success', 'Data FKTP berhasil disimpan.');
    }

    /**
     * Tampilkan form edit FKTP.
     */
    public function edit(FKTP $fktp)
    {
        return view('fktp.edit', compact('fktp'));
    }

    /**
     * Perbarui data FKTP.
     */
    public function update(Request $request, FKTP $fktp)
    {
        $request->validate([
            'nama_fktp' => 'required|string|max:255',
            'kabupaten_kota' => 'required|string|max:255',
        ]);

        $fktp->update([
            'nama_fktp' => $request->nama_fktp,
            'kabupaten_kota' => $request->kabupaten_kota,
        ]);

        return redirect()->route('fktps.index')->with('success', 'Data FKTP berhasil diperbarui.');
    }

    /**
     * Hapus data FKTP.
     */
    public function destroy(FKTP $fktp)
    {
        $fktp->delete();

        return redirect()->route('fktps.index')->with('success', 'Data FKTP berhasil dihapus.');
    }

    /**
     * Tampilkan daftar peserta PRB yang terdaftar di FKTP ini.
     */
    public function peserta(FKTP $fktp)
    {
        // Pastikan relasi 'rekrutmens' ada di model FKTP Anda.
        $pesertas = $fktp->rekrutmens; 
        return view('fktp.peserta', compact('fktp', 'pesertas'));
    }

public function updateStatus(Request $request, Rekrutmen $rekrutmen)
{
    if ($rekrutmen->status === 'baru') {
        $rekrutmen->status = 'sedang_fkrtl';
        $rekrutmen->save();

        return redirect()->back()->with('success', 'Status berhasil diubah menjadi sedang_fkrtl');
    }

    return redirect()->back()->with('error', 'Status tidak bisa diubah oleh FKTP pada kondisi saat ini');
}

}
