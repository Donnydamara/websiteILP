<?php

namespace App\Exports;

use App\Models\Kunjungan_Bayi_Balita_Prasekolah;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KunjunganBayiBalitaPrasekolahExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
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
                'No', 'KK', 'NIK', 'Nama', 'Tanggal Lahir', 'Tempat Lahir', 'Jenis Kelamin',
                'Kunjungan', 'Tanggal Kunjungan', 'Suhu Tubuh', 'Buku KIA', 'Tanggal Terakhir Ditimbang Dan Diukur', '',
                '', 'Hasil Penimbangan Dan Pengukuran', '', '',
                'Imunisasi', '', '',
                '', '', '', '',
                '', '', '', '',
                '', '', '', '',
                '', '', '', '',
                '', '', '', '',
                'Pemberian Makan Pendamping Asi Kaya Protein Hewani', '', '', '', '', 'Obat Cacing',
                '', 'Kapsu Vitamin A', '', '', 'Makan Tambahan Pangan Lokal',
                '', 'Edukasi', 'Tanda Bahaya Pada Bayi 2 - 60 Bulan', '', '',
                '', '', '', '', '',
                'Pengingat Periksa Postu', 'Lapor ke Nakes'
            ],
            [
                '', '', '', '', ' ', ' ', ' ',
                '', ' ', ' ', ' ', '', '',
                '', '', '', '', 'Usia 0 Bulan', '', '', 'Usia 1 Bulan', '', 'Usia 2 Bulan', '',
                '', '', 'Usia 3 Bulan', '',
                '', '', 'Usia 4 Bulan', '',
                '', '', 'Usia 9 Bulan', '', 'Usia 10 Bulan', 'Usia 12 Bulan', 'Usia 18 Bulan', '', 'Makanan Pokok( Beras/ ', 'Makanan Sumber Protein Hewani(Telur/Ikan/', 'Makanan Sumber Protein Nabati(Tahu/ Tempe',
                'Sumber Lemak', 'Buah Dan Sayur', 'Ada', 'Tanggal Minum', 'Jenis Vitamin', 'Tanggal', 'Tanggal',
                'Bagi Balita Dengan Masalah Gizi', '', '', '', '', '',
                '', '', '', '', '', '', ''
            ],
            [
                '', '', '', '', ' ', ' ', ' ',
                '', ' ', ' ', ' ', 'Tanggal', 'Tempat',
                'Petugas', 'Berat Badan', 'Panjang/Tinggi Badan', 'Lingkar Kepala',
                'Hepatitis B (0 Bulan)', 'BCG (0 Bulan)', 'Polio (0 Bulan)', 'BCG (1 Bulan)', 'Polio (1 Bulan)',
                'DPT-HB-Hib 1 (2 Bulan)', 'Polio 2 (2 Bulan)',
                'PCV 1 (2 Bulan)', 'RV 1 (2 Bulan)', 'DPT-HB-Hib 2 (3 Bulan)', 'Polio 3 (3 Bulan)',
                'PCV 2 (3 Bulan)', 'RV 2 (3 Bulan)', 'DPT-HB-Hib 3 (4 Bulan)', 'Polio 4 (4 Bulan)',
                'Polio Suntik (4 Bulan)', 'RV 3 (4 Bulan)', 'Campak/Rubella (9 Bulan)', 'Polio Suntik 2 (9 Bulan)', 'JE (10 Bulan)',
                'PCV 3 (12 Bulan)', 'DPT Lanjutan 1 (18 Bulan)', 'Campak Lanjutan (18 Bulan)', 'Kacang/ Jagung)', '/Ayam / Daging / Udang / Hati/ Susu Dan Produk Olahan)', '/Kacang Panjang/ Kacang Potong)',
                '(Minyak/ Santan', '', '', '', '', '', '', 'Ada', 'Kepatuhan Makan Tambahan', '', 'Napas', 'Batuk', 'Diare',
                'Jumlah/Warna Kencing', 'Warna Kulit', 'Aktivitas', 'Hisapan Bayi', 'Pemberian Makan', '', ''
            ],
        ];
    }

    public function map($data): array
    {
        return [
            ++$this->serialNumber,
            substr($data->kk, 0, 0) . 'xxxxxxxxxxxxxxxx',
            "'" . $data->nik, // NIK dengan tanda kutip tunggal
            $data->nama,
            $data->tgl_lahir,
            $data->tmp_lahir,
            $data->gender,
            $data->kunjungan,
            $data->tgl_kunjungan,
            $data->suhu_tubuh,
            $data->buku_kia,
            $data->tgl_timbang_ukur,
            $data->tempat_timbang_ukur,
            $data->petugas_timbang_ukur,
            $data->bb_hasil_timbang_ukur,
            $data->pb_tb_hasil_timbang_ukur,
            $data->lk_hasil_timbang_ukur,
            $data->hepatitis_b_0bulan,
            $data->bcg_0bulan,
            $data->polio_0bulan,
            $data->bcg_1bulan,
            $data->polio_1bulan,
            $data->dpt_hb_hib_1_2bulan,
            $data->polio_2_2bulan,
            $data->pcv_1_2bulan,
            $data->rv_1_2bulan,
            $data->dpt_hb_hib_2_3bulan,
            $data->polio_3_3bulan,
            $data->pcv_2_3bulan,
            $data->rv_2_3bulan,
            $data->dpt_hb_hib_3_4bulan,
            $data->polio_4_4bulan,
            $data->polio_suntik_4bulan,
            $data->rv_3_4bulan,
            $data->campak_rubelia_9bulan,
            $data->polio_suntik_2_9bulan,
            $data->je_10bulan,
            $data->pv_3_12bulan,
            $data->dpt_lanjut_1_18bulan,
            $data->campak_lanjut_18bulan,
            $data->makanan_pokok,
            $data->makanan_protein_hewan,
            $data->makanan_protein_nabati,
            $data->makanan_lemak,
            $data->sayur_buah,
            $data->oc_ada,
            $data->oc_tgl,
            $data->kv_jenis,
            $data->tgl_kv_mulai,
            $data->tgl_kv_selesai,
            $data->makan_tambah_ada,
            $data->makan_tambah_kepatuhan,
            $data->edukasi,

            $data->napas,
            $data->batuk,
            $data->diare,
            $data->jmh_warna_kencing,
            $data->warna_kulit,
            $data->aktifitas,
            $data->hisapan_bayi,
            $data->pemberian_makan,
            $data->pengingat_periksa_postu,
            $data->lapor_nakes,
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
        $sheet->mergeCells('K1:K3');
        $sheet->mergeCells('L1:N2');
        $sheet->mergeCells('O1:Q2');
        $sheet->mergeCells('R1:AN1');
        $sheet->mergeCells('R2:T2');
        $sheet->mergeCells('U2:V2');
        $sheet->mergeCells('U2:V2');
        $sheet->mergeCells('W2:Z2');
        $sheet->mergeCells('AA2:AD2');
        $sheet->mergeCells('AE2:AH2');
        $sheet->mergeCells('AI2:AJ2');
        $sheet->mergeCells('AM2:AN2');
        $sheet->mergeCells('AO1:AS1');
        $sheet->mergeCells('AT1:AU1');
        $sheet->mergeCells('AV1:AX1');
        $sheet->mergeCells('AY1:AZ2');
        $sheet->mergeCells('BB1:BI2');
        $sheet->mergeCells('BB1:BI2');
        $sheet->mergeCells('AS2:AS3');
        $sheet->mergeCells('AT2:AT3');
        $sheet->mergeCells('AU2:AU3');
        $sheet->mergeCells('AV2:AV3');
        $sheet->mergeCells('AW2:AW3');
        $sheet->mergeCells('AX2:AX3');
        $sheet->mergeCells('BA1:BA3');
        $sheet->mergeCells('BJ1:BJ3');
        $sheet->mergeCells('BK1:BK3');


        $totalRows = $this->data->count() + 3; // +1 for headers

        $sheet->getStyle("A1:BK{$totalRows}")->applyFromArray([
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
