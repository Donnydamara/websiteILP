<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPengumpulan extends Model
{
    use HasFactory;

    protected $table = 'jadwal_pengumpulan_data';

    protected $fillable = [
        'alamat',
        'rt',
        'rw',
        'dusun',
        'desa',
        'kecamatan',
        'kota',
        'provinsi',
        'no_hp',
        'puskesmas',
        'postu',
        'posyandu',
        'nama',
        'kk',
        'desa_id',
        'id_user'
    ];
    // Pastikan properti ini diatur menjadi true
    public $timestamps = true;
    public $updated_at = true;

    /**
     * Relasi many-to-one dengan TargetDesa.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function targetDesa()
    {
        return $this->belongsTo(TargetDesa::class, 'desa_id');
    }
}
