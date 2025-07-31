<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pic_apoteks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pic_prb_id')->constrained('pic_prbs')->onDelete('cascade');
            $table->string('nama_faskes'); // Apotek atau Farmasi
            $table->string('kab_kota');
            $table->string('nama_pic');
            $table->string('no_hp');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pic_apoteks');
    }
};
