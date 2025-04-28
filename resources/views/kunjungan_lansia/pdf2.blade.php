<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>8. Checklist Kunjungan Rumah - Lansia</title>
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
            font-size: 45%
        }

        th {
            background-color: #f2f2f2;
        }

        h3 {
            text-align: center;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body>
    <h3>8. Checklist Kunjungan Rumah - Lansia</h3>
    <table>
        <tbody aria-colspan="6">
            <tr>
                <th colspan="3">Nama</th>
                <td colspan="15">{{ $kunjunganlansia->nama }}</td>
            </tr>
            <tr>
                <th colspan="3">Tempat / Tanggal Lahir</th>
                <td colspan="15">{{ $kunjunganlansia->tmp_lahir }} / {{ $kunjunganlansia->tgl_lahir }}</td>
            </tr>
            <tr>
                <th colspan="3">Jenis Kelamin</th>
                <td colspan="15">{{ $kunjunganlansia->gender }}</td>
            </tr>
            <tr>
                <th scope="row" colspan="1" rowspan="2">Kunjungan</th>
                <th scope="row" colspan="1" rowspan="2">Tanggal</th>
                <th scope="row" colspan="1" rowspan="2">Pemantauan Suhu</th>
                <th scope="row" colspan="2" rowspan="1">Pemeriksaan Tekanan Darah</th>
                <th scope="row" colspan="3" rowspan="1">Terdiagnosa Tekanan Darah Tinggi / Hipertensi</th>
                <th scope="row" colspan="2" rowspan="1">Pemeriksaan Kadar Gula Darah</th>
                <th scope="row" colspan="3" rowspan="1">Terdiagnosa Gula Darah Tinggi / Diabetes Melitus</th>
                <th scope="row" colspan="2" rowspan="1">Skrining / Pemeriksaan Geriatri
                <th scope="row" colspan="1" rowspan="2">Perilaku Merokok</th>
                <th scope="row" colspan="1" rowspan="2">Melakukan Skrining Kesehatan Jiwa</th>
                <th scope="row" colspan="1" rowspan="2">Edukasi</th>

            </tr>
            <tr>
                <th colspan="1">Pemeriksaan Dalam Satu Tahun Terakhir</th>
                <th colspan="1">Terdiagnosa Darat Tinggi / Hipertensi</th>
                <th colspan="1">Pemeriksaan Dalam Satu Bulan Terakhir</th>
                <th colspan="1">Ada Obat Hipertensi</th>
                <th colspan="1">Sudah Minum Obat Hari Ini / 24 Jam Terakhir</th>
                <th colspan="1">Pemeriksaan Dalam Satu Bulan Terakhir</th>
                <th colspan="1">Terdiagnosa Kencing Manis / Diabetes Melitus (DM)</th>
                <th colspan="1">Pemeriksaan Dalam Satu Bulan Terakhir</th>
                <th colspan="1">Ada Obat Diabetes Melitus</th>
                <th colspan="1">Sudah Minum Obat Hari Ini / 25 Jam Terakhir</th>
                <th colspan="1">Aktifitas Kehidupan Sehari Hari (AKS)</th>
                <th colspan="1">Skrining Lansia Sederhana (SKILAS)</th>

            </tr>
            <tr>
                <td rowspan="3">{{ $kunjunganlansia->kunjungan }}</td>
                <td rowspan="3">{{ $kunjunganlansia->tgl_kunjungan }}</td>
                <td rowspan="3">{{ $kunjunganlansia->suhu_tubuh }}</td>
                <td rowspan="1" colspan="1">Tanggal <br>
                    {{ $kunjunganlansia->tgl_periksa_satu_tahun_terakhir_ptd }}
                </td>
                <td rowspan="3" colspan="1">Tanggal <br>{{ $kunjunganlansia->tgl_diaknosa_darah_ptd }} </td>
                <td rowspan="1" colspan="1">Tanggal
                    {{ $kunjunganlansia->tgl_periksa_satu_tahun_terakhir_darah }}<br>
                </td>
                <td rowspan="3" colspan="1">{{ $kunjunganlansia->obat_terakhir_darah }}</td>
                <td rowspan="3" colspan="1">{{ $kunjunganlansia->minum_obat_terakhir_darah }}</td>
                <td rowspan="1" colspan="1">Tanggal <br>{{ $kunjunganlansia->tgl_periksa_satu_tahun_gula_darah }}
                </td>
                <td rowspan="3" colspan="1">Tanggal <br> {{ $kunjunganlansia->tgl_kencing_manis_gula_darah }}
                </td>
                <td rowspan="1" colspan="1">Tanggal
                    <br>{{ $kunjunganlansia->tgl_periksa_satu_tahun_gula_darah_melitus }}
                </td>
                <td rowspan="3" colspan="1">{{ $kunjunganlansia->obat_gula_darah_melitus }}</td>
                <td rowspan="3" colspan="1">{{ $kunjunganlansia->minum_obat_gula_darah_melitus }}</td>
                <td rowspan="1" colspan="1">Tanggal <br>{{ $kunjunganlansia->tgl_aks_skrining_geriatri }}</td>
                <td rowspan="1" colspan="1">Tanggal <br>{{ $kunjunganlansia->tgl_skilas_skrining_geriatri }}
                </td>
                <td rowspan="1" colspan="1" rowspan="3">{{ $kunjunganlansia->merokok }}</td>
                <td rowspan="1" colspan="1">Tanggal {{ $kunjunganlansia->tgl_skrining }}<br></td>
                <td rowspan="3" colspan="1">{{ $kunjunganlansia->edukasi }}</td>
            </tr>
            <tr>
                <td scope="row" colspan="1" rowspan="1">Tempat <br>
                    {{ $kunjunganlansia->tmp_periksa_satu_tahun_terakhir_ptd }}</td>
                </td>
                <td scope="row" colspan="1" rowspan="1">Tempat <br>
                    {{ $kunjunganlansia->tmp_periksa_satu_tahun_terakhir_darah }}</td>
                <td scope="row" colspan="1" rowspan="1">Tempat
                    {{ $kunjunganlansia->tmp_periksa_satu_tahun_gula_darah }}<br></td>
                <td scope="row" colspan="1" rowspan="1">Tempat <br>
                    {{ $kunjunganlansia->tmp_periksa_satu_tahun_gula_darah_melitus }}</td>
                <td scope="row" colspan="1" rowspan="1">Tempat <br>
                    {{ $kunjunganlansia->tmp_aks_skrining_geriatri }}</td>
                <td scope="row" colspan="1" rowspan="1">Tempat <br>
                    {{ $kunjunganlansia->tmp_skilas_skrining_geriatri }}</td>
                <td scope="row" colspan="1" rowspan="1">Tempat <br> {{ $kunjunganlansia->tmp_skrining }}
                </td>

            </tr>
            <tr>
                <td scope="row" colspan="1" rowspan="1">Hasil <br>
                    {{ $kunjunganlansia->hasil_periksa_satu_tahun_terakhir_ptd }}</td>
                <td scope="row" colspan="1" rowspan="1">Hasil <br>
                    {{ $kunjunganlansia->hasil_periksa_satu_tahun_terakhir_darah }}</td>
                <td scope="row" colspan="1" rowspan="1">Hasil <br>
                    {{ $kunjunganlansia->hasil_periksa_satu_tahun_gula_darah }}</td>
                <td scope="row" colspan="1" rowspan="1">Hasil <br>
                    {{ $kunjunganlansia->hasil_periksa_satu_tahun_gula_darah_melitus }}</td>
                <td scope="row" colspan="2" rowspan="1"></td>
                <td scope="row" colspan="1" rowspan="1">Petugas <br>
                    {{ $kunjunganlansia->petugas_skrining }}
                </td>

            </tr>
        </tbody>
    </table>
</body>

</html>
