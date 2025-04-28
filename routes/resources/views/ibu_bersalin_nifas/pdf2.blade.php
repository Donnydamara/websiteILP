<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3. Checklist Kunjungan Rumah - Ibu Bersalin Nifas</title>
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
            font-size: 70%
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
    <h3>3. Checklist Kunjungan Rumah - Ibu Bersalin Nifas</h3>
    <table>

        <tbody aria-colspan="17">

            <tr>
                <th colspan="3">Nama</th>
                <td colspan="14">{{ $ibubersalinNifas->nama }}</td>
            </tr>
            <tr>
                <th colspan="3">Umur Ibu</th>
                <td colspan="11">{{ $ibubersalinNifas->umur_ibu }}</td>
                <th colspan="3">Tahun</th>
            </tr>
            <tr>
                <th colspan="3">Kelahiran Anak Ke-</th>
                <td colspan="14">{{ $ibubersalinNifas->kelahiran_ke }}</td>
            </tr>
            <tr>
                <th colspan="17">Informasi Persalinan</th>
            </tr>
            <tr>
                <th colspan="3">Tanggal Persalinan</th>
                <td colspan="14">{{ $ibubersalinNifas->tgl_persalinan }}</td>
            </tr>
            <tr>
                <th colspan="3">Pukul Persalinan</th>
                <td colspan="14">{{ $ibubersalinNifas->pukul_persalinan }}</td>
            </tr>
            <tr>
                <th colspan="3">Usia Kehamilan Saat Persalinan</th>
                <td colspan="11">{{ $ibubersalinNifas->usia_kehamilan_persalinan }}</td>
                <th colspan="3">Minggu</th>
            </tr>
            <tr>
                <th colspan="3">Penolong Persalinan</th>
                <td colspan="14">{{ $ibubersalinNifas->penolong_persalinan }}
                    @if ($ibubersalinNifas->penolong_persalinan == 'lainnya')
                        : {{ $ibubersalinNifas->lainya_penolong_persalinan }}
                    @endif
                </td>
            </tr>
            <tr>
                <th colspan="3">Penolong Persalinan</th>
                <td colspan="14">{{ $ibubersalinNifas->tmpt_persalinan }}
                    {{ $ibubersalinNifas->nama_tmpt_persalinan }}</td>
            </tr>
            <tr>
                <th colspan="3">Cara Persalinan</th>
                <td colspan="14">{{ $ibubersalinNifas->cara_persalinan }}
                    @if ($ibubersalinNifas->cara_persalinan == 'lainnya')
                        : {{ $ibubersalinNifas->lainya_cara_persalinan }}
                    @endif
                </td>
            </tr>
            <tr>
                <th colspan="3">Keadaan Ibu Pada Saat Melahirkan</th>
                <td colspan="14">{{ $ibubersalinNifas->keadaan_ibu_persalinan }}</td>
            </tr>
            <tr>
                <th colspan="3">Riwayat Inisiasi Menyusu Dini (IMD)</th>
                <td colspan="14">{{ $ibubersalinNifas->riwayat_imd_persalinan }}</td>
            </tr>
        </tbody>
    </table>
    <div class="page-break"></div>
    <table>
        <tbody>
            {{--  --}}
            <tr>
                <th scope="row" colspan="1" rowspan="2">Kunjungan</th>
                <th scope="row" colspan="1" rowspan="2">Tanggal</th>
                <th scope="row" colspan="1" rowspan="2">Pemantauan Suhu Tubuh</th>
                <th scope="row" colspan="4" rowspan="1">Ibu memeriksa
                    kesehatannya ke
                    posyandu Prima/ Puskesmas/ Fasyankes
                    lainnya atau kunjungan rumah oleh nakes dan
                    untuk melakukan pemeriksaan setelah melahirkann</th>
                <th scope="row" colspan="1" rowspan="2">Isi Priring Ibu Menyusui</th>
                <th scope="row" colspan="2" rowspan="1">Kapsul Vitamil A</th>
                <th scope="row" colspan="1" rowspan="2">Menyusui</th>
                <th scope="row" colspan="1" rowspan="2">KB Pasca Persalinan</th>
                <th scope="row" colspan="1" rowspan="2">Melakukan
                    Skiring Kesehatan</th>
                <th scope="row" colspan="1" rowspan="2">Pemberian Edukasi/ Kunjungan
                    Nakes</th>
            </tr>
            {{--  --}}
            <tr>
                <th>KF1 (6 Jam - 48 Jam)</th>
                <th>KF2 (3 - 7 Hari Pasca Persalinan)</th>
                <th>KF3 (8 - 28 Hari Pasca Persalinan)</th>
                <th>KF4 (29 - 42 Hari Pasca Persalinan)</th>
                <th>ADA</th>
                <th>Waktu Minum</th>

            </tr>
            {{--  --}}

            <tr>
                <td rowspan="3">{{ $ibubersalinNifas->kunjungan }}</td>
                <td rowspan="3">{{ $ibubersalinNifas->tgl_kunjungan }}</td>
                <td rowspan="3">{{ $ibubersalinNifas->suhu_tubuh }}</td>
                <td rowspan="1">Tanggal <br>
                    @if ($ibubersalinNifas->pemeriksaan_kesehatan == 'KF1 (6 Jam - 48 Jam)')
                        {{ $ibubersalinNifas->tgl_pk }}
                    @endif
                </td>
                <td rowspan="1">Tanggal <br>
                    @if ($ibubersalinNifas->pemeriksaan_kesehatan == 'KF2 (3 - 7 Hari Pasca Persalinan)')
                        {{ $ibubersalinNifas->tgl_pk }}
                    @endif
                </td>
                <td rowspan="1">Tanggal <br>
                    @if ($ibubersalinNifas->pemeriksaan_kesehatan == 'KF3 (8 - 28 Hari Pasca Persalinan)')
                        {{ $ibubersalinNifas->tgl_pk }}
                    @endif
                </td>
                <td rowspan="1">Tanggal <br>
                    @if ($ibubersalinNifas->pemeriksaan_kesehatan == 'KF4 (29 - 42 Hari Pasca Persalinan)')
                        {{ $ibubersalinNifas->tgl_pk }}
                    @endif
                </td>
                <td rowspan="3">{{ $ibubersalinNifas->porsi }}</td>
                <td rowspan="3">{{ $ibubersalinNifas->ada_kva }}</td>
                <td rowspan="3">{{ $ibubersalinNifas->wkt_minum_kva }}</td>
                <td rowspan="3">{{ $ibubersalinNifas->menyusui }}</td>
                <td rowspan="3">{{ $ibubersalinNifas->kb_pasca_persalinan }}</td>
                <td rowspan="1">Tanggal <br>{{ $ibubersalinNifas->skrining_kesehatan }}</td>
                <td rowspan="3">{{ $ibubersalinNifas->edukasi_kunjungan }}</td>

            </tr>
            {{--  --}}
            <tr>
                <td rowspan="1">Tempat <br>
                    @if ($ibubersalinNifas->pemeriksaan_kesehatan == 'KF1 (6 Jam - 48 Jam)')
                        {{ $ibubersalinNifas->tempat_pk }}
                    @endif
                </td>
                <td rowspan="1">Tempat <br>
                    @if ($ibubersalinNifas->pemeriksaan_kesehatan == 'KF2 (3 - 7 Hari Pasca Persalinan)')
                        {{ $ibubersalinNifas->tempat_pk }}
                    @endif
                </td>
                <td rowspan="1">Tempat <br>
                    @if ($ibubersalinNifas->pemeriksaan_kesehatan == 'KF3 (8 - 28 Hari Pasca Persalinan)')
                        {{ $ibubersalinNifas->tempat_pk }}
                    @endif
                </td>
                <td rowspan="1">Tempat <br>
                    @if ($ibubersalinNifas->pemeriksaan_kesehatan == 'KF4 (29 - 42 Hari Pasca Persalinan)')
                        {{ $ibubersalinNifas->tempat_pk }}
                    @endif
                </td>
                <td rowspan="1">Tempat <br> {{ $ibubersalinNifas->skrining_kesehatan_tmp }}</td>

            </tr>
            {{--  --}}
            <tr>
                <td rowspan="1">Petugas <br>
                    @if ($ibubersalinNifas->pemeriksaan_kesehatan == 'KF1 (6 Jam - 48 Jam)')
                        {{ $ibubersalinNifas->petugas_pk }}
                    @endif
                </td>
                <td rowspan="1">Petugas <br>
                    @if ($ibubersalinNifas->pemeriksaan_kesehatan == 'KF2 (3 - 7 Hari Pasca Persalinan)')
                        {{ $ibubersalinNifas->petugas_pk }}
                    @endif
                </td>
                <td rowspan="1">Petugas <br>
                    @if ($ibubersalinNifas->pemeriksaan_kesehatan == 'KF3 (8 - 28 Hari Pasca Persalinan)')
                        {{ $ibubersalinNifas->petugas_pk }}
                    @endif
                </td>
                <td rowspan="1">Petugas <br>
                    @if ($ibubersalinNifas->pemeriksaan_kesehatan == 'KF4 (29 - 42 Hari Pasca Persalinan)')
                        {{ $ibubersalinNifas->petugas_pk }}
                    @endif
                </td>
                <td rowspan="1">Petugas <br> {{ $ibubersalinNifas->skrining_kesehatan_petugas }}</td>


            </tr>
            {{--  --}}

        </tbody>
    </table>

    <table>

        <tbody>
            <tr>
                <th scope="row" colspan="13" rowspan="1">Tanda Bahaya Pada Bayi 0 - 2 Bulan</th>
                <th scope="row" colspan="1" rowspan="2">Mengingatkan Periksa Ke Postu/ Fasyankes</th>
                <th scope="row" colspan="1" rowspan="2">Melaporkan Ke Nakes</th>
            </tr>
            <tr>
                <th>Demam</th>
                <th>Ada perasaan bersalah, mudah
                    menangis, kehilangan minat, gelisah, gangguan
                    tidur,
                    gangguan konsentrasi</th>
                <th>Tidak bisa BAK, BAK sedikit tapi
                    sering, terasa panas, nyeri panggul, urin keluar
                    tanpa disadari</th>
                <th>Nafas pendek dan terengah-engah,
                    nafas dangkal disertasi nyeri dada, nafas
                    berat, batuk lebih dari 2 (dua) hari</th>
                <th>Payudara bengkak kemerahan
                    disertai nyeri, benjolan disertai nyeri ada
                    keluhan dalam menyusul</th>
                <th>Sakit Kepala</th>
                <th>Pendarahan (pembalut basah dalam
                    5 menit)</th>
                <th>Area sekitar kelamin bengkak
                    atau
                    nyeri atau ada luka terbuka</th>
                <th>Keluar cairan dari dalam jalan
                    lahir</th>
                <th>Pandangan Kabur</th>
                <th>Darah nifas berbau atau mengalir
                    atau ada nyeri pada perut bawah</th>
                <th>Keputihan berlebih. berwarna dan
                    berbau</th>
                <th>Jantung Berdebar</th>

            </tr>

            <tr>
                <td>{{ $ibubersalinNifas->demam }}</td>
                <td>{{ $ibubersalinNifas->perasaan }}</td>
                <td>{{ $ibubersalinNifas->sakit }}</td>
                <td>{{ $ibubersalinNifas->pernafasan }}</td>
                <td>{{ $ibubersalinNifas->payudara }}</td>
                <td>{{ $ibubersalinNifas->sakit_kepala }}</td>
                <td>{{ $ibubersalinNifas->pendarahan }}</td>
                <td>{{ $ibubersalinNifas->sakit_bagian_kelamin }}</td>
                <td>{{ $ibubersalinNifas->keluar_cairan }}</td>
                <td>{{ $ibubersalinNifas->pandangan_kabur }}</td>
                <td>{{ $ibubersalinNifas->darah_nifas }}</td>
                <td>{{ $ibubersalinNifas->keputihan }}</td>
                <td>{{ $ibubersalinNifas->jantung_berdebar }}</td>
                <td>{{ $ibubersalinNifas->pengingat_periksa_postu }}</td>
                <td>{{ $ibubersalinNifas->tgl_laporan_nakes }}</td>

            </tr>


        </tbody>
    </table>
</body>

</html>
