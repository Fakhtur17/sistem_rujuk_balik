<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PicApotek extends Model
{
    use HasFactory;

    protected $fillable = [
        'pic_prb_id',
        'nama_faskes',
        'kab_kota',
        'nama_pic',
        'no_hp',
    ];

    public function picPrb()
    {
        return $this->belongsTo(PicPrb::class);
    }
}
