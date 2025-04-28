<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TargetDesa extends Model
{
    use HasFactory;

    protected $table = 'target_desa';

    protected $fillable = [
        'provinsi',
        'kota',
        'kecamatan',
        'desa',
        'puskesmas',
        'target_penduduk',
    ];
    // Pastikan properti ini diatur menjadi true
    public $timestamps = true;
    public $updated_at = true;

    /**
     * Membuat data baru.
     *
     * @param array $data
     * @return static
     */
    public static function createNew(array $data)
    {
        return static::create($data);
    }

    /**
     * Mengupdate data berdasarkan ID.
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
    public static function updateById(int $id, array $data)
    {
        $targetDesa = static::find($id);
        if ($targetDesa) {
            return $targetDesa->update($data);
        }
        return false;
    }

    /**
     * Menghapus data berdasarkan ID.
     *
     * @param int $id
     * @return bool|null
     */
    public static function deleteById(int $id)
    {
        $targetDesa = static::find($id);
        if ($targetDesa) {
            return $targetDesa->delete();
        }
        return false;
    }

    /**
     * Relasi one-to-many dengan JadwalPengumpulan.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function jadwalPengumpulan()
    {
        return $this->hasMany(JadwalPengumpulan::class, 'desa_id');
    }
}
