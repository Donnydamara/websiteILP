@extends('layouts/master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Detail Ibu Hamil') }}</h1>

    <!-- Main Content goes here -->
    {{-- <a href="{{ route('ibu_hamil.createdetail') }}" class="btn btn-sm btn-info ml-2">Tambah Detail</a> --}}
    <div class="row mb-3">
        <div class="col text-center">
            <!-- Tombol Tambah (untuk role 'kader') -->
            @if (Auth::check() && Auth::user()->role == 'kader')
                <button class="btn btn-primary mb-2"
                    onclick="window.location.href='{{ route('ibu_hamil.createdetail', ['id' => $dataKK->id]) }}'">
                    Tambah Data
                </button>
            @endif

            <!-- Tombol Kembali -->
            <a href="{{ route('ibu_hamil.index') }}" class="btn btn-primary mb-2">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>


            <!-- Tombol PDF -->
            <a href="{{ route('ibuHamil.pdf', ['id' => $dataKK->id]) }}" target="_blank" class="btn btn-info mb-2">
                <i class="fas fa-file-pdf"></i> Download PDF
            </a>


            <!-- Tombol Export ke Excel -->
            <a href="{{ route('ibu_hamil.show', ['id' => $dataKK->id, 'export' => true]) }}" class="btn btn-success mb-2">
                <i class="fas fa-file-excel"></i> Export to Excel
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
                            <td>{{ $member->kehamilan_ke }}</td>
                            <td>
                                <div class="d-flex">
                                    @if (Auth::check() && Auth::user()->role == 'kader')
                                        <form action="{{ route('ibu_hamil.editdetail', ['id' => $member->id]) }}"
                                            method="GET" style="display:inline;">
                                            @csrf
                                            <button class="edit">
                                                Edit
                                                <span></span>
                                            </button>
                                        </form>

                                        {{-- <a href="{{ route('ibu_hamil.editdetail', ['id' => $member->id]) }}"
                                        class="btn btn-sm btn-primary mr-2">Edit</a> --}}


                                        <form action="{{ route('ibu_hamil.destroy2', ['id' => $member->id]) }}"
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
                                                        <h5 class="modal-title" id="exampleModalLabel">Detail Anggota
                                                            Keluarga
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
                                                                        <tbody>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">Ibu
                                                                                    Hamil</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->status }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">No Kartu
                                                                                    Keluarga
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->kk }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">Nama
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->nama }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">NIK</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->nik }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">
                                                                                    Kehamilan
                                                                                    Ke-
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->kehamilan_ke }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">Jarak
                                                                                    Kehamilan Dengan <br> Kehamilan
                                                                                    Sebelumnya</th>
                                                                                <td scope="row" colspan="4">
                                                                                    @if ($member->jarak_kehamilan_unit === 'bulan')
                                                                                        {{ $member->jarak_kehamilan_bulan }}
                                                                                        Bulan
                                                                                    @elseif($member->jarak_kehamilan_unit === 'tahun')
                                                                                        {{ $member->jarak_kehamilan_tahun }}
                                                                                        Tahun
                                                                                    @else
                                                                                        -
                                                                                    @endif
                                                                                </td>
                                                                            </tr>


                                                                            <tr>
                                                                                <th scope="row" colspan="2">Umur Ibu
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->umur }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">
                                                                                    Kunjungan
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->kunjungan }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">Suhu
                                                                                    Tubuh
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->suhu_tubuh }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">KIA</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->kia }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2"
                                                                                    rowspan="5">Ibu
                                                                                    Memeriksakan Kehamilan</th>

                                                                            </tr>
                                                                            <tr>
                                                                                <td scope="row" colspan="2">
                                                                                    {{ $member->jenis_imk }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">Tanggal
                                                                                </th>
                                                                                <td scope="row" colspan="3">
                                                                                    {{ $member->tgl_imk }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">Tempat
                                                                                </th>
                                                                                <td scope="row" colspan="3">
                                                                                    {{ $member->tempat_imk }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">Petugas
                                                                                </th>
                                                                                <td scope="row" colspan="3">
                                                                                    {{ $member->petugas_imk }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">Isi
                                                                                    Piringku
                                                                                    Untuk Ibu Hamil</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->porsi }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2"
                                                                                    rowspan="3">
                                                                                    TTD</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">Ada</th>
                                                                                <td scope="row" colspan="3">
                                                                                    {{ $member->ada_ttd }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">Minum
                                                                                    Hari
                                                                                    Ini /
                                                                                    Dalam 24 Jam Terakhir</th>
                                                                                <td scope="row" colspan="3">
                                                                                    {{ $member->minum_ttd }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">Lila
                                                                                    <23,5 cm </th>
                                                                                <td scope="row" colspan="3">
                                                                                    {{ $member->lila }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">PMT
                                                                                    Untuk
                                                                                    Bumil
                                                                                    KEK</th>
                                                                                <td scope="row" colspan="3">
                                                                                    {{ $member->pmt }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2"
                                                                                    rowspan="4">
                                                                                    Mengikuti Kelas Ibu Hamil Terakhir</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">Tanggal
                                                                                </th>
                                                                                <td scope="row" colspan="3">
                                                                                    {{ $member->kls_ibu_hamil }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">Tempat
                                                                                </th>
                                                                                <td scope="row" colspan="3">
                                                                                    {{ $member->tempat_ibu_hamil }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">
                                                                                    Pendamping
                                                                                </th>
                                                                                <td scope="row" colspan="3">
                                                                                    {{ $member->pendamping_ibu_hamil }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2"
                                                                                    rowspan="4">
                                                                                    Melakukan Skrining Kesehatan Jiwa</th>

                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">Tanggal
                                                                                </th>
                                                                                <td scope="row" colspan="3">
                                                                                    {{ $member->kls_skrining_kesehatan }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">Tempat
                                                                                </th>
                                                                                <td scope="row" colspan="3">
                                                                                    {{ $member->tempat_skrining_kesehatan }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="1">Petugas
                                                                                </th>
                                                                                <td scope="row" colspan="3">
                                                                                    {{ $member->petugas_skrining_kesehatan }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">Edukasi
                                                                                </th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->edukasi }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="6">Tanda
                                                                                    Bahaya
                                                                                    Pada Kehamilan</th>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">Demam
                                                                                    Lebih
                                                                                    Dari
                                                                                    Dua Hari</th>
                                                                                <td scope="row" colspan="4">
                                                                                    {{ $member->demam_l2 }}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row" colspan="2">
                                                                                    {{ $member->sakit_kepala_l2 }}
                            </td>
                            <td scope="row" colspan="4">Pusing / Sakit Kepala Berat</th>
                        </tr>
                        <tr>
                            <th scope="row" colspan="2">Sulit Tidur / Cemas Berlebih</th>
                            <td scope="row" colspan="4">{{ $member->sulit_tidur_l2 }}</td>
                        </tr>
                        <tr>
                            <th scope="row" colspan="2">Diare Berulang</th>
                            <td scope="row" colspan="4">{{ $member->diare_l2 }}</td>
                        </tr>
                        <tr>
                            <th scope="row" colspan="2">Resiko TBC</th>
                            <td scope="row" colspan="4">{{ $member->tbc_l2 }}</td>
                        </tr>
                        <tr>
                            <th scope="row" colspan="2">Tidak Ada Gerakan Janin</th>
                            <td scope="row" colspan="4">{{ $member->gerakan_janin_l2 }}</td>
                        </tr>
                        <tr>
                            <th scope="row" colspan="2">Jantung Berdebar-Debar AtauNyeri Pada Dada</th>
                            <td scope="row" colspan="4">{{ $member->jantung_sakit_l2 }}</td>
                        </tr>
                        <tr>
                            <th scope="row" colspan="2">Keluar Cairan Dari Jalan Lahir</th>
                            <td scope="row" colspan="4">{{ $member->keluar_cairan_l2 }}</td>
                        </tr>
                        <tr>
                            <th scope="row" colspan="2">Sakit Saat Kencing Manis</th>
                            <td scope="row" colspan="4">{{ $member->kencing_manis_l2 }}</td>
                        </tr>
                        <tr>
                            <th scope="row" colspan="2">Nyeri Perut Hebat</th>
                            <td scope="row" colspan="4">{{ $member->nyeri_perut_l2 }}</td>
                        </tr>
                        <tr>
                            <th scope="row" colspan="2">Mengingatkan Periksa Ke Postu/ Fasyankes</th>
                            <td scope="row" colspan="4">{{ $member->periksa_l2 }}</td>
                        </tr>
                        <tr>
                            <th scope="row" colspan="2">Melaporkan Ke Nakes</th>
                            <td scope="row" colspan="4">{{ $member->lapor_nakes }}</td>
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
    <a href="{{ route('ibuHamil.tbc.pdf2', $member->id) }}" class="action_has has_saved" aria-label="save"
        type="button" target="_blank">
        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20" height="20"
            stroke-linejoin="round" stroke-linecap="round" stroke-width="2" viewBox="0 0 24 24" stroke="currentColor"
            fill="none">
            <path d="m19,21H5c-1.1,0-2-.9-2-2V5c0-1.1.9-2,2-2h11l5,5v11c0,1.1-.9,2-2,2Z" stroke-linejoin="round"
                stroke-linecap="round" data-path="box"></path>
            <path d="M7 3L7 8L15 8" stroke-linejoin="round" stroke-linecap="round" data-path="line-top"></path>
            <path d="M17 20L17 13L7 13L7 20" stroke-linejoin="round" stroke-linecap="round" data-path="line-bottom">
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
