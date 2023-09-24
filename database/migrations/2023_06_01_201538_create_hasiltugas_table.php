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
        Schema::create('hasiltugas', function (Blueprint $table) {
            $table->id('id_hasil');
            $table->Integer('id_tugas');
            $table->string('nama_pengumpul');
            $table->Integer('id_user');
            $table->string('mata_pelajaran');
            $table->string('file_hasil_tugas');
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
        Schema::dropIfExists('hasiltugas');
    }
};
