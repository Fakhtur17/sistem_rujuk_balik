<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menambahkan kolom user_id ke tabel apoteks
     */
    public function up(): void
    {
        Schema::table('apoteks', function (Blueprint $table) {
            // Tambahkan kolom user_id dengan foreign key
            $table->foreignId('user_id')
                  ->nullable()
                  ->constrained('users') // nama tabel users
                  ->onDelete('cascade');
        });
    }

    /**
     * Menghapus kolom user_id jika rollback
     */
    public function down(): void
    {
        Schema::table('apoteks', function (Blueprint $table) {
            $table->dropForeign(['user_id']); // Hapus relasi foreign key
            $table->dropColumn('user_id');    // Hapus kolomnya
        });
    }
};
