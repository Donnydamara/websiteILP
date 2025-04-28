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
        Schema::create('ibu_hamil', function (Blueprint $table) {
            $table->id();
            $table->string('kk');
            $table->string('status');
            $table->string('nik')->nullable();
            $table->string('nama')->nullable();
            $table->integer('kehamilan_ke')->nullable();
            $table->string('jarak_kehamilan_unit')->nullable();
            $table->string('jarak_kehamilan_bulan')->nullable();
            $table->string('jarak_kehamilan_tahun')->nullable();
            $table->integer('umur')->nullable();
            $table->string('kunjungan')->nullable();
            $table->date('tgl_kunjungan')->nullable();
            $table->string('suhu_tubuh')->nullable();
            $table->string('kia')->nullable();
            $table->string('jenis_imk')->nullable();
            $table->date('tgl_imk')->nullable();
            $table->string('tempat_imk')->nullable();
            $table->string('petugas_imk')->nullable();
            $table->string('porsi')->nullable();
            $table->string('ada_ttd')->nullable();
            $table->string('minum_ttd')->nullable();
            $table->string('lila')->nullable();
            $table->string('pmt')->nullable();
            $table->date('kls_ibu_hamil')->nullable();
            $table->string('tempat_ibu_hamil')->nullable();
            $table->string('pendamping_ibu_hamil')->nullable();
            $table->date('kls_skrining_kesehatan')->nullable();
            $table->string('tempat_skrining_kesehatan')->nullable();
            $table->string('petugas_skrining_kesehatan')->nullable();
            $table->string('edukasi')->nullable();
            $table->string('demam_l2')->default(false);
            $table->string('sakit_kepala_l2')->default(false);
            $table->string('sulit_tidur_l2')->default(false);
            $table->string('diare_l2')->default(false);
            $table->string('tbc_l2')->default(false);
            $table->string('gerakan_janin_l2')->default(false);
            $table->string('jantung_sakit_l2')->default(false);
            $table->string('keluar_cairan_l2')->default(false);
            $table->string('kencing_manis_l2')->default(false);
            $table->string('nyeri_perut_l2')->default(false);
            $table->string('periksa_l2')->default(false);
            $table->string('lapor_nakes')->nullable();
            $table->integer('id_user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ibu_hamil');
    }
};
