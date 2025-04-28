@extends('layouts.master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Rekapitulasi Kader') }}</h1>

    {{-- Form for date selection --}}




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

    <div class="card-body">
        <div class="table-responsive">
            <div class="card-body mb-3">
                <form action="{{ route('rekapitulasi.index') }}" method="GET" class="row g-2 align-items-center">
                    <div class="col-auto">
                        <label for="start_date" class="sr-only">{{ __('Start Date') }}</label>
                        <input type="date" name="start_date" id="start_date" class="form-control"
                            value="{{ request('start_date') }}" placeholder="Start Date">
                    </div>
                    <div class="col-auto">
                        <label for="end_date" class="sr-only">{{ __('End Date') }}</label>
                        <input type="date" name="end_date" id="end_date" class="form-control"
                            value="{{ request('end_date', now()->format('Y-m-d')) }}" placeholder="End Date">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">{{ __('Filter') }}</button>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('rekapitulasi_kunjungan_rumah.pdf', ['start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
                            target="_blank" class="btn btn-secondary">{{ __('Export PDF') }}</a>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('rekapitulasi.export', ['export' => 'excel', 'start_date' => request('start_date'), 'end_date' => request('end_date')]) }}"
                            class="btn btn-success">{{ __('Export to Excel') }}</a>
                    </div>
                </form>
            </div>

            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead class="thead-light">
                    <tr>
                        <th rowspan="2">No</th>
                        <th rowspan="2">Jumlah Keluarga Yang Kunjungan</th>
                        <th colspan="6">Jumlah Sasaran Yang Dikunjungi</th>
                        <th colspan="2">Jumlah Ibu Hamil, Ibu Bersalin-Nifas, Balita & Apras Dengan Masalah Yang
                            Ditentukan</th>
                        <th colspan="3">Jumlah Usia Sekolah, Remaja, Usia Produktif Dan Lansia Dengan Masalah Yang
                            Ditentukan</th>
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
