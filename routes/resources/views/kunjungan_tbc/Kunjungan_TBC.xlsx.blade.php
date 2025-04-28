<?php

namespace App\Exports;

use App\Models\Kunjungan_TBC;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KunjunganTBCExport implements FromArray, WithHeadings
{
    protected $nik;

    public function __construct($nik)
    {
        $this->nik = $nik;
    }

    public function array(): array
    {
        $kunjungantbc = Kunjungan_TBC::where('nik', $this->nik)->get();

        $exportData = [];

        foreach ($kunjungantbc as $kunjungan) {
            $exportData[] = [
                'Kunjungan' => $kunjungan->kunjungan,
                'Tanggal' => $kunjungan->tgl_kunjungan,
                'Batuk Skrining' => $kunjungan->batuk_skrining,
                'Demam Skrining' => $kunjungan->demam_skrining,
                'BB Skrining' => $kunjungan->bb_skrining,
                'Kontak Erat Keluarga' => $kunjungan->kontak_erat_keluarga,
                'Tanggal Diagnosa' => $kunjungan->tgl_diaknosa,
                'Tempat Diagnosa' => $kunjungan->tmp_diaknosa,
                'Tanggal Pemeriksaan Terakhir' => $kunjungan->tgl_periksa_terakhir,
                'Tempat Pemeriksaan Terakhir' => $kunjungan->tmp_periksa_terakhir,
                'Obat TBC' => $kunjungan->obat_tbc,
                'Minum Obat TBC' => $kunjungan->minum_obat_tbc,
                'Nama PMO' => $kunjungan->nama_pmo,
                'Merokok' => $kunjungan->merokok,
                'Edukasi' => $kunjungan->edukasi,
                'Periksa Postu Fasyankes' => $kunjungan->periksa_postu_fasyankes,
                'Tanggal Lapor' => $kunjungan->tgl_lapor,
            ];
        }

        return $exportData;
    }

    public function headings(): array
    {
        return ['Kunjungan', 'Tanggal', 'Batuk Skrining', 'Demam Skrining', 'BB Skrining', 'Kontak Erat Keluarga', 'Tanggal Diagnosa', 'Tempat Diagnosa', 'Tanggal Pemeriksaan Terakhir', 'Tempat Pemeriksaan Terakhir', 'Obat TBC', 'Minum Obat TBC', 'Nama PMO', 'Merokok', 'Edukasi', 'Periksa Postu Fasyankes', 'Tanggal Lapor'];
    }
}
