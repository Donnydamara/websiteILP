<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan_Rumah_Bayi extends Model
{
    use HasFactory;
    protected $table = 'kunjungan_rumah_bayi';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
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
        'suhu',
        'buku_kia',
        'asi',
        'lila',
        'tgl_timbang',
        'tmp_timbang',
        'petugas_timbang',
        'hasil_timbang_ukur_bb',
        'hasil_timbang_ukur_pb',
        'hasil_timbang_ukur_lk',
        'jenis_kunjungan_pemeriksaan',
        'tgl_pemeriksaan',
        'tmp_pemeriksaan',
        'petugas_pemeriksaan',
        'jenis_imunisasi',
        'hepatitis_b_0bln',
        'bcg_0bln',
        'polio_tetes_0bln',
        'bcg_1bln',
        'polio_tetes_1_1bln',
        'dpt_hb_hib_1_2bln',
        'polio_tetes_1_2bln',
        'pcv_1_2bln',
        'rv_1_2bln',
        'dpt_hb_hib_2_3bln',
        'polio_tetes_2_3bln',
        'pcv_2_3bln',
        'rv_2_3bln',
        'dpt_hb_hib_3_4bln',
        'polio_tetes_3_4bln',
        'pcv_3_4bln',
        'rv_3_4bln',
        'edukasi_kunjungan',
        'napas',
        'aktifitas',
        'warna_kulit',
        'hisapan_bayi',
        'kejang',
        'suhu_tubuh',
        'bab',
        'jmhdanwarna_kencing',
        'tali_pusar',
        'mata',
        'kulit',
        'imunisasi',
        'pengingat_pemeriksaan',
        'tgl_lapor_nakes',
        'id_user'
    ];
    // Pastikan properti ini diatur menjadi true
    public $timestamps = true;
    public $updated_at = true;
}
