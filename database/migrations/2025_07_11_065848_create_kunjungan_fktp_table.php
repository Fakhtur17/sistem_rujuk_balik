<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('kunjungan_fktp', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rekrutmen_id')->constrained()->onDelete('cascade');
            $table->integer('kunjungan_ke');
            $table->date('tanggal_kunjungan');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('kunjungan_fktp');
    }
};

