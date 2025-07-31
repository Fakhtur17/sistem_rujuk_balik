<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFktpsTable extends Migration
{
    public function up()
    {
        Schema::create('fktps', function (Blueprint $table) {
            $table->id();
            $table->string('nama_fktp');
            $table->string('kabupaten_kota');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fktps');
    }
}