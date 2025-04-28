<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>4. Checklist Kunjungan - Bayi (Usia 0 - 6 Bulan)</title>
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
    <h3>4. Checklist Kunjungan - Bayi (Usia 0 - 6 Bulan)</h3>
    <table>
        <tbody aria-colspan="6">
            <tr>
                <th colspan="3">Nama</th>
                <td colspan="14">{{ $kunjunganrumahBayi->nama }}</td>
            </tr>
            <tr>
                <th colspan="3">Tempat / Tanggal Lahir</th>
                <td colspan="14">{{ $kunjunganrumahBayi->tmp_lahir }} /
                    {{ $kunjunganrumahBayi->tgl_lahir }}</td>
            </tr>
            <tr>
                <th colspan="3">Jenis Kelamin</th>
                <td colspan="14">{{ $kunjunganrumahBayi->gender }}</td>
            </tr>

            <tr>
                <th scope="row" colspan="1" rowspan="2">Kunjungan</th>
                <th scope="row" colspan="1" rowspan="2">Tanggal</th>
                <th scope="row" colspan="1" rowspan="2">Pemantauan Suhu Tubuh</th>
                <th scope="row" colspan="1" rowspan="2">Ada Buku KIA</th>
                <th scope="row" colspan="1" rowspan="2">ASI Ekslusif</th>
                <th scope="row" colspan="1" rowspan="2">Tanggal Terakhir Di Timbang Dan Pengukuran</th>
                <th scope="row" colspan="1" rowspan="2">Hasil Penimbangan Dan Pengukuran</th>
                <th scope="row" colspan="5" rowspan="1">Kunjungan Pemeriksaan Bayi Setelah Dilahirkan (0-28
                    Hari)</th>
                <th scope="row" colspan="4" rowspan="1">Imunisasi</th>
                <th scope="row" colspan="1" rowspan="2">Pemberian Edukasi / Kunjungan Nakes</th>
            </tr>
            <tr>
                <th>Pelayanan Esensial (0 - 6 Jam)</th>
                <th>KN 1 (1 - 48 Jam)</th>
                <th>KN 2 (3 - 7 Hari)</th>
                <th>KN 3 (9 - 28 Hari)</th>
                <th>Usia <br> 0 <br>Bulan</th>
                <th>Usia <br> 1 <br>Bulan</th>
                <th>Usia <br> 2 <br>Bulan</th>
                <th>Usia <br> 3 <br>Bulan</th>
                <th>Usia <br> 4 <br>Bulan</th>

            </tr>
            <tr>
                <td rowspan="4">{{ $kunjunganrumahBayi->kunjungan }}</td>
                <td rowspan="4">{{ $kunjunganrumahBayi->tgl_kunjungan }}</td>
                <td rowspan="4">{{ $kunjunganrumahBayi->suhu_tubuh }}</td>
                <td rowspan="4">{{ $kunjunganrumahBayi->buku_kia }}</td>
                <td rowspan="4">{{ $kunjunganrumahBayi->asi }}</td>
                {{-- <td rowspan="4">{{ asi eklusif}}</td> --}}
                <td rowspan="1">Tanggal <br> {{ $kunjunganrumahBayi->tgl_timbang }}</td>
                <td rowspan="1">BB <br> {{ $kunjunganrumahBayi->hasil_timbang_ukur_bb }}</td>
                <td rowspan="1">Tanggal <br>
                    @if ($kunjunganrumahBayi->jenis_kunjungan_pemeriksaan == 'Pelayanan Esensial (0-6 Jam)')
                        {{ $kunjunganrumahBayi->tgl_pemeriksaan }}
                    @endif
                </td>
                <td rowspan="1">Tanggal <br>
                    @if ($kunjunganrumahBayi->jenis_kunjungan_pemeriksaan == 'KN 1 (6-48 Jam)')
                        {{ $kunjunganrumahBayi->tgl_pemeriksaan }}
                    @endif
                </td>
                <td rowspan="1">Tanggal <br>
                    @if ($kunjunganrumahBayi->jenis_kunjungan_pemeriksaan == 'KN 2 (3-7 Hari)')
                        {{ $kunjunganrumahBayi->tgl_pemeriksaan }}
                    @endif
                </td>
                <td rowspan="1">Tanggal <br>
                    @if ($kunjunganrumahBayi->jenis_kunjungan_pemeriksaan == 'KN 3 (8 - 28 Hari)')
                        {{ $kunjunganrumahBayi->tgl_pemeriksaan }}
                    @endif
                </td>

                <td rowspan="1">Hepatitis B <br> (<24 Jam) <br> {{ $kunjunganrumahBayi->hepatitis_b_0bln }}</td>
                <td rowspan="1">BCG <br> {{ $kunjunganrumahBayi->bcg_1bln }}</td>
                <td rowspan="1">DPT-HB-Hib1

                    <br> {{ $kunjunganrumahBayi->dpt_hb_hib_1_2bln }}
                </td>
                <td rowspan="1">DPT-HB-Hib2

                    <br> {{ $kunjunganrumahBayi->dpt_hb_hib_2_3bln }}
                </td>
                <td rowspan="1">DPT-HB-Hib3

                    <br> {{ $kunjunganrumahBayi->dpt_hb_hib_3_4bln }}
                </td>
                <td rowspan="4">{{ $kunjunganrumahBayi->edukasi_kunjungan }}
                </td>


            </tr>
            <tr>
                <td scope="row" colspan="1" rowspan="1">Tempat <br> {{ $kunjunganrumahBayi->tmp_timbang }}
                </td>
                <td scope="row" colspan="1" rowspan="1">PB <br>
                    {{ $kunjunganrumahBayi->hasil_timbang_ukur_pb }}
                </td>
                <td rowspan="1">Tempat <br>
                    @if ($kunjunganrumahBayi->jenis_kunjungan_pemeriksaan == 'Pelayanan Esensial (0-6 Jam)')
                        {{ $kunjunganrumahBayi->tmp_pemeriksaan }}
                    @endif
                </td>
                <td rowspan="1">Tempat <br>
                    @if ($kunjunganrumahBayi->jenis_kunjungan_pemeriksaan == 'KN 1 (6-48 Jam)')
                        {{ $kunjunganrumahBayi->tmp_pemeriksaan }}
                    @endif
                </td>
                <td rowspan="1">Tempat <br>
                    @if ($kunjunganrumahBayi->jenis_kunjungan_pemeriksaan == 'KN 2 (3-7 Hari)')
                        {{ $kunjunganrumahBayi->tmp_pemeriksaan }}
                    @endif
                </td>
                <td rowspan="1">Tempat <br>
                    @if ($kunjunganrumahBayi->jenis_kunjungan_pemeriksaan == 'KN 3 (8 - 28 Hari)')
                        {{ $kunjunganrumahBayi->tmp_pemeriksaan }}
                    @endif
                </td>
                <td scope="row" colspan="1" rowspan="1">BCG <br> {{ $kunjunganrumahBayi->bcg_0bln }}
                </td>
                <td scope="row" colspan="1" rowspan="3">Polio Tetes
                    1 <br> {{ $kunjunganrumahBayi->polio_tetes_1_1bln }}
                </td>
                <td scope="row" colspan="1" rowspan="1">Polio Tetes 2
                    <br> {{ $kunjunganrumahBayi->polio_tetes_1_2bln }}
                </td>
                <td scope="row" colspan="1" rowspan="1">Polio Tetes 3
                    <br> {{ $kunjunganrumahBayi->polio_tetes_2_3bln }}
                </td>
                <td scope="row" colspan="1" rowspan="1">Polio Tetes 4
                    <br> {{ $kunjunganrumahBayi->polio_tetes_3_4bln }}
                </td>


            </tr>
            <tr>
                <td scope="row" colspan="1" rowspan="2">Petugas <br>
                    {{ $kunjunganrumahBayi->petugas_timbang }}
                </td>
                <td scope="row" colspan="1" rowspan="2">LK <br>
                    {{ $kunjunganrumahBayi->hasil_timbang_ukur_lk }}
                </td>
                <td rowspan="2">Petugas
                    Pemeriksaan <br>
                    @if ($kunjunganrumahBayi->jenis_kunjungan_pemeriksaan == 'Pelayanan Esensial (0-6 Jam)')
                        {{ $kunjunganrumahBayi->petugas_pemeriksaan }}
                    @endif
                </td>
                <td rowspan="2">Petugas
                    Pemeriksaan <br>
                    @if ($kunjunganrumahBayi->jenis_kunjungan_pemeriksaan == 'KN 1 (6-48 Jam)')
                        {{ $kunjunganrumahBayi->petugas_pemeriksaan }}
                    @endif
                </td>
                <td rowspan="2">Petugas
                    Pemeriksaan <br>
                    @if ($kunjunganrumahBayi->jenis_kunjungan_pemeriksaan == 'KN 2 (3-7 Hari)')
                        {{ $kunjunganrumahBayi->petugas_pemeriksaan }}
                    @endif
                </td>
                <td rowspan="2">Petugas
                    Pemeriksaan <br>
                    @if ($kunjunganrumahBayi->jenis_kunjungan_pemeriksaan == 'KN 3 (8 - 28 Hari)')
                        {{ $kunjunganrumahBayi->petugas_pemeriksaan }}
                    @endif
                </td>
                <td scope="row" colspan="1" rowspan="2">Polio Tetes
                    1 <br> {{ $kunjunganrumahBayi->polio_tetes_0bln }}
                </td>
                <td scope="row" colspan="1" rowspan="1">PCV 1 <br> {{ $kunjunganrumahBayi->pcv_1_2bln }}
                </td>
                <td scope="row" colspan="1" rowspan="1">PCV 2 <br> {{ $kunjunganrumahBayi->pcv_2_3bln }}
                </td>
                <td scope="row" colspan="1" rowspan="1">Polio Suntik 1 (IPV) 1
                    <br> {{ $kunjunganrumahBayi->polio_tetes_3_4bln }}
                </td>



            </tr>
            <tr>
                <td scope="row" colspan="1" rowspan="1">RV 1 <br> {{ $kunjunganrumahBayi->rv_1_2bln }}
                </td>
                <td scope="row" colspan="1" rowspan="1">RV 2 <br> {{ $kunjunganrumahBayi->rv_2_3bln }}
                </td>
                <td scope="row" colspan="1" rowspan="1">RV 3 <br> {{ $kunjunganrumahBayi->rv_3_4bln }}
                </td>

            </tr>

        </tbody>
    </table>
    <div class="page-break"></div>
    <!-- Mulai tabel baru pada halaman kedua -->
    <h3>4. Checklist Kunjungan - Bayi (Usia 0 - 6 Bulan)</h3>
    <table>

        <tbody>
            <tr>
                <th scope="row" colspan="1" rowspan="2">Wkatu Kunjungan</th>
                <th scope="row" colspan="1" rowspan="2">Tanggal</th>
                <th scope="row" colspan="12" rowspan="1">Tanda Bahaya Pada Bayi 0 - 2 Bulan</th>
                <th scope="row" colspan="1" rowspan="2">Mengingatkan Periksa Ke Postu/ Fasyankes</th>
                <th scope="row" colspan="1" rowspan="2">Melaporkan Ke Nakes</th>
            </tr>
            <tr>
                <th>Napas</th>
                <th>Aktifitas</th>
                <th>Warna Kulit</th>
                <th>Hisapan Bayi</th>
                <th>Kejang</th>
                <th>Suhu Tubuh</th>
                <th>Buang Air Besar (BAB)</th>
                <th>Jumlah Dan Warna Air Kencing</th>
                <th>Tali Pusat</th>
                <th>Mata</th>
                <th>Kulit</th>
                <th>Imunisasi</th>
            </tr>

            <tr>
                <td>{{ $kunjunganrumahBayi->kunjungan }}</td>
                <td>{{ $kunjunganrumahBayi->tgl_kunjungan }}</td>
                <td>{{ $kunjunganrumahBayi->napas }}</td>
                <td>{{ $kunjunganrumahBayi->aktifitas }}</td>
                <td>{{ $kunjunganrumahBayi->warna_kulit }}</td>
                <td>{{ $kunjunganrumahBayi->hisapan_bayi }}</td>
                <td>{{ $kunjunganrumahBayi->kejang }}</td>
                <td>{{ $kunjunganrumahBayi->suhu_tubuh }}</td>
                <td>{{ $kunjunganrumahBayi->bab }}</td>
                <td>{{ $kunjunganrumahBayi->jmhdanwarna_kencing }}</td>
                <td>{{ $kunjunganrumahBayi->tali_pusar }}</td>
                <td>{{ $kunjunganrumahBayi->mata }}</td>
                <td>{{ $kunjunganrumahBayi->kulit }}</td>
                <td>{{ $kunjunganrumahBayi->imunisasi }}</td>
                <td>{{ $kunjunganrumahBayi->pengingat_pemeriksaan }}</td>
                <td>{{ $kunjunganrumahBayi->tgl_lapor_nakes }}</td>
            </tr>


        </tbody>
    </table>
</body>

</html>
