<?php

namespace App\Http\Controllers;

use App\Models\DataKK;
use App\Models\Kunjungan_Bayi_Balita_Prasekolah;
use App\Models\Kunjungan_Lansia;
use App\Models\Kunjungan_Rumah_Bayi;
use App\Models\Kunjungan_TBC;
use App\Models\Kunjungan_Usia_Dewasa;
use App\Models\Kunjungan_Usia_Sekolah;
use App\Models\Lingkungan_Rumah;
use App\Models\TindakLanjutKunjungan;
use App\Models\Ibu_Bersalin_Nifas;
use App\Models\Ibu_Hamil;
use App\Models\JadwalPengumpulan;
use App\Models\TargetDesa;
use Illuminate\Http\Request;

class StarterController extends Controller
{
    public function index()
    {
        $desas = TargetDesa::select('desa')->distinct()->get();
        $totalTargetPenduduk = TargetDesa::sum('target_penduduk');
        $selectedDesa = request()->get('desa');

        if ($selectedDesa) {
            $totalKKByDesa = JadwalPengumpulan::where('desa', $selectedDesa)->distinct('kk')->count('kk');
        } else {
            $totalKKByDesa = JadwalPengumpulan::distinct('kk')->count('kk');
        }


        $totalDataKK = DataKK::distinct('kk')->count('kk');
        $totalLakiLaki = DataKK::where('gender', 'Laki-laki')->count('kk');
        $totalPerempuan = DataKK::where('gender', 'Perempuan')->count('kk');
        $totalLingkungan_Rumah = Lingkungan_Rumah::distinct('kk')->count('kk');

        $totalIbuHamilTandaBahaya = Ibu_Hamil::whereIn('nik', function ($query) {
            $query->select('nik')
                ->from('Ibu_Hamil')
                ->where('demam_l2', 'Ada')
                ->orWhere('sakit_kepala_l2', 'Ada')
                ->orWhere('sulit_tidur_l2', 'Ada')
                ->orWhere('diare_l2', 'Ada')
                ->orWhere('tbc_l2', 'Ada')
                ->orWhere('gerakan_janin_l2', 'Ada')
                ->orWhere('jantung_sakit_l2', 'Ada')
                ->orWhere('keluar_cairan_l2', 'Ada')
                ->orWhere('kencing_manis_l2', 'Ada')
                ->orWhere('nyeri_perut_l2', 'Ada')
                ->orderBy('created_at', 'desc') // Urutkan berdasarkan created_at terbaru
                ->groupBy('nik')
                ->distinct(); // Ambil data terbaru per nik
        })->distinct('nik')->count('nik');

        $totalIbuHamilYa = Ibu_Hamil::where('status', 'Ya')->distinct('nik')->count('nik');

        $totalIbu_Bersalin_NifasTandaBahaya = Ibu_Bersalin_Nifas::whereIn('nik', function ($query) {
            $query->select('nik')
                ->from('Ibu_Bersalin_Nifas')
                ->where('demam', 'Ya')
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
                ->orWhere('jantung_berdebar', 'Ya')
                ->orderBy('created_at', 'desc')
                ->groupBy('nik')
                ->distinct(); // Ambil data terbaru per nik
        })->distinct('nik')->count('nik');
        $totalIbu_Bersalin_Nifas = Ibu_Bersalin_Nifas::where('status', 'Ya')->distinct('nik')->count('nik');

        $totalKunjungan_Rumah_BayiTandaBahaya = Kunjungan_Rumah_Bayi::whereIn('nik', function ($query) {
            $query->select('nik')
                ->from('Kunjungan_Rumah_Bayi')
                ->where('napas', 'Ya')
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
                ->orWhere('imunisasi', 'Ya')
                ->orderBy('created_at', 'desc')
                ->groupBy('nik')
                ->distinct(); // Ambil data terbaru per nik
        })->distinct('nik')->count('nik');
        $totalKunjungan_Rumah_Bayi = Kunjungan_Rumah_Bayi::where('status', 'Ya')->distinct('nik')->count('nik');

        $total_Kunjungan_Bayi_Balita_PrasekolahTandaBahaya = Kunjungan_Bayi_Balita_Prasekolah::whereIn('nik', function ($query) {
            $query->select('nik')
                ->from('Kunjungan_Bayi_Balita_Prasekolah')
                ->where('napas', 'Ya')->orWhere('batuk', 'Ya')->orWhere('diare', 'Ya')->orWhere('jmh_warna_kencing', 'Ya')->orWhere('warna_kulit', 'Ya')->orWhere('aktifitas', 'Ya')->orWhere('hisapan_bayi', 'Ya')->orWhere('pemberian_makan', 'Ya')
                ->orderBy('created_at', 'desc')
                ->groupBy('nik')
                ->distinct(); // Ambil data terbaru per nik
        })->distinct('nik')->count('nik');
        $totalKunjungan_Bayi_Balita_Prasekolah = Kunjungan_Bayi_Balita_Prasekolah::where('status', 'Ya')->distinct('nik')->count('nik');

        $Kunjungan_TBC = Kunjungan_TBC::whereIn('nik', function ($query) {
            $query->select('nik')
                ->from('Kunjungan_TBC')
                ->where('status', 'Ya')
                ->orderBy('created_at', 'desc')
                ->groupBy('nik');
        })
            ->distinct('nik')
            ->count('nik');


        $totalKunjungan_Usia_Sekolah = Kunjungan_Usia_Sekolah::where('status', 'Ya')->distinct('nik')->count('nik');


        $totalKunjungan_Usia_Dewasa = Kunjungan_Usia_Dewasa::where('status', 'Ya')->distinct('nik')->count('nik');
        $totalKunjungan_Lansia = Kunjungan_Lansia::where('status', 'Ya')->distinct('nik')->count('nik');
        $totalKunjungan_TBC = Kunjungan_TBC::where('status', 'Ya')->distinct('nik')->count('nik');
        $totalTindakLanjutKunjungan = TindakLanjutKunjungan::count('nik');

        return view("starter", compact('totalTindakLanjutKunjungan', 'totalKunjungan_Rumah_BayiTandaBahaya', 'total_Kunjungan_Bayi_Balita_PrasekolahTandaBahaya', 'Kunjungan_TBC', 'totalIbu_Bersalin_NifasTandaBahaya', 'totalIbuHamilTandaBahaya', 'totalPerempuan', 'totalLakiLaki', 'totalKunjungan_TBC', 'totalKunjungan_Lansia', 'totalKunjungan_Usia_Dewasa', 'totalKunjungan_Usia_Sekolah', 'totalKunjungan_Bayi_Balita_Prasekolah', 'totalKunjungan_Rumah_Bayi', 'desas', 'totalTargetPenduduk', 'totalKKByDesa', 'totalIbuHamilYa', 'totalDataKK', 'totalLingkungan_Rumah', 'totalIbu_Bersalin_Nifas'));
    }

    public function getTargetByDesa(Request $request)
    {
        $desa = $request->desa;

        if ($desa) {
            // Menghitung total target_penduduk dari TargetDesa berdasarkan desa yang dipilih
            $totalTargetPenduduk = TargetDesa::where('desa', $desa)->sum('target_penduduk');

            // Menghitung jumlah data KK dari JadwalPengumpulan berdasarkan desa yang dipilih
            $totalKKByDesa = JadwalPengumpulan::where('desa', $desa)->distinct('kk')->count('kk');
        } else {
            // Jika tidak ada desa yang dipilih, hitung total dari semua desa
            $totalTargetPenduduk = TargetDesa::sum('target_penduduk');
            $totalKKByDesa = JadwalPengumpulan::distinct('kk')->count('kk');
        }

        return response()->json([
            'totalTargetPenduduk' => $totalTargetPenduduk,
            'totalKKByDesa' => $totalKKByDesa,
        ]);
    }
}
