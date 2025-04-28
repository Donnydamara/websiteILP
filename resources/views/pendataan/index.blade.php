@extends('layouts.master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title ?? __('Pendataan Penduduk') }}</h1>

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

    <!-- Card Grid Section -->
    <div class="row text-center">
        @php
            $cards = [
                ['title' => 'Jadwal Pendataan', 'route' => 'jadwal.index', 'color' => 'primary'],
                ['title' => 'Data Keluarga', 'route' => 'datakk.index', 'color' => 'secondary'],
                ['title' => 'Lingkungan Rumah', 'route' => 'lingkunganrumah.index', 'color' => 'success'],
                ['title' => 'Ibu Hamil', 'route' => 'ibu_hamil.index', 'color' => 'danger'],
                ['title' => 'Ibu Bersalin & Nifas', 'route' => 'ibu_bersalin_nifas.index', 'color' => 'warning'],
                ['title' => 'Kunjungan Rumah Bayi', 'route' => 'kunjungan_rumah_bayi.index', 'color' => 'info'],
                [
                    'title' => 'Kunjungan Bayi & Balita Prasekolah',
                    'route' => 'kunjungan_bayi_balita_prasekolah.index',
                    'color' => 'dark',
                ],
                ['title' => 'Kunjungan Usia Sekolah', 'route' => 'kunjungan_usia_sekolah.index', 'color' => 'light'],
                ['title' => 'Kunjungan Usia Dewasa', 'route' => 'kunjungan_usia_dewasa.index', 'color' => 'primary'],
                ['title' => 'Kunjungan Lansia', 'route' => 'kunjungan_lansia.index', 'color' => 'secondary'],
                ['title' => 'Kunjungan TBC', 'route' => 'kunjungan_tbc.index', 'color' => 'success'],
            ];
        @endphp

        @foreach ($cards as $card)
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <h5 class="card-title">{{ $card['title'] }}</h5>
                        <a href="{{ route($card['route']) }}" class="btn btn-{{ $card['color'] }}">
                            Masuk Ke Halaman List {{ $card['title'] }}
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('styles')
    <style>
        .card {
            border-radius: 10px;
            min-height: 200px;
            /* Menjaga agar semua kartu memiliki tinggi minimum yang sama */
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .card-title {
            font-size: 1.25rem;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .btn {
            margin-top: 15px;
            width: 100%;
        }
    </style>
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
