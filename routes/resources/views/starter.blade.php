@extends('layouts.master')
@section('content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-primary">Dashboard</h1>

    </div>

    <!-- Content Row -->
    <div class="row">
        <div class="col-lg-6">
            <!-- Pilih Desa dan Target Kunjungan Kepala Keluarga -->
            <div class="col-md-12 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <label for="desaDropdown" class="text-primary fw-bold">Pilih Desa</label>
                        <select id="desaDropdown" class="form-select">
                            <option value="">Total Desa Target</option>
                            @foreach ($desas as $desa)
                                <option value="{{ $desa->desa }}">
                                    {{ $desa->desa }}
                                </option>
                            @endforeach
                        </select>

                        <div class="mt-3">
                            <div class="text-xs fw-bold text-primary text-uppercase">
                                Target Kunjungan Kepala Keluarga (<span
                                    id="desaName">{{ request()->get('desa') ? request()->get('desa') : 'Semua Desa' }}</span>)
                            </div>
                            <div class="h5 mb-0 fw-bold text-gray-800" id="targetPenduduk">
                                {{ $totalTargetPenduduk }} / {{ $totalKKByDesa }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <a href="{{ route('lingkunganrumah.index') }}" class="text-decoration-none">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col me-2">
                                    <div class="text-xs fw-bold text-warning text-uppercase mb-1">
                                        Total Data Lingkungan
                                    </div>
                                    <div class="h5 mb-0 fw-bold text-gray-800">
                                        {{ $totalLingkungan_Rumah }}
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <i class="material-icons">home</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Total Gender Laki-Laki dan Perempuan -->
            <div class="col-md-12 mb-4">
                <a href="{{ route('datakk.index') }}" class="text-decoration-none">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col me-2">
                                    <div class="text-xs fw-bold text-info text-uppercase mb-1">
                                        Total Gender Laki Laki
                                    </div>
                                    <div class="h5 mb-0 fw-bold text-gray-800">
                                        {{ $totalLakiLaki }}
                                    </div>
                                    <div class="text-xs fw-bold text-info text-uppercase mb-1 mt-2">
                                        Total Gender Perempuan
                                    </div>
                                    <div class="h5 mb-0 fw-bold text-gray-800">
                                        {{ $totalPerempuan }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="material-icons">wc</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-12 mb-4">
                <a href="{{ route('ibu_hamil.index') }}" class="text-decoration-none">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col me-2">
                                    <div class="text-xs fw-bold text-danger text-uppercase mb-1">
                                        Jumlah Ibu Hamil
                                    </div>
                                    <div class="h5 mb-0 fw-bold text-gray-800">
                                        {{ $totalIbuHamilYa }}
                                    </div>

                                </div>
                                <div class="col-auto">
                                    <i class="material-icons">pregnant_woman</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-12 mb-4">
                <a href="{{ route('ibu_bersalin_nifas.index') }}" class="text-decoration-none">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col me-2">
                                    <div class="text-xs fw-bold text-primary text-uppercase mb-1">
                                        Total Ibu Bersalin Dan Nifas
                                    </div>
                                    <div class="h5 mb-0 fw-bold text-gray-800">
                                        {{ $totalIbu_Bersalin_Nifas }}
                                    </div>

                                </div>
                                <div class="col-auto">
                                    <i class="material-icons">pregnant_woman</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-12 mb-4">
                <a href="{{ route('kunjungan_rumah_bayi.index') }}" class="text-decoration-none">
                    <div class="card border-left-secondary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col me-2">
                                    <div class="text-xs fw-bold text-secondary text-uppercase mb-1">
                                        Total Kunjungan Rumah Bayi
                                    </div>
                                    <div class="h5 mb-0 fw-bold text-gray-800">
                                        {{ $totalKunjungan_Rumah_Bayi }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="material-icons">child_care</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-12 mb-4">
                <a href="{{ route('kunjungan_bayi_balita_prasekolah.index') }}" class="text-decoration-none">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col me-2">
                                    <div class="text-xs fw-bold text-info text-uppercase mb-1">
                                        Total Kunjungan Bayi Balita Dan Prasekolah
                                    </div>
                                    <div class="h5 mb-0 fw-bold text-gray-800">
                                        {{ $totalKunjungan_Bayi_Balita_Prasekolah }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="material-icons">child_friendly</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-12 mb-4">
                <a href="{{ route('kunjungan_usia_sekolah.index') }}" class="text-decoration-none">
                    <div class="card border-left-info shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col me-2">
                                    <div class="text-xs fw-bold text-info text-uppercase mb-1">
                                        Total Kunjungan Usia Sekolah
                                    </div>
                                    <div class="h5 mb-0 fw-bold text-gray-800">
                                        {{ $totalKunjungan_Usia_Sekolah }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="material-icons">school</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-md-12 mb-4">
                <a href="{{ route('kunjungan_usia_dewasa.index') }}" class="text-decoration-none">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col me-2">
                                    <div class="text-xs fw-bold text-warning text-uppercase mb-1">
                                        Kunjungan Usia Dewasa
                                    </div>
                                    <div class="h5 mb-0 fw-bold text-gray-800">
                                        {{ $totalKunjungan_Usia_Dewasa }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="material-icons">face</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-12 mb-4">
                <a href="{{ route('kunjungan_lansia.index') }}" class="text-decoration-none">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col me-2">
                                    <div class="text-xs fw-bold text-warning text-uppercase mb-1">
                                        Kunjungan Usia Lansia
                                    </div>
                                    <div class="h5 mb-0 fw-bold text-gray-800">
                                        {{ $totalKunjungan_Lansia }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="material-icons">elderly</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-12 mb-4">
                <a href="{{ route('kunjungan_tbc.index') }}" class="text-decoration-none">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col me-2">
                                    <div class="text-xs fw-bold text-warning text-uppercase mb-1">
                                        Kunjungan TBC
                                    </div>
                                    <div class="h5 mb-0 fw-bold text-gray-800">
                                        {{ $Kunjungan_TBC }}
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="material-icons">medical_services</i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <!-- Statistik Pendataan dan Chart -->
        <div class="col-lg-6">
            <div class="row">
                <!-- Statistik Pendataan -->
                <div class="col-md-12 mb-4">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 fw-bold text-primary">Statistik Pendataan</h6>
                        </div>
                        <div class="card-body">
                            <div id="donutchart" style="width: 100%;"></div>

                        </div>
                    </div>
                </div>

                <!-- Statistik Chart -->
                <div class="col-md-12 mb-2">
                    <div class="card shadow mb-2">
                        <div class="card-header py-2">
                            <h6 class="m-0 fw-bold text-primary">Statistik Tanda Bahaya</h6>
                        </div>
                        <div class="card-body p-2">
                            <!-- Chart Container -->
                            <canvas id="myChart" width="350" height="150"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-2">
                    <div class="card shadow mb-2">
                        <div class="card-header py-2">
                            <h6 class="m-0 fw-bold text-primary">Statistik TBC</h6>
                        </div>
                        <div class="card-body p-2">
                            <!-- Chart Container -->
                            <canvas id="tbc" width="350" height="150"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mb-2">
                    <a href="{{ route('tindak_lanjut_kunjungan.index') }}" class="text-decoration-none">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col me-2">
                                        <div class="text-xs fw-bold text-warning text-uppercase mb-1">
                                            Kunjungan Tindak Lanjut
                                        </div>
                                        <div class="h5 mb-0 fw-bold text-gray-800">
                                            {{ $totalTindakLanjutKunjungan }}
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="material-icons">report</i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>

    </div>





    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <script>
        $(document).ready(function() {
            $('#desaDropdown').change(function() {
                var desa = $(this).val();
                $.ajax({
                    url: "{{ route('getTargetByDesa') }}",
                    type: "GET",
                    data: {
                        desa: desa
                    },
                    success: function(response) {
                        $('#targetPenduduk').text(response.totalTargetPenduduk + ' / ' +
                            response.totalKKByDesa);
                        $('#desaName').text(desa ? desa : 'Semua Desa'); // Perbaikan di sini
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });

        // ====================================================
        const totalKunjungan_TBC = {{ $totalKunjungan_TBC }};
        // Add other data if needed

        const data = {
            labels: ['Kunjungan TBC'], // Modify labels as needed
            datasets: [{
                label: 'Total Kunjungan TBC',
                data: [totalKunjungan_TBC],
                fill: false,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            }]
        };

        const config = {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };

        window.onload = function() {
            const ctx = document.getElementById('tbc').getContext('2d');
            new Chart(ctx, config);
        };


        // ==========================================
        document.addEventListener('DOMContentLoaded', function() {
            const labels = ['Ibu Hamil', 'Ibu Bersalin Nifas', 'Kunjungan Bayi Balita Prasekolah',
                'Kunjungan Rumah Bayi'
            ];
            const data = {
                labels: labels,
                datasets: [{
                    label: 'Total Data dengan Tanda Bahaya',
                    data: [{{ $totalIbuHamilTandaBahaya }},
                        {{ $totalIbu_Bersalin_NifasTandaBahaya }},
                        {{ $total_Kunjungan_Bayi_Balita_PrasekolahTandaBahaya }},
                        {{ $totalKunjungan_Rumah_BayiTandaBahaya }}


                    ],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                }]
            };

            const config = {
                type: 'bar',
                data: data,
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            };

            var myChart = new Chart(
                document.getElementById('myChart'),
                config
            );
        });



        // ==========================================
        google.charts.load("current", {
            packages: ["corechart"]
        });
        google.charts.setOnLoadCallback(drawChart);

        // Initial draw
        drawChart();

        // Redraw chart on window resize
        window.addEventListener('resize', drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Task', 'Value'],
                ['Target Kepala Keluarga', {{ $totalTargetPenduduk }}],
                ['Total Kepala Keluarga', {{ $totalKKByDesa }}]
            ]);

            var options = {
                title: 'Target Pendataan Penduduk',
                pieHole: 0.4,
                width: '100%', // Responsive width
                height: '100%' // Responsive height
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }
    </script>


    <!-- Content Row -->
@endsection
