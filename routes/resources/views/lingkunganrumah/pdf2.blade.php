<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1. Data Keluarga Dan Anggota Keluarga</title>
    <style>
        table {
            width: 100%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 5px 5px;
            text-align: center;
            border: 1px solid #ccc;
            font-size: 80%
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
    <h3>1. Data Keluarga Dan Anggota Keluarga</h3>
    <table>
        <tbody aria-colspan="6">
            <tr>
                <th>Nama Kepala Keluarga</th>
                <td colspan="2">{{ $lingkunganRumah->nama }}</td>
            </tr>
            <tr>
                <th rowspan="8">Data Anggota Keluarga (Total)</th>
                <td>{{ $lingkunganRumah->AK_total }}</td>
                <th>Anggota Keluarga Total</th>

            </tr>
            <tr>
                <td>{{ $lingkunganRumah->AK_lansia }}</td>
                <th>Jumlah Anggota Keluarga Lansia (>60 Tahun)</th>
            </tr>
            <tr>
                <td>{{ $lingkunganRumah->jumlah_AK_dewasa }}</td>
                <th>Jumlah Anggota Keluarga Usia Dewasa (>18 - 59 Tahun)</th>
            </tr>
            <tr>
                <td>{{ $lingkunganRumah->AK_remaja }}</td>
                <th>Jumlah Anggota Keluarga Usia Sekolah Dan Remaja (>6 - 18 Tahun)</th>
            </tr>
            <tr>
                <td>{{ $lingkunganRumah->AK_balita }}</td>
                <th>Jumlah Anggota Keluarga Anggota Balita (6 - 71 Bulan)</th>
            </tr>
            <tr>
                <td>{{ $lingkunganRumah->AK_bayi }}</td>
                <th>Jumlah Anggota Keluarga Bayi (0 - 6 Bulan)</th>
            </tr>
            <tr>
                <td>{{ $lingkunganRumah->AK_ibu_bersalin_nifas }}</td>
                <th>Jumlah Anggota Keluarga Ibu Bersalin Dan Nifas</th>
            </tr>
            <tr>
                <td>{{ $lingkunganRumah->AK_ibu_hamil }}</td>
                <th>Jumlah Anggota Keluarga Ibu Hamil</th>
            </tr>
            <tr>
                <th>Apakah Memiliki Jaminan Kesehatan Nasional JKN / Jaminan Kesehatan Daerah (Jamkesda)/ Ansuransi
                    Kesehatan</th>
                <td colspan="2">{{ $lingkunganRumah->jkn_jamkesda }}</td>
            </tr>
            <tr>
                <th>Apakah Tersedia Serapan Air Bersih Di Lingkungan Rumah?</th>
                <td colspan="2">{{ $lingkunganRumah->sarana_air }}</td>
            </tr>
            <tr>
                <th>Bila "Ya": Apa Jenis Sumber Airnya Terlindungi?</th>
                <td colspan="2">{{ $lingkunganRumah->jenis_sumber_air }}</td>
            </tr>
            <tr>
                <th>Apakah Tersedia Jamban Keluarga?</th>
                <td colspan="2">{{ $lingkunganRumah->jamban }}</td>
            </tr>
            <tr>
                <th>Bila "Ya" Apakah Jenis Jambannya Saniter?</th>
                <td colspan="2">{{ $lingkunganRumah->jenis_jamban }}</td>
            </tr>
            <tr>
                <th>Apakah Rumah Memiliki Ventilasi Yang Cukup?</th>
                <td colspan="2">{{ $lingkunganRumah->ventilasi }}</td>
            </tr>
            <tr>
                <th>Apakah Ada Anggota Keluarga Yang Mengalami Gangguan Jiwa</th>
                <td colspan="2">{{ $lingkunganRumah->mengalami_gangguan_jiwa }}</td>
            </tr>
            <tr>
                <th>Apakah Ada Anggota Keluarga Yang Terdiagnosis: <br> (TBC, Hipertensi Dan Diabetes Melitus)</th>
                <td colspan="2">{{ $lingkunganRumah->TBC_hipertensi_millitus }}</td>
            </tr>


        </tbody>
    </table>


</body>

</html>
