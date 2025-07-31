<?php

namespace App\Http\Controllers;

use App\Models\Apotek;
use Illuminate\Http\Request;

class ApotekController extends Controller
{
    public function index(Request $request)
{
    $query = Apotek::query();

    // Jika role apotek, tampilkan hanya apotek_id miliknya
if (auth()->user()->role === 'apotek') {
    $query->where('id', auth()->user()->apotek_id);
}

    // Filter pencarian
    if ($request->filled('nama')) {
        $query->where('nama_apotek', 'like', '%' . $request->nama . '%');
    }
    if ($request->filled('kota')) {
        $query->where('kota_kabupaten', 'like', '%' . $request->kota . '%');
    }

    $apoteks = $query->latest()->paginate(10);
    return view('apoteks.index', compact('apoteks'));
}

    public function create()
{
    if (auth()->user()->role !== 'admin') {
        abort(403, 'Hanya admin yang dapat mengakses halaman ini.');
    }

    return view('apoteks.create');
}


    public function store(Request $request)
{
    if (auth()->user()->role !== 'admin') {
        abort(403, 'Hanya admin yang dapat menambah apotek.');
    }

    $request->validate([
        'nama_apotek' => 'required|string|max:255',
        'kota_kabupaten' => 'required|string|max:255',
        'user_id' => 'nullable|exists:users,id', // opsional jika admin mau menetapkan user
    ]);

    Apotek::create([
        'nama_apotek' => $request->nama_apotek,
        'kota_kabupaten' => $request->kota_kabupaten,
        'user_id' => $request->user_id, // boleh null atau ditentukan
    ]);

    return redirect()->route('apoteks.index')->with('success', 'Apotek berhasil ditambahkan.');
}



    public function edit(Apotek $apotek)
{
    if (auth()->user()->role !== 'admin') {
        abort(403, 'Hanya admin yang dapat mengedit apotek.');
    }

    return view('apoteks.edit', compact('apotek'));
}


    public function update(Request $request, Apotek $apotek)
{
    if (auth()->user()->role !== 'admin') {
        abort(403, 'Hanya admin yang dapat memperbarui apotek.');
    }

    $request->validate([
        'nama_apotek' => 'required|string|max:255',
        'kota_kabupaten' => 'required|string|max:255',
    ]);

    $apotek->update($request->only(['nama_apotek', 'kota_kabupaten']));

    return redirect()->route('apoteks.index')->with('success', 'Apotek berhasil diperbarui.');
}


    public function destroy(Apotek $apotek)
{
    if (auth()->user()->role !== 'admin') {
        abort(403, 'Hanya admin yang dapat menghapus apotek.');
    }

    $apotek->delete();
    return redirect()->route('apoteks.index')->with('success', 'Apotek berhasil dihapus.');
}
// ApotekRekrutmenController.php

public function updateStatus(Request $request, Rekrutmen $rekrutmen)
{
    if ($rekrutmen->status === 'sedang_apotek') {
        $rekrutmen->status = 'selesai';
        $rekrutmen->save();

        return redirect()->back()->with('success', 'Status berhasil diubah menjadi selesai');
    }

    return redirect()->back()->with('error', 'Status tidak sesuai untuk Apotek');
}


}


