<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan_Bayi_Balita_Prasekolah extends Model
{
    use HasFactory;

    // Set the table name explicitly if it doesn't follow the convention
    protected $table = 'kunjungan_bayi_balita_prasekolah';

    // Specify the fields that are mass assignable
    protected $fillable = [
        'kk',
        'status',
        'nik',
        'nama',
        'tgl_lahir',
        'tmp_lahir',
        'gender',
        'kunjungan',
        'tgl_kunjungan',
        'suhu_tubuh',
        'buku_kia',
        'tgl_timbang_ukur',
        'tempat_timbang_ukur',
        'petugas_timbang_ukur',
        'bb_hasil_timbang_ukur',
        'pb_tb_hasil_timbang_ukur',
        'lk_hasil_timbang_ukur',
        'jenis_imunisasi',
        'hepatitis_b_0bulan',
        'bcg_0bulan',
        'polio_0bulan',
        'bcg_1bulan',
        'polio_1bulan',
        'dpt_hb_hib_1_2bulan',
        'polio_2_2bulan',
        'pcv_1_2bulan',
        'rv_1_2bulan',
        'dpt_hb_hib_2_3bulan',
        'polio_3_3bulan',
        'pcv_2_3bulan',
        'rv_2_3bulan',
        'dpt_hb_hib_3_4bulan',
        'polio_4_4bulan',
        'polio_suntik_4bulan',
        'rv_3_4bulan',
        'campak_rubelia_9bulan',
        'polio_suntik_2_9bulan',
        'je_10bulan',
        'pv_3_12bulan',
        'dpt_lanjut_1_18bulan',
        'campak_lanjut_18bulan',
        'makanan_pokok',
        'makanan_protein_hewan',
        'makanan_protein_nabati',
        'makanan_lemak',
        'sayur_buah',
        'oc_ada',
        'oc_tgl',
        'kv_jenis',
        'tgl_kv_mulai',
        'tgl_kv_selesai',
        'makan_tambah_ada',
        'makan_tambah_kepatuhan',
        'edukasi',
        'napas',
        'batuk',
        'diare',
        'jmh_warna_kencing',
        'warna_kulit',
        'aktifitas',
        'hisapan_bayi',
        'pemberian_makan',
        'pengingat_periksa_postu',
        'lapor_nakes',
        'id_user'
    ];
    // Pastikan properti ini diatur menjadi true
    public $timestamps = true;
    public $updated_at = true;
}
