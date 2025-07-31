<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::table('rekrutmens', function (Blueprint $table) {
        $table->enum('status', ['baru', 'sedang_fktp', 'sedang_apotek', 'selesai'])
              ->default('baru')
              ->after('id');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rekrutmens', function (Blueprint $table) {
            //
        });
    }
};
