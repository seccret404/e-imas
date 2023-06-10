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
        Schema::create('surat_izins', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->string('role');
            $table->string('nama_request');
            $table->string('jenis_surat');
            $table->text('keterangan_surat');
            $table->text('keterangan_tambahan');
            $table->date('waktu_mulai');
            $table->date('waktu_berakhir');
            $table->string('role',12);
            $table->string('status');
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
        Schema::dropIfExists('surat_izins');
    }
};
