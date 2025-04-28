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
        Schema::create('ibu_bersalin_nifas', function (Blueprint $table) {
            $table->id();
            $table->integer('kk');
            $table->string('status');
            $table->integer('nik')->nullable();
            $table->string('nama')->nullable();
            $table->integer('umur_ibu')->nullable();
            $table->integer('kelahiran_ke')->nullable();
            $table->date('tgl_persalinan')->nullable();
            $table->time('pukul_persalinan')->nullable();
            $table->integer('usia_kehamilan_persalinan')->nullable();
            $table->string('penolong_persalinan')->nullable();
            $table->string('lainya_penolong_persalinan')->nullable();
            $table->string('tmpt_persalinan')->nullable();
            $table->string('nama_tmpt_persalinan')->nullable();
            $table->string('cara_persalinan')->nullable();
            $table->string('lainya_cara_persalinan')->nullable();
            $table->string('keadaan_ibu_persalinan')->nullable();
            $table->string('riwayat_imd_persalinan')->nullable();
            $table->string('kunjungan')->nullable();
            $table->date('tgl_kunjungan')->nullable();
            $table->string('suhu_tubuh')->nullable();
            $table->string('buku_ka')->nullable();
            $table->string('pemeriksaan_kesehatan')->nullable();
            $table->date('tgl_pk')->nullable();
            $table->string('tempat_pk')->nullable();
            $table->string('petugas_pk')->nullable();
            $table->string('porsi')->nullable();
            $table->string('ada_kva')->nullable();
            $table->date('wkt_minum_kva')->nullable();
            $table->string('menyusui')->nullable();
            $table->string('kb_pasca_persalinan')->nullable();
            $table->date('skrining_kesehatan')->nullable();
            $table->string('skrining_kesehatan_tmp')->nullable();
            $table->string('skrining_kesehatan_petugas')->nullable();
            $table->string('edukasi_kunjungan')->nullable();
            $table->string('demam')->nullable();
            $table->string('perasaan')->nullable();
            $table->string('sakit')->nullable();
            $table->string('pernafasan')->nullable();
            $table->string('payudara')->nullable();
            $table->string('sakit_kepala')->nullable();
            $table->string('pendarahan')->nullable();
            $table->string('sakit_bagian_kelamin')->nullable();
            $table->string('keluar_cairan')->nullable();
            $table->string('pandangan_kabur')->nullable();
            $table->string('darah_nifas')->nullable();
            $table->string('keputihan')->nullable();
            $table->string('jantung_berdebar')->nullable();
            $table->string('pengingat_periksa_postu')->nullable();
            $table->date('tgl_laporan_nakes');
            $table->integer('id_user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ibu_bersalin_nifas');
    }
};
