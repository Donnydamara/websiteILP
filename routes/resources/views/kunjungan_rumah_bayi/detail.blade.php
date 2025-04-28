@extends('layouts/master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Detail Kunjungan Rumah Bayi') }}</h1>

    <!-- Main Content goes here -->
    {{-- <a href="{{ route('ibu_hamil.createdetail') }}" class="btn btn-sm btn-info ml-2">Tambah Detail</a> --}}
    {{-- <a href="{{ route('kunjungan_rumah_bayi.createdetail', ['id' => $dataKK->id]) }}" class="btn btn-sm btn-info ml-2">Tambah
        Detail</a>
    <a href="{{ route('kunjunganrumahBayi.pdf', ['id' => $dataKK->id]) }}" class="btn btn-primary" target="_blank">Download
        PDF</a>
    <a href="{{ route('kunjungan_rumah_bayi.index') }}" class="btn btn-primary mb-3">Kembali</a> --}}
    <div class="row mb-3">
        <div class="col text-center">
            <!-- Tombol Tambah (untuk role 'kader') -->
            @if (Auth::check() && Auth::user()->role == 'kader')
                <button class="btn btn-primary mb-2"
                    onclick="window.location.href='{{ route('kunjungan_rumah_bayi.createdetail', ['id' => $dataKK->id]) }}'">
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
            <form action="{{ route('kunjungan_rumah_bayi.index') }}" method="GET" style="display:inline;">
                @csrf
                <button class="btn btn-secondary mb-2" type="submit">
                    <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1"
                        viewBox="0 0 1024 1024">
                        <path
                            d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z">
                        </path>
                    </svg>
                    <span>Kembali</span>
                </button>
            </form>

            <!-- Tombol PDF -->
            <a href="{{ route('kunjunganrumahBayi.pdf', ['id' => $dataKK->id]) }}" target="_blank"
                class="btn btn-info mb-2">
                <i class="fas fa-file-pdf"></i> Download PDF
            </a>

            <!-- Tombol Export ke Excel -->
            <a href="{{ route('kunjungan_rumah_bayi.show_export', ['id' => $dataKK->id, 'export' => true]) }}"
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
                                            action="{{ route('kunjungan_rumah_bayi.editdetail', ['id' => $member->id]) }}"
                                            method="GET" style="display:inline;">
                                            @csrf
                                            <button class="edit">
                                                Edit
                                                <span></span>
                                            </button>
                                        </form>

                                        <form action="{{ route('kunjungan_rumah_bayi.destroy2', ['id' => $member->id]) }}"
                                            method="post" class="delete-form">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="delete">
                                                <span class="delete__text">Hapus</span>
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
                                                            Rumah
                                                            Bayi
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
                                                                                    Kunjungan Rumah Bayi
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->status }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">No Kartu
                                                                                    Keluarga</th>
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
                                                                                <th scope="row">Tanggal Lahir
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->tgl_lahir }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Tempat Lahir
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->tmp_lahir }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Jenis Kelamin
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->gender }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Kunjungan</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->kunjungan }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Tanggal
                                                                                    Kunjungan</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->tgl_kunjungan }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Suhu Tubuh
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->suhu }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Buku KIA</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->buku_kia }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">ASI Ekslusif</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->asi }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" rowspan="4">Tanggal
                                                                                    Terakhir Di Timbang Dan Diukur</th>

                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">Tanggal
                                                                                </th>
                                                                                <td scope="row" colspan="2">
                                                                                    {{ $member->tgl_timbang }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">Tempat
                                                                                </th>
                                                                                <td scope="row" colspan="2">
                                                                                    {{ $member->tmp_timbang }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">Petugas
                                                                                </th scope="row" colspan="4">
                                                                                <td>{{ $member->petugas_timbang }}</td>
                                                                            </tr>
                                                                            <tr aria-colspan="4">
                                                                                <th scope="row" rowspan="3"
                                                                                    colspan="1"> Hasil
                                                                                    Penimbangan Dan Pengukuran</th>
                                                                                <th scope="row" colspan="2">
                                                                                    BB
                                                                                </th>
                                                                                <th scope="row" colspan="2">
                                                                                    {{ $member->hasil_timbang_ukur_bb }}
                                                                                </th>

                                                                            </tr>
                                                                            <tr aria-colspan="4">
                                                                                <th scope="row" colspan="2">
                                                                                    PB</th>
                                                                                <th scope="row" colspan="2">
                                                                                    {{ $member->hasil_timbang_ukur_pb }}
                                                                                </th>

                                                                            </tr>

                                                                            <tr aria-colspan="4">
                                                                                <th scope="row" colspan="2">
                                                                                    LK</th>
                                                                                <th colspan="2">
                                                                                    {{ $member->hasil_timbang_ukur_lk }}
                                                                                </th>
                                                                            </tr>

                                                                            <tr>

                                                                                <th scope="row" rowspan="5">Jenis
                                                                                    Kunjungan Pemeriksaan
                                                                                </th>


                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->jenis_kunjungan_pemeriksaan }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">Tanggal
                                                                                    Pemeriksaan</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->tgl_pemeriksaan }}</td>
                                                                            </tr>

                                                                            <tr>
                                                                                <th scope="row" colspan="2">Tempat
                                                                                    Pemeriksaan</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->tmp_pemeriksaan }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">Petugas
                                                                                    Pemeriksaan</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->petugas_pemeriksaan }}</td>
                                                                            </tr>
                                                                            {{-- 0 --}}
                                                                            <tr>
                                                                                <th scope="row" rowspan="22">Jenis
                                                                                    Imunisasi</th>
                                                                                <td scope="row" colspan="4">
                                                                                    Usia 0 Bulan</td>
                                                                            </tr>

                                                                            <tr>
                                                                                <th scope="row" colspan="2">
                                                                                    Hepatitis B (0 bln)
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->hepatitis_b_0bln ?? '-' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">BCG (0
                                                                                    bln)
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->bcg_0bln ?? '-' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">Polio
                                                                                    Tetes (0 bln)</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->polio_tetes_0bln ?? '-' }}
                                                                                </td>
                                                                            </tr>
                                                                            {{-- 1 --}}
                                                                            <tr>

                                                                                <td scope="row" colspan="4">
                                                                                    Usia 1 Bulan</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">BCG (1
                                                                                    bln)
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->bcg_1bln ?? '-' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">Polio
                                                                                    Tetes (1-1 bln)
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->polio_tetes_1_1bln ?? '-' }}
                                                                                </td>
                                                                            </tr>
                                                                            {{-- 2 --}}
                                                                            <tr>

                                                                                <td scope="row" colspan="4">
                                                                                    Usia 2 Bulan</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">
                                                                                    DPT-HB-Hib (1-2 bln)
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->dpt_hb_hib_1_2bln ?? '-' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">Polio
                                                                                    Tetes (1-2 bln)
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->polio_tetes_1_2bln ?? '-' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">PCV (1-2
                                                                                    bln)
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->pcv_1_2bln ?? '-' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">RV (1-2
                                                                                    bln)
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->rv_1_2bln ?? '-' }}
                                                                                </td>
                                                                            </tr>
                                                                            {{-- 3 --}}
                                                                            <tr>

                                                                                <td scope="row" colspan="4">
                                                                                    Usia 3 Bulan</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">
                                                                                    DPT-HB-Hib (2-3 bln)
                                                                                </th>
                                                                                <td cope="row" colspan="4">
                                                                                    {{ $member->dpt_hb_hib_2_3bln ?? '-' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">Polio
                                                                                    Tetes (2-3 bln)
                                                                                </th>
                                                                                <td cope="row" colspan="4">
                                                                                    {{ $member->polio_tetes_2_3bln ?? '-' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">PCV (2-3
                                                                                    bln)
                                                                                </th>
                                                                                <td cope="row" colspan="4">
                                                                                    {{ $member->pcv_2_3bln ?? '-' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">RV (2-3
                                                                                    bln)
                                                                                </th>
                                                                                <td cope="row" colspan="4">
                                                                                    {{ $member->rv_2_3bln ?? '-' }}
                                                                                </td>
                                                                            </tr>
                                                                            {{-- 4 --}}
                                                                            <tr>

                                                                                <td scope="row" colspan="4">
                                                                                    Usia 4 Bulan</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">
                                                                                    DPT-HB-Hib (3-4 bln)
                                                                                </th>
                                                                                <td cope="row" colspan="4">
                                                                                    {{ $member->dpt_hb_hib_3_4bln ?? '-' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">Polio
                                                                                    Tetes (3-4 bln)
                                                                                </th>
                                                                                <td cope="row" colspan="4">
                                                                                    {{ $member->polio_tetes_3_4bln ?? '-' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">PCV (3-4
                                                                                    bln)
                                                                                </th>
                                                                                <td cope="row" colspan="4">
                                                                                    {{ $member->pcv_3_4bln ?? '-' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">RV (3-4
                                                                                    bln)
                                                                                </th>
                                                                                <td cope="row" colspan="4">
                                                                                    {{ $member->rv_3_4bln ?? '-' }}
                                                                                </td>
                                                                            </tr>

                                                                            <tr>
                                                                                <th scope="row">
                                                                                    Edukasi/Kunjungan Nakes</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->edukasi_kunjungan }}</td>
                                                                            </tr>

                                                                            <tr>
                                                                                <th scope="row" rowspan="2">Tanda
                                                                                    Bahaya
                                                                                    Pada Bayi 0 - 2 Bulan</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">Napas
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->napas }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">
                                                                                    Aktifitas
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->aktifitas }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">Warna
                                                                                    Kulit
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->warna_kulit }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">Hisapan
                                                                                    Bayi
                                                                                </th>
                                                                                <tdscope="row"
                                                                                colspan="4">{{ $member->hisapan_bayi }}
                                                                                </tdscope=>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">Kejang
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->kejang }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">Suhu
                                                                                    Tubuh
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->suhu_tubuh }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">BAB</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->bab }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">Jumlah
                                                                                    dan
                                                                                    Warna Kencing
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->jmhdanwarna_kencing }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">Tali
                                                                                    Pusar
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->tali_pusar }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">Mata
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->mata }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">Kulit
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->kulit }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="">
                                                                                    Imunisasi
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->imunisasi }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Pengingat
                                                                                    Pemeriksaan</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->pengingat_pemeriksaan }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Tanggal
                                                                                    Lapor Nakes</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->tgl_lapor_nakes }}</td>
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
                                    <a href="{{ route('kunjunganrumahBayi.tbc.pdf2', $member->id) }}"
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
                                    <!-- End of Modal -->
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
