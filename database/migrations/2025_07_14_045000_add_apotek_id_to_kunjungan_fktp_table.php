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
    Schema::table('kunjungan_fktp', function (Blueprint $table) {
        $table->foreignId('apotek_id')->constrained()->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::table('kunjungan_fktp', function (Blueprint $table) {
        $table->dropForeign(['apotek_id']);
        $table->dropColumn('apotek_id');
    });
}

};
