<?php

namespace App\Http\Controllers;

use App\Models\DataKK;
use App\Models\JadwalPengumpulan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DataKKExport;

class DataKKController extends Controller
{
    // Menampilkan daftar data KK
    // public function index()
    // {
    //     $userId = Auth::id();
    //     $userRole = Auth::user()->role; // Get the role of the currently logged-in user

    //     if ($userRole === 'admin') {
    //         // Admin users see all records
    //         $dataKKs = DataKK::where('hubungan_keluarga', 'Kepala Keluarga')->paginate(10);
    //     } else {
    //         // Non-admin users see records filtered by their user ID
    //         $dataKKs = DataKK::where('hubungan_keluarga', 'Kepala Keluarga')
    //             ->where('id_user', $userId)
    //             ->paginate(10);
    //     }

    //     // Pass the data to the view
    //     return view('pendataan_kk.list', compact('dataKKs'));
    // }

    // Menampilkan daftar data KK dan melakukan ekspor jika diperlukan
    public function index(Request $request)
    {
        $userId = Auth::id();
        $userRole = Auth::user()->role; // Get the role of the currently logged-in user
        $export = $request->input('export', false); // Check if the request is for export

        // Query to get data based on user role
        if ($userRole === 'admin') {
            $dataKKs = DataKK::where('hubungan_keluarga', 'Kepala Keluarga')->get();
        } else {
            $dataKKs = DataKK::where('hubungan_keluarga', 'Kepala Keluarga')
                ->where('id_user', $userId)
                ->get();
        }

        // If this is an export request, export the data to Excel
        if ($export) {
            return Excel::download(new DataKKExport($dataKKs), 'data_kk.xlsx');
        }

        // Paginate the data for normal view
        $dataKKs = DataKK::where('hubungan_keluarga', 'Kepala Keluarga')->paginate(10);

        // Pass the data to the view
        return view('pendataan_kk.list', compact('dataKKs'));
    }



    public function show($id, Request $request)
    {
        // Retrieve data Ibu Hamil by ID
        $dataKK = DataKK::findOrFail($id);

        // Get family members related by KK
        $familyMembers = DataKK::where('kk', $dataKK->kk)->get();

        // Check if this is an export request
        if ($request->input('export', false)) {
            return Excel::download(new DataKKExport($familyMembers), 'family_members.xlsx');
        }

        // Pass data to the view
        return view('pendataan_kk.detail', compact('dataKK', 'familyMembers'));
    }





    // Menampilkan form untuk menambahkan data KK baru
    public function create(Request $request)
    {
        // Mengambil data KK dan nama kepala keluarga dari session
        $kk = $request->session()->get('kk');
        $kepala_kk = $request->session()->get('kepala_kk');

        return view('pendataan_kk.create', compact('kk', 'kepala_kk'));

        $title = 'Create Data KK';
        session(['kk' => '', 'kepala_kk' => '']);
        return view('datakk.create', compact('kk', 'kepala_kk'));
    }

    // Menyimpan data KK baru ke dalam database
    public function store(Request $request)
    {
        $request->validate([
            'kk' => 'required|digits:16',
            'nama' => 'required',
            'nik' => 'required|digits:16',
            'tgl_lahir' => 'required|date',
            'gender' => 'required',
            'hubungan_keluarga' => 'required',
            'status_perkawinan' => 'required',
            'pendidikan_terakhir' => 'required',
            'pekerjaan' => 'required',
            'kelompok_sasaran' => 'required',
            //  // Remove this line
        ]);
        $validatedData['id_user'] = Auth::id();
        // Add the logged-in user's ID to the request data
        $request->merge(['id_user' => Auth::id()]);

        // Save the data
        DataKK::create($request->all());

        session(['kk' => $request->kk]);
        session(['kepala_kk' => $request->nama]);

        // Check which button was clicked
        if ($request->input('action') == 'save_and_add') {
            return redirect()->route('datakk.create')->with('success', 'Data KK berhasil ditambahkan! Silakan tambahkan data lagi.');
        }

        return redirect()->route('lingkunganrumah.create')->with('success', 'Data KK berhasil ditambahkan!');
    }



    public function create1(Request $request)
    {
        // Mengambil data KK dan nama kepala keluarga dari session
        $kk = $request->session()->get('kk');
        $kepala_kk = $request->session()->get('kepala_kk');

        return view('pendataan_kk.createkk', compact('kk', 'kepala_kk'));
    }

    public function store1(Request $request)
    {
        $request->validate([
            'kk' => 'required|digits:16',
            'nama' => 'required',
            'nik' => 'required|digits:16',
            'tgl_lahir' => 'required|date',
            'gender' => 'required',
            'hubungan_keluarga' => 'required',
            'status_perkawinan' => 'required',
            'pendidikan_terakhir' => 'required',
            'pekerjaan' => 'required',
            'kelompok_sasaran' => 'required',

        ]);
        $validatedData['id_user'] = Auth::id();
        DataKK::create($request->all());

        session(['kk' => $request->kk]);
        session(['kepala_kk' => $request->nama]);

        return redirect()->route('lingkunganrumah.index')->with('message', 'Data KK created successfully.');
    }

    public function create2(Request $request, $id = null)
    {
        // Fetch the DataKK record by ID
        $dataKK = DataKK::findOrFail($id);

        // Pass KK data to the "createdetail" view
        return view('pendataan_kk.createdetail', compact('dataKK'));
    }


    public function store2(Request $request)
    {
        $request->validate([
            'kk' => 'required|digits:16',
            'nama' => 'required',
            'nik' => 'required|digits:16',
            'tgl_lahir' => 'required|date',
            'gender' => 'required',
            'hubungan_keluarga' => 'required',
            'status_perkawinan' => 'required',
            'pendidikan_terakhir' => 'required',
            'pekerjaan' => 'required',
            'kelompok_sasaran' => 'required',

        ]);
        $validatedData['id_user'] = Auth::id();
        $dataKK = DataKK::create($request->all());

        session(['kk' => $request->kk]);

        return redirect()->route('pendataan_kk.detail', $dataKK->id)->with('success', 'Data anggota keluarga berhasil ditambahkan.');
    }


    public function store3(Request $request)
    {
        $request->validate([
            'kk' => 'required|digits:16',
            'nama' => 'required',
            'nik' => 'required|digits:16',
            'tgl_lahir' => 'required|date',
            'gender' => 'required',
            'hubungan_keluarga' => 'required',
            'status_perkawinan' => 'required',
            'pendidikan_terakhir' => 'required',
            'pekerjaan' => 'required',
            'kelompok_sasaran' => 'required',

        ]);
        $validatedData['id_user'] = Auth::id();
        DataKK::create($request->all());

        session(['kk' => $request->kk]);

        return redirect()->route('datakk.index')->with('message', 'Data KK created successfully.');
    }

    // Menampilkan form untuk mengedit data KK
    public function edit($id)
    {
        $dataKK = DataKK::findOrFail($id);
        return view('pendataan_kk.edit', ['data' => $dataKK]);
    }

    // Menyimpan perubahan pada data KK ke dalam database
    public function update(Request $request, $id)
    {
        $request->validate([
            'kk' => 'required',
            'nama' => 'required',
            'nik' => 'required|integer',
            'tgl_lahir' => 'required|date',
            'gender' => 'required',
            'hubungan_keluarga' => 'required',
            'status_perkawinan' => 'required',
            'pendidikan_terakhir' => 'required',
            'pekerjaan' => 'required',
            'kelompok_sasaran' => 'required',
        ]);

        $dataKK = DataKK::findOrFail($id);
        $dataKK->update($request->all());

        return redirect()->route('datakk.index')->with('message', 'Data KK updated successfully.');
    }
    public function edit2($id)
    {
        $dataKK = DataKK::findOrFail($id);
        return view('pendataan_kk.editdetail', ['data' => $dataKK]);
    }

    // Menyimpan perubahan pada data KK ke dalam database
    public function update2(Request $request, $id)
    {
        $request->validate([
            'kk' => 'required',
            'nama' => 'required',
            'nik' => 'required|integer',
            'tgl_lahir' => 'required|date',
            'gender' => 'required',
            'hubungan_keluarga' => 'required',
            'status_perkawinan' => 'required',
            'pendidikan_terakhir' => 'required',
            'pekerjaan' => 'required',
            'kelompok_sasaran' => 'required',
        ]);

        $dataKK = DataKK::findOrFail($id);
        $dataKK->update($request->all());
        session(['kk' => $request->kk]);

        return redirect()->route('pendataan_kk.detail', $dataKK->id)->with('success', 'Data anggota keluarga berhasil ditambahkan.');
    }

    // Menampilkan form validasi
    public function createvalidate()
    {
        return view('pendataan_kk.createvalidate');
    }

    // Menyimpan data KK baru ke dalam database
    public function storevalidate(Request $request)
    {
        $validatedData = $request->validate([
            'kk' => 'required|digits:16',
            'nama' => 'required',
            'nik' => 'required|digits:16',
            'tgl_lahir' => 'required|date',
            'gender' => 'required',
            'hubungan_keluarga' => 'required',
            'status_perkawinan' => 'required',
            'pendidikan_terakhir' => 'required',
            'pekerjaan' => 'required',
            'kelompok_sasaran' => 'required',
            //  // Remove this line
        ]);
        $validatedData['id_user'] = Auth::id();
        // Add the logged-in user's ID to the validated data
        $validatedData['id_user'] = Auth::id();

        $dataKK = JadwalPengumpulan::where('kk', $validatedData['kk'])->first();
        if (!$dataKK) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['kk' => 'KK tidak ditemukan di data KK.']);
        }

        DataKK::create($validatedData);

        return redirect()->route('datakk.index')
            ->with('success', 'Data kunjungan berhasil disimpan.');
    }

    public function checkKK(Request $request)
    {
        $kk = $request->input('kk');

        // Lakukan validasi KK di sini, misalnya dengan mencari KK di database atau service lainnya
        $dataKK = JadwalPengumpulan::where('kk', $kk)->first();

        if ($dataKK) {
            return response()->json([
                'status' => 'success',
                'message' => 'KK Ditemukan',
                'data' => [
                    'nama' => $dataKK->nama,
                    'nik' => $dataKK->nik,
                ]
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'KK Tidak Ditemukan']);
        }
    }
    // Memeriksa keberadaan KK
    // public function checkKK(Request $request)
    // {
    //     $kk = $request->input('kk');

    //     // Lakukan validasi KK di sini, misalnya dengan mencari KK di database atau service lainnya
    //     $dataKK = JadwalPengumpulan::where('kk', $kk)->first();

    //     if ($dataKK) {
    //         return response()->json([
    //             'status' => 'success',
    //             'message' => 'KK Ditemukan',
    //         ]);
    //     } else {
    //         return response()->json(['status' => 'error', 'success' => 'KK Tidak Ditemukan']);
    //     }
    // }
    //======================================
    // Menghapus data KK dari database
    public function destroy($id)
    {
        $dataKK = DataKK::findOrFail($id);
        $dataKK->delete();

        return redirect()->route('datakk.index')->with('success', 'Data anggota kepala keluarga berhasil.');
    }

    public function destroy2($id)
    {
        $dataKK = DataKK::findOrFail($id);
        $kk = $dataKK->kk;
        $dataKK->delete();

        $otherDataKK = DataKK::where('kk', $kk)->first();

        if ($otherDataKK) {
            return redirect()->route('pendataan_kk.detail', ['id' => $otherDataKK->id])->with('success', 'Data anggota keluarga berhasil dihapus.');
        } else {
            return redirect()->route('datakk.index')->with('success', 'Data anggota keluarga berhasil dihapus.');
        }
    }
    public function pendataan_KKPDF($kk)
    {
        // Mengambil data berdasarkan nomor KK dari model DataKK
        $pendataan_KK = DataKK::where('kk', $kk)->get();

        // Mengambil data dari JadwalPengumpulan berdasarkan nomor KK yang sama
        $jadwalPengumpulan = JadwalPengumpulan::where('kk', $kk)->get();

        // Render view 'pendataan_kk.pdf' dan kirimkan data yang diambil
        $pdf = PDF::loadView('pendataan_kk.pdf', [
            'pendataan_KK' => $pendataan_KK,
            'jadwalPengumpulan' => $jadwalPengumpulan
        ])->setPaper('a4', 'landscape');

        // Mengirimkan file PDF yang dihasilkan
        return $pdf->stream('pendataan_kk.pdf');
    }
}
