<?php

namespace App\Exports;

use App\Models\Lingkungan_Rumah;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class LingkunganRumahExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $serialNumber = 0;

    /**
     * Return the data that should be exported.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Lingkungan_Rumah::all();
    }

    // Define the headings for the Excel export
    public function headings(): array
    {
        return [
            ['No', 'Kartu Keluarga', 'Kepala Keluarga', 'Anggota Keluarga Total ', 'Jumlah Anggota Keluarga Lansia (>60Tahun)', 'Jumlah Anggota Keluarga Usia Dewasa(>18 - 59 Tahun)', 'Jumlah Anggota Keluarga Usia Sekolah Dan Remaja (>6 - 18 Tahun)', 'Jumlah Anggota Keluarga Anggota Balita (6 - 71 Bulan)', 'Jumlah Anggota Keluarga Anggota Balita (6 - 71 Bulan)', 'Jumlah Anggota Keluarga Ibu Bersalin Dan Nifas', 'Anggota Keluarga Ibu Hamil ', 'Memiliki Jaminan JKN dan Jamkesda/ Ansuransi Kesehatan', 'Tersedia Serapan Air', 'Jenis Sumber Air', 'Tersedia Jamban', 'Jenis Jamban', 'Apalah Venstilasi Cukup ', 'Anggota Keluarga Mengalami Gangguan Jiwa', 'Anggota Keluarga Terdiaknosa (TBC, Hipertensi dan Diabetes Mellitus) '],

        ];
    }

    // Map the data to the correct format for each row
    public function map($lingkunganRumah): array
    {
        return [
            ++$this->serialNumber,
            substr($lingkunganRumah->kk, 0, 0) . 'xxxxxxxxxxxxxxxx',

            $lingkunganRumah->nama,
            $lingkunganRumah->AK_lansia,
            $lingkunganRumah->jumlah_AK_dewasa,
            $lingkunganRumah->AK_remaja,
            $lingkunganRumah->AK_balita,
            $lingkunganRumah->AK_bayi,
            $lingkunganRumah->AK_ibu_bersalin_nifas,
            $lingkunganRumah->AK_ibu_hamil,
            $lingkunganRumah->jkn_jamkesda,
            $lingkunganRumah->sarana_air,
            $lingkunganRumah->jenis_sumber_air,
            $lingkunganRumah->jamban,
            $lingkunganRumah->jenis_jamban,
            $lingkunganRumah->ventilasi,
            $lingkunganRumah->mengalami_gangguan_jiwa,
            $lingkunganRumah->TBC_hipertensi_millitus,
            $lingkunganRumah->TBC_hipertensi_millitus,
        ];
    }

    // Style the Excel export
    public function styles(Worksheet $sheet)
    {
        // Apply center, middle align, and borders to all cells
        $totalRows = count($this->collection()) + 1; // +1 for headers

        $sheet->getStyle("A1:S{$totalRows}")->applyFromArray([
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

        // Bold and background color for header rows
        return [
            1 => [
                'font' => ['bold' => true],
                'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'startColor' => ['rgb' => '28a745']],
            ],
            2 => [
                'font' => ['bold' => true],
            ],
            // Add more styles for other header rows if necessary
        ];
    }
}
