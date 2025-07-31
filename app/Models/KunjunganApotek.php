<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KunjunganApotek extends Model
{
    use HasFactory;

    protected $fillable = ['rekrutmen_id', 'nama_apotek', 'tanggal_kunjungan'];

    public function rekrutmen()
    {
        return $this->belongsTo(Rekrutmen::class);
    }

    public function apotek()
    {
        return $this->belongsTo(Apotek::class, 'nama_apotek', 'nama_apotek');
    }
}
