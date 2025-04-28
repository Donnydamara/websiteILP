<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan_Bayi_Balita_Prasekolah;
use App\Models\DataKK;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Exports\KunjunganBayiBalitaPrasekolahExport; // Import Export Class
use Maatwebsite\Excel\Facades\Excel;

class KunjunganBayiBalitaPrasekolahController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $userRole = Auth::user()->role;
        $status = $request->input('status', 'ya');
        $export = $request->input('export', false); // Cek apakah ini permintaan ekspor

        if ($userRole === 'admin') {
            $query = $status === 'semua'
                ? Kunjungan_Bayi_Balita_Prasekolah::query()
                : Kunjungan_Bayi_Balita_Prasekolah::where('status', $status);
        } else {
            $query = $status === 'semua'
                ? Kunjungan_Bayi_Balita_Prasekolah::where('id_user', $userId)
                : Kunjungan_Bayi_Balita_Prasekolah::where('id_user', $userId)->where('status', $status);
        }

        // Jika ekspor diminta
        if ($export) {
            $data = $query->get();
            return Excel::download(new KunjunganBayiBalitaPrasekolahExport($data), 'kunjungan_bayi_balita_prasekolah.xlsx');
        }

        $kunjunganbayibalitaPrasekolahs = $query->paginate(10);
        $filteredkunjunganbayibalitaPrasekolahs = $kunjunganbayibalitaPrasekolahs->unique('nik');

        return view('kunjungan_bayi_balita_prasekolah.list', [
            'kunjunganbayibalitaPrasekolahs' => $filteredkunjunganbayibalitaPrasekolahs,
            'status' => $status
        ]);
    }

    public function show($id, Request $request)
    {
        $dataKK = Kunjungan_Bayi_Balita_Prasekolah::findOrFail($id);
        $familyMembers = Kunjungan_Bayi_Balita_Prasekolah::where('nik', $dataKK->nik)->get();

        // Jika ekspor diminta
        if ($request->input('export', false)) {
            return Excel::download(new KunjunganBayiBalitaPrasekolahExport($familyMembers), 'family_members.xlsx');
        }

        return view('kunjungan_bayi_balita_prasekolah.detail', compact('dataKK', 'familyMembers'));
    }

    // Menampilkan form untuk menambahkan data lingkungan rumah baru
    public function create(Request $request)
    {
        $kk = $request->session()->get('kk');
        $nama = $request->session()->get('nama');
        return view('kunjungan_bayi_balita_prasekolah.create', compact('kk', 'nama'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kk' => 'required|integer',
            'status' => 'required|string',
        ]);

        if ($request->status === 'Ya') {
            $request->validate([
                'nik' => 'required|integer',
                'nama' => 'required|string',
                'tgl_lahir' => 'required|date',
                'tmp_lahir' => 'required|string',
                'gender' => 'required|string',
                'kunjungan' => 'required|string',
                'tgl_kunjungan' => 'required|date',
                'suhu_tubuh' => 'required|string',
                'buku_kia' => 'required|string',
                'tgl_timbang_ukur' => 'required|date',
                'tempat_timbang_ukur' => 'required|string',
                'petugas_timbang_ukur' => 'required|string',
                'bb_hasil_timbang_ukur' => 'required|string',
                'pb_tb_hasil_timbang_ukur' => 'required|string',
                'lk_hasil_timbang_ukur' => 'required|string',
                'jenis_imunisasi' => 'nullable|string',
                'hepatitis_b_0bulan' => 'nullable|date',
                'bcg_0bulan' => 'nullable|date',
                'polio_0bulan' => 'nullable|date',
                'bcg_1bulan' => 'nullable|date',
                'polio_1bulan' => 'nullable|date',
                'dpt_hb_hib_1_2bulan' => 'nullable|date',
                'polio_2_2bulan' => 'nullable|date',
                'pcv_1_2bulan' => 'nullable|date',
                'rv_1_2bulan' => 'nullable|date',
                'dpt_hb_hib_2_3bulan' => 'nullable|date',
                'polio_3_3bulan' => 'nullable|date',
                'pcv_2_3bulan' => 'nullable|date',
                'rv_2_3bulan' => 'nullable|date',
                'dpt_hb_hib_3_4bulan' => 'nullable|date',
                'polio_4_4bulan' => 'nullable|date',
                'polio_suntik_4bulan' => 'nullable|date',
                'rv_3_4bulan' => 'nullable|date',
                'campak_rubelia_9bulan' => 'nullable|date',
                'polio_suntik_2_9bulan' => 'nullable|date',
                'je_10bulan' => 'nullable|date',
                'pv_3_12bulan' => 'nullable|date',
                'dpt_lanjut_1_18bulan' => 'nullable|date',
                'campak_lanjut_18bulan' => 'nullable|date',
                'makanan_pokok' => 'required|string',
                'makanan_protein_hewan' => 'required|string',
                'makanan_protein_nabati' => 'required|string',
                'makanan_lemak' => 'required|string',
                'sayur_buah' => 'required|string',
                'oc_ada' => 'required|string',
                'oc_tgl' => 'nullable|date',
                'kv_jenis' => 'nullable|string',
                'tgl_kv_mulai' => 'nullable|date',
                'tgl_kv_selesai' => 'nullable|date',
                'makan_tambah_ada' => 'required|string',
                'makan_tambah_kepatuhan' => 'required|string',
                'edukasi' => 'required|string',
                'tgl_kunjungan2' => 'nullable|date',
                'napas' => 'required|string',
                'batuk' => 'required|string',
                'diare' => 'required|string',
                'jmh_warna_kencing' => 'required|string',
                'warna_kulit' => 'required|string',
                'aktifitas' => 'required|string',
                'hisapan_bayi' => 'required|string',
                'pemberian_makan' => 'required|string',
                'pengingat_periksa_postu' => 'required|string',
                'lapor_nakes' => 'required|string',
                'created_at' => 'nullable|date',
                'updated_at' => 'nullable|date',
            ]);
        } else {
            $request->merge([
                'nik' => null,
                'nama' => null,
                'tgl_lahir' => null,
                'tmp_lahir' => null,
                'gender' => null,
                'kunjungan' => null,
                'tgl_kunjungan' => null,
                'suhu_tubuh' => null,
                'buku_kia' => null,
                'tgl_timbang_ukur' => null,
                'tempat_timbang_ukur' => null,
                'petugas_timbang_ukur' => null,
                'bb_hasil_timbang_ukur' => null,
                'pb_tb_hasil_timbang_ukur' => null,
                'lk_hasil_timbang_ukur' => null,
                'jenis_imunisasi' => null,
                'hepatitis_b_0bulan' => null,
                'bcg_0bulan' => null,
                'polio_0bulan' => null,
                'bcg_1bulan' => null,
                'polio_1bulan' => null,
                'dpt_hb_hib_1_2bulan' => null,
                'polio_2_2bulan' => null,
                'pcv_1_2bulan' => null,
                'rv_1_2bulan' => null,
                'dpt_hb_hib_2_3bulan' => null,
                'polio_3_3bulan' => null,
                'pcv_2_3bulan' => null,
                'rv_2_3bulan' => null,
                'dpt_hb_hib_3_4bulan' => null,
                'polio_4_4bulan' => null,
                'polio_suntik_4bulan' => null,
                'rv_3_4bulan' => null,
                'campak_rubelia_9bulan' => null,
                'polio_suntik_2_9bulan' => null,
                'je_10bulan' => null,
                'pv_3_12bulan' => null,
                'dpt_lanjut_1_18bulan' => null,
                'campak_lanjut_18bulan' => null,
                'makanan_pokok' => null,
                'makanan_protein_hewan' => null,
                'makanan_protein_nabati' => null,
                'makanan_lemak' => null,
                'sayur_buah' => null,
                'oc_ada' => null,
                'oc_tgl' => null,
                'kv_jenis' => null,
                'tgl_kv_mulai' => null,
                'tgl_kv_selesai' => null,
                'makan_tambah_ada' => null,
                'makan_tambah_kepatuhan' => null,
                'edukasi' => null,
                'napas' => null,
                'batuk' => null,
                'diare' => null,
                'jmh_warna_kencing' => null,
                'warna_kulit' => null,
                'aktifitas' => null,
                'hisapan_bayi' => null,
                'pemberian_makan' => null,
                'pengingat_periksa_postu' => null,
                'lapor_nakes' => null,
            ]);
        }
        $validatedData['id_user'] = Auth::id();

        Kunjungan_Bayi_Balita_Prasekolah::create($request->all());

        session(['kk' => $request->kk, 'nama' => $request->nama]);

        return redirect()->route('kunjungan_usia_sekolah.create')->with('success', 'Data ibu hamil berhasil ditambahkan.');
    }

    public function create2(Request $request, $id = null)
    {
        if ($id) {
            $kunjunganbayibalitaPrasekolah = Kunjungan_Bayi_Balita_Prasekolah::find($id);
            $kk = $kunjunganbayibalitaPrasekolah ? $kunjunganbayibalitaPrasekolah->kk : null;
            $nama = $kunjunganbayibalitaPrasekolah ? $kunjunganbayibalitaPrasekolah->nama : null;
            $nik = $kunjunganbayibalitaPrasekolah ? $kunjunganbayibalitaPrasekolah->nik : null;
        } else {
            $kk = $request->session()->get('kk');
            $nama = $request->session()->get('nama');
            $nik = $request->session()->get('nik');

            if (!$kk) {
                $kunjunganbayibalitaPrasekolah = Kunjungan_Bayi_Balita_Prasekolah::orderBy('created_at', 'desc')->first();
                $kk = $kunjunganbayibalitaPrasekolah ? $kunjunganbayibalitaPrasekolah->kk : null;
                $nama = $kunjunganbayibalitaPrasekolah ? $kunjunganbayibalitaPrasekolah->nama : null;
                $nik = $kunjunganbayibalitaPrasekolah ? $kunjunganbayibalitaPrasekolah->nik : null;
            }
        }

        return view('kunjungan_bayi_balita_prasekolah.createdetail', compact('kk', 'nama', 'nik'));
    }



    // Menyimpan data lingkungan rumah baru ke dalam database
    public function store2(Request $request)
    {
        $validatedData = $request->validate([
            'kk' => 'required|integer',
            'nik' => 'required|integer',
            'nama' => 'required|string',
            'status' => 'required|string',
        ]);

        if ($request->status === 'Ya') {
            $additionalData = $request->validate([

                'tgl_lahir' => 'required|date',
                'tmp_lahir' => 'required|string',
                'gender' => 'required|string',
                'kunjungan' => 'required|string',
                'tgl_kunjungan' => 'required|date',
                'suhu_tubuh' => 'required|string',
                'buku_kia' => 'required|string',
                'tgl_timbang_ukur' => 'required|date',
                'tempat_timbang_ukur' => 'required|string',
                'petugas_timbang_ukur' => 'required|string',
                'bb_hasil_timbang_ukur' => 'required|string',
                'pb_tb_hasil_timbang_ukur' => 'required|string',
                'lk_hasil_timbang_ukur' => 'required|string',
                'jenis_imunisasi' => 'nullable|string',
                'hepatitis_b_0bulan' => 'nullable|date',
                'bcg_0bulan' => 'nullable|date',
                'polio_0bulan' => 'nullable|date',
                'bcg_1bulan' => 'nullable|date',
                'polio_1bulan' => 'nullable|date',
                'dpt_hb_hib_1_2bulan' => 'nullable|date',
                'polio_2_2bulan' => 'nullable|date',
                'pcv_1_2bulan' => 'nullable|date',
                'rv_1_2bulan' => 'nullable|date',
                'dpt_hb_hib_2_3bulan' => 'nullable|date',
                'polio_3_3bulan' => 'nullable|date',
                'pcv_2_3bulan' => 'nullable|date',
                'rv_2_3bulan' => 'nullable|date',
                'dpt_hb_hib_3_4bulan' => 'nullable|date',
                'polio_4_4bulan' => 'nullable|date',
                'polio_suntik_4bulan' => 'nullable|date',
                'rv_3_4bulan' => 'nullable|date',
                'campak_rubelia_9bulan' => 'nullable|date',
                'polio_suntik_2_9bulan' => 'nullable|date',
                'je_10bulan' => 'nullable|date',
                'pv_3_12bulan' => 'nullable|date',
                'dpt_lanjut_1_18bulan' => 'nullable|date',
                'campak_lanjut_18bulan' => 'nullable|date',
                'makanan_pokok' => 'required|string',
                'makanan_protein_hewan' => 'required|string',
                'makanan_protein_nabati' => 'required|string',
                'makanan_lemak' => 'required|string',
                'sayur_buah' => 'required|string',
                'oc_ada' => 'required|string',
                'oc_tgl' => 'nullable|date',
                'kv_jenis' => 'nullable|string',
                'tgl_kv_mulai' => 'nullable|date',
                'tgl_kv_selesai' => 'nullable|date',
                'makan_tambah_ada' => 'required|string',
                'makan_tambah_kepatuhan' => 'required|string',
                'edukasi' => 'required|string',
                'tgl_kunjungan2' => 'nullable|date',
                'napas' => 'required|string',
                'batuk' => 'required|string',
                'diare' => 'required|string',
                'jmh_warna_kencing' => 'required|string',
                'warna_kulit' => 'required|string',
                'aktifitas' => 'required|string',
                'hisapan_bayi' => 'required|string',
                'pemberian_makan' => 'required|string',
                'pengingat_periksa_postu' => 'required|string',
                'lapor_nakes' => 'required|string',
                'created_at' => 'nullable|date',
                'updated_at' => 'nullable|date',
            ]);
            $validatedData = array_merge($validatedData, $additionalData);
        } else {
            $validatedData = array_merge($validatedData, [

                'tgl_lahir' => null,
                'tmp_lahir' => null,
                'gender' => null,
                'kunjungan' => null,
                'tgl_kunjungan' => null,
                'suhu_tubuh' => null,
                'buku_kia' => null,
                'tgl_timbang_ukur' => null,
                'tempat_timbang_ukur' => null,
                'petugas_timbang_ukur' => null,
                'bb_hasil_timbang_ukur' => null,
                'pb_tb_hasil_timbang_ukur' => null,
                'lk_hasil_timbang_ukur' => null,
                'jenis_imunisasi' => null,
                'hepatitis_b_0bulan' => null,
                'bcg_0bulan' => null,
                'polio_0bulan' => null,
                'bcg_1bulan' => null,
                'polio_1bulan' => null,
                'dpt_hb_hib_1_2bulan' => null,
                'polio_2_2bulan' => null,
                'pcv_1_2bulan' => null,
                'rv_1_2bulan' => null,
                'dpt_hb_hib_2_3bulan' => null,
                'polio_3_3bulan' => null,
                'pcv_2_3bulan' => null,
                'rv_2_3bulan' => null,
                'dpt_hb_hib_3_4bulan' => null,
                'polio_4_4bulan' => null,
                'polio_suntik_4bulan' => null,
                'rv_3_4bulan' => null,
                'campak_rubelia_9bulan' => null,
                'polio_suntik_2_9bulan' => null,
                'je_10bulan' => null,
                'pv_3_12bulan' => null,
                'dpt_lanjut_1_18bulan' => null,
                'campak_lanjut_18bulan' => null,
                'makanan_pokok' => null,
                'makanan_protein_hewan' => null,
                'makanan_protein_nabati' => null,
                'makanan_lemak' => null,
                'sayur_buah' => null,
                'oc_ada' => null,
                'oc_tgl' => null,
                'kv_jenis' => null,
                'tgl_kv_mulai' => null,
                'tgl_kv_selesai' => null,
                'makan_tambah_ada' => null,
                'makan_tambah_kepatuhan' => null,
                'edukasi' => null,
                'napas' => null,
                'batuk' => null,
                'diare' => null,
                'jmh_warna_kencing' => null,
                'warna_kulit' => null,
                'aktifitas' => null,
                'hisapan_bayi' => null,
                'pemberian_makan' => null,
                'pengingat_periksa_postu' => null,
                'lapor_nakes' => null,
            ]);
        }
        $validatedData['id_user'] = Auth::id();

        $kunjunganbayibalitaPrasekolah = Kunjungan_Bayi_Balita_Prasekolah::create($validatedData);

        session(['kk' => $request->kk, 'nama' => $request->nama, 'nik' => $request->nik]);

        return redirect()->route('kunjungan_bayi_balita_prasekolah.show', $kunjunganbayibalitaPrasekolah->id)->with('success', 'Data ibu hamil berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit data lingkungan rumah
    public function edit(Request $request, $id = null)
    {
        if ($id) {
            $kunjunganbayibalitaPrasekolah = Kunjungan_Bayi_Balita_Prasekolah::find($id);
            $kk = $kunjunganbayibalitaPrasekolah ? $kunjunganbayibalitaPrasekolah->kk : null;
            $nama = $kunjunganbayibalitaPrasekolah ? $kunjunganbayibalitaPrasekolah->nama : null;
            $nik = $kunjunganbayibalitaPrasekolah ? $kunjunganbayibalitaPrasekolah->nik : null;
        } else {
            $kk = $request->session()->get('kk');
            $nama = $request->session()->get('nama');
            $nik = $request->session()->get('nik');

            if (!$kk) {
                $kunjunganbayibalitaPrasekolah = Kunjungan_Bayi_Balita_Prasekolah::orderBy('created_at', 'desc')->first();
                $kk = $kunjunganbayibalitaPrasekolah ? $kunjunganbayibalitaPrasekolah->kk : null;
                $nama = $kunjunganbayibalitaPrasekolah ? $kunjunganbayibalitaPrasekolah->nama : null;
                $nik = $kunjunganbayibalitaPrasekolah ? $kunjunganbayibalitaPrasekolah->nik : null;
            }
        }

        return view('kunjungan_bayi_balita_prasekolah.edit', compact('kk', 'nama', 'nik', 'kunjunganbayibalitaPrasekolah'));
        // $kunjunganbayibalitaPrasekolah = Kunjungan_Bayi_Balita_Prasekolah::findOrFail($id);
        // return view('kunjungan_bayi_balita_prasekolah.edit', compact('kunjunganbayibalitaPrasekolah'));
    }

    // Menyimpan perubahan pada data lingkungan rumah ke dalam database
    public function update(Request $request, $id)
    {
        // Validasi input dari formulir
        $request->validate([
            'kk' => 'required|integer',
            'nik' => 'required|integer',
            'nama' => 'required|string',
            'status' => 'required|string',
        ]);

        if ($request->status === 'Ya' || $request->status === 'Selesai') {
            $request->validate([

                'tgl_lahir' => 'required|date',
                'tmp_lahir' => 'required|string',
                'gender' => 'required|string',
                'kunjungan' => 'required|string',
                'tgl_kunjungan' => 'required|date',
                'suhu_tubuh' => 'required|string',
                'buku_kia' => 'required|string',
                'tgl_timbang_ukur' => 'required|date',
                'tempat_timbang_ukur' => 'required|string',
                'petugas_timbang_ukur' => 'required|string',
                'bb_hasil_timbang_ukur' => 'required|string',
                'pb_tb_hasil_timbang_ukur' => 'required|string',
                'lk_hasil_timbang_ukur' => 'required|string',
                'jenis_imunisasi' => 'nullable|string',
                'hepatitis_b_0bulan' => 'nullable|date',
                'bcg_0bulan' => 'nullable|date',
                'polio_0bulan' => 'nullable|date',
                'bcg_1bulan' => 'nullable|date',
                'polio_1bulan' => 'nullable|date',
                'dpt_hb_hib_1_2bulan' => 'nullable|date',
                'polio_2_2bulan' => 'nullable|date',
                'pcv_1_2bulan' => 'nullable|date',
                'rv_1_2bulan' => 'nullable|date',
                'dpt_hb_hib_2_3bulan' => 'nullable|date',
                'polio_3_3bulan' => 'nullable|date',
                'pcv_2_3bulan' => 'nullable|date',
                'rv_2_3bulan' => 'nullable|date',
                'dpt_hb_hib_3_4bulan' => 'nullable|date',
                'polio_4_4bulan' => 'nullable|date',
                'polio_suntik_4bulan' => 'nullable|date',
                'rv_3_4bulan' => 'nullable|date',
                'campak_rubelia_9bulan' => 'nullable|date',
                'polio_suntik_2_9bulan' => 'nullable|date',
                'je_10bulan' => 'nullable|date',
                'pv_3_12bulan' => 'nullable|date',
                'dpt_lanjut_1_18bulan' => 'nullable|date',
                'campak_lanjut_18bulan' => 'nullable|date',
                'makanan_pokok' => 'required|string',
                'makanan_protein_hewan' => 'required|string',
                'makanan_protein_nabati' => 'required|string',
                'makanan_lemak' => 'required|string',
                'sayur_buah' => 'required|string',
                'oc_ada' => 'required|string',
                'oc_tgl' => 'nullable|date',
                'kv_jenis' => 'nullable|string',
                'tgl_kv_mulai' => 'nullable|date',
                'tgl_kv_selesai' => 'nullable|date',
                'makan_tambah_ada' => 'required|string',
                'makan_tambah_kepatuhan' => 'required|string',
                'edukasi' => 'required|string',
                'tgl_kunjungan2' => 'nullable|date',
                'napas' => 'required|string',
                'batuk' => 'required|string',
                'diare' => 'required|string',
                'jmh_warna_kencing' => 'required|string',
                'warna_kulit' => 'required|string',
                'aktifitas' => 'required|string',
                'hisapan_bayi' => 'required|string',
                'pemberian_makan' => 'required|string',
                'pengingat_periksa_postu' => 'required|string',
                'lapor_nakes' => 'required|string',
                'created_at' => 'nullable|date',
                'updated_at' => 'nullable|date',
            ]);
        } else {
            $request->merge([
                'tgl_lahir' => null,
                'tmp_lahir' => null,
                'gender' => null,
                'kunjungan' => null,
                'tgl_kunjungan' => null,
                'suhu_tubuh' => null,
                'buku_kia' => null,
                'tgl_timbang_ukur' => null,
                'tempat_timbang_ukur' => null,
                'petugas_timbang_ukur' => null,
                'bb_hasil_timbang_ukur' => null,
                'pb_tb_hasil_timbang_ukur' => null,
                'lk_hasil_timbang_ukur' => null,
                'jenis_imunisasi' => null,
                'hepatitis_b_0bulan' => null,
                'bcg_0bulan' => null,
                'polio_0bulan' => null,
                'bcg_1bulan' => null,
                'polio_1bulan' => null,
                'dpt_hb_hib_1_2bulan' => null,
                'polio_2_2bulan' => null,
                'pcv_1_2bulan' => null,
                'rv_1_2bulan' => null,
                'dpt_hb_hib_2_3bulan' => null,
                'polio_3_3bulan' => null,
                'pcv_2_3bulan' => null,
                'rv_2_3bulan' => null,
                'dpt_hb_hib_3_4bulan' => null,
                'polio_4_4bulan' => null,
                'polio_suntik_4bulan' => null,
                'rv_3_4bulan' => null,
                'campak_rubelia_9bulan' => null,
                'polio_suntik_2_9bulan' => null,
                'je_10bulan' => null,
                'pv_3_12bulan' => null,
                'dpt_lanjut_1_18bulan' => null,
                'campak_lanjut_18bulan' => null,
                'makanan_pokok' => null,
                'makanan_protein_hewan' => null,
                'makanan_protein_nabati' => null,
                'makanan_lemak' => null,
                'sayur_buah' => null,
                'oc_ada' => null,
                'oc_tgl' => null,
                'kv_jenis' => null,
                'tgl_kv_mulai' => null,
                'tgl_kv_selesai' => null,
                'makan_tambah_ada' => null,
                'makan_tambah_kepatuhan' => null,
                'edukasi' => null,
                'napas' => null,
                'batuk' => null,
                'diare' => null,
                'jmh_warna_kencing' => null,
                'warna_kulit' => null,
                'aktifitas' => null,
                'hisapan_bayi' => null,
                'pemberian_makan' => null,
                'pengingat_periksa_postu' => null,
                'lapor_nakes' => null,
            ]);
        }

        $kunjunganbayibalitaPrasekolah = Kunjungan_Bayi_Balita_Prasekolah::findOrFail($id);
        $kunjunganbayibalitaPrasekolah->update($request->all());

        return redirect()->route('kunjungan_bayi_balita_prasekolah.index')->with('success', 'Data ibu hamil berhasil diperbarui.');
    }
    // Menampilkan form untuk mengedit data lingkungan rumah
    public function edit2(Request $request, $id = null)
    {
        if ($id) {
            $kunjunganbayibalitaPrasekolah = Kunjungan_Bayi_Balita_Prasekolah::find($id);
            $kk = $kunjunganbayibalitaPrasekolah ? $kunjunganbayibalitaPrasekolah->kk : null;
            $nama = $kunjunganbayibalitaPrasekolah ? $kunjunganbayibalitaPrasekolah->nama : null;
            $nik = $kunjunganbayibalitaPrasekolah ? $kunjunganbayibalitaPrasekolah->nik : null;
        } else {
            $kk = $request->session()->get('kk');
            $nama = $request->session()->get('nama');
            $nik = $request->session()->get('nik');

            if (!$kk) {
                $kunjunganbayibalitaPrasekolah = Kunjungan_Bayi_Balita_Prasekolah::orderBy('created_at', 'desc')->first();
                $kk = $kunjunganbayibalitaPrasekolah ? $kunjunganbayibalitaPrasekolah->kk : null;
                $nama = $kunjunganbayibalitaPrasekolah ? $kunjunganbayibalitaPrasekolah->nama : null;
                $nik = $kunjunganbayibalitaPrasekolah ? $kunjunganbayibalitaPrasekolah->nik : null;
            }
        }

        return view('kunjungan_bayi_balita_prasekolah.editdetail', compact('kk', 'nama', 'nik', 'kunjunganbayibalitaPrasekolah'));
        // $kunjunganbayibalitaPrasekolah = Kunjungan_Bayi_Balita_Prasekolah::findOrFail($id);
        // return view('kunjungan_bayi_balita_prasekolah.editdetail', compact('kunjunganbayibalitaPrasekolah'));
    }

    // Menyimpan perubahan pada data lingkungan rumah ke dalam database
    public function update2(Request $request, $id)
    {
        // Validasi input dari formulir
        $request->validate([
            'kk' => 'required|integer',
            'nik' => 'required|integer',
            'nama' => 'required|string',
            'status' => 'required|string',
        ]);

        if ($request->status === 'Ya' || $request->status === 'Selesai') {
            $request->validate([

                'tgl_lahir' => 'required|date',
                'tmp_lahir' => 'required|string',
                'gender' => 'required|string',
                'kunjungan' => 'required|string',
                'tgl_kunjungan' => 'required|date',
                'suhu_tubuh' => 'required|string',
                'buku_kia' => 'required|string',
                'tgl_timbang_ukur' => 'required|date',
                'tempat_timbang_ukur' => 'required|string',
                'petugas_timbang_ukur' => 'required|string',
                'bb_hasil_timbang_ukur' => 'required|string',
                'pb_tb_hasil_timbang_ukur' => 'required|string',
                'lk_hasil_timbang_ukur' => 'required|string',
                'jenis_imunisasi' => 'nullable|string',
                'hepatitis_b_0bulan' => 'nullable|date',
                'bcg_0bulan' => 'nullable|date',
                'polio_0bulan' => 'nullable|date',
                'bcg_1bulan' => 'nullable|date',
                'polio_1bulan' => 'nullable|date',
                'dpt_hb_hib_1_2bulan' => 'nullable|date',
                'polio_2_2bulan' => 'nullable|date',
                'pcv_1_2bulan' => 'nullable|date',
                'rv_1_2bulan' => 'nullable|date',
                'dpt_hb_hib_2_3bulan' => 'nullable|date',
                'polio_3_3bulan' => 'nullable|date',
                'pcv_2_3bulan' => 'nullable|date',
                'rv_2_3bulan' => 'nullable|date',
                'dpt_hb_hib_3_4bulan' => 'nullable|date',
                'polio_4_4bulan' => 'nullable|date',
                'polio_suntik_4bulan' => 'nullable|date',
                'rv_3_4bulan' => 'nullable|date',
                'campak_rubelia_9bulan' => 'nullable|date',
                'polio_suntik_2_9bulan' => 'nullable|date',
                'je_10bulan' => 'nullable|date',
                'pv_3_12bulan' => 'nullable|date',
                'dpt_lanjut_1_18bulan' => 'nullable|date',
                'campak_lanjut_18bulan' => 'nullable|date',
                'makanan_pokok' => 'required|string',
                'makanan_protein_hewan' => 'required|string',
                'makanan_protein_nabati' => 'required|string',
                'makanan_lemak' => 'required|string',
                'sayur_buah' => 'required|string',
                'oc_ada' => 'required|string',
                'oc_tgl' => 'nullable|date',
                'kv_jenis' => 'nullable|string',
                'tgl_kv_mulai' => 'nullable|date',
                'tgl_kv_selesai' => 'nullable|date',
                'makan_tambah_ada' => 'required|string',
                'makan_tambah_kepatuhan' => 'required|string',
                'edukasi' => 'required|string',
                'tgl_kunjungan2' => 'nullable|date',
                'napas' => 'required|string',
                'batuk' => 'required|string',
                'diare' => 'required|string',
                'jmh_warna_kencing' => 'required|string',
                'warna_kulit' => 'required|string',
                'aktifitas' => 'required|string',
                'hisapan_bayi' => 'required|string',
                'pemberian_makan' => 'required|string',
                'pengingat_periksa_postu' => 'required|string',
                'lapor_nakes' => 'required|string',
                'created_at' => 'nullable|date',
                'updated_at' => 'nullable|date',
            ]);
        } else {
            $request->merge([
                'tgl_lahir' => null,
                'tmp_lahir' => null,
                'gender' => null,
                'kunjungan' => null,
                'tgl_kunjungan' => null,
                'suhu_tubuh' => null,
                'buku_kia' => null,
                'tgl_timbang_ukur' => null,
                'tempat_timbang_ukur' => null,
                'petugas_timbang_ukur' => null,
                'bb_hasil_timbang_ukur' => null,
                'pb_tb_hasil_timbang_ukur' => null,
                'lk_hasil_timbang_ukur' => null,
                'jenis_imunisasi' => null,
                'hepatitis_b_0bulan' => null,
                'bcg_0bulan' => null,
                'polio_0bulan' => null,
                'bcg_1bulan' => null,
                'polio_1bulan' => null,
                'dpt_hb_hib_1_2bulan' => null,
                'polio_2_2bulan' => null,
                'pcv_1_2bulan' => null,
                'rv_1_2bulan' => null,
                'dpt_hb_hib_2_3bulan' => null,
                'polio_3_3bulan' => null,
                'pcv_2_3bulan' => null,
                'rv_2_3bulan' => null,
                'dpt_hb_hib_3_4bulan' => null,
                'polio_4_4bulan' => null,
                'polio_suntik_4bulan' => null,
                'rv_3_4bulan' => null,
                'campak_rubelia_9bulan' => null,
                'polio_suntik_2_9bulan' => null,
                'je_10bulan' => null,
                'pv_3_12bulan' => null,
                'dpt_lanjut_1_18bulan' => null,
                'campak_lanjut_18bulan' => null,
                'makanan_pokok' => null,
                'makanan_protein_hewan' => null,
                'makanan_protein_nabati' => null,
                'makanan_lemak' => null,
                'sayur_buah' => null,
                'oc_ada' => null,
                'oc_tgl' => null,
                'kv_jenis' => null,
                'tgl_kv_mulai' => null,
                'tgl_kv_selesai' => null,
                'makan_tambah_ada' => null,
                'makan_tambah_kepatuhan' => null,
                'edukasi' => null,
                'napas' => null,
                'batuk' => null,
                'diare' => null,
                'jmh_warna_kencing' => null,
                'warna_kulit' => null,
                'aktifitas' => null,
                'hisapan_bayi' => null,
                'pemberian_makan' => null,
                'pengingat_periksa_postu' => null,
                'lapor_nakes' => null,
            ]);
        }



        $kunjunganbayibalitaPrasekolah = Kunjungan_Bayi_Balita_Prasekolah::findOrFail($id);
        $kunjunganbayibalitaPrasekolah->update($request->all());
        session(['kk' => $request->kk, 'nama' => $request->nama, 'nik' => $request->nik]);

        return redirect()->route('kunjungan_bayi_balita_prasekolah.show', $kunjunganbayibalitaPrasekolah->id)->with('success', 'Data ibu hamil berhasil ditambahkan.');
    }
    // ==============================================


    public function createvalidate()
    {
        return view('kunjungan_bayi_balita_prasekolah.createvalidate');
    }

    // Menyimpan data ibu hamil baru ke dalam database
    public function storevalidate(Request $request)
    {
        $validatedData = $request->validate([
            'status' => 'required|string',
        ]);

        if ($request->status === 'Ya') {
            $additionalValidation = $request->validate([
                'kk' => 'required',
                'nik' => 'required|integer',
                'nama' => 'required|string',
                'tgl_lahir' => 'required|date',
                'tmp_lahir' => 'required|string',
                'gender' => 'required|string',
                'kunjungan' => 'required|string',
                'tgl_kunjungan' => 'required|date',
                'suhu_tubuh' => 'required|string',
                'buku_kia' => 'required|string',
                'tgl_timbang_ukur' => 'required|date',
                'tempat_timbang_ukur' => 'required|string',
                'petugas_timbang_ukur' => 'required|string',
                'bb_hasil_timbang_ukur' => 'required|string',
                'pb_tb_hasil_timbang_ukur' => 'required|string',
                'lk_hasil_timbang_ukur' => 'required|string',
                'jenis_imunisasi' => 'nullable|string',
                'hepatitis_b_0bulan' => 'nullable|date',
                'bcg_0bulan' => 'nullable|date',
                'polio_0bulan' => 'nullable|date',
                'bcg_1bulan' => 'nullable|date',
                'polio_1bulan' => 'nullable|date',
                'dpt_hb_hib_1_2bulan' => 'nullable|date',
                'polio_2_2bulan' => 'nullable|date',
                'pcv_1_2bulan' => 'nullable|date',
                'rv_1_2bulan' => 'nullable|date',
                'dpt_hb_hib_2_3bulan' => 'nullable|date',
                'polio_3_3bulan' => 'nullable|date',
                'pcv_2_3bulan' => 'nullable|date',
                'rv_2_3bulan' => 'nullable|date',
                'dpt_hb_hib_3_4bulan' => 'nullable|date',
                'polio_4_4bulan' => 'nullable|date',
                'polio_suntik_4bulan' => 'nullable|date',
                'rv_3_4bulan' => 'nullable|date',
                'campak_rubelia_9bulan' => 'nullable|date',
                'polio_suntik_2_9bulan' => 'nullable|date',
                'je_10bulan' => 'nullable|date',
                'pv_3_12bulan' => 'nullable|date',
                'dpt_lanjut_1_18bulan' => 'nullable|date',
                'campak_lanjut_18bulan' => 'nullable|date',
                'makanan_pokok' => 'required|string',
                'makanan_protein_hewan' => 'required|string',
                'makanan_protein_nabati' => 'required|string',
                'makanan_lemak' => 'required|string',
                'sayur_buah' => 'required|string',
                'oc_ada' => 'required|string',
                'oc_tgl' => 'nullable|date',
                'kv_jenis' => 'nullable|string',
                'tgl_kv_mulai' => 'nullable|date',
                'tgl_kv_selesai' => 'nullable|date',
                'makan_tambah_ada' => 'required|string',
                'makan_tambah_kepatuhan' => 'required|string',
                'edukasi' => 'required|string',
                'tgl_kunjungan2' => 'nullable|date',
                'napas' => 'required|string',
                'batuk' => 'required|string',
                'diare' => 'required|string',
                'jmh_warna_kencing' => 'required|string',
                'warna_kulit' => 'required|string',
                'aktifitas' => 'required|string',
                'hisapan_bayi' => 'required|string',
                'pemberian_makan' => 'required|string',
                'pengingat_periksa_postu' => 'required|string',
                'lapor_nakes' => 'required|string',
                'created_at' => 'nullable|date',
                'updated_at' => 'nullable|date',
            ]);
            $validatedData = array_merge($validatedData, $additionalValidation);
        } else {
            // Set all fields to '-' if status is 'Tidak'
            $request->merge([
                'kk' => null,
                'nik' => null,
                'nama' => null,
                'tgl_lahir' => null,
                'tmp_lahir' => null,
                'gender' => null,
                'kunjungan' => null,
                'tgl_kunjungan' => null,
                'suhu_tubuh' => null,
                'buku_kia' => null,
                'tgl_timbang_ukur' => null,
                'tempat_timbang_ukur' => null,
                'petugas_timbang_ukur' => null,
                'bb_hasil_timbang_ukur' => null,
                'pb_tb_hasil_timbang_ukur' => null,
                'lk_hasil_timbang_ukur' => null,
                'jenis_imunisasi' => null,
                'hepatitis_b_0bulan' => null,
                'bcg_0bulan' => null,
                'polio_0bulan' => null,
                'bcg_1bulan' => null,
                'polio_1bulan' => null,
                'dpt_hb_hib_1_2bulan' => null,
                'polio_2_2bulan' => null,
                'pcv_1_2bulan' => null,
                'rv_1_2bulan' => null,
                'dpt_hb_hib_2_3bulan' => null,
                'polio_3_3bulan' => null,
                'pcv_2_3bulan' => null,
                'rv_2_3bulan' => null,
                'dpt_hb_hib_3_4bulan' => null,
                'polio_4_4bulan' => null,
                'polio_suntik_4bulan' => null,
                'rv_3_4bulan' => null,
                'campak_rubelia_9bulan' => null,
                'polio_suntik_2_9bulan' => null,
                'je_10bulan' => null,
                'pv_3_12bulan' => null,
                'dpt_lanjut_1_18bulan' => null,
                'campak_lanjut_18bulan' => null,
                'makanan_pokok' => null,
                'makanan_protein_hewan' => null,
                'makanan_protein_nabati' => null,
                'makanan_lemak' => null,
                'sayur_buah' => null,
                'oc_ada' => null,
                'oc_tgl' => null,
                'kv_jenis' => null,
                'tgl_kv_mulai' => null,
                'tgl_kv_selesai' => null,
                'makan_tambah_ada' => null,
                'makan_tambah_kepatuhan' => null,
                'edukasi' => null,
                'napas' => null,
                'batuk' => null,
                'diare' => null,
                'jmh_warna_kencing' => null,
                'warna_kulit' => null,
                'aktifitas' => null,
                'hisapan_bayi' => null,
                'pemberian_makan' => null,
                'pengingat_periksa_postu' => null,
                'lapor_nakes' => null,
            ]);
        }
        $validatedData['id_user'] = Auth::id();
        if ($request->status === 'Ya') {
            $datakk = DataKK::where('nik', $validatedData['nik'])->first();
            if (!$datakk) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['nik' => 'NIK tidak ditemukan di data NIK.']);
            }
        }

        Kunjungan_Bayi_Balita_Prasekolah::create($validatedData);

        session(['nik' => $request->nik]);
        return redirect()->route('kunjungan_bayi_balita_prasekolah.index')->with('success', 'Data ibu hamil berhasil ditambahkan.');
    }

    public function checkKK(Request $request)
    {
        $nik = $request->input('nik');

        // Lakukan validasi nik di sini, misalnya dengan mencari nik di database atau service lainnya
        $dataKK = DataKK::where('nik', $nik)->first();

        if ($dataKK) {
            return response()->json([
                'status' => 'success',
                'message' => 'KK Ditemukan',
                'data' => [
                    'nama' => $dataKK->nama,
                    'kk' => $dataKK->kk,
                ]
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'NIK Tidak Ditemukan']);
        }
    }
    // ==============================================


    // Menghapus data lingkungan rumah dari database
    public function destroy($id)
    {
        // Temukan data lingkungan rumah yang akan dihapus
        $kunjunganbayibalitaPrasekolah = Kunjungan_Bayi_Balita_Prasekolah::findOrFail($id);

        // Hapus data lingkungan rumah
        $kunjunganbayibalitaPrasekolah->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kunjungan_bayi_balita_prasekolah.index')->with('success', 'Data kunjungan bayi, balita dan usia prasekolah berhasil dihapus.');
    }
    public function destroy2($id)
    {
        // Temukan data ibu hamil yang akan dihapus
        $kunjunganbayibalitaPrasekolah = Kunjungan_Bayi_Balita_Prasekolah::findOrFail($id);

        // Simpan KK sebelum menghapus data
        $kk = $kunjunganbayibalitaPrasekolah->kk;

        // Hapus data ibu hamil
        $kunjunganbayibalitaPrasekolah->delete();

        // Temukan ID data KK lain yang tersisa (jika ada)
        $otherkunjunganbayibalitaPrasekolah = Kunjungan_Bayi_Balita_Prasekolah::where('kk', $kk)->first();

        // Redirect ke halaman detail dengan menggunakan ID KK yang tersisa (jika ada), jika tidak kembali ke index
        if ($otherkunjunganbayibalitaPrasekolah) {
            return redirect()->route('kunjungan_bayi_balita_prasekolah.show', ['id' => $otherkunjunganbayibalitaPrasekolah->id])->with('success', 'Data kunjungan bayi, balita dan usia prasekolah berhasil dihapus.');
        } else {
            return redirect()->route('kunjungan_bayi_balita_prasekolah.index')->with('success', 'Data kunjungan bayi, balita dan usia prasekolah berhasil dihapus.');
        }
    }
    public function kunjunganbayibalitaPrasekolahtbcPDF($id)
    {
        // Mengambil data kunjungan TBC berdasarkan ID
        $dataKK = Kunjungan_Bayi_Balita_Prasekolah::findOrFail($id);

        // Mengambil anggota keluarga yang terkait dengan KK yang sama
        $kunjunganbayibalitaPrasekolah = Kunjungan_Bayi_Balita_Prasekolah::where('nik', $dataKK->nik)->get();

        // Memuat view dan mengirimkan data yang diambil
        $pdf = Pdf::loadView('kunjungan_bayi_balita_prasekolah.pdf', ['kunjunganbayibalitaPrasekolah' => $kunjunganbayibalitaPrasekolah])
            ->setPaper('a4', 'landscape');

        // Mengirimkan file PDF yang dihasilkan
        return $pdf->stream('5. Kunjungan Bayi Balita Prasekolah.pdf');
    }
    public function kunjunganbayibalitaPrasekolahtbcPDF2($id)
    {
        try {
            // Mengambil data kunjungan TBC berdasarkan ID
            $kunjunganbayibalitaPrasekolah = Kunjungan_Bayi_Balita_Prasekolah::findOrFail($id);

            // Memuat view dan mengirimkan data yang diambil
            $pdf = Pdf::loadView('kunjungan_bayi_balita_prasekolah.pdf2', ['kunjunganbayibalitaPrasekolah' => $kunjunganbayibalitaPrasekolah])
                ->setPaper('a4', 'landscape');
            // Mengirimkan file PDF yang dihasilkan
            return $pdf->stream('5. Kunjungan Bayi Balita Prasekolah.pdf');
        } catch (\Exception $e) {
            // Menangani error jika data tidak ditemukan atau terjadi kesalahan lain
            return redirect()->back()->withErrors(['msg' => 'Data kunjungan TBC tidak ditemukan atau terjadi kesalahan.']);
        }
    }
}
