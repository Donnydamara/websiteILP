<?php

namespace App\Exports;

use App\Models\DataKK;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromCollection;

class DataKKExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $dataKKs;
    protected $serialNumber = 0;

    /**
     * Constructor to initialize the data for export.
     *
     * @param \Illuminate\Support\Collection $dataKKs
     */
    public function __construct($dataKKs)
    {
        $this->dataKKs = $dataKKs;
    }

    /**
     * Return the collection of data that should be exported.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->dataKKs; // Return the provided data instead of all DataKK records
    }

    /**
     * Define the headings for the Excel export.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            ['No', 'No Kartu Keluarga', 'Nama', 'NIK', 'Gender', 'Hubungan Keluarga', 'Status Perkawinan', 'Pendidikan Terakhir', 'Pekerjaan', 'Kelompok Sasaran'],
        ];
    }

    /**
     * Map the data to the correct format for each row.
     *
     * @param DataKK $member
     * @return array
     */
    public function map($member): array
    {
        return [
            ++$this->serialNumber,
            "'" . $member->kk, // Add single quote for KK
            $member->nama,
            "'" . $member->nik, // Add single quote for NIK
            $member->gender,
            $member->hubungan_keluarga,
            $member->status_perkawinan,
            $member->pendidikan_terakhir,
            $member->pekerjaan,
            $member->kelompok_sasaran
        ];
    }

    /**
     * Style the Excel export, making the first row bold and applying borders.
     *
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        // Define the range based on the number of data rows
        $totalRows = count($this->dataKKs) + 1; // +1 for header

        // Apply styles for the header row
        $sheet->getStyle("A1:J1")->applyFromArray([
            'font' => ['bold' => true],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '28a745'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        // Apply center alignment and borders to all cells with data
        $sheet->getStyle("A2:J{$totalRows}")->applyFromArray([
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
    }
}
