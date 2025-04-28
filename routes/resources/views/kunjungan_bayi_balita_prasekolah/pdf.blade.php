<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>5. Checklist Kunjungan - Bayi, Balita Dan Anak Usia Prasekolah</title>
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
    <h3>5. Checklist Kunjungan - Bayi, Balita Dan Anak Usia Prasekolah</h3>
    <table>

        <tbody aria-colspan="17">
            @if ($kunjunganbayibalitaPrasekolah->isNotEmpty())
                <tr>
                    <th colspan="3">Nama</th>
                    <td colspan="23">{{ $kunjunganbayibalitaPrasekolah[0]->nama }}</td>
                </tr>
                <tr>
                    <th colspan="3">Tempat / Tanggal Lahir</th>
                    <td colspan="23">{{ $kunjunganbayibalitaPrasekolah[0]->tmp_lahir }} /
                        {{ $kunjunganbayibalitaPrasekolah[0]->tgl_lahir }}</td>
                </tr>
                <tr>
                    <th colspan="3">Jenis Kelamin</th>
                    <td colspan="23">{{ $kunjunganbayibalitaPrasekolah[0]->gender }}</td>
                </tr>
            @endif
            {{--  --}}
            <tr>
                <th scope="row" colspan="1" rowspan="2">Kunjungan</th>
                <th scope="row" colspan="1" rowspan="2">Tanggal</th>
                <th scope="row" colspan="1" rowspan="2">Pemantauan Suhu Tubuh</th>
                <th scope="row" colspan="1" rowspan="2">Ada Buku KIA</th>
                <th scope="row" colspan="1" rowspan="2">Tanggal Terakhir Di Timbang</th>
                <th scope="row" colspan="1" rowspan="2">Hasil Penimbangan Dan Pengukuran</th>
                <th scope="row" colspan="9" rowspan="1">Imunisasi</th>
                <th scope="row" colspan="5" rowspan="1">Pemberian
                    Makanan Pendamping ASI Kaya Protein Hewani</th>
                <th scope="row" colspan="2" rowspan="1">Obat Cacing</th>
                <th scope="row" colspan="2" rowspan="1">Kapsul Vitamin A</th>
                <th scope="row" colspan="2" rowspan="1">Makanan Tambahan Pangan Lokal Bagi Balita Dengan
                    Masalah Gizi</th>
                <th scope="row" colspan="1" rowspan="2">Pemberian Edukasi/ Kunjungan Nakes</th>


            </tr>
            {{--  --}}
            <tr>
                <th>Usia <br> 0 <br>Bulan</th>
                <th>Usia <br> 1 <br>Bulan</th>
                <th>Usia <br> 2 <br>Bulan</th>
                <th>Usia <br> 3 <br>Bulan</th>
                <th>Usia <br> 4 <br>Bulan</th>
                <th>Usia <br> 9 <br>Bulan</th>
                <th>Usia <br> 10 <br>Bulan</th>
                <th>Usia <br> 12 <br>Bulan</th>
                <th>Usia <br> 18 <br>Bulan</th>
                <th>Makanan Pokok<br> (Beras/<br>Kentang/<br>Jagung)</th>
                <th>Makanan Sumber <br> Proteiin Hewani<br>
                    (Telur/<br>Ikan/<br>Ayam/<br>Daging/<br>Udang/<br>Hati/<br>Susu <br>Dan Produk<br> Olahan)</th>
                <th>Makanan Sumber<br> Protein Nabati<br> (Tahu/<br>Tempe/<br>Kacang <br>Hijau/<br>Kacang <br>Polong)
                </th>
                <th>Sumber Lemak (Minyak /Santan)</th>
                <th>Buah Dan Sayur</th>
                <th>Ada</th>
                <th>Waktu Makan</th>
                <th>Jenis
                    Kunjungan</th>
                <th>Jenis
                    Kunjungan2</th>

                <th>Ada</th>
                <th>Kepatuhan Konsumsi</th>

            </tr>
            {{--  --}}
            @foreach ($kunjunganbayibalitaPrasekolah as $member)
                <tr>
                    <td rowspan="4">{{ $member->kunjungan }}</td>
                    <td rowspan="4">{{ $member->tgl_kunjungan }}</td>
                    <td rowspan="4">{{ $member->suhu_tubuh }}</td>
                    <td rowspan="4">{{ $member->buku_kia }}</td>
                    <td rowspan="1">Tanggal <br> {{ $member->tgl_timbang_ukur }}</td>
                    <td rowspan="1">BB <br> {{ $member->bb_hasil_timbang_ukur }}</td>
                    <td rowspan="1">Hepatitis B <br> (<24 Jam) <br> {{ $member->hepatitis_b_0bulan }}</td>
                    <td rowspan="1">BCG <br> {{ $member->bcg_1bulan }}</td>
                    <td rowspan="1">DPT-HB-Hib

                        <br> {{ $member->dpt_hb_hib_1_2bulan }}
                    </td>
                    <td rowspan="1">DPT-HB-Hib

                        <br> {{ $member->dpt_hb_hib_2_3bulan }}
                    </td>
                    <td rowspan="1">DPT-HB-Hib

                        <br> {{ $member->dpt_hb_hib_3_4bulan }}
                    </td>
                    <td rowspan="2">Campak
                        Rubella

                        <br> {{ $member->campak_rubelia_9bulan }}
                    </td>
                    <td rowspan="4">Jepanese encephalitis (JE)
                        <br> {{ $member->je_10bulan }}
                    </td>
                    <td rowspan="4">PCV3
                        <br> {{ $member->pv_3_12bulan }}
                    </td>
                    <td rowspan="2">DPT-HB-hib 1 Lanjutan

                        <br> {{ $member->dpt_lanjut_1_18bulan }}
                    </td>
                    <td rowspan="4">{{ $member->makanan_pokok }}</td>
                    <td rowspan="4">{{ $member->makanan_protein_hewan }}</td>
                    <td rowspan="4">{{ $member->makanan_protein_nabati }}</td>
                    <td rowspan="4">{{ $member->makanan_lemak }}</td>
                    <td rowspan="4">{{ $member->sayur_buah }}</td>
                    <td rowspan="4">{{ $member->oc_ada }}</td>
                    <td rowspan="4">Tanggal <br>{{ $member->oc_tgl }}</td>
                    {{-- <td rowspan="2">{{ $member->kv_jenis }}</td> --}}
                    <td scope="row" colspan="1" rowspan="2">Mulai <br>
                        @if ($member->kv_jenis == 'Usia 6 - 11 Bulan (Kapsul Biru)')
                            {{ $member->tgl_kv_mulai }}
                        @endif
                    </td>


                    <td scope="row" colspan="1" rowspan="2">Mulai <br>
                        @if ($member->kv_jenis == 'Usia >11 Bulan (Kapsul Merah)')
                            {{ $member->tgl_kv_mulai }}
                        @endif
                    </td>
                    <td rowspan="4">{{ $member->makan_tambah_ada }}</td>
                    <td rowspan="4"> {{ $member->makan_tambah_kepatuhan }}</td>
                    <td rowspan="4"> {{ $member->edukasi }}</td>


                </tr>
                {{--  --}}
                <tr>
                    <td scope="row" colspan="1" rowspan="1">Tempat <br> {{ $member->tempat_timbang_ukur }}
                    </td>
                    <td scope="row" colspan="1" rowspan="1">PB/TB <br> {{ $member->pb_tb_hasil_timbang_ukur }}
                    </td>
                    <td scope="row" colspan="1" rowspan="1">BCG <br> {{ $member->bcg_0bulan }}
                    </td>
                    <td scope="row" colspan="1" rowspan="1">Polio Tetes
                        1 <br> {{ $member->polio_1bulan }}
                    </td>
                    <td scope="row" colspan="1" rowspan="1">Polio Tetes
                        <br> {{ $member->polio_2_2bulan }}
                    </td>
                    <td scope="row" colspan="1" rowspan="1">Polio Tetes
                        <br> {{ $member->polio_3_3bulan }}
                    </td>
                    <td scope="row" colspan="1" rowspan="1">Polio Tetes
                        <br> {{ $member->polio_4_4bulan }}
                    </td>


                </tr>
                {{--  --}}
                <tr>
                    <td scope="row" colspan="1" rowspan="2">Petugas <br> {{ $member->petugas_timbang_ukur }}
                    </td>
                    <td scope="row" colspan="1" rowspan="2">LK <br> {{ $member->lk_hasil_timbang_ukur }}
                    </td>
                    <td scope="row" colspan="1" rowspan="2">Polio Tetes
                        1 <br> {{ $member->polio_0bulan }}
                    </td>
                    <td scope="row" colspan="1" rowspan="2">
                    </td>
                    <td scope="row" colspan="1" rowspan="1">PCV <br> {{ $member->pcv_1_2bulan }}
                    </td>
                    <td scope="row" colspan="1" rowspan="1">PCV <br> {{ $member->pcv_2_3bulan }}
                    </td>
                    <td scope="row" colspan="1" rowspan="1">Polio Suntik
                        <br> {{ $member->polio_suntik_4bulan }}
                    </td>
                    <td scope="row" colspan="1" rowspan="2">Polio Suntik
                        <br> {{ $member->polio_suntik_2_9bulan }}
                    </td>
                    <td scope="row" colspan="1" rowspan="2">Campak-rubella Lanjutan
                        <br> {{ $member->campak_lanjut_18bulan }}
                    </td>

                    <td scope="row" colspan="1" rowspan="2">Selesai <br>
                        @if ($member->kv_jenis == 'Usia 6 - 11 Bulan (Kapsul Biru)')
                            {{ $member->tgl_kv_selesai }}
                        @endif
                    </td>


                    <td scope="row" colspan="1" rowspan="2">Selesai <br>
                        @if ($member->kv_jenis == 'Usia >11 Bulan (Kapsul Merah)')
                            {{ $member->tgl_kv_selesai }}
                        @endif
                    </td>


                </tr>
                {{--  --}}
                <tr>
                    <td scope="row" colspan="1" rowspan="1">RV <br> {{ $member->rv_1_2bulan }}
                    </td>
                    <td scope="row" colspan="1" rowspan="1">RV <br> {{ $member->rv_2_3bulan }}
                    </td>
                    <td scope="row" colspan="1" rowspan="1">RV <br> {{ $member->rv_3_4bulan }}
                    </td>

                </tr>
                {{--  --}}
            @endforeach

        </tbody>
    </table>
    <div class="page-break"></div>
    <!-- Mulai tabel baru pada halaman kedua -->
    <h3>5. Checklist Kunjungan - Bayi, Balita Dan Anak Usia Prasekolah (Lembar 2)</h3>
    <table>

        <tbody>
            <tr>
                <th scope="row" colspan="1" rowspan="2">Wkatu Kunjungan</th>
                <th scope="row" colspan="1" rowspan="2">Tanggal</th>
                <th scope="row" colspan="8" rowspan="1">Tanda Bahaya Pada Bayi 2 - 60 Bulan</th>
                <th scope="row" colspan="1" rowspan="2">Mengingatkan Periksa Ke Postu/ Fasyankes</th>
                <th scope="row" colspan="1" rowspan="2">Melaporkan Ke Nakes</th>
            </tr>
            <tr>
                <th>Napas</th>
                <th>Batuk</th>
                <th>Diare</th>
                <th>Jumlah Dan Warna Kencing</th>
                <th>Warna Kulit</th>
                <th>Aktifitas</th>
                <th>Hisapan Bayi</th>
                <th>Pemberian Makan</th>
            </tr>
            @foreach ($kunjunganbayibalitaPrasekolah as $member)
                <tr>
                    <td>{{ $member->kunjungan }}</td>
                    <td>{{ $member->tgl_kunjungan }}</td>
                    <td>{{ $member->napas }}</td>
                    <td>{{ $member->batuk }}</td>
                    <td>{{ $member->diare }}</td>
                    <td>{{ $member->jmh_warna_kencing }}</td>
                    <td>{{ $member->warna_kulit }}</td>
                    <td>{{ $member->aktifitas }}</td>
                    <td>{{ $member->hisapan_bayi }}</td>
                    <td>{{ $member->pemberian_makan }}</td>
                    <td>{{ $member->pengingat_periksa_postu }}</td>
                    <td>{{ $member->lapor_nakes }}</td>
                </tr>
            @endforeach

        </tbody>
    </table>
</body>

</html>
