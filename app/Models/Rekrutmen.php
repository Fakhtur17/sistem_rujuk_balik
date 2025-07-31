<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekrutmen extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'farmasi_id',
        'fktp_id',
        'tanggal_prb',
        'nama_fkrtl',
        'nama_peserta',
        'nomor_kartu_jkn',
        'nomor_hp',
        'link_srb',
        'status', // PASTIKAN BARIS INI ADA
    ];

    /**
     * Get the FKTP that owns the rekrutmen.
     */
    public function fktp()
    {
        return $this->belongsTo(FKTP::class, 'fktp_id');
    }

    /**
     * Get the Farmasi that owns the rekrutmen.
     */
    public function farmasi()
    {
        return $this->belongsTo(Farmasi::class, 'farmasi_id');
    }

    /**
     * Get the Kunjungan FKTP for the rekrutmen.
     */
    public function kunjunganFktp()
    {
        return $this->hasMany(KunjunganFktp::class);
    }

    /**
     * Get the Kunjungan Apotek for the rekrutmen.
     */
    public function kunjunganApotek()
    {
        return $this->hasMany(KunjunganApotek::class);
    }
}
