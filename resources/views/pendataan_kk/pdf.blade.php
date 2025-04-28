<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>1. Data Pendataan Kartu Keluarga</title>
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
            font-size: 12px;
            /* Sesuaikan ukuran font dengan yang Anda inginkan */
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
    <h3>1. Data Pendataan Kartu Keluarga</h3>

    <table>
        <tbody>
            <thead>
                @foreach ($jadwalPengumpulan as $key => $jadwal)
                    <tr>
                        <th colspan="1">Tanggal Data Pengumpulan </th>
                        <td colspan="3">{{ $jadwal->created_at }}</td>

                    </tr>
                    <tr>
                        <th colspan="4">Informasi Tempat</th>
                    </tr>
                    <tr>
                        <th colspan="1">Alamat</th>
                        <td colspan="3">{{ $jadwal->alamat }} RT {{ $jadwal->rt }} / RW {{ $jadwal->rw }}</td>
                    </tr>
                    <tr>
                        <th colspan="1">Desa / Kelurahan</th>
                        <td colspan="1">{{ $jadwal->desa }}</td>
                        <th colspan="1">No. Handphone KK / Salah Satu Anggota Keluarga</th>
                        <td colspan="1">{{ $jadwal->no_hp }}</td>
                    </tr>
                    <tr>
                        <th colspan="1">Kecamatan</th>
                        <td colspan="1">{{ $jadwal->kecamatan }}</td>
                        <th colspan="1">Puskesmas</th>
                        <td colspan="1">{{ $jadwal->puskesmas }}</td>
                    </tr>
                    <tr>
                        <th colspan="1">Kabupaten / Kota</th>
                        <td colspan="1">{{ $jadwal->kota }}</td>
                        <th colspan="1">Postu/Posyandu Prima</th>
                        <td colspan="1">{{ $jadwal->postu }}</td>
                    </tr>
                    <tr>
                        <th colspan="1">Provinsi</th>
                        <td colspan="1">{{ $jadwal->provinsi }}</td>
                        <th colspan="1">Posyandu</th>
                        <td colspan="1">{{ $jadwal->posyandu }}</td>
                    </tr>
                @endforeach
            </thead>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th colspan="10">Informasi Anggota Keluarga</th>
            </tr>
            <tr>
                <th>No</th>
                <th>Nama Lengkap</th>
                <th>NIK</th>
                <th>Tanggal Lahir</th>
                <th>Jenis Kelamin</th>
                <th>Hubungan Dengan Kepala Keluarga</th>
                <th>Status Perkawinan</th>
                <th>Pendidikan Terakhir</th>
                <th>Pekerjaan</th>
                <th>Kelompok Sasaran</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($pendataan_KK as $key => $data)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ $data->nik }}</td>
                    <td>{{ $data->tgl_lahir }}</td>
                    <td>{{ $data->gender }}</td>
                    <td>{{ $data->hubungan_keluarga }}</td>
                    <td>{{ $data->status_perkawinan }}</td>
                    <td>{{ $data->pendidikan_terakhir }}</td>
                    <td>{{ $data->pekerjaan }}</td>
                    <td>{{ $data->kelompok_sasaran }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>




</body>

</html>
