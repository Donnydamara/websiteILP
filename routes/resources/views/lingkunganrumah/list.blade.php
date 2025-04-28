@extends('layouts/master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">List Daftar Lingkungan Rumah</h1>

    <!-- Main Content goes here -->
    <div class="row mb-3">
        <div class="col text-center">
            <!-- Tombol Tambah (untuk role 'kader') -->
            @if (Auth::check() && Auth::user()->role == 'kader')
                <button class="btn btn-primary mb-2"
                    onclick="window.location.href='{{ route('lingkunganrumah.createvalidate') }}'">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path fill="none" d="M0 0h24v24H0z"></path>
                            <path fill="currentColor" d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z"></path>
                        </svg>
                        Tambah Data
                    </span>
                </button>
            @endif

            <!-- Tombol Kembali (untuk role 'admin') -->
            @if (Auth::check() && Auth::user()->role == 'admin')
                <form action="{{ route('pendataan.index') }}" method="GET" class="d-inline">
                    @csrf
                    <button class="btn btn-secondary mb-2">
                        <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1"
                            viewBox="0 0 1024 1024">
                            <path
                                d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z">
                            </path>
                        </svg>
                        <span>Kembali</span>
                    </button>
                </form>
            @endif

            <!-- Tombol Export ke Excel -->
            <a href="{{ route('lingkungan_rumah.index', ['export' => 1]) }}" class="btn btn-success mb-2">
                <i class="fas fa-file-excel"></i> Export Excel
            </a>
        </div>
    </div>



    {{-- <a href="{{ route('lingkunganrumah.create') }}" class="btn btn-primary mb-3">Tambah Data Lingkungan Rumah</a> --}}

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
                    <th>No</th>
                    <th>Kartu Keluarga</th>
                    <th>Kepala Keluarga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lingkunganRumahs as $lingkunganRumah)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $lingkunganRumah->kk }}</td>
                        <td>{{ $lingkunganRumah->nama }}</td>

                        <td>

                            <div class="d-flex">
                                @if (Auth::check() && Auth::user()->role == 'kader')
                                    <form action="{{ route('lingkunganrumah.edit', ['id' => $lingkunganRumah->id]) }}"
                                        method="GET" style="display:inline;">
                                        @csrf
                                        <button class="edit">
                                            Edit
                                            <span></span>
                                        </button>
                                    </form>
                                    <form action="{{ route('lingkunganrumah.destroy', ['id' => $lingkunganRumah->id]) }}"
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
                                <!-- Button Detail -->
                                <form method="GET" style="display:inline;">
                                    @csrf
                                    <button type="button" class="custom-btn btn-2" data-toggle="modal"
                                        data-target="#detailModal{{ $lingkunganRumah->id }}">
                                        Detail
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="detailModal{{ $lingkunganRumah->id }}" tabindex="-1"
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
                                                                            <th>Kartu Keluarga</th>
                                                                            <td>{{ $lingkunganRumah->kk }}</td>
                                                                            <th></th>
                                                                            <th></th>
                                                                            <th></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Data Anggota Keluarga
                                                                            </th>

                                                                            <th scope="row">Kepala Keluarga</th>
                                                                            <td>{{ $lingkunganRumah->nama }}
                                                                            </td>
                                                                            {{--  --}}
                                                                            <th scope="row">Memiliki Jaminan JKN dan
                                                                                Jamkesda/
                                                                                Ansuransi Kesehatan</th>
                                                                            <td>{{ $lingkunganRumah->jkn_jamkesda }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row"></th>
                                                                            <th scope="row">Anggota Keluarga Total
                                                                            </th>
                                                                            <td>{{ $lingkunganRumah->AK_total }}</td>
                                                                            {{--  --}}
                                                                            <th scope="row">Tersedia Serapan Air</th>
                                                                            <td>{{ $lingkunganRumah->sarana_air }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row"></th>
                                                                            <th scope="row">Jumlah Anggota Keluarga
                                                                                Lansia (>60 Tahun)</th>
                                                                            <td>{{ $lingkunganRumah->AK_lansia }}</td>
                                                                            {{--  --}}
                                                                            <th scope="row">Jenis Sumber Air</th>
                                                                            <td>{{ $lingkunganRumah->jenis_sumber_air }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row"></th>
                                                                            <th scope="row">Jumlah Anggota Keluarga
                                                                                Usia
                                                                                Dewasa(>18 - 59 Tahun)</th>
                                                                            <td>{{ $lingkunganRumah->jumlah_AK_dewasa }}
                                                                            </td>
                                                                            {{--  --}}
                                                                            <th scope="row">Tersedia Jamban</th>
                                                                            <td>{{ $lingkunganRumah->jamban }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row"></th>
                                                                            <th scope="row">Jumlah Anggota Keluarga
                                                                                Usia
                                                                                Sekolah Dan Remaja (>6 - 18 Tahun)</th>
                                                                            <td>{{ $lingkunganRumah->AK_remaja }}</td>
                                                                            {{--  --}}
                                                                            <th scope="row">Jenis Jamban</th>
                                                                            <td>{{ $lingkunganRumah->jenis_jamban }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row"></th>
                                                                            <th scope="row">Jumlah Anggota Keluarga
                                                                                Anggota Balita (6 - 71 Bulan)</th>
                                                                            <td>{{ $lingkunganRumah->AK_balita }}</td>
                                                                            {{--  --}}
                                                                            <th scope="row">Apalah Venstilasi Cukup
                                                                            </th>
                                                                            <td>{{ $lingkunganRumah->ventilasi }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row"></th>
                                                                            <th scope="row">Jumlah Anggota Keluarga
                                                                                Anggota Balita (6 - 71 Bulan)</th>
                                                                            <td>{{ $lingkunganRumah->AK_bayi }}</td>
                                                                            {{--  --}}
                                                                            <th scope="row">Anggota Keluarga
                                                                                Mengalami
                                                                                Gangguan
                                                                                Jiwa</th>
                                                                            <td>{{ $lingkunganRumah->mengalami_gangguan_jiwa }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row"></th>
                                                                            <th scope="row">Jumlah Anggota Keluarga
                                                                                Ibu
                                                                                Bersalin Dan Nifas</th>
                                                                            <td>{{ $lingkunganRumah->AK_ibu_bersalin_nifas }}
                                                                            </td>
                                                                            {{--  --}}
                                                                            <th scope="row">Anggota Keluarga
                                                                                Terdiaknosa
                                                                                (TBC,
                                                                                Hipertensi dan Diabetes Mellitus)
                                                                            </th>
                                                                            <td>{{ $lingkunganRumah->TBC_hipertensi_millitus }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row"></th>
                                                                            <th scope="row">Anggota Keluarga Ibu
                                                                                Hamil
                                                                            </th>
                                                                            <td>{{ $lingkunganRumah->AK_ibu_hamil }}
                                                                            </td>

                                                                        </tr>

                                                                        <!-- Add more information fields here -->
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- End of Modal -->
                                </form>
                                <a href="{{ route('lingkunganRumah.tbc.pdf2', $lingkunganRumah->id) }}"
                                    class="action_has has_saved" aria-label="save" type="button" target="_blank">
                                    <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20"
                                        height="20" stroke-linejoin="round" stroke-linecap="round" stroke-width="2"
                                        viewBox="0 0 24 24" stroke="currentColor" fill="none">
                                        <path d="m19,21H5c-1.1,0-2-.9-2-2V5c0-1.1.9-2,2-2h11l5,5v11c0,1.1-.9,2-2,2Z"
                                            stroke-linejoin="round" stroke-linecap="round" data-path="box"></path>
                                        <path d="M7 3L7 8L15 8" stroke-linejoin="round" stroke-linecap="round"
                                            data-path="line-top"></path>
                                        <path d="M17 20L17 13L7 13L7 20" stroke-linejoin="round" stroke-linecap="round"
                                            data-path="line-bottom"></path>
                                    </svg></a>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $lingkunganRumahs->links() }}

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
                        text: "menghapus Data!",
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
