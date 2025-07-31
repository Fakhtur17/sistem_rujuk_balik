<?php

namespace App\Http\Controllers;

use App\Models\PicApotek;
use Illuminate\Http\Request;

class PicApotekController extends Controller
{
    public function index($picPrb)
    {
       $data = PicApotek::where('pic_prb_id', $picPrb)->paginate(10);
        return view('pic_apoteks.index', [
            'data' => $data,
            'pic_prb_id' => $picPrb,
        ]);
    }

    public function create($picPrb)
    {
        return view('pic_apoteks.create', ['pic_prb_id' => $picPrb]);
    }

    public function store(Request $request, $picPrb)
    {
        $validated = $request->validate([
            'nama_faskes' => 'required|string|max:255',
            'kab_kota'    => 'required|string|max:255',
            'nama_pic'    => 'required|string|max:255',
            'no_hp'       => 'required|string|max:20',
        ]);

        $validated['pic_prb_id'] = $picPrb;

        PicApotek::create($validated);

        return redirect()
            ->route('pic-apoteks.index', ['picPrb' => $picPrb])
            ->with('success', 'Data PIC Apotek berhasil ditambahkan.');
    }

    public function edit($picPrb, $id)
    {
        $data = PicApotek::where('pic_prb_id', $picPrb)->findOrFail($id);
        return view('pic_apoteks.edit', compact('data', 'picPrb'));
    }

    public function update(Request $request, $picPrb, $id)
    {
        $data = PicApotek::where('pic_prb_id', $picPrb)->findOrFail($id);

        $validated = $request->validate([
            'nama_faskes' => 'required|string|max:255',
            'kab_kota'    => 'required|string|max:255',
            'nama_pic'    => 'required|string|max:255',
            'no_hp'       => 'required|string|max:20',
        ]);

        $data->update($validated);

        return redirect()
            ->route('pic-apoteks.index', ['picPrb' => $picPrb])
            ->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($picPrb, $id)
    {
        $data = PicApotek::where('pic_prb_id', $picPrb)->findOrFail($id);
        $data->delete();

        return redirect()
            ->route('pic-apoteks.index', ['picPrb' => $picPrb])
            ->with('success', 'Data berhasil dihapus.');
    }
}
