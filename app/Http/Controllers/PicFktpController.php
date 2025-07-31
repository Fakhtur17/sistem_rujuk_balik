<?php

namespace App\Http\Controllers;

use App\Models\PicFktp;
use Illuminate\Http\Request;

class PicFktpController extends Controller
{
    public function index($pic_prb_id)
    {
        $data = PicFktp::where('pic_prb_id', $pic_prb_id)->paginate(10);
        return view('pic_fktps.index', compact('data', 'pic_prb_id'));
    }

    public function create($pic_prb_id)
    {
        return view('pic_fktps.create', compact('pic_prb_id'));
    }

    public function store(Request $request, $pic_prb_id)
    {
        $request->validate([
            'nama_faskes' => 'required',
            'kab_kota' => 'required',
            'nama_pic' => 'required',
            'no_hp' => 'required',
        ]);

        PicFktp::create(array_merge($request->all(), ['pic_prb_id' => $pic_prb_id]));

        return redirect()
            ->route('pic-fktps.index', $pic_prb_id)
            ->with('success', 'Data PIC FKTP berhasil ditambahkan.');
    }

    public function edit($pic_prb_id, $id)
    {
        $data = PicFktp::where('id', $id)
                      ->where('pic_prb_id', $pic_prb_id)
                      ->firstOrFail();

        return view('pic_fktps.edit', compact('data', 'pic_prb_id'));
    }

    public function update(Request $request, $pic_prb_id, $id)
    {
        $data = PicFktp::where('id', $id)
                      ->where('pic_prb_id', $pic_prb_id)
                      ->firstOrFail();

        $request->validate([
            'nama_faskes' => 'required',
            'kab_kota' => 'required',
            'nama_pic' => 'required',
            'no_hp' => 'required',
        ]);

        $data->update($request->all());

        return redirect()
            ->route('pic-fktps.index', $pic_prb_id)
            ->with('success', 'Data PIC FKTP berhasil diperbarui.');
    }

    public function destroy($pic_prb_id, $id)
    {
        $data = PicFktp::where('id', $id)
                      ->where('pic_prb_id', $pic_prb_id)
                      ->firstOrFail();

        $data->delete();

        return back()->with('success', 'Data PIC FKTP berhasil dihapus.');
    }
}
