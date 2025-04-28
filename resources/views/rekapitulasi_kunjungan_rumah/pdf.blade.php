<!DOCTYPE html>
<html>

<head>
    <title>Export PDF</title>
    <style>
        table {
            width: 100%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        th {
            background-color: #f2f2f2;
        }

        h3 {
            text-align: center;
            margin-top: 20px;
            font-size: 24px;
        }

        .page-break {
            page-break-before: always;
        }
    </style>
</head>

<body>
    <h1>Rekapitulasi Kunjungan Rumah</h1>
    <table>
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Jumlah Keluarga Yang Kunjungan</th>
                <th colspan="6">Jumlah Sasaran Yang Dikunjungi</th>
                <th colspan="2">Jumlah Ibu Hamil, Ibu Bersalin-Nifas, Balita & Apras Dengan Masalah Yang Ditentukan
                </th>
                <th colspan="3">Jumlah Usia Sekolah, Remaja, Usia Produktif Dan Lansia Dengan Masalah Yang Ditentukan
                </th>
                <th colspan="2">Jumlah Sasaran Dengan Tindak Lanjut Yang Dilakukan</th>
            </tr>
            <tr>
                <th>Ibu Hamil</th>
                <th>Ibu Bersalin-Nifas</th>
                <th>Bayi, Balita & Apras</th>
                <th>Usia Sekolah & Remaja</th>
                <th>Usia Produktif</th>
                <th>Usia Lansia</th>
                <th>Tidak Akses Pelayanan</th>
                <th>Tanda Bahaya</th>
                <th>Tidak Akses Pelayanan</th>
                <th>Bergejala TBC</th>
                <th>Tidak Minum Obat teratur (TBC / Hipertensi / DM)</th>
                <th>Edukasi</th>
                <th>Lapor Nakes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataPerWeek as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $data['total_families_visited'] }}</td>
                    <td>{{ $data['ibu_hamil_count'] }}</td>
                    <td>{{ $data['ibu_bersalin_nifas_count'] }}</td>
                    <td>{{ $data['kunjungan_bayi_balita_prasekolah_count'] }}</td>
                    <td>{{ $data['kunjungan_usia_sekolah_count'] }}</td>
                    <td>{{ $data['kunjungan_usia_dewasa_count'] }}</td>
                    <td>{{ $data['kunjungan_lansia_count'] }}</td>
                    <td>{{ $data['tidak_status_count'] }}</td>
                    <td>{{ $data['tanda_bahaya_count'] }}</td>
                    <td>{{ $data['tidak_status_count2'] }}</td>
                    <td>{{ $data['TBC_count'] }}</td>
                    <td>{{ $data['minum_TBC_count'] }}</td>
                    <td>{{ $data['edukasi_count'] }}</td>
                    <td>{{ $data['lapor_Nakes_count'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
