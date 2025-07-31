<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Tambahkan kolom jenis_pic ke tabel pic_prbs.
     */
    public function up(): void
    {
        Schema::table('pic_prbs', function (Blueprint $table) {
            $table->enum('jenis_pic', ['RS', 'FKTP', 'APOTEK'])->after('nama_pic');
        });
    }

    /**
     * Hapus kolom jenis_pic jika rollback.
     */
    public function down(): void
    {
        Schema::table('pic_prbs', function (Blueprint $table) {
            $table->dropColumn('jenis_pic');
        });
    }
};
