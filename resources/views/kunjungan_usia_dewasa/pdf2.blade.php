<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>8. Checklist Kunjungan Rumah - Usia Dewasa</title>
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
    <h3>8. Checklist Kunjungan Rumah - Usia Dewasa</h3>
    <table>
        <tbody aria-colspan="6">
            <tr>
                <th colspan="3">Nama</th>
                <td colspan="15">{{ $kunjunganusiadewasa->nama }}</td>
            </tr>
            <tr>
                <th colspan="3">Tempat / Tanggal Lahir</th>
                <td colspan="15">{{ $kunjunganusiadewasa->tmp_lahir }} / {{ $kunjunganusiadewasa->tgl_lahir }}</td>
            </tr>
            <tr>
                <th colspan="3">Jenis Kelamin</th>
                <td colspan="15">{{ $kunjunganusiadewasa->gender }}</td>
            </tr>
            <tr>
                <th colspan="3">Riwayat Penyakit Keluarga</th>
                <td colspan="15">{{ $kunjunganusiadewasa->riwayat_penyakit }}</td>
            </tr>
            <tr>
                <th scope="row" colspan="1" rowspan="2">Kunjungan</th>
                <th scope="row" colspan="1" rowspan="2">Tanggal</th>
                <th scope="row" colspan="1" rowspan="2">Pemantauan Suhu Tubuh</th>
                <th scope="row" colspan="1" rowspan="2">Isi Piringku Usia Produktif</th>
                <th scope="row" colspan="2" rowspan="1">Pemeriksaan Tekanan Darah</th>
                <th scope="row" colspan="3" rowspan="1">Terdiagnosa Tekanan Darah Tinggi / Hipertensi</th>
                <th scope="row" colspan="2" rowspan="1">Pemeriksaan Kadar Gula Darah</th>
                <th scope="row" colspan="3" rowspan="1">Terdiagnosa Gula Darah Tinggi / Diabetes Melitus</th>
                <th scope="row" colspan="1" rowspan="2">Perilaku Merokok</th>
                <th scope="row" colspan="1" rowspan="2">Jenis Kontrasepsi</th>
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
            </tr>
            <tr>
                <td rowspan="3">{{ $kunjunganusiadewasa->kunjungan }}</td>
                <td rowspan="3">{{ $kunjunganusiadewasa->tgl_kunjungan }}</td>
                <td rowspan="3">{{ $kunjunganusiadewasa->suhu_tubuh }}</td>
                <td rowspan="3">{{ $kunjunganusiadewasa->porsi }}</td>
                <td rowspan="1" colspan="1">Tanggal
                    <br>{{ $kunjunganusiadewasa->tgl_periksa_satu_tahun_terakhir_ptd }}
                </td>
                <td rowspan="3" colspan="1">Tanggal <br>{{ $kunjunganusiadewasa->tgl_diaknosa_darah_ptd }}</td>
                <td rowspan="1" colspan="1">
                    Tanggal<br>{{ $kunjunganusiadewasa->tgl_periksa_satu_tahun_terakhir_darah }}</td>
                <td rowspan="3" colspan="1">{{ $kunjunganusiadewasa->obat_terakhir_darah }}</td>
                <td rowspan="3" colspan="1">{{ $kunjunganusiadewasa->minum_obat_terakhir_darah }}</td>
                <td rowspan="1" colspan="1">
                    Tanggal<br>{{ $kunjunganusiadewasa->tgl_periksa_satu_tahun_gula_darah }}</td>
                <td rowspan="3" colspan="1">Tanggal <br> {{ $kunjunganusiadewasa->tgl_kencing_manis_gula_darah }}
                </td>
                <td rowspan="1" colspan="1">
                    Tanggal<br>{{ $kunjunganusiadewasa->tgl_periksa_satu_tahun_gula_darah_melitus }}</td>
                <td rowspan="3" colspan="1">{{ $kunjunganusiadewasa->obat_gula_darah_melitus }}</td>
                <td rowspan="3" colspan="1">{{ $kunjunganusiadewasa->minum_obat_gula_darah_melitus }}</td>
                <td rowspan="1" colspan="1" rowspan="3">{{ $kunjunganusiadewasa->merokok }}</td>
                <td rowspan="1" colspan="1" rowspan="3">{{ $kunjunganusiadewasa->jenis_kontrasepsi }}</td>
                <td rowspan="1" colspan="1">Tanggal {{ $kunjunganusiadewasa->tgl_skrining }}<br></td>
                <td rowspan="3" colspan="1">{{ $kunjunganusiadewasa->edukasi }}</td>
            </tr>
            <tr>
                <td scope="row" colspan="1" rowspan="1">Tempat
                    <br>{{ $kunjunganusiadewasa->tmp_periksa_satu_tahun_terakhir_ptd }}
                </td>
                <td scope="row" colspan="1" rowspan="1">Tempat
                    <br>{{ $kunjunganusiadewasa->tmp_periksa_satu_tahun_terakhir_darah }}
                </td>
                <td scope="row" colspan="1" rowspan="1">
                    Tempat<br>{{ $kunjunganusiadewasa->tmp_periksa_satu_tahun_gula_darah }}</td>
                <td scope="row" colspan="1" rowspan="1">Tempat
                    <br>{{ $kunjunganusiadewasa->tmp_periksa_satu_tahun_gula_darah_melitus }}
                </td>
                <td scope="row" colspan="1" rowspan="1">Tempat <br>{{ $kunjunganusiadewasa->tmp_skrining }}
                </td>
            </tr>
            <tr>
                <td scope="row" colspan="1" rowspan="1">Hasil
                    <br>{{ $kunjunganusiadewasa->hasil_periksa_satu_tahun_terakhir_ptd }}
                </td>
                <td scope="row" colspan="1" rowspan="1">Hasil
                    <br>{{ $kunjunganusiadewasa->hasil_periksa_satu_tahun_terakhir_darah }}
                </td>
                <td scope="row" colspan="1" rowspan="1">Hasil
                    <br>{{ $kunjunganusiadewasa->hasil_periksa_satu_tahun_gula_darah }}
                </td>
                <td scope="row" colspan="1" rowspan="1">Hasil
                    <br>{{ $kunjunganusiadewasa->hasil_periksa_satu_tahun_gula_darah_melitus }}
                </td>
                <td scope="row" colspan="1" rowspan="1">Petugas
                    <br>{{ $kunjunganusiadewasa->petugas_skrining }}
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
