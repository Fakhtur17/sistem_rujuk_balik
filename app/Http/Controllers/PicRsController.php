<?php

namespace App\Http\Controllers;

use App\Models\PicRs;
use Illuminate\Http\Request;

class PicRsController extends Controller
{
    public function index($pic_prb_id)
    {
        $data = PicRs::where('pic_prb_id', $pic_prb_id)->paginate(10);
        return view('pic_rs.index', compact('data', 'pic_prb_id'));
    }

    public function create($pic_prb_id)
    {
        return view('pic_rs.create', compact('pic_prb_id'));
    }

    public function store(Request $request, $pic_prb_id)
    {
        $request->validate([
            'nama_faskes' => 'required',
            'kab_kota' => 'required',
            'nama_pic' => 'required',
            'no_hp' => 'required',
        ]);

        PicRs::create(array_merge($request->all(), ['pic_prb_id' => $pic_prb_id]));

        return redirect()->route('pic-rs.index', $pic_prb_id)
                         ->with('success', 'Data PIC RS berhasil ditambahkan.');
    }

    public function edit($pic_prb_id, $id)
    {
        $data = PicRs::findOrFail($id);
        return view('pic_rs.edit', compact('data', 'pic_prb_id'));
    }

    public function update(Request $request, $pic_prb_id, $id)
    {
        $data = PicRs::findOrFail($id);
        $request->validate([
            'nama_faskes' => 'required',
            'kab_kota' => 'required',
            'nama_pic' => 'required',
            'no_hp' => 'required',
        ]);
        $data->update($request->all());

        return redirect()->route('pic-rs.index', $pic_prb_id)
                         ->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($pic_prb_id, $id)
    {
        $data = PicRs::findOrFail($id);
        $data->delete();

        return redirect()->route('pic-rs.index', $pic_prb_id)
                         ->with('success', 'Data berhasil dihapus.');
    }
}
