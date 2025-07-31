<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apotek extends Model
{
    use HasFactory;

    // Atribut yang bisa diisi secara massal
    protected $fillable = ['nama_apotek', 'kota_kabupaten', 'user_id'];

    // Relasi: Apotek punya banyak Obat
    public function obats()
    {
        return $this->hasMany(Obat::class);
    }

    // Relasi: Apotek dimiliki oleh satu User
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
