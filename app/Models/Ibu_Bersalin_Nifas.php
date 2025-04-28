<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ibu_Bersalin_Nifas extends Model
{
    use HasFactory;
    protected $table = 'ibu_bersalin_nifas';

    protected $fillable = [
        'kk',
        'nik',
        'nama',
        'umur_ibu',
        'status',
        'kelahiran_ke',
        'tgl_persalinan',
        'pukul_persalinan',
        'usia_kehamilan_persalinan',
        'penolong_persalinan',
        'lainya_penolong_persalinan',
        'tmpt_persalinan',
        'nama_tmpt_persalinan',
        'cara_persalinan',
        'lainya_cara_persalinan',
        'keadaan_ibu_persalinan',
        'riwayat_imd_persalinan',
        'kunjungan',
        'tgl_kunjungan',
        'suhu_tubuh',
        'buku_ka',
        'pemeriksaan_kesehatan',
        'tgl_pk',
        'tempat_pk',
        'petugas_pk',
        'porsi',
        'ada_kva',
        'wkt_minum_kva',
        'menyusui',
        'kb_pasca_persalinan',
        'skrining_kesehatan',
        'skrining_kesehatan_tmp',
        'skrining_kesehatan_petugas',
        'edukasi_kunjungan',
        'demam',
        'perasaan',
        'sakit',
        'pernafasan',
        'payudara',
        'sakit_kepala',
        'pendarahan',
        'sakit_bagian_kelamin',
        'keluar_cairan',
        'pandangan_kabur',
        'darah_nifas',
        'keputihan',
        'jantung_berdebar',
        'pengingat_periksa_postu',
        'tgl_laporan_nakes',
        'id_user'
    ];
    // Pastikan properti ini diatur menjadi true
    public $timestamps = true;
    public $updated_at = true;
}
