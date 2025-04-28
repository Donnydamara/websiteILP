<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan_Lansia extends Model
{
    use HasFactory;

    protected $table = 'kunjungan_lansia';

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
        'tgl_periksa_satu_tahun_terakhir_ptd',
        'tmp_periksa_satu_tahun_terakhir_ptd',
        'hasil_periksa_satu_tahun_terakhir_ptd',
        'tgl_diaknosa_darah_ptd',
        'tgl_periksa_satu_tahun_terakhir_darah',
        'tmp_periksa_satu_tahun_terakhir_darah',
        'hasil_periksa_satu_tahun_terakhir_darah',
        'obat_terakhir_darah',
        'minum_obat_terakhir_darah',
        'tgl_periksa_satu_tahun_gula_darah',
        'tmp_periksa_satu_tahun_gula_darah',
        'hasil_periksa_satu_tahun_gula_darah',
        'tgl_kencing_manis_gula_darah',
        'tgl_periksa_satu_tahun_gula_darah_melitus',
        'tmp_periksa_satu_tahun_gula_darah_melitus',
        'hasil_periksa_satu_tahun_gula_darah_melitus',
        'obat_gula_darah_melitus',
        'minum_obat_gula_darah_melitus',
        'tgl_aks_skrining_geriatri',
        'tmp_aks_skrining_geriatri',
        'tgl_skilas_skrining_geriatri',
        'tmp_skilas_skrining_geriatri',
        'merokok',
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
