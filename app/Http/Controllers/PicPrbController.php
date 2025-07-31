<?php

namespace App\Http\Controllers;

use App\Models\PicPrb;
use Illuminate\Http\Request;

class PicPrbController extends Controller
{
    public function index(Request $request)
    {
        $query = PicPrb::query();

        // Pencarian berdasarkan nama_pic
        if ($request->filled('search')) {
            $query->where('nama_pic', 'like', '%' . $request->search . '%');
        }

        // Pagination: 10 data per halaman
        $picPrbs = $query->latest()->paginate(10)->withQueryString();

        return view('pic_prbs.index', compact('picPrbs'));
    }

    public function create()
    {
        return view('pic_prbs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pic' => 'required|string|max:255',
            'jenis_pic' => 'required|in:RS,FKTP,APOTEK',
        ]);

        PicPrb::create($request->only(['nama_pic', 'jenis_pic']));

        return redirect()->route('pic-prbs.index')->with('success', 'PIC PRB berhasil ditambahkan.');
    }

    public function edit(PicPrb $picPrb)
    {
        return view('pic_prbs.edit', compact('picPrb'));
    }

    public function update(Request $request, PicPrb $picPrb)
    {
        $request->validate([
            'nama_pic' => 'required|string|max:255',
            'jenis_pic' => 'required|in:RS,FKTP,APOTEK',
        ]);

        $picPrb->update($request->only(['nama_pic', 'jenis_pic']));

        return redirect()->route('pic-prbs.index')->with('success', 'Data PIC PRB diperbarui.');
    }

    public function destroy(PicPrb $picPrb)
    {
        $picPrb->delete();

        return redirect()->route('pic-prbs.index')->with('success', 'PIC PRB berhasil dihapus.');
    }

    public function show($id)
    {
        $pic = PicPrb::findOrFail($id);

        if ($pic->jenis_pic === 'RS') {
            return redirect()->route('pic-rs.index', ['picPrb' => $pic->id]);
        } elseif ($pic->jenis_pic === 'FKTP') {
            return redirect()->route('pic-fktps.index', ['picPrb' => $pic->id]);
        } else {
            return redirect()->route('pic-apoteks.index', ['picPrb' => $pic->id]);
        }
    }
}
