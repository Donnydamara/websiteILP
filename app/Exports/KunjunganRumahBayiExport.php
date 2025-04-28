<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KunjunganRumahBayiExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $data;
    protected $serialNumber = 0;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function collection()
    {
        return $this->data->sortBy('kk')->values();
    }

    public function headings(): array
    {
        return [
            [
                'No', 'KK', 'NIK', 'Nama', 'Tanggal Lahir', 'Tempat Lahir', 'Jenis Kelamin', 'Kunjungan',
                'Tanggal Kunjungan', 'Suhu Tubuh', 'Ada Buku KIA', 'ASI Ekslusif', 'LILA', 'Tanggal Terakhir Ditimbang Dan Diukur ', ' ',
                ' ', 'Hasil Penimbangan Dan Pengukuran', '  ', '  ', 'Kunjungan Pemeriksaan Bayi Setelah Dilahirkan (0-28 Hari)',
                ' ', '', ' ',
                'Jenis Imunisasi', '', '', '', '',
                '', '', '', '',
                '', '', '', '',
                '', '', '', '',
                'Pemberian Edukasi/Kunjungan Nakes', 'Tanda Bahaya Pada Bayi 0-2 Bulan', '', '', '', '',
                '', '', '', '', '', '', '',
                'Pengingat Pemeriksaan', 'Tanggal Lapor ke Nakes',
            ],
            [
                '', '', '', '', '', '', '', '', '', ' ', '  ', ' ', '', ' ', ' ',
                ' ', '  ', '  ', '  ', ' ',
                ' ', ' ', ' ',  'Usia 0 Bulan', '', '', 'Usia 1 Bulan', '', 'Usia 2 Bulan', '', '', '',
                'Usia 3 Bulan', '', '', '', 'Usia 4 Bulan', '', '', '', '', '', '', '', '', '', '',
                '', '', '', '', '', '', '', '', '',
            ],
            [
                '', '', '', '', '', '', '', '', '', ' ', '  ', ' ', '', 'Tanggal Timbang', 'Tempat Timbang',
                'Petugas Timbang', 'Hasil Timbang BB', 'Hasil Timbang PB', 'Hasil Timbang LK', 'Jenis Pemeriksaan',
                'Tanggal Pemeriksaan', 'Tempat Pemeriksaan', 'Petugas Pemeriksaan',  'Hepatitis B (0 bln)', 'BCG (0 bln)', 'Polio Tetes (0 bln)',
                'BCG (1 bln)', 'Polio Tetes 1 (1 bln)', 'DPT-HB-Hib 1 (2 bln)', 'Polio Tetes 1 (2 bln)', 'PCV 1 (2 bln)', 'RV 1 (2 bln)',
                'DPT-HB-Hib 2 (3 bln)', 'Polio Tetes 2 (3 bln)', 'PCV 2 (3 bln)', 'RV 2 (3 bln)', 'DPT-HB-Hib 3 (4 bln)', 'Polio Tetes 3 (4 bln)', 'PCV 3 (4 bln)', 'RV 3 (4 bln)',
                '', 'Napas', 'Aktivitas', 'Warna Kulit', 'Hisapan Bayi', 'Kejang',
                'Suhu Tubuh', 'Buang Air Besar (BAB)', 'Jumlah dan Warna Kencing', 'Tali Pusar', 'Mata', 'Kulit', 'Imunisasi', '', '',
            ],
        ];
    }

    public function map($row): array
    {
        return [
            ++$this->serialNumber,
            $row->kk,
            $row->nik,
            $row->nama,
            $row->tgl_lahir,
            $row->tmp_lahir,
            $row->gender,
            $row->kunjungan,
            $row->tgl_kunjungan,
            $row->suhu,
            $row->buku_kia,
            $row->asi,
            $row->lila,
            $row->tgl_timbang,
            $row->tmp_timbang,
            $row->petugas_timbang,
            $row->hasil_timbang_ukur_bb,
            $row->hasil_timbang_ukur_pb,
            $row->hasil_timbang_ukur_lk,
            $row->jenis_kunjungan_pemeriksaan,
            $row->tgl_pemeriksaan,
            $row->tmp_pemeriksaan,
            $row->petugas_pemeriksaan,

            $row->hepatitis_b_0bln,
            $row->bcg_0bln,
            $row->polio_tetes_0bln,
            $row->bcg_1bln,
            $row->polio_tetes_1_1bln,
            $row->dpt_hb_hib_1_2bln,
            $row->polio_tetes_1_2bln,
            $row->pcv_1_2bln,
            $row->rv_1_2bln,
            $row->dpt_hb_hib_2_3bln,
            $row->polio_tetes_2_3bln,
            $row->pcv_2_3bln,
            $row->rv_2_3bln,
            $row->dpt_hb_hib_3_4bln,
            $row->polio_tetes_3_4bln,
            $row->pcv_3_4bln,
            $row->rv_3_4bln,
            $row->edukasi_kunjungan,
            $row->napas,
            $row->aktifitas,
            $row->warna_kulit,
            $row->hisapan_bayi,
            $row->kejang,
            $row->suhu_tubuh,
            $row->bab,
            $row->jmhdanwarna_kencing,
            $row->tali_pusar,
            $row->mata,
            $row->kulit,
            $row->imunisasi,
            $row->pengingat_pemeriksaan,
            $row->tgl_lapor_nakes,
        ];
    }

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
        $sheet->mergeCells('K1:K3');
        $sheet->mergeCells('L1:L3');
        $sheet->mergeCells('M1:M3');
        $sheet->mergeCells('N1:P2');
        $sheet->mergeCells('Q1:S2');
        $sheet->mergeCells('Q1:S2');
        $sheet->mergeCells('T1:W2');
        $sheet->mergeCells('X1:AN1');
        $sheet->mergeCells('X2:Z2');
        $sheet->mergeCells('AA2:AB2');
        $sheet->mergeCells('AA2:AB2');
        $sheet->mergeCells('AC2:AF2');
        $sheet->mergeCells('AG2:AJ2');
        $sheet->mergeCells('AK2:AN2');
        $sheet->mergeCells('AO1:AO3');
        $sheet->mergeCells('AP1:BA2');
        $sheet->mergeCells('BB1:BB3');
        $sheet->mergeCells('BC1:BC3');



        $totalRows = $this->data->count() + 3;

        $sheet->getStyle("A1:BC{$totalRows}")->applyFromArray([
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
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '28a745'],
                ],
            ],
            2 => [
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '28a745'],
                ],
            ],
            3 => [
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '28a745'],
                ],
            ],
        ];
    }
}
