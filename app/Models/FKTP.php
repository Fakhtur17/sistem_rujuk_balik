<?php

// app/Models/FKTP.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FKTP extends Model
{
    use HasFactory;

    protected $table = 'fktps'; // <--- Tambahkan ini

    protected $fillable = ['nama_fktp', 'kabupaten_kota'];
    // App\Models\FKTP.php
    public function rekrutmens()
    {
        return $this->hasMany(Rekrutmen::class, 'fktp_id');
    }


}
