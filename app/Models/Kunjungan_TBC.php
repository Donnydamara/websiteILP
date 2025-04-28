<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kunjungan_TBC extends Model
{
    use HasFactory;

    protected $table = 'kunjungan_tbc';
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
        'batuk_skrining',
        'demam_skrining',
        'bb_skrining',
        'kontak_erat_keluarga',
        'kontak_erat_tetangga',
        'kontak_erat_art',
        'tgl_diaknosa',
        'tmp_diaknosa',
        'tgl_periksa_terakhir',
        'tmp_periksa_terakhir',
        'obat_tbc',
        'minum_obat_tbc',
        'nama_pmo',
        'merokok',
        'edukasi',
        'periksa_postu_fasyankes',
        'tgl_lapor',
        'id_user'
    ];
    // Pastikan properti ini diatur menjadi true
    public $timestamps = true;
    public $updated_at = true;
}
