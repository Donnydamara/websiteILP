<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kunjungan TBC</title>
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
    <h3>1. Data Keluarga Dan Anggota Keluarga</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Posyandu</th>
                <th>Waktu</th>
                <th>Nama</th>
                <th>NIK</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>No Telepon</th>
                <th>Masalah Kesehatan</th>
                <th>Tindak Lanjut</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>{{ $tindakLanjutKunjungan->posyandu }}</td>
                <td>{{ $tindakLanjutKunjungan->waktu }}</td>
                <td>{{ $tindakLanjutKunjungan->nama }}</td>
                <td>{{ $tindakLanjutKunjungan->nik }}</td>
                <td>{{ $tindakLanjutKunjungan->tgl_lahir }}</td>
                <td>{{ $tindakLanjutKunjungan->alamat }}</td>
                <td>{{ $tindakLanjutKunjungan->no_telepon }}</td>
                <td>{{ $tindakLanjutKunjungan->masalah_kesehatan_yang_ditemukan }}</td>
                <td>{{ $tindakLanjutKunjungan->tindak_lanjut }}</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
