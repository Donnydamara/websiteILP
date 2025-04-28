<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan_Usia_Dewasa;
use App\Models\DataKK;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Exports\KunjunganUsiaDewasaExport;
use Maatwebsite\Excel\Facades\Excel;

class KunjunganUsiaDewasaController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $userRole = Auth::user()->role; // Peran pengguna yang sedang login
        $status = $request->input('status', 'semua'); // Default status adalah "semua"
        $export = $request->input('export', false); // Cek apakah ekspor diminta

        if ($userRole === 'admin') {
            $query = $status === 'semua'
                ? Kunjungan_Usia_Dewasa::orderBy('created_at', 'desc')
                : Kunjungan_Usia_Dewasa::where('status', $status)->orderBy('created_at', 'desc');
        } else {
            $query = $status === 'semua'
                ? Kunjungan_Usia_Dewasa::where('id_user', $userId)->orderBy('created_at', 'desc')
                : Kunjungan_Usia_Dewasa::where('id_user', $userId)->where('status', $status)->orderBy('created_at', 'desc');
        }

        // Jika ekspor diminta
        if ($export) {
            $data = $query->get();
            return Excel::download(new KunjunganUsiaDewasaExport($data), 'kunjungan_usia_dewasa.xlsx');
        }

        $kunjunganusiaDewasas = $query->paginate(10);
        $filteredkunjunganusiaDewasas = $kunjunganusiaDewasas->unique('nik');

        return view('kunjungan_usia_dewasa.list', [
            'kunjunganusiaDewasas' => $filteredkunjunganusiaDewasas,
            'status' => $status
        ]);
    }

    public function show($id, Request $request)
    {
        $dataKK = Kunjungan_Usia_Dewasa::findOrFail($id);
        $familyMembers = Kunjungan_Usia_Dewasa::where('nik', $dataKK->nik)->get();

        // Jika ekspor diminta
        if ($request->input('export', false)) {
            return Excel::download(new KunjunganUsiaDewasaExport($familyMembers), 'family_members.xlsx');
        }

        return view('kunjungan_usia_dewasa.detail', compact('dataKK', 'familyMembers'));
    }

    // Menampilkan form untuk menambahkan data lingkungan rumah baru
    public function create(Request $request)
    {
        $kk = $request->session()->get('kk');
        $nama = $request->session()->get('nama');
        return view('kunjungan_usia_dewasa.create', compact('kk', 'nama'));
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
                'riwayat_penyakit' => 'required|string',
                'kunjungan' => 'required|string',
                'tgl_kunjungan' => 'required|date',
                'suhu_tubuh' => 'required|string',
                'porsi' => 'required|string',
                'tgl_periksa_satu_tahun_terakhir_ptd' => 'required|date',
                'tmp_periksa_satu_tahun_terakhir_ptd' => 'required|string',
                'hasil_periksa_satu_tahun_terakhir_ptd' => 'required|string',
                'tgl_diaknosa_darah_ptd' => 'nullable|date',
                'tgl_periksa_satu_tahun_terakhir_darah' => 'nullable|date',
                'tmp_periksa_satu_tahun_terakhir_darah' => 'nullable|string',
                'hasil_periksa_satu_tahun_terakhir_darah' => 'nullable|string',
                'obat_terakhir_darah' => 'nullable|string',
                'diaknosa_tekanan_darah' => 'nullable|string',
                'diaknosa_gula_darah' => 'nullable|string',
                'minum_obat_terakhir_darah' => 'nullable|string',
                'tgl_periksa_satu_tahun_gula_darah' => 'required|date',
                'tmp_periksa_satu_tahun_gula_darah' => 'required|string',
                'hasil_periksa_satu_tahun_gula_darah' => 'required|string',
                'tgl_kencing_manis_gula_darah' => 'nullable|date',
                'tgl_periksa_satu_tahun_gula_darah_melitus' => 'nullable|date',
                'tmp_periksa_satu_tahun_gula_darah_melitus' => 'nullable|string',
                'hasil_periksa_satu_tahun_gula_darah_melitus' => 'nullable|string',
                'obat_gula_darah_melitus' => 'nullable|string',
                'minum_obat_gula_darah_melitus' => 'nullable|string',
                'merokok' => 'required|string',
                'jenis_kontrasepsi' => 'required|string',
                'tgl_skrining' => 'required|date',
                'tmp_skrining' => 'required|string',
                'petugas_skrining' => 'required|string',
                'edukasi' => 'required|string',
            ]);
        } else {
            $request->merge([
                'nik'  => null,
                'nama'  => null,
                'tgl_lahir' => null,
                'tgl_lahir' => null,
                'tmp_lahir' => null,
                'gender' => null,
                'riwayat_penyakit' => null,
                'kunjungan' => null,
                'tgl_kunjungan' => null,
                'suhu_tubuh' => null,
                'porsi' => null,
                'tgl_periksa_satu_tahun_terakhir_ptd' => null,
                'tmp_periksa_satu_tahun_terakhir_ptd' => null,
                'hasil_periksa_satu_tahun_terakhir_ptd' => null,
                'tgl_diaknosa_darah_ptd' => null,
                'diaknosa_tekanan_darah' => null,
                'diaknosa_gula_darah' => null,
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
                'merokok' => null,
                'jenis_kontrasepsi' => null,
                'tgl_skrining' => null,
                'tmp_skrining' => null,
                'petugas_skrining' => null,
                'edukasi' => null,
            ]);
        }
        $validatedData['id_user'] = Auth::id();
        Kunjungan_Usia_Dewasa::create($request->all());

        session(['kk' => $request->kk, 'nama' => $request->nama]);

        return redirect()->route('kunjungan_lansia.create')->with('success', 'Data ibu hamil berhasil ditambahkan.');
    }

    public function create2(Request $request, $id = null)
    {
        if ($id) {
            $kunjunganusiaDewasa = Kunjungan_Usia_Dewasa::find($id);
            $kk = $kunjunganusiaDewasa ? $kunjunganusiaDewasa->kk : null;
            $nama = $kunjunganusiaDewasa ? $kunjunganusiaDewasa->nama : null;
            $nik = $kunjunganusiaDewasa ? $kunjunganusiaDewasa->nik : null;
        } else {
            $kk = $request->session()->get('kk');
            $nama = $request->session()->get('nama');
            $nik = $request->session()->get('nik');

            if (!$kk) {
                $kunjunganusiaDewasa = Kunjungan_Usia_Dewasa::orderBy('created_at', 'desc')->first();
                $kk = $kunjunganusiaDewasa ? $kunjunganusiaDewasa->kk : null;
                $nama = $kunjunganusiaDewasa ? $kunjunganusiaDewasa->nama : null;
                $nik = $kunjunganusiaDewasa ? $kunjunganusiaDewasa->nik : null;
            }
        }

        return view('kunjungan_usia_dewasa.createdetail', compact('kk', 'nama', 'nik'));
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

        // Jika status 'Ya', validasi tambahan
        if ($request->status === 'Ya') {
            $additionalData = $request->validate([

                'tgl_lahir' => 'required|date',
                'tmp_lahir' => 'required|string',
                'gender' => 'required|string',
                'riwayat_penyakit' => 'required|string',
                'kunjungan' => 'required|string',
                'tgl_kunjungan' => 'required|date',
                'suhu_tubuh' => 'required|string',
                'porsi' => 'required|string',
                'tgl_periksa_satu_tahun_terakhir_ptd' => 'required|date',
                'tmp_periksa_satu_tahun_terakhir_ptd' => 'required|string',
                'hasil_periksa_satu_tahun_terakhir_ptd' => 'required|string',
                'tgl_diaknosa_darah_ptd' => 'nullable|date',
                'tgl_periksa_satu_tahun_terakhir_darah' => 'nullable|date',
                'tmp_periksa_satu_tahun_terakhir_darah' => 'nullable|string',
                'hasil_periksa_satu_tahun_terakhir_darah' => 'nullable|string',
                'obat_terakhir_darah' => 'nullable|string',
                'diaknosa_tekanan_darah' => 'nullable|string',
                'diaknosa_gula_darah' => 'nullable|string',
                'minum_obat_terakhir_darah' => 'nullable|string',
                'tgl_periksa_satu_tahun_gula_darah' => 'required|date',
                'tmp_periksa_satu_tahun_gula_darah' => 'required|string',
                'hasil_periksa_satu_tahun_gula_darah' => 'required|string',
                'tgl_kencing_manis_gula_darah' => 'nullable|date',
                'tgl_periksa_satu_tahun_gula_darah_melitus' => 'nullable|date',
                'tmp_periksa_satu_tahun_gula_darah_melitus' => 'nullable|string',
                'hasil_periksa_satu_tahun_gula_darah_melitus' => 'nullable|string',
                'obat_gula_darah_melitus' => 'nullable|string',
                'minum_obat_gula_darah_melitus' => 'nullable|string',
                'merokok' => 'required|string',
                'jenis_kontrasepsi' => 'required|string',
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
                'tgl_lahir' => null,
                'tmp_lahir' => null,
                'gender' => null,
                'riwayat_penyakit' => null,
                'kunjungan' => null,
                'tgl_kunjungan' => null,
                'suhu_tubuh' => null,
                'porsi' => null,
                'tgl_periksa_satu_tahun_terakhir_ptd' => null,
                'tmp_periksa_satu_tahun_terakhir_ptd' => null,
                'hasil_periksa_satu_tahun_terakhir_ptd' => null,
                'tgl_diaknosa_darah_ptd' => null,
                'diaknosa_tekanan_darah' => null,
                'diaknosa_gula_darah' => null,
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
                'merokok' => null,
                'jenis_kontrasepsi' => null,
                'tgl_skrining' => null,
                'tmp_skrining' => null,
                'petugas_skrining' => null,
                'edukasi' => null,
            ]);
        }
        $validatedData['id_user'] = Auth::id();

        $kunjunganusiaDewasa = Kunjungan_Usia_Dewasa::create($validatedData);
        session(['kk' => $request->kk, 'nama' => $request->nama, 'nik' => $request->nik]);

        return redirect()->route('kunjungan_usia_dewasa.show', $kunjunganusiaDewasa->id)->with('success', 'Data ibu hamil berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit data lingkungan rumah
    public function edit($id)
    {
        $kunjunganusiaDewasa = Kunjungan_Usia_Dewasa::findOrFail($id);
        return view('kunjungan_usia_dewasa.edit', compact('kunjunganusiaDewasa'));
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
                'riwayat_penyakit' => 'required|string',
                'kunjungan' => 'required|string',
                'tgl_kunjungan' => 'required|date',
                'suhu_tubuh' => 'required|string',
                'porsi' => 'required|string',
                'tgl_periksa_satu_tahun_terakhir_ptd' => 'required|date',
                'tmp_periksa_satu_tahun_terakhir_ptd' => 'required|string',
                'hasil_periksa_satu_tahun_terakhir_ptd' => 'required|string',
                'tgl_diaknosa_darah_ptd' => 'nullable|date',
                'tgl_periksa_satu_tahun_terakhir_darah' => 'nullable|date',
                'tmp_periksa_satu_tahun_terakhir_darah' => 'nullable|string',
                'hasil_periksa_satu_tahun_terakhir_darah' => 'nullable|string',
                'obat_terakhir_darah' => 'nullable|string',
                'diaknosa_tekanan_darah' => 'nullable|string',
                'diaknosa_gula_darah' => 'nullable|string',
                'minum_obat_terakhir_darah' => 'nullable|string',
                'tgl_periksa_satu_tahun_gula_darah' => 'required|date',
                'tmp_periksa_satu_tahun_gula_darah' => 'required|string',
                'hasil_periksa_satu_tahun_gula_darah' => 'required|string',
                'tgl_kencing_manis_gula_darah' => 'nullable|date',
                'tgl_periksa_satu_tahun_gula_darah_melitus' => 'nullable|date',
                'tmp_periksa_satu_tahun_gula_darah_melitus' => 'nullable|string',
                'hasil_periksa_satu_tahun_gula_darah_melitus' => 'nullable|string',
                'obat_gula_darah_melitus' => 'nullable|string',
                'minum_obat_gula_darah_melitus' => 'nullable|string',
                'merokok' => 'required|string',
                'jenis_kontrasepsi' => 'required|string',
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
                'riwayat_penyakit' => null,
                'kunjungan' => null,
                'tgl_kunjungan' => null,
                'suhu_tubuh' => null,
                'porsi' => null,
                'tgl_periksa_satu_tahun_terakhir_ptd' => null,
                'tmp_periksa_satu_tahun_terakhir_ptd' => null,
                'hasil_periksa_satu_tahun_terakhir_ptd' => null,
                'tgl_diaknosa_darah_ptd' => null,
                'diaknosa_tekanan_darah' => null,
                'diaknosa_gula_darah' => null,
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
                'merokok' => null,
                'jenis_kontrasepsi' => null,
                'tgl_skrining' => null,
                'tmp_skrining' => null,
                'petugas_skrining' => null,
                'edukasi' => null,
            ]);
        }
        $kunjunganusiaDewasa = Kunjungan_Usia_Dewasa::findOrFail($id);
        $kunjunganusiaDewasa->update($request->all());
        Kunjungan_Usia_Dewasa::where('nik', $kunjunganusiaDewasa->nik)
            ->update(['status' => $request->status]);

        return redirect()->route('kunjungan_usia_dewasa.index')->with('success', 'Data ibu hamil berhasil diperbarui.');
    }
    // Menampilkan form untuk mengedit data lingkungan rumah
    public function edit2($id)
    {
        $kunjunganusiaDewasa = Kunjungan_Usia_Dewasa::findOrFail($id);
        return view('kunjungan_usia_dewasa.editdetail', compact('kunjunganusiaDewasa'));
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
                'riwayat_penyakit' => 'required|string',
                'kunjungan' => 'required|string',
                'tgl_kunjungan' => 'required|date',
                'suhu_tubuh' => 'required|string',
                'porsi' => 'required|string',
                'tgl_periksa_satu_tahun_terakhir_ptd' => 'required|date',
                'tmp_periksa_satu_tahun_terakhir_ptd' => 'required|string',
                'hasil_periksa_satu_tahun_terakhir_ptd' => 'required|string',
                'tgl_diaknosa_darah_ptd' => 'nullable|date',
                'tgl_periksa_satu_tahun_terakhir_darah' => 'nullable|date',
                'tmp_periksa_satu_tahun_terakhir_darah' => 'nullable|string',
                'hasil_periksa_satu_tahun_terakhir_darah' => 'nullable|string',
                'obat_terakhir_darah' => 'nullable|string',
                'diaknosa_tekanan_darah' => 'nullable|string',
                'diaknosa_gula_darah' => 'nullable|string',
                'minum_obat_terakhir_darah' => 'nullable|string',
                'tgl_periksa_satu_tahun_gula_darah' => 'required|date',
                'tmp_periksa_satu_tahun_gula_darah' => 'required|string',
                'hasil_periksa_satu_tahun_gula_darah' => 'required|string',
                'tgl_kencing_manis_gula_darah' => 'nullable|date',
                'tgl_periksa_satu_tahun_gula_darah_melitus' => 'nullable|date',
                'tmp_periksa_satu_tahun_gula_darah_melitus' => 'nullable|string',
                'hasil_periksa_satu_tahun_gula_darah_melitus' => 'nullable|string',
                'obat_gula_darah_melitus' => 'nullable|string',
                'minum_obat_gula_darah_melitus' => 'nullable|string',
                'merokok' => 'required|string',
                'jenis_kontrasepsi' => 'required|string',
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
                'riwayat_penyakit' => null,
                'kunjungan' => null,
                'tgl_kunjungan' => null,
                'suhu_tubuh' => null,
                'porsi' => null,
                'tgl_periksa_satu_tahun_terakhir_ptd' => null,
                'tmp_periksa_satu_tahun_terakhir_ptd' => null,
                'hasil_periksa_satu_tahun_terakhir_ptd' => null,
                'tgl_diaknosa_darah_ptd' => null,
                'diaknosa_tekanan_darah' => null,
                'diaknosa_gula_darah' => null,
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
                'merokok' => null,
                'jenis_kontrasepsi' => null,
                'tgl_skrining' => null,
                'tmp_skrining' => null,
                'petugas_skrining' => null,
                'edukasi' => null,
            ]);
        }
        $kunjunganusiaDewasa = Kunjungan_Usia_Dewasa::findOrFail($id);
        $kunjunganusiaDewasa->update($request->all());
        session(['kk' => $request->kk, 'nama' => $request->nama, 'nik' => $request->nik]);

        return redirect()->route('kunjungan_usia_dewasa.show', $kunjunganusiaDewasa->id)->with('success', 'Data ibu hamil berhasil ditambahkan.');
    }
    // ==============================================


    public function createvalidate()
    {
        return view('kunjungan_usia_dewasa.createvalidate');
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
                'riwayat_penyakit' => 'required|string',
                'kunjungan' => 'required|string',
                'tgl_kunjungan' => 'required|date',
                'suhu_tubuh' => 'required|string',
                'porsi' => 'required|string',
                'tgl_periksa_satu_tahun_terakhir_ptd' => 'required|date',
                'tmp_periksa_satu_tahun_terakhir_ptd' => 'required|string',
                'hasil_periksa_satu_tahun_terakhir_ptd' => 'required|string',
                'tgl_diaknosa_darah_ptd' => 'nullable|date',
                'tgl_periksa_satu_tahun_terakhir_darah' => 'nullable|date',
                'tmp_periksa_satu_tahun_terakhir_darah' => 'nullable|string',
                'hasil_periksa_satu_tahun_terakhir_darah' => 'nullable|string',
                'obat_terakhir_darah' => 'nullable|string',
                'diaknosa_tekanan_darah' => 'nullable|string',
                'diaknosa_gula_darah' => 'nullable|string',
                'minum_obat_terakhir_darah' => 'nullable|string',
                'tgl_periksa_satu_tahun_gula_darah' => 'required|date',
                'tmp_periksa_satu_tahun_gula_darah' => 'required|string',
                'hasil_periksa_satu_tahun_gula_darah' => 'required|string',
                'tgl_kencing_manis_gula_darah' => 'nullable|date',
                'tgl_periksa_satu_tahun_gula_darah_melitus' => 'nullable|date',
                'tmp_periksa_satu_tahun_gula_darah_melitus' => 'nullable|string',
                'hasil_periksa_satu_tahun_gula_darah_melitus' => 'nullable|string',
                'obat_gula_darah_melitus' => 'nullable|string',
                'minum_obat_gula_darah_melitus' => 'nullable|string',
                'merokok' => 'required|string',
                'jenis_kontrasepsi' => 'required|string',
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
                'nik'  => null,
                'nama'  => null,
                'tgl_lahir' => null,
                'tmp_lahir' => null,
                'gender' => null,
                'riwayat_penyakit' => null,
                'kunjungan' => null,
                'tgl_kunjungan' => null,
                'suhu_tubuh' => null,
                'porsi' => null,
                'tgl_periksa_satu_tahun_terakhir_ptd' => null,
                'tmp_periksa_satu_tahun_terakhir_ptd' => null,
                'hasil_periksa_satu_tahun_terakhir_ptd' => null,
                'tgl_diaknosa_darah_ptd' => null,
                'diaknosa_tekanan_darah' => null,
                'diaknosa_gula_darah' => null,
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
                'merokok' => null,
                'jenis_kontrasepsi' => null,
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

        Kunjungan_Usia_Dewasa::create($validatedData);

        session(['nik' => $request->nik]);
        return redirect()->route('kunjungan_usia_dewasa.index')->with('success', 'Data ibu hamil berhasil ditambahkan.');
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
        $kunjunganusiaDewasa = Kunjungan_Usia_Dewasa::findOrFail($id);

        // Hapus data lingkungan rumah
        $kunjunganusiaDewasa->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kunjungan_usia_dewasa.index')->with('success', 'Data kunjungan dewasa berhasil dihapus.');
    }
    public function destroy2($id)
    {
        // Temukan data ibu hamil yang akan dihapus
        $kunjunganusiaDewasa = Kunjungan_Usia_Dewasa::findOrFail($id);

        // Simpan KK sebelum menghapus data
        $kk = $kunjunganusiaDewasa->kk;

        // Hapus data ibu hamil
        $kunjunganusiaDewasa->delete();

        // Temukan ID data KK lain yang tersisa (jika ada)
        $otherkunjunganusiaDewasa = Kunjungan_Usia_Dewasa::where('kk', $kk)->first();

        // Redirect ke halaman detail dengan menggunakan ID KK yang tersisa (jika ada), jika tidak kembali ke index
        if ($otherkunjunganusiaDewasa) {
            return redirect()->route('kunjungan_usia_dewasa.show', ['id' => $otherkunjunganusiaDewasa->id])->with('success', 'Data kunjungan dewasa berhasil dihapus.');
        } else {
            return redirect()->route('kunjungan_usia_dewasa.index')->with('success', 'Data kunjungan dewasa berhasil dihapus.');
        }
    }
    public function kunjunganusiadewasaPDF($id)
    {
        // Mengambil data kunjungan TBC berdasarkan ID
        $dataKK = Kunjungan_Usia_Dewasa::findOrFail($id);

        // Mengambil anggota keluarga yang terkait dengan KK yang sama
        $kunjunganusiadewasa = Kunjungan_Usia_Dewasa::where('nik', $dataKK->nik)->get();

        $pdf = Pdf::loadView('kunjungan_usia_dewasa.pdf', ['kunjunganusiadewasa' => $kunjunganusiadewasa])
            ->setPaper('a4', 'landscape');

        return $pdf->stream('Kunjungan Usia Dewasa.pdf');
    }
    public function kunjunganusiadewasaPDF2($id)
    {
        try {
            // Mengambil data kunjungan TBC berdasarkan ID
            $kunjunganusiadewasa = Kunjungan_Usia_Dewasa::findOrFail($id);

            // Memuat view dan mengirimkan data yang diambil
            $pdf = Pdf::loadView('kunjungan_usia_dewasa.pdf2', ['kunjunganusiadewasa' => $kunjunganusiadewasa])
                ->setPaper('a4', 'landscape');

            // Mengirimkan file PDF yang dihasilkan
            return $pdf->stream('Kunjungan Usia Dewasa.pdf');
        } catch (\Exception $e) {
            // Menangani error jika data tidak ditemukan atau terjadi kesalahan lain
            return redirect()->back()->withErrors(['msg' => 'Data kunjungan Usia Sekolah tidak ditemukan atau terjadi kesalahan.']);
        }
    }
}
