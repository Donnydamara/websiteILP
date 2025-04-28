<?php

namespace App\Exports;

use App\Models\Kunjungan_Lansia;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KunjunganLansiaExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
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
                'NO', 'KK', 'NIK', 'Nama', 'Tanggal Lahir', 'Tempat Lahir',
                'Jenis Kelamin',  'Kunjungan',
                'Tanggal Kunjungan', 'Suhu Tubuh', 'Pemeriksaan Tekanan Darah',
                '', '',
                '', 'Terdiagnosa Tekanan Darah Tinggi/ Hipertensi',
                '', '',
                '', '', 'Pemeriksaan Kadar Gula Darah',
                '', '', '',
                'Terdiagnosa Kadar Gula Darah Tinggi/ Diabetes Melitus', '',
                '', '', '',
                'Skrining/ Pemeriksaan Geriatri', '',
                '', '', 'Perilaku Merokok', 'Melakukan Skrining Kesehatan Jiwa', '',
                '', 'Pemberian Edukasi/ Kunjungan Nakes'
            ],
            [
                '', '', '', '', '', '',
                '', '', '', '',
                'Pemeriksaan Dalam Satu Tahun Terakhir', '', '', 'Terdiagnosa Darah Tinggi/ Hipertensi', 'Pemeriksaan Dalam Satu Bulan Terakhir',
                '', '', 'Ada Obat Hipertensi', 'Sudah Minum Obat Hari Ini/ 24 Jam Terakhir',
                'Pemeriksaan Dalam Satu Tahun Terakhir',
                '', '', 'Terdiagnosa Kencing Manis/ Diabetes Melitus (DM)', 'Pemeriksaan Dalam Satu Bulan Terakhir', '', '', 'Ada Obat DM', 'Sudah Minum Obat Hari Ini/ 24 Jam',
                'Aktifitas Kehidupan Sehari Hari (AKS)', '',
                'Skrining Lansia Sederhana (SKILAS)', '', '', '', '',
                '', ''
            ],
            [
                '', '', '', '', ' ', ' ',
                ' ',  '',
                ' ', ' ', '  ',
                '', '',
                '', ' ',
                '', '',
                '', '', '   ',
                '', '', '',
                ' ', '',
                '', '', '',
                '', '',
                '', '', '', '', '',
                '', ''
            ],
            [
                '', '', '', '', '',
                '', '', '', '',
                '', 'Tanggal', 'Tempat', 'Hasil', 'Tanggal', 'Tanggal',
                'Tempat', 'Hasil', '', '', 'Tanggal',
                'Tempat', 'Hasil', 'Tanggal', 'Tempat', 'Tanggal',
                'Hasil', '', '', 'Tanggal', 'Tempat',
                'Tanggal', 'Tempat', 'Merokok', 'Tanggal', 'Tempat',
                'Petugas', ''
            ],
        ];
    }

    public function map($kunjunganLansia): array
    {
        return [
            ++$this->serialNumber,
            substr($kunjunganLansia->kk, 0, 0) . 'xxxxxxxxxxxxxxxx',
            "'" . $kunjunganLansia->nik,
            $kunjunganLansia->nama,
            $kunjunganLansia->tgl_lahir,
            $kunjunganLansia->tmp_lahir,
            $kunjunganLansia->gender,
            $kunjunganLansia->kunjungan,
            $kunjunganLansia->tgl_kunjungan,
            $kunjunganLansia->suhu_tubuh,
            $kunjunganLansia->tgl_periksa_satu_tahun_terakhir_ptd,
            $kunjunganLansia->tmp_periksa_satu_tahun_terakhir_ptd,
            $kunjunganLansia->hasil_periksa_satu_tahun_terakhir_ptd,
            $kunjunganLansia->tgl_diaknosa_darah_ptd,
            $kunjunganLansia->tgl_periksa_satu_tahun_terakhir_darah,
            $kunjunganLansia->tmp_periksa_satu_tahun_terakhir_darah,
            $kunjunganLansia->hasil_periksa_satu_tahun_terakhir_darah,
            $kunjunganLansia->obat_terakhir_darah,
            $kunjunganLansia->minum_obat_terakhir_darah,
            $kunjunganLansia->tgl_periksa_satu_tahun_gula_darah,
            $kunjunganLansia->tmp_periksa_satu_tahun_gula_darah,
            $kunjunganLansia->hasil_periksa_satu_tahun_gula_darah,
            $kunjunganLansia->tgl_kencing_manis_gula_darah,
            $kunjunganLansia->tgl_periksa_satu_tahun_gula_darah_melitus,
            $kunjunganLansia->tmp_periksa_satu_tahun_gula_darah_melitus,
            $kunjunganLansia->hasil_periksa_satu_tahun_gula_darah_melitus,
            $kunjunganLansia->obat_gula_darah_melitus,
            $kunjunganLansia->minum_obat_gula_darah_melitus,
            $kunjunganLansia->tgl_aks_skrining_geriatri,
            $kunjunganLansia->tmp_aks_skrining_geriatri,
            $kunjunganLansia->tgl_skilas_skrining_geriatri,
            $kunjunganLansia->tmp_skilas_skrining_geriatri,
            $kunjunganLansia->merokok,
            $kunjunganLansia->tgl_skrining,
            $kunjunganLansia->tmp_skrining,
            $kunjunganLansia->petugas_skrining,
            $kunjunganLansia->edukasi,
        ];
    }

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
        $sheet->mergeCells('K1:N1');
        $sheet->mergeCells('K2:M3');
        $sheet->mergeCells('N2:N3');
        $sheet->mergeCells('O1:S1');
        $sheet->mergeCells('O2:Q3');
        $sheet->mergeCells('R2:R4');
        $sheet->mergeCells('S2:S4');
        $sheet->mergeCells('T1:W1');
        $sheet->mergeCells('T2:V3');
        $sheet->mergeCells('W2:W3');
        $sheet->mergeCells('X1:AB1');
        $sheet->mergeCells('X2:Z3');
        $sheet->mergeCells('AA2:AA4');
        $sheet->mergeCells('AB2:AB4');
        $sheet->mergeCells('AC1:AF1');
        $sheet->mergeCells('AC2:AD3');
        $sheet->mergeCells('AE2:AF3');
        $sheet->mergeCells('AG1:AG4');
        $sheet->mergeCells('AH1:AJ3');
        $sheet->mergeCells('AK1:AK4');


        $totalRows = $this->data->count() + 4;

        $sheet->getStyle("A1:AK{$totalRows}")->applyFromArray([
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        $sheet->getStyle('A1:AK4')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '28a745'],
            ],
        ]);

        return [];
    }
}
