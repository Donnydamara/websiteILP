<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class IbuHamilExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $data;
    protected $serialNumber = 0;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Return the data that should be exported.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // return $this->data;
        return $this->data->sortBy('kk')->values();
    }

    // Define the headings for the Excel export
    public function headings(): array
    {
        return [
            [
                'No', 'KK', 'NIK', 'Nama', 'Kehamilan Ke', 'Jarak Kehamilan (Unit)', 'Umur',
                'Kunjungan', 'Tanggal Kunjungan', 'Suhu Tubuh', 'KIA', 'Ibu Memeriksakan Kehamilan', '', '', '', 'Isi Piringku Untuk Ibu Hamil', 'TTD', '', 'LILA <23,5',
                'PMT Untuk Bumil KEK', 'Mengikuti Kelas Ibu Hamil Terakhir', '', '', 'Melakukan Skrining Kesehatan Jiwa', '', '', 'Edukasi', 'Tanda Bahaya', '', '', '', '', '', '', '', '', '', 'Mengingatkan Periksa Ke Postu/Fasyankes', 'Melaporkan Ke Nakes'
            ],
            [
                '', '', '', '', '', '', '', '', '', '', '', 'Trimester', 'Tanggal IMK', 'Tempat IMK', 'Petugas IMK',
                '', 'ADA', 'Minum Hari Ini/ Dalam 24 Jam Terakhir', '', '', 'Tanggal', 'Tempat', 'Pendamping',
                'Tanggal', 'Tempat', 'Petugas', '',
                'Demam', 'Sakit Kepala', 'Sulit Tidur', 'Diare', 'TBC', 'Gerakan Janin', 'Jantung Sakit',
                'Keluar Cairan', 'Kencing Manis', 'Nyeri Perut', '', '',
            ],
        ];
    }

    // Map the data to the correct format for each row
    public function map($lingkunganRumah): array
    {
        // Tentukan jarak kehamilan berdasarkan unit
        $jarakKehamilan = $lingkunganRumah->jarak_kehamilan_unit === 'tahun'
            ? $lingkunganRumah->jarak_kehamilan_tahun . ' tahun'
            : $lingkunganRumah->jarak_kehamilan_bulan . ' bulan';

        return [
            ++$this->serialNumber,
            substr($lingkunganRumah->kk, 0, 0) . 'xxxxxxxxxxxxxxxx',
            "'" . $lingkunganRumah->nik, // Menambahkan tanda kutip tunggal untuk NIK
            $lingkunganRumah->nama,
            $lingkunganRumah->kehamilan_ke,
            $jarakKehamilan, // Menampilkan jarak kehamilan dengan unit yang sesuai
            $lingkunganRumah->umur,
            $lingkunganRumah->kunjungan,
            $lingkunganRumah->tgl_kunjungan,
            $lingkunganRumah->suhu_tubuh,
            $lingkunganRumah->kia,
            $lingkunganRumah->jenis_imk,
            $lingkunganRumah->tgl_imk,
            $lingkunganRumah->tempat_imk,
            $lingkunganRumah->petugas_imk,
            $lingkunganRumah->porsi,
            $lingkunganRumah->ada_ttd,
            $lingkunganRumah->minum_ttd,
            $lingkunganRumah->lila,
            $lingkunganRumah->pmt,
            $lingkunganRumah->kls_ibu_hamil,
            $lingkunganRumah->tempat_ibu_hamil,
            $lingkunganRumah->pendamping_ibu_hamil,
            $lingkunganRumah->kls_skrining_kesehatan,
            $lingkunganRumah->tempat_skrining_kesehatan,
            $lingkunganRumah->petugas_skrining_kesehatan,
            $lingkunganRumah->edukasi,
            $lingkunganRumah->demam_l2,
            $lingkunganRumah->sakit_kepala_l2,
            $lingkunganRumah->sulit_tidur_l2,
            $lingkunganRumah->diare_l2,
            $lingkunganRumah->tbc_l2,
            $lingkunganRumah->gerakan_janin_l2,
            $lingkunganRumah->jantung_sakit_l2,
            $lingkunganRumah->keluar_cairan_l2,
            $lingkunganRumah->kencing_manis_l2,
            $lingkunganRumah->nyeri_perut_l2,
            $lingkunganRumah->periksa_l2,
            $lingkunganRumah->lapor_nakes,
        ];
    }


    // Style the Excel export
    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:A2');
        $sheet->mergeCells('B1:B2');
        $sheet->mergeCells('C1:C2');
        $sheet->mergeCells('D1:D2');
        $sheet->mergeCells('E1:E2');
        $sheet->mergeCells('F1:F2');
        $sheet->mergeCells('G1:G2');
        $sheet->mergeCells('H1:H2');
        $sheet->mergeCells('I1:I2');
        $sheet->mergeCells('J1:J2');
        $sheet->mergeCells('K1:K2');
        $sheet->mergeCells('L1:O1');
        $sheet->mergeCells('P1:P2');
        $sheet->mergeCells('Q1:R1');
        $sheet->mergeCells('S1:S2');
        $sheet->mergeCells('T1:T2');
        $sheet->mergeCells('U1:W1');
        $sheet->mergeCells('X1:Z1');
        $sheet->mergeCells('AA1:AA2');
        $sheet->mergeCells('AB1:AK1');
        $sheet->mergeCells('AL1:AL2');
        $sheet->mergeCells('AM1:AM2');


        $totalRows = $this->data->count() + 2; // +1 for headers

        $sheet->getStyle("A1:AM{$totalRows}")->applyFromArray([
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
        ];
    }
}
