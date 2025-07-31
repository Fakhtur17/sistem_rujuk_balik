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
    Schema::create('obats', function (Blueprint $table) {
        $table->id();
        $table->foreignId('apotek_id')->constrained()->onDelete('cascade');
        $table->string('nama_obat');
        $table->string('kategori')->nullable();
        $table->text('deskripsi')->nullable();
        $table->integer('stok')->default(0); // ini yang penting!
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('obats');
    }
};
