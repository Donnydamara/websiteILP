<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class TindakLanjutKunjunganExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
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
        return $this->data->sortBy('posyandu')->values();
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
                'NO', 'Posyandu', 'Waktu', 'Nama', 'NIK', 'Tanggal Lahir', 'Alamat',
                'No Telepon', 'Masalah Kesehatan yang Ditemukan', 'Tindak Lanjut', 'Edukasi', 'Lapor Nakes', 'Status'
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
            $item->posyandu,
            $item->waktu,
            $item->nama,
            "'" . $item->nik, // Menambahkan ' agar NIK ditampilkan sebagai teks
            $item->tgl_lahir,
            $item->alamat,
            $item->no_telepon,
            $item->masalah_kesehatan_yang_ditemukan,
            $item->tindak_lanjut,
            $item->edukasi,
            $item->lapor_nakes,
            $item->status,
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
        $totalRows = $this->data->count() + 1; // +1 untuk header

        $sheet->getStyle("A1:M{$totalRows}")->applyFromArray([
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
        ];
    }
}
