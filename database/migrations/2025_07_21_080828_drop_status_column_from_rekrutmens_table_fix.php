<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Hapus kolom status jika ada
        Schema::table('rekrutmens', function (Blueprint $table) {
            if (Schema::hasColumn('rekrutmens', 'status')) {
                $table->dropColumn('status');
            }
        });
    }

    public function down(): void
    {
        // Tambahkan kembali jika dibutuhkan rollback
        Schema::table('rekrutmens', function (Blueprint $table) {
            $table->enum('status', ['baru', 'sedang_fktp', 'sedang_apotek', 'selesai'])->default('baru');
        });
    }
};
