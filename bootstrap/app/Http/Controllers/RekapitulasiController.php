<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ibu_Hamil;
use App\Models\Ibu_Bersalin_Nifas;
use App\Models\Kunjungan_Bayi_Balita_Prasekolah;
use App\Models\Kunjungan_Lansia;
use App\Models\Kunjungan_Rumah_Bayi;
use App\Models\Kunjungan_TBC;
use App\Models\Kunjungan_Usia_Dewasa;
use App\Models\Kunjungan_Usia_Sekolah;
use App\Models\TindakLanjutKunjungan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use App\Exports\RekapitulasiExport;
use Maatwebsite\Excel\Facades\Excel;

class RekapitulasiController extends Controller
{
    public function index(Request $request)
    {
        // Get the filter inputs from the request
        $startDate = $request->get('start_date') ? Carbon::parse($request->get('start_date')) : null;
        $endDate = $request->get('end_date') ? Carbon::parse($request->get('end_date')) : Carbon::now();
        $period = $request->get('period', 'week');  // Default to 'week' if no period is provided
        $userId = $request->get('user_id');
        $posyandu = $request->get('posyandu');

        // If no start date is provided, determine the start date based on the period
        if (!$startDate) {
            $startDate = $this->getStartDateByPeriod($period, $endDate);
        } else {
            $period = 'custom';  // If a start date is provided, treat it as a custom period
        }

        // Get the filtered data based on the given parameters
        $dataPerWeek = $this->getDataPerWeek($startDate, $endDate, $userId, $posyandu);

        // Get the users and posyandus for the filter options
        $users = \App\Models\User::select('id', 'name')->distinct()->get();
        $posyandus = \App\Models\JadwalPengumpulan::select('posyandu')->distinct()->get();

        // Handle Excel export
        if ($request->get('export') === 'excel') {
            $exportData = collect($dataPerWeek);

            return Excel::download(
                new RekapitulasiExport($exportData, $startDate->format('d-m-Y'), $endDate->format('d-m-Y')),
                'rekapitulasi_kunjungan.xlsx'
            );
        }

        // Return the view with the data and filter options
        return view('rekapitulasi_kunjungan_rumah.list', compact('dataPerWeek', 'period', 'users', 'posyandus', 'startDate', 'endDate'));
    }


    private function getStartDateByPeriod($period, $endDate)
    {
        switch ($period) {
            case 'week':
                return $endDate->copy()->subWeek()->startOfWeek();
            case 'month':
                return $endDate->copy()->subMonth()->startOfMonth();
            case 'year':
                return $endDate->copy()->subYear()->startOfYear();
            default:
                return $endDate->copy()->subWeek()->startOfWeek();
        }
    }

    private function getDataPerWeek($startDate, $endDate, $userId = null, $posyandu = null)
    {
        $dataPerWeek = [];
        $currentDate = $startDate->copy();

        while ($currentDate->lessThanOrEqualTo($endDate)) {
            $weekStartDate = $currentDate->copy()->startOfWeek();
            $weekEndDate = $currentDate->copy()->endOfWeek();

            if ($weekEndDate->greaterThan($endDate)) {
                $weekEndDate = $endDate;
            }

            $dataPerWeek[] = [
                'week_start' => $weekStartDate->format('Y-m-d'),
                'week_end' => $weekEndDate->format('Y-m-d'),
                'total_families_visited' => $this->getTotalFamiliesVisited($weekStartDate, $weekEndDate),
                'ibu_hamil_count' => $this->getCountByModel(Ibu_Hamil::class, $weekStartDate, $weekEndDate),
                'ibu_bersalin_nifas_count' => $this->getCountByModel(Ibu_Bersalin_Nifas::class, $weekStartDate, $weekEndDate),
                'kunjungan_bayi_balita_prasekolah_count' => $this->getCountByModel(Kunjungan_Bayi_Balita_Prasekolah::class, $weekStartDate, $weekEndDate),
                'kunjungan_usia_sekolah_count' => $this->getCountByModel(Kunjungan_Usia_Sekolah::class, $weekStartDate, $weekEndDate),
                'kunjungan_usia_dewasa_count' => $this->getCountByModel(Kunjungan_Usia_Dewasa::class, $weekStartDate, $weekEndDate),
                'kunjungan_lansia_count' => $this->getCountByModel(Kunjungan_Lansia::class, $weekStartDate, $weekEndDate),
                'tidak_status_count' => $this->getTidakStatusCount($weekStartDate, $weekEndDate),
                'tanda_bahaya_count' => $this->getTandaBahayaCount($weekStartDate, $weekEndDate),
                'tidak_status_count2' => $this->getTidakStatus2Count($weekStartDate, $weekEndDate),
                'TBC_count' => $this->getTBCCount($weekStartDate, $weekEndDate),
                'minum_TBC_count' => $this->getMinumTBCCount($weekStartDate, $weekEndDate),
                'edukasi_count' => $this->getEdukasiCount($weekStartDate, $weekEndDate),
                'lapor_Nakes_count' => $this->getLaporNakesCount($weekStartDate, $weekEndDate),
            ];

            $currentDate->addWeek();
        }

        return $dataPerWeek;
    }

    private function getTotalFamiliesVisited($startDate, $endDate)
    {
        $total_families_visited = 0;

        // Hitung jumlah keluarga dari masing-masing model yang relevan
        $total_families_visited += Ibu_Hamil::whereBetween('created_at', [$startDate, $endDate])->count();
        $total_families_visited += Ibu_Bersalin_Nifas::whereBetween('created_at', [$startDate, $endDate])->count();
        $total_families_visited += Kunjungan_Bayi_Balita_Prasekolah::whereBetween('created_at', [$startDate, $endDate])->count();
        $total_families_visited += Kunjungan_Lansia::whereBetween('created_at', [$startDate, $endDate])->count();
        $total_families_visited += Kunjungan_Usia_Dewasa::whereBetween('created_at', [$startDate, $endDate])->count();
        $total_families_visited += Kunjungan_Usia_Sekolah::whereBetween('created_at', [$startDate, $endDate])->count();
        // Tambahkan model lain yang relevan

        return $total_families_visited;
    }

    private function getCountByModel($modelClass, $startDate, $endDate)
    {
        return $modelClass::whereBetween('created_at', [$startDate, $endDate])->count();
    }

    private function getTidakStatusCount($startDate, $endDate)
    {
        $tidak_status_count = 0;

        // Hitung "Tidak" status dari masing-masing model yang relevan
        $tidak_status_count += Ibu_Hamil::whereBetween('created_at', [$startDate, $endDate])->where('status', 'Tidak')->count();
        $tidak_status_count += Ibu_Bersalin_Nifas::whereBetween('created_at', [$startDate, $endDate])->where('status', 'Tidak')->count();
        $tidak_status_count += Kunjungan_Bayi_Balita_Prasekolah::whereBetween('created_at', [$startDate, $endDate])->where('status', 'Tidak')->count();
        $tidak_status_count += Kunjungan_Rumah_Bayi::whereBetween('created_at', [$startDate, $endDate])->where('status', 'Tidak')->count();
        // Tambahkan model lain sesuai kebutuhan

        return $tidak_status_count;
    }

    private function getTandaBahayaCount($startDate, $endDate)
    {
        $tanda_bahaya_count = 0;

        // Hitung "Ya" status dari masing-masing model yang relevan
        $tanda_bahaya_count += Ibu_Hamil::whereBetween('created_at', [$startDate, $endDate])
            ->where(function ($query) {
                $query->where('demam_l2', 'Ada')
                    ->orWhere('sakit_kepala_l2', 'Ada')
                    ->orWhere('sulit_tidur_l2', 'Ada')
                    ->orWhere('diare_l2', 'Ada')
                    ->orWhere('tbc_l2', 'Ada')
                    ->orWhere('gerakan_janin_l2', 'Ada')
                    ->orWhere('jantung_sakit_l2', 'Ada')
                    ->orWhere('keluar_cairan_l2', 'Ada')
                    ->orWhere('kencing_manis_l2', 'Ada')
                    ->orWhere('nyeri_perut_l2', 'Ada');
            })
            ->distinct('nik')
            ->count();

        $tanda_bahaya_count += Ibu_Bersalin_Nifas::whereBetween('created_at', [$startDate, $endDate])
            ->where(function ($query) {
                $query->where('demam', 'Ya')
                    ->orWhere('perasaan', 'Ya')
                    ->orWhere('sakit', 'Ya')
                    ->orWhere('pernafasan', 'Ya')
                    ->orWhere('payudara', 'Ya')
                    ->orWhere('sakit_kepala', 'Ya')
                    ->orWhere('pendarahan', 'Ya')
                    ->orWhere('sakit_bagian_kelamin', 'Ya')
                    ->orWhere('keluar_cairan', 'Ya')
                    ->orWhere('pandangan_kabur', 'Ya')
                    ->orWhere('darah_nifas', 'Ya')
                    ->orWhere('keputihan', 'Ya')
                    ->orWhere('jantung_berdebar', 'Ya');
            })
            ->distinct('nik')
            ->count();

        $tanda_bahaya_count += Kunjungan_Bayi_Balita_Prasekolah::whereBetween('created_at', [$startDate, $endDate])
            ->where(function ($query) {
                $query->where('napas', 'Ya')
                    ->orWhere('batuk', 'Ya')
                    ->orWhere('diare', 'Ya')
                    ->orWhere('jmh_warna_kencing', 'Ya')
                    ->orWhere('warna_kulit', 'Ya')
                    ->orWhere('aktifitas', 'Ya')
                    ->orWhere('hisapan_bayi', 'Ya')
                    ->orWhere('pemberian_makan', 'Ya');
            })
            ->distinct('nik')
            ->count();

        $tanda_bahaya_count += Kunjungan_Rumah_Bayi::whereBetween('created_at', [$startDate, $endDate])
            ->where(function ($query) {
                $query->where('napas', 'Ya')
                    ->orWhere('aktifitas', 'Ya')
                    ->orWhere('warna_kulit', 'Ya')
                    ->orWhere('hisapan_bayi', 'Ya')
                    ->orWhere('kejang', 'Ya')
                    ->orWhere('suhu_tubuh', 'Ya')
                    ->orWhere('bab', 'Ya')
                    ->orWhere('jmhdanwarna_kencing', 'Ya')
                    ->orWhere('tali_pusar', 'Ya')
                    ->orWhere('mata', 'Ya')
                    ->orWhere('kulit', 'Ya')
                    ->orWhere('imunisasi', 'Ya');
            })
            ->distinct('nik')
            ->count();

        // Tambahkan model lain sesuai kebutuhan

        return $tanda_bahaya_count;
    }


    private function getTidakStatus2Count($startDate, $endDate)
    {
        $tidak_status_count2 = 0;

        // Hitung "Tidak" status dari masing-masing model yang relevan
        $tidak_status_count2 += Ibu_Hamil::whereBetween('created_at', [$startDate, $endDate])->where('status', 'Tidak')->count();
        $tidak_status_count2 += Ibu_Bersalin_Nifas::whereBetween('created_at', [$startDate, $endDate])->where('status', 'Tidak')->count();
        $tidak_status_count2 += Kunjungan_Bayi_Balita_Prasekolah::whereBetween('created_at', [$startDate, $endDate])->where('status', 'Tidak')->count();
        $tidak_status_count2 += Kunjungan_Rumah_Bayi::whereBetween('created_at', [$startDate, $endDate])->where('status', 'Tidak')->count();
        // Tambahkan model lain sesuai kebutuhan

        return $tidak_status_count2;
    }

    private function getTBCCount($startDate, $endDate)
    {
        $TBC_count = 0;

        // Hitung jumlah keluarga dari masing-masing model yang relevan
        $TBC_count += Kunjungan_TBC::whereBetween('created_at', [$startDate, $endDate])->count();
        // Tambahkan model lain yang relevan

        return $TBC_count;
    }

    private function getMinumTBCCount($startDate, $endDate)
    {
        $minum_TBC_count = 0;

        // Hitung "Tidak" status dari masing-masing model yang relevan
        $minum_TBC_count += Kunjungan_TBC::whereBetween('created_at', [$startDate, $endDate])->where('minum_obat_tbc', 'Tidak')->count();
        $minum_TBC_count += Kunjungan_Lansia::whereBetween('created_at', [$startDate, $endDate])->where('minum_obat_gula_darah_melitus', 'Tidak')->count();
        $minum_TBC_count += Kunjungan_Usia_Dewasa::whereBetween('created_at', [$startDate, $endDate])->where('minum_obat_gula_darah_melitus', 'Tidak')->count();
        // Tambahkan model lain sesuai kebutuhan

        return $minum_TBC_count;
    }

    private function getEdukasiCount($startDate, $endDate)
    {
        $edukasi_count = 0;

        // Hitung jumlah keluarga dari masing-masing model yang relevan
        $edukasi_count += TindakLanjutKunjungan::whereBetween('created_at', [$startDate, $endDate])->where('edukasi', 'Ya')->count();
        // Tambahkan model lain yang relevan

        return $edukasi_count;
    }

    private function getLaporNakesCount($startDate, $endDate)
    {
        $lapor_Nakes_count = 0;

        // Hitung jumlah keluarga dari masing-masing model yang relevan
        $lapor_Nakes_count += TindakLanjutKunjungan::whereBetween('created_at', [$startDate, $endDate])->where('lapor_nakes', 'Ya')->count();
        // Tambahkan model lain yang relevan

        return $lapor_Nakes_count;
    }
    public function exportAllPDF(Request $request)
    {
        try {
            $startDate = $request->get('start_date') ? Carbon::parse($request->get('start_date')) : null;
            $endDate = $request->get('end_date') ? Carbon::parse($request->get('end_date')) : Carbon::now();

            if (!$startDate) {
                $period = $request->get('period', 'week');
                $startDate = $this->getStartDateByPeriod($period, $endDate);
            } else {
                $period = 'custom';
            }

            // Data untuk ditampilkan per minggu
            $dataPerWeek = $this->getDataPerWeek($startDate, $endDate);

            // Load the PDF view with all necessary data
            $pdf = PDF::loadView('rekapitulasi_kunjungan_rumah.pdf', compact('dataPerWeek', 'period'))->setPaper('a4', 'landscape');

            // Stream the generated PDF to the browser
            return $pdf->stream('Semua Data Tindak Lanjut Kunjungan.pdf');
        } catch (\Exception $e) {
            // Handle any errors that occur during PDF generation
            return redirect()->back()->withErrors(['msg' => 'Terjadi kesalahan dalam mengexport data kunjungan.']);
        }
    }
}
