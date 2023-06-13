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
        Schema::create('presensisiswa', function (Blueprint $table) {
            $table->id();
            $table->string('nisn');
            $table->string('id_siswa');
            $table->string('gambar');
            $table->date('tgl_presensi');
            $table->time('jam masuk');
            $table->time('jam keluar')->nullable();
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
        Schema::dropIfExists('presensisiswa');
    }
};
