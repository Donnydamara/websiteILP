<?php

namespace App\Exports;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;

class IbuBersalinNifasExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $ibuBersalinNifas;
    protected $serialNumber = 0;

    public function __construct($ibuBersalinNifas)
    {
        $this->ibuBersalinNifas = $ibuBersalinNifas;
    }

    /**
     * Return the data that should be exported.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->ibuBersalinNifas;
    }

    // Define the headings for the Excel export
    public function headings(): array
    {
        return [
            [
                'No', 'KK', 'NIK', 'Nama', 'Umur Ibu', 'Kelahiran Ke', 'Tanggal Persalinan', 'Pukul Persalinan',
                'Usia Kehamilan Saat Persalinan', 'Penolong Persalinan', 'Lainnya Penolong Persalinan', 'Tempat Persalinan',
                'Nama Tempat Persalinan', 'Cara Persalinan', 'Lainnya Cara Persalinan', 'Keadaan Ibu Pada Saat Persalinan',
                'Riwayat Inisiasi Menyusu Dini (IMD)', 'Kunjungan', 'Tanggal Kunjungan', 'Pemantauan Suhu Tubuh', 'Ada Buku KIA',
                'Ibu memeriksa kesehatan Ke Posyandu Prima/Puskesmas/Fasyankes  ', '', '', '', 'Isi Piringku Ibu Menyusui',
                'Kapsul Vitamin A', '', 'Menyusui', 'KB Pasca Persalinan', 'Skrining Kesehatan',
                '', '', 'Edukasi Kunjungan', 'Tanda Bahaya Setelah Bersalin', '', '', '', '', '', '', '', '', '', ',', '', '',
                'Pengingat Periksa Postu', 'Tanggal Laporan Nakes',
            ],
            [
                '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Lainnya Atau Kunjungan Rumah Oleh Nakes Untuk Melakukan Pemeriksaan', '', '', '', '', '', '', '', '', '', '', '', '', 'Demam', 'Ada Perasaan Bersalah, Mudah Menangis', 'Tidak Bisa BAK, BAK Sedikita Tapi ', 'Nafas Pendek Dan Terengah enga, Nafas Dangkal disertai', 'Payudara Bengkak Kemerahan Disertai', 'Sakit Kepala', 'Pendarahan (Pembalut', 'Area Sekitar Kelamin Bengkak',
                'Keluar Cairan', 'Pandangan Kabur', 'Darah Nifas Berbau Atau Mengalir', 'Keputihan Berlebih,', 'Jantung Berdebar',
            ],
            [
                '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'Setelah Melahirkarkan', '', '', '', '', 'Ada KVA', 'Waktu Minum KVA', '', '', 'Tanggal', 'Tempat', 'Petugas', '', '',  ',Kehilangan Minat, Gelisah, Gangguan Tidur', '', '', 'Nyeri, Benjolan Disertai Nyeri', '', '', '',
                '', '', '', '',
            ],
            [
                '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'KF', 'Tanggal Pemeriksaan', 'Tempat Pemeriksaan', 'Petugas Pemeriksaan', '', '', '', '', '', '', '', '', '', '', ',Gangguan Konsentrasi', 'Sering, Terasa Panas, Nyeri Panggul, Urin Keluar Tanpa Disadari', 'Nyeri dada, Nafas Berat, Batuk Lebih Dari 2 Minggu',
                'Ada Keluhan Dalam Menyusui', '', 'Basah Dalam 5 Menit)', 'Atau Nyeri Ada Luka Terbuka', 'Dari Jalan Lahir', '', 'Atau Ada Nyeri Pada Perut Bawah',
                'Berwarna Dan Berbau',
            ],
        ];
    }

    // Map the data to the correct format for each row
    public function map($data): array
    {
        return [
            ++$this->serialNumber,

            substr($data->kk, 0, 0) . 'xxxxxxxxxxxxxxxx',  // Menambahkan tanda kutip tunggal untuk KK
            "'" . $data->nik, // Tambahkan tanda kutip tunggal untuk NIK
            $data->nama,
            $data->umur_ibu,
            $data->kelahiran_ke,
            $data->tgl_persalinan,
            $data->pukul_persalinan,
            $data->usia_kehamilan_persalinan,
            $data->penolong_persalinan,
            $data->lainya_penolong_persalinan,
            $data->tmpt_persalinan,
            $data->nama_tmpt_persalinan,
            $data->cara_persalinan,
            $data->lainya_cara_persalinan,
            $data->keadaan_ibu_persalinan,
            $data->riwayat_imd_persalinan,
            $data->kunjungan,
            $data->tgl_kunjungan,
            $data->suhu_tubuh,
            $data->buku_ka,
            $data->pemeriksaan_kesehatan,
            $data->tgl_pk,
            $data->tempat_pk,
            $data->petugas_pk,
            $data->porsi,
            $data->ada_kva,
            $data->wkt_minum_kva,
            $data->menyusui,
            $data->kb_pasca_persalinan,
            $data->skrining_kesehatan,
            $data->skrining_kesehatan_tmp,
            $data->skrining_kesehatan_petugas,
            $data->edukasi_kunjungan,
            $data->demam,
            $data->perasaan,
            $data->sakit,
            $data->pernafasan,
            $data->payudara,
            $data->sakit_kepala,
            $data->pendarahan,
            $data->sakit_bagian_kelamin,
            $data->keluar_cairan,
            $data->pandangan_kabur,
            $data->darah_nifas,
            $data->keputihan,
            $data->jantung_berdebar,
            $data->pengingat_periksa_postu,
            $data->tgl_laporan_nakes,
        ];
    }

    // Style the Excel export
    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:A4');
        $sheet->mergeCells('B1:B4');
        $sheet->mergeCells('C1:C4');
        $sheet->mergeCells('D1:D4');
        $sheet->mergeCells('E1:E4');
        $sheet->mergeCells('F1:F4');
        $sheet->mergeCells('G1:G4');
        $sheet->mergeCells('H1:H4');
        $sheet->mergeCells('I1:I4');
        $sheet->mergeCells('J1:J4');
        $sheet->mergeCells('K1:K4');
        $sheet->mergeCells('L1:L4');
        $sheet->mergeCells('M1:M4');
        $sheet->mergeCells('N1:N4');
        $sheet->mergeCells('O1:O4');
        $sheet->mergeCells('P1:P4');
        $sheet->mergeCells('Q1:Q4');
        $sheet->mergeCells('R1:R4');
        $sheet->mergeCells('S1:S4');
        $sheet->mergeCells('T1:T4');
        $sheet->mergeCells('U1:U4');
        $sheet->mergeCells('V1:Y1');
        $sheet->mergeCells('V2:Y2');
        $sheet->mergeCells('V3:Y3');
        $sheet->mergeCells('Z1:Z4');
        $sheet->mergeCells('AA1:AB2');
        $sheet->mergeCells('AA3:AA4');
        $sheet->mergeCells('AB3:AB4');
        $sheet->mergeCells('AC1:AC4');
        $sheet->mergeCells('AD1:AD4');
        $sheet->mergeCells('AE1:AG2');
        $sheet->mergeCells('AE3:AE4');
        $sheet->mergeCells('AF3:AF4');
        $sheet->mergeCells('AG3:AG4');
        $sheet->mergeCells('AH1:AH4');
        $sheet->mergeCells('AI1:AU1');
        $sheet->mergeCells('AI2:AI4');
        $sheet->mergeCells('AK2:AK3');
        $sheet->mergeCells('AL2:AL3');
        $sheet->mergeCells('AN2:AN4');
        $sheet->mergeCells('AO2:AO3');
        $sheet->mergeCells('AP2:AP3');
        $sheet->mergeCells('AQ2:AQ3');
        $sheet->mergeCells('AR2:AR4');
        $sheet->mergeCells('AS2:AS3');
        $sheet->mergeCells('AT2:AT3');
        $sheet->mergeCells('AU2:AU4');
        $sheet->mergeCells('AV1:AV4');
        $sheet->mergeCells('AW1:AW4');


        // Tentukan range berdasarkan jumlah baris data
        $totalRows = count($this->ibuBersalinNifas) + 4; // +2 untuk header baris pertama dan kedua

        // Apply center, middle align, and all borders to all cells with data
        $sheet->getStyle("A1:AW{$totalRows}")->applyFromArray([
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        // Apply the styles for bold font and background color for header rows
        return [
            1 => [
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
                'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => '28a745']],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
            ],
            2 => [
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
                'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => '28a745']],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
            ],
            3 => [
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
                'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => '28a745']],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
            ],
            4 => [
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
                'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => '28a745']],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '000000'],
                    ],
                ],
            ],
        ];
    }
}
