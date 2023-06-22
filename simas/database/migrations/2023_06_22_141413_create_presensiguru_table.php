<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('presensiguru', function (Blueprint $table) {
            $table->id();
            $table->string('npdn');
            $table->string('id_guru');
            $table->string('gambar');
            $table->date('tgl_presensi');
            $table->time('jam_masuk');
            $table->time('jam_keluar')->nullable();
            $table->string('location_masuk');
            $table->string('lokasi_keluar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('presensiguru');
    }
};
