<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Apotek;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::with('apotek')->latest()->get();
        return view('obats.index', compact('obats'));
    }

    public function byApotek(Apotek $apotek)
    {
        $obats = Obat::where('apotek_id', $apotek->id)->get();
        return view('obats.by_apotek', compact('apotek', 'obats'));
    }

    public function create()
    {
        $apoteks = Apotek::all();
        return view('obats.create', compact('apoteks'));
    }

    public function createForApotek(Apotek $apotek)
    {
        $apoteks = Apotek::all();
        return view('obats.create', [
            'apoteks' => $apoteks,
            'selectedApotek' => $apotek
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'apotek_id' => 'required|exists:apoteks,id',
            'nama_obat' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'stok' => 'nullable|integer|min:0',
        ]);

        $obat = Obat::create($request->all());

        // ➜ Redirect ke daftar obat berdasarkan apotek
        return redirect()->route('obats.byApotek', $obat->apotek_id)
                         ->with('success', 'Obat berhasil ditambahkan.');
    }

    public function edit(Obat $obat)
    {
        $apoteks = Apotek::all();
        return view('obats.edit', compact('obat', 'apoteks'));
    }

    public function update(Request $request, Obat $obat)
    {
        $request->validate([
            'apotek_id' => 'required|exists:apoteks,id',
            'nama_obat' => 'required|string|max:255',
            'kategori' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'stok' => 'nullable|integer|min:0',
        ]);

        $obat->update($request->all());

        return redirect()->route('obats.byApotek', $obat->apotek_id)
                         ->with('success', 'Obat berhasil diperbarui.');
    }

    public function destroy(Obat $obat)
    {
        $apotekId = $obat->apotek_id;
        $obat->delete();

        return redirect()->route('obats.byApotek', $apotekId)
                         ->with('success', 'Obat berhasil dihapus.');
    }

    // METHOD YANG DIUPDATE - PILIH SALAH SATU OPSI
    
    // OPSI 1: Menggunakan JOIN (Paling Efisien)
    public function obatKosong(Request $request)
{
    $query = Obat::with('apotek')->where('stok', '<=', 0);

    // Jika ada parameter pencarian
    if ($request->has('search') && $request->search != '') {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('nama_obat', 'like', '%' . $search . '%')
              ->orWhereHas('apotek', function ($q2) use ($search) {
                  $q2->where('nama_apotek', 'like', '%' . $search . '%');
              });
        });
    }

    // Urutkan berdasarkan nama apotek dan nama obat
    $obats = $query->get()->sortBy([
        fn($a, $b) => strcmp($a->apotek->nama_apotek ?? '', $b->apotek->nama_apotek ?? ''),
        fn($a, $b) => strcmp($a->nama_obat, $b->nama_obat),
    ]);

    return view('obats.kosong', compact('obats'));
}


    // OPSI 2: Menggunakan Collection Sort (Lebih Mudah Dipahami)
    public function obatKosongAlternatif()
    {
        $obats = Obat::where('stok', '<=', 0)
                     ->with('apotek')
                     ->get()
                     ->sortBy(function($obat) {
                         return $obat->apotek->nama_apotek ?? 'zzz'; // 'zzz' untuk apotek null di akhir
                     })
                     ->sortBy('nama_obat'); // Sort nama obat dalam apotek yang sama

        return view('obats.kosong', compact('obats'));
    }

    // OPSI 3: Menggunakan Raw Query
    public function obatKosongRaw()
    {
        $obats = Obat::where('stok', '<=', 0)
                     ->with('apotek')
                     ->orderByRaw('(SELECT nama_apotek FROM apoteks WHERE apoteks.id = obats.apotek_id) ASC')
                     ->orderBy('nama_obat', 'asc')
                     ->get();

        return view('obats.kosong', compact('obats'));
    }

    // OPSI 4: Jika ingin grouped by apotek (Data terkelompok per apotek)
    public function obatKosongGrouped()
    {
        $obatsByApotek = Obat::where('stok', '<=', 0)
                            ->with('apotek')
                            ->get()
                            ->groupBy(function($obat) {
                                return $obat->apotek->nama_apotek ?? 'Tidak Ada Apotek';
                            })
                            ->sortKeys(); // Sort berdasarkan key (nama apotek)

        return view('obats.kosong_grouped', compact('obatsByApotek'));
    }
}