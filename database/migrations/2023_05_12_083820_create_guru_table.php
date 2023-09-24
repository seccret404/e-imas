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
        Schema::create('guru', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('npdn')->unique();
            $table->string('kode_guru');
            $table->string('alamat');
            $table->string('profil');
            $table->string('email');
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->string('no_hp');
            $table->string('jenis_kelamin');
            $table->string('status')->default('aktif');
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
        Schema::dropIfExists('guru');
    }
};
