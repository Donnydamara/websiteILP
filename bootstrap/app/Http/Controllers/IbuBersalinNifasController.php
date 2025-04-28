<?php

namespace App\Http\Controllers;

use App\Models\Ibu_Bersalin_Nifas;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataKK;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\IbuBersalinNifasExport;

class IbuBersalinNifasController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $userRole = Auth::user()->role;
        $status = $request->input('status', 'ya');
        $export = $request->input('export', false); // Cek apakah permintaan ekspor

        if ($userRole === 'admin') {
            if ($status === 'semua') {
                $ibuhamilNifass = Ibu_Bersalin_Nifas::orderBy('created_at', 'desc');
            } else {
                $ibuhamilNifass = Ibu_Bersalin_Nifas::where('status', $status)
                    ->orderBy('created_at', 'desc');
            }
        } else {
            if ($status === 'semua') {
                $ibuhamilNifass = Ibu_Bersalin_Nifas::where('id_user', $userId)
                    ->orderBy('created_at', 'desc');
            } else {
                $ibuhamilNifass = Ibu_Bersalin_Nifas::where('id_user', $userId)
                    ->where('status', $status)
                    ->orderBy('created_at', 'desc');
            }
        }

        // Jika permintaan untuk ekspor, kembalikan file Excel
        if ($export) {
            return Excel::download(new IbuBersalinNifasExport($ibuhamilNifass->get()), 'ibu_bersalin_nifas.xlsx');
        }

        // Lakukan paginasi jika bukan ekspor
        $ibuhamilNifass = $ibuhamilNifass->paginate(10);
        $filteredibuhamilNifass = $ibuhamilNifass->unique('nik');

        return view('ibu_bersalin_nifas.list', ['ibuhamilNifass' => $filteredibuhamilNifass, 'status' => $status]);
    }

    public function show($id, Request $request)
    {
        // Retrieve data Ibu Bersalin Nifas by ID
        $dataKK = Ibu_Bersalin_Nifas::findOrFail($id);
        $familyMembers = Ibu_Bersalin_Nifas::where('nik', $dataKK->nik)->get();

        // Check if export is requested
        if ($request->input('export', false)) {
            // Export family members data to Excel
            return Excel::download(new IbuBersalinNifasExport($familyMembers), 'ibu_bersalin_nifas_family_members.xlsx');
        }

        return view('ibu_bersalin_nifas.detail', compact('dataKK', 'familyMembers'));
    }

    // Menampilkan form untuk menambahkan data lingkungan rumah baru
    public function create(Request $request)
    {
        $kk = $request->session()->get('kk');
        $nama = $request->session()->get('nama');
        return view('ibu_bersalin_nifas.create', compact('kk', 'nama'));
    }

    // Menyimpan data lingkungan rumah baru ke dalam database
    public function store(Request $request)
    {
        $request->validate([
            'kk' => 'required|integer|min:0',
            'status' => 'required|string',
            // Tambahkan aturan validasi lainnya di sini
        ]);

        // Check if the status is 'Ya'
        if ($request->status === 'Ya') {
            $request->validate([
                'nik' => 'required|integer|min:0',
                'nama' => 'required|string',
                'umur_ibu' => 'integer|required',
                'kelahiran_ke' => 'integer|required',
                'tgl_persalinan' => 'date|required',
                'pukul_persalinan' => 'date_format:H:i|required',
                'usia_kehamilan_persalinan' => 'integer|required',
                'penolong_persalinan' => 'string|required',
                'lainya_penolong_persalinan' => 'string|nullable',
                'tmpt_persalinan' => 'string|required',
                'nama_tmpt_persalinan' => 'string|required',
                'cara_persalinan' => 'string|required',
                'lainya_cara_persalinan' => 'string|nullable',
                'keadaan_ibu_persalinan' => 'string|required',
                'riwayat_imd_persalinan' => 'string|required',
                'kunjungan' => 'integer|required',
                'tgl_kunjungan' => 'date|required',
                'suhu_tubuh' => 'string|required',
                'buku_ka' => 'string|required',
                'pemeriksaan_kesehatan' => 'string|required',
                'tgl_pk' => 'date|required',
                'tempat_pk' => 'string|required',
                'petugas_pk' => 'string|required',
                'porsi' => 'string|required',
                'ada_kva' => 'string|required',
                'wkt_minum_kva' => 'date|required',
                'menyusui' => 'string|required',
                'kb_pasca_persalinan' => 'string|required',
                'skrining_kesehatan' => 'date|required',
                'skrining_kesehatan_tmp' => 'string|required',
                'skrining_kesehatan_petugas' => 'string|required',
                'edukasi_kunjungan' => 'date|required',
                'demam' => 'string|required',
                'perasaan' => 'string|required',
                'sakit' => 'string|required',
                'pernafasan' => 'string|required',
                'payudara' => 'string|required',
                'sakit_kepala' => 'string|required',
                'pendarahan' => 'string|required',
                'sakit_bagian_kelamin' => 'string|required',
                'keluar_cairan' => 'string|required',
                'pandangan_kabur' => 'string|required',
                'darah_nifas' => 'string|required',
                'keputihan' => 'string|required',
                'jantung_berdebar' => 'string|required',
                'pengingat_periksa_postu' => 'string|required',
                'tgl_laporan_nakes' => 'date|required',
            ]);
        } else {
            // Set all fields to '-' if status is 'Tidak'
            $request->merge([
                'nik' => null,
                'nama' => null,
                'umur_ibu' => null,
                'kelahiran_ke' => null,
                'tgl_persalinan' => null,
                'pukul_persalinan' => null,
                'usia_kehamilan_persalinan' => null,
                'penolong_persalinan' => null,
                'lainya_penolong_persalinan' => null,
                'tmpt_persalinan' => null,
                'nama_tmpt_persalinan' => null,
                'cara_persalinan' => null,
                'lainya_cara_persalinan' => null,
                'keadaan_ibu_persalinan' => null,
                'riwayat_imd_persalinan' => null,
                'kunjungan' => null,
                'tgl_kunjungan' => null,
                'suhu_tubuh' => null,
                'buku_ka' => null,
                'pemeriksaan_kesehatan' => null,
                'tgl_pk' => null,
                'tempat_pk' => null,
                'petugas_pk' => null,
                'porsi' => null,
                'ada_kva' => null,
                'wkt_minum_kva' => null,
                'menyusui' => null,
                'kb_pasca_persalinan' => null,
                'skrining_kesehatan' => null,
                'skrining_kesehatan_tmp' => null,
                'skrining_kesehatan_petugas' => null,
                'edukasi_kunjungan' => null,
                'demam' => null,
                'perasaan' => null,
                'sakit' => null,
                'pernafasan' => null,
                'payudara' => null,
                'sakit_kepala' => null,
                'pendarahan' => null,
                'sakit_bagian_kelamin' => null,
                'keluar_cairan' => null,
                'pandangan_kabur' => null,
                'darah_nifas' => null,
                'keputihan' => null,
                'jantung_berdebar' => null,
                'pengingat_periksa_postu' => null,
                'tgl_laporan_nakes' => null,
            ]);
        }
        $validatedData['id_user'] = Auth::id();
        Ibu_Bersalin_Nifas::create($request->all());

        session(['kk' => $request->kk, 'nama' => $request->nama]);

        return redirect()->route('kunjungan_rumah_bayi.create')->with('success', 'Data ibu hamil berhasil ditambahkan.');
    }

    public function create2(Request $request, $id = null)
    {
        if ($id) {
            $ibuhamilNifas = Ibu_Bersalin_Nifas::find($id);
            $kk = $ibuhamilNifas ? $ibuhamilNifas->kk : null;
            $nama = $ibuhamilNifas ? $ibuhamilNifas->nama : null;
            $nik = $ibuhamilNifas ? $ibuhamilNifas->nik : null;
        } else {
            $kk = $request->session()->get('kk');
            $nama = $request->session()->get('nama');
            $nik = $request->session()->get('nik');

            if (!$kk) {
                $ibuhamilNifas = Ibu_Bersalin_Nifas::orderBy('created_at', 'desc')->first();
                $kk = $ibuhamilNifas ? $ibuhamilNifas->kk : null;
                $nama = $ibuhamilNifas ? $ibuhamilNifas->nama : null;
                $nik = $ibuhamilNifas ? $ibuhamilNifas->nik : null;
            }
        }

        return view('ibu_bersalin_nifas.createdetail', compact('kk', 'nama', 'nik'));
    }



    public function store2(Request $request)
    {
        // Validasi umum
        $validatedData = $request->validate([
            'kk' => 'required|integer|min:0',
            'status' => 'required|string',
            'nik' => 'required|integer|min:0',
            'nama' => 'required|string',
            // Tambahkan aturan validasi lainnya di sini
        ]);

        // Jika status 'Ya', validasi tambahan
        if ($request->status === 'Ya') {
            $additionalData = $request->validate([
                'umur_ibu' => 'integer|required',
                'kelahiran_ke' => 'integer|required',
                'tgl_persalinan' => 'date|required',
                'pukul_persalinan' => 'date_format:H:i|required',
                'usia_kehamilan_persalinan' => 'integer|required',
                'penolong_persalinan' => 'string|required',
                'lainya_penolong_persalinan' => 'string|nullable',
                'tmpt_persalinan' => 'string|required',
                'nama_tmpt_persalinan' => 'string|required',
                'cara_persalinan' => 'string|required',
                'lainya_cara_persalinan' => 'string|nullable',
                'keadaan_ibu_persalinan' => 'string|required',
                'riwayat_imd_persalinan' => 'string|required',
                'kunjungan' => 'integer|required',
                'tgl_kunjungan' => 'date|required',
                'suhu_tubuh' => 'string|required',
                'buku_ka' => 'string|required',
                'pemeriksaan_kesehatan' => 'string|required',
                'tgl_pk' => 'date|required',
                'tempat_pk' => 'string|required',
                'petugas_pk' => 'string|required',
                'porsi' => 'string|required',
                'ada_kva' => 'string|required',
                'wkt_minum_kva' => 'date|required',
                'menyusui' => 'string|required',
                'kb_pasca_persalinan' => 'string|required',
                'skrining_kesehatan' => 'date|required',
                'skrining_kesehatan_tmp' => 'string|required',
                'skrining_kesehatan_petugas' => 'string|required',
                'edukasi_kunjungan' => 'date|required',
                'demam' => 'string|required',
                'perasaan' => 'string|required',
                'sakit' => 'string|required',
                'pernafasan' => 'string|required',
                'payudara' => 'string|required',
                'sakit_kepala' => 'string|required',
                'pendarahan' => 'string|required',
                'sakit_bagian_kelamin' => 'string|required',
                'keluar_cairan' => 'string|required',
                'pandangan_kabur' => 'string|required',
                'darah_nifas' => 'string|required',
                'keputihan' => 'string|required',
                'jantung_berdebar' => 'string|required',
                'pengingat_periksa_postu' => 'string|required',
                'tgl_laporan_nakes' => 'date|required',
            ]);

            $validatedData = array_merge($validatedData, $additionalData);
        } else {
            // Kosongkan nilai jika status bukan 'Ya'
            $validatedData = array_merge($validatedData, [
                'umur_ibu' => null,
                'kelahiran_ke' => null,
                'tgl_persalinan' => null,
                'pukul_persalinan' => null,
                'usia_kehamilan_persalinan' => null,
                'penolong_persalinan' => null,
                'lainya_penolong_persalinan' => null,
                'tmpt_persalinan' => null,
                'nama_tmpt_persalinan' => null,
                'cara_persalinan' => null,
                'lainya_cara_persalinan' => null,
                'keadaan_ibu_persalinan' => null,
                'riwayat_imd_persalinan' => null,
                'kunjungan' => null,
                'tgl_kunjungan' => null,
                'suhu_tubuh' => null,
                'buku_ka' => null,
                'pemeriksaan_kesehatan' => null,
                'tgl_pk' => null,
                'tempat_pk' => null,
                'petugas_pk' => null,
                'porsi' => null,
                'ada_kva' => null,
                'wkt_minum_kva' => null,
                'menyusui' => null,
                'kb_pasca_persalinan' => null,
                'skrining_kesehatan' => null,
                'skrining_kesehatan_tmp' => null,
                'skrining_kesehatan_petugas' => null,
                'edukasi_kunjungan' => null,
                'demam' => null,
                'perasaan' => null,
                'sakit' => null,
                'pernafasan' => null,
                'payudara' => null,
                'sakit_kepala' => null,
                'pendarahan' => null,
                'sakit_bagian_kelamin' => null,
                'keluar_cairan' => null,
                'pandangan_kabur' => null,
                'darah_nifas' => null,
                'keputihan' => null,
                'jantung_berdebar' => null,
                'pengingat_periksa_postu' => null,
                'tgl_laporan_nakes' => null,
            ]);
        }

        // Tambahkan ID pengguna saat ini
        $validatedData['id_user'] = Auth::id();

        // Simpan data ke dalam tabel
        $ibuhamilNifas = Ibu_Bersalin_Nifas::create($validatedData);

        // Simpan data ke session untuk digunakan selanjutnya
        session(['kk' => $request->kk, 'nama' => $request->nama, 'nik' => $request->nik]);

        // Redirect ke halaman yang ditentukan dengan pesan sukses
        return redirect()->route('ibu_bersalin_nifas.show', $ibuhamilNifas->id)
            ->with('success', 'Data ibu hamil berhasil ditambahkan.');
    }


    // Menampilkan form untuk mengedit data lingkungan rumah
    public function edit($id)
    {
        $ibuhamilNifas = Ibu_Bersalin_Nifas::findOrFail($id);
        return view('ibu_bersalin_nifas.edit', compact('ibuhamilNifas'));
    }

    // Menyimpan perubahan pada data lingkungan rumah ke dalam database
    public function update(Request $request, $id)
    {
        // Validasi dasar
        $request->validate([
            'kk' => 'required|integer|min:0',
            'status' => 'required|string',
        ]);

        // Validasi tambahan berdasarkan status
        if ($request->status === 'Ya' || $request->status === 'Selesai') {
            $request->validate([
                'nik' => 'required|integer|min:0',
                'nama' => 'required|string',
                'umur_ibu' => 'integer|required',
                'kelahiran_ke' => 'integer|required',
                'tgl_persalinan' => 'date|required',
                'pukul_persalinan' => 'date_format:H:i|required',
                'usia_kehamilan_persalinan' => 'integer|required',
                'penolong_persalinan' => 'string|required',
                'lainya_penolong_persalinan' => 'string|nullable',
                'tmpt_persalinan' => 'string|required',
                'nama_tmpt_persalinan' => 'string|required',
                'cara_persalinan' => 'string|required',
                'lainya_cara_persalinan' => 'string|nullable',
                'keadaan_ibu_persalinan' => 'string|required',
                'riwayat_imd_persalinan' => 'string|required',
                'kunjungan' => 'integer|required',
                'tgl_kunjungan' => 'date|required',
                'suhu_tubuh' => 'string|required',
                'buku_ka' => 'string|required',
                'pemeriksaan_kesehatan' => 'string|required',
                'tgl_pk' => 'date|required',
                'tempat_pk' => 'string|required',
                'petugas_pk' => 'string|required',
                'porsi' => 'string|required',
                'ada_kva' => 'string|required',
                'wkt_minum_kva' => 'date|required',
                'menyusui' => 'string|required',
                'kb_pasca_persalinan' => 'string|required',
                'skrining_kesehatan' => 'date|required',
                'skrining_kesehatan_tmp' => 'string|required',
                'skrining_kesehatan_petugas' => 'string|required',
                'edukasi_kunjungan' => 'date|required',
                'demam' => 'string|required',
                'perasaan' => 'string|required',
                'sakit' => 'string|required',
                'pernafasan' => 'string|required',
                'payudara' => 'string|required',
                'sakit_kepala' => 'string|required',
                'pendarahan' => 'string|required',
                'sakit_bagian_kelamin' => 'string|required',
                'keluar_cairan' => 'string|required',
                'pandangan_kabur' => 'string|required',
                'darah_nifas' => 'string|required',
                'keputihan' => 'string|required',
                'jantung_berdebar' => 'string|required',
                'pengingat_periksa_postu' => 'string|required',
                'tgl_laporan_nakes' => 'date|required',
            ]);
        } else {
            // Kosongkan semua field jika status adalah 'Tidak'
            $request->merge([
                'nik' => null,
                'nama' => null,
                'umur_ibu' => null,
                'kelahiran_ke' => null,
                'tgl_persalinan' => null,
                'pukul_persalinan' => null,
                'usia_kehamilan_persalinan' => null,
                'penolong_persalinan' => null,
                'lainya_penolong_persalinan' => null,
                'tmpt_persalinan' => null,
                'nama_tmpt_persalinan' => null,
                'cara_persalinan' => null,
                'lainya_cara_persalinan' => null,
                'keadaan_ibu_persalinan' => null,
                'riwayat_imd_persalinan' => null,
                'kunjungan' => null,
                'tgl_kunjungan' => null,
                'suhu_tubuh' => null,
                'buku_ka' => null,
                'pemeriksaan_kesehatan' => null,
                'tgl_pk' => null,
                'tempat_pk' => null,
                'petugas_pk' => null,
                'porsi' => null,
                'ada_kva' => null,
                'wkt_minum_kva' => null,
                'menyusui' => null,
                'kb_pasca_persalinan' => null,
                'skrining_kesehatan' => null,
                'skrining_kesehatan_tmp' => null,
                'skrining_kesehatan_petugas' => null,
                'edukasi_kunjungan' => null,
                'demam' => null,
                'perasaan' => null,
                'sakit' => null,
                'pernafasan' => null,
                'payudara' => null,
                'sakit_kepala' => null,
                'pendarahan' => null,
                'sakit_bagian_kelamin' => null,
                'keluar_cairan' => null,
                'pandangan_kabur' => null,
                'darah_nifas' => null,
                'keputihan' => null,
                'jantung_berdebar' => null,
                'pengingat_periksa_postu' => null,
                'tgl_laporan_nakes' => null,
            ]);
        }

        // Format waktu persalinan
        $request['pukul_persalinan'] = date('H:i', strtotime($request->pukul_persalinan));

        // Update record Ibu_Hamil_Nifas spesifik
        $ibu_hamil_nifas = Ibu_Bersalin_Nifas::findOrFail($id);
        $ibu_hamil_nifas->update($request->all());

        // Update semua record dengan NIK yang sama
        Ibu_Bersalin_Nifas::where('nik', $ibu_hamil_nifas->nik)
            ->update(['status' => $request->status]);

        return redirect()->route('ibu_bersalin_nifas.index')->with('success', 'Data ibu hamil berhasil diperbarui.');
    }

    // Menampilkan form untuk mengedit data lingkungan rumah
    public function edit2($id)
    {
        $ibuhamilNifas = Ibu_Bersalin_Nifas::findOrFail($id);
        return view('ibu_bersalin_nifas.editdetail', compact('ibuhamilNifas'));
    }

    // Menyimpan perubahan pada data lingkungan rumah ke dalam database
    public function update2(Request $request, $id)
    {
        // Validasi dasar
        $request->validate([
            'kk' => 'required|integer|min:0',
            'status' => 'required|string',
        ]);

        // Validasi tambahan berdasarkan status
        if ($request->status === 'Ya' || $request->status === 'Selesai') {
            $request->validate([
                'nik' => 'required|integer|min:0',
                'nama' => 'required|string',
                'umur_ibu' => 'required|integer',
                'kelahiran_ke' => 'required|integer',
                'tgl_persalinan' => 'required|date',
                'pukul_persalinan' => 'required|date_format:H:i',
                'usia_kehamilan_persalinan' => 'required|integer',
                'penolong_persalinan' => 'required|string',
                'lainya_penolong_persalinan' => 'nullable|string',
                'tmpt_persalinan' => 'required|string',
                'nama_tmpt_persalinan' => 'required|string',
                'cara_persalinan' => 'required|string',
                'lainya_cara_persalinan' => 'nullable|string',
                'keadaan_ibu_persalinan' => 'required|string',
                'riwayat_imd_persalinan' => 'required|string',
                'kunjungan' => 'required|integer',
                'tgl_kunjungan' => 'required|date',
                'suhu_tubuh' => 'required|string',
                'buku_ka' => 'required|string',
                'pemeriksaan_kesehatan' => 'required|string',
                'tgl_pk' => 'required|date',
                'tempat_pk' => 'required|string',
                'petugas_pk' => 'required|string',
                'porsi' => 'required|string',
                'ada_kva' => 'required|string',
                'wkt_minum_kva' => 'required|date',
                'menyusui' => 'required|string',
                'kb_pasca_persalinan' => 'required|string',
                'skrining_kesehatan' => 'required|date',
                'skrining_kesehatan_tmp' => 'required|string',
                'skrining_kesehatan_petugas' => 'required|string',
                'edukasi_kunjungan' => 'required|date',
                'demam' => 'required|string',
                'perasaan' => 'required|string',
                'sakit' => 'required|string',
                'pernafasan' => 'required|string',
                'payudara' => 'required|string',
                'sakit_kepala' => 'required|string',
                'pendarahan' => 'required|string',
                'sakit_bagian_kelamin' => 'required|string',
                'keluar_cairan' => 'required|string',
                'pandangan_kabur' => 'required|string',
                'darah_nifas' => 'required|string',
                'keputihan' => 'required|string',
                'jantung_berdebar' => 'required|string',
                'pengingat_periksa_postu' => 'required|string',
                'tgl_laporan_nakes' => 'required|date',
            ]);
        } else {
            // Kosongkan semua field jika status tidak sesuai
            $request->merge([
                'nik' => null,
                'nama' => null,
                'umur_ibu' => null,
                'kelahiran_ke' => null,
                'tgl_persalinan' => null,
                'pukul_persalinan' => null,
                'usia_kehamilan_persalinan' => null,
                'penolong_persalinan' => null,
                'lainya_penolong_persalinan' => null,
                'tmpt_persalinan' => null,
                'nama_tmpt_persalinan' => null,
                'cara_persalinan' => null,
                'lainya_cara_persalinan' => null,
                'keadaan_ibu_persalinan' => null,
                'riwayat_imd_persalinan' => null,
                'kunjungan' => null,
                'tgl_kunjungan' => null,
                'suhu_tubuh' => null,
                'buku_ka' => null,
                'pemeriksaan_kesehatan' => null,
                'tgl_pk' => null,
                'tempat_pk' => null,
                'petugas_pk' => null,
                'porsi' => null,
                'ada_kva' => null,
                'wkt_minum_kva' => null,
                'menyusui' => null,
                'kb_pasca_persalinan' => null,
                'skrining_kesehatan' => null,
                'skrining_kesehatan_tmp' => null,
                'skrining_kesehatan_petugas' => null,
                'edukasi_kunjungan' => null,
                'demam' => null,
                'perasaan' => null,
                'sakit' => null,
                'pernafasan' => null,
                'payudara' => null,
                'sakit_kepala' => null,
                'pendarahan' => null,
                'sakit_bagian_kelamin' => null,
                'keluar_cairan' => null,
                'pandangan_kabur' => null,
                'darah_nifas' => null,
                'keputihan' => null,
                'jantung_berdebar' => null,
                'pengingat_periksa_postu' => null,
                'tgl_laporan_nakes' => null,
            ]);
        }

        // Format pukul_persalinan
        if ($request->pukul_persalinan) {
            $request['pukul_persalinan'] = date('H:i', strtotime($request->pukul_persalinan));
        }

        // Update record Ibu_Bersalin_Nifas spesifik
        $ibuhamilNifas = Ibu_Bersalin_Nifas::findOrFail($id);
        $ibuhamilNifas->update($request->all());

        // Simpan session
        session(['kk' => $request->kk, 'nama' => $request->nama, 'nik' => $request->nik]);

        return redirect()->route('ibu_bersalin_nifas.show', $ibuhamilNifas->id)->with('success', 'Data ibu hamil berhasil diperbarui.');
    }

    // ==============================================


    public function createvalidate()
    {
        return view('ibu_bersalin_nifas.createvalidate');
    }

    // Menyimpan data ibu hamil baru ke dalam database
    public function storevalidate(Request $request)
    {
        $validatedData = $request->validate([
            'status' => 'required|string',
        ]);

        if ($request->status === 'Ya') {
            $additionalValidation = $request->validate([
                'kk' => 'required|integer|min:0',
                'nik' => 'required|integer|min:0',
                'nama' => 'required|string',
                'umur_ibu' => 'integer|required',
                'kelahiran_ke' => 'integer|required',
                'tgl_persalinan' => 'date|required',
                'pukul_persalinan' => 'date_format:H:i|required',
                'usia_kehamilan_persalinan' => 'integer|required',
                'penolong_persalinan' => 'string|required',
                'lainya_penolong_persalinan' => 'string|nullable',
                'tmpt_persalinan' => 'string|required',
                'nama_tmpt_persalinan' => 'string|required',
                'cara_persalinan' => 'string|required',
                'lainya_cara_persalinan' => 'string|nullable',
                'keadaan_ibu_persalinan' => 'string|required',
                'riwayat_imd_persalinan' => 'string|required',
                'kunjungan' => 'integer|required',
                'tgl_kunjungan' => 'date|required',
                'suhu_tubuh' => 'string|required',
                'buku_ka' => 'string|required',
                'pemeriksaan_kesehatan' => 'string|required',
                'tgl_pk' => 'date|required',
                'tempat_pk' => 'string|required',
                'petugas_pk' => 'string|required',
                'porsi' => 'string|required',
                'ada_kva' => 'string|required',
                'wkt_minum_kva' => 'date|required',
                'menyusui' => 'string|required',
                'kb_pasca_persalinan' => 'string|required',
                'skrining_kesehatan' => 'date|required',
                'skrining_kesehatan_tmp' => 'string|required',
                'skrining_kesehatan_petugas' => 'string|required',
                'edukasi_kunjungan' => 'date|required',
                'demam' => 'string|required',
                'perasaan' => 'string|required',
                'sakit' => 'string|required',
                'pernafasan' => 'string|required',
                'payudara' => 'string|required',
                'sakit_kepala' => 'string|required',
                'pendarahan' => 'string|required',
                'sakit_bagian_kelamin' => 'string|required',
                'keluar_cairan' => 'string|required',
                'pandangan_kabur' => 'string|required',
                'darah_nifas' => 'string|required',
                'keputihan' => 'string|required',
                'jantung_berdebar' => 'string|required',
                'pengingat_periksa_postu' => 'string|required',
                'tgl_laporan_nakes' => 'date|required',
            ]);
            $validatedData = array_merge($validatedData, $additionalValidation);
        } else {
            // Set all fields to '-' if status is 'Tidak'
            $request->merge([
                'nik' => null,
                'kk' => null,
                'nama' => null,
                'umur_ibu' => null,
                'kelahiran_ke' => null,
                'tgl_persalinan' => null,
                'pukul_persalinan' => null,
                'usia_kehamilan_persalinan' => null,
                'penolong_persalinan' => null,
                'lainya_penolong_persalinan' => null,
                'tmpt_persalinan' => null,
                'nama_tmpt_persalinan' => null,
                'cara_persalinan' => null,
                'lainya_cara_persalinan' => null,
                'keadaan_ibu_persalinan' => null,
                'riwayat_imd_persalinan' => null,
                'kunjungan' => null,
                'tgl_kunjungan' => null,
                'suhu_tubuh' => null,
                'buku_ka' => null,
                'pemeriksaan_kesehatan' => null,
                'tgl_pk' => null,
                'tempat_pk' => null,
                'petugas_pk' => null,
                'porsi' => null,
                'ada_kva' => null,
                'wkt_minum_kva' => null,
                'menyusui' => null,
                'kb_pasca_persalinan' => null,
                'skrining_kesehatan' => null,
                'skrining_kesehatan_tmp' => null,
                'skrining_kesehatan_petugas' => null,
                'edukasi_kunjungan' => null,
                'demam' => null,
                'perasaan' => null,
                'sakit' => null,
                'pernafasan' => null,
                'payudara' => null,
                'sakit_kepala' => null,
                'pendarahan' => null,
                'sakit_bagian_kelamin' => null,
                'keluar_cairan' => null,
                'pandangan_kabur' => null,
                'darah_nifas' => null,
                'keputihan' => null,
                'jantung_berdebar' => null,
                'pengingat_periksa_postu' => null,
                'tgl_laporan_nakes' => null,
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

        Ibu_Bersalin_Nifas::create($validatedData);

        session(['nik' => $request->nik]);
        return redirect()->route('ibu_bersalin_nifas.index')->with('success', 'Data ibu hamil berhasil ditambahkan.');
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
        $ibuhamilNifas = Ibu_Bersalin_Nifas::findOrFail($id);

        // Hapus data lingkungan rumah
        $ibuhamilNifas->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('ibu_bersalin_nifas.index')->with('success', 'Data ibu bersalin nifas berhasil dihapus.');
    }
    public function destroy2($id)
    {
        // Temukan data ibu hamil yang akan dihapus
        $ibuhamilNifas = Ibu_Bersalin_Nifas::findOrFail($id);

        // Simpan KK sebelum menghapus data
        $kk = $ibuhamilNifas->kk;

        // Hapus data ibu hamil
        $ibuhamilNifas->delete();

        // Temukan ID data KK lain yang tersisa (jika ada)
        $otheribuhamilNifas = Ibu_Bersalin_Nifas::where('kk', $kk)->first();

        // Redirect ke halaman detail dengan menggunakan ID KK yang tersisa (jika ada), jika tidak kembali ke index
        if ($otheribuhamilNifas) {
            return redirect()->route('ibu_bersalin_nifas.show', ['id' => $otheribuhamilNifas->id])->with('success', 'Data ibu bersalin nifas berhasil dihapus.');
        } else {
            return redirect()->route('ibu_bersalin_nifas.index')->with('success', 'Data ibu bersalin nifas berhasil dihapus.');
        }
    }
    public function ibubersalinNifasPDF($id)
    {
        // Mengambil data kunjungan TBC berdasarkan ID
        $dataKK = Ibu_Bersalin_Nifas::findOrFail($id);

        // Mengambil anggota keluarga yang terkait dengan KK yang sama
        $ibubersalinNifas = Ibu_Bersalin_Nifas::where('kk', $dataKK->kk)->get();

        // Memuat view dan mengirimkan data yang diambil
        $pdf = Pdf::loadView('ibu_bersalin_nifas.pdf', ['ibubersalinNifas' => $ibubersalinNifas])
            ->setPaper('a4', 'landscape');

        // Mengirimkan file PDF yang dihasilkan
        return $pdf->stream('3. Checklist Kunjungan Rumah - Ibu Bersalin Nifas.pdf');
    }
    public function ibubersalinNifasPDF2($id)
    {
        try {
            // Mengambil data kunjungan TBC berdasarkan ID
            $ibubersalinNifas = Ibu_Bersalin_Nifas::findOrFail($id);

            // Memuat view dan mengirimkan data yang diambil
            $pdf = Pdf::loadView('ibu_bersalin_nifas.pdf2', ['ibubersalinNifas' => $ibubersalinNifas])
                ->setPaper('a4', 'landscape');
            // Mengirimkan file PDF yang dihasilkan
            return $pdf->stream('3. Checklist Kunjungan Rumah - Ibu Bersalin Nifas.pdf');
        } catch (\Exception $e) {
            // Menangani error jika data tidak ditemukan atau terjadi kesalahan lain
            return redirect()->back()->withErrors(['msg' => 'Data kunjungan TBC tidak ditemukan atau terjadi kesalahan.']);
        }
    }
}
