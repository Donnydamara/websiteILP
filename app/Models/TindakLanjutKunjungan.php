<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TindakLanjutKunjungan extends Model
{
    use HasFactory;

    protected $table = 'tindak_lanjut_kunjungan';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';
    public $timestamps = true;

    protected $fillable = [
        'posyandu',
        'waktu',
        'nama',
        'nik',
        'tgl_lahir',
        'alamat',
        'no_telepon',
        'masalah_kesehatan_yang_ditemukan',
        'tindak_lanjut',
        'lapor_nakes',
        'edukasi',
        'status',
        'id_user'
    ];

    // Define the casts for attribute types
    protected $casts = [
        'waktu' => 'datetime',
        'tanggal_lahir' => 'date',
    ];
}
