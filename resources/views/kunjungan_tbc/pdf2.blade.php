</html>
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

            <tr>
                <th colspan="3">Nama</th>
                <td colspan="15">{{ $kunjungantbc->nama }}</td>
            </tr>
            <tr>
                <th colspan="3">Tempat / Tanggal Lahir</th>
                <td colspan="15">{{ $kunjungantbc->tmp_lahir }} / {{ $kunjungantbc->tgl_lahir }}</td>
            </tr>
            <tr>
                <th colspan="3">Jenis Kelamin</th>
                <td colspan="15">{{ $kunjungantbc->gender }}</td>
            </tr>


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

            <tr>
                <td rowspan="3">{{ $kunjungantbc->kunjungan }}</td>
                <td rowspan="3">{{ $kunjungantbc->tgl_kunjungan }}</td>
                <td rowspan="3">{{ $kunjungantbc->batuk_skrining }}</td>
                <td rowspan="3">{{ $kunjungantbc->demam_skrining }}</td>
                <td rowspan="3">{{ $kunjungantbc->bb_skrining }}</td>
                <td scope="row" colspan="1" rowspan="1">Keluarga</td>
                <td rowspan="1">{{ $kunjungantbc->kontak_erat_keluarga }}</td>
                <td scope="row" colspan="1" rowspan="1">Tanggal</td>
                <td rowspan="1">{{ $kunjungantbc->tgl_diaknosa }}</td>
                <td scope="row" colspan="1" rowspan="1">Tanggal</td>
                <td rowspan="1">{{ $kunjungantbc->tgl_periksa_terakhir }}</td>
                <td rowspan="3">{{ $kunjungantbc->obat_tbc }}</td>
                <td rowspan="3">{{ $kunjungantbc->minum_obat_tbc }}</td>
                <td rowspan="3">{{ $kunjungantbc->nama_pmo }}</td>
                <td rowspan="3">{{ $kunjungantbc->merokok }}</td>
                <td rowspan="3">{{ $kunjungantbc->edukasi }}</td>
                <td rowspan="3">{{ $kunjungantbc->periksa_postu_fasyankes }}</td>
                <td rowspan="3">{{ $kunjungantbc->tgl_lapor }}</td>

            </tr>
            <tr>
                <td scope="row" colspan="1" rowspan="1">Tetangga</td>
                <td rowspan="1">{{ $kunjungantbc->kontak_erat_tetangga }}</td>
                <td scope="row" colspan="1" rowspan="1">Tempat</td>
                <td rowspan="1">{{ $kunjungantbc->tmp_diaknosa }}</td>
                <td scope="row" colspan="1" rowspan="1">Tempat</td>
                <td rowspan="1">{{ $kunjungantbc->tmp_periksa_terakhir }}</td>
            </tr>
            <tr>
                <td scope="row" colspan="1" rowspan="1">ART</td>
                <td rowspan="1">{{ $kunjungantbc->kontak_erat_art }}</td>
                <td scope="row" colspan="2" rowspan="1"></td>
                <td scope="row" colspan="2" rowspan="1"></td>

            </tr>

        </tbody>
    </table>
</body>

</html>
