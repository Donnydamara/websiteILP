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
        Schema::create('kunjungan_bayi_balita_prasekolahi', function (Blueprint $table) {
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
            $table->string('buku_kia')->nullable();
            $table->date('tgl_timbang_ukur')->nullable();
            $table->string('tempat_timbang_ukur')->nullable();
            $table->string('petugas_timbang_ukur')->nullable();
            $table->string('bb_hasil_timbang_ukur')->nullable();
            $table->string('pb_tb_hasil_timbang_ukur')->nullable();
            $table->string('lk_hasil_timbang_ukur')->nullable();
            $table->string('jenis_imunisasi')->nullable();
            $table->date('hepatitis_b_0bulan')->nullable();
            $table->date('bcg_0bulan')->nullable();
            $table->date('polio_0bulan')->nullable();
            $table->date('bcg_1bulan')->nullable();
            $table->date('polio_1bulan')->nullable();
            $table->date('dpt_hb_hib_1_2bulan')->nullable();
            $table->date('polio_2_2bulan')->nullable();
            $table->date('pcv_1_2bulan')->nullable();
            $table->date('rv_1_2bulan')->nullable();
            $table->date('dpt_hb_hib_2_3bulan')->nullable();
            $table->date('polio_3_3bulan')->nullable();
            $table->date('pcv_2_3bulan')->nullable();
            $table->date('rv_2_3bulan')->nullable();
            $table->date('dpt_hb_hib_3_4bulan')->nullable();
            $table->date('polio_4_4bulan')->nullable();
            $table->date('polio_suntik_4bulan')->nullable();
            $table->date('rv_3_4bulan')->nullable();
            $table->date('campak_rubelia_9bulan')->nullable();
            $table->date('polio_suntik_2_9bulan')->nullable();
            $table->date('je_10bulan')->nullable();
            $table->date('pv_3_12bulan')->nullable();
            $table->date('dpt_lanjut_1_18bulan')->nullable();
            $table->date('campak_lanjut_18bulan')->nullable();
            $table->string('makanan_pokok')->nullable();
            $table->string('makanan_protein_hewan')->nullable();
            $table->string('makanan_protein_nabati')->nullable();
            $table->string('makanan_lemak')->nullable();
            $table->string('sayur_buah')->nullable();
            $table->string('oc_ada')->nullable();
            $table->date('oc_tgl')->nullable();
            $table->string('kv_jenis')->nullable();
            $table->date('tgl_kv_mulai')->nullable();
            $table->date('tgl_kv_selesai')->nullable();
            $table->string('makan_tambah_ada')->nullable();
            $table->string('makan_tambah_kepatuhan')->nullable();
            $table->string('edukasi')->nullable();
            $table->string('napas')->nullable();
            $table->string('batuk')->nullable();
            $table->string('diare')->nullable();
            $table->string('jmh_warna_kencing')->nullable();
            $table->string('warna_kulit')->nullable();
            $table->string('aktifitas')->nullable();
            $table->string('hisapan_bayi')->nullable();
            $table->string('pemberian_makan')->nullable();
            $table->string('pengingat_periksa_postu')->nullable();
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
        Schema::dropIfExists('kunjungan_bayi_balita_prasekolahi');
    }
};
