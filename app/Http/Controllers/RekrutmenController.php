<?php

namespace App\Http\Controllers;

use App\Models\Rekrutmen;
use App\Models\Farmasi;
use App\Models\FKTP;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Exports\RekrutmenExport;
use Maatwebsite\Excel\Facades\Excel; // Penting untuk mengelola file

class RekrutmenController extends Controller
{
    /**
     * Menampilkan daftar rekrutmen dengan pencarian.
     */
    public function index(Request $request)
    {
        // Mulai dengan query builder
        $query = Rekrutmen::with('fktp');

        // Logika pencarian yang lebih sederhana dan efisien
        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(function($subQuery) use ($q) {
                $subQuery->where('nama_peserta', 'like', "%$q%")
                         ->orWhere('nomor_kartu_jkn', 'like', "%$q%");
            });
        }

        // Ambil data dengan urutan terbaru dan paginasi
        $rekrutmens = $query->latest('tanggal_prb')->paginate(10)->withQueryString();

        return view('rekrutmens.index', compact('rekrutmens'));
    }

    /**
     * Tampilkan form tambah rekrutmen.
     */
    public function create()
    {
        $farmasis = Farmasi::all();
        $fktps = FKTP::all();
        return view('rekrutmens.create', compact('farmasis', 'fktps'));
    }

    /**
     * Simpan data rekrutmen ke database.
     */
    public function store(Request $request)
    {
        // PERUBAHAN: Validasi sekarang mengizinkan PDF
        $request->validate([
            'tanggal_prb'     => 'required|date',
            'nama_fkrtl'      => 'required|string|max:255',
            'nama_peserta'    => 'required|string|max:255',
            'nomor_kartu_jkn' => 'required|string|size:19',
            'nomor_hp'        => 'required|string|min:10|max:13',
            'fktp_id'         => 'required|exists:fktps,id',
            'link_srb'        => 'required|file|mimes:jpg,jpeg,png,gif,pdf|max:5120', // Izinkan gambar dan PDF
        ]);

        $path = null;
        if ($request->hasFile('link_srb')) {
            // Simpan file ke 'storage/app/public/srb' dan dapatkan path relatifnya
            $path = $request->file('link_srb')->store('srb', 'public');
        }

        Rekrutmen::create([
            'tanggal_prb'     => $request->tanggal_prb,
            'nama_fkrtl'      => $request->nama_fkrtl,
            'nama_peserta'    => $request->nama_peserta,
            'nomor_kartu_jkn' => $request->nomor_kartu_jkn,
            'nomor_hp'        => $request->nomor_hp,
            'fktp_id'         => $request->fktp_id,
            // Simpan HANYA path relatifnya, bukan URL lengkap
            'link_srb'        => $path,
        ]);

        return redirect()->route('rekrutmens.index')->with('success', 'Data berhasil ditambahkan.');
    }

    /**
     * Tampilkan form edit data rekrutmen.
     */
    public function edit(Rekrutmen $rekrutmen)
    {
        $farmasis = Farmasi::all();
        $fktps = FKTP::all();
        return view('rekrutmens.edit', compact('rekrutmen', 'farmasis', 'fktps'));
    }

    /**
     * Perbarui data rekrutmen.
     */
    public function update(Request $request, Rekrutmen $rekrutmen)
    {
        // PERUBAHAN: Validasi sekarang mengizinkan PDF
        $request->validate([
            'tanggal_prb'     => 'required|date',
            'nama_fkrtl'      => 'required|string|max:255',
            'nama_peserta'    => 'required|string|max:255',
            'nomor_kartu_jkn' => 'required|string|size:19',
            'nomor_hp'        => 'required|string|min:10|max:15',
            'fktp_id'         => 'required|exists:fktps,id',
            'link_srb'        => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf|max:5120', // Izinkan gambar dan PDF
        ]);

        $data = $request->only([
            'tanggal_prb', 'nama_fkrtl', 'nama_peserta',
            'nomor_kartu_jkn', 'nomor_hp', 'fktp_id'
        ]);

        // Jika ada file baru yang diunggah
        if ($request->hasFile('link_srb')) {
            // 1. Hapus file lama jika ada
            if ($rekrutmen->link_srb) {
                Storage::disk('public')->delete($rekrutmen->link_srb);
            }
            
            // 2. Simpan file baru dan dapatkan path-nya
            $path = $request->file('link_srb')->store('srb', 'public');
            $data['link_srb'] = $path;
        }

        $rekrutmen->update($data);

        return redirect()->route('rekrutmens.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Hapus data rekrutmen.
     */
    public function destroy(Rekrutmen $rekrutmen)
    {
        // Hapus file dari storage sebelum menghapus data dari database
        if ($rekrutmen->link_srb) {
            Storage::disk('public')->delete($rekrutmen->link_srb);
        }
        
        $rekrutmen->delete();
        return redirect()->route('rekrutmens.index')->with('success', 'Data berhasil dihapus.');
    }
    public function updateStatus(Request $request, $id)
{
    $user = $request->user();
    $role = $user->role;

    // Tentukan status yang diizinkan berdasarkan role
    if ($role === 'admin') {
        $allowedStatus = ['baru', 'sedang_fktp', 'sedang_apotek', 'selesai'];
    } elseif ($role === 'fktp') {
        $allowedStatus = ['sedang_fkrtl'];
    } elseif ($role === 'apotek') {
        $allowedStatus = ['sedang_apotek', 'selesai'];
    } else {
        abort(403, 'Role tidak diizinkan mengubah status.');
    }

    // Validasi
    $request->validate([
        'status' => 'required|in:' . implode(',', $allowedStatus),
    ]);

    // Update
    $rekrutmen = Rekrutmen::findOrFail($id);
    $rekrutmen->status = $request->status;
    $rekrutmen->save();

    return redirect()->back()->with('success', 'Status berhasil diperbarui.');
}
public function export(Request $request)
{
    $from = $request->query('from');
    $to = $request->query('to');

    $query = Rekrutmen::with('fktp');

    if ($from && $to) {
        $query->whereBetween('tanggal_prb', [$from, $to]);
    }

    $data = $query->get();

    return Excel::download(new RekrutmenExport($data), 'rekrutmen-' . now()->format('Ymd-His') . '.xlsx');
}

}
