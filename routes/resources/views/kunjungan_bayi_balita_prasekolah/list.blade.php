@extends('layouts/master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('List Data Kunjungan Bayi Dan Anak Usia Prasekolah') }}</h1>

    <!-- Main Content goes here -->

    {{-- <a href="{{ route('kunjungan_bayi_balita_prasekolah.createvalidate') }}" class="btn btn-primary mb-3">Tambah Data Bayi
        Balita
        Prasekolah Baru</a> --}}
    {{-- <a href="{{ route('kunjungan_bayi_balita_prasekolah.create') }}" class="btn btn-primary mb-3">Tambah Data Bayi Balita
        Prasekolah Baru</a> --}}
    <div class="row mb-3">
        <div class="col text-center">
            <!-- Tombol Create untuk role 'kader' -->
            @if (Auth::check() && Auth::user()->role == 'kader')
                <button class="btn btn-primary mb-2"
                    onclick="window.location.href='{{ route('kunjungan_bayi_balita_prasekolah.createvalidate') }}'">
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                            <path fill="none" d="M0 0h24v24H0z"></path>
                            <path fill="currentColor" d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z"></path>
                        </svg>
                        Tambah Data
                    </span>
                </button>
            @endif

            <!-- Tombol Kembali untuk role 'admin' -->
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
                        <span>Back</span>
                    </button>
                </form>
            @endif

            <!-- Dropdown Filter Status -->
            <form method="GET" action="{{ route('kunjungan_bayi_balita_prasekolah.index') }}" class="d-inline mb-2">
                <select name="status" class="form-select" onchange="this.form.submit()"
                    style="display: inline-block; width: auto;">
                    <option value="ya" {{ $status == 'ya' ? 'selected' : '' }}>Ya</option>
                    <option value="selesai" {{ $status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="semua" {{ $status == 'semua' ? 'selected' : '' }}>Semua</option>
                </select>
            </form>

            <!-- Tombol Export ke Excel -->
            <form action="{{ route('kunjungan_bayi_balita_prasekolah.export') }}" method="GET" class="d-inline">
                <input type="hidden" name="status" value="{{ $status }}">
                <input type="hidden" name="export" value="true">
                <button type="submit" class="btn btn-success mb-2">
                    <i class="fas fa-file-excel"></i> Export to Excel
                </button>
            </form>
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
                    <th style="text-align: center">Status Kunjungan <br> Bayi Dan Usia Prasekolah</th>
                    <th style="text-align: center">Kartu Keluarga</th>
                    <th style="text-align: center">NIK</th>
                    <th style="text-align: center">Nama</th>
                    <th style="text-align: center">Jenis Kelamin</th>
                    <th style="text-align: center">Kunjungan</th>
                    <th style="text-align: center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kunjunganbayibalitaPrasekolahs as $dataKK)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td class="status-box" style="color: #fff">{{ $dataKK->status }}</td>
                        <td>{{ $dataKK->kk }}</td>
                        <td>{{ $dataKK->nik }}</td>
                        <td>{{ $dataKK->nama }}</td>
                        <td>{{ $dataKK->gender }}</td>
                        <td>{{ $dataKK->kunjungan }}</td>
                        <td>
                            <div class="d-flex">
                                @if (Auth::check() && Auth::user()->role == 'kader')
                                    <form
                                        action="{{ route('kunjungan_bayi_balita_prasekolah.edit', ['id' => $dataKK->id]) }}"
                                        method="GET" style="display:inline;">
                                        @csrf
                                        <button class="edit">
                                            Edit
                                            <span></span>
                                        </button>
                                    </form>

                                    <form
                                        action="{{ route('kunjungan_bayi_balita_prasekolah.destroy', ['id' => $dataKK->id]) }}"
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

                                <form action="{{ route('kunjungan_bayi_balita_prasekolah.show', ['id' => $dataKK->id]) }}"
                                    method="GET" style="display:inline;">
                                    @csrf
                                    <button class="custom-btn btn-2">
                                        Detail lengkap
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- {{ $kunjunganbayibalitaPrasekolahs->links() }} --}}

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
        document.querySelectorAll('.status-box').forEach(function(td) {
            if (td.textContent === "Tidak") {
                td.style.backgroundColor = 'red';
            } else if (td.textContent === "Ya") {
                td.style.backgroundColor = 'blue';
            } else if (td.textContent === "Selesai") {
                td.style.backgroundColor = 'green';
            }
        });
    </script>
@endsection
