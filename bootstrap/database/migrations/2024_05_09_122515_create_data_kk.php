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
        Schema::create('data_kk', function (Blueprint $table) {
            $table->id();
            $table->integer('kk');
            $table->string('nama');
            $table->integer('nik');
            $table->date('tgl_lahir');
            $table->string('gender');
            $table->string('hubungan_keluarga');
            $table->string('status_perkawinan');
            $table->string('pendidikan_terakhir');
            $table->string('pekerjaan');
            $table->string('kelompok_sasaran');
            $table->integer('id_user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_kk');
    }
};
