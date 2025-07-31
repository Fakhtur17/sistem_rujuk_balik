<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Fktp;
use App\Models\Farmasi;
use App\Models\Apotek;
use App\Models\Rekrutmen;
use App\Models\KunjunganFktp;
use App\Models\Obat;

class DashboardController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();
        $role = $user->role;

        switch ($role) {
            case 'admin':
                $fktpCount = Fktp::count();
                $farmasiCount = Farmasi::count();
                $apotekCount = Apotek::count();
                $pesertaCount = Rekrutmen::count();

               $from = request('from');
                $to = request('to');

                $rekrutmenBaru = Rekrutmen::when($from && $to, function ($query) use ($from, $to) {
                        return $query->whereBetween('tanggal_prb', [$from, $to]);
                    })
                    ->latest()
                    ->take(10)
                    ->get();


                $chartLabels = Fktp::pluck('nama_fktp')->toArray();
                $chartData = Fktp::withCount('rekrutmens')->get()->pluck('rekrutmens_count')->toArray();
                
                return view('dashboard.admin', compact(
                    'fktpCount',
                    'farmasiCount',
                    'apotekCount',
                    'pesertaCount',
                    'rekrutmenBaru',
                    'chartLabels',
                    'chartData',
                    'from',
                    'to'
                ));

            case 'fkrtl':
                $fkrtlName = $user->name;

                $totalPeserta = Rekrutmen::where('nama_fkrtl', 'like', '%' . $fkrtlName . '%')->count();
                $fktpCount = Fktp::count();

                $pesertaFktrl = Rekrutmen::with('fktp')
                    ->where('nama_fkrtl', 'like', '%' . $fkrtlName . '%')
                    ->latest()
                    ->take(10)
                    ->get();

                // Grafik jumlah peserta per FKTP yang merujuk ke FKRTL ini
                $groupedByFktp = Rekrutmen::where('nama_fkrtl', 'like', '%' . $fkrtlName . '%')
                    ->whereHas('fktp')
                    ->selectRaw('fktp_id, COUNT(*) as jumlah')
                    ->groupBy('fktp_id')
                    ->with('fktp')
                    ->get()
                    ->map(function($item) {
                        return [
                            'nama_fktp' => $item->fktp->nama_fktp ?? 'Tidak diketahui',
                            'jumlah' => $item->jumlah
                        ];
                    });

                $chartLabels = $groupedByFktp->pluck('nama_fktp')->toArray();
                $chartData = $groupedByFktp->pluck('jumlah')->toArray();

                // Handle jika kosong
                if (empty($chartLabels)) {
                    $chartLabels = ['Belum ada data'];
                    $chartData = [0];
                }

                return view('dashboard.fkrtl', compact(
                    'totalPeserta',
                    'fktpCount',
                    'chartLabels',
                    'chartData',
                    'fkrtlName',
                    'pesertaFktrl'
                ));

            case 'fktp':
                if (!$user->fktp_id) {
                    abort(403, 'User belum terhubung ke FKTP manapun.');
                }

                $fktp = Fktp::find($user->fktp_id);
                if (!$fktp) {
                    abort(403, 'FKTP tidak ditemukan.');
                }

                $fktpName = $fktp->nama_fktp;
                $jumlahPeserta = Rekrutmen::where('fktp_id', $fktp->id)->count();

                $rekrutmenBaru = Rekrutmen::with('fktp')
                    ->where('fktp_id', $fktp->id)
                    ->latest()
                    ->get();

                // Statistik
                $pesertaBulanIni = Rekrutmen::where('fktp_id', $fktp->id)
                    ->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->count();

                $pesertaMingguIni = Rekrutmen::where('fktp_id', $fktp->id)
                    ->where('created_at', '>=', now()->startOfWeek())
                    ->count();

                $pesertaHariIni = Rekrutmen::where('fktp_id', $fktp->id)
                    ->whereDate('created_at', now()->toDateString())
                    ->count();

                // Grafik berdasarkan FKRTL tujuan
                $groupedByFkrtl = Rekrutmen::select('nama_fkrtl')
                    ->selectRaw('COUNT(*) as jumlah')
                    ->where('fktp_id', $fktp->id)
                    ->whereNotNull('nama_fkrtl')
                    ->where('nama_fkrtl', '!=', '')
                    ->groupBy('nama_fkrtl')
                    ->orderByDesc('jumlah')
                    ->get();

                if ($groupedByFkrtl->isEmpty()) {
                    $chartLabels = ['Belum ada data'];
                    $chartData = [0];
                } else {
                    $chartLabels = $groupedByFkrtl->pluck('nama_fkrtl')->toArray();
                    $chartData = $groupedByFkrtl->pluck('jumlah')->toArray();
                }

                return view('dashboard.fktp', compact(
                    'fktpName',
                    'jumlahPeserta',
                    'rekrutmenBaru',
                    'chartLabels',
                    'chartData',
                    'pesertaBulanIni',
                    'pesertaMingguIni',
                    'pesertaHariIni'
                ));

            case 'apotek':
                $kunjunganFktp = KunjunganFktp::with('rekrutmen.fktp')
                    ->where('apotek_id', $user->apotek_id)
                    ->latest()
                    ->get();

                $apoteks = Apotek::all();

                $jumlahObatKosong = Obat::where('apotek_id', $user->apotek_id)
                    ->where('stok', 0)
                    ->count();

                return view('dashboard.apotek', compact(
                    'kunjunganFktp',
                    'apoteks',
                    'jumlahObatKosong'
                ));

            default:
                abort(403, 'Role tidak dikenali.');
        }
    }
}
