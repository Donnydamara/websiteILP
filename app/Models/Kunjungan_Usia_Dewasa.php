<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan_Usia_Dewasa extends Model
{
    use HasFactory;

    protected $table = 'kunjungan_usia_dewasa';

    protected $fillable = [
        'kk',
        'status',
        'nik',
        'nama',
        'tgl_lahir',
        'tmp_lahir',
        'gender',
        'riwayat_penyakit',
        'kunjungan',
        'tgl_kunjungan',
        'suhu_tubuh',
        'porsi',
        'tgl_periksa_satu_tahun_terakhir_ptd',
        'tmp_periksa_satu_tahun_terakhir_ptd',
        'hasil_periksa_satu_tahun_terakhir_ptd',
        'tgl_diaknosa_darah_ptd',
        'diaknosa_tekanan_darah',
        'diaknosa_gula_darah',
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
        'merokok',
        'jenis_kontrasepsi',
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
