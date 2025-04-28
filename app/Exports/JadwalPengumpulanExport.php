<?php

namespace App\Exports;

use App\Models\JadwalPengumpulan;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromCollection;

class JadwalPengumpulanExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $jadwals;
    protected $serialNumber = 0;

    public function __construct($jadwals)
    {
        $this->jadwals = $jadwals;
    }

    /**
     * Return the data that should be exported.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->jadwals;
    }

    // Define the headings for the Excel export with two rows
    public function headings(): array
    {
        return [
            ['No', 'Kepala Keluarga', 'Kartu Keluarga', 'Alamat', 'RT', 'RW', 'Dusun', 'Desa/Kelurahan', 'Kecamatan', 'Kabupaten/Kota', 'Provinsi', 'No Handphone', 'Puskesmas', 'Postu/Posyandu Prima', 'Posyandu'],
        ];
    }

    // Map the data to the correct format for each row
    public function map($jadwal): array
    {
        return [
            ++$this->serialNumber,
            $jadwal->nama,
            "'" . $jadwal->kk, // Menambahkan tanda kutip tunggal untuk KK
            $jadwal->alamat,
            $jadwal->rt,
            $jadwal->rw,
            $jadwal->dusun,
            $jadwal->desa,
            $jadwal->kecamatan,
            $jadwal->kota,
            $jadwal->provinsi,
            $jadwal->no_hp,
            $jadwal->puskesmas,
            $jadwal->postu,
            $jadwal->posyandu
        ];
    }

    // Style the Excel export, making the first row bold with merged cells
    public function styles(Worksheet $sheet)
    {
        // Tentukan range berdasarkan jumlah baris data
        $totalRows = count($this->jadwals) + 1; // +1 untuk header

        // Apply center, middle align, and all borders to all cells with data
        $sheet->getStyle("A1:O{$totalRows}")->applyFromArray([
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

        // Apply the styles for bold font and background color for header row
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
            ]
        ];
    }
}
