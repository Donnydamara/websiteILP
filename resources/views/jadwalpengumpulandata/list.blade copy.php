@extends('layouts/master')

@section('content')
<!-- Page Heading
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('List Tanggal Pengumpulan Data') }}</h1>

    <!-- Main Content goes here -->

<!-- {{-- <a href="{{ route('jadwal.create') }}" class="btn btn-primary mb-3">New Target Desa</a> --}}

    <div class="button-container">
        @if (Auth::check() && Auth::user()->role == 'kader')
            <button class="add" onclick="window.location.href='{{ route('jadwal.createjad') }}'">
                <span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z"></path>
                        <path fill="currentColor" d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z"></path>
                    </svg>
                    Tambah
                </span>
            </button>
        @endif

        @if (Auth::check() && Auth::user()->role == 'admin')
            <form action="{{ route('pendataan.index') }}" method="GET" style="display:inline;">
                @csrf
                <button class="back btn-2">
                    <svg height="16" width="16" xmlns="http://www.w3.org/2000/svg" version="1.1"
                        viewBox="0 0 1024 1024">
                        <path
                            d="M874.690416 495.52477c0 11.2973-9.168824 20.466124-20.466124 20.466124l-604.773963 0 188.083679 188.083679c7.992021 7.992021 7.992021 20.947078 0 28.939099-4.001127 3.990894-9.240455 5.996574-14.46955 5.996574-5.239328 0-10.478655-1.995447-14.479783-5.996574l-223.00912-223.00912c-3.837398-3.837398-5.996574-9.046027-5.996574-14.46955 0-5.433756 2.159176-10.632151 5.996574-14.46955l223.019353-223.029586c7.992021-7.992021 20.957311-7.992021 28.949332 0 7.992021 8.002254 7.992021 20.957311 0 28.949332l-188.073446 188.073446 604.753497 0C865.521592 475.058646 874.690416 484.217237 874.690416 495.52477z">
                        </path>
                    </svg>
                    <span>Back</span>
                </button>
            </form>
        @endif -->

<form method="GET" action="{{ route('jadwalpengumpulan.index') }}">
    <button type="submit" class="btn btn-success" name="export" value="1">Export Excel</button>
</form>
</div>



@if (session('message'))
<div class="alert alert-success">
    {{ session('message') }}
</div>
@endif
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
                        <!-- <button class="edit" onclick="window.location.href='{{ route('jadwal.edit', ['jadwal' => $jadwal->id]) }}'"> -->
                        Edit
                        <span></span>
                        </button>

                        {{--
                                    <a href="{{ route('jadwal.edit', ['jadwal' => $jadwal->id]) }}"
                        class="btn btn-sm btn-primary mr-2">Edit</a> --}}


                        <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST" onsubmit="">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger hidden">Hapus</button>
                        </form>
                        <form action="{{ route('jadwal.destroy', ['jadwal' => $jadwal->id]) }}" method="post" class="delete-form">
                            @csrf
                            @method('delete')
                            <button type="submit" class="delete">
                                <span class="delete__text">Hapus</span>
                                <span class="delete__icon">
                                    <svg class="svg" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg">
                                        <title></title>
                                        <path d="M112,112l20,320c.95,18.49,14.4,32,32,32H348c17.67,0,30.87-13.51,32-32l20-320" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px">
                                        </path>
                                        <line style="stroke:#fff;stroke-linecap:round;stroke-miterlimit:10;stroke-width:32px" x1="80" x2="432" y1="112" y2="112"></line>
                                        <path d="M192,112V72h0a23.93,23.93,0,0,1,24-24h80a23.93,23.93,0,0,1,24,24h0v40" style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px">
                                        </path>
                                        <line style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" x1="256" x2="256" y1="176" y2="400"></line>
                                        <line style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" x1="184" x2="192" y1="176" y2="400"></line>
                                        <line style="fill:none;stroke:#fff;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px" x1="328" x2="320" y1="176" y2="400"></line>
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
                            <button type="button" class="custom-btn btn-2" data-toggle="modal" data-target="#detailModal{{ $jadwal->id }}">
                                Detail
                            </button>
                            <!-- Modal -->
                            <div class="modal fade" id="detailModal{{ $jadwal->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Detail Anggota Keluarga
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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

{{-- {{ $jadwals->links() }} --}}
<!-- <style>
    .hidden {
        display: none;
    }
</style> -->
<!-- End of Main Content -->
@endsection

@push('scripts')
@yield('addJavascript')
<!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $("#data-table").DataTable({
            responsive: true, // Enable responsive mode
            searching: true, // Enable searching
            paging: true, // Enable pagination
            lengthMenu: [10, 25, 50, 75, 100], // Show 10, 25, 50, 75, 100 records per page
            pageLength: 10 // Default records per page
        });
    });
</script> -->
@endpush
@section('scripts')
<!-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('.delete-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(event) {
                    event.preventDefault();
                    const formElement = this;
                    Swal.fire({
                        title: 'Apa Kamu Yakin?',
                        text: "Menghapus Data Ini!",
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
    </script> -->
@endsection