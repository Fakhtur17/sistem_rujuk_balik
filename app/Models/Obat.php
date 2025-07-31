<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    protected $fillable = [
        'apotek_id', 'nama_obat', 'kategori', 'deskripsi', 'stok'
    ];

    public function apotek()
    {
        return $this->belongsTo(Apotek::class);
    }
}

