<?php

namespace App\Http\Controllers;

use App\Models\Rekrutmen;
use App\Models\Apotek;
use App\Models\KunjunganApotek;
use Illuminate\Http\Request;

class KunjunganApotekController extends Controller
{
    public function create($rekrutmen_id)
    {
        $rekrutmen = Rekrutmen::findOrFail($rekrutmen_id);
        $apotekList = Apotek::all();
        return view('kunjungan_apotek.create', compact('rekrutmen', 'apotekList'));
    }

    public function store(Request $request)
{
    $request->validate([
        'rekrutmen_id' => 'required|exists:rekrutmens,id',
        'tanggal_kunjungan' => 'required|date',
        'nama_apotek' => 'required|string|max:255',
    ]);

    // Simpan data kunjungan apotek
    $kunjungan = new KunjunganApotek($request->all());
    $kunjungan->save();

    // Ubah status rekrutmen ke 'sedang_apotek'
    $rekrutmen = Rekrutmen::find($request->rekrutmen_id);
    // Kondisi sekarang:
if ($rekrutmen->status === 'sedang_fktp' || $rekrutmen->status === 'baru') {
    $rekrutmen->status = 'selesai';
    $rekrutmen->save();
}


    return redirect()->route('rekrutmens.index', ['q' => $rekrutmen->nomor_kartu_jkn])
        ->with('success', 'Kunjungan Apotek berhasil ditambahkan dan status diperbarui.');
}
}
