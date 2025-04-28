<?php

namespace App\Exports;

use App\Models\Kunjungan_Usia_Sekolah;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KunjunganUsiaSekolahExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $data;
    protected $serialNumber = 0;

    public function __construct($data)
    {
        $this->data = $data;
    }
    /**
     * Mengambil data yang akan diekspor.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // return $this->data;
        return $this->data->sortBy('kk')->values();
    }

    /**
     * Menentukan header untuk file Excel.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            [
                'NO', 'KK', 'NIK', 'Nama', 'Tanggal Lahir', 'Tempat Lahir', 'Jenis Kelamin', 'Kunjungan',
                'Tanggal Kunjungan', 'Suhu Tubuh', 'Tanggal Terakhir', '',
                'Isi Piringku Usia Sekolah/ Remaja', 'Hasil Penimbangan Dan Pengukuran', '', '', 'Remaja Putri',
                '', '', '', '',
                'Merokok', 'Remaja >15 Tahun Pemeriksaan PTM*) Satu Tahun Terakhir', '',
                '', '', '',
                '', 'Melakukan Skrining Kesehatan Jiwa', '', '', 'Edukasi',
            ],
            [
                '', '', '', '', ' ', ' ', ' ', '', ' ', ' ', ' Menimbang Dan Mengukur', '', '',
                '', '', '', 'Ada TTD Putri',
                'Minum TTD Putri', 'Pemeriksaan Anemia(Skrining Hb) Sau Tahun Terakhir', '', '', '',
                'Gula Darah', '', '',
                'Tekanan Darah', '', '', '', '', '', '',
                '',
            ],
            [
                '', '', '', '', ' ', ' ', ' ', '', ' ', ' ', 'Tanggal', 'Tempat', '',
                'Berat Badan (BB)', 'Tinggi Badan (TB)', 'Lingkar Pinggang (LP)', '',
                '', 'Tanggal', 'Tempat', 'Hasil', '', 'Tanggal', 'Tempat',
                'Hasil', 'Tanggal', 'Tempat',
                'Hasil', 'Tanggal', 'Tempat', 'Petugas', '',
            ],
        ];
    }

    /**
     * Memetakan data untuk setiap baris.
     *
     * @param $kunjunganUsiaSekolah
     * @return array
     */
    public function map($kunjunganUsiaSekolah): array
    {
        return [
            ++$this->serialNumber,
            substr($kunjunganUsiaSekolah->kk, 0, 0) . 'xxxxxxxxxxxxxxxx',
            "'" . $kunjunganUsiaSekolah->nik,
            $kunjunganUsiaSekolah->nama,
            $kunjunganUsiaSekolah->tgl_lahir,
            $kunjunganUsiaSekolah->tmp_lahir,
            $kunjunganUsiaSekolah->gender,
            $kunjunganUsiaSekolah->kunjungan,
            $kunjunganUsiaSekolah->tgl_kunjungan,
            $kunjunganUsiaSekolah->suhu_tubuh,
            $kunjunganUsiaSekolah->tgl_timbang_ukur,
            $kunjunganUsiaSekolah->tmp_timbang_ukur,
            $kunjunganUsiaSekolah->porsi,
            $kunjunganUsiaSekolah->bb_timbang_ukur,
            $kunjunganUsiaSekolah->tb_timbang_ukur,
            $kunjunganUsiaSekolah->lp_timbang_ukur,
            $kunjunganUsiaSekolah->ada_ttd_putri,
            $kunjunganUsiaSekolah->minum_ttd_putri,
            $kunjunganUsiaSekolah->tgl_skrining_hb_putri,
            $kunjunganUsiaSekolah->tmp_skrining_hb_putri,
            $kunjunganUsiaSekolah->hasil_skrining_hb_putri,
            $kunjunganUsiaSekolah->merokok,
            $kunjunganUsiaSekolah->tgl_gula_darah_periksi_ptm,
            $kunjunganUsiaSekolah->tmp_gula_darah_periksi_ptm,
            $kunjunganUsiaSekolah->hasil_gula_darah_periksi_ptm,
            $kunjunganUsiaSekolah->tgl_tekanan_darah_periksi_ptm,
            $kunjunganUsiaSekolah->tmp_tekanan_darah_periksi_ptm,
            $kunjunganUsiaSekolah->hasil_tekanan_darah_periksi_ptm,
            $kunjunganUsiaSekolah->tgl_skrining,
            $kunjunganUsiaSekolah->tmp_skrining,
            $kunjunganUsiaSekolah->petugas_skrining,
            $kunjunganUsiaSekolah->edukasi,
        ];
    }
    // Style the Excel export
    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:A3');
        $sheet->mergeCells('B1:B3');
        $sheet->mergeCells('C1:C3');
        $sheet->mergeCells('D1:D3');
        $sheet->mergeCells('E1:E3');
        $sheet->mergeCells('F1:F3');
        $sheet->mergeCells('G1:G3');
        $sheet->mergeCells('H1:H3');
        $sheet->mergeCells('I1:I3');
        $sheet->mergeCells('J1:J3');
        $sheet->mergeCells('K1:L1');
        $sheet->mergeCells('K2:L2');
        $sheet->mergeCells('M1:M3');
        $sheet->mergeCells('N1:P2');
        $sheet->mergeCells('Q1:U1');
        $sheet->mergeCells('Q2:Q3');
        $sheet->mergeCells('R2:R3');
        $sheet->mergeCells('S2:U2');
        $sheet->mergeCells('V1:V3');
        $sheet->mergeCells('W1:AB1');
        $sheet->mergeCells('W2:Y2');
        $sheet->mergeCells('Z2:AB2');
        $sheet->mergeCells('AC1:AE2');
        $sheet->mergeCells('AF1:AF3');


        $totalRows = $this->data->count() + 3; // +1 for headers

        $sheet->getStyle("A1:AF{$totalRows}")->applyFromArray([
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
            ],
        ];
    }
}
