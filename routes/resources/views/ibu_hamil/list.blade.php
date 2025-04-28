@extends('layouts/master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('List Data Ibu Hamil') }}</h1>

    <!-- Main Content goes here -->
    {{-- 
    <a href="{{ route('ibu_hamil.createvalidate') }}" class="btn btn-primary mb-3">Tambah Data Ibu Hamil Baru</a> --}}
    {{-- <a href="{{ route('ibu_hamil.createvalidate') }}" class="btn btn-primary mb-3">Tambah Data Ibu Hamil Baru</a> --}}
    {{-- <a href="{{ route('ibu_hamil.create') }}" class="btn btn-primary mb-3">Tambah Data Ibu Hamil Baru</a> --}}
    <div class="row mb-3">
        <div class="col text-center">
            <!-- Tombol Tambah (untuk role 'kader') -->
            @if (Auth::check() && Auth::user()->role == 'kader')
                <button class="btn btn-primary mb-2" onclick="window.location.href='{{ route('ibu_hamil.createvalidate') }}'">
                    Tambah Data
                </button>
            @endif

            <!-- Tombol Kembali (untuk role 'admin') -->
            @if (Auth::check() && Auth::user()->role == 'admin')
                <form action="{{ route('pendataan.index') }}" method="GET" class="d-inline">
                    @csrf
                    <button class="btn btn-secondary mb-2">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </button>
                </form>
            @endif

            <!-- Dropdown Filter -->
            <form method="GET" action="{{ route('ibu_hamil.index') }}" class="d-inline mb-2">
                <select name="status" class="form-select" onchange="this.form.submit()"
                    style="display: inline-block; width: auto;">
                    <option value="ya" {{ $status == 'ya' ? 'selected' : '' }}>Ya</option>
                    <option value="selesai" {{ $status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="semua" {{ $status == 'semua' ? 'selected' : '' }}>Semua</option>
                </select>
            </form>

            <!-- Tombol Export ke Excel -->
            <form action="{{ route('ibu_hamil.index') }}" method="GET" class="d-inline">
                <!-- Hidden parameters -->
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
                    <th style="text-align: center">Status Kunjungan <br> Bersalin Nifas</th>
                    <th style="text-align: center">Kartu Keluarga</th>
                    <th style="text-align: center">NIK</th>
                    <th style="text-align: center">Nama</th>
                    <th style="text-align: center">Kunjungan</th>
                    <th style="text-align: center">Kehamilan Ke</th>
                    <th style="text-align: center">Aksi</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($ibuHamils as $dataKK)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td
                            class="status-box 
    {{ $dataKK->status === 'Ya' ? 'yes' : ($dataKK->status === 'Tidak' ? 'no' : 'done') }}">
                            {{ $dataKK->status }}
                        </td>

                        <td>{{ $dataKK->kk }}</td>
                        <td>{{ $dataKK->nik }}</td>
                        <td>{{ $dataKK->nama }}</td>
                        <td>{{ $dataKK->kunjungan }}</td>
                        <td>{{ $dataKK->kehamilan_ke }}</td>
                        <td>
                            <div class="d-flex">
                                @if (Auth::check() && Auth::user()->role == 'kader')
                                    <form action="{{ route('ibu_hamil.edit', ['id' => $dataKK->id]) }}" method="GET"
                                        style="display:inline;">
                                        @csrf
                                        <button class="edit">
                                            Edit
                                            <span></span>
                                        </button>
                                    </form>
                                    {{-- <a href="{{ route('ibu_hamil.edit', ['id' => $dataKK->id]) }}"
                                    class="btn btn-sm btn-primary mr-2">Edit</a> --}}
                                    <form action="{{ route('ibu_hamil.destroy', ['id' => $dataKK->id]) }}" method="post"
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
                                                        x1="80" x2="432" y1="112" y2="112"></line>
                                                    <path
                                                        d="M192,112V72h0a23.93,23.93,0,0,1,24-24h80a23.93,23.93,0,0,1,24,24h0v40"
                                                        style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px">
                                                    </path>
                                                    <line
                                                        style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"
                                                        x1="256" x2="256" y1="176" y2="400"></line>
                                                    <line
                                                        style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"
                                                        x1="184" x2="192" y1="176" y2="400"></line>
                                                    <line
                                                        style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"
                                                        x1="328" x2="320" y1="176" y2="400"></line>
                                                </svg>
                                            </span>
                                        </button>
                                    </form>
                                @endif
                                {{-- <form action="{{ route('ibu_hamil.destroy', ['id' => $dataKK->id]) }}" method="post"
                                    class="delete-form">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form> --}}
                                <form action="{{ route('ibu_hamil.show', ['id' => $dataKK->id]) }}" method="GET"
                                    style="display:inline;">
                                    @csrf
                                    <button class="custom-btn btn-2">
                                        Detail lengkap
                                    </button>
                                </form>
                                {{-- <a href="{{ route('ibu_hamil.show', ['id' => $dataKK->id]) }}"
                                    class="btn btn-sm btn-info ml-2">Detail Lengkap</a> --}}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    {{-- {{ $ibuHamils->links() }} --}}

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
                        text: "Menghapus data!",
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
                        text: "Menghapus data!",
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
