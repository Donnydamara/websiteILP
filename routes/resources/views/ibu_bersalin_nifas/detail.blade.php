@extends('layouts/master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Detail Ibu Bersalin Nifas') }}</h1>

    <!-- Main Content goes here -->
    {{-- <a href="{{ route('ibu_hamil.createdetail') }}" class="btn btn-sm btn-info ml-2">Tambah Detail</a> --}}
    {{-- <a href="{{ route('ibu_bersalin_nifas.createdetail', ['id' => $dataKK->id]) }}" class="btn btn-sm btn-info ml-2">Tambah
        Detail</a>
    <a href="{{ route('ibubersalinNifas.pdf', ['id' => $dataKK->id]) }}" class="btn btn-primary" target="_blank">Download
        PDF</a>
    <a href="{{ route('ibu_bersalin_nifas.index') }}" class="btn btn-primary mb-3">Kembali</a> --}}

    <div class="row mb-3">
        <div class="col text-center">
            @if (Auth::check() && Auth::user()->role == 'kader')
                <button class="btn btn-primary mb-2"
                    onclick="window.location.href='{{ route('ibu_bersalin_nifas.createdetail', ['id' => $dataKK->id]) }}'">
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
            <a href="{{ route('ibu_bersalin_nifas.index') }}" class="btn btn-secondary mb-2">
                <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1"
                    viewBox="0 0 1024 1024">
                    <path
                        d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z">
                    </path>
                </svg>
                <span>Kembali</span>
            </a>

            <!-- Tombol PDF -->
            <a href="{{ route('ibubersalinNifas.pdf', ['id' => $dataKK->id]) }}" target="_blank" class="btn btn-info mb-2">
                <i class="fas fa-file-pdf"></i> Download PDF
            </a>

            <!-- Tombol Export ke Excel -->
            <a href="{{ route('ibu_bersalin_nifas.show', ['id' => $dataKK->id, 'export' => true]) }}"
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
                    <th style="text-align: center">Kehamilan Ke</th>
                    <th style="text-align: center">Tanggal Persalinan</th>
                    <th style="text-align: center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($familyMembers->isNotEmpty())
                    @foreach ($familyMembers as $member)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $dataKK->kk }}</td>
                            <td>{{ $dataKK->nama }}</td>
                            <td>{{ $member->nik }}</td>
                            <td>{{ $member->kunjungan }}</td>
                            <td>{{ $member->kelahiran_ke }}</td>
                            <td>{{ $member->tgl_persalinan }}</td>
                            <td>
                                <div class="d-flex">
                                    @if (Auth::check() && Auth::user()->role == 'kader')
                                        <form action="{{ route('ibu_bersalin_nifas.editdetail', ['id' => $member->id]) }}"
                                            method="GET" style="display:inline;">
                                            @csrf
                                            <button class="edit">
                                                Edit
                                                <span></span>
                                            </button>
                                        </form>

                                        <form action="{{ route('ibu_bersalin_nifas.destroy2', ['id' => $member->id]) }}"
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
                                                        <h5 class="modal-title" id="exampleModalLabel">Detail Ibu Bersalin
                                                            Dan
                                                            Nifas
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
                                                                                <th scope="row">Status Ibu Bersalin
                                                                                    Nifas
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->status }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">No Kartu Keluarga</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->kk }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Nama</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->nama }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">NIK</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->nik }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Umur Ibu</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->umur_ibu }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Kelahiran Ke</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->kelahiran_ke }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Tanggal Persalinan</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->tgl_persalinan }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Pukul Persalinan</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->pukul_persalinan }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Usia Kehamilan
                                                                                    Persalinan
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->usia_kehamilan_persalinan }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Penolong Persalinan</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->penolong_persalinan }}
                                                                                    @if ($member->penolong_persalinan == 'lainnya')
                                                                                        :
                                                                                        {{ $member->lainya_penolong_persalinan }}
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" rowspan="2">Tempat
                                                                                    Persalinan
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->tmpt_persalinan }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Nama Tempat Persalinan
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->nama_tmpt_persalinan }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Cara Persalinan</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->cara_persalinan }}
                                                                                    @if ($member->cara_persalinan == 'lainnya')
                                                                                        :
                                                                                        {{ $member->lainya_cara_persalinan }}
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Keadaan Ibu Pada Saat
                                                                                    Melahirkan
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->keadaan_ibu_persalinan }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">RRiwayat Inisiasi
                                                                                    Menyusui
                                                                                    Dini
                                                                                    (IMD)
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->riwayat_imd_persalinan }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Tanggal Kunjungan</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->tgl_kunjungan }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Pemantauan Suhu Tubuh
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->suhu_tubuh }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Ada Buku KIA</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->buku_ka }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" rowspan="4">Ibu
                                                                                    memeriksa
                                                                                    kesehatannya ke
                                                                                    posyandu Prima/ Puskesmas/ Fasyankes
                                                                                    lainnya atau kunjungan rumah oleh nakes
                                                                                    dan
                                                                                    untuk melakukan pemeriksaan setelah
                                                                                    melahirkann
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->pemeriksaan_kesehatan }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">Tanggal
                                                                                    Pemeriksaan
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->tgl_pk }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">Tempat
                                                                                    Pemeriksaan</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->tempat_pk }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">Petugas
                                                                                    Pemeriksaan
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->petugas_pk }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Isi Priring Ibu Menyusui
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->porsi }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" rowspan="3">Kapsul
                                                                                    Vitamil A
                                                                                </th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">ADA</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->ada_kva }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">Waktu
                                                                                    Minum
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->wkt_minum_kva }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Menyusui</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->menyusui }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">KB Pasca Persalinan</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->kb_pasca_persalinan }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" rowspan="4">
                                                                                    Melakukan
                                                                                    Skiring Kesehatan</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">Tanggal
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->skrining_kesehatan }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">Tempat
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->skrining_kesehatan_tmp }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">Petugas
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->skrining_kesehatan_petugas }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Pemberian Edukasi/
                                                                                    Kunjungan
                                                                                    Nakes</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->edukasi_kunjungan }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Demam</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->demam }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Ada perasaan bersalah,
                                                                                    mudah
                                                                                    menangis, kehilangan minat, gelisah,
                                                                                    gangguan
                                                                                    tidur,
                                                                                    gangguan konsentrasi</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->perasaan }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Tidak bisa BAK, BAK
                                                                                    sedikit
                                                                                    tapi
                                                                                    sering, terasa panas, nyeri panggul,
                                                                                    urin
                                                                                    keluar
                                                                                    tanpa disadari</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->sakit }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Nafas pendek dan
                                                                                    terengah-engah,
                                                                                    nafas dangkal disertasi nyeri dada,
                                                                                    nafas
                                                                                    berat, batuk lebih dari 2 (dua) hari
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->pernafasan }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Payudara bengkak
                                                                                    kemerahan
                                                                                    disertai nyeri, benjolan disertai nyeri
                                                                                    ada
                                                                                    keluhan dalam menyusul</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->payudara }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Sakit Kepala</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->sakit_kepala }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Pendarahan (pembalut
                                                                                    basah
                                                                                    dalam
                                                                                    5 menit)</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->pendarahan }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Area sekitar kelamin
                                                                                    bengkak
                                                                                    atau
                                                                                    nyeri atau ada luka terbuka</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->sakit_bagian_kelamin }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Keluar cairan dari dalam
                                                                                    jalan
                                                                                    lahir</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->keluar_cairan }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Pandangan Kabur</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->pandangan_kabur }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Darah nifas berbau atau
                                                                                    mengalir
                                                                                    atau ada nyeri pada perut bawah</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->darah_nifas }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Keputihan berlebih.
                                                                                    berwarna
                                                                                    dan
                                                                                    berbau</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->keputihan }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Jantung Berdebar</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->jantung_berdebar }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Mengingatkan periksa ke
                                                                                    Postu/
                                                                                    Fasyankes</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->pengingat_periksa_postu }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Melaporkan ke Nakes</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->tgl_laporan_nakes }}</td>
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
                                    <a href="{{ route('ibubersalinNifas.tbc.pdf2', $member->id) }}"
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
