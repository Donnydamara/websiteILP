<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromCollection;

class KunjunganTBCExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $kunjunganTBCs;
    protected $serialNumber = 0;

    public function __construct($kunjunganTBCs)
    {
        $this->kunjunganTBCs = $kunjunganTBCs;
    }

    /**
     * Return the data that should be exported.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->kunjunganTBCs;
    }

    // Define the headings for the Excel export with two rows
    public function headings(): array
    {
        return [
            ['No', 'Status Kunjungan TBC', 'No Kartu Keluarga', 'NIK', 'Nama', 'Tanggal Lahir', 'Tempat Lahir', 'Jenis Kelamin', 'Tanggal Kunjungan', 'Kunjungan', 'Skrining TBC', 'Skrining TBC', 'Skrining TBC', 'Skrining TBC', 'Skrining TBC', 'Skrining TBC', 'Terdiagnosa TBC', 'Terdiagnosa TBC', 'Pemeriksaan Terakhir', 'Pemeriksaan Terakhir', 'Obat TBC', 'Obat TBC', 'Pengawas Minum Obat (PMO)', 'Perilaku Merokok', 'Pemberi Edukasi Kunjungan Nakes', 'Mengingatkan Periksa Ke Postu / Fayankes', 'Melaporkan ke Nakes'],

            ['', '', '', '', '', '', '', '', '', '', 'Batuk Terus Menerus', 'Demam Lebih Dari 2 Minggu', 'BB Tidak Naik Atau Turun Dalam 2 Bulan Berturut-Turut', 'Kontak Erat Keluarga', 'Kontak Erat Tetangga', 'Kontak Erat ART', 'Tanggal Terdiagnosa TBC', 'Tempat Terdiagnosa TBC', 'Tanggal Periksa Terakhir', 'Tempat Periksa Terakhir', 'Obat TBC', 'Sudah Minum Obat Hari Ini/24 Jam Terakhir', '', '', '', '', '']
        ];
    }

    // Map the data to the correct format for each row
    public function map($member): array
    {
        return [
            ++$this->serialNumber,
            $member->status,
            substr($member->kk, 0, 0) . 'xxxxxxxxxxxxxxxx',  // Menambahkan tanda kutip tunggal untuk KK
            "'" . $member->nik, // Menambahkan tanda kutip tunggal untuk NIK
            $member->nama,
            $member->tgl_lahir,
            $member->tmp_lahir,
            $member->gender,
            $member->tgl_kunjungan,
            $member->kunjungan,
            $member->batuk_skrining,
            $member->demam_skrining,
            $member->bb_skrining,
            $member->kontak_erat_keluarga,
            $member->kontak_erat_tetangga,
            $member->kontak_erat_art,
            $member->tgl_diaknosa,
            $member->tmp_diaknosa,
            $member->tgl_periksa_terakhir,
            $member->tmp_periksa_terakhir,
            $member->obat_tbc,
            $member->minum_obat_tbc,
            $member->nama_pmo,
            $member->merokok,
            $member->edukasi,
            $member->periksa_postu_fasyankes,
            $member->tgl_lapor,
        ];
    }

    // Style the Excel export, making the first row bold with merged cells
    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('AA1:AA2');
        $sheet->mergeCells('Z1:Z2');
        $sheet->mergeCells('Y1:Y2');
        $sheet->mergeCells('X1:X2');
        $sheet->mergeCells('W1:W2');
        $sheet->mergeCells('J1:J2');
        $sheet->mergeCells('I1:I2');
        $sheet->mergeCells('H1:H2');
        $sheet->mergeCells('G1:G2');
        $sheet->mergeCells('F1:F2');
        $sheet->mergeCells('E1:E2');
        $sheet->mergeCells('D1:D2');
        $sheet->mergeCells('C1:C2');
        $sheet->mergeCells('B1:B2');
        $sheet->mergeCells('A1:A2');
        $sheet->mergeCells('K1:P1');
        $sheet->mergeCells('Q1:R1');
        $sheet->mergeCells('S1:T1');
        $sheet->mergeCells('U1:V1');

        // Tentukan range berdasarkan jumlah baris data
        $totalRows = count($this->kunjunganTBCs) + 2; // +2 untuk header baris pertama dan kedua

        // Apply center, middle align, and all borders to all cells with data
        $sheet->getStyle("A1:AA{$totalRows}")->applyFromArray([
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
        ];
    }
}
