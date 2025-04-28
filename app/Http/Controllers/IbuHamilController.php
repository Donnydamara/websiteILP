<?php

namespace App\Http\Controllers;

use App\Models\Ibu_Hamil;
use App\Models\DataKK;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\IbuHamilExport;

class IbuHamilController extends Controller
{
    // Menampilkan daftar data lingkungan rumah
    public function index(Request $request)
    {
        $userId = Auth::id();
        $userRole = Auth::user()->role; // Dapatkan peran dari user yang sedang login

        // Dapatkan nilai status dari query parameter atau gunakan "ya" sebagai default
        $status = $request->input('status', 'ya');
        $export = $request->input('export', false); // Check apakah ini request untuk ekspor

        // Mengambil data berdasarkan status dan role user
        if ($userRole === 'admin') {
            if ($status === 'semua') {
                $ibuHamils = Ibu_Hamil::orderBy('created_at', 'desc');
            } else {
                $ibuHamils = Ibu_Hamil::where('status', $status)
                    ->orderBy('created_at', 'desc');
            }
        } else {
            if ($status === 'semua') {
                $ibuHamils = Ibu_Hamil::where('id_user', $userId)
                    ->orderBy('created_at', 'desc');
            } else {
                $ibuHamils = Ibu_Hamil::where('id_user', $userId)
                    ->where('status', $status)
                    ->orderBy('created_at', 'desc');
            }
        }

        // Jika ini adalah request untuk ekspor Excel, kembalikan file Excel
        if ($export) {
            return Excel::download(new IbuHamilExport($ibuHamils->get()), 'ibu_hamil.xlsx');
        }

        // Jika bukan untuk ekspor, lakukan paginasi dan filtering
        $ibuHamils = $ibuHamils->paginate(10);

        // Filter untuk mendapatkan hanya data terbaru berdasarkan NIK
        $filteredIbuHamils = $ibuHamils->unique('nik');

        // Pass the filtered data and the selected status to the view
        return view('ibu_hamil.list', ['ibuHamils' => $filteredIbuHamils, 'status' => $status]);
    }


    public function show($id, Request $request)
    {
        // Retrieve data Ibu Hamil by ID
        $dataKK = Ibu_Hamil::findOrFail($id);

        // Get family members related by KK
        $familyMembers = Ibu_Hamil::where('nik', $dataKK->nik)->get();

        // Check if this is an export request
        if ($request->input('export', false)) {
            // Export the data to Excel
            return Excel::download(new IbuHamilExport($familyMembers), 'ibu_hamil_family_members.xlsx');
        }

        // Pass data to the view
        return view('ibu_hamil.detail', compact('dataKK', 'familyMembers'));
    }



    // Menampilkan form untuk menambahkan data lingkungan rumah baru
    public function create(Request $request)
    {
        $kk = $request->session()->get('kk');
        $nama = $request->session()->get('nama');
        return view('ibu_hamil.create', compact('kk', 'nama'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kk' => 'required',
            'status' => 'required|string',
        ]);

        if ($request->status === 'Ya') {
            $request->validate([
                'nik' => 'required',
                'nama' => 'required',
                'kehamilan_ke' => 'required|integer|min:0',
                'jarak_kehamilan_unit' => 'required|in:bulan,tahun',
                'jarak_kehamilan_bulan' => 'nullable|required_if:jarak_kehamilan_unit,bulan|integer|min:0',
                'jarak_kehamilan_tahun' => 'nullable|required_if:jarak_kehamilan_unit,tahun|integer|min:0',
                'umur' => 'required|integer|min:0',
                'kunjungan' => 'required|integer|min:0',
                'tgl_kunjungan' => 'required|date',
                'suhu_tubuh' => 'required',
                'kia' => 'required',
                'jenis_imk' => 'required',
                'tgl_imk' => 'required|date',
                'tempat_imk' => 'required',
                'petugas_imk' => 'required',
                'porsi' => 'required',
                'ada_ttd' => 'required',
                'minum_ttd' => 'required',
                'lila' => 'required',
                'pmt' => 'required',
                'kls_ibu_hamil' => 'required|date',
                'tempat_ibu_hamil' => 'required',
                'pendamping_ibu_hamil' => 'required',
                'kls_skrining_kesehatan' => 'required|date',
                'tempat_skrining_kesehatan' => 'required',
                'petugas_skrining_kesehatan' => 'required',
                'edukasi' => 'required',
                'demam_l2' => 'required',
                'sakit_kepala_l2' => 'required',
                'sulit_tidur_l2' => 'required',
                'diare_l2' => 'required',
                'tbc_l2' => 'required',
                'gerakan_janin_l2' => 'required',
                'jantung_sakit_l2' => 'required',
                'keluar_cairan_l2' => 'required',
                'kencing_manis_l2' => 'required',
                'nyeri_perut_l2' => 'required',
                'periksa_l2' => 'required',
                'lapor_nakes' => 'required',
            ]);
        } else {
            // Set all fields to '-' if status is 'Tidak'
            $request->merge([
                'nik' => null,
                'nama' => null,
                'kehamilan_ke' => null,
                // 'jarak_kehamilan' => null,
                'jarak_kehamilan_unit',
                'jarak_kehamilan_bulan',
                'jarak_kehamilan_tahun',
                'umur' => null,
                'kunjungan' => null,
                'tgl_kunjungan' => null,
                'suhu_tubuh' => null,
                'kia' => null,
                'jenis_imk' => null,
                'tgl_imk' => null,
                'tempat_imk' => null,
                'petugas_imk' => null,
                'porsi' => null,
                'ada_ttd' => null,
                'minum_ttd' => null,
                'lila' => null,
                'pmt' => null,
                'kls_ibu_hamil' => null,
                'tempat_ibu_hamil' => null,
                'pendamping_ibu_hamil' => null,
                'kls_skrining_kesehatan' => null,
                'tempat_skrining_kesehatan' => null,
                'petugas_skrining_kesehatan' => null,
                'edukasi' => null,
                'demam_l2' => null,
                'sakit_kepala_l2' => null,
                'sulit_tidur_l2' => null,
                'diare_l2' => null,
                'tbc_l2' => null,
                'gerakan_janin_l2' => null,
                'jantung_sakit_l2' => null,
                'keluar_cairan_l2' => null,
                'kencing_manis_l2' => null,
                'nyeri_perut_l2' => null,
                'periksa_l2' => null,
                'lapor_nakes' => null,
            ]);
            $validatedData['id_user'] = Auth::id();


            // Gabungkan input jarak kehamilan berdasarkan pilihan pengguna
            $jarakKehamilan = $request->jarak_kehamilan_unit === 'bulan'
                ? $request->jarak_kehamilan_bulan . ' bulan'
                : $request->jarak_kehamilan_tahun . ' tahun';

            $request->merge(['jarak_kehamilan' => $jarakKehamilan]);
        }

        // Ibu_Hamil::create($request->all());
        $ibuHamil = Ibu_Hamil::create($request->all());

        session(['kk' => $request->kk, 'nama' => $request->nama]);

        return redirect()->route('ibu_bersalin_nifas.create')->with('success', 'Data ibu hamil berhasil ditambahkan.');
    }

    // Menampilkan form untuk menambahkan data lingkungan rumah baru
    public function create2(Request $request, $id = null)
    {
        if ($id) {
            $ibuHamil = Ibu_Hamil::find($id);
            $kk = $ibuHamil ? $ibuHamil->kk : null;
            $nama = $ibuHamil ? $ibuHamil->nama : null;
            $nik = $ibuHamil ? $ibuHamil->nik : null;
        } else {
            $kk = $request->session()->get('kk');
            $nama = $request->session()->get('nama');
            $nik = $request->session()->get('nik');

            if (!$kk) {
                $ibuHamil = Ibu_Hamil::orderBy('created_at', 'desc')->first();
                $kk = $ibuHamil ? $ibuHamil->kk : null;
                $nama = $ibuHamil ? $ibuHamil->nama : null;
                $nik = $ibuHamil ? $ibuHamil->nik : null;
            }
        }

        return view('ibu_hamil.createdetail', compact('kk', 'nama', 'nik'));
    }

    // Menyimpan data lingkungan rumah baru ke dalam database
    public function store2(Request $request)
    {
        // Validasi input dari formulir
        $validatedData = $request->validate([
            'kk' => 'required',
            'status' => 'required|string',
        ]);

        if ($request->status === 'Ya') {
            $additionalValidation = $request->validate([
                'nik' => 'required',
                'nama' => 'required',
                'kehamilan_ke' => 'required|integer|min:0',
                'jarak_kehamilan_unit' => 'required|in:bulan,tahun',
                'jarak_kehamilan_bulan' => 'nullable|required_if:jarak_kehamilan_unit,bulan|integer|min:0',
                'jarak_kehamilan_tahun' => 'nullable|required_if:jarak_kehamilan_unit,tahun|integer|min:0',
                'umur' => 'required|integer|min:0',
                'kunjungan' => 'required|integer|min:0',
                'tgl_kunjungan' => 'required|date',
                'suhu_tubuh' => 'required',
                'kia' => 'required',
                'jenis_imk' => 'required',
                'tgl_imk' => 'required|date',
                'tempat_imk' => 'required',
                'petugas_imk' => 'required',
                'porsi' => 'required',
                'ada_ttd' => 'required',
                'minum_ttd' => 'required',
                'lila' => 'required',
                'pmt' => 'required',
                'kls_ibu_hamil' => 'required|date',
                'tempat_ibu_hamil' => 'required',
                'pendamping_ibu_hamil' => 'required',
                'kls_skrining_kesehatan' => 'required|date',
                'tempat_skrining_kesehatan' => 'required',
                'petugas_skrining_kesehatan' => 'required',
                'edukasi' => 'required',
                'demam_l2' => 'required',
                'sakit_kepala_l2' => 'required',
                'sulit_tidur_l2' => 'required',
                'diare_l2' => 'required',
                'tbc_l2' => 'required',
                'gerakan_janin_l2' => 'required',
                'jantung_sakit_l2' => 'required',
                'keluar_cairan_l2' => 'required',
                'kencing_manis_l2' => 'required',
                'nyeri_perut_l2' => 'required',
                'periksa_l2' => 'required',
                'lapor_nakes' => 'required',
            ]);

            $validatedData = array_merge($validatedData, $additionalValidation);

            // Calculate jarak_kehamilan based on user input
            $jarakKehamilan = $request->jarak_kehamilan_unit === 'bulan'
                ? $request->jarak_kehamilan_bulan . ' bulan'
                : $request->jarak_kehamilan_tahun . ' tahun';

            $validatedData['jarak_kehamilan'] = $jarakKehamilan;
        } else {
            // Set all fields to null if status is 'Tidak'
            $validatedData = array_merge($validatedData, [
                'nik' => null,
                'nama' => null,
                'kehamilan_ke' => null,
                'jarak_kehamilan' => null,
                'umur' => null,
                'kunjungan' => null,
                'tgl_kunjungan' => null,
                'suhu_tubuh' => null,
                'kia' => null,
                'jenis_imk' => null,
                'tgl_imk' => null,
                'tempat_imk' => null,
                'petugas_imk' => null,
                'porsi' => null,
                'ada_ttd' => null,
                'minum_ttd' => null,
                'lila' => null,
                'pmt' => null,
                'kls_ibu_hamil' => null,
                'tempat_ibu_hamil' => null,
                'pendamping_ibu_hamil' => null,
                'kls_skrining_kesehatan' => null,
                'tempat_skrining_kesehatan' => null,
                'petugas_skrining_kesehatan' => null,
                'edukasi' => null,
                'demam_l2' => null,
                'sakit_kepala_l2' => null,
                'sulit_tidur_l2' => null,
                'diare_l2' => null,
                'tbc_l2' => null,
                'gerakan_janin_l2' => null,
                'jantung_sakit_l2' => null,
                'keluar_cairan_l2' => null,
                'kencing_manis_l2' => null,
                'nyeri_perut_l2' => null,
                'periksa_l2' => null,
                'lapor_nakes' => null,
            ]);
        }

        // Automatically assign the user ID
        $validatedData['id_user'] = Auth::id();

        $ibuHamil = Ibu_Hamil::create($validatedData);

        // Store selected fields in session
        session(['kk' => $request->kk, 'nama' => $request->nama, 'nik' => $request->nik]);

        return redirect()->route('ibu_hamil.show', $ibuHamil->id)->with('success', 'Data ibu hamil berhasil ditambahkan.');
    }


    // Menampilkan form untuk mengedit data lingkungan rumah
    public function edit($id)
    {
        $ibu_hamil = Ibu_Hamil::findOrFail($id);
        return view('ibu_hamil.edit', compact('ibu_hamil'));
    }


    public function update(Request $request, $id)
    {
        // Validasi dasar
        $request->validate([
            'kk' => 'required',
            'status' => 'required|string',
        ]);

        // Validasi tambahan berdasarkan status
        if ($request->status === 'Ya' || $request->status === 'Selesai') {
            $request->validate([
                'nik' => 'required',
                'nama' => 'required',
                'kehamilan_ke' => 'required|integer',
                'jarak_kehamilan' => 'nullable|integer',
                'umur' => 'required|integer',
                'kunjungan' => 'required|string',
                'tgl_kunjungan' => 'required|date',
                'suhu_tubuh' => 'required',
                'kia' => 'required',
                'jenis_imk' => 'required',
                'tgl_imk' => 'required|date',
                'tempat_imk' => 'required',
                'petugas_imk' => 'required',
                'porsi' => 'required',
                'ada_ttd' => 'required',
                'minum_ttd' => 'required',
                'lila' => 'required',
                'pmt' => 'required',
                'kls_ibu_hamil' => 'required|date',
                'tempat_ibu_hamil' => 'required',
                'pendamping_ibu_hamil' => 'required',
                'kls_skrining_kesehatan' => 'required|date',
                'tempat_skrining_kesehatan' => 'required',
                'petugas_skrining_kesehatan' => 'required',
                'edukasi' => 'required',
                'demam_l2' => 'required',
                'sakit_kepala_l2' => 'required',
                'sulit_tidur_l2' => 'required',
                'diare_l2' => 'required',
                'tbc_l2' => 'required',
                'gerakan_janin_l2' => 'required',
                'jantung_sakit_l2' => 'required',
                'keluar_cairan_l2' => 'required',
                'kencing_manis_l2' => 'required',
                'nyeri_perut_l2' => 'required',
                'periksa_l2' => 'required',
                'lapor_nakes' => 'required',
            ]);
        } else {
            // Kosongkan semua field jika status adalah 'Tidak'
            $request->merge([
                'nik' => null,
                'nama' => null,
                'kehamilan_ke' => null,
                'jarak_kehamilan' => null,
                'umur' => null,
                'kunjungan' => null,
                'tgl_kunjungan' => null,
                'suhu_tubuh' => null,
                'kia' => null,
                'jenis_imk' => null,
                'tgl_imk' => null,
                'tempat_imk' => null,
                'petugas_imk' => null,
                'porsi' => null,
                'ada_ttd' => null,
                'minum_ttd' => null,
                'lila' => null,
                'pmt' => null,
                'kls_ibu_hamil' => null,
                'tempat_ibu_hamil' => null,
                'pendamping_ibu_hamil' => null,
                'kls_skrining_kesehatan' => null,
                'tempat_skrining_kesehatan' => null,
                'petugas_skrining_kesehatan' => null,
                'edukasi' => null,
                'demam_l2' => null,
                'sakit_kepala_l2' => null,
                'sulit_tidur_l2' => null,
                'diare_l2' => null,
                'tbc_l2' => null,
                'gerakan_janin_l2' => null,
                'jantung_sakit_l2' => null,
                'keluar_cairan_l2' => null,
                'kencing_manis_l2' => null,
                'nyeri_perut_l2' => null,
                'periksa_l2' => null,
                'lapor_nakes' => null,
            ]);
        }

        // Update record Ibu_Hamil spesifik
        $ibu_hamil = Ibu_Hamil::findOrFail($id);
        $ibu_hamil->update($request->all());

        // Update semua record dengan NIK yang sama
        Ibu_Hamil::where('nik', $ibu_hamil->nik)
            ->update(['status' => $request->status]);

        return redirect()->route('ibu_hamil.index')->with('success', 'Data ibu hamil berhasil diperbarui.');
    }


    // Menampilkan form untuk mengedit data lingkungan rumah
    public function edit2($id)
    {
        $ibu_hamil = Ibu_Hamil::findOrFail($id);
        return view('ibu_hamil.editdetail', compact('ibu_hamil'));
    }

    // Menyimpan perubahan pada data lingkungan rumah ke dalam database
    public function update2(Request $request, $id)
    {
        // Validasi dasar
        $request->validate([
            'kk' => 'required',
            'status' => 'required|string',
        ]);

        // Validasi tambahan berdasarkan status
        if ($request->status === 'Ya' || $request->status === 'Selesai') {
            $request->validate([
                'nik' => 'required',
                'nama' => 'required',
                'kehamilan_ke' => 'required|integer',
                'jarak_kehamilan' => 'nullable|integer',
                'umur' => 'required|integer',
                'kunjungan' => 'required|string',
                'tgl_kunjungan' => 'required|date',
                'suhu_tubuh' => 'required',
                'kia' => 'required',
                'jenis_imk' => 'required',
                'tgl_imk' => 'required|date',
                'tempat_imk' => 'required',
                'petugas_imk' => 'required',
                'porsi' => 'required',
                'ada_ttd' => 'required',
                'minum_ttd' => 'required',
                'lila' => 'required',
                'pmt' => 'required',
                'kls_ibu_hamil' => 'required|date',
                'tempat_ibu_hamil' => 'required',
                'pendamping_ibu_hamil' => 'required',
                'kls_skrining_kesehatan' => 'required|date',
                'tempat_skrining_kesehatan' => 'required',
                'petugas_skrining_kesehatan' => 'required',
                'edukasi' => 'required',
                'demam_l2' => 'required',
                'sakit_kepala_l2' => 'required',
                'sulit_tidur_l2' => 'required',
                'diare_l2' => 'required',
                'tbc_l2' => 'required',
                'gerakan_janin_l2' => 'required',
                'jantung_sakit_l2' => 'required',
                'keluar_cairan_l2' => 'required',
                'kencing_manis_l2' => 'required',
                'nyeri_perut_l2' => 'required',
                'periksa_l2' => 'required',
                'lapor_nakes' => 'required',
            ]);
        } else {
            // Kosongkan semua field jika status adalah 'Tidak'
            $request->merge([
                'nik' => null,
                'nama' => null,
                'kehamilan_ke' => null,
                'jarak_kehamilan' => null,
                'umur' => null,
                'kunjungan' => null,
                'tgl_kunjungan' => null,
                'suhu_tubuh' => null,
                'kia' => null,
                'jenis_imk' => null,
                'tgl_imk' => null,
                'tempat_imk' => null,
                'petugas_imk' => null,
                'porsi' => null,
                'ada_ttd' => null,
                'minum_ttd' => null,
                'lila' => null,
                'pmt' => null,
                'kls_ibu_hamil' => null,
                'tempat_ibu_hamil' => null,
                'pendamping_ibu_hamil' => null,
                'kls_skrining_kesehatan' => null,
                'tempat_skrining_kesehatan' => null,
                'petugas_skrining_kesehatan' => null,
                'edukasi' => null,
                'demam_l2' => null,
                'sakit_kepala_l2' => null,
                'sulit_tidur_l2' => null,
                'diare_l2' => null,
                'tbc_l2' => null,
                'gerakan_janin_l2' => null,
                'jantung_sakit_l2' => null,
                'keluar_cairan_l2' => null,
                'kencing_manis_l2' => null,
                'nyeri_perut_l2' => null,
                'periksa_l2' => null,
                'lapor_nakes' => null,
            ]);
        }

        // Update record Ibu_Hamil spesifik
        $ibu_hamil = Ibu_Hamil::findOrFail($id);
        $ibu_hamil->update($request->all());

        // Update semua record dengan NIK yang sama
        Ibu_Hamil::where('nik', $ibu_hamil->nik)
            ->update(['status' => $request->status]);

        return redirect()->route('ibu_hamil.show', $ibu_hamil->id)
            ->with('success', 'Data ibu hamil berhasil ditambahkan.');
    }

    // ==============================================


    // public function createvalidate()
    // {
    //     return view('ibu_hamil.createvalidate');
    // }
    public function createvalidate()
    {
        // Logika untuk createvalidate
        return view('ibu_hamil.createvalidate');
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
                'nik' => 'required',
                'nama' => 'required',
                'kehamilan_ke' => 'required|integer',
                'jarak_kehamilan_unit' => 'required|string',
                'jarak_kehamilan_bulan' => 'nullable|integer|required_if:jarak_kehamilan_unit,bulan',
                'jarak_kehamilan_tahun' => 'nullable|integer|required_if:jarak_kehamilan_unit,tahun',
                'umur' => 'required|integer',
                'kunjungan' => 'required|string',
                'tgl_kunjungan' => 'required|date',
                'suhu_tubuh' => 'required',
                'kia' => 'required',
                'jenis_imk' => 'required',
                'tgl_imk' => 'required|date',
                'tempat_imk' => 'required',
                'petugas_imk' => 'required',
                'porsi' => 'required',
                'ada_ttd' => 'required',
                'minum_ttd' => 'required',
                'lila' => 'required',
                'pmt' => 'required',
                'kls_ibu_hamil' => 'required|date',
                'tempat_ibu_hamil' => 'required',
                'pendamping_ibu_hamil' => 'required',
                'kls_skrining_kesehatan' => 'required|date',
                'tempat_skrining_kesehatan' => 'required',
                'petugas_skrining_kesehatan' => 'required',
                'edukasi' => 'required',
                'demam_l2' => 'required',
                'sakit_kepala_l2' => 'required',
                'sulit_tidur_l2' => 'required',
                'diare_l2' => 'required',
                'tbc_l2' => 'required',
                'gerakan_janin_l2' => 'required',
                'jantung_sakit_l2' => 'required',
                'keluar_cairan_l2' => 'required',
                'kencing_manis_l2' => 'required',
                'nyeri_perut_l2' => 'required',
                'periksa_l2' => 'required',
                'lapor_nakes' => 'required',
            ]);

            // Merge additional validation with initial validation
            $validatedData = array_merge($validatedData, $additionalValidation);

            // Calculate jarak_kehamilan based on user input
            $jarakKehamilan = $request->jarak_kehamilan_unit === 'bulan'
                ? $request->jarak_kehamilan_bulan . ' bulan'
                : $request->jarak_kehamilan_tahun . ' tahun';

            $validatedData['jarak_kehamilan'] = $jarakKehamilan;
        } else {
            // Default values when status is not 'Ya'
            $validatedData = array_merge($validatedData, [
                'kk' => null,
                'nik' => null,
                'nama' => null,
                'kehamilan_ke' => null,
                'jarak_kehamilan' => null,
                'umur' => null,
                'kunjungan' => null,
                'tgl_kunjungan' => null,
                'suhu_tubuh' => null,
                'kia' => null,
                'jenis_imk' => null,
                'tgl_imk' => null,
                'tempat_imk' => null,
                'petugas_imk' => null,
                'porsi' => null,
                'ada_ttd' => null,
                'minum_ttd' => null,
                'lila' => null,
                'pmt' => null,
                'kls_ibu_hamil' => null,
                'tempat_ibu_hamil' => null,
                'pendamping_ibu_hamil' => null,
                'kls_skrining_kesehatan' => null,
                'tempat_skrining_kesehatan' => null,
                'petugas_skrining_kesehatan' => null,
                'edukasi' => null,
                'demam_l2' => null,
                'sakit_kepala_l2' => null,
                'sulit_tidur_l2' => null,
                'diare_l2' => null,
                'tbc_l2' => null,
                'gerakan_janin_l2' => null,
                'jantung_sakit_l2' => null,
                'keluar_cairan_l2' => null,
                'kencing_manis_l2' => null,
                'nyeri_perut_l2' => null,
                'periksa_l2' => null,
                'lapor_nakes' => null,
            ]);
        }

        // Automatically fill in the user ID
        $validatedData['id_user'] = Auth::id();

        if ($request->status === 'Ya') {
            // Check if the NIK exists in DataKK
            $datakk = DataKK::where('nik', $validatedData['nik'])->first();
            if (!$datakk) {
                return redirect()->back()
                    ->withInput()
                    ->withErrors(['nik' => 'NIK tidak ditemukan di data NIK.']);
            }
        }

        // Save the validated data to Ibu_Hamil model
        Ibu_Hamil::create($validatedData);

        // Store the NIK in session
        session(['nik' => $request->nik]);

        return redirect()->route('ibu_hamil.index')->with('success', 'Data ibu hamil berhasil ditambahkan.');
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
        $ibu_hamil = Ibu_Hamil::findOrFail($id);

        // Hapus data lingkungan rumah
        $ibu_hamil->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('ibu_hamil.index')->with('success', 'Data ibu hamil berhasil dihapus.');
    }
    public function destroy2($id)
    {
        // Temukan data ibu hamil yang akan dihapus
        $ibu_hamil = Ibu_Hamil::findOrFail($id);

        // Simpan KK sebelum menghapus data
        $kk = $ibu_hamil->kk;

        // Hapus data ibu hamil
        $ibu_hamil->delete();

        // Temukan ID data KK lain yang tersisa (jika ada)
        $otherIbuHamil = Ibu_Hamil::where('kk', $kk)->first();

        // Redirect ke halaman detail dengan menggunakan ID KK yang tersisa (jika ada), jika tidak kembali ke index
        if ($otherIbuHamil) {
            return redirect()->route('ibu_hamil.show', ['id' => $otherIbuHamil->id])->with('success', 'Data ibu hamil berhasil dihapus.');
        } else {
            return redirect()->route('ibu_hamil.index')->with('success', 'Data ibu hamil berhasil dihapus.');
        }
    }
    public function ibuHamilPDF($id)
    {
        // Mengambil data kunjungan TBC berdasarkan ID
        $dataKK = Ibu_Hamil::findOrFail($id);

        // Mengambil anggota keluarga yang terkait dengan KK yang sama
        $ibuHamil = Ibu_Hamil::where('nik', $dataKK->nik)->get();

        // Memuat view dan mengirimkan data yang diambil
        $pdf = Pdf::loadView('ibu_hamil.pdf', ['ibuHamil' => $ibuHamil])
            ->setPaper('a4', 'landscape');

        // Mengirimkan file PDF yang dihasilkan
        return $pdf->stream('2. Checklist Kunjungan Rumah - Ibu Hamil.pdf');
    }
    public function ibuHamilPDF2($id)
    {
        try {
            // Mengambil data kunjungan TBC berdasarkan ID
            $ibuHamil = Ibu_Hamil::findOrFail($id);

            // Memuat view dan mengirimkan data yang diambil
            $pdf = Pdf::loadView('ibu_hamil.pdf2', ['ibuHamil' => $ibuHamil])
                ->setPaper('a4', 'landscape');
            // Mengirimkan file PDF yang dihasilkan
            return $pdf->stream('2. Checklist Kunjungan Rumah - Ibu Hamil.pdf');
        } catch (\Exception $e) {
            // Menangani error jika data tidak ditemukan atau terjadi kesalahan lain
            return redirect()->back()->withErrors(['msg' => 'Data Kunjungan Rumah - Ibu Hamil.']);
        }
    }
}
