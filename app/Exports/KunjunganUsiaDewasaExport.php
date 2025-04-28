<?php

namespace App\Exports;

use App\Models\Kunjungan_Usia_Dewasa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KunjunganUsiaDewasaExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
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
        return $this->data->sortBy('kk')->values();
    }

    // Define the headings for the Excel export
    public function headings(): array
    {
        return [
            [
                'NO', 'KK', 'NIK', 'Nama', 'Tanggal Lahir', 'Tempat Lahir',
                'Jenis Kelamin', 'Riwayat Penyakit', 'Kunjungan',
                'Tanggal Kunjungan', 'Suhu Tubuh', 'Porsi', 'Pemeriksaan Tekanan Darah',
                '', '',
                '', 'Terdiagnosa Tekanan Darah Tinggi/ Hipertensi',
                '', '',
                '', '', 'Pemeriksaan Kadar Gula Darah',
                '', '', '',
                'Terdiagnosa Kadar Gula Darah Tinggi/ Diabetes Melitus', '',
                '', '', '',
                'Merokok', 'Jenis Kontrasepsi', 'Melakukan Sekrining Kesehatan Jiwa', '', '', 'Pemberian Edukasi/ Kunjungan Nakes',
            ],
            [
                '', '', '', '', '', '', '',
                '', '', '', '',
                '', 'Pemeriksaan Dalam Satu Tahun Terakhir', '', '', 'Terdiagnosa Darah Tinggi/ Hipertensi', 'Pemeriksaan Dalam Satu Bulan Terakhir',
                '', '', 'Ada Obat Hipertensi', 'Sudah Minum Obat Hari Ini/ 24 Jam Terakhir',
                'Pemeriksaan Dalam Satu Tahun Terakhir',
                '', '', 'Terdiagnosa Kencing Manis/ Diabetes Melitus (DM)', 'Pemeriksaan Dalam Satu Bulan Terakhir', '', '', 'Ada Obat DM', 'Sudah Minum Obat Hari Ini/ 24 Jam',
                '', '', '', '', '', '', '',
            ],
            [
                '', '', '', '', '', '', '',
                '', '', '', '',
                '', '', '', '', '', '',
                '', '', '', '', '',
                '', '', '', '', '',
                '', '', '', '', '', '', '', '', '',
            ],
            [
                '', '', '', '', '', '', '',
                '', '', '', '',
                '', 'Tanggal', 'Tempat', 'Hasil', 'Tanggal', 'Tanggal',
                'Tempat', 'Hasil', '', '', 'Tanggal',
                'Tempat', 'Hasil', 'Tanggal', 'Tempat', 'Tanggal',
                'Hasil', '', '', '', '', 'Tanggal', 'Tempat', 'Petugas', '',
            ],
        ];
    }
    /**
     * Memetakan data untuk setiap baris.
     *
     * @param $kunjunganUsiaSekolah
     * @return array
     */
    // Map the data to the correct format for each row
    public function map($kunjunganusiaDewasa): array
    {
        return [
            ++$this->serialNumber,
            substr($kunjunganusiaDewasa->kk, 0, 0) . 'xxxxxxxxxxxxxxxx',
            "'" . $kunjunganusiaDewasa->nik,
            $kunjunganusiaDewasa->nama,
            $kunjunganusiaDewasa->tgl_lahir,
            $kunjunganusiaDewasa->tmp_lahir,
            $kunjunganusiaDewasa->gender,
            $kunjunganusiaDewasa->riwayat_penyakit,
            $kunjunganusiaDewasa->kunjungan,
            $kunjunganusiaDewasa->tgl_kunjungan,
            $kunjunganusiaDewasa->suhu_tubuh,
            $kunjunganusiaDewasa->porsi,
            $kunjunganusiaDewasa->tgl_periksa_satu_tahun_terakhir_ptd,
            $kunjunganusiaDewasa->tmp_periksa_satu_tahun_terakhir_ptd,
            $kunjunganusiaDewasa->hasil_periksa_satu_tahun_terakhir_ptd,
            $kunjunganusiaDewasa->tgl_diaknosa_darah_ptd,
            $kunjunganusiaDewasa->tgl_periksa_satu_tahun_terakhir_darah,
            $kunjunganusiaDewasa->tmp_periksa_satu_tahun_terakhir_darah,
            $kunjunganusiaDewasa->hasil_periksa_satu_tahun_terakhir_darah,
            $kunjunganusiaDewasa->obat_terakhir_darah,
            $kunjunganusiaDewasa->minum_obat_terakhir_darah,
            $kunjunganusiaDewasa->tgl_periksa_satu_tahun_gula_darah,
            $kunjunganusiaDewasa->tmp_periksa_satu_tahun_gula_darah,
            $kunjunganusiaDewasa->hasil_periksa_satu_tahun_gula_darah,
            $kunjunganusiaDewasa->tgl_kencing_manis_gula_darah,
            $kunjunganusiaDewasa->tgl_periksa_satu_tahun_gula_darah_melitus,
            $kunjunganusiaDewasa->tmp_periksa_satu_tahun_gula_darah_melitus,
            $kunjunganusiaDewasa->hasil_periksa_satu_tahun_gula_darah_melitus,
            $kunjunganusiaDewasa->obat_gula_darah_melitus,
            $kunjunganusiaDewasa->minum_obat_gula_darah_melitus,
            $kunjunganusiaDewasa->merokok,
            $kunjunganusiaDewasa->jenis_kontrasepsi,
            $kunjunganusiaDewasa->tgl_skrining,
            $kunjunganusiaDewasa->tmp_skrining,
            $kunjunganusiaDewasa->petugas_skrining,
            $kunjunganusiaDewasa->edukasi,
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
        $sheet->mergeCells('M1:P1');
        $sheet->mergeCells('M2:O3');
        $sheet->mergeCells('P2:P3');
        $sheet->mergeCells('Q2:S3');
        $sheet->mergeCells('Q1:U1');
        $sheet->mergeCells('T2:T4');
        $sheet->mergeCells('U2:U4');
        $sheet->mergeCells('V1:Y1');
        $sheet->mergeCells('V2:X3');
        $sheet->mergeCells('Y2:Y3');
        $sheet->mergeCells('Z1:AD1');
        $sheet->mergeCells('Z2:AB3');
        $sheet->mergeCells('AC2:AC4');
        $sheet->mergeCells('AD2:AD4');
        $sheet->mergeCells('AE1:AE4');
        $sheet->mergeCells('AF1:AF4');
        $sheet->mergeCells('AG1:AI3');
        $sheet->mergeCells('AJ1:AJ4');


        $totalRows = $this->data->count() + 4; // +1 for headers

        $sheet->getStyle("A1:AJ{$totalRows}")->applyFromArray([
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
            ], 4 => [
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
