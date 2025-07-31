<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class RekrutmenExport implements FromCollection, WithHeadings
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = DB::table('rekrutmens')
            ->join('fktps', 'rekrutmens.fktp_id', '=', 'fktps.id')
            ->select(
                'rekrutmens.nama_peserta',
                'rekrutmens.nomor_kartu_jkn',
                'rekrutmens.nomor_hp',
                'fktps.nama_fktp',
                'rekrutmens.nama_fkrtl',
                'rekrutmens.tanggal_prb',
                'rekrutmens.status'
            );

        // ✅ Filter status
        if (!empty($this->filters['status'])) {
            $query->where('rekrutmens.status', $this->filters['status']);
        }

        // ✅ Filter tanggal_prb
        if (!empty($this->filters['from']) && !empty($this->filters['to'])) {
            $query->whereBetween('rekrutmens.tanggal_prb', [
                $this->filters['from'],
                $this->filters['to'],
            ]);
        }

        return $query->orderBy('rekrutmens.created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'Nama Peserta',
            'Nomor SEP',
            'Nomor HP',
            'Nama FKTP',
            'Nama FKRTL',
            'Tanggal PRB',
            'Status'
        ];
    }
}
