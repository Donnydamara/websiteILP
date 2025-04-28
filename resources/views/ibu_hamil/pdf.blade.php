<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2. Checklist Kunjungan Rumah - Ibu Hamil</title>
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
            font-size: 50%
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
    <h3>2. Checklist Kunjungan Rumah - Ibu Hamil</h3>
    <table>

        <tbody aria-colspan="17">
            @if ($ibuHamil->isNotEmpty())
                <tr>
                    <th colspan="3">Nama</th>
                    <td colspan="4">{{ $ibuHamil[0]->nama }}</td>
                    <th colspan="3">Kehamilan Anak Ke</th>
                    <td colspan="8">{{ $ibuHamil[0]->kehamilan_ke }}</td>
                </tr>
                <tr>
                    <th colspan="3">Umur Ibu</th>
                    <td colspan="4">{{ $ibuHamil[0]->umur }}</td>
                    <th colspan="3">Jarak Kehamilan Dengan <br> Kehamilan Sebelumnya</th>
                    <td colspan="5">
                        @if ($ibuHamil[0]->jarak_kehamilan_unit === 'bulan')
                            {{ $ibuHamil[0]->jarak_kehamilan_bulan }} Bulan
                        @elseif($ibuHamil[0]->jarak_kehamilan_unit === 'tahun')
                            {{ $ibuHamil[0]->jarak_kehamilan_tahun }} Tahun
                        @else
                            Tidak ada data
                        @endif
                    </td>

                    <th colspan="3">Tahun/Bulan</th>
                </tr>
            @endif
            {{--  --}}
            <tr>
                <th scope="row" colspan="1" rowspan="3">Kunjungan</th>
                <th scope="row" colspan="1" rowspan="3">Tanggal</th>
                <th scope="row" colspan="1" rowspan="3">Pemantauan Suhu Tubuh</th>
                <th scope="row" colspan="1" rowspan="3">Ada Buku KIA</th>
                <th scope="row" colspan="6" rowspan="1">Ibu Memeriksakan Kehamilan</th>
                <th scope="row" colspan="1" rowspan="3">Isi Piringku Untuk Ibu Hamil</th>
                <th scope="row" colspan="2" rowspan="2">TTD</th>
                <th scope="row" colspan="1" rowspan="3">Lila <23,5 cm </th>
                <th scope="row" colspan="1" rowspan="3">PMT Untuk Bumil KEK</th>
                <th scope="row" colspan="1" rowspan="3">Mengikuti Kelas Ibu Hamil Terakhir</th>
                <th scope="row" colspan="1" rowspan="3">Melakukan Skrining Kesehatan Jiwa</th>
                <th scope="row" colspan="1" rowspan="3">Pemberian Edukasi / Kunjungan Nakes</th>
            </tr>
            {{--  --}}
            <tr>
                <th colspan="1">Trimester I (1 Kali Pada Umur Kehamilan Hinggal 12 Minggu)</th>
                <th colspan="2">Trimester II (2 Kali Pada Umur Kehamilan Diatas 12 - 24 Minggu)</th>
                <th colspan="3">Trimester III (3 Kali Pada Umur Kehamilan Diatas 24 - 40 Minggu)</th>
            </tr>
            {{--  --}}
            <tr>
                <th>K1</th>
                <th>K2</th>
                <th>K3</th>
                <th>K4</th>
                <th>K5</th>
                <th>K6</th>
                <th colspan="1">Ada</th>
                <th colspan="1">Minum Hari Ini / Dalam 24 Jam Terakhir</th>
            </tr>
            {{--  --}}
            @foreach ($ibuHamil as $member)
                <tr>
                    <td rowspan="3">{{ $member->kunjungan }}</td>
                    <td rowspan="3">{{ $member->tgl_kunjungan }}</td>
                    <td rowspan="3">{{ $member->suhu_tubuh }}</td>
                    <td rowspan="3">{{ $member->kia }}</td>
                    <td rowspan="1">Tanggal <br>
                        @if ($member->jenis_imk == 'K1 (Trimester I (1 kali pada umur kehamilan hingga 12 minggu))')
                            {{ $member->tgl_imk }}
                        @endif
                    </td>
                    <td rowspan="1">Tanggal <br>
                        @if ($member->jenis_imk == 'K2 (Trimester II (2 kali pada umur kehamilan hingga 12 - 24 minggu))')
                            {{ $member->tgl_imk }}
                        @endif
                    </td>
                    <td rowspan="1">Tanggal <br>
                        @if ($member->jenis_imk == 'K3 (Trimester II (2 kali pada umur kehamilan hingga 12 - 24 minggu))')
                            {{ $member->tgl_imk }}
                        @endif
                    </td>
                    <td rowspan="1">Tanggal <br>
                        @if ($member->jenis_imk == 'K4 (Trimester III (3 kali pada umur kehamilan hingga 24 - 40 minggu))')
                            {{ $member->tgl_imk }}
                        @endif
                    </td>
                    <td rowspan="1">Tanggal <br>
                        @if ($member->jenis_imk == 'K5 (Trimester III (3 kali pada umur kehamilan hingga 24 - 40 minggu))')
                            {{ $member->tgl_imk }}
                        @endif
                    </td>
                    <td rowspan="1">Tanggal <br>
                        @if ($member->jenis_imk == 'K6 (Trimester III (3 kali pada umur kehamilan hingga 24 - 40 minggu))')
                            {{ $member->tgl_imk }}
                        @endif
                    </td>
                    <td rowspan="3">{{ $member->porsi }}</td>
                    <td rowspan="3">{{ $member->ada_ttd }}</td>
                    <td rowspan="3">{{ $member->minum_ttd }}</td>
                    <td rowspan="3">{{ $member->lila }}</td>
                    <td rowspan="3">{{ $member->pmt }}</td>
                    <td rowspan="1">Tanggal <br> {{ $member->kls_ibu_hamil }}</td>
                    <td rowspan="1">Tanggal <br> {{ $member->kls_skrining_kesehatan }}</td>
                    <td rowspan="3">Tanggal <br> {{ $member->edukasi }}</td>

                </tr>
                {{--  --}}
                <tr>
                    <td rowspan="1">Tempat <br>
                        @if ($member->jenis_imk == 'K1 (Trimester I (1 kali pada umur kehamilan hingga 12 minggu))')
                            {{ $member->tempat_imk }}
                        @endif
                    </td>
                    <td rowspan="1">Tempat <br>
                        @if ($member->jenis_imk == 'K2 (Trimester II (2 kali pada umur kehamilan hingga 12 - 24 minggu))')
                            {{ $member->tempat_imk }}
                        @endif
                    </td>
                    <td rowspan="1">Tempat <br>
                        @if ($member->jenis_imk == 'K3 (Trimester II (2 kali pada umur kehamilan hingga 12 - 24 minggu))')
                            {{ $member->tempat_imk }}
                        @endif
                    </td>
                    <td rowspan="1">Tempat <br>
                        @if ($member->jenis_imk == 'K4 (Trimester III (3 kali pada umur kehamilan hingga 24 - 40 minggu))')
                            {{ $member->tempat_imk }}
                        @endif
                    </td>
                    <td rowspan="1">Tempat <br>
                        @if ($member->jenis_imk == 'K5 (Trimester III (3 kali pada umur kehamilan hingga 24 - 40 minggu))')
                            {{ $member->tempat_imk }}
                        @endif
                    </td>
                    <td rowspan="1">Tempat <br>
                        @if ($member->jenis_imk == 'K6 (Trimester III (3 kali pada umur kehamilan hingga 24 - 40 minggu))')
                            {{ $member->tempat_imk }}
                        @endif
                    </td>
                    <td rowspan="1">Tempat <br> {{ $member->tempat_ibu_hamil }}</td>
                    <td rowspan="1">Tempat <br> {{ $member->tempat_skrining_kesehatan }}</td>
                </tr>
                {{--  --}}
                <tr>
                    <td rowspan="1">Petugas <br>
                        @if ($member->jenis_imk == 'K1 (Trimester I (1 kali pada umur kehamilan hingga 12 minggu))')
                            {{ $member->petugas_imk }}
                        @endif
                    </td>
                    <td rowspan="1">Petugas <br>
                        @if ($member->jenis_imk == 'K2 (Trimester II (2 kali pada umur kehamilan hingga 12 - 24 minggu))')
                            {{ $member->petugas_imk }}
                        @endif
                    </td>
                    <td rowspan="1">Petugas <br>
                        @if ($member->jenis_imk == 'K3 (Trimester II (2 kali pada umur kehamilan hingga 12 - 24 minggu))')
                            {{ $member->petugas_imk }}
                        @endif
                    </td>
                    <td rowspan="1">Petugas <br>
                        @if ($member->jenis_imk == 'K4 (Trimester III (3 kali pada umur kehamilan hingga 24 - 40 minggu))')
                            {{ $member->petugas_imk }}
                        @endif
                    </td>
                    <td rowspan="1">Petugas <br>
                        @if ($member->jenis_imk == 'K5 (Trimester III (3 kali pada umur kehamilan hingga 24 - 40 minggu))')
                            {{ $member->petugas_imk }}
                        @endif
                    </td>
                    <td rowspan="1">Petugas <br>
                        @if ($member->jenis_imk == 'K6 (Trimester III (3 kali pada umur kehamilan hingga 24 - 40 minggu))')
                            {{ $member->petugas_imk }}
                        @endif
                    </td>
                    <td rowspan="1">Pendamping <br> {{ $member->pendamping_ibu_hamil }}</td>
                    <td rowspan="1">Pendamping <br> {{ $member->petugas_skrining_kesehatan }}</td>
                </tr>
                {{--  --}}
            @endforeach

        </tbody>
    </table>
    <div class="page-break"></div>
    <!-- Mulai tabel baru pada halaman kedua -->
    <h3>2. Checklist Kunjungan Rumah - Ibu Hamil (Lembar Dua)</h3>
    <table>

        <tbody>
            <tr>
                <th scope="row" colspan="1" rowspan="2">Wkatu Kunjungan</th>
                <th scope="row" colspan="1" rowspan="2">Tanggal</th>
                <th scope="row" colspan="10" rowspan="1">Tanda Bahaya Pada Kehamilan</th>
                <th scope="row" colspan="1" rowspan="2">Mengingatkan Periksa Ke Postu/ Fasyankes</th>
                <th scope="row" colspan="1" rowspan="2">Melaporkan Ke Nakes</th>
            </tr>
            <tr>
                <th>Demam Lebih Dari Dua Hari</th>
                <th>Pusing / Sakit Kepala Berat</th>
                <th>Sulit Tidur / Cemas Berlebih</th>
                <th>Diare Berulang</th>
                <th>Resiko TBC</th>
                <th>Tidak Ada Gerakan Janin</th>
                <th>Jantung Berdebar-Debar Atau Nyeri Pada Dada</th>
                <th>Keluar Cairan Dari Jalan Lahir</th>
                <th>Sakit Saat Kencing Manis</th>
                <th>Nyeri Perut Hebat</th>

            </tr>
            @foreach ($ibuHamil as $member)
                <tr>
                    <td>{{ $member->kunjungan }}</td>
                    <td>{{ $member->tgl_kunjungan }}</td>
                    <td>{{ $member->demam_l2 }}</td>
                    <td>{{ $member->sakit_kepala_l2 }}</td>
                    <td>{{ $member->sulit_tidur_l2 }}</td>
                    <td>{{ $member->diare_l2 }}</td>
                    <td>{{ $member->tbc_l2 }}</td>
                    <td>{{ $member->gerakan_janin_l2 }}</td>
                    <td>{{ $member->jantung_sakit_l2 }}</td>
                    <td>{{ $member->keluar_cairan_l2 }}</td>
                    <td>{{ $member->kencing_manis_l2 }}</td>
                    <td>{{ $member->nyeri_perut_l2 }}</td>
                    <td>{{ $member->periksa_l2 }}</td>
                    <td>{{ $member->lapor_nakes }}</td>

                </tr>
            @endforeach

        </tbody>
    </table>
</body>

</html>
