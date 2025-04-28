@extends('layouts.master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Daftar Tindak Lanjut Kunjungan Rumah</h1>

    <!-- Main Content -->
    {{-- <a href="{{ route('tindak_lanjut_kunjungan.create') }}" class="btn btn-primary mb-3">Tambah Data Tindak Lanjut
        Kunjungan</a> --}}
    {{-- <a href="{{ route('tindak_lanjut_kunjungan.export_pdf') }}" class="btn btn-primary" target="_blank">Download Semua Data
        PDF</a> --}}

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

    <div class="table-responsive">
        <div class="card-body mb-3">
            <!-- Form Filter -->
            <form method="GET" action="{{ route('tindak_lanjut_kunjungan.index') }}" class="row g-3 align-items-center">
                <!-- Filter Posyandu -->
                <div class="col-md-6">
                    <label for="posyandu" class="form-label">Pilih Posyandu:</label>
                    <select name="posyandu" id="posyandu" class="form-control" onchange="this.form.submit()">
                        <option value="">-- Semua Posyandu --</option>
                        @foreach ($posyandus as $item)
                            <option value="{{ $item }}" {{ request('posyandu') == $item ? 'selected' : '' }}>
                                {{ $item }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Status -->
                <div class="col-md-6">
                    <label for="status" class="form-label">Filter Status:</label>
                    <select name="status" id="status" class="form-control" onchange="this.form.submit()">
                        <option value="ya" {{ $status == 'ya' ? 'selected' : '' }}>Ya</option>
                        <option value="selesai" {{ $status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="semua" {{ $status == 'semua' ? 'selected' : '' }}>Semua</option>
                    </select>
                </div>
            </form>
        </div>

        <div class="card-body mb-3">
            <!-- Action Buttons -->
            <div class="d-flex align-items-center">
                <!-- Button Export to Excel -->
                <a href="{{ route('tindak_lanjut_kunjungan.export', ['status' => request('status'), 'posyandu' => request('posyandu'), 'export' => 'true']) }}"
                    class="btn btn-success mr-2">
                    Export Excel
                </a>

                <!-- Button Export to PDF -->
                <a href="{{ route('tindak_lanjut_kunjungan.exportAllPDF3', ['status' => request('status'), 'posyandu' => request('posyandu')]) }}"
                    target="_blank" class="btn btn-danger mr-2">
                    Export PDF
                </a>

                <!-- Button Tambah Data -->
                <button type="button" class="btn btn-primary d-flex align-items-center"
                    onclick="window.location.href='{{ route('tindak_lanjut_kunjungan.create') }}'">
                    <span class="mr-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20">
                            <path fill="none" d="M0 0h24v24H0z"></path>
                            <path fill="currentColor" d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z"></path>
                        </svg>
                    </span>
                    Tambah Data
                </button>
            </div>
        </div>



        <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Status</th>
                        <th>Posyandu</th>
                        <th>Waktu</th>
                        <th>Nama</th>
                        <th>NIK</th>

                        <th>No Telepon</th>

                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tindakLanjutKunjungans as $tindakLanjutKunjungan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td class="status-box 
    {{ $tindakLanjutKunjungan->status === 'Ya' ? 'yes' : ($tindakLanjutKunjungan->status === 'Tidak' ? 'no' : 'done') }}"
                                style="margin-left: 25px">
                                {{ $tindakLanjutKunjungan->status }}
                            </td>
                            <td>{{ $tindakLanjutKunjungan->posyandu }}</td>
                            <td>{{ $tindakLanjutKunjungan->waktu }}</td>
                            <td>{{ $tindakLanjutKunjungan->nama }}</td>
                            <td>{{ $tindakLanjutKunjungan->nik }}</td>

                            <td>{{ $tindakLanjutKunjungan->no_telepon }}</td>

                            <td>
                                <div class="d-flex">
                                    <button class="edit"
                                        onclick="window.location.href='{{ route('tindak_lanjut_kunjungan.edit', ['id' => $tindakLanjutKunjungan->id]) }}'">
                                        Edit
                                        <span></span>
                                    </button>
                                    {{-- <form
                                    action="{{ route('tindak_lanjut_kunjungan.edit', ['id' => $tindakLanjutKunjungan->id]) }}"
                                    method="GET" style="display:inline;">
                                    @csrf
                                    <button class="edit">
                                        Edit
                                        <span></span>
                                    </button>
                                </form> --}}
                                    <form
                                        action="{{ route('tindak_lanjut_kunjungan.destroy', ['id' => $tindakLanjutKunjungan->id]) }}"
                                        method="POST" onsubmit="">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger hidden">Hapus</button>
                                    </form>
                                    <form
                                        action="{{ route('tindak_lanjut_kunjungan.destroy', ['id' => $tindakLanjutKunjungan->id]) }}"
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
                                    <a href="{{ route('tindak_lanjut_kunjungan.pdf', $tindakLanjutKunjungan->id) }}"
                                        class="action_has has_saved" aria-label="save" type="button" target="_blank">
                                        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="20"
                                            height="20" stroke-linejoin="round" stroke-linecap="round" stroke-width="2"
                                            viewBox="0 0 24 24" stroke="currentColor" fill="none">
                                            <path d="m19,21H5c-1.1,0-2-.9-2-2V5c0-1.1.9-2,2-2h11l5,5v11c0,1.1-.9,2-2,2Z"
                                                stroke-linejoin="round" stroke-linecap="round" data-path="box"></path>
                                            <path d="M7 3L7 8L15 8" stroke-linejoin="round" stroke-linecap="round"
                                                data-path="line-top"></path>
                                            <path d="M17 20L17 13L7 13L7 20" stroke-linejoin="round"
                                                stroke-linecap="round" data-path="line-bottom">
                                            </path>
                                        </svg></a>
                                    {{-- <a href="{{ route('tindak_lanjut_kunjungan.edit', ['id' => $tindakLanjutKunjungan->id]) }}"
                                    class="btn btn-sm btn-primary mr-2">Edit</a> --}}
                                    {{-- <a href="{{ route('tindak_lanjut_kunjungan.pdf', $tindakLanjutKunjungan->id) }}"
                                    class="btn btn-primary" target="_blank">PDF</a> --}}
                                    {{-- <form
                                    action="{{ route('tindak_lanjut_kunjungan.destroy', ['id' => $tindakLanjutKunjungan->id]) }}"
                                    method="post" class="delete-form">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form> --}}
                                    <form method="GET" style="display:inline;">
                                        @csrf
                                        <button type="button" class="custom-btn btn-2" data-toggle="modal"
                                            data-target="#detailModal{{ $tindakLanjutKunjungan->id }}">
                                            Detail
                                        </button>

                                        <!-- Modal -->
                                        <div class="modal fade" id="detailModal{{ $tindakLanjutKunjungan->id }}"
                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="card">
                                                            <div class="card-header bg-primary text-white">
                                                                <h5 class="mb-0">Detail Tindak Lanjut Kunjungan</h5>
                                                            </div>
                                                            <div class="card-body">
                                                                <!-- Detail Content -->
                                                                <table class="table table-borderless">
                                                                    <tbody>
                                                                        <tr>
                                                                            <th scope="row" class="text-right">
                                                                                Posyandu:
                                                                            </th>
                                                                            <td>{{ $tindakLanjutKunjungan->posyandu }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row" class="text-right">Waktu:
                                                                            </th>
                                                                            <td>{{ $tindakLanjutKunjungan->waktu }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row" class="text-right">Nama:
                                                                            </th>
                                                                            <td>{{ $tindakLanjutKunjungan->nama }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row" class="text-right">NIK:
                                                                            </th>
                                                                            <td>{{ $tindakLanjutKunjungan->nik }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row" class="text-right">Tanggal
                                                                                Lahir:
                                                                            </th>
                                                                            <td>{{ $tindakLanjutKunjungan->tgl_lahir }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row" class="text-right">Alamat:
                                                                            </th>
                                                                            <td>{{ $tindakLanjutKunjungan->alamat }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row" class="text-right">No
                                                                                Telepon:
                                                                            </th>
                                                                            <td>{{ $tindakLanjutKunjungan->no_telepon }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row" class="text-right">Masalah
                                                                                Kesehatan:
                                                                            </th>
                                                                            <td>{{ $tindakLanjutKunjungan->masalah_kesehatan_yang_ditemukan }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th scope="row" class="text-right">Tindak
                                                                                Lanjut:
                                                                            </th>
                                                                            <td>{{ $tindakLanjutKunjungan->tindak_lanjut }}
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <!-- Add more details if needed -->
                                                            </div>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                        <!-- End of Modal -->
                                </div>
                            </td>
                        </tr>
                    @endforeach
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
            function handleFormSubmit(event) {
                const selectBox = document.getElementById('posyandu');
                if (!selectBox.value) {
                    // No value selected, redirect to download all PDFs
                    event.preventDefault();
                    window.open("{{ route('tindak_lanjut_kunjungan.export_pdf') }}", "_blank");
                }
            }
            document.addEventListener('DOMContentLoaded', function() {
                const deleteForms = document.querySelectorAll('.delete-form');
                deleteForms.forEach(form => {
                    form.addEventListener('submit', function(event) {
                        event.preventDefault();
                        const formElement = this;
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
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
