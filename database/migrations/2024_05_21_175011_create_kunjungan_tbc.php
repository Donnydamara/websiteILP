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
        Schema::create('kunjungan_tbc', function (Blueprint $table) {
            $table->id();
            $table->integer('kk');
            $table->integer('nik')->nullable();
            $table->string('status');
            $table->string('nama')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('tmp_lahir')->nullable();
            $table->string('gender')->nullable();
            $table->string('kunjungan')->nullable();
            $table->date('tgl_kunjungan')->nullable();
            $table->string('batuk_skrining')->nullable();
            $table->string('demam_skrining')->nullable();
            $table->string('bb_skrining')->nullable();
            $table->text('kontak_erat_keluarga')->nullable();
            $table->text('kontak_erat_tetangga')->nullable();
            $table->text('kontak_erat_art')->nullable();
            $table->date('tgl_diaknosa')->nullable();
            $table->string('tmp_diaknosa')->nullable();
            $table->date('tgl_periksa_terakhir')->nullable();
            $table->string('tmp_periksa_terakhir')->nullable();
            $table->string('obat_tbc')->nullable();
            $table->string('minum_obat_tbc')->nullable();
            $table->string('nama_pmo')->nullable();
            $table->string('merokok')->nullable();
            $table->string('edukasi')->nullable();
            $table->string('periksa_postu_fasyankes')->nullable();
            $table->date('tgl_lapor')->nullable();
            $table->integer('id_user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungan_tbc');
    }
};
