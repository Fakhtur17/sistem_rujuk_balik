<?php

// database/migrations/xxxx_xx_xx_create_farmasis_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('farmasis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_rs'); // Nama RS atau Klinik
            $table->string('alamat');
            $table->string('kota');
            $table->string('kontak')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('farmasis');
    }
};

