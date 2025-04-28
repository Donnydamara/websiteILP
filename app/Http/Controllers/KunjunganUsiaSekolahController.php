<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan_Usia_Sekolah;
use App\Models\DataKK;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Exports\KunjunganUsiaSekolahExport; // Import kelas export
use Maatwebsite\Excel\Facades\Excel;

class KunjunganUsiaSekolahController extends Controller
{
    // Menampilkan daftar data lingkungan rumah
    public function index(Request $request)
    {
        $userId = Auth::id();
        $userRole = Auth::user()->role;
        $status = $request->input('status', 'ya');
        $export = $request->input('export', false); // Cek apakah ini permintaan ekspor

        if ($userRole === 'admin') {
            $query = $status === 'semua'
                ? Kunjungan_Usia_Sekolah::orderBy('created_at', 'desc')
                : Kunjungan_Usia_Sekolah::where('status', $status)->orderBy('created_at', 'desc');
        } else {
            $query = $status === 'semua'
                ? Kunjungan_Usia_Sekolah::where('id_user', $userId)->orderBy('created_at', 'desc')
                : Kunjungan_Usia_Sekolah::where('id_user', $userId)->where('status', $status)->orderBy('created_at', 'desc');
        }

        // Jika ekspor diminta
        if ($export) {
            $data = $query->get();
            return Excel::download(new KunjunganUsiaSekolahExport($data), 'kunjungan_usia_sekolah.xlsx');
        }

        $kunjunganusiaSekolahs = $query->paginate(10);
        $filteredkunjunganusiaSekolahs = $kunjunganusiaSekolahs->unique('nik');

        return view('kunjungan_usia_sekolah.list', [
            'kunjunganusiaSekolahs' => $filteredkunjunganusiaSekolahs,
            'status' => $status
        ]);
    }

    public function show($id, Request $request)
    {
        $dataKK = Kunjungan_Usia_Sekolah::findOrFail($id);
        $familyMembers = Kunjungan_Usia_Sekolah::where('nik', $dataKK->nik)->get();

        // Jika ekspor diminta
        if ($request->input('export', false)) {
            return Excel::download(new KunjunganUsiaSekolahExport($familyMembers), 'family_members.xlsx');
        }

        return view('kunjungan_usia_sekolah.detail', compact('dataKK', 'familyMembers'));
    }

    // Menampilkan form untuk menambahkan data lingkungan rumah baru
    public function create(Request $request)
    {
        $kk = $request->session()->get('kk');
        $nama = $request->session()->get('nama');
        return view('kunjungan_usia_sekolah.create', compact('kk', 'nama'));
    }

    // Menyimpan data lingkungan rumah baru ke dalam database
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
                'tgl_timbang_ukur' => 'required|date',
                'tmp_timbang_ukur' => 'required|string',
                'porsi' => 'required|string',
                'bb_timbang_ukur' => 'required|string',
                'tb_timbang_ukur' => 'required|string',
                'lp_timbang_ukur' => 'required|string',
                'ada_ttd_putri' => 'nullable|string',
                'minum_ttd_putri' => 'nullable|string',
                'tgl_skrining_hb_putri' => 'nullable|date',
                'tmp_skrining_hb_putri' => 'nullable|string',
                'hasil_skrining_hb_putri' => 'nullable|string',
                'merokok' => 'required|string',
                'tgl_gula_darah_periksi_ptm' => 'required|date',
                'tmp_gula_darah_periksi_ptm' => 'required|string',
                'hasil_gula_darah_periksi_ptm' => 'required|string',
                'tgl_tekanan_darah_periksi_ptm' => 'required|date',
                'tmp_tekanan_darah_periksi_ptm' => 'required|string',
                'hasil_tekanan_darah_periksi_ptm' => 'required|string',
                'tgl_skrining' => 'required|date',
                'tmp_skrining' => 'required|string',
                'petugas_skrining' => 'required|string',
                'edukasi' => 'required|string',
            ]);
        } else {
            $request->merge([
                'nik',
                'nama',
                'tgl_lahir',
                'tmp_lahir',
                'gender',
                'kunjungan',
                'tgl_kunjungan',
                'suhu_tubuh',
                'tgl_timbang_ukur',
                'tmp_timbang_ukur',
                'porsi',
                'bb_timbang_ukur',
                'tb_timbang_ukur',
                'lp_timbang_ukur',
                'ada_ttd_putri',
                'minum_ttd_putri',
                'tgl_skrining_hb_putri',
                'tmp_skrining_hb_putri',
                'hasil_skrining_hb_putri',
                'merokok',
                'tgl_gula_darah_periksi_ptm',
                'tmp_gula_darah_periksi_ptm',
                'hasil_gula_darah_periksi_ptm',
                'tgl_tekanan_darah_periksi_ptm',
                'tmp_tekanan_darah_periksi_ptm',
                'hasil_tekanan_darah_periksi_ptm',
                'tgl_skrining',
                'tmp_skrining',
                'petugas_skrining',
                'edukasi'
            ]);
        }
        $validatedData['id_user'] = Auth::id();
        Kunjungan_Usia_Sekolah::create($request->all());

        session(['kk' => $request->kk, 'nama' => $request->nama]);

        return redirect()->route('kunjungan_usia_dewasa.create')->with('success', 'Data ibu hamil berhasil ditambahkan.');
    }

    public function create2(Request $request, $id = null)
    {
        if ($id) {
            $kunjunganusiaSekolah = Kunjungan_Usia_Sekolah::find($id);
            $kk = $kunjunganusiaSekolah ? $kunjunganusiaSekolah->kk : null;
            $nama = $kunjunganusiaSekolah ? $kunjunganusiaSekolah->nama : null;
            $nik = $kunjunganusiaSekolah ? $kunjunganusiaSekolah->nik : null;
        } else {
            $kk = $request->session()->get('kk');
            $nama = $request->session()->get('nama');
            $nik = $request->session()->get('nik');

            if (!$kk) {
                $kunjunganusiaSekolah = Kunjungan_Usia_Sekolah::orderBy('created_at', 'desc')->first();
                $kk = $kunjunganusiaSekolah ? $kunjunganusiaSekolah->kk : null;
                $nama = $kunjunganusiaSekolah ? $kunjunganusiaSekolah->nama : null;
                $nik = $kunjunganusiaSekolah ? $kunjunganusiaSekolah->nik : null;
            }
        }

        return view('kunjungan_usia_sekolah.createdetail', compact('kk', 'nama', 'nik'));
    }



    // Menyimpan data lingkungan rumah baru ke dalam database
    public function store2(Request $request)
    {
        $validatedData = $request->validate([
            'kk' => 'required|integer',
            'status' => 'required|string',
            'nik' => 'required|integer',
            'nama' => 'required|string',
        ]);

        if ($request->status === 'Ya') {
            $additionalData = $request->validate([
                'tgl_lahir' => 'required|date',
                'tmp_lahir' => 'required|string',
                'gender' => 'required|string',
                'kunjungan' => 'required|string',
                'tgl_kunjungan' => 'required|date',
                'suhu_tubuh' => 'required|string',
                'tgl_timbang_ukur' => 'required|date',
                'tmp_timbang_ukur' => 'required|string',
                'porsi' => 'required|string',
                'bb_timbang_ukur' => 'required|string',
                'tb_timbang_ukur' => 'required|string',
                'lp_timbang_ukur' => 'required|string',
                'ada_ttd_putri' => 'nullable|string',
                'minum_ttd_putri' => 'nullable|string',
                'tgl_skrining_hb_putri' => 'nullable|date',
                'tmp_skrining_hb_putri' => 'nullable|string',
                'hasil_skrining_hb_putri' => 'nullable|string',
                'merokok' => 'required|string',
                'tgl_gula_darah_periksi_ptm' => 'required|date',
                'tmp_gula_darah_periksi_ptm' => 'required|string',
                'hasil_gula_darah_periksi_ptm' => 'required|string',
                'tgl_tekanan_darah_periksi_ptm' => 'required|date',
                'tmp_tekanan_darah_periksi_ptm' => 'required|string',
                'hasil_tekanan_darah_periksi_ptm' => 'required|string',
                'tgl_skrining' => 'required|date',
                'tmp_skrining' => 'required|string',
                'petugas_skrining' => 'required|string',
                'edukasi' => 'required|string',
            ]);
            $validatedData = array_merge($validatedData, $additionalData);
        } else {
            $validatedData = array_merge($validatedData, [
                'tgl_lahir',
                'tmp_lahir',
                'gender',
                'kunjungan',
                'tgl_kunjungan',
                'suhu_tubuh',
                'tgl_timbang_ukur',
                'tmp_timbang_ukur',
                'porsi',
                'bb_timbang_ukur',
                'tb_timbang_ukur',
                'lp_timbang_ukur',
                'ada_ttd_putri',
                'minum_ttd_putri',
                'tgl_skrining_hb_putri',
                'tmp_skrining_hb_putri',
                'hasil_skrining_hb_putri',
                'merokok',
                'tgl_gula_darah_periksi_ptm',
                'tmp_gula_darah_periksi_ptm',
                'hasil_gula_darah_periksi_ptm',
                'tgl_tekanan_darah_periksi_ptm',
                'tmp_tekanan_darah_periksi_ptm',
                'hasil_tekanan_darah_periksi_ptm',
                'tgl_skrining',
                'tmp_skrining',
                'petugas_skrining',
                'edukasi'
            ]);
        }
        $validatedData['id_user'] = Auth::id();
        $kunjunganusiaSekolah = Kunjungan_Usia_Sekolah::create($validatedData);

        session(['kk' => $request->kk, 'nama' => $request->nama, 'nik' => $request->nik]);

        return redirect()->route('kunjungan_usia_sekolah.show', $kunjunganusiaSekolah->id)->with('success', 'Data ibu hamil berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit data lingkungan rumah
    public function edit($id)
    {
        $kunjunganusiaSekolah = Kunjungan_Usia_Sekolah::findOrFail($id);
        return view('kunjungan_usia_sekolah.edit', compact('kunjunganusiaSekolah'));
    }

    // Menyimpan perubahan pada data lingkungan rumah ke dalam database
    public function update(Request $request, $id)
    {
        // Validasi input dari formulir
        $request->validate([
            'kk' => 'required|integer',
            'status' => 'required|string',
            'nik' => 'required|integer',
            'nama' => 'required|string',
        ]);

        if ($request->status === 'Ya' || $request->status === 'Selesai') {
            $request->validate([
                'tgl_lahir' => 'required|date',
                'tmp_lahir' => 'required|string',
                'gender' => 'required|string',
                'kunjungan' => 'required|string',
                'tgl_kunjungan' => 'required|date',
                'suhu_tubuh' => 'required|string',
                'tgl_timbang_ukur' => 'required|date',
                'tmp_timbang_ukur' => 'required|string',
                'porsi' => 'required|string',
                'bb_timbang_ukur' => 'required|string',
                'tb_timbang_ukur' => 'required|string',
                'lp_timbang_ukur' => 'required|string',
                'ada_ttd_putri' => 'nullable|string',
                'minum_ttd_putri' => 'nullable|string',
                'tgl_skrining_hb_putri' => 'nullable|date',
                'tmp_skrining_hb_putri' => 'nullable|string',
                'hasil_skrining_hb_putri' => 'nullable|string',
                'merokok' => 'required|string',
                'tgl_gula_darah_periksi_ptm' => 'required|date',
                'tmp_gula_darah_periksi_ptm' => 'required|string',
                'hasil_gula_darah_periksi_ptm' => 'required|string',
                'tgl_tekanan_darah_periksi_ptm' => 'required|date',
                'tmp_tekanan_darah_periksi_ptm' => 'required|string',
                'hasil_tekanan_darah_periksi_ptm' => 'required|string',
                'tgl_skrining' => 'required|date',
                'tmp_skrining' => 'required|string',
                'petugas_skrining' => 'required|string',
                'edukasi' => 'required|string',
            ]);
        } else {
            $request->merge([
                'tgl_lahir',
                'tmp_lahir',
                'gender',
                'kunjungan',
                'tgl_kunjungan',
                'suhu_tubuh',
                'tgl_timbang_ukur',
                'tmp_timbang_ukur',
                'porsi',
                'bb_timbang_ukur',
                'tb_timbang_ukur',
                'lp_timbang_ukur',
                'ada_ttd_putri',
                'minum_ttd_putri',
                'tgl_skrining_hb_putri',
                'tmp_skrining_hb_putri',
                'hasil_skrining_hb_putri',
                'merokok',
                'tgl_gula_darah_periksi_ptm',
                'tmp_gula_darah_periksi_ptm',
                'hasil_gula_darah_periksi_ptm',
                'tgl_tekanan_darah_periksi_ptm',
                'tmp_tekanan_darah_periksi_ptm',
                'hasil_tekanan_darah_periksi_ptm',
                'tgl_skrining',
                'tmp_skrining',
                'petugas_skrining',
                'edukasi'
            ]);
        }
        $kunjunganusiaSekolah = Kunjungan_Usia_Sekolah::findOrFail($id);
        $kunjunganusiaSekolah->update($request->all());

        Kunjungan_Usia_Sekolah::where('nik', $kunjunganusiaSekolah->nik)
            ->update(['status' => $request->status]);

        return redirect()->route('kunjungan_usia_sekolah.index')->with('success', 'Data ibu hamil berhasil diperbarui.');
    }
    // Menampilkan form untuk mengedit data lingkungan rumah
    public function edit2($id)
    {
        $kunjunganusiaSekolah = Kunjungan_Usia_Sekolah::findOrFail($id);
        return view('kunjungan_usia_sekolah.editdetail', compact('kunjunganusiaSekolah'));
    }

    // Menyimpan perubahan pada data lingkungan rumah ke dalam database
    public function update2(Request $request, $id)
    {
        // Validasi input dari formulir
        $request->validate([
            'kk' => 'required|integer',
            'status' => 'required|string',
            'nik' => 'required|integer',
            'nama' => 'required|string',
        ]);

        if ($request->status === 'Ya' || $request->status === 'Selesai') {
            $request->validate([
                'tgl_lahir' => 'required|date',
                'tmp_lahir' => 'required|string',
                'gender' => 'required|string',
                'kunjungan' => 'required|string',
                'tgl_kunjungan' => 'required|date',
                'suhu_tubuh' => 'required|string',
                'tgl_timbang_ukur' => 'required|date',
                'tmp_timbang_ukur' => 'required|string',
                'porsi' => 'required|string',
                'bb_timbang_ukur' => 'required|string',
                'tb_timbang_ukur' => 'required|string',
                'lp_timbang_ukur' => 'required|string',
                'ada_ttd_putri' => 'nullable|string',
                'minum_ttd_putri' => 'nullable|string',
                'tgl_skrining_hb_putri' => 'nullable|date',
                'tmp_skrining_hb_putri' => 'nullable|string',
                'hasil_skrining_hb_putri' => 'nullable|string',
                'merokok' => 'required|string',
                'tgl_gula_darah_periksi_ptm' => 'required|date',
                'tmp_gula_darah_periksi_ptm' => 'required|string',
                'hasil_gula_darah_periksi_ptm' => 'required|string',
                'tgl_tekanan_darah_periksi_ptm' => 'required|date',
                'tmp_tekanan_darah_periksi_ptm' => 'required|string',
                'hasil_tekanan_darah_periksi_ptm' => 'required|string',
                'tgl_skrining' => 'required|date',
                'tmp_skrining' => 'required|string',
                'petugas_skrining' => 'required|string',
                'edukasi' => 'required|string',
            ]);
        } else {
            $request->merge([
                'tgl_lahir',
                'tmp_lahir',
                'gender',
                'kunjungan',
                'tgl_kunjungan',
                'suhu_tubuh',
                'tgl_timbang_ukur',
                'tmp_timbang_ukur',
                'porsi',
                'bb_timbang_ukur',
                'tb_timbang_ukur',
                'lp_timbang_ukur',
                'ada_ttd_putri',
                'minum_ttd_putri',
                'tgl_skrining_hb_putri',
                'tmp_skrining_hb_putri',
                'hasil_skrining_hb_putri',
                'merokok',
                'tgl_gula_darah_periksi_ptm',
                'tmp_gula_darah_periksi_ptm',
                'hasil_gula_darah_periksi_ptm',
                'tgl_tekanan_darah_periksi_ptm',
                'tmp_tekanan_darah_periksi_ptm',
                'hasil_tekanan_darah_periksi_ptm',
                'tgl_skrining',
                'tmp_skrining',
                'petugas_skrining',
                'edukasi'
            ]);
        }
        $kunjunganusiaSekolah = Kunjungan_Usia_Sekolah::findOrFail($id);
        $kunjunganusiaSekolah->update($request->all());
        session(['kk' => $request->kk, 'nama' => $request->nama, 'nik' => $request->nik]);

        return redirect()->route('kunjungan_usia_sekolah.show', $kunjunganusiaSekolah->id)->with('success', 'Data ibu hamil berhasil ditambahkan.');
    }

    // ==============================================


    public function createvalidate()
    {
        return view('kunjungan_usia_sekolah.createvalidate');
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
                'tgl_timbang_ukur' => 'required|date',
                'tmp_timbang_ukur' => 'required|string',
                'porsi' => 'required|string',
                'bb_timbang_ukur' => 'required|string',
                'tb_timbang_ukur' => 'required|string',
                'lp_timbang_ukur' => 'required|string',
                'ada_ttd_putri' => 'nullable|string',
                'minum_ttd_putri' => 'nullable|string',
                'tgl_skrining_hb_putri' => 'nullable|date',
                'tmp_skrining_hb_putri' => 'nullable|string',
                'hasil_skrining_hb_putri' => 'nullable|string',
                'merokok' => 'required|string',
                'tgl_gula_darah_periksi_ptm' => 'required|date',
                'tmp_gula_darah_periksi_ptm' => 'required|string',
                'hasil_gula_darah_periksi_ptm' => 'required|string',
                'tgl_tekanan_darah_periksi_ptm' => 'required|date',
                'tmp_tekanan_darah_periksi_ptm' => 'required|string',
                'hasil_tekanan_darah_periksi_ptm' => 'required|string',
                'tgl_skrining' => 'required|date',
                'tmp_skrining' => 'required|string',
                'petugas_skrining' => 'required|string',
                'edukasi' => 'required|string',
            ]);
            $validatedData = array_merge($validatedData, $additionalValidation);
        } else {
            // Set all fields to '-' if status is 'Tidak'
            $request->merge([
                'kk' => null,
                'nik',
                'nama',
                'tgl_lahir',
                'tmp_lahir',
                'gender',
                'kunjungan',
                'tgl_kunjungan',
                'suhu_tubuh',
                'tgl_timbang_ukur',
                'tmp_timbang_ukur',
                'porsi',
                'bb_timbang_ukur',
                'tb_timbang_ukur',
                'lp_timbang_ukur',
                'ada_ttd_putri',
                'minum_ttd_putri',
                'tgl_skrining_hb_putri',
                'tmp_skrining_hb_putri',
                'hasil_skrining_hb_putri',
                'merokok',
                'tgl_gula_darah_periksi_ptm',
                'tmp_gula_darah_periksi_ptm',
                'hasil_gula_darah_periksi_ptm',
                'tgl_tekanan_darah_periksi_ptm',
                'tmp_tekanan_darah_periksi_ptm',
                'hasil_tekanan_darah_periksi_ptm',
                'tgl_skrining',
                'tmp_skrining',
                'petugas_skrining',
                'edukasi'
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

        Kunjungan_Usia_Sekolah::create($validatedData);

        session(['nik' => $request->nik]);
        return redirect()->route('kunjungan_usia_sekolah.index')->with('success', 'Data ibu hamil berhasil ditambahkan.');
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
        $kunjunganusiaSekolah = Kunjungan_Usia_Sekolah::findOrFail($id);

        // Hapus data lingkungan rumah
        $kunjunganusiaSekolah->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kunjungan_usia_sekolah.index')->with('success', 'Data kunjungan sekolah berhasil dihapus.');
    }
    public function destroy2($id)
    {
        // Temukan data ibu hamil yang akan dihapus
        $kunjunganusiaSekolah = Kunjungan_Usia_Sekolah::findOrFail($id);

        // Simpan KK sebelum menghapus data
        $kk = $kunjunganusiaSekolah->kk;

        // Hapus data ibu hamil
        $kunjunganusiaSekolah->delete();

        // Temukan ID data KK lain yang tersisa (jika ada)
        $otherkunjunganusiaSekolah = Kunjungan_Usia_Sekolah::where('kk', $kk)->first();

        // Redirect ke halaman detail dengan menggunakan ID KK yang tersisa (jika ada), jika tidak kembali ke index
        if ($otherkunjunganusiaSekolah) {
            return redirect()->route('kunjungan_usia_sekolah.show', ['id' => $otherkunjunganusiaSekolah->id])->with('success', 'Data kunjungan sekolah berhasil dihapus.');
        } else {
            return redirect()->route('kunjungan_usia_sekolah.index')->with('success', 'Data kunjungan sekolah berhasil dihapus.');
        }
    }
    public function kunjunganusiasekolahPDF($id)
    {
        // Mengambil data kunjungan TBC berdasarkan ID
        $dataKK = Kunjungan_Usia_Sekolah::findOrFail($id);

        // Mengambil anggota keluarga yang terkait dengan KK yang sama
        $kunjunganusiasekolah = Kunjungan_Usia_Sekolah::where('nik', $dataKK->nik)->get();

        // Memuat view dan mengirimkan data yang diambil
        $pdf = Pdf::loadView('kunjungan_usia_sekolah.pdf', ['kunjunganusiasekolah' => $kunjunganusiasekolah])
            ->setPaper('a4', 'landscape');

        // Mengirimkan file PDF yang dihasilkan
        return $pdf->stream('Kunjungan Usia Sekolah.pdf');
    }
    public function kunjunganusiasekolahPDF2($id)
    {
        try {
            // Mengambil data kunjungan TBC berdasarkan ID
            $kunjunganusiaSekolah = Kunjungan_Usia_Sekolah::findOrFail($id);

            // Memuat view dan mengirimkan data yang diambil
            $pdf = Pdf::loadView('kunjungan_usia_sekolah.pdf2', ['kunjunganusiasekolah' => $kunjunganusiaSekolah])
                ->setPaper('a4', 'landscape');
            // Mengirimkan file PDF yang dihasilkan
            return $pdf->stream('Kunjungan Usia Sekolah.pdf');
        } catch (\Exception $e) {
            // Menangani error jika data tidak ditemukan atau terjadi kesalahan lain
            return redirect()->back()->withErrors(['msg' => 'Data kunjungan Usia Sekolah tidak ditemukan atau terjadi kesalahan.']);
        }
    }
}
