<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ibu_Hamil extends Model
{
    use HasFactory;

    protected $table = 'ibu_hamil';

    protected $fillable = [
        'kk',
        'status',
        'nik',
        'nama',
        'kehamilan_ke',
        // 'jarak_kehamilan',
        'jarak_kehamilan_unit',
        'jarak_kehamilan_bulan',
        'jarak_kehamilan_tahun',
        'umur',
        'kunjungan',
        'tgl_kunjungan',
        'suhu_tubuh',
        'kia',
        'jenis_imk',
        'tgl_imk',
        'tempat_imk',
        'petugas_imk',
        'porsi',
        'ada_ttd',
        'minum_ttd',
        'lila',
        'pmt',
        'kls_ibu_hamil',
        'tempat_ibu_hamil',
        'pendamping_ibu_hamil',
        'kls_skrining_kesehatan',
        'tempat_skrining_kesehatan',
        'petugas_skrining_kesehatan',
        'edukasi',
        'demam_l2',
        'sakit_kepala_l2',
        'sulit_tidur_l2',
        'diare_l2',
        'tbc_l2',
        'gerakan_janin_l2',
        'jantung_sakit_l2',
        'keluar_cairan_l2',
        'kencing_manis_l2',
        'nyeri_perut_l2',
        'periksa_l2',
        'lapor_nakes',
        'id_user'
    ];

    // Pastikan properti ini diatur menjadi true
    public $timestamps = true;
    public $updated_at = true;
}
