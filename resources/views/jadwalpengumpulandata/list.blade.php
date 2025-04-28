@extends('layouts/master')

@section('content')
    <!-- Page Heading -->
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800 text-center">{{ $title ?? __('List Tanggal Pengumpulan Data') }}</h1>

        <!-- Buttons -->
        <div class="row mb-3">
            <div class="col text-center">
                @if (Auth::check() && Auth::user()->role == 'kader')
                    <button class="btn btn-primary mb-2" onclick="window.location.href='{{ route('jadwal.createjad') }}'">
                        Tambah Data
                    </button>
                @endif

                @if (Auth::check() && Auth::user()->role == 'admin')
                    <form action="{{ route('pendataan.index') }}" method="GET" class="d-inline">
                        @csrf
                        <button class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back
                        </button>
                    </form>
                @endif

                <form method="GET" action="{{ route('jadwalpengumpulan.index') }}" class="d-inline">
                    <button type="submit" class="btn btn-success" name="export" value="1"><i
                            class="fas fa-file-excel"></i> Export Excel</button>
                </form>
            </div>
        </div>

        <!-- Session Messages -->
        @if (session('message'))
            <div class="alert alert-success text-center">
                {{ session('message') }}
            </div>
        @endif

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable" style="text-align: center;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Desa</th>
                        <th>Kartu Keluarga</th>
                        <th>Kepala Keluarga</th>
                        <th>No Handphome</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jadwals as $jadwal)
                        <tr>
                            <td scope="row">{{ $loop->iteration }}</td>
                            <td>{{ $jadwal->desa }}</td>
                            <td>{{ $jadwal->kk }}</td>
                            <td>{{ $jadwal->nama }}</td>
                            <td>{{ $jadwal->no_hp }}</td>
                            <td>
                                <div class="d-flex">
                                    @if (Auth::check() && Auth::user()->role == 'kader')
                                        <button class="edit"
                                            onclick="window.location.href='{{ route('jadwal.edit', ['jadwal' => $jadwal->id]) }}'">
                                            Edit
                                            <span></span>
                                        </button>

                                        {{--
                                            <a href="{{ route('jadwal.edit', ['jadwal' => $jadwal->id]) }}"
                                class="btn btn-sm btn-primary mr-2">Edit</a> --}}


                                        <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST"
                                            onsubmit="">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger hidden">Hapus</button>
                                        </form>
                                        <form action="{{ route('jadwal.destroy', ['jadwal' => $jadwal->id]) }}"
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
                                    {{-- <form action="{{ route('jadwal.destroy', ['jadwal' => $jadwal->id]) }}" method="post"
                                class="delete-form">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                <!-- Button Detail -->
                                <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#detailModal{{ $jadwal->id }}">
                                    Detail
                                </button> --}}
                                    <form method="GET" style="display:inline;">
                                        @csrf
                                        <button type="button" class="custom-btn btn-2" data-toggle="modal"
                                            data-target="#detailModal{{ $jadwal->id }}">
                                            Detail
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="detailModal{{ $jadwal->id }}" tabindex="-1"
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
                                                                            <th scope="row">Kepala Keluarga</th>
                                                                            <td>{{ $jadwal->nama }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Kartu Keluarga</th>
                                                                            <td>{{ $jadwal->kk }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Alamat</th>
                                                                            <td>{{ $jadwal->alamat }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">RT</th>
                                                                            <td>{{ $jadwal->rt }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">RW</th>
                                                                            <td>{{ $jadwal->rw }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Dusun</th>
                                                                            <td>{{ $jadwal->dusun }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Desa/Kelurahan</th>
                                                                            <td>{{ $jadwal->desa }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Kecamatan</th>
                                                                            <td>{{ $jadwal->kecamatan }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Kabupaten/Kota</th>
                                                                            <td>{{ $jadwal->kota }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Provinsi</th>
                                                                            <td>{{ $jadwal->provinsi }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">No Handphome</th>
                                                                            <td>{{ $jadwal->no_hp }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Puskesmas</th>
                                                                            <td>{{ $jadwal->puskesmas }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Postu/Posyandu Prima</th>
                                                                            <td>{{ $jadwal->postu }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row">Posyandu</th>
                                                                            <td>{{ $jadwal->posyandu }}</td>
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
                </tbody>
            </table>
        </div>
    </div>

    <style>
        .hidden {
            display: none;
        }
    </style>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".delete-form").on("submit", function(e) {
                e.preventDefault();
                const form = this;
                Swal.fire({
                    title: 'Apakah Anda Yakin?',
                    text: "Data akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
