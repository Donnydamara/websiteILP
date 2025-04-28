<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>7. Checklist Kunjungan Rumah - Usia Sekolah / Remaja</title>
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
    <h3>7. Checklist Kunjungan Rumah - Usia Sekolah / Remaja</h3>
    <table>
        <tbody aria-colspan="6">
            <tr>
                <th colspan="3">Nama</th>
                <td colspan="11">{{ $kunjunganusiasekolah->nama }}</td>
            </tr>
            <tr>
                <th colspan="3">Tempat / Tanggal Lahir</th>
                <td colspan="11">{{ $kunjunganusiasekolah->tmp_lahir }} / {{ $kunjunganusiasekolah->tgl_lahir }}</td>
            </tr>
            <tr>
                <th colspan="3">Jenis Kelamin</th>
                <td colspan="11">{{ $kunjunganusiasekolah->gender }}</td>
            </tr>
            <tr>
                <th scope="row" colspan="1" rowspan="2">Kunjungan</th>
                <th scope="row" colspan="1" rowspan="2">Tanggal</th>
                <th scope="row" colspan="1" rowspan="2">Pemantauan Suhu</th>
                <th scope="row" colspan="1" rowspan="2">Tanggal Terakhir Menimbang Dan Mengukur</th>
                <th scope="row" colspan="1" rowspan="2">Isi Piringku Usia Sekolah/Remaja</th>
                <th scope="row" colspan="1" rowspan="2">Hasil Penimbangan Dan Pengukuran</th>
                <th scope="row" colspan="3" rowspan="1">Remaja Putri</th>
                <th scope="row" colspan="1" rowspan="2">Merokok</th>
                <th scope="row" colspan="2" rowspan="1">Remaja >15 Tahun Pemeriksaan PTM*) Satu Tahun
                    Terakhir</th>
                <th scope="row" colspan="1" rowspan="2">Melakukan Skrining Kesehatan Jiwa</th>
                <th scope="row" colspan="1" rowspan="2">Pemberian Edukasi / Kunjungan Nakes</th>
            </tr>
            <tr>

                <th colspan="1">Ada TTD</th>
                <th colspan="1">Minum TTD Minggu Ini / Dalam 7 Hari terakhir</th>
                <th colspan="1">Pemeriksaan Anemia (Skrining Hb) Satu Tahun Terakhir</th>

                <th colspan="1">Gula Darah</th>
                <th colspan="1">Tekanan Darah</th>
            </tr>
            {{--  --}}
            <tr>
                <td rowspan="3">{{ $kunjunganusiasekolah->kunjungan }}</td>
                <td rowspan="3">{{ $kunjunganusiasekolah->tgl_kunjungan }}</td>
                <td rowspan="3">{{ $kunjunganusiasekolah->suhu_tubuh }}</td>
                <td rowspan="1">Tanggal <br> {{ $kunjunganusiasekolah->tgl_timbang_ukur }}</td>
                <td rowspan="3">{{ $kunjunganusiasekolah->porsi }}</td>
                <td rowspan="1">BB <br> {{ $kunjunganusiasekolah->bb_timbang_ukur }}</td>
                <td rowspan="3">
                    @if ($kunjunganusiasekolah->gender == 'Wanita')
                        {{ $kunjunganusiasekolah->ada_ttd_putri }}
                    @endif
                </td>
                <td rowspan="3">
                    @if ($kunjunganusiasekolah->gender == 'Wanita')
                        {{ $kunjunganusiasekolah->minum_ttd_putri }}
                    @endif
                </td>
                <td rowspan="1">
                    Tanggal
                    <br>
                    @if ($kunjunganusiasekolah->gender == 'Wanita')
                        {{ $kunjunganusiasekolah->tgl_skrining_hb_putri }}
                    @endif
                </td>
                <td rowspan="3">{{ $kunjunganusiasekolah->merokok }}</td>
                <td rowspan="1">Tanggal <br>{{ $kunjunganusiasekolah->tgl_gula_darah_periksi_ptm }}</td>
                <td rowspan="1">Tanggal <br>{{ $kunjunganusiasekolah->tgl_tekanan_darah_periksi_ptm }}</td>
                <td rowspan="1">Tanggal <br>{{ $kunjunganusiasekolah->tgl_skrining }}</td>
                <td rowspan="3">{{ $kunjunganusiasekolah->edukasi }}</td>
            </tr>
            <tr>
                <td scope="row" colspan="1" rowspan="1">Tempat <br>
                    {{ $kunjunganusiasekolah->tmp_timbang_ukur }}</td>
                <td scope="row" colspan="1" rowspan="1">TB <br> {{ $kunjunganusiasekolah->tb_timbang_ukur }}
                </td>

                <td scope="row" colspan="1" rowspan="1">Tempat <br>
                    @if ($kunjunganusiasekolah->gender == 'Wanita')
                        {{ $kunjunganusiasekolah->tmp_skrining_hb_putri }}
                    @endif
                </td>
                <td scope="row" colspan="1" rowspan="1">Tempat <br>
                    {{ $kunjunganusiasekolah->tmp_gula_darah_periksi_ptm }}</td>
                <td scope="row" colspan="1" rowspan="1">Tempat <br>
                    {{ $kunjunganusiasekolah->tmp_tekanan_darah_periksi_ptm }}</td>
                <td scope="row" colspan="1" rowspan="1">Tempat <br>
                    {{ $kunjunganusiasekolah->tmp_skrining }}</td>

            </tr>
            <tr>
                <td scope="row" colspan="1" rowspan="1"> <br>

                    {{ $kunjunganusiasekolah->hasil_periksa_satu_tahun_terakhir_ptd }}</td>
                <td scope="row" colspan="1" rowspan="1">LP <br> {{ $kunjunganusiasekolah->lp_timbang_ukur }}
                </td>


                <td scope="row" colspan="1" rowspan="1">Hasil <br>
                    @if ($kunjunganusiasekolah->gender == 'Wanita')
                        {{ $kunjunganusiasekolah->hasil_skrining_hb_putri }}
                    @endif
                </td>

                <td scope="row" colspan="1" rowspan="1">Hasil <br>
                    {{ $kunjunganusiasekolah->hasil_gula_darah_periksi_ptm }}</td>
                <td scope="row" colspan="1" rowspan="1">Hasil <br>
                    {{ $kunjunganusiasekolah->hasil_tekanan_darah_periksi_ptm }}</td>
                <td scope="row" colspan="1" rowspan="1">Petugas <br>
                    {{ $kunjunganusiasekolah->petugas_skrining }}</td>


            </tr>
        </tbody>
    </table>
</body>

</html>
