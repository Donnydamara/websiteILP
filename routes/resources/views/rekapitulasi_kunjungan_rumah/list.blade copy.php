@extends('layouts.master')

@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Rekapitulasi Kader') }}</h1>

{{-- Form for date selection --}}
<div class="mb-4">
    <form action="{{ route('rekapitulasi_kunjungan_rumah.index') }}" method="GET" class="form-inline">
        <div class="form-group mb-2">
            <label for="start_date" class="mr-2">Start Date:</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
        </div>
        <div class="form-group mx-sm-3 mb-2">
            <label for="end_date" class="mr-2">End Date:</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
        </div>
        <button type="submit" class="btn btn-primary mb-2">Filter</button>
    </form>
</div>

{{-- Export PDF Button --}}
<div class="mb-4">
    <a href="{{ route('rekapitulasi_kunjungan_rumah.pdf') }}" class="btn btn-primary" target="_blank">Export Data to
        PDF</a>
</div>

@if (session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('
            success ') }}',
        });
    });
</script>
@endif

<div class="table-responsive" style="text-align: center">
    <table class="table table-bordered table-striped" id="dataTable">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">Jumlah Keluarga Yang Kunjungan</th>
                <th colspan="6">Jumlah Sasaran Yang Dikunjungi</th>
                <th colspan="2">Jumlah Ibu Hamil, Ibu Bersalin-Nifas, Balita & Apras Dengan Masalah Yang Ditentukan
                </th>
                <th colspan="3">Jumlah Usia Sekolah, Remaja, Usia Produktif Dan Lansia Dengan Masalah Yang Ditentukan
                </th>
                <th colspan="2">Jumlah Sasaran Dengan Tindak Lanjut Yang Dilakukan</th>
            </tr>
            <tr>
                <th>Ibu Hamil</th>
                <th>Ibu Bersalin-Nifas</th>
                <th>Bayi, Balita & Apras</th>
                <th>Usia Sekolah & Remaja</th>
                <th>Usia Produktif</th>
                <th>Usia Lansia</th>
                <th>Tidak Akses Pelayanan</th>
                <th>Tanda Bahaya</th>
                <th>Tidak Akses Pelayanan</th>
                <th>Bergejala TBC</th>
                <th>Tidak Minum Obat teratur (TBC / Hipertensi / DM)</th>
                <th>Edukasi</th>
                <th>Lapor Nakes</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataPerWeek as $weekData)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $weekData['total_families_visited'] }}</td>
                <td>{{ $weekData['ibu_hamil_count'] }}</td>
                <td>{{ $weekData['ibu_bersalin_nifas_count'] }}</td>
                <td>{{ $weekData['kunjungan_bayi_balita_prasekolah_count'] }}</td>
                <td>{{ $weekData['kunjungan_usia_sekolah_count'] }}</td>
                <td>{{ $weekData['kunjungan_usia_dewasa_count'] }}</td>
                <td>{{ $weekData['kunjungan_lansia_count'] }}</td>
                <td>{{ $weekData['tidak_status_count'] }}</td>
                <td>{{ $weekData['tanda_bahaya_count'] }}</td>
                <td>{{ $weekData['tidak_status_count2'] }}</td>
                <td>{{ $weekData['TBC_count'] }}</td>
                <td>{{ $weekData['minum_TBC_count'] }}</td>
                <td>{{ $weekData['edukasi_count'] }}</td>
                <td>{{ $weekData['lapor_Nakes_count'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
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
@endsection