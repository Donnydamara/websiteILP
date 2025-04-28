<?php

namespace App\Http\Controllers;

use App\Models\DataKK;
use App\Models\Ibu_Bersalin_Nifas;
use App\Models\Ibu_Hamil;
use App\Models\Kunjungan_Bayi_Balita_Prasekolah;
use App\Models\Kunjungan_Lansia;
use App\Models\Kunjungan_Rumah_Bayi;
use App\Models\Kunjungan_TBC;
use App\Models\Kunjungan_Usia_Dewasa;
use App\Models\Kunjungan_Usia_Sekolah;
use App\Models\Lingkungan_Rumah;
use App\Models\JadwalPengumpulan;
use App\Models\TargetDesa; // Tambahkan namespace untuk model JadwalPengumpulan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\JadwalPengumpulanExport;
use Maatwebsite\Excel\Facades\Excel;

class JadwalPengumpulanController extends Controller
{
    // public function index()
    // {
    //     $userId = Auth::id();
    //     $userRole = Auth::user()->role; // Get the role of the currently logged-in user

    //     if ($userRole === 'admin') {
    //         // Admin users see all records and paginate them
    //         $jadwals = JadwalPengumpulan::paginate(10);
    //     } else {
    //         // Non-admin users see records filtered by their user ID and paginate them
    //         $jadwals = JadwalPengumpulan::where('id_user', $userId)->paginate(10);
    //     }

    //     // Pass the paginated data to the view
    //     return view('jadwalpengumpulandata.list', compact('jadwals'));
    // }
    public function index(Request $request)
    {
        $userId = Auth::id();
        $userRole = Auth::user()->role; // Get the role of the currently logged-in user
        $export = $request->input('export', false); // Check if the request is for export

        if ($userRole === 'admin') {
            // Admin users see all records
            $jadwals = JadwalPengumpulan::all();
        } else {
            // Non-admin users see records filtered by their user ID
            $jadwals = JadwalPengumpulan::where('id_user', $userId)->get();
        }

        // Check if this is an export request
        if ($export) {
            return Excel::download(new JadwalPengumpulanExport($jadwals), 'jadwal_pengumpulan.xlsx');
        }

        // Paginate the data for normal view
        $jadwals = JadwalPengumpulan::paginate(10);

        // Pass the paginated data to the view
        return view('jadwalpengumpulandata.list', compact('jadwals'));
    }



    public function create()
    {
        $puskesmasList = TargetDesa::distinct()->pluck('puskesmas'); // Ambil daftar puskesmas yang unik
        // Ambil data provinsi, kota, kecamatan, dan desa untuk puskesmas pertama
        $firstPuskesmas = $puskesmasList->first();
        $targetDesa = TargetDesa::where('puskesmas', $firstPuskesmas)->get();

        return view('jadwalpengumpulandata.create', compact('puskesmasList', 'targetDesa'));
    }


    public function getDesaByPuskesmas(Request $request)
    {
        $desaList = TargetDesa::where('puskesmas', $request->puskesmas)->get();
        return response()->json($desaList);
    }

    // Menyimpan jadwal pengumpulan data baru ke dalam database
    public function store(Request $request)
    {
        $request->validate([
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'dusun' => 'required',
            'desa' => 'required',
            'kecamatan' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
            'no_hp' => 'required',
            'puskesmas' => 'required',
            'postu' => 'required',
            'posyandu' => 'required',
            'nama' => 'required',
            'kk' => 'required|digits:16',
        ]);
        $validatedData['id_user'] = Auth::id();

        JadwalPengumpulan::create($request->all());

        return redirect()->route('datakk.create')->with(['kk' => $request->kk, 'nama' => $request->nama], 'success', 'Berhasil Menambahkan Jadwal Pengumpulan .');

        // return redirect()->route('jadwal.index')->with('success', 'Jadwal Pengumpulan created successfully.'); // Ganti target-desa.index menjadi jadwal.index
    }

    public function edit($id)
    {
        $jadwal = JadwalPengumpulan::findOrFail($id);
        $targetDesa = TargetDesa::all(); // Ambil semua data dari tabel target_desa
        return view('jadwalpengumpulandata.edit', ['data' => $jadwal, 'targetDesa' => $targetDesa]);
    }

    // Menyimpan perubahan pada jadwal pengumpulan data ke dalam database
    public function update(Request $request, $id)
    {
        $request->validate([
            'alamat' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'dusun' => 'required',
            'desa' => 'required',
            'kecamatan' => 'required',
            'kota' => 'required',
            'provinsi' => 'required',
            'no_hp' => 'required',
            'puskesmas' => 'required',
            'postu' => 'required',
            'posyandu' => 'required',
            'nama' => 'required',
            'kk' => 'required|digits:16',
        ]);

        $jadwalPengumpulan = JadwalPengumpulan::findOrFail($id);
        $jadwalPengumpulan->update($request->all());

        // Update data KK di semua tabel terkait
        $this->updateKKInAllTables($request->kk, $jadwalPengumpulan->kk);

        return redirect()->route('jadwal.index')->with('success', 'Berhasil Memperbaharui Jadwal Pengumpulan .');
    }

    // Menghapus jadwal pengumpulan data dari database
    public function destroy($id)
    {
        $jadwalPengumpulan = JadwalPengumpulan::findOrFail($id);
        $kk = $jadwalPengumpulan->kk;

        // Menghapus semua data terkait dengan nomor KK yang dihapus
        $this->deleteAllDataByKK($kk);

        $jadwalPengumpulan->delete();

        return redirect()->route('jadwal.index')->with('success', 'Berhasil Hapus Jadwal Pengumpulan.');
    }
    public function getRelatedData($puskesmas)
    {
        $targetDesa = TargetDesa::where('puskesmas', $puskesmas)->first();

        if ($targetDesa) {
            return response()->json([
                'provinsi' => $targetDesa->provinsi,
                'kota' => $targetDesa->kota,
                'kecamatan' => $targetDesa->kecamatan,
                'desa' => $targetDesa->desa
            ]);
        }

        return response()->json(['error' => 'Data not found'], 404);
    }

    private function updateKKInAllTables($newKK, $oldKK)
    {
        DataKK::where('kk', $oldKK)->update(['kk' => $newKK]);
        Ibu_Bersalin_Nifas::where('kk', $oldKK)->update(['kk' => $newKK]);
        Ibu_Hamil::where('kk', $oldKK)->update(['kk' => $newKK]);
        Kunjungan_Bayi_Balita_Prasekolah::where('kk', $oldKK)->update(['kk' => $newKK]);
        Kunjungan_Lansia::where('kk', $oldKK)->update(['kk' => $newKK]);
        Kunjungan_Rumah_Bayi::where('kk', $oldKK)->update(['kk' => $newKK]);
        Kunjungan_TBC::where('kk', $oldKK)->update(['kk' => $newKK]);
        Kunjungan_Usia_Dewasa::where('kk', $oldKK)->update(['kk' => $newKK]);
        Kunjungan_Usia_Sekolah::where('kk', $oldKK)->update(['kk' => $newKK]);
        Lingkungan_Rumah::where('kk', $oldKK)->update(['kk' => $newKK]);
    }

    private function deleteAllDataByKK($kk)
    {
        DataKK::where('kk', $kk)->delete();
        Ibu_Bersalin_Nifas::where('kk', $kk)->delete();
        Ibu_Hamil::where('kk', $kk)->delete();
        Kunjungan_Bayi_Balita_Prasekolah::where('kk', $kk)->delete();
        Kunjungan_Lansia::where('kk', $kk)->delete();
        Kunjungan_Rumah_Bayi::where('kk', $kk)->delete();
        Kunjungan_TBC::where('kk', $kk)->delete();
        Kunjungan_Usia_Dewasa::where('kk', $kk)->delete();
        Kunjungan_Usia_Sekolah::where('kk', $kk)->delete();
        Lingkungan_Rumah::where('kk', $kk)->delete();
    }
}
