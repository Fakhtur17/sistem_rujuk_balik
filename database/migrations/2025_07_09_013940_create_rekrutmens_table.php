<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('rekrutmens', function (Blueprint $table) {
            $table->id();

            // FK ke FKTP
            $table->unsignedBigInteger('fktp_id')->nullable();
            $table->foreign('fktp_id')->references('id')->on('fktps')->onDelete('set null');

            // FK ke Farmasi RS
            $table->unsignedBigInteger('farmasi_id')->nullable();
            $table->foreign('farmasi_id')->references('id')->on('farmasis')->onDelete('set null');

            // Data peserta PRB
            $table->date('tanggal_prb');
            $table->string('nama_fkrtl');
            $table->string('nama_peserta');
            $table->string('nomor_kartu_jkn');
            $table->string('nomor_hp');
            $table->string('link_srb')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('rekrutmens');
    }
};
