<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan_Lansia;
use App\Models\DataKK;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Exports\KunjunganLansiaExport;
use Maatwebsite\Excel\Facades\Excel;

class KunjunganLansiController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $userRole = Auth::user()->role;
        $status = $request->input('status', 'semua');
        $export = $request->input('export', false);

        if ($userRole === 'admin') {
            $query = $status === 'semua'
                ? Kunjungan_Lansia::orderBy('created_at', 'desc')
                : Kunjungan_Lansia::where('status', $status)->orderBy('created_at', 'desc');
        } else {
            $query = $status === 'semua'
                ? Kunjungan_Lansia::where('id_user', $userId)->orderBy('created_at', 'desc')
                : Kunjungan_Lansia::where('id_user', $userId)->where('status', $status)->orderBy('created_at', 'desc');
        }

        // Jika ekspor diminta
        if ($export) {
            $data = $query->get();
            return Excel::download(new KunjunganLansiaExport($data), 'kunjungan_lansia.xlsx');
        }

        $kunjunganLansias = $query->paginate(10);
        $filteredkunjunganLansias = $kunjunganLansias->unique('nik');

        return view('kunjungan_lansia.list', [
            'kunjunganLansias' => $filteredkunjunganLansias,
            'status' => $status
        ]);
    }

    public function show($id, Request $request)
    {
        $dataKK = Kunjungan_Lansia::findOrFail($id);
        $familyMembers = Kunjungan_Lansia::where('nik', $dataKK->nik)->get();

        // Jika ekspor diminta
        if ($request->input('export', false)) {
            return Excel::download(new KunjunganLansiaExport($familyMembers), 'family_members.xlsx');
        }

        return view('kunjungan_lansia.detail', compact('dataKK', 'familyMembers'));
    }

    // Menampilkan form untuk menambahkan data lingkungan rumah baru
    public function create(Request $request)
    {
        $kk = $request->session()->get('kk');
        $nama = $request->session()->get('nama');
        return view('kunjungan_lansia.create', compact('kk', 'nama'));
    }

    // Menyimpan data lingkungan rumah baru ke dalam database
    public function store(Request $request)
    {
        // Validasi input dari formulir
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
                'tgl_periksa_satu_tahun_terakhir_ptd' => 'required|date',
                'tmp_periksa_satu_tahun_terakhir_ptd' => 'required|string',
                'hasil_periksa_satu_tahun_terakhir_ptd' => 'required|string',
                'tgl_diaknosa_darah_ptd' => 'required|date',
                'tgl_periksa_satu_tahun_terakhir_darah' => 'required|date',
                'tmp_periksa_satu_tahun_terakhir_darah' => 'required|string',
                'hasil_periksa_satu_tahun_terakhir_darah' => 'required|string',
                'obat_terakhir_darah' => 'required|string',
                'minum_obat_terakhir_darah' => 'required|string',
                'tgl_periksa_satu_tahun_gula_darah' => 'required|date',
                'tmp_periksa_satu_tahun_gula_darah' => 'required|string',
                'hasil_periksa_satu_tahun_gula_darah' => 'required|string',
                'tgl_kencing_manis_gula_darah' => 'required|date',
                'tgl_periksa_satu_tahun_gula_darah_melitus' => 'required|date',
                'tmp_periksa_satu_tahun_gula_darah_melitus' => 'required|string',
                'hasil_periksa_satu_tahun_gula_darah_melitus' => 'required|string',
                'obat_gula_darah_melitus' => 'required|string',
                'minum_obat_gula_darah_melitus' => 'required|string',
                'tgl_aks_skrining_geriatri' => 'required|date',
                'tmp_aks_skrining_geriatri' => 'required|string',
                'tgl_skilas_skrining_geriatri' => 'required|date',
                'tmp_skilas_skrining_geriatri' => 'required|string',
                'merokok' => 'required|string',
                'tgl_skrining' => 'required|date',
                'tmp_skrining' => 'required|string',
                'petugas_skrining' => 'required|string',
                'edukasi' => 'required|string',
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
                'tgl_periksa_satu_tahun_terakhir_ptd' => null,
                'tmp_periksa_satu_tahun_terakhir_ptd' => null,
                'hasil_periksa_satu_tahun_terakhir_ptd' => null,
                'tgl_diaknosa_darah_ptd' => null,
                'tgl_periksa_satu_tahun_terakhir_darah' => null,
                'tmp_periksa_satu_tahun_terakhir_darah' => null,
                'hasil_periksa_satu_tahun_terakhir_darah' => null,
                'obat_terakhir_darah' => null,
                'minum_obat_terakhir_darah' => null,
                'tgl_periksa_satu_tahun_gula_darah' => null,
                'tmp_periksa_satu_tahun_gula_darah' => null,
                'hasil_periksa_satu_tahun_gula_darah' => null,
                'tgl_kencing_manis_gula_darah' => null,
                'tgl_periksa_satu_tahun_gula_darah_melitus' => null,
                'tmp_periksa_satu_tahun_gula_darah_melitus' => null,
                'hasil_periksa_satu_tahun_gula_darah_melitus' => null,
                'obat_gula_darah_melitus' => null,
                'minum_obat_gula_darah_melitus' => null,
                'tgl_aks_skrining_geriatri' => null,
                'tmp_aks_skrining_geriatri' => null,
                'tgl_skilas_skrining_geriatri' => null,
                'tmp_skilas_skrining_geriatri' => null,
                'merokok' => null,
                'tgl_skrining' => null,
                'tmp_skrining' => null,
                'petugas_skrining' => null,
                'edukasi' => null,
            ]);
        }
        $validatedData['id_user'] = Auth::id();
        Kunjungan_Lansia::create($request->all());

        session(['kk' => $request->kk, 'nama' => $request->nama]);

        return redirect()->route('kunjungan_tbc.create')->with('success', 'Data ibu hamil berhasil ditambahkan.');
    }

    public function create2(Request $request, $id = null)
    {
        if ($id) {
            $kunjunganLansias = Kunjungan_Lansia::find($id);
            $kk = $kunjunganLansias ? $kunjunganLansias->kk : null;
            $nama = $kunjunganLansias ? $kunjunganLansias->nama : null;
            $nik = $kunjunganLansias ? $kunjunganLansias->nik : null;
        } else {
            $kk = $request->session()->get('kk');
            $nama = $request->session()->get('nama');
            $nik = $request->session()->get('nik');

            if (!$kk) {
                $kunjunganLansias = Kunjungan_Lansia::orderBy('created_at', 'desc')->first();
                $kk = $kunjunganLansias ? $kunjunganLansias->kk : null;
                $nama = $kunjunganLansias ? $kunjunganLansias->nama : null;
                $nik = $kunjunganLansias ? $kunjunganLansias->nik : null;
            }
        }
        return view('kunjungan_lansia.createdetail', compact('kk', 'nama', 'nik'));
    }



    // Menyimpan data lingkungan rumah baru ke dalam database
    public function store2(Request $request)
    {
        // Validasi input dari formulir
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
                'tgl_periksa_satu_tahun_terakhir_ptd' => 'required|date',
                'tmp_periksa_satu_tahun_terakhir_ptd' => 'required|string',
                'hasil_periksa_satu_tahun_terakhir_ptd' => 'required|string',
                'tgl_diaknosa_darah_ptd' => 'required|date',
                'tgl_periksa_satu_tahun_terakhir_darah' => 'required|date',
                'tmp_periksa_satu_tahun_terakhir_darah' => 'required|string',
                'hasil_periksa_satu_tahun_terakhir_darah' => 'required|string',
                'obat_terakhir_darah' => 'required|string',
                'minum_obat_terakhir_darah' => 'required|string',
                'tgl_periksa_satu_tahun_gula_darah' => 'required|date',
                'tmp_periksa_satu_tahun_gula_darah' => 'required|string',
                'hasil_periksa_satu_tahun_gula_darah' => 'required|string',
                'tgl_kencing_manis_gula_darah' => 'required|date',
                'tgl_periksa_satu_tahun_gula_darah_melitus' => 'required|date',
                'tmp_periksa_satu_tahun_gula_darah_melitus' => 'required|string',
                'hasil_periksa_satu_tahun_gula_darah_melitus' => 'required|string',
                'obat_gula_darah_melitus' => 'required|string',
                'minum_obat_gula_darah_melitus' => 'required|string',
                'tgl_aks_skrining_geriatri' => 'required|date',
                'tmp_aks_skrining_geriatri' => 'required|string',
                'tgl_skilas_skrining_geriatri' => 'required|date',
                'tmp_skilas_skrining_geriatri' => 'required|string',
                'merokok' => 'required|string',
                'tgl_skrining' => 'required|date',
                'tmp_skrining' => 'required|string',
                'petugas_skrining' => 'required|string',
                'edukasi' => 'required|string',
            ]);
            $validatedData = array_merge($validatedData, $additionalData);
        } else {
            // Kosongkan nilai jika status bukan 'Ya'
            $validatedData = array_merge($validatedData, [
                'tgl_lahir' => null,
                'tmp_lahir' => null,
                'gender' => null,
                'kunjungan' => null,
                'tgl_kunjungan' => null,
                'suhu_tubuh' => null,
                'tgl_periksa_satu_tahun_terakhir_ptd' => null,
                'tmp_periksa_satu_tahun_terakhir_ptd' => null,
                'hasil_periksa_satu_tahun_terakhir_ptd' => null,
                'tgl_diaknosa_darah_ptd' => null,
                'tgl_periksa_satu_tahun_terakhir_darah' => null,
                'tmp_periksa_satu_tahun_terakhir_darah' => null,
                'hasil_periksa_satu_tahun_terakhir_darah' => null,
                'obat_terakhir_darah' => null,
                'minum_obat_terakhir_darah' => null,
                'tgl_periksa_satu_tahun_gula_darah' => null,
                'tmp_periksa_satu_tahun_gula_darah' => null,
                'hasil_periksa_satu_tahun_gula_darah' => null,
                'tgl_kencing_manis_gula_darah' => null,
                'tgl_periksa_satu_tahun_gula_darah_melitus' => null,
                'tmp_periksa_satu_tahun_gula_darah_melitus' => null,
                'hasil_periksa_satu_tahun_gula_darah_melitus' => null,
                'obat_gula_darah_melitus' => null,
                'minum_obat_gula_darah_melitus' => null,
                'tgl_aks_skrining_geriatri' => null,
                'tmp_aks_skrining_geriatri' => null,
                'tgl_skilas_skrining_geriatri' => null,
                'tmp_skilas_skrining_geriatri' => null,
                'merokok' => null,
                'tgl_skrining' => null,
                'tmp_skrining' => null,
                'petugas_skrining' => null,
                'edukasi' => null,
            ]);
        }
        $validatedData['id_user'] = Auth::id();
        $kunjunganLansia = Kunjungan_Lansia::create($validatedData);

        session(['kk' => $request->kk, 'nama' => $request->nama, 'nik' => $request->nik]);

        return redirect()->route('kunjungan_lansia.show', $kunjunganLansia->id)->with('success', 'Data ibu hamil berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit data lingkungan rumah
    public function edit($id)
    {
        $kunjunganLansia = Kunjungan_Lansia::findOrFail($id);
        return view('kunjungan_lansia.edit', compact('kunjunganLansia'));
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
                'tgl_periksa_satu_tahun_terakhir_ptd' => 'required|date',
                'tmp_periksa_satu_tahun_terakhir_ptd' => 'required|string',
                'hasil_periksa_satu_tahun_terakhir_ptd' => 'required|string',
                'tgl_diaknosa_darah_ptd' => 'required|date',
                'tgl_periksa_satu_tahun_terakhir_darah' => 'required|date',
                'tmp_periksa_satu_tahun_terakhir_darah' => 'required|string',
                'hasil_periksa_satu_tahun_terakhir_darah' => 'required|string',
                'obat_terakhir_darah' => 'required|string',
                'minum_obat_terakhir_darah' => 'required|string',
                'tgl_periksa_satu_tahun_gula_darah' => 'required|date',
                'tmp_periksa_satu_tahun_gula_darah' => 'required|string',
                'hasil_periksa_satu_tahun_gula_darah' => 'required|string',
                'tgl_kencing_manis_gula_darah' => 'required|date',
                'tgl_periksa_satu_tahun_gula_darah_melitus' => 'required|date',
                'tmp_periksa_satu_tahun_gula_darah_melitus' => 'required|string',
                'hasil_periksa_satu_tahun_gula_darah_melitus' => 'required|string',
                'obat_gula_darah_melitus' => 'required|string',
                'minum_obat_gula_darah_melitus' => 'required|string',
                'tgl_aks_skrining_geriatri' => 'required|date',
                'tmp_aks_skrining_geriatri' => 'required|string',
                'tgl_skilas_skrining_geriatri' => 'required|date',
                'tmp_skilas_skrining_geriatri' => 'required|string',
                'merokok' => 'required|string',
                'tgl_skrining' => 'required|date',
                'tmp_skrining' => 'required|string',
                'petugas_skrining' => 'required|string',
                'edukasi' => 'required|string',
            ]);
        } else {
            $request->merge([
                'tgl_lahir' => null,
                'tmp_lahir' => null,
                'gender' => null,
                'kunjungan' => null,
                'tgl_kunjungan' => null,
                'suhu_tubuh' => null,
                'tgl_periksa_satu_tahun_terakhir_ptd' => null,
                'tmp_periksa_satu_tahun_terakhir_ptd' => null,
                'hasil_periksa_satu_tahun_terakhir_ptd' => null,
                'tgl_diaknosa_darah_ptd' => null,
                'tgl_periksa_satu_tahun_terakhir_darah' => null,
                'tmp_periksa_satu_tahun_terakhir_darah' => null,
                'hasil_periksa_satu_tahun_terakhir_darah' => null,
                'obat_terakhir_darah' => null,
                'minum_obat_terakhir_darah' => null,
                'tgl_periksa_satu_tahun_gula_darah' => null,
                'tmp_periksa_satu_tahun_gula_darah' => null,
                'hasil_periksa_satu_tahun_gula_darah' => null,
                'tgl_kencing_manis_gula_darah' => null,
                'tgl_periksa_satu_tahun_gula_darah_melitus' => null,
                'tmp_periksa_satu_tahun_gula_darah_melitus' => null,
                'hasil_periksa_satu_tahun_gula_darah_melitus' => null,
                'obat_gula_darah_melitus' => null,
                'minum_obat_gula_darah_melitus' => null,
                'tgl_aks_skrining_geriatri' => null,
                'tmp_aks_skrining_geriatri' => null,
                'tgl_skilas_skrining_geriatri' => null,
                'tmp_skilas_skrining_geriatri' => null,
                'merokok' => null,
                'tgl_skrining' => null,
                'tmp_skrining' => null,
                'petugas_skrining' => null,
                'edukasi' => null,
            ]);
        }
        $kunjunganLansia = Kunjungan_Lansia::findOrFail($id);
        $kunjunganLansia->update($request->all());

        // Update semua record dengan NIK yang sama
        Kunjungan_Lansia::where('nik', $kunjunganLansia->nik)
            ->update(['status' => $request->status]);

        return redirect()->route('kunjungan_lansia.index')->with('success', 'Data ibu hamil berhasil diperbarui.');
    }
    // Menampilkan form untuk mengedit data lingkungan rumah
    public function edit2($id)
    {
        $kunjunganLansia = Kunjungan_Lansia::findOrFail($id);
        return view('kunjungan_lansia.editdetail', compact('kunjunganLansia'));
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
                'tgl_periksa_satu_tahun_terakhir_ptd' => 'required|date',
                'tmp_periksa_satu_tahun_terakhir_ptd' => 'required|string',
                'hasil_periksa_satu_tahun_terakhir_ptd' => 'required|string',
                'tgl_diaknosa_darah_ptd' => 'required|date',
                'tgl_periksa_satu_tahun_terakhir_darah' => 'required|date',
                'tmp_periksa_satu_tahun_terakhir_darah' => 'required|string',
                'hasil_periksa_satu_tahun_terakhir_darah' => 'required|string',
                'obat_terakhir_darah' => 'required|string',
                'minum_obat_terakhir_darah' => 'required|string',
                'tgl_periksa_satu_tahun_gula_darah' => 'required|date',
                'tmp_periksa_satu_tahun_gula_darah' => 'required|string',
                'hasil_periksa_satu_tahun_gula_darah' => 'required|string',
                'tgl_kencing_manis_gula_darah' => 'required|date',
                'tgl_periksa_satu_tahun_gula_darah_melitus' => 'required|date',
                'tmp_periksa_satu_tahun_gula_darah_melitus' => 'required|string',
                'hasil_periksa_satu_tahun_gula_darah_melitus' => 'required|string',
                'obat_gula_darah_melitus' => 'required|string',
                'minum_obat_gula_darah_melitus' => 'required|string',
                'tgl_aks_skrining_geriatri' => 'required|date',
                'tmp_aks_skrining_geriatri' => 'required|string',
                'tgl_skilas_skrining_geriatri' => 'required|date',
                'tmp_skilas_skrining_geriatri' => 'required|string',
                'merokok' => 'required|string',
                'tgl_skrining' => 'required|date',
                'tmp_skrining' => 'required|string',
                'petugas_skrining' => 'required|string',
                'edukasi' => 'required|string',
            ]);
        } else {
            $request->merge([
                'tgl_lahir' => null,
                'tmp_lahir' => null,
                'gender' => null,
                'kunjungan' => null,
                'tgl_kunjungan' => null,
                'suhu_tubuh' => null,
                'tgl_periksa_satu_tahun_terakhir_ptd' => null,
                'tmp_periksa_satu_tahun_terakhir_ptd' => null,
                'hasil_periksa_satu_tahun_terakhir_ptd' => null,
                'tgl_diaknosa_darah_ptd' => null,
                'tgl_periksa_satu_tahun_terakhir_darah' => null,
                'tmp_periksa_satu_tahun_terakhir_darah' => null,
                'hasil_periksa_satu_tahun_terakhir_darah' => null,
                'obat_terakhir_darah' => null,
                'minum_obat_terakhir_darah' => null,
                'tgl_periksa_satu_tahun_gula_darah' => null,
                'tmp_periksa_satu_tahun_gula_darah' => null,
                'hasil_periksa_satu_tahun_gula_darah' => null,
                'tgl_kencing_manis_gula_darah' => null,
                'tgl_periksa_satu_tahun_gula_darah_melitus' => null,
                'tmp_periksa_satu_tahun_gula_darah_melitus' => null,
                'hasil_periksa_satu_tahun_gula_darah_melitus' => null,
                'obat_gula_darah_melitus' => null,
                'minum_obat_gula_darah_melitus' => null,
                'tgl_aks_skrining_geriatri' => null,
                'tmp_aks_skrining_geriatri' => null,
                'tgl_skilas_skrining_geriatri' => null,
                'tmp_skilas_skrining_geriatri' => null,
                'merokok' => null,
                'tgl_skrining' => null,
                'tmp_skrining' => null,
                'petugas_skrining' => null,
                'edukasi' => null,
            ]);
        }
        $kunjunganLansia = Kunjungan_Lansia::findOrFail($id);
        $kunjunganLansia->update($request->all());
        session(['kk' => $request->kk, 'nama' => $request->nama, 'nik' => $request->nik]);

        return redirect()->route('kunjungan_lansia.show', $kunjunganLansia->id)->with('success', 'Data ibu hamil berhasil ditambahkan.');
    }
    // ==============================================


    public function createvalidate()
    {
        return view('kunjungan_lansia.createvalidate');
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
                'tgl_periksa_satu_tahun_terakhir_ptd' => 'required|date',
                'tmp_periksa_satu_tahun_terakhir_ptd' => 'required|string',
                'hasil_periksa_satu_tahun_terakhir_ptd' => 'required|string',
                'tgl_diaknosa_darah_ptd' => 'required|date',
                'tgl_periksa_satu_tahun_terakhir_darah' => 'required|date',
                'tmp_periksa_satu_tahun_terakhir_darah' => 'required|string',
                'hasil_periksa_satu_tahun_terakhir_darah' => 'required|string',
                'obat_terakhir_darah' => 'required|string',
                'minum_obat_terakhir_darah' => 'required|string',
                'tgl_periksa_satu_tahun_gula_darah' => 'required|date',
                'tmp_periksa_satu_tahun_gula_darah' => 'required|string',
                'hasil_periksa_satu_tahun_gula_darah' => 'required|string',
                'tgl_kencing_manis_gula_darah' => 'required|date',
                'tgl_periksa_satu_tahun_gula_darah_melitus' => 'required|date',
                'tmp_periksa_satu_tahun_gula_darah_melitus' => 'required|string',
                'hasil_periksa_satu_tahun_gula_darah_melitus' => 'required|string',
                'obat_gula_darah_melitus' => 'required|string',
                'minum_obat_gula_darah_melitus' => 'required|string',
                'tgl_aks_skrining_geriatri' => 'required|date',
                'tmp_aks_skrining_geriatri' => 'required|string',
                'tgl_skilas_skrining_geriatri' => 'required|date',
                'tmp_skilas_skrining_geriatri' => 'required|string',
                'merokok' => 'required|string',
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
                'nik' => null,
                'nama' => null,
                'tgl_lahir' => null,
                'tmp_lahir' => null,
                'gender' => null,
                'kunjungan' => null,
                'tgl_kunjungan' => null,
                'suhu_tubuh' => null,
                'tgl_periksa_satu_tahun_terakhir_ptd' => null,
                'tmp_periksa_satu_tahun_terakhir_ptd' => null,
                'hasil_periksa_satu_tahun_terakhir_ptd' => null,
                'tgl_diaknosa_darah_ptd' => null,
                'tgl_periksa_satu_tahun_terakhir_darah' => null,
                'tmp_periksa_satu_tahun_terakhir_darah' => null,
                'hasil_periksa_satu_tahun_terakhir_darah' => null,
                'obat_terakhir_darah' => null,
                'minum_obat_terakhir_darah' => null,
                'tgl_periksa_satu_tahun_gula_darah' => null,
                'tmp_periksa_satu_tahun_gula_darah' => null,
                'hasil_periksa_satu_tahun_gula_darah' => null,
                'tgl_kencing_manis_gula_darah' => null,
                'tgl_periksa_satu_tahun_gula_darah_melitus' => null,
                'tmp_periksa_satu_tahun_gula_darah_melitus' => null,
                'hasil_periksa_satu_tahun_gula_darah_melitus' => null,
                'obat_gula_darah_melitus' => null,
                'minum_obat_gula_darah_melitus' => null,
                'tgl_aks_skrining_geriatri' => null,
                'tmp_aks_skrining_geriatri' => null,
                'tgl_skilas_skrining_geriatri' => null,
                'tmp_skilas_skrining_geriatri' => null,
                'merokok' => null,
                'tgl_skrining' => null,
                'tmp_skrining' => null,
                'petugas_skrining' => null,
                'edukasi' => null,
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

        Kunjungan_Lansia::create($validatedData);

        session(['nik' => $request->nik]);
        return redirect()->route('kunjungan_lansia.index')->with('success', 'Data ibu hamil berhasil ditambahkan.');
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
        $kunjunganLansia = Kunjungan_Lansia::findOrFail($id);

        // Hapus data lingkungan rumah
        $kunjunganLansia->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kunjungan_lansia.index')->with('success', 'Data kunjungan lansia berhasil dihapus.');
    }
    public function destroy2($id)
    {
        // Temukan data ibu hamil yang akan dihapus
        $kunjunganLansia = Kunjungan_Lansia::findOrFail($id);

        // Simpan KK sebelum menghapus data
        $kk = $kunjunganLansia->kk;

        // Hapus data ibu hamil
        $kunjunganLansia->delete();

        // Temukan ID data KK lain yang tersisa (jika ada)
        $otherkunjunganLansia = Kunjungan_Lansia::where('kk', $kk)->first();

        // Redirect ke halaman detail dengan menggunakan ID KK yang tersisa (jika ada), jika tidak kembali ke index
        if ($otherkunjunganLansia) {
            return redirect()->route('kunjungan_lansia.show', ['id' => $otherkunjunganLansia->id])->with('success', 'Data kunjungan lansia berhasil dihapus.');
        } else {
            return redirect()->route('kunjungan_lansia.index')->with('success', 'Data kunjungan lansia berhasil dihapus.');
        }
    }
    public function kunjunganlansiaPDF($id)
    {
        // Mengambil data kunjungan TBC berdasarkan ID
        $dataKK = Kunjungan_Lansia::findOrFail($id);
        // Mengambil anggota keluarga yang terkait dengan KK yang sama
        $kunjunganlansia = Kunjungan_Lansia::where('nik', $dataKK->nik)->get();

        // Memuat view dan mengirimkan data yang diambil
        $pdf = Pdf::loadView('kunjungan_lansia.pdf', ['kunjunganlansia' => $kunjunganlansia])
            ->setPaper('a4', 'landscape');

        // Mengirimkan file PDF yang dihasilkan
        return $pdf->stream('Kunjungan Lansia.pdf');
    }
    public function kunjunganlansiaPDF2($id)
    {
        try {
            // Mengambil data kunjungan TBC berdasarkan ID
            $kunjunganlansia = Kunjungan_Lansia::findOrFail($id);

            // Memuat view dan mengirimkan data yang diambil
            $pdf = Pdf::loadView('kunjungan_lansia.pdf2', ['kunjunganlansia' => $kunjunganlansia])
                ->setPaper('a4', 'landscape');

            // Mengirimkan file PDF yang dihasilkan
            return $pdf->stream('Kunjungan Lansia.pdf');
        } catch (\Exception $e) {
            // Menangani error jika data tidak ditemukan atau terjadi kesalahan lain
            return redirect()->back()->withErrors(['msg' => 'Data kunjungan TBC tidak ditemukan atau terjadi kesalahan.']);
        }
    }
}
