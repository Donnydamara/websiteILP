@extends('layouts/master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Detail Kunjungan Bayi Dan Anak Usia Prasekolah') }}</h1>

    <!-- Main Content goes here -->
    {{-- <a href="{{ route('ibu_hamil.createdetail') }}" class="btn btn-sm btn-info ml-2">Tambah Detail</a> --}}
    {{-- <a href="{{ route('kunjungan_bayi_balita_prasekolah.createdetail', ['id' => $dataKK->id]) }}"
        class="btn btn-sm btn-info ml-2">Tambah
        Detail</a>
    <a href="{{ route('kunjunganbayibalitaPrasekolah.pdf', ['id' => $dataKK->id]) }}" class="btn btn-primary"
        target="_blank">Download PDF</a>
    <a href="{{ route('kunjungan_bayi_balita_prasekolah.index') }}" class="btn btn-primary mb-3">Kembali</a> --}}

    <div class="row mb-3">
        <div class="col text-center">
            <!-- Tombol Tambah untuk role 'kader' -->
            @if (Auth::check() && Auth::user()->role == 'kader')
                <button class="btn btn-primary mb-2"
                    onclick="window.location.href='{{ route('kunjungan_bayi_balita_prasekolah.createdetail', ['id' => $dataKK->id]) }}'">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path fill="none" d="M0 0h24v24H0z"></path>
                            <path fill="currentColor" d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z"></path>
                        </svg>
                        Tambah Data
                    </span>
                </button>
            @endif

            <!-- Tombol Kembali -->
            <a href="{{ route('kunjungan_bayi_balita_prasekolah.index') }}" class="btn btn-primary mb-2">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>

            <!-- Tombol Download PDF -->
            <a href="{{ route('kunjunganbayibalitaPrasekolah.pdf', ['id' => $dataKK->id]) }}" target="_blank"
                class="btn btn-info mb-2">
                <div class="docs">
                    <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2"
                        stroke="currentColor" height="20" width="20" viewBox="0 0 24 24">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line y2="13" x2="8" y1="13" x1="16"></line>
                        <line y2="17" x2="8" y1="17" x1="16"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                    All PDF
                </div>
                <div class="download">
                    <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2"
                        stroke="currentColor" height="24" width="24" viewBox="0 0 24 24">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line y2="3" x2="12" y1="15" x1="12"></line>
                    </svg>
                </div>
            </a>

            <!-- Tombol Export ke Excel -->
            <a href="{{ route('kunjungan_bayi_balita_prasekolah.show_export', ['id' => $dataKK->id, 'export' => true]) }}"
                class="btn btn-success mb-2">
                <i class="fas fa-file-excel"></i> Export Excel
            </a>
        </div>
    </div>

    @if (session('success'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: '{{ session('success') }}',
                });
            });
        </script>
    @endif

    <div class="table-responsive" style="text-align: center">
        <table class="table table-bordered table-striped" id="dataTable">
            <thead>
                <tr>
                    <th style="text-align: center">No</th>
                    <th style="text-align: center">Kartu Keluarga</th>
                    <th style="text-align: center">Nama</th>
                    <th style="text-align: center">NIK</th>
                    <th style="text-align: center">Kunjungan</th>
                    <th style="text-align: center">Jenis Kelamin</th>
                    <th style="text-align: center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($familyMembers->isNotEmpty())
                    @foreach ($familyMembers as $member)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dataKK->kk }}</td>
                            <td>{{ $member->nama }}</td>
                            <td>{{ $member->nik }}</td>
                            <td>{{ $member->kunjungan }}</td>
                            <td>{{ $member->gender }}</td>
                            <td>
                                <div class="d-flex">
                                    @if (Auth::check() && Auth::user()->role == 'kader')
                                        <form
                                            action="{{ route('kunjungan_bayi_balita_prasekolah.editdetail', ['id' => $member->id]) }}"
                                            method="GET" style="display:inline;">
                                            @csrf
                                            <button class="edit">
                                                Edit
                                                <span></span>
                                            </button>
                                        </form>

                                        <form
                                            action="{{ route('kunjungan_bayi_balita_prasekolah.destroy2', ['id' => $member->id]) }}"
                                            method="post" class="delete-form">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="delete">
                                                <span class="delete__text">Delete</span>
                                                <span class="delete__icon">
                                                    <svg class="svg" height="512" viewBox="0 0 512 512" width="512"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <title></title>
                                                        <path
                                                            d="M112,112l20,320c.95,18.49,14.4,32,32,32H348c17.67,0,30.87-13.51,32-32l20-320"
                                                            style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px">
                                                        </path>
                                                        <line
                                                            style="stroke:#fff;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px"
                                                            x1="80" x2="432" y1="112" y2="112">
                                                        </line>
                                                        <path
                                                            d="M192,112V72h0a23.93,23.93,0,0,1,24-24h80a23.93,23.93,0,0,1,24,24h0v40"
                                                            style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px">
                                                        </path>
                                                        <line
                                                            style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"
                                                            x1="256" x2="256" y1="176" y2="400">
                                                        </line>
                                                        <line
                                                            style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"
                                                            x1="184" x2="192" y1="176" y2="400">
                                                        </line>
                                                        <line
                                                            style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"
                                                            x1="328" x2="320" y1="176" y2="400">
                                                        </line>
                                                    </svg>
                                                </span>
                                            </button>
                                        </form>
                                    @endif




                                    <form method="GET" style="display:inline;">
                                        @csrf
                                        <button type="button" class="custom-btn btn-2" data-toggle="modal"
                                            data-target="#detailModal{{ $member->id }}">
                                            Detail
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="detailModal{{ $member->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Detail Kunjungan
                                                            Bayi Dan
                                                            Anak Usia Prasekolah
                                                        </h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Card View Content -->
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <!-- Table Content -->
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered">
                                                                        <tbody aria-colspan="6">
                                                                            <tr>
                                                                                <th scope="row">Status
                                                                                    Kunjungan Bayi,
                                                                                    Balita,
                                                                                    Dan Usia Prasekolah</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->status }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">No Kartu Keluarga</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->kk }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">NIK</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->nik }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Nama</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->nama }}</td>
                                                                            </tr>

                                                                            <tr>
                                                                                <th scope="row">Tanggal Lahir</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->tgl_lahir }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Tempat Lahir</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->tmp_lahir }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Jenis Kelamin</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->gender }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Kunjungan</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->kunjungan }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Tanggal Kunjungan</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->tgl_kunjungan }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Pemantauan Suhu <br>
                                                                                    Tubuh
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->suhu_tubuh }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Ada Buku KIA</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->buku_kia }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" rowspan="4">Tanggal
                                                                                    Terakhir Di Timbang</th>

                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" scope="row"
                                                                                    colspan="1">
                                                                                    Tanggal Timbang Ukur</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->tgl_timbang_ukur }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Tempat Timbang Ukur</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->tempat_timbang_ukur }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Petugas Timbang Ukur
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->petugas_timbang_ukur }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" rowspan="4">Hasil
                                                                                    Penimbangan Dan Pengukuran
                                                                                </th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">

                                                                                    BB</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->bb_hasil_timbang_ukur }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">

                                                                                    PB/TB</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->pb_tb_hasil_timbang_ukur }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">

                                                                                    LK</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->lk_hasil_timbang_ukur }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" rowspan="32">Jenis
                                                                                    Imunisasi
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    Usia 0 Bulan</td>
                                                                            </tr>
                                                                            {{-- bulan 0 --}}

                                                                            <tr>
                                                                                <th scope="row" colspan="1">
                                                                                    Hepatitis B
                                                                                    (<24 Jam) </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->hepatitis_b_0bulan ?? '-' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">BCG
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->bcg_0bulan ?? '-' }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">Polio
                                                                                    Tetes
                                                                                    1
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->polio_0bulan ?? '-' }}</td>
                                                                            </tr>
                                                                            {{-- 1 --}}
                                                                            <tr>
                                                                                <td scope="row" colspan="4">
                                                                                    Usia 1 Bulan</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">BCG</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->bcg_1bulan ?? '-' }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">Polio
                                                                                    Tetes
                                                                                    1
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->polio_1bulan ?? '-' }}</td>
                                                                            </tr>
                                                                            {{-- 2 --}}
                                                                            <tr>
                                                                                <td scope="row" colspan="4">
                                                                                    Usia 2 Bulan</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">
                                                                                    DPT-HB-Hib
                                                                                    (1-2
                                                                                    bln)</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->dpt_hb_hib_1_2bulan ?? '-' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">Polio
                                                                                    Tetes
                                                                                    (1-2
                                                                                    bln)</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->polio_2_2bulan ?? '-' }}
                                                                                </td>
                                                                            </tr>

                                                                            <tr>
                                                                                <th scope="row" colspan="1">PCV (1-2
                                                                                    bln)
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->pcv_1_2bulan ?? '-' }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">RV (1-2
                                                                                    bln)
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->rv_1_2bulan ?? '-' }}</td>
                                                                            </tr>
                                                                            {{-- bulan 3 --}}
                                                                            <tr>
                                                                                <td scope="row" colspan="4">
                                                                                    Usia 3 Bulan</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">
                                                                                    DPT-HB-Hib
                                                                                    (2-3
                                                                                    bln)</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->dpt_hb_hib_2_3bulan ?? '-' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">Polio
                                                                                    Tetes
                                                                                    (2-3
                                                                                    bln)</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->polio_3_3bulan ?? '-' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">PCV (2-3
                                                                                    bln)
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->pcv_2_3bulan ?? '-' }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">RV (2-3
                                                                                    bln)
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->rv_2_3bulan ?? '-' }}</td>
                                                                            </tr>
                                                                            {{-- bulan 4 --}}
                                                                            <tr>
                                                                                <td scope="row" colspan="4">
                                                                                    Usia 4 Bulan</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">
                                                                                    DPT-HB-Hib
                                                                                    (3-4
                                                                                    bln)</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->dpt_hb_hib_3_4bulan ?? '-' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">Polio
                                                                                    Tetes
                                                                                    (3-4
                                                                                    bln)</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->polio_4_4bulan ?? '-' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">Polio
                                                                                    Suntik
                                                                                    (4
                                                                                    bln)</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->polio_suntik_4bulan ?? '-' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">RV (3-4
                                                                                    bln)
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->rv_3_4bulan ?? '-' }}</td>
                                                                            </tr>
                                                                            {{-- bulan 9 --}}
                                                                            <tr>
                                                                                <td scope="row" colspan="4">
                                                                                    Usia 9 Bulan</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">Campak
                                                                                    Rubella
                                                                                    (9 bln)</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->campak_rubelia_9bulan ?? '-' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">Polio
                                                                                    Suntik
                                                                                    (9
                                                                                    bln)</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->polio_suntik_2_9bulan ?? '-' }}
                                                                                </td>
                                                                            </tr>
                                                                            {{-- 10 --}}
                                                                            <tr>
                                                                                <td scope="row" colspan="4">
                                                                                    Usia 1 Bulan</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">JE (10
                                                                                    bln)
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->je_10bulan ?? '-' }}</td>
                                                                            </tr>
                                                                            {{-- 12 --}}
                                                                            <tr>
                                                                                <td scope="row" colspan="4">
                                                                                    Usia 12 Bulan</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">PCV (12
                                                                                    bln)
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->pv_3_12bulan ?? '-' }}</td>
                                                                            </tr>
                                                                            {{-- 18 --}}
                                                                            <tr>
                                                                                <td scope="row" colspan="4">
                                                                                    Usia 18 Bulan</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">DPT
                                                                                    Lanjutan
                                                                                    (18
                                                                                    bln)</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->dpt_lanjut_1_18bulan ?? '-' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">Campak
                                                                                    Lanjutan
                                                                                    (18 bln)</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->campak_lanjut_18bulan ?? '-' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" rowspan="6">
                                                                                    Pemberian
                                                                                    Makanan Pendamping ASI Kaya Protein
                                                                                    Hewani
                                                                                </th>
                                                                            </tr>

                                                                            <tr>
                                                                                <th scope="row" colspan="1">Makanan
                                                                                    Pokok
                                                                                    (Beras/Kentang/Jagung)</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->makanan_pokok }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">Makanan
                                                                                    Sumber
                                                                                    Protein Hewani
                                                                                    (Telur/Ikan/Ayam/Daging/Udang/Hati/Susu
                                                                                    Dan
                                                                                    Produk Olahan)</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->makanan_protein_hewan }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">Makanan
                                                                                    Sumber
                                                                                    Protein Nabati (Tahu/Tempe/Kacang
                                                                                    Hijau/Kacang Panjang)</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->makanan_protein_nabati }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">Makanan
                                                                                    Lemak
                                                                                    (Minyak/Santan)</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->makanan_lemak }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">Sayur
                                                                                    Dan
                                                                                    Buah
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->sayur_buah }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" rowspan="3">Obat
                                                                                    Cacing
                                                                                </th>

                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">Ada</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->oc_ada }}</td>
                                                                            </tr>

                                                                            <tr>
                                                                                <th scope="row" colspan="1">Tanggal
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->oc_tgl }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" rowspan="4">Kapsul
                                                                                    Vitamin A
                                                                                </th>

                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">Jenis
                                                                                    Kunjungan
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->kv_jenis }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">Tanggal
                                                                                    Mulai Kunjungan</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->tgl_kv_mulai }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">Tanggal
                                                                                    Selesai Kunjungan
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->tgl_kv_selesai }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" rowspan="3">Makanan
                                                                                    Tambahan Pangan Lokal Bagi Balita Dengan
                                                                                    Masalah Gizi
                                                                                </th>

                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">Ada</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->makan_tambah_ada }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">
                                                                                    Kepatuhan
                                                                                    Konsumsi
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->makan_tambah_kepatuhan }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Edukasi</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->edukasi }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" rowspan="9">Tanda
                                                                                    Bahaya
                                                                                    Pada Bayi 2 - 60 Bulan
                                                                                </th>

                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Napas</th>
                                                                                <td>{{ $member->napas }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Batuk</th>
                                                                                <td>{{ $member->batuk }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Diare</th>
                                                                                <td>{{ $member->diare }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Jumlah dan Warna Kencing
                                                                                </th>
                                                                                <td>{{ $member->jmh_warna_kencing }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Warna Kulit</th>
                                                                                <td>{{ $member->warna_kulit }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Aktifitas</th>
                                                                                <td>{{ $member->aktifitas }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Hisapan Bayi</th>
                                                                                <td>{{ $member->hisapan_bayi }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Pemberian Makan</th>
                                                                                <td>{{ $member->pemberian_makan }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Mengingatkan Periksa Ke
                                                                                    Postu/ Fasyankes
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->pengingat_periksa_postu }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Lapor Nakes</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->lapor_nakes }}</td>
                                                                            </tr>

                                                                        </tbody>



                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                    <a href="{{ route('kunjunganbayibalitaPrasekolah.tbc.pdf2', $member->id) }}"
                                        class="action_has has_saved" aria-label="save" type="button" target="_blank">
                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20"
                                            height="20" stroke-linejoin="round" stroke-linecap="round"
                                            stroke-width="2" viewBox="0 0 24 24" stroke="currentColor" fill="none">
                                            <path d="m19,21H5c-1.1,0-2-.9-2-2V5c0-1.1.9-2,2-2h11l5,5v11c0,1.1-.9,2-2,2Z"
                                                stroke-linejoin="round" stroke-linecap="round" data-path="box"></path>
                                            <path d="M7 3L7 8L15 8" stroke-linejoin="round" stroke-linecap="round"
                                                data-path="line-top"></path>
                                            <path d="M17 20L17 13L7 13L7 20" stroke-linejoin="round"
                                                stroke-linecap="round" data-path="line-bottom">
                                            </path>
                                        </svg></a>
                    @endforeach
                @else
                    <tr>
                        <td colspan="11">No family members found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>


    <!-- End of Main Content -->
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('.delete-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    const formElement = this;
                    Swal.fire({
                        title: 'Apakah Kamu Yakin?',
                        text: "Menghapus Data!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            formElement.submit();
                        }
                    });
                });
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('.delete-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    const formElement = this;
                    Swal.fire({
                        title: 'Apakah Kamu Yakin?',
                        text: "Menghapus Data!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            formElement.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
