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
        Schema::create('kunjungan_usia_sekolah', function (Blueprint $table) {
            $table->id();
            $table->integer('kk');
            $table->string('status');
            $table->integer('nik')->nullable();
            $table->string('nama')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('tmp_lahir')->nullable();
            $table->string('gender')->nullable();
            $table->string('kunjungan')->nullable();
            $table->date('tgl_kunjungan')->nullable();
            $table->string('suhu_tubuh')->nullable();
            $table->date('tgl_timbang_ukur')->nullable();
            $table->string('tmp_timbang_ukur')->nullable();
            $table->string('porsi')->nullable();
            $table->string('bb_timbang_ukur')->nullable();
            $table->string('tb_timbang_ukur')->nullable();
            $table->string('lp_timbang_ukur')->nullable();
            $table->string('ada_ttd_putri')->nullable();
            $table->string('minum_ttd_putri')->nullable();
            $table->date('tgl_skrining_hb_putri')->nullable();
            $table->string('tmp_skrining_hb_putri')->nullable();
            $table->string('hasil_skrining_hb_putri')->nullable();
            $table->string('merokok')->nullable();
            $table->date('tgl_gula_darah_periksi_ptm')->nullable();
            $table->string('tmp_gula_darah_periksi_ptm')->nullable();
            $table->string('hasil_gula_darah_periksi_ptm')->nullable();
            $table->date('tgl_tekanan_darah_periksi_ptm')->nullable();
            $table->string('tmp_tekanan_darah_periksi_ptm')->nullable();
            $table->string('hasil_tekanan_darah_periksi_ptm')->nullable();
            $table->date('tgl_skrining')->nullable();
            $table->string('tmp_skrining')->nullable();
            $table->string('petugas_skrining')->nullable();
            $table->string('edukasi')->nullable();
            $table->integer('id_user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungan_usia_sekolah');
    }
};
