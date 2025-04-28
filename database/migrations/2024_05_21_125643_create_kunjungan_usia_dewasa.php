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
        Schema::create('kunjungan_usia_dewasa', function (Blueprint $table) {
            $table->id();
            $table->integer('kk');
            $table->string('status');
            $table->integer('nik')->nullable();
            $table->string('nama')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('tmp_lahir')->nullable();
            $table->string('gender')->nullable();
            $table->string('riwayat_penyakit')->nullable();
            $table->string('kunjungan')->nullable();
            $table->date('tgl_kunjungan')->nullable();
            $table->string('suhu_tubuh')->nullable();
            $table->string('porsi')->nullable();
            $table->date('tgl_periksa_satu_tahun_terakhir_ptd')->nullable();
            $table->string('tmp_periksa_satu_tahun_terakhir_ptd')->nullable();
            $table->string('hasil_periksa_satu_tahun_terakhir_ptd')->nullable();
            $table->date('tgl_diaknosa_darah_ptd')->nullable();
            $table->date('tgl_periksa_satu_tahun_terakhir_darah')->nullable();
            $table->string('tmp_periksa_satu_tahun_terakhir_darah')->nullable();
            $table->string('hasil_periksa_satu_tahun_terakhir_darah')->nullable();
            $table->string('obat_terakhir_darah')->nullable();
            $table->string('diaknosa_tekanan_darah')->nullable();
            $table->string('diaknosa_gula_darah')->nullable();
            $table->string('minum_obat_terakhir_darah')->nullable();
            $table->date('tgl_periksa_satu_tahun_gula_darah')->nullable();
            $table->string('tmp_periksa_satu_tahun_gula_darah')->nullable();
            $table->string('hasil_periksa_satu_tahun_gula_darah')->nullable();
            $table->date('tgl_kencing_manis_gula_darah')->nullable();
            $table->date('tgl_periksa_satu_tahun_gula_darah_melitus')->nullable();
            $table->string('tmp_periksa_satu_tahun_gula_darah_melitus')->nullable();
            $table->string('hasil_periksa_satu_tahun_gula_darah_melitus')->nullable();
            $table->string('obat_gula_darah_melitus')->nullable();
            $table->string('minum_obat_gula_darah_melitus')->nullable();
            $table->string('merokok')->nullable();
            $table->string('jenis_kontrasepsi')->nullable();
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
        Schema::dropIfExists('kunjungan_usia_dewasa');
    }
};
