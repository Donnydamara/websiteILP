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
        Schema::create('jadwal_pengumpulan_data', function (Blueprint $table) {
            $table->id();
            $table->string('alamat');
            $table->string('rt');
            $table->string('rw');
            $table->string('dusun');
            $table->string('desa');
            $table->string('kecamatan');
            $table->string('kota');
            $table->string('provinsi');
            $table->integer('no_hp');
            $table->string('puskesmas');
            $table->string('postu');
            $table->string('posyandu');
            $table->string('nama');
            $table->integer('kk');
            $table->integer('id_user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_pengumpulan_data');
    }
};
