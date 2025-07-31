<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KunjunganFktp extends Model
{
    use HasFactory;

    protected $table = 'kunjungan_fktp';

    protected $fillable = [
    'rekrutmen_id',
    'apotek_id',
    'kunjungan_ke',
    'tanggal_kunjungan',
];

    public function rekrutmen()
    {
        return $this->belongsTo(Rekrutmen::class);
    }
    public function apotek()
{
    return $this->belongsTo(Apotek::class);
}
public function fktp()
{
    return $this->belongsTo(Fktp::class);
}

}

