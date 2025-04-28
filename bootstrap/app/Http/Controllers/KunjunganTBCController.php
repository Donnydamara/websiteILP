<?php

namespace App\Http\Controllers;

use App\Models\Kunjungan_TBC;
use App\Models\DataKK;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\KunjunganTBCExport;

class KunjunganTBCController extends Controller
{


    // public function index(Request $request)
    // {
    //     $userId = Auth::id();
    //     $userRole = Auth::user()->role; // Dapatkan peran dari user yang sedang login

    //     // Dapatkan nilai status dari query parameter atau gunakan "semua" sebagai default
    //     $status = $request->input('status', 'semua');

    //     if ($userRole === 'admin') {
    //         // Admin users see all records with the selected status
    //         if ($status === 'semua') {
    //             // Jika status adalah "semua", ambil semua data tanpa memfilter status
    //             $kunjunganTBCs = Kunjungan_TBC::orderBy('created_at', 'desc')->paginate(10);
    //         } else {
    //             // Filter data berdasarkan status yang dipilih
    //             $kunjunganTBCs = Kunjungan_TBC::where('status', $status)
    //                 ->orderBy('created_at', 'desc')
    //                 ->paginate(10);
    //         }
    //     } else {
    //         // Non-admin users see records filtered by their user ID and the selected status
    //         if ($status === 'semua') {
    //             // Jika status adalah "semua", ambil semua data berdasarkan ID user tanpa memfilter status
    //             $kunjunganTBCs = Kunjungan_TBC::where('id_user', $userId)
    //                 ->orderBy('created_at', 'desc')
    //                 ->paginate(10);
    //         } else {
    //             // Filter data berdasarkan status yang dipilih
    //             $kunjunganTBCs = Kunjungan_TBC::where('id_user', $userId)
    //                 ->where('status', $status)
    //                 ->orderBy('created_at', 'desc')
    //                 ->paginate(10);
    //         }
    //     }
    //     // Filter untuk mendapatkan hanya data terbaru berdasarkan NIK
    //     $filteredkunjunganTBCs = $kunjunganTBCs->unique('nik');
    //     // Pass the filtered data and the selected status to the view
    //     return view('kunjungan_tbc.list', ['kunjunganTBCs' => $filteredkunjunganTBCs, 'status' => $status]);
    //     // Pass the paginated data and the selected status to the view
    //     // return view('kunjungan_tbc.list', ['kunjunganTBCs' => $kunjunganTBCs, 'status' => $status]);
    // }
    public function index(Request $request)
    {
        $userId = Auth::id();
        $userRole = Auth::user()->role; // Dapatkan peran dari user yang sedang login

        // Dapatkan nilai status dari query parameter atau gunakan "semua" sebagai default
        $status = $request->input('status', 'semua');
        $export = $request->input('export', false); // Check apakah ini request untuk ekspor

        // Mengambil data berdasarkan status dan role user
        if ($userRole === 'admin') {
            if ($status === 'semua') {
                $kunjunganTBCs = Kunjungan_TBC::orderBy('created_at', 'desc');
            } else {
                $kunjunganTBCs = Kunjungan_TBC::where('status', $status)
                    ->orderBy('created_at', 'desc');
            }
        } else {
            if ($status === 'semua') {
                $kunjunganTBCs = Kunjungan_TBC::where('id_user', $userId)
                    ->orderBy('created_at', 'desc');
            } else {
                $kunjunganTBCs = Kunjungan_TBC::where('id_user', $userId)
                    ->where('status', $status)
                    ->orderBy('created_at', 'desc');
            }
        }

        // Jika ini adalah request untuk ekspor Excel, kembalikan file Excel
        if ($export) {
            return Excel::download(new KunjunganTBCExport($kunjunganTBCs->get()), 'kunjungan_tbc.xlsx');
        }

        // Jika bukan untuk ekspor, lakukan paginasi dan filtering
        $kunjunganTBCs = $kunjunganTBCs->paginate(10);

        // Filter untuk mendapatkan hanya data terbaru berdasarkan NIK
        $filteredkunjunganTBCs = $kunjunganTBCs->unique('nik');

        // Pass the filtered data and the selected status to the view
        return view('kunjungan_tbc.list', ['kunjunganTBCs' => $filteredkunjunganTBCs, 'status' => $status]);
    }


    public function show($id, Request $request)
    {
        // Retrieve data Kunjungan TBC by ID
        $dataKK = Kunjungan_TBC::findOrFail($id);

        // Get family members related by NIK
        $familyMembers = Kunjungan_TBC::where('nik', $dataKK->nik)->get();

        // Check if the request is for exporting Excel
        if ($request->input('export', false)) {
            return Excel::download(new KunjunganTBCExport($familyMembers), 'kunjungan_tbc_detail.xlsx');
        }

        // Pass data to the view
        return view('kunjungan_tbc.detail', compact('dataKK', 'familyMembers'));
    }


    // public function show($id)
    // {
    //     // Retrieve data Ibu Hamil by ID
    //     $dataKK = Kunjungan_TBC::findOrFail($id);
    //     // Get family members related by KK
    //     $familyMembers = Kunjungan_TBC::where('nik', $dataKK->nik)->get();
    //     // Pass data to the view
    //     return view('kunjungan_tbc.detail', compact('dataKK', 'familyMembers'));
    // }

    // Menampilkan form untuk menambahkan data lingkungan rumah baru
    public function create(Request $request)
    {
        $kk = $request->session()->get('kk');
        $nama = $request->session()->get('nama');
        return view('kunjungan_tbc.create', compact('kk', 'nama'));
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
                'batuk_skrining' => 'required|string',
                'demam_skrining' => 'required|string',
                'bb_skrining' => 'required|string',
                'kontak_erat_keluarga' => 'required|string',
                'kontak_erat_tetangga' => 'required|string',
                'kontak_erat_art' => 'required|string',
                'tgl_diaknosa' => 'required|date',
                'tmp_diaknosa' => 'required|string',
                'tgl_periksa_terakhir' => 'required|date',
                'tmp_periksa_terakhir' => 'required|string',
                'obat_tbc' => 'required|string',
                'minum_obat_tbc' => 'required|string',
                'nama_pmo' => 'required|string',
                'merokok' => 'required|string',
                'edukasi' => 'required|string',
                'periksa_postu_fasyankes' => 'required|string',
                'tgl_lapor' => 'required|date',
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
                'batuk_skrining' => null,
                'demam_skrining' => null,
                'bb_skrining' => null,
                'kontak_erat_keluarga' => null,
                'kontak_erat_tetangga' => null,
                'kontak_erat_art' => null,
                'tgl_diaknosa' => null,
                'tmp_diaknosa' => null,
                'tgl_periksa_terakhir' => null,
                'tmp_periksa_terakhir' => null,
                'obat_tbc' => null,
                'minum_obat_tbc' => null,
                'nama_pmo' => null,
                'merokok' => null,
                'edukasi' => null,
                'periksa_postu_fasyankes' => null,
                'tgl_lapor' => null,
            ]);
        }
        $validatedData['id_user'] = Auth::id();
        Kunjungan_TBC::create($request->all());

        session(['kk' => $request->kk, 'nama' => $request->nama]);

        return redirect()->route('jadwal.index')->with('success', 'Data ibu hamil berhasil ditambahkan.');
    }

    public function create2(Request $request, $id = null)
    {
        if ($id) {
            $kunjunganTBC = Kunjungan_TBC::find($id);
            $kk = $kunjunganTBC ? $kunjunganTBC->kk : null;
            $nama = $kunjunganTBC ? $kunjunganTBC->nama : null;
            $nik = $kunjunganTBC ? $kunjunganTBC->nik : null;
        } else {
            $kk = $request->session()->get('kk');
            $nama = $request->session()->get('nama');
            $nik = $request->session()->get('nik');

            if (!$kk) {
                $kunjunganTBC = Kunjungan_TBC::orderBy('created_at', 'desc')->first();
                $kk = $kunjunganTBC ? $kunjunganTBC->kk : null;
                $nama = $kunjunganTBC ? $kunjunganTBC->nama : null;
                $nik = $kunjunganTBC ? $kunjunganTBC->nik : null;
            }
        }

        return view('kunjungan_tbc.createdetail', compact('kk', 'nama', 'nik'));
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
                'batuk_skrining' => 'required|string',
                'demam_skrining' => 'required|string',
                'bb_skrining' => 'required|string',
                'kontak_erat_keluarga' => 'required|string',
                'kontak_erat_tetangga' => 'required|string',
                'kontak_erat_art' => 'required|string',
                'tgl_diaknosa' => 'required|date',
                'tmp_diaknosa' => 'required|string',
                'tgl_periksa_terakhir' => 'required|date',
                'tmp_periksa_terakhir' => 'required|string',
                'obat_tbc' => 'required|string',
                'minum_obat_tbc' => 'required|string',
                'nama_pmo' => 'required|string',
                'merokok' => 'required|string',
                'edukasi' => 'required|string',
                'periksa_postu_fasyankes' => 'required|string',
                'tgl_lapor' => 'required|date',
            ]);
            $validatedData = array_merge($validatedData, $additionalData);
        } else {
            // Kosongkan nilai jika status bukan 'Ya'
            $validatedData = array_merge($validatedData, [
                // 'nik' => null,
                // 'nama' => null,
                'tgl_lahir' => null,
                'tmp_lahir' => null,
                'gender' => null,
                'kunjungan' => null,
                'tgl_kunjungan' => null,
                'batuk_skrining' => null,
                'demam_skrining' => null,
                'bb_skrining' => null,
                'kontak_erat_keluarga' => null,
                'kontak_erat_tetangga' => null,
                'kontak_erat_art' => null,
                'tgl_diaknosa' => null,
                'tmp_diaknosa' => null,
                'tgl_periksa_terakhir' => null,
                'tmp_periksa_terakhir' => null,
                'obat_tbc' => null,
                'minum_obat_tbc' => null,
                'nama_pmo' => null,
                'merokok' => null,
                'edukasi' => null,
                'periksa_postu_fasyankes' => null,
                'tgl_lapor' => null,
            ]);
        }
        $validatedData['id_user'] = Auth::id();

        $kunjunganTBC = Kunjungan_TBC::create($validatedData);

        session(['kk' => $request->kk, 'nama' => $request->nama, 'nik' => $request->nik]);

        return redirect()->route('kunjungan_tbc.show', $kunjunganTBC->id)->with('success', 'Data ibu hamil berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit data lingkungan rumah
    public function edit($id)
    {
        $kunjunganTBC = Kunjungan_TBC::findOrFail($id);
        return view('kunjungan_tbc.edit', compact('kunjunganTBC'));
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
                'batuk_skrining' => 'required|string',
                'demam_skrining' => 'required|string',
                'bb_skrining' => 'required|string',
                'kontak_erat_keluarga' => 'required|string',
                'kontak_erat_tetangga' => 'required|string',
                'kontak_erat_art' => 'required|string',
                'tgl_diaknosa' => 'required|date',
                'tmp_diaknosa' => 'required|string',
                'tgl_periksa_terakhir' => 'required|date',
                'tmp_periksa_terakhir' => 'required|string',
                'obat_tbc' => 'required|string',
                'minum_obat_tbc' => 'required|string',
                'nama_pmo' => 'required|string',
                'merokok' => 'required|string',
                'edukasi' => 'required|string',
                'periksa_postu_fasyankes' => 'required|string',
                'tgl_lapor' => 'required|date',
            ]);
        } else {
            $request->merge([
                // 'nik' => null,
                // 'nama' => null,
                'tgl_lahir' => null,
                'tmp_lahir' => null,
                'gender' => null,
                'kunjungan' => null,
                'tgl_kunjungan' => null,
                'batuk_skrining' => null,
                'demam_skrining' => null,
                'bb_skrining' => null,
                'kontak_erat_keluarga' => null,
                'kontak_erat_tetangga' => null,
                'kontak_erat_art' => null,
                'tgl_diaknosa' => null,
                'tmp_diaknosa' => null,
                'tgl_periksa_terakhir' => null,
                'tmp_periksa_terakhir' => null,
                'obat_tbc' => null,
                'minum_obat_tbc' => null,
                'nama_pmo' => null,
                'merokok' => null,
                'edukasi' => null,
                'periksa_postu_fasyankes' => null,
                'tgl_lapor' => null,
            ]);
        }

        $kunjunganTBC = Kunjungan_TBC::findOrFail($id);
        $kunjunganTBC->update($request->all());

        Kunjungan_TBC::where('nik', $kunjunganTBC->nik)
            ->update(['status' => $request->status]);

        return redirect()->route('kunjungan_tbc.index')->with('success', 'Data ibu hamil berhasil diperbarui.');
    }
    // Menampilkan form untuk mengedit data lingkungan rumah
    public function edit2($id)
    {
        $kunjunganTBC = Kunjungan_TBC::findOrFail($id);
        return view('kunjungan_tbc.editdetail', compact('kunjunganTBC'));
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
                'batuk_skrining' => 'required|string',
                'demam_skrining' => 'required|string',
                'bb_skrining' => 'required|string',
                'kontak_erat_keluarga' => 'required|string',
                'kontak_erat_tetangga' => 'required|string',
                'kontak_erat_art' => 'required|string',
                'tgl_diaknosa' => 'required|date',
                'tmp_diaknosa' => 'required|string',
                'tgl_periksa_terakhir' => 'required|date',
                'tmp_periksa_terakhir' => 'required|string',
                'obat_tbc' => 'required|string',
                'minum_obat_tbc' => 'required|string',
                'nama_pmo' => 'required|string',
                'merokok' => 'required|string',
                'edukasi' => 'required|string',
                'periksa_postu_fasyankes' => 'required|string',
                'tgl_lapor' => 'required|date',
            ]);
        } else {
            $request->merge([
                // 'nik' => null,
                // 'nama' => null,
                'tgl_lahir' => null,
                'tmp_lahir' => null,
                'gender' => null,
                'kunjungan' => null,
                'tgl_kunjungan' => null,
                'batuk_skrining' => null,
                'demam_skrining' => null,
                'bb_skrining' => null,
                'kontak_erat_keluarga' => null,
                'kontak_erat_tetangga' => null,
                'kontak_erat_art' => null,
                'tgl_diaknosa' => null,
                'tmp_diaknosa' => null,
                'tgl_periksa_terakhir' => null,
                'tmp_periksa_terakhir' => null,
                'obat_tbc' => null,
                'minum_obat_tbc' => null,
                'nama_pmo' => null,
                'merokok' => null,
                'edukasi' => null,
                'periksa_postu_fasyankes' => null,
                'tgl_lapor' => null,
            ]);
        }

        $kunjunganTBC = Kunjungan_TBC::findOrFail($id);
        $kunjunganTBC->update($request->all());
        session(['kk' => $request->kk, 'nama' => $request->nama, 'nik' => $request->nik]);

        return redirect()->route('kunjungan_tbc.show', $kunjunganTBC->id)->with('success', 'Data ibu hamil berhasil ditambahkan.');
    }
    // ==============================================


    public function createvalidate()
    {
        return view('kunjungan_tbc.createvalidate');
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
                'batuk_skrining' => 'required|string',
                'demam_skrining' => 'required|string',
                'bb_skrining' => 'required|string',
                'kontak_erat_keluarga' => 'required|string',
                'kontak_erat_tetangga' => 'required|string',
                'kontak_erat_art' => 'required|string',
                'tgl_diaknosa' => 'required|date',
                'tmp_diaknosa' => 'required|string',
                'tgl_periksa_terakhir' => 'required|date',
                'tmp_periksa_terakhir' => 'required|string',
                'obat_tbc' => 'required|string',
                'minum_obat_tbc' => 'required|string',
                'nama_pmo' => 'required|string',
                'merokok' => 'required|string',
                'edukasi' => 'required|string',
                'periksa_postu_fasyankes' => 'required|string',
                'tgl_lapor' => 'required|date',
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
                'batuk_skrining' => null,
                'demam_skrining' => null,
                'bb_skrining' => null,
                'kontak_erat_keluarga' => null,
                'kontak_erat_tetangga' => null,
                'kontak_erat_art' => null,
                'tgl_diaknosa' => null,
                'tmp_diaknosa' => null,
                'tgl_periksa_terakhir' => null,
                'tmp_periksa_terakhir' => null,
                'obat_tbc' => null,
                'minum_obat_tbc' => null,
                'nama_pmo' => null,
                'merokok' => null,
                'edukasi' => null,
                'periksa_postu_fasyankes' => null,
                'tgl_lapor' => null,
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

        Kunjungan_TBC::create($validatedData);

        session(['nik' => $request->nik]);
        return redirect()->route('kunjungan_tbc.index')->with('success', 'Data ibu hamil berhasil ditambahkan.');
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
        $kunjunganTBC = Kunjungan_TBC::findOrFail($id);

        // Hapus data lingkungan rumah
        $kunjunganTBC->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('kunjungan_tbc.index')->with('success', 'Data kunjungan TBC berhasil dihapus.');
    }
    public function destroy2($id)
    {
        // Temukan data ibu hamil yang akan dihapus
        $kunjunganTBC = Kunjungan_TBC::findOrFail($id);

        // Simpan KK sebelum menghapus data
        $kk = $kunjunganTBC->kk;

        // Hapus data ibu hamil
        $kunjunganTBC->delete();

        // Temukan ID data KK lain yang tersisa (jika ada)
        $otherkunjunganTBC = Kunjungan_TBC::where('kk', $kk)->first();

        // Redirect ke halaman detail dengan menggunakan ID KK yang tersisa (jika ada), jika tidak kembali ke index
        if ($otherkunjunganTBC) {
            return redirect()->route('kunjungan_tbc.show', ['id' => $otherkunjunganTBC->id])->with('success', 'Data kunjungan TBC berhasil dihapus.');
        } else {
            return redirect()->route('kunjungan_tbc.index')->with('success', 'Data kunjungan TBC berhasil dihapus.');
        }
    }
    // public function kunjungantbcPDF()
    // {
    //     $kunjungantbc = Kunjungan_TBC::get();
    //     $pdf = Pdf::loadView('kunjungan_tbc.pdf', ['kunjungantbc' => $kunjungantbc]);
    //     return $pdf->stream('Kunjungan TBC.pdf');
    // }
    public function kunjungantbcPDF($id)
    {
        // Mengambil data kunjungan TBC berdasarkan ID
        $dataKK = Kunjungan_TBC::findOrFail($id);

        // Mengambil anggota keluarga yang terkait dengan KK yang sama
        $familyMembers = Kunjungan_TBC::where('nik', $dataKK->nik)->get();

        // Memuat view dan mengirimkan data yang diambil
        $pdf = Pdf::loadView('kunjungan_tbc.pdf', ['kunjungantbc' => $familyMembers])
            ->setPaper('a4', 'landscape');

        // Mengirimkan file PDF yang dihasilkan
        return $pdf->stream('Kunjungan_TBC.pdf');
    }



    public function kunjungantbcPDF2($id)
    {
        try {
            // Mengambil data kunjungan TBC berdasarkan ID
            $kunjunganTBC = Kunjungan_TBC::findOrFail($id);

            // Memuat view dan mengirimkan data yang diambil
            $pdf = Pdf::loadView('kunjungan_tbc.pdf2', ['kunjungantbc' => $kunjunganTBC])
                ->setPaper('a4', 'landscape');
            // Mengirimkan file PDF yang dihasilkan
            return $pdf->stream('Kunjungan TBC.pdf');
        } catch (\Exception $e) {
            // Menangani error jika data tidak ditemukan atau terjadi kesalahan lain
            return redirect()->back()->withErrors(['msg' => 'Data kunjungan TBC tidak ditemukan atau terjadi kesalahan.']);
        }
    }
}
