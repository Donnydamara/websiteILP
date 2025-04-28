@extends('layouts/master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Detail Data Keluarga Dan Anggota Keluarga') }}</h1>

    <!-- Main Content goes here -->

    {{-- <a href="{{ route('pendataan_kk.createdetail', ['id' => $dataKK->id]) }}" class="btn btn-sm btn-info ml-2">Tambah
        Detail</a> --}}
    <div class="row mb-3">
        <div class="col text-center">
            <!-- Tombol Tambah Data (untuk role 'kader') -->
            @if (Auth::check() && Auth::user()->role == 'kader')
                <button class="btn btn-primary mb-2"
                    onclick="window.location.href='{{ route('pendataan_kk.createdetail', ['id' => $dataKK->id]) }}'">
                    Tambah Data
                </button>
            @endif

            <!-- Tombol Kembali (untuk role 'admin') -->
            @if (Auth::check() && Auth::user()->role == 'admin')
                <form action="{{ route('datakk.index') }}" method="GET" class="d-inline">
                    @csrf
                    <button class="btn btn-secondary mb-2">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </button>
                </form>
            @endif

            <!-- Tombol Download PDF -->
            <a href="{{ route('pendataan.kk.pdf', ['kk' => $dataKK->kk]) }}" target="_blank" class="btn btn-info mb-2">
                <i class="fas fa-file-pdf"></i> Download PDF
            </a>

            <!-- Tombol Export Excel -->
            <form method="GET" action="{{ route('datakk.show', ['id' => $dataKK->id]) }}" class="d-inline">
                <button type="submit" class="btn btn-success mb-2" name="export" value="1">
                    <i class="fas fa-file-excel"></i> Export Excel
                </button>
            </form>

            <a href="{{ route('datakk.index') }}" class="btn btn-primary mb-2">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>


    {{-- <div class="button-container">
        @if (Auth::check() && Auth::user()->role == 'kader')
            <button class="add btn btn-primary mb-2 mb-md-0"
                onclick="window.location.href='{{ route('pendataan_kk.createdetail', ['id' => $dataKK->id]) }}'">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z"></path>
                        <path fill="currentColor" d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z"></path>
                    </svg>
                    Tambah
                </span>
            </button>
        @endif
        <form action="{{ route('datakk.index') }}" method="GET" style="display:inline;">
            @csrf
            <button class="back btn btn-secondary me-2" type="submit">
                <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1"
                    viewBox="0 0 1024 1024">
                    <path
                        d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z">
                    </path>
                </svg>
                <span class="d-none d-md-inline">Kembali</span>
            </button>
        </form>
        <a href="{{ route('pendataan.kk.pdf', ['kk' => $dataKK->kk]) }}" target="_blank" class="download-button ">
            <div class="docs"><svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none"
                    stroke-width="2" stroke="currentColor" height="20" width="20" viewBox="0 0 24 24">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line y2="13" x2="8" y1="13" x1="16"></line>
                    <line y2="17" x2="8" y1="17" x1="16"></line>
                    <polyline points="10 9 9 9 8 9"></polyline>
                </svg> All PDF</div>
            <div class="download">
                <svg class="css-i6dzq1" stroke-linejoin="round" stroke-linecap="round" fill="none" stroke-width="2"
                    stroke="currentColor" height="24" width="24" viewBox="0 0 24 24">
                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                    <polyline points="7 10 12 15 17 10"></polyline>
                    <line y2="3" x2="12" y1="15" x1="12"></line>
                </svg>
            </div>
        </a>
        <form method="GET" action="{{ route('datakk.show', ['id' => $dataKK->id]) }}">
            <button type="submit" class="btn btn-success" name="export" value="1">Export to Excel</button>
        </form>

    </div> --}}


    {{-- <a href="{{ route('datakk.index') }}" class="btn btn-primary mb-3">kembali</a> --}}
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
                    <th style="text-align: center">Jenis Kelamin</th>
                    <th style="text-align: center">Hubungan Keluarga</th>
                    <th style="text-align: center">Kelompok Sasaran</th>
                    <th style="text-align: center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @if ($familyMembers->isNotEmpty())
                    @foreach ($familyMembers as $member)
                        <tr>
                            <td scope="row">{{ $loop->iteration }}</td>
                            <td>{{ $dataKK->kk }}</td>
                            <td>{{ $member->nama }}</td>
                            <td>{{ $member->nik }}</td>
                            <td>{{ $member->gender }}</td>
                            <td>{{ $member->hubungan_keluarga }}</td>
                            <td>{{ $member->kelompok_sasaran }}</td>
                            <td>
                                <div class="d-flex">
                                    @if (Auth::check() && Auth::user()->role == 'kader')
                                        {{-- <form action="{{ route('pendataan_kk.editdetail', ['id' => $member->id]) }}"
                                            method="GET" style="display:inline;">
                                            @csrf
                                            <button class="edit">
                                                Edit
                                                <span></span>
                                            </button>
                                        </form> --}}
                                        <button class="edit"
                                            onclick="window.location.href='{{ route('pendataan_kk.editdetail', ['id' => $member->id]) }}'">
                                            Edit
                                            <span></span>
                                        </button>
                                        <form action="{{ route('datakk.destroy2', ['id' => $member->id]) }}" method="POST"
                                            onsubmit="">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger hidden">Hapus</button>
                                        </form>
                                        <form action="{{ route('datakk.destroy2', ['id' => $member->id]) }}" method="post"
                                            class="delete-form">
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
                                            <div class="modal-dialog modal-dialog-centered" role="document">
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
                                                                <table class="table table-bordered">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th scope="row">No Kartu Keluarga</th>
                                                                            <td>{{ $member->kk }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Nama</th>
                                                                            <td>{{ $member->nama }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">NIK</th>
                                                                            <td>{{ $member->nik }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Gender</th>
                                                                            <td>{{ $member->gender }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Hubungan Keluarga</th>
                                                                            <td>{{ $member->hubungan_keluarga }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Status Perkawinan</th>
                                                                            <td>{{ $member->status_perkawinan }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Pendidikan Terakhir</th>
                                                                            <td>{{ $member->pendidikan_terakhir }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Pekerjaan</th>
                                                                            <td>{{ $member->pekerjaan }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Kelompok Sasaran</th>
                                                                            <td>{{ $member->kelompok_sasaran }}</td>
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
    <style>
        .hidden {
            display: none;
        }
    </style>
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
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            formElement.submit();
                        }
                    });
                });
            });
        });
    </script>
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
                        confirmButtonText: 'Yes, delete it!'
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
