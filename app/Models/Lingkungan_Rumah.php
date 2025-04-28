<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lingkungan_Rumah extends Model
{
    use HasFactory;

    protected $table = 'lingkungan_rumah'; // Sesuaikan nama tabel dengan penamaan sebenarnya
    protected $fillable = [
        'kk',
        'AK_total',
        'AK_lansia',
        'jumlah_AK_dewasa',
        'AK_remaja',
        'AK_balita',
        'AK_bayi',
        'AK_ibu_bersalin_nifas',
        'AK_ibu_hamil',
        'jkn_jamkesda',
        'sarana_air',
        'jenis_sumber_air',
        'jamban',
        'jenis_jamban',
        'ventilasi',
        'mengalami_gangguan_jiwa',
        'TBC_hipertensi_millitus',
        'nama',
        'id_user'
    ];
    // Pastikan properti ini diatur menjadi true
    public $timestamps = true;
    public $updated_at = true;
}
