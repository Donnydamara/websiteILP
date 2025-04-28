<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lingkungan_Rumah;
use App\Models\JadwalPengumpulan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LingkunganRumahExport;

class LingkunganRumahController extends Controller
{
    public function index(Request $request)
    {
        $userId = Auth::id();
        $userRole = Auth::user()->role; // Get the role of the currently logged-in user

        if ($userRole === 'admin') {
            // Admin users see all records and paginate them
            $lingkunganRumahs = Lingkungan_Rumah::distinct('kk')->paginate(10);
        } else {
            // Non-admin users see records filtered by their user ID and paginate them
            $lingkunganRumahs = Lingkungan_Rumah::where('id_user', $userId)
                ->distinct('kk') // Ensure unique records based on 'kk'
                ->paginate(10);
        }

        // Check if this is an export request
        if ($request->input('export') == 1) {
            return Excel::download(new LingkunganRumahExport($lingkunganRumahs), 'lingkungan_rumah.xlsx');
        }

        // Pass the paginated data to the view
        return view('lingkunganrumah.list', compact('lingkunganRumahs'));
    }




    // Menampilkan form untuk menambahkan data lingkungan rumah baru
    public function create(Request $request)
    {
        $kk = $request->session()->get('kk');
        return view('lingkunganrumah.create', compact('kk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kk' => 'required',
            'AK_total' => 'required|integer|min:0',
            'AK_lansia' => 'required|integer|min:0',
            'jumlah_AK_dewasa' => 'required|integer|min:0',
            'AK_remaja' => 'required|integer|min:0',
            'AK_balita' => 'required|integer|min:0',
            'AK_bayi' => 'required|integer|min:0',
            'AK_ibu_bersalin_nifas' => 'required|integer|min:0',
            'AK_ibu_hamil' => 'required|integer|min:0',
            'jkn_jamkesda' => 'required',
            'sarana_air' => 'required',
            'jenis_sumber_air' => 'required',
            'jamban' => 'required',
            'jenis_jamban' => 'required',
            'ventilasi' => 'required',
            'mengalami_gangguan_jiwa' => 'required',
            'TBC_hipertensi_millitus' => 'required',
            'nama' => 'required',
        ]);
        $validatedData['id_user'] = Auth::id();

        Lingkungan_Rumah::create($request->all());

        session(['kk' => $request->kk]);

        return redirect()->route('ibu_hamil.create')->with('success', 'Data lingkungan rumah berhasil ditambahkan.');
    }

    // Menampilkan form untuk mengedit data lingkungan rumah
    public function edit($id)
    {
        $lingkunganRumah = Lingkungan_Rumah::findOrFail($id);
        return view('lingkunganrumah.edit', compact('lingkunganRumah'));
    }

    // Menyimpan perubahan pada data lingkungan rumah ke dalam database
    public function update(Request $request, $id)
    {
        // Validasi input dari formulir
        $request->validate([
            'kk' => 'required',
            'AK_lansia' => 'required|integer|min:0',
            'jumlah_AK_dewasa' => 'required|integer|min:0',
            'AK_remaja' => 'required|integer|min:0',
            'AK_balita' => 'required|integer|min:0',
            'AK_bayi' => 'required|integer|min:0',
            'AK_ibu_bersalin_nifas' => 'required|integer|min:0',
            'AK_ibu_hamil' => 'required|integer|min:0',
            'jkn_jamkesda' => 'required',
            'sarana_air' => 'required',
            'jenis_sumber_air' => 'required',
            'jamban' => 'required',
            'jenis_jamban' => 'required',
            'ventilasi' => 'required',
            'mengalami_gangguan_jiwa' => 'required',
            'TBC_hipertensi_millitus' => 'required',
            'nama' => 'required',
        ]);

        // Temukan data lingkungan rumah yang akan diupdate
        $lingkunganRumah = Lingkungan_Rumah::findOrFail($id);

        // Update data lingkungan rumah dengan data baru dari formulir
        $lingkunganRumah->update($request->all());

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('lingkunganrumah.index')->with('success', 'Data lingkungan rumah berhasil diperbarui.');
    }
    // ================================

    public function createvalidate()
    {
        return view('lingkunganrumah.createvalidate');
    }

    // Menyimpan data lingkungan rumah baru ke dalam database
    public function storevalidate(Request $request)
    {
        $validatedData = $request->validate([
            'kk' => 'required',
            'AK_total' => 'required',
            'AK_lansia' => 'required',
            'jumlah_AK_dewasa' => 'required',
            'AK_remaja' => 'required',
            'AK_balita' => 'required',
            'AK_bayi' => 'required',
            'AK_ibu_bersalin_nifas' => 'required',
            'AK_ibu_hamil' => 'required',
            'jkn_jamkesda' => 'required',
            'sarana_air' => 'required',
            'jenis_sumber_air' => 'required',
            'jamban' => 'required',
            'jenis_jamban' => 'required',
            'ventilasi' => 'required',
            'mengalami_gangguan_jiwa' => 'required',
            'TBC_hipertensi_millitus' => 'required',
            'nama' => 'required',
        ]);

        $dataKK = JadwalPengumpulan::where('kk', $validatedData['kk'])->first();
        if (!$dataKK) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['kk' => 'KK tidak ditemukan di data KK.']);
        }
        $validatedData['id_user'] = Auth::id();
        Lingkungan_Rumah::create($validatedData);

        session(['kk' => $request->kk]);

        return redirect()->route('lingkunganrumah.index')->with('success', 'Data lingkungan rumah berhasil ditambahkan.');
    }

    public function checkKK(Request $request)
    {
        $kk = $request->input('kk');

        // Lakukan validasi KK di sini, misalnya dengan mencari KK di database atau service lainnya
        $Lingkungan_Rumah = JadwalPengumpulan::where('kk', $kk)->first();

        if ($Lingkungan_Rumah) {
            return response()->json([
                'status' => 'success',
                'message' => 'KK Ditemukan',
                'data' => [
                    'nama' => $Lingkungan_Rumah->nama,
                    'nik' => $Lingkungan_Rumah->nik,
                ]
            ]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'KK Tidak Ditemukan']);
        }
    }
    // Menghapus data lingkungan rumah dari database
    public function destroy($id)
    {
        // Temukan data lingkungan rumah yang akan dihapus
        $lingkunganRumah = Lingkungan_Rumah::findOrFail($id);

        // Hapus data lingkungan rumah
        $lingkunganRumah->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('lingkunganrumah.index')->with('success', 'Data lingkungan rumah berhasil dihapus.');
    }
    public function lingkunganRumahPDF2($id)
    {
        try {
            // Mengambil data kunjungan TBC berdasarkan ID
            $lingkunganRumah = Lingkungan_Rumah::findOrFail($id);

            // Memuat view dan mengirimkan data yang diambil
            $pdf = Pdf::loadView('lingkunganrumah.pdf2', ['lingkunganRumah' => $lingkunganRumah])
                ->setPaper('a4', 'landscape');
            // Mengirimkan file PDF yang dihasilkan
            return $pdf->stream('1. Data Keluarga Dan Anggota Keluarga.pdf');
        } catch (\Exception $e) {
            // Menangani error jika data tidak ditemukan atau terjadi kesalahan lain
            return redirect()->back()->withErrors(['msg' => 'Data lingkungan rumah tidak ditemukan atau terjadi kesalahan.']);
        }
    }



    // public function lingkunganRumahPDF2($id)
    // {
    //     try {
    //         // Mengambil data lingkungan rumah berdasarkan ID
    //         $lingkunganRumah = Lingkungan_Rumah::findOrFail($id);

    //         // Memuat view dan mengirimkan data yang diambil
    //         $pdf = Pdf::loadView('lingkunganrumah.pdf2', ['lingkunganRumah' => $lingkunganRumah])
    //             ->setPaper('a4', 'landscape');

    //         // Menghasilkan file PDF untuk di-download
    //         return $pdf->download('1. Data Keluarga Dan Anggota Keluarga.pdf');
    //     } catch (\Exception $e) {
    //         // Menangani error jika data tidak ditemukan atau terjadi kesalahan lain
    //         return redirect()->back()->withErrors(['msg' => 'Data lingkungan rumah tidak ditemukan atau terjadi kesalahan.']);
    //     }
    // }
}
