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
    </style>
</head>

<body>
    <h3>5. Checklist Kunjungan - Bayi, Balita Dan Anak Usia Prasekolah</h3>
    <table>
        <tbody aria-colspan="6">
            <tr>
                <th colspan="3">Nama</th>
                <td colspan="23">{{ $kunjunganbayibalitaPrasekolah->nama }}</td>
            </tr>
            <tr>
                <th colspan="3">Tempat / Tanggal Lahir</th>
                <td colspan="23">{{ $kunjunganbayibalitaPrasekolah->tmp_lahir }} /
                    {{ $kunjunganbayibalitaPrasekolah->tgl_lahir }}</td>
            </tr>
            <tr>
                <th colspan="3">Jenis Kelamin</th>
                <td colspan="23">{{ $kunjunganbayibalitaPrasekolah->gender }}</td>
            </tr>

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
                <th scope="row" colspan="1" rowspan="1">Kapsul Vitamin A</th>
                <th scope="row" colspan="2" rowspan="1">Makanan Tambahan Pangan Lokal Bagi Balita Dengan
                    Masalah Gizi</th>
                <th scope="row" colspan="1" rowspan="2">Pemberian Edukasi/ Kunjungan Nakes</th>

            </tr>
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

                <th>Ada</th>
                <th>Kepatuhan Konsumsi</th>

            </tr>
            <tr>
                <td rowspan="4">{{ $kunjunganbayibalitaPrasekolah->kunjungan }}</td>
                <td rowspan="4">{{ $kunjunganbayibalitaPrasekolah->tgl_kunjungan }}</td>
                <td rowspan="4">{{ $kunjunganbayibalitaPrasekolah->suhu_tubuh }}</td>
                <td rowspan="4">{{ $kunjunganbayibalitaPrasekolah->buku_kia }}</td>
                <td rowspan="1">Tanggal <br> {{ $kunjunganbayibalitaPrasekolah->tgl_timbang_ukur }}</td>
                <td rowspan="1">BB <br> {{ $kunjunganbayibalitaPrasekolah->bb_hasil_timbang_ukur }}</td>
                <td rowspan="1">Hepatitis B <br> (<24 Jam) <br>
                        {{ $kunjunganbayibalitaPrasekolah->hepatitis_b_0bulan }}</td>
                <td rowspan="1">BCG <br> {{ $kunjunganbayibalitaPrasekolah->bcg_1bulan }}</td>
                <td rowspan="1">DPT-HB-Hib

                    <br> {{ $kunjunganbayibalitaPrasekolah->dpt_hb_hib_1_2bulan }}
                </td>
                <td rowspan="1">DPT-HB-Hib

                    <br> {{ $kunjunganbayibalitaPrasekolah->dpt_hb_hib_2_3bulan }}
                </td>
                <td rowspan="1">DPT-HB-Hib

                    <br> {{ $kunjunganbayibalitaPrasekolah->dpt_hb_hib_3_4bulan }}
                </td>
                <td rowspan="2">Campak
                    Rubella

                    <br> {{ $kunjunganbayibalitaPrasekolah->campak_rubelia_9bulan }}
                </td>
                <td rowspan="4">Jepanese encephalitis (JE)
                    <br> {{ $kunjunganbayibalitaPrasekolah->je_10bulan }}
                </td>
                <td rowspan="4">PCV3
                    <br> {{ $kunjunganbayibalitaPrasekolah->pv_3_12bulan }}
                </td>
                <td rowspan="2">DPT-HB-hib 1 Lanjutan

                    <br> {{ $kunjunganbayibalitaPrasekolah->dpt_lanjut_1_18bulan }}
                </td>
                <td rowspan="4">{{ $kunjunganbayibalitaPrasekolah->makanan_pokok }}</td>
                <td rowspan="4">{{ $kunjunganbayibalitaPrasekolah->makanan_protein_hewan }}</td>
                <td rowspan="4">{{ $kunjunganbayibalitaPrasekolah->makanan_protein_nabati }}</td>
                <td rowspan="4">{{ $kunjunganbayibalitaPrasekolah->makanan_lemak }}</td>
                <td rowspan="4">{{ $kunjunganbayibalitaPrasekolah->sayur_buah }}</td>
                <td rowspan="4">{{ $kunjunganbayibalitaPrasekolah->oc_ada }}</td>
                <td rowspan="4">Tanggal <br>{{ $kunjunganbayibalitaPrasekolah->oc_tgl }}</td>
                <td rowspan="2">{{ $kunjunganbayibalitaPrasekolah->kv_jenis }}</td>
                <td rowspan="4">{{ $kunjunganbayibalitaPrasekolah->makan_tambah_ada }}</td>
                <td rowspan="4"> {{ $kunjunganbayibalitaPrasekolah->makan_tambah_kepatuhan }}</td>
                <td rowspan="4"> {{ $kunjunganbayibalitaPrasekolah->edukasi }}</td>
            </tr>
            <tr>
                <td scope="row" colspan="1" rowspan="1">Tempat <br>
                    {{ $kunjunganbayibalitaPrasekolah->tempat_timbang_ukur }}
                </td>
                <td scope="row" colspan="1" rowspan="1">PB/TB <br>
                    {{ $kunjunganbayibalitaPrasekolah->pb_tb_hasil_timbang_ukur }}
                </td>
                <td scope="row" colspan="1" rowspan="1">BCG <br>
                    {{ $kunjunganbayibalitaPrasekolah->bcg_0bulan }}
                </td>
                <td scope="row" colspan="1" rowspan="1">Polio Tetes
                    1 <br> {{ $kunjunganbayibalitaPrasekolah->polio_1bulan }}
                </td>
                <td scope="row" colspan="1" rowspan="1">Polio Tetes
                    <br> {{ $kunjunganbayibalitaPrasekolah->polio_2_2bulan }}
                </td>
                <td scope="row" colspan="1" rowspan="1">Polio Tetes
                    <br> {{ $kunjunganbayibalitaPrasekolah->polio_3_3bulan }}
                </td>
                <td scope="row" colspan="1" rowspan="1">Polio Tetes
                    <br> {{ $kunjunganbayibalitaPrasekolah->polio_4_4bulan }}
                </td>

            </tr>
            <tr>
                <td scope="row" colspan="1" rowspan="2">Petugas <br>
                    {{ $kunjunganbayibalitaPrasekolah->petugas_timbang_ukur }}
                </td>
                <td scope="row" colspan="1" rowspan="2">LK <br>
                    {{ $kunjunganbayibalitaPrasekolah->lk_hasil_timbang_ukur }}
                </td>
                <td scope="row" colspan="1" rowspan="2">Polio Tetes
                    1 <br> {{ $kunjunganbayibalitaPrasekolah->polio_0bulan }}
                </td>
                <td scope="row" colspan="1" rowspan="2">
                </td>
                <td scope="row" colspan="1" rowspan="1">PCV <br>
                    {{ $kunjunganbayibalitaPrasekolah->pcv_1_2bulan }}
                </td>
                <td scope="row" colspan="1" rowspan="1">PCV <br>
                    {{ $kunjunganbayibalitaPrasekolah->pcv_2_3bulan }}
                </td>
                <td scope="row" colspan="1" rowspan="1">Polio Suntik
                    <br> {{ $kunjunganbayibalitaPrasekolah->polio_suntik_4bulan }}
                </td>
                <td scope="row" colspan="1" rowspan="2">Polio Suntik
                    <br> {{ $kunjunganbayibalitaPrasekolah->polio_suntik_2_9bulan }}
                </td>
                <td scope="row" colspan="1" rowspan="2">Campak-rubella Lanjutan
                    <br> {{ $kunjunganbayibalitaPrasekolah->campak_lanjut_18bulan }}
                </td>
                <td scope="row" colspan="1" rowspan="1">Mulai <br>
                    {{ $kunjunganbayibalitaPrasekolah->tgl_kv_mulai }}
                </td>
                {{--  --}}
            <tr>
                <td scope="row" colspan="1" rowspan="1">RV <br>
                    {{ $kunjunganbayibalitaPrasekolah->rv_1_2bulan }}
                </td>
                <td scope="row" colspan="1" rowspan="1">RV <br>
                    {{ $kunjunganbayibalitaPrasekolah->rv_2_3bulan }}
                </td>
                <td scope="row" colspan="1" rowspan="1">RV <br>
                    {{ $kunjunganbayibalitaPrasekolah->rv_3_4bulan }}
                </td>
                <td scope="row" colspan="1" rowspan="1">Selesai <br>
                    {{ $kunjunganbayibalitaPrasekolah->tgl_kv_selesai }}
                </td>
            </tr>
            </tr>
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

            <tr>
                <td>{{ $kunjunganbayibalitaPrasekolah->kunjungan }}</td>
                <td>{{ $kunjunganbayibalitaPrasekolah->tgl_kunjungan }}</td>
                <td>{{ $kunjunganbayibalitaPrasekolah->napas }}</td>
                <td>{{ $kunjunganbayibalitaPrasekolah->batuk }}</td>
                <td>{{ $kunjunganbayibalitaPrasekolah->diare }}</td>
                <td>{{ $kunjunganbayibalitaPrasekolah->jmh_warna_kencing }}</td>
                <td>{{ $kunjunganbayibalitaPrasekolah->warna_kulit }}</td>
                <td>{{ $kunjunganbayibalitaPrasekolah->aktifitas }}</td>
                <td>{{ $kunjunganbayibalitaPrasekolah->hisapan_bayi }}</td>
                <td>{{ $kunjunganbayibalitaPrasekolah->pemberian_makan }}</td>
                <td>{{ $kunjunganbayibalitaPrasekolah->pengingat_periksa_postu }}</td>
                <td>{{ $kunjunganbayibalitaPrasekolah->lapor_nakes }}</td>
            </tr>


        </tbody>
    </table>
</body>

</html>
