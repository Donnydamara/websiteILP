<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>9. Checklist Kunjungan Rumah - Pengendalian Penyakit Menular (TBC)</title>
    <style>
        table {
            width: 100%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px 12px;
            text-align: center;
            border: 1px solid #ccc;
            font-size: 50%
        }

        th {
            background-color: #f2f2f2;
        }

        h3 {
            text-align: center;
        }

        /* Media query untuk menyesuaikan ukuran teks */
    </style>
</head>

<body>
    <h3>9. Checklist Kunjungan Rumah - Pengendalian Penyakit Menular (TBC)</h3>
    <table>

        <tbody aria-colspan="17">
            @if ($kunjungantbc->isNotEmpty())
                <tr>
                    <th colspan="3">Nama</th>
                    <td colspan="15">{{ $kunjungantbc[0]->nama }}</td>
                </tr>
                <tr>
                    <th colspan="3">Tempat / Tanggal Lahir</th>
                    <td colspan="15">{{ $kunjungantbc[0]->tmp_lahir }} / {{ $kunjungantbc[0]->tgl_lahir }}</td>
                </tr>
                <tr>
                    <th colspan="3">Jenis Kelamin</th>
                    <td colspan="15">{{ $kunjungantbc[0]->gender }}</td>
                </tr>
            @endif

            <tr>
                <th scope="row" colspan="1" rowspan="2">Kunjungan</th>
                <th scope="row" colspan="1" rowspan="2">Tanggal</th>
                <th scope="row" colspan="5" rowspan="1">Skrining</th>
                <th scope="row" colspan="2" rowspan="2">Terdiagnosa TBC</th>
                <th scope="row" colspan="2" rowspan="2">Pemeriksaan Terakhir</th>
                <th scope="row" colspan="2" rowspan="1">Obat TBC</th>
                <th scope="row" colspan="1" rowspan="2">Pengawas Minum Obat (PMO)</th>
                <th scope="row" colspan="1" rowspan="2">Perilaku Merokok</th>
                <th scope="row" colspan="1" rowspan="2">Pemberian Edukasi / Kunjungan Nakes</th>
                <th scope="row" colspan="1" rowspan="2">Mengingatkan Periksa Ke Postu / Fayankes</th>
                <th scope="row" colspan="1" rowspan="2">Melaporkan Ke Nakes</th>
            </tr>
            <tr>
                <th>Batuk Terus Menerus</th>
                <th>Demam Lebih Dari > 2 Minggu</th>
                <th>BB Tidak Naik Atau Turun Dalam 2 Bulan Berturut - Terut</th>
                <th colspan="2">Kontak Erat Dengan Pasien TBC</th>
                <th>Ada Obat</th>
                <th>Sudah Minum Obat Hari Ini / 24 Jam Terakhir</th>
            </tr>
            @foreach ($kunjungantbc as $kunjungan)
                <tr>
                    <td rowspan="3">{{ $kunjungan->kunjungan }}</td>
                    <td rowspan="3">{{ $kunjungan->tgl_kunjungan }}</td>
                    <td rowspan="3">{{ $kunjungan->batuk_skrining }}</td>
                    <td rowspan="3">{{ $kunjungan->demam_skrining }}</td>
                    <td rowspan="3">{{ $kunjungan->bb_skrining }}</td>
                    <td scope="row" colspan="1" rowspan="1">Keluarga</td>
                    <td rowspan="1">{{ $kunjungan->kontak_erat_keluarga }}</td>
                    <td scope="row" colspan="1" rowspan="1">Tanggal</td>
                    <td rowspan="1">{{ $kunjungan->tgl_diaknosa }}</td>
                    <td scope="row" colspan="1" rowspan="1">Tanggal</td>
                    <td rowspan="1">{{ $kunjungan->tgl_periksa_terakhir }}</td>
                    <td rowspan="3">{{ $kunjungan->obat_tbc }}</td>
                    <td rowspan="3">{{ $kunjungan->minum_obat_tbc }}</td>
                    <td rowspan="3">{{ $kunjungan->nama_pmo }}</td>
                    <td rowspan="3">{{ $kunjungan->merokok }}</td>
                    <td rowspan="3">{{ $kunjungan->edukasi }}</td>
                    <td rowspan="3">{{ $kunjungan->periksa_postu_fasyankes }}</td>
                    <td rowspan="3">{{ $kunjungan->tgl_lapor }}</td>

                </tr>
                <tr>
                    <td scope="row" colspan="1" rowspan="1">Tetangga</td>
                    <td rowspan="1">{{ $kunjungan->kontak_erat_tetangga }}</td>
                    <td scope="row" colspan="1" rowspan="1">Tempat</td>
                    <td rowspan="1">{{ $kunjungan->tmp_diaknosa }}</td>
                    <td scope="row" colspan="1" rowspan="1">Tempat</td>
                    <td rowspan="1">{{ $kunjungan->tmp_periksa_terakhir }}</td>
                </tr>
                <tr>
                    <td scope="row" colspan="1" rowspan="1">ART</td>
                    <td rowspan="1">{{ $kunjungan->kontak_erat_art }}</td>
                    <td scope="row" colspan="2" rowspan="1"></td>
                    <td scope="row" colspan="2" rowspan="1"></td>

                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
