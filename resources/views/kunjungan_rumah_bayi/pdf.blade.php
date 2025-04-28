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

        /* Media query untuk menyesuaikan ukuran teks */
    </style>
</head>

<body>
    <h3>4. Checklist Kunjungan - Bayi (Usia 0 - 6 Bulan)</h3>
    <table>

        <tbody aria-colspan="17">
            @if ($kunjunganrumahBayi->isNotEmpty())
                <tr>
                    <th colspan="3">Nama</th>
                    <td colspan="14">{{ $kunjunganrumahBayi[0]->nama }}</td>
                </tr>
                <tr>
                    <th colspan="3">Tempat / Tanggal Lahir</th>
                    <td colspan="14">{{ $kunjunganrumahBayi[0]->tmp_lahir }} /
                        {{ $kunjunganrumahBayi[0]->tgl_lahir }}</td>
                </tr>
                <tr>
                    <th colspan="3">Jenis Kelamin</th>
                    <td colspan="14">{{ $kunjunganrumahBayi[0]->gender }}</td>
                </tr>
            @endif
            {{--  --}}
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
            {{--  --}}
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
            {{--  --}}
            @foreach ($kunjunganrumahBayi as $member)
                <tr>
                    <td rowspan="4">{{ $member->kunjungan }}</td>
                    <td rowspan="4">{{ $member->tgl_kunjungan }}</td>
                    <td rowspan="4">{{ $member->suhu_tubuh }}</td>
                    <td rowspan="4">{{ $member->buku_kia }}</td>
                    <td rowspan="4">{{ $member->asi }}</td>
                    {{-- <td rowspan="4">{{ asi eklusif}}</td> --}}
                    <td rowspan="1">Tanggal <br> {{ $member->tgl_timbang }}</td>
                    <td rowspan="1">BB <br> {{ $member->hasil_timbang_ukur_bb }}</td>
                    <td rowspan="1">Tanggal <br>
                        @if ($member->jenis_kunjungan_pemeriksaan == 'Pelayanan Esensial (0-6 Jam)')
                            {{ $member->tgl_pemeriksaan }}
                        @endif
                    </td>
                    <td rowspan="1">Tanggal <br>
                        @if ($member->jenis_kunjungan_pemeriksaan == 'KN 1 (6-48 Jam)')
                            {{ $member->tgl_pemeriksaan }}
                        @endif
                    </td>
                    <td rowspan="1">Tanggal <br>
                        @if ($member->jenis_kunjungan_pemeriksaan == 'KN 2 (3-7 Hari)')
                            {{ $member->tgl_pemeriksaan }}
                        @endif
                    </td>
                    <td rowspan="1">Tanggal <br>
                        @if ($member->jenis_kunjungan_pemeriksaan == 'KN 3 (8 - 28 Hari)')
                            {{ $member->tgl_pemeriksaan }}
                        @endif
                    </td>

                    <td rowspan="1">Hepatitis B <br> (<24 Jam) <br> {{ $member->hepatitis_b_0bln }}</td>
                    <td rowspan="1">BCG <br> {{ $member->bcg_1bln }}</td>
                    <td rowspan="1">DPT-HB-Hib1

                        <br> {{ $member->dpt_hb_hib_1_2bln }}
                    </td>
                    <td rowspan="1">DPT-HB-Hib2

                        <br> {{ $member->dpt_hb_hib_2_3bln }}
                    </td>
                    <td rowspan="1">DPT-HB-Hib3

                        <br> {{ $member->dpt_hb_hib_3_4bln }}
                    </td>
                    <td rowspan="4">{{ $member->edukasi_kunjungan }}
                    </td>


                </tr>
                {{--  --}}
                <tr>
                    <td scope="row" colspan="1" rowspan="1">Tempat <br> {{ $member->tmp_timbang }}
                    </td>
                    <td scope="row" colspan="1" rowspan="1">PB <br> {{ $member->hasil_timbang_ukur_pb }}
                    </td>
                    <td rowspan="1">Tempat <br>
                        @if ($member->jenis_kunjungan_pemeriksaan == 'Pelayanan Esensial (0-6 Jam)')
                            {{ $member->tmp_pemeriksaan }}
                        @endif
                    </td>
                    <td rowspan="1">Tempat <br>
                        @if ($member->jenis_kunjungan_pemeriksaan == 'KN 1 (6-48 Jam)')
                            {{ $member->tmp_pemeriksaan }}
                        @endif
                    </td>
                    <td rowspan="1">Tempat <br>
                        @if ($member->jenis_kunjungan_pemeriksaan == 'KN 2 (3-7 Hari)')
                            {{ $member->tmp_pemeriksaan }}
                        @endif
                    </td>
                    <td rowspan="1">Tempat <br>
                        @if ($member->jenis_kunjungan_pemeriksaan == 'KN 3 (8 - 28 Hari)')
                            {{ $member->tmp_pemeriksaan }}
                        @endif
                    </td>
                    <td scope="row" colspan="1" rowspan="1">BCG <br> {{ $member->bcg_0bln }}
                    </td>
                    <td scope="row" colspan="1" rowspan="3">Polio Tetes
                        1 <br> {{ $member->polio_tetes_1_1bln }}
                    </td>
                    <td scope="row" colspan="1" rowspan="1">Polio Tetes 2
                        <br> {{ $member->polio_tetes_1_2bln }}
                    </td>
                    <td scope="row" colspan="1" rowspan="1">Polio Tetes 3
                        <br> {{ $member->polio_tetes_2_3bln }}
                    </td>
                    <td scope="row" colspan="1" rowspan="1">Polio Tetes 4
                        <br> {{ $member->polio_tetes_3_4bln }}
                    </td>


                </tr>
                {{--  --}}
                <tr>
                    <td scope="row" colspan="1" rowspan="2">Petugas <br> {{ $member->petugas_timbang }}
                    </td>
                    <td scope="row" colspan="1" rowspan="2">LK <br> {{ $member->hasil_timbang_ukur_lk }}
                    </td>
                    <td rowspan="2">Petugas
                        Pemeriksaan <br>
                        @if ($member->jenis_kunjungan_pemeriksaan == 'Pelayanan Esensial (0-6 Jam)')
                            {{ $member->petugas_pemeriksaan }}
                        @endif
                    </td>
                    <td rowspan="2">Petugas
                        Pemeriksaan <br>
                        @if ($member->jenis_kunjungan_pemeriksaan == 'KN 1 (6-48 Jam)')
                            {{ $member->petugas_pemeriksaan }}
                        @endif
                    </td>
                    <td rowspan="2">Petugas
                        Pemeriksaan <br>
                        @if ($member->jenis_kunjungan_pemeriksaan == 'KN 2 (3-7 Hari)')
                            {{ $member->petugas_pemeriksaan }}
                        @endif
                    </td>
                    <td rowspan="2">Petugas
                        Pemeriksaan <br>
                        @if ($member->jenis_kunjungan_pemeriksaan == 'KN 3 (8 - 28 Hari)')
                            {{ $member->petugas_pemeriksaan }}
                        @endif
                    </td>
                    <td scope="row" colspan="1" rowspan="2">Polio Tetes
                        1 <br> {{ $member->polio_tetes_0bln }}
                    </td>
                    <td scope="row" colspan="1" rowspan="1">PCV 1 <br> {{ $member->pcv_1_2bln }}
                    </td>
                    <td scope="row" colspan="1" rowspan="1">PCV 2 <br> {{ $member->pcv_2_3bln }}
                    </td>
                    <td scope="row" colspan="1" rowspan="1">Polio Suntik 1 (IPV) 1
                        <br> {{ $member->polio_tetes_3_4bln }}
                    </td>



                </tr>
                {{--  --}}
                <tr>
                    <td scope="row" colspan="1" rowspan="1">RV 1 <br> {{ $member->rv_1_2bln }}
                    </td>
                    <td scope="row" colspan="1" rowspan="1">RV 2 <br> {{ $member->rv_2_3bln }}
                    </td>
                    <td scope="row" colspan="1" rowspan="1">RV 3 <br> {{ $member->rv_3_4bln }}
                    </td>

                </tr>
                {{--  --}}
            @endforeach

        </tbody>
    </table>
    <div class="page-break"></div>
    <!-- Mulai tabel baru pada halaman kedua -->
    <h3>4. Checklist Kunjungan - Bayi (Usia 0 - 6 Bulan) (Lembar Dua)</h3>
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
            @foreach ($kunjunganrumahBayi as $member)
                <tr>
                    <td>{{ $member->kunjungan }}</td>
                    <td>{{ $member->tgl_kunjungan }}</td>
                    <td>{{ $member->napas }}</td>
                    <td>{{ $member->aktifitas }}</td>
                    <td>{{ $member->warna_kulit }}</td>
                    <td>{{ $member->hisapan_bayi }}</td>
                    <td>{{ $member->kejang }}</td>
                    <td>{{ $member->suhu_tubuh }}</td>
                    <td>{{ $member->bab }}</td>
                    <td>{{ $member->jmhdanwarna_kencing }}</td>
                    <td>{{ $member->tali_pusar }}</td>
                    <td>{{ $member->mata }}</td>
                    <td>{{ $member->kulit }}</td>
                    <td>{{ $member->imunisasi }}</td>
                    <td>{{ $member->pengingat_pemeriksaan }}</td>
                    <td>{{ $member->tgl_lapor_nakes }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
</body>

</html>
