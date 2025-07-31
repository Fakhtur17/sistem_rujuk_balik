<?php

namespace App\Http\Controllers;

use App\Models\Rekrutmen;
use App\Models\KunjunganFktp;
use Illuminate\Http\Request;
use App\Models\Apotek;

class KunjunganFktpController extends Controller
{
    /**
     * Menampilkan form untuk membuat kunjungan baru.
     */
    public function create(Rekrutmen $rekrutmen)
    {
        $apoteks = Apotek::all();
        return view('kunjungan_fktp.create', compact('rekrutmen', 'apoteks'));
    }
    public function index(Request $request)
{
    $kunjunganFktp = KunjunganFktp::with('rekrutmen.fktp')
        ->when($request->search, function ($query) use ($request) {
            $query->whereHas('rekrutmen', function ($q) use ($request) {
                $q->where('nama_peserta', 'like', '%' . $request->search . '%')
                  ->orWhere('nomor_kartu_jkn', 'like', '%' . $request->search . '%');
            });
        })
        ->latest()
        ->paginate(10);

    return view('kunjungan_fktp.index', compact('kunjunganFktp'));
}

    /**
     * Menyimpan data kunjungan baru dan memperbarui status rekrutmen.
     */
   public function store(Request $request)
{
    $request->validate([
        'rekrutmen_id' => 'required|exists:rekrutmens,id',
        'kunjungan_ke' => 'required|integer',
        'tanggal_kunjungan' => 'required|date',
        'apotek_id' => 'nullable|exists:apoteks,id',
    ]);

    // Simpan data kunjungan
    $kunjungan = new KunjunganFktp($request->all());
    $kunjungan->save();

    // Selalu ubah status jadi 'sedang_fktp' setelah kunjungan ditambahkan
    $rekrutmen = Rekrutmen::find($request->rekrutmen_id);
    $rekrutmen->status = 'sedang_fktp';
    $rekrutmen->save();

    return redirect()->route('rekrutmens.index', ['q' => $rekrutmen->nomor_kartu_jkn])
        ->with('success', 'Kunjungan FKTP berhasil ditambahkan dan status diperbarui.');
}


}
