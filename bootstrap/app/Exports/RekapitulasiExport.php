<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class RekapitulasiExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $data;
    protected $startDate;
    protected $endDate;
    private $serialNumber = 0;

    public function __construct($data, $startDate, $endDate)
    {
        $this->data = $data;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function collection()
    {
        return $this->data;
    }

    /**
     * Menentukan header untuk file Excel.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            ['Rekapitulasi Kunjungan'],
            ['Tanggal Pendataan: ' . $this->startDate . ' - ' . $this->endDate],
            [],
            [
                'NO',
                'Total Keluarga Dikunjungi',
                'Ibu Hamil',
                'Ibu Bersalin/Nifas',
                'Kunjungan Bayi/Balita/Prasekolah',
                'Kunjungan Usia Sekolah',
                'Kunjungan Usia Dewasa',
                'Kunjungan Lansia',
                'Tidak Status (1)',
                'Tanda Bahaya',
                'Tidak Status (2)',
                'Kasus TBC',
                'Minum Obat TBC',
                'Edukasi',
                'Lapor Nakes'
            ]
        ];
    }

    /**
     * Memetakan data untuk setiap baris.
     *
     * @param $item
     * @return array
     */
    public function map($item): array
    {
        return [
            ++$this->serialNumber,
            $item['total_families_visited'],
            $item['ibu_hamil_count'],
            $item['ibu_bersalin_nifas_count'],
            $item['kunjungan_bayi_balita_prasekolah_count'],
            $item['kunjungan_usia_sekolah_count'],
            $item['kunjungan_usia_dewasa_count'],
            $item['kunjungan_lansia_count'],
            $item['tidak_status_count'],
            $item['tanda_bahaya_count'],
            $item['tidak_status_count2'],
            $item['TBC_count'],
            $item['minum_TBC_count'],
            $item['edukasi_count'],
            $item['lapor_Nakes_count']
        ];
    }

    /**
     * Style untuk file Excel.
     *
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        $totalRows = $this->data->count() + 3; // +3 untuk header tambahan

        $sheet->getStyle("A4:O{$totalRows}")->applyFromArray([
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
            1 => ['font' => ['bold' => true, 'size' => 14]],
            2 => ['font' => ['bold' => true, 'size' => 12]],
            4 => [
                'font' => ['bold' => true],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '28a745']
                ],
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
