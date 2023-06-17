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
        Schema::create('hasilujian', function (Blueprint $table) {
            $table->id();
            $table->Integer('id_ujian');
            $table->Integer('id_siswa');
            $table->string('nama_pengumpul');
            $table->string('jenis_ujian');
            $table->string('file_hasil_ujian');
            $table->date('dedline');
            $table->string('uploaded')->default('0');
            $table->integer('nilai')->default('0');
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
        Schema::dropIfExists('hasilujian');
    }
};
