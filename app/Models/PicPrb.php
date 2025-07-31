<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PicPrb extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pic',
        'jenis_pic',
    ];

    public function rs()
    {
        return $this->hasMany(PicRs::class);
    }

    public function fktps()
    {
        return $this->hasMany(PicFktp::class);
    }

    public function apoteks()
    {
        return $this->hasMany(PicApotek::class);
    }
}
