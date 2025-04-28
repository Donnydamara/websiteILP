<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan_Usia_Sekolah extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'kunjungan_usia_sekolah';

    // Kolom-kolom yang bisa diisi
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
        'tgl_timbang_ukur',
        'tmp_timbang_ukur',
        'porsi',
        'bb_timbang_ukur',
        'tb_timbang_ukur',
        'lp_timbang_ukur',
        'ada_ttd_putri',
        'minum_ttd_putri',
        'tgl_skrining_hb_putri',
        'tmp_skrining_hb_putri',
        'hasil_skrining_hb_putri',
        'merokok',
        'tgl_gula_darah_periksi_ptm',
        'tmp_gula_darah_periksi_ptm',
        'hasil_gula_darah_periksi_ptm',
        'tgl_tekanan_darah_periksi_ptm',
        'tmp_tekanan_darah_periksi_ptm',
        'hasil_tekanan_darah_periksi_ptm',
        'tgl_skrining',
        'tmp_skrining',
        'petugas_skrining',
        'edukasi',
        'id_user'
    ];
    // Pastikan properti ini diatur menjadi true
    public $timestamps = true;
    public $updated_at = true;
}
