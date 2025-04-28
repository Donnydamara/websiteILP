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
        Schema::create('kunjungan_rumah_bayi', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('kk');
            $table->string('status');
            $table->string('nik')->nullable();
            $table->string('nama')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('tmp_lahir')->nullable();
            $table->string('gender')->nullable();
            $table->string('kunjungan')->nullable();
            $table->date('tgl_kunjungan')->nullable();
            $table->string('suhu')->nullable();
            $table->string('buku_kia')->nullable();
            $table->string('asi')->nullable();
            $table->string('lila')->nullable();
            $table->date('tgl_timbang')->nullable();
            $table->string('tmp_timbang')->nullable();
            $table->string('petugas_timbang')->nullable();
            $table->string('hasil_timbang_ukur_bb')->nullable();
            $table->string('hasil_timbang_ukur_pb')->nullable();
            $table->string('hasil_timbang_ukur_lk')->nullable();
            $table->string('jenis_kunjungan_pemeriksaan')->nullable();
            $table->date('tgl_pemeriksaan')->nullable();
            $table->string('tmp_pemeriksaan')->nullable();
            $table->string('petugas_pemeriksaan')->nullable();
            $table->string('jenis_imunisasi')->nullable();
            $table->date('hepatitis_b_0bln')->nullable();
            $table->date('bcg_0bln')->nullable();
            $table->date('polio_tetes_0bln')->nullable();
            $table->date('bcg_1bln')->nullable();
            $table->date('polio_tetes_1_1bln')->nullable();
            $table->date('dpt_hb_hib_1_2bln')->nullable();
            $table->date('polio_tetes_1_2bln')->nullable();
            $table->date('pcv_1_2bln')->nullable();
            $table->date('rv_1_2bln')->nullable();
            $table->date('dpt_hb_hib_2_3bln')->nullable();
            $table->date('polio_tetes_2_3bln')->nullable();
            $table->date('pcv_2_3bln')->nullable();
            $table->date('rv_2_3bln')->nullable();
            $table->date('dpt_hb_hib_3_4bln')->nullable();
            $table->date('polio_tetes_3_4bln')->nullable();
            $table->date('pcv_3_4bln')->nullable();
            $table->date('rv_3_4bln')->nullable();
            $table->string('edukasi_kunjungan')->nullable();
            $table->string('napas')->nullable();
            $table->string('aktifitas')->nullable();
            $table->string('warna_kulit')->nullable();
            $table->string('hisapan_bayi')->nullable();
            $table->string('kejang')->nullable();
            $table->string('suhu_tubuh')->nullable();
            $table->string('bab')->nullable();
            $table->string('jmhdanwarna_kencing')->nullable();
            $table->string('tali_pusar')->nullable();
            $table->string('mata')->nullable();
            $table->string('kulit')->nullable();
            $table->string('imunisasi')->nullable();
            $table->string('pengingat_pemeriksaan')->nullable();
            $table->date('tgl_lapor_nakes')->nullable();
            $table->integer('id_user');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kunjungan_rumah_bayi');
    }
};
