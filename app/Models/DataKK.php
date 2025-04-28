<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKK extends Model
{
    use HasFactory;

    protected $table = 'data_kk';

    protected $fillable = [
        'kk',
        'nama',
        'nik',
        'tgl_lahir',
        'gender',
        'hubungan_keluarga',
        'status_perkawinan',
        'pendidikan_terakhir',
        'pekerjaan',
        'kelompok_sasaran',
        'id_user'
    ];

    protected $dates = [
        'tgl_lahir',
        'created_at',
        'updated_at',
    ];


    // Pastikan properti ini diatur menjadi true
    public $timestamps = true;
    public $updated_at = true;
}
