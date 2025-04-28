@extends('layouts/master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('List Data Keluarga Dan Anggota Keluarga') }}</h1>

    <!-- Main Content goes here -->

    {{-- <a href="{{ route('datakk.create') }}" class="btn btn-primary mb-3">Tambah Data KK</a> --}}
    {{-- <a href="{{ route('datakk.createvalidate') }}" class="btn btn-primary mb-3">Tambah Data KK</a> --}}

    <div class="row mb-3">
        <div class="col text-center">
            <!-- Tombol Tambah Data (untuk role 'kader') -->
            @if (Auth::check() && Auth::user()->role == 'kader')
                <button class="btn btn-primary mb-2" onclick="window.location.href='{{ route('datakk.createvalidate') }}'">
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



            <!-- Tombol Export Excel -->
            <form method="GET" action="{{ route('datakk.index') }}" class="d-inline">
                <button type="submit" class="btn btn-success mb-2" name="export" value="1">
                    <i class="fas fa-file-excel"></i> Export Excel
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
                    <th style="text-align: center">Kartu Keluarga</th>
                    <th style="text-align: center">Nama</th>
                    <th style="text-align: center">Gender</th>
                    <th style="text-align: center">Hubungan Keluarga</th>
                    <th style="text-align: center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataKKs as $dataKK)
                    <tr>
                        <td scope="row">{{ $loop->iteration }}</td>
                        <td>{{ $dataKK->kk }}</td>
                        <td>{{ $dataKK->nama }}</td>
                        <td>{{ $dataKK->gender }}</td>
                        <td>{{ $dataKK->hubungan_keluarga }}</td>
                        <td>
                            <div class="d-flex">
                                @if (Auth::check() && Auth::user()->role == 'kader')
                                    <form action="{{ route('datakk.edit', ['id' => $dataKK->id]) }}" method="GET"
                                        style="display:inline;">
                                        @csrf
                                        <button class="edit">
                                            Edit
                                            <span></span>
                                        </button>
                                    </form>
                                @endif

                                <form action="{{ route('datakk.show', ['id' => $dataKK->id]) }}" method="GET"
                                    style="display:inline;">
                                    @csrf
                                    <button class="custom-btn btn-2">
                                        Detail lengkap
                                    </button>
                                </form>


                                {{-- <a href="{{ route('datakk.show', ['id' => $dataKK->id]) }}" class="custom-btn">Detail
                                    Lengkap</a> --}}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- {{ $dataKKs->links() }} --}}

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
    </script>
    <script>
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
    </script>
@endsection
