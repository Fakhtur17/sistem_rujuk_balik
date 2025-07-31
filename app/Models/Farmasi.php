<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Farmasi extends Model
{
    use HasFactory;

    protected $fillable = ['nama_rs', 'alamat', 'kota', 'kontak'];

    /**
     * Relasi: Farmasi memiliki banyak Rekrutmen
     */
    public function rekrutmens()
{
    return $this->hasMany(Rekrutmen::class, 'nama_fkrtl', 'nama_rs');
}
public function user()
{
    return $this->belongsTo(User::class);
}
}
