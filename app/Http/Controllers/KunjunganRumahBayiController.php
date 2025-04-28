<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan_Rumah_Bayi;
use App\Models\DataKK;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Exports\KunjunganRumahBayiExport; // Import kelas export
use Maatwebsite\Excel\Facades\Excel;

class KunjunganRumahBayiController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $userRole = Auth::user()->role;
        $status = $request->input('status', 'ya');
        $export = $request->input('export', false); // Cek apakah ini permintaan ekspor

        // Filter data sesuai role dan status
        if ($userRole === 'admin') {
            $query = $status === 'semua'
                ? Kunjungan_Rumah_Bayi::query()
                : Kunjungan_Rumah_Bayi::where('status', $status);
        } else {
            $query = $status === 'semua'
                ? Kunjungan_Rumah_Bayi::where('id_user', $userId)
                : Kunjungan_Rumah_Bayi::where('id_user', $userId)->where('status', $status);
        }

        // Jika ekspor diminta, kembalikan file Excel
        if ($export) {
            $data = $query->orderBy('created_at', 'desc')->get();
            return Excel::download(new KunjunganRumahBayiExport($data), 'kunjungan_rumah_bayi.xlsx');
        }

        // Jika tidak ekspor, lakukan paginasi
        $kunjunganrumahBayis = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('kunjungan_rumah_bayi.list', [
            'kunjunganrumahBayis' => $kunjunganrumahBayis,
            'status' => $status
        ]);
    }

    public function show($id, Request $request)
    {
        $dataKK = Kunjungan_Rumah_Bayi::findOrFail($id);
        $familyMembers = Kunjungan_Rumah_Bayi::where('nik', $dataKK->nik)->get();

        // Cek apakah permintaan ekspor
        if ($request->input('export', false)) {
            return Excel::download(new KunjunganRumahBayiExport($familyMembers), 'kunjungan_rumah_bayi_family_members.xlsx');
        }

        return view('kunjungan_rumah_bayi.detail', compact('dataKK', 'familyMembers'));
    }

    // Menampilkan form untuk menambahkan data lingkungan rumah baru
    public function create(Request $request)
    {
        $kk = $request->session()->get('kk');
        $nama = $request->session()->get('nama');
        return view('kunjungan_rumah_bayi.create', compact('kk', 'nama'));
    }

    // Menyimpan data lingkungan rumah baru ke dalam database
    public function store(Request $request)
    {
        $request->validate([
            'kk' => 'required|string',
            'status' => 'required|string',
        ]);
        if ($request->status === 'Ya') {
            $request->validate([
                'nik' => 'required|string',
                'nama' => 'required|string',
                'tgl_lahir' => 'required|date',
                'tmp_lahir' => 'required|string',
                'gender' => 'required|string',
                'kunjungan' => 'required|string',
                'tgl_kunjungan' => 'required|date',
                'suhu' => 'required|string',
                'buku_kia' => 'required|string',
                'asi' => 'required|string',
                'lila' => 'required|string',
                'tgl_timbang' => 'required|date',
                'tmp_timbang' => 'required|string',
                'petugas_timbang' => 'required|string',
                'hasil_timbang_ukur_bb' => 'required|string',
                'hasil_timbang_ukur_pb' => 'required|string',
                'hasil_timbang_ukur_lk' => 'required|string',
                'jenis_kunjungan_pemeriksaan' => 'required|string',
                'tgl_pemeriksaan' => 'required|date',
                'tmp_pemeriksaan' => 'required|string',
                'petugas_pemeriksaan' => 'required|string',
                'jenis_imunisasi' => 'nullable|string',
                'hepatitis_b_0bln' => 'nullable|date',
                'bcg_0bln' => 'nullable|date',
                'polio_tetes_0bln' => 'nullable|date',
                'bcg_1bln' => 'nullable|date',
                'polio_tetes_1_1bln' => 'nullable|date',
                'dpt_hb_hib_1_2bln' => 'nullable|date',
                'polio_tetes_1_2bln' => 'nullable|date',
                'pcv_1_2bln' => 'nullable|date',
                'rv_1_2bln' => 'nullable|date',
                'dpt_hb_hib_2_3bln' => 'nullable|date',
                'polio_tetes_2_3bln' => 'nullable|date',
                'pcv_2_3bln' => 'nullable|date',
                'rv_2_3bln' => 'nullable|date',
                'dpt_hb_hib_3_4bln' => 'nullable|date',
                'polio_tetes_3_4bln' => 'nullable|date',
                'pcv_3_4bln' => 'nullable|date',
                'rv_3_4bln' => 'nullable|date',
                'edukasi_kunjungan' => 'required|string',
                'napas' => 'required|string',
                'aktifitas' => 'required|string',
                'warna_kulit' => 'required|string',
                'hisapan_bayi' => 'required|string',
                'kejang' => 'required|string',
                'suhu_tubuh' => 'required|string',
                'bab' => 'required|string',
                'jmhdanwarna_kencing' => 'required|string',
                'tali_pusar' => 'required|string',
                'mata' => 'required|string',
                'kulit' => 'required|string',
                'imunisasi' => 'required|string',
                'pengingat_pemeriksaan' => 'required|string',
                'tgl_lapor_nakes' => 'required|date',
            ]);
        } else {
            // Set all fields to '-' if status is 'Tidak'
            $request->merge([
                'nik' => null,
                'nama' => null,
                'tgl_lahir' => null,
                'tmp_lahir' => null,
                'gender' => null,
                'kunjungan' => null,
                'tgl_kunjungan' => null,
                'suhu' => null,
                'buku_kia' => null,
                'asi' => null,
                'tgl_timbang' => null,
                'tmp_timbang' => null,
                'petugas_timbang' => null,
                'hasil_timbang_ukur_bb' => null,
                'hasil_timbang_ukur_pb' => null,
                'hasil_timbang_ukur_lk' => null,
                'jenis_kunjungan_pemeriksaan' => null,
                'tgl_pemeriksaan' => null,
                'tmp_pemeriksaan' => null,
                'petugas_pemeriksaan' => null,
                'jenis_imunisasi' => null,
                'hepatitis_b_0bln' => null,
                'bcg_0bln' => null,
                'polio_tetes_0bln' => null,
                'bcg_1bln' => null,
                'polio_tetes_1_1bln' => null,
                'dpt_hb_hib_1_2bln' => null,
                'polio_tetes_1_2bln' => null,
                'pcv_1_2bln' => null,
                'rv_1_2bln' => null,
                'dpt_hb_hib_2_3bln' => null,
                'polio_tetes_2_3bln' => null,
                'pcv_2_3bln' => null,
                'rv_2_3bln' => null,
                'dpt_hb_hib_3_4bln' => null,
                'polio_tetes_3_4bln' => null,
                'pcv_3_4bln' => null,
                'rv_3_4bln' => null,
                'edukasi_kunjungan' => null,
                'kunjungan2' => null,
                'tgl_kunjungan2' => null,
                'napas' => null,
                'aktifitas' => null,
                'warna_kulit' => null,
                'hisapan_bayi' => null,
                'kejang' => null,
                'suhu_tubuh' => null,
                'bab' => null,
                'jmhdanwarna_kencing' => null,
                'tali_pusar' => null,
                'mata' => null,
                'kulit' => null,
                'imunisasi' => null,
                'pengingat_pemeriksaan' => null,
                'tgl_lapor_nakes' => null,
            ]);
        }
        $validatedData['id_user'] = Auth::id();
        Kunjungan_Rumah_Bayi::create($request->all());

        session(['kk' => $request->kk, 'nama' => $request->nama]);

        return redirect()->route('kunjungan_bayi_balita_prasekolah.create')->with('success', 'Data ibu hamil berhasil ditambahkan.');
    }

    public function create2(Request $request, $id = null)
    {
        if ($id) {
            $kunjunganrumahBayi = Kunjungan_Rumah_Bayi::find($id);
            $kk = $kunjunganrumahBayi ? $kunjunganrumahBayi->kk : null;
            $nama = $kunjunganrumahBayi ? $kunjunganrumahBayi->nama : null;
            $nik = $kunjunganrumahBayi ? $kunjunganrumahBayi->nik : null;
        } else {
            $kk = $request->session()->get('kk');
            $nama = $request->session()->get('nama');
            $nik = $request->session()->get('nik');

            if (!$kk) {
                $kunjunganrumahBayi = Kunjungan_Rumah_Bayi::orderBy('created_at', 'desc')->first();
                $kk = $kunjunganrumahBayi ? $kunjunganrumahBayi->kk : null;
                $nama = $kunjunganrumahBayi ? $kunjunganrumahBayi->nama : null;
                $nik = $kunjunganrumahBayi ? $kunjunganrumahBayi->nik : null;
            }
        }

        return view('kunjungan_rumah_bayi.createdetail', compact('kk', 'nama', 'nik'));
    }



    // Menyimpan data lingkungan rumah baru ke dalam database
    public function store2(Request $request)
    {
        $validatedData = $request->validate([
            'kk' => 'required|string',
            'status' => 'required|string',
            'nik' => 'required|string',
            'nama' => 'required|string',
        ]);
        if ($request->status === 'Ya') {
            $additionalData = $request->validate([
                'tgl_lahir' => 'required|date',
                'tmp_lahir' => 'required|string',
                'gender' => 'required|string',
                'kunjungan' => 'required|string',
                'tgl_kunjungan' => 'required|date',
                'suhu' => 'required|string',
                'buku_kia' => 'required|string',
                'asi' => 'required|string',
                'lila' => 'required|string',
                'tgl_timbang' => 'required|date',
                'tmp_timbang' => 'required|string',
                'petugas_timbang' => 'required|string',
                'hasil_timbang_ukur_bb' => 'required|string',
                'hasil_timbang_ukur_pb' => 'required|string',
                'hasil_timbang_ukur_lk' => 'required|string',
                'jenis_kunjungan_pemeriksaan' => 'required|string',
                'tgl_pemeriksaan' => 'required|date',
                'tmp_pemeriksaan' => 'required|string',
                'petugas_pemeriksaan' => 'required|string',
                'jenis_imunisasi' => 'nullable|string',
                'hepatitis_b_0bln' => 'nullable|date',
                'bcg_0bln' => 'nullable|date',
                'polio_tetes_0bln' => 'nullable|date',
                'bcg_1bln' => 'nullable|date',
                'polio_tetes_1_1bln' => 'nullable|date',
                'dpt_hb_hib_1_2bln' => 'nullable|date',
                'polio_tetes_1_2bln' => 'nullable|date',
                'pcv_1_2bln' => 'nullable|date',
                'rv_1_2bln' => 'nullable|date',
                'dpt_hb_hib_2_3bln' => 'nullable|date',
                'polio_tetes_2_3bln' => 'nullable|date',
                'pcv_2_3bln' => 'nullable|date',
                'rv_2_3bln' => 'nullable|date',
                'dpt_hb_hib_3_4bln' => 'nullable|date',
                'polio_tetes_3_4bln' => 'nullable|date',
                'pcv_3_4bln' => 'nullable|date',
                'rv_3_4bln' => 'nullable|date',
                'edukasi_kunjungan' => 'required|string',
                'napas' => 'required|string',
                'aktifitas' => 'required|string',
                'warna_kulit' => 'required|string',
                'hisapan_bayi' => 'required|string',
                'kejang' => 'required|string',
                'suhu_tubuh' => 'required|string',
                'bab' => 'required|string',
                'jmhdanwarna_kencing' => 'required|string',
                'tali_pusar' => 'required|string',
                'mata' => 'required|string',
                'kulit' => 'required|string',
                'imunisasi' => 'required|string',
                'pengingat_pemeriksaan' => 'required|string',
                'tgl_lapor_nakes' => 'required|date',
            ]);
            $validatedData = array_merge($validatedData, $additionalData);
        } else {
            // Set all fields to '-' if status is 'Tidak'
            $validatedData = array_merge($validatedData, [
                // 'nik' => null,
                // 'nama' => null,
                'tgl_lahir' => null,
                'tmp_lahir' => null,
                'gender' => null,
                'kunjungan' => null,
                'tgl_kunjungan' => null,
                'suhu' => null,
                'buku_kia' => null,
                'asi' => null,
                'tgl_timbang' => null,
                'tmp_timbang' => null,
                'petugas_timbang' => null,
                'hasil_timbang_ukur_bb' => null,
                'hasil_timbang_ukur_pb' => null,
                'hasil_timbang_ukur_lk' => null,
                'jenis_kunjungan_pemeriksaan' => null,
                'tgl_pemeriksaan' => null,
                'tmp_pemeriksaan' => null,
                'petugas_pemeriksaan' => null,
                'jenis_imunisasi' => null,
                'hepatitis_b_0bln' => null,
                'bcg_0bln' => null,
                'polio_tetes_0bln' => null,
                'bcg_1bln' => null,
                'polio_tetes_1_1bln' => null,
                'dpt_hb_hib_1_2bln' => null,
                'polio_tetes_1_2bln' => null,
                'pcv_1_2bln' => null,
                'rv_1_2bln' => null,
                'dpt_hb_hib_2_3bln' => null,
                'polio_tetes_2_3bln' => null,
                'pcv_2_3bln' => null,
                'rv_2_3bln' => null,
                'dpt_hb_hib_3_4bln' => null,
                'polio_tetes_3_4bln' => null,
                'pcv_3_4bln' => null,
                'rv_3_4bln' => null,
                'edukasi_kunjungan' => null,
                'kunjungan2' => null,
                'tgl_kunjungan2' => null,
                'napas' => null,
                'aktifitas' => null,
                'warna_kulit' => null,
                'hisapan_bayi' => null,
                'kejang' => null,
                'suhu_tubuh' => null,
                'bab' => null,
                'jmhdanwarna_kencing' => null,
                'tali_pusar' => null,
                'mata' => null,
                'kulit' => null,
                'imunisasi' => null,
                'pengingat_pemeriksaan' => null,
                'tgl_lapor_nakes' => null,
            ]);
        }
        $validatedData['id_user'] = Auth::id();

        $kunjunganrumahBayi = Kunjungan_Rumah_Bayi::create($validatedData);

        session(['kk' => $request->kk, 'nama' => $request->nama, 'nik' => $request->nik]);

        return redirect()->route('kunjungan_rumah_bayi.show', $kunjunganrumahBayi->id)->with('success', 'Data ibu hamil berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit data lingkungan rumah
    public function edit(Request $request, $id = null)
    {
        if ($id) {
            $kunjunganrumahBayi = Kunjungan_Rumah_Bayi::find($id);
            $kk = $kunjunganrumahBayi ? $kunjunganrumahBayi->kk : null;
            $nama = $kunjunganrumahBayi ? $kunjunganrumahBayi->nama : null;
            $nik = $kunjunganrumahBayi ? $kunjunganrumahBayi->nik : null;
        } else {
            $kk = $request->session()->get('kk');
            $nama = $request->session()->get('nama');
            $nik = $request->session()->get('nik');

            if (!$kk) {
                $kunjunganrumahBayi = Kunjungan_Rumah_Bayi::orderBy('created_at', 'desc')->first();
                $kk = $kunjunganrumahBayi ? $kunjunganrumahBayi->kk : null;
                $nama = $kunjunganrumahBayi ? $kunjunganrumahBayi->nama : null;
                $nik = $kunjunganrumahBayi ? $kunjunganrumahBayi->nik : null;
            }
        }

        return view('kunjungan_rumah_bayi.edit', compact('kk', 'nama', 'nik', 'kunjunganrumahBayi'));
        // $kunjunganrumahBayi = Kunjungan_Rumah_Bayi::findOrFail($id);
        // return view('kunjungan_rumah_bayi.editdetail', compact('kunjunganrumahBayi'));
    }

    // Menyimpan perubahan pada data lingkungan rumah ke dalam database
    public function update(Request $request, $id)
    {
        // Validasi input dari formulir
        $request->validate([
            'kk' => 'required|string',
            'status' => 'required|string',
            'nik' => 'required|string',
            'nama' => 'required|string',
        ]);
        if ($request->status === 'Ya' || $request->status === 'Selesai') {
            $request->validate([

                'tgl_lahir' => 'required|date',
                'tmp_lahir' => 'required|string',
                'gender' => 'required|string',
                'kunjungan' => 'required|string',
                'tgl_kunjungan' => 'required|date',
                'suhu' => 'required|string',
                'buku_kia' => 'required|string',
                'asi' => 'required|string',
                'lila' => 'required|string',
                'tgl_timbang' => 'required|date',
                'tmp_timbang' => 'required|string',
                'petugas_timbang' => 'required|string',
                'hasil_timbang_ukur_bb' => 'required|string',
                'hasil_timbang_ukur_pb' => 'required|string',
                'hasil_timbang_ukur_lk' => 'required|string',
                'jenis_kunjungan_pemeriksaan' => 'required|string',
                'tgl_pemeriksaan' => 'required|date',
                'tmp_pemeriksaan' => 'required|string',
                'petugas_pemeriksaan' => 'required|string',
                'jenis_imunisasi' => 'nullable|string',
                'hepatitis_b_0bln' => 'nullable|date',
                'bcg_0bln' => 'nullable|date',
                'polio_tetes_0bln' => 'nullable|date',
                'bcg_1bln' => 'nullable|date',
                'polio_tetes_1_1bln' => 'nullable|date',
                'dpt_hb_hib_1_2bln' => 'nullable|date',
                'polio_tetes_1_2bln' => 'nullable|date',
                'pcv_1_2bln' => 'nullable|date',
                'rv_1_2bln' => 'nullable|date',
                'dpt_hb_hib_2_3bln' => 'nullable|date',
                'polio_tetes_2_3bln' => 'nullable|date',
                'pcv_2_3bln' => 'nullable|date',
                'rv_2_3bln' => 'nullable|date',
                'dpt_hb_hib_3_4bln' => 'nullable|date',
                'polio_tetes_3_4bln' => 'nullable|date',
                'pcv_3_4bln' => 'nullable|date',
                'rv_3_4bln' => 'nullable|date',
                'edukasi_kunjungan' => 'required|string',
                'napas' => 'required|string',
                'aktifitas' => 'required|string',
                'warna_kulit' => 'required|string',
                'hisapan_bayi' => 'required|string',
                'kejang' => 'required|string',
                'suhu_tubuh' => 'required|string',
                'bab' => 'required|string',
                'jmhdanwarna_kencing' => 'required|string',
                'tali_pusar' => 'required|string',
                'mata' => 'required|string',
                'kulit' => 'required|string',
                'imunisasi' => 'required|string',
                'pengingat_pemeriksaan' => 'required|string',
                'tgl_lapor_nakes' => 'required|date',
            ]);
        } else {
            // Set all fields to '-' if status is 'Tidak'
            $request->merge([
                // 'nik' => null,
                // 'nama' => null,
                'tgl_lahir' => null,
                'tmp_lahir' => null,
                'gender' => null,
                'kunjungan' => null,
                'tgl_kunjungan' => null,
                'suhu' => null,
                'buku_kia' => null,
                'asi' => null,
                'tgl_timbang' => null,
                'tmp_timbang' => null,
                'petugas_timbang' => null,
                'hasil_timbang_ukur_bb' => null,
                'hasil_timbang_ukur_pb' => null,
                'hasil_timbang_ukur_lk' => null,
                'jenis_kunjungan_pemeriksaan' => null,
                'tgl_pemeriksaan' => null,
                'tmp_pemeriksaan' => null,
                'petugas_pemeriksaan' => null,
                'jenis_imunisasi' => null,
                'hepatitis_b_0bln' => null,
                'bcg_0bln' => null,
                'polio_tetes_0bln' => null,
                'bcg_1bln' => null,
                'polio_tetes_1_1bln' => null,
                'dpt_hb_hib_1_2bln' => null,
                'polio_tetes_1_2bln' => null,
                'pcv_1_2bln' => null,
                'rv_1_2bln' => null,
                'dpt_hb_hib_2_3bln' => null,
                'polio_tetes_2_3bln' => null,
                'pcv_2_3bln' => null,
                'rv_2_3bln' => null,
                'dpt_hb_hib_3_4bln' => null,
                'polio_tetes_3_4bln' => null,
                'pcv_3_4bln' => null,
                'rv_3_4bln' => null,
                'edukasi_kunjungan' => null,
                'kunjungan2' => null,
                'tgl_kunjungan2' => null,
                'napas' => null,
                'aktifitas' => null,
                'warna_kulit' => null,
                'hisapan_bayi' => null,
                'kejang' => null,
                'suhu_tubuh' => null,
                'bab' => null,
                'jmhdanwarna_kencing' => null,
                'tali_pusar' => null,
                'mata' => null,
                'kulit' => null,
                'imunisasi' => null,
                'pengingat_pemeriksaan' => null,
                'tgl_lapor_nakes' => null,
            ]);
        }
        $kunjunganrumahBayi = Kunjungan_Rumah_Bayi::findOrFail($id);
        $kunjunganrumahBayi->update($request->all());

        return redirect()->route('kunjungan_rumah_bayi.index')->with('success', 'Data ibu hamil berhasil diperbarui.');
    }
    // Menampilkan form untuk mengedit data lingkungan rumah
    public function edit2(Request $request, $id = null)
    {
        if ($id) {
            $kunjunganrumahBayi = Kunjungan_Rumah_Bayi::find($id);
            $kk = $kunjunganrumahBayi ? $kunjunganrumahBayi->kk : null;
            $nama = $kunjunganrumahBayi ? $kunjunganrumahBayi->nama : null;
            $nik = $kunjunganrumahBayi ? $kunjunganrumahBayi->nik : null;
        } else {
            $kk = $request->session()->get('kk');
            $nama = $request->session()->get('nama');
            $nik = $request->session()->get('nik');

            if (!$kk) {
                $kunjunganrumahBayi = Kunjungan_Rumah_Bayi::orderBy('created_at', 'desc')->first();
                $kk = $kunjunganrumahBayi ? $kunjunganrumahBayi->kk : null;
                $nama = $kunjunganrumahBayi ? $kunjunganrumahBayi->nama : null;
                $nik = $kunjunganrumahBayi ? $kunjunganrumahBayi->nik : null;
            }
        }

        return view('kunjungan_rumah_bayi.edit', compact('kk', 'nama', 'nik', 'kunjunganrumahBayi'));
        // $kunjunganrumahBayi = Kunjungan_Rumah_Bayi::findOrFail($id);
        // return view('kunjungan_rumah_bayi.editdetail', compact('kunjunganrumahBayi'));
    }

    // Menyimpan perubahan pada data lingkungan rumah ke dalam database
    public function update2(Request $request, $id)
    {
        // Validasi input dari formulir
        $request->validate([
            'kk' => 'required|string',
            'status' => 'required|string',
            'nik' => 'required|string',
            'nama' => 'required|string',
        ]);
        if ($request->status === 'Ya' || $request->status === 'Selesai') {
            $request->validate([
                'tgl_lahir' => 'required|date',
                'tmp_lahir' => 'required|string',
                'gender' => 'required|string',
                'kunjungan' => 'required|string',
                'tgl_kunjungan' => 'required|date',
                'suhu' => 'required|string',
                'buku_kia' => 'required|string',
                'asi' => 'required|string',
                'lila' => 'required|string',
                'tgl_timbang' => 'required|date',
                'tmp_timbang' => 'required|string',
                'petugas_timbang' => 'required|string',
                'hasil_timbang_ukur_bb' => 'required|string',
                'hasil_timbang_ukur_pb' => 'required|string',
                'hasil_timbang_ukur_lk' => 'required|string',
                'jenis_kunjungan_pemeriksaan' => 'required|string',
                'tgl_pemeriksaan' => 'required|date',
                'tmp_pemeriksaan' => 'required|string',
                'petugas_pemeriksaan' => 'required|string',
                'jenis_imunisasi' => 'nullable|string',
                'hepatitis_b_0bln' => 'nullable|date',
                'bcg_0bln' => 'nullable|date',
                'polio_tetes_0bln' => 'nullable|date',
                'bcg_1bln' => 'nullable|date',
                'polio_tetes_1_1bln' => 'nullable|date',
                'dpt_hb_hib_1_2bln' => 'nullable|date',
                'polio_tetes_1_2bln' => 'nullable|date',
                'pcv_1_2bln' => 'nullable|date',
                'rv_1_2bln' => 'nullable|date',
                'dpt_hb_hib_2_3bln' => 'nullable|date',
                'polio_tetes_2_3bln' => 'nullable|date',
                'pcv_2_3bln' => 'nullable|date',
                'rv_2_3bln' => 'nullable|date',
                'dpt_hb_hib_3_4bln' => 'nullable|date',
                'polio_tetes_3_4bln' => 'nullable|date',
                'pcv_3_4bln' => 'nullable|date',
                'rv_3_4bln' => 'nullable|date',
                'edukasi_kunjungan' => 'required|string',
                'napas' => 'required|string',
                'aktifitas' => 'required|string',
                'warna_kulit' => 'required|string',
                'hisapan_bayi' => 'required|string',
                'kejang' => 'required|string',
                'suhu_tubuh' => 'required|string',
                'bab' => 'required|string',
                'jmhdanwarna_kencing' => 'required|string',
                'tali_pusar' => 'required|string',
                'mata' => 'required|string',
                'kulit' => 'required|string',
                'imunisasi' => 'required|string',
                'pengingat_pemeriksaan' => 'required|string',
                'tgl_lapor_nakes' => 'required|date',
            ]);
        } else {
            // Set all fields to '-' if status is 'Tidak'
            $request->merge([
                // 'nik' => null,
                // 'nama' => null,
                'tgl_lahir' => null,
                'tmp_lahir' => null,
                'gender' => null,
                'kunjungan' => null,
                'tgl_kunjungan' => null,
                'suhu' => null,
                'buku_kia' => null,
                'asi' => null,
                'tgl_timbang' => null,
                'tmp_timbang' => null,
                'petugas_timbang' => null,
                'hasil_timbang_ukur_bb' => null,
                'hasil_timbang_ukur_pb' => null,
                'hasil_timbang_ukur_lk' => null,
                'jenis_kunjungan_pemeriksaan' => null,
                'tgl_pemeriksaan' => null,
                'tmp_pemeriksaan' => null,
                'petugas_pemeriksaan' => null,
                'jenis_imunisasi' => null,
                'hepatitis_b_0bln' => null,
                'bcg_0bln' => null,
                'polio_tetes_0bln' => null,
                'bcg_1bln' => null,
                'polio_tetes_1_1bln' => null,
                'dpt_hb_hib_1_2bln' => null,
                'polio_tetes_1_2bln' => null,
                'pcv_1_2bln' => null,
                'rv_1_2bln' => null,
                'dpt_hb_hib_2_3bln' => null,
                'polio_tetes_2_3bln' => null,
                'pcv_2_3bln' => null,
                'rv_2_3bln' => null,
                'dpt_hb_hib_3_4bln' => null,
                'polio_tetes_3_4bln' => null,
                'pcv_3_4bln' => null,
                'rv_3_4bln' => null,
                'edukasi_kunjungan' => null,
                'kunjungan2' => null,
                'tgl_kunjungan2' => null,
                'napas' => null,
                'aktifitas' => null,
                'warna_kulit' => null,
                'hisapan_bayi' => null,
                'kejang' => null,
                'suhu_tubuh' => null,
                'bab' => null,
                'jmhdanwarna_kencing' => null,
                'tali_pusar' => null,
                'mata' => null,
                'kulit' => null,
                'imunisasi' => null,
                'pengingat_pemeriksaan' => null,
                'tgl_lapor_nakes' => null,
            ]);
        }

        $kunjunganrumahBayi = Kunjungan_Rumah_Bayi::findOrFail($id);
        $kunjunganrumahBayi->update($request->all());
        session(['kk' => $request->kk, 'nama' => $request->nama, 'nik' => $request->nik]);

        return redirect()->route('kunjungan_rumah_bayi.show', $kunjunganrumahBayi->id)->with('success', 'Data ibu hamil berhasil ditambahkan.');
    }

    // ==============================================


    public function createvalidate()
    {
        return view('kunjungan_rumah_bayi.createvalidate');
    }

    // Menyimpan data ibu hamil baru ke dalam database
    public function storevalidate(Request $request)
    {
        // Validasi untuk status
        $validatedData = $request->validate([
            'status' => 'required|string',
        ]);

        // Validasi tambahan jika status adalah 'Ya'
        if ($request->status === 'Ya') {
            $additionalValidation = $request->validate([
                'kk' => 'required|string',
                'nik' => 'required|string',
                'nama' => 'required|string',
                'tgl_lahir' => 'required|date',
                'tmp_lahir' => 'required|string',
                'gender' => 'required|string',
                'kunjungan' => 'required|string',
                'tgl_kunjungan' => 'required|date',
                'suhu' => 'required|string',
                'buku_kia' => 'required|string',
                'asi' => 'required|string',
                'lila' => 'required|string',
                'tgl_timbang' => 'required|date',
                'tmp_timbang' => 'required|string',
                'petugas_timbang' => 'required|string',
                'hasil_timbang_ukur_bb' => 'required|string',
                'hasil_timbang_ukur_pb' => 'required|string',
                'hasil_timbang_ukur_lk' => 'required|string',
                'jenis_kunjungan_pemeriksaan' => 'required|string',
                'tgl_pemeriksaan' => 'required|date',
                'tmp_pemeriksaan' => 'required|string',
                'petugas_pemeriksaan' => 'required|string',
                'jenis_imunisasi' => 'nullable|string',
                'hepatitis_b_0bln' => 'nullable|date',
                'bcg_0bln' => 'nullable|date',
                'polio_tetes_0bln' => 'nullable|date',
                'bcg_1bln' => 'nullable|date',
                'polio_tetes_1_1bln' => 'nullable|date',
                'dpt_hb_hib_1_2bln' => 'nullable|date',
                'polio_tetes_1_2bln' => 'nullable|date',
                'pcv_1_2bln' => 'nullable|date',
                'rv_1_2bln' => 'nullable|date',
                'dpt_hb_hib_2_3bln' => 'nullable|date',
                'polio_tetes_2_3bln' => 'nullable|date',
                'pcv_2_3bln' => 'nullable|date',
                'rv_2_3bln' => 'nullable|date',
                'dpt_hb_hib_3_4bln' => 'nullable|date',
                'polio_tetes_3_4bln' => 'nullable|date',
                'pcv_3_4bln' => 'nullable|date',
                'rv_3_4bln' => 'nullable|date',
                'edukasi_kunjungan' => 'required|string',
                'napas' => 'required|string',
                'aktifitas' => 'required|string',
                'warna_kulit' => 'required|string',
                'hisapan_bayi' => 'required|string',
                'kejang' => 'required|string',
                'suhu_tubuh' => 'required|string',
                'bab' => 'required|string',
                'jmhdanwarna_kencing' => 'required|string',
                'tali_pusar' => 'required|string',
                'mata' => 'required|string',
                'kulit' => 'required|string',
                'imunisasi' => 'required|string',
                'pengingat_pemeriksaan' => 'required|string',
                'tgl_lapor_nakes' => 'required|date',
            ]);

            $validatedData = array_merge($validatedData, $additionalValidation);
        } else {
            // Set all fields to null if status is 'Tidak'
            $request->merge([
                'kk' => null,
                'nik' => null,
                'nama' => null,
                'tgl_lahir' => null,
                'tmp_lahir' => null,
                'gender' => null,
                'kunjungan' => null,
                'tgl_kunjungan' => null,
                'suhu' => null,
                'buku_kia' => null,
                'asi' => null,
                'tgl_timbang' => null,
                'tmp_timbang' => null,
                'petugas_timbang' => null,
                'hasil_timbang_ukur_bb' => null,
                'hasil_timbang_ukur_pb' => null,
                'hasil_timbang_ukur_lk' => null,
                'jenis_kunjungan_pemeriksaan' => null,
                'tgl_pemeriksaan' => null,
                'tmp_pemeriksaan' => null,
                'petugas_pemeriksaan' => null,
                'jenis_imunisasi' => null,
                'hepatitis_b_0bln' => null,
                'bcg_0bln' => null,
                'polio_tetes_0bln' => null,
                'bcg_1bln' => null,
                'polio_tetes_1_1bln' => null,
                'dpt_hb_hib_1_2bln' => null,
                'polio_tetes_1_2bln' => null,
                'pcv_1_2bln' => null,
                'rv_1_2bln' => null,
                'dpt_hb_hib_2_3bln' => null,
                'polio_tetes_2_3bln' => null,
                'pcv_2_3bln' => null,
                'rv_2_3bln' => null,
                'dpt_hb_hib_3_4bln' => null,
                'polio_tetes_3_4bln' => null,
                'pcv_3_4bln' => null,
                'rv_3_4bln' => null,
                'edukasi_kunjungan' => null,
                'napas' => null,
                'aktifitas' => null,
                'warna_kulit' => null,
                'hisapan_bayi' => null,
                'kejang' => null,
                'suhu_tubuh' => null,
                'bab' => null,
                'jmhdanwarna_kencing' => null,
                'tali_pusar' => null,
                'mata' => null,
                'kulit' => null,
                'imunisasi' => null,
                'pengingat_pemeriksaan' => null,
                'tgl_lapor_nakes' => null,
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

        Kunjungan_Rumah_Bayi::create($validatedData);

        session(['nik' => $request->nik]);
        return redirect()->route('kunjungan_rumah_bayi.index')->with('success', 'Data berhasil ditambahkan.');
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
        $kunjunganrumahBayi = Kunjungan_Rumah_Bayi::findOrFail($id);

        // Hapus data lingkungan rumah
        $kunjunganrumahBayi->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kunjungan_rumah_bayi.index')->with('success', 'Data kunjungan rumah bayi berhasil dihapus.');
    }
    public function destroy2($id)
    {
        // Temukan data ibu hamil yang akan dihapus
        $kunjunganrumahBayi = Kunjungan_Rumah_Bayi::findOrFail($id);

        // Simpan KK sebelum menghapus data
        $kk = $kunjunganrumahBayi->kk;

        // Hapus data ibu hamil
        $kunjunganrumahBayi->delete();

        // Temukan ID data KK lain yang tersisa (jika ada)
        $otherkunjunganrumahBayi = Kunjungan_Rumah_Bayi::where('kk', $kk)->first();

        // Redirect ke halaman detail dengan menggunakan ID KK yang tersisa (jika ada), jika tidak kembali ke index
        if ($otherkunjunganrumahBayi) {
            return redirect()->route('kunjungan_rumah_bayi.show', ['id' => $otherkunjunganrumahBayi->id])->with('success', 'Data kunjungan rumah bayi berhasil dihapus.');
        } else {
            return redirect()->route('kunjungan_rumah_bayi.index')->with('success', 'Data kunjungan rumah bayi berhasil dihapus.');
        }
    }
    public function kunjunganrumahBayiPDF($id)
    {
        // Mengambil data kunjungan TBC berdasarkan ID
        $dataKK = Kunjungan_Rumah_Bayi::findOrFail($id);

        // Mengambil anggota keluarga yang terkait dengan KK yang sama
        $kunjunganrumahBayi = Kunjungan_Rumah_Bayi::where('nik', $dataKK->nik)->get();

        // Memuat view dan mengirimkan data yang diambil
        $pdf = Pdf::loadView('kunjungan_rumah_bayi.pdf', ['kunjunganrumahBayi' => $kunjunganrumahBayi])
            ->setPaper('a4', 'landscape');

        // Mengirimkan file PDF yang dihasilkan
        return $pdf->stream('4. Checklist Kunjungan Rumah - Bayi.pdf');
    }
    public function kunjunganrumahBayiPDF2($id)
    {
        try {
            // Mengambil data kunjungan TBC berdasarkan ID
            $kunjunganrumahBayi = Kunjungan_Rumah_Bayi::findOrFail($id);

            // Memuat view dan mengirimkan data yang diambil
            $pdf = Pdf::loadView('kunjungan_rumah_bayi.pdf2', ['kunjunganrumahBayi' => $kunjunganrumahBayi])
                ->setPaper('a4', 'landscape');
            // Mengirimkan file PDF yang dihasilkan
            return $pdf->stream('4. Checklist Kunjungan Rumah - Bayi.pdf');
        } catch (\Exception $e) {
            // Menangani error jika data tidak ditemukan atau terjadi kesalahan lain
            return redirect()->back()->withErrors(['msg' => 'Data kunjungan TBC tidak ditemukan atau terjadi kesalahan.']);
        }
    }
}
