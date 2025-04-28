<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TindakLanjutKunjungan;
use App\Models\DataKK;
use App\Models\JadwalPengumpulan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TindakLanjutKunjunganExport;

class TindakLanjutKunjunganController extends Controller
{
    // Method untuk menampilkan semua data kunjungan
    public function index(Request $request)
    {
        $userId = Auth::id();
        $userRole = Auth::user()->role;

        // Ambil input filter
        $status = $request->input('status', 'ya'); // Default 'ya'
        $posyandu = $request->input('posyandu', null); // Default null
        $export = $request->input('export', false);

        // Query dasar tergantung pada peran user
        $query = $userRole === 'admin'
            ? TindakLanjutKunjungan::query()
            : TindakLanjutKunjungan::where('id_user', $userId);

        // Filter berdasarkan status
        if ($status !== 'semua') {
            $query->where('status', $status);
        }

        // Filter berdasarkan posyandu
        if (!empty($posyandu)) {
            $query->where('posyandu', $posyandu);
        }

        // Jika ekspor diminta
        if ($export) {
            $data = $query->get();
            return Excel::download(new TindakLanjutKunjunganExport($data), 'tindak_lanjut_kunjungan.xlsx');
        }

        // Pagination
        $tindakLanjutKunjungans = $query->distinct('nik')->paginate(10);

        // Daftar posyandu unik untuk filter
        $posyandus = TindakLanjutKunjungan::distinct('posyandu')->pluck('posyandu');

        // Kirim data ke view
        return view('tindak_lanjut_kunjungan.list', compact('tindakLanjutKunjungans', 'status', 'posyandu', 'posyandus'));
    }





    // Method untuk menampilkan form tambah kunjungan
    public function create()
    {
        // $posyandus = JadwalPengumpulan ::all();
        // return view('tindak_lanjut_kunjungan.create', compact('posyandus'));
        return view('tindak_lanjut_kunjungan.create');
    }

    // Method untuk menyimpan data kunjungan baru
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'posyandu' => 'required',
            'waktu' => 'required|date',
            'nama' => 'required',
            'nik' => 'required',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required',
            'no_telepon' => 'required',
            'masalah_kesehatan_yang_ditemukan' => 'required',
            'tindak_lanjut' => 'required',
            'edukasi' => 'required',
            'lapor_nakes' => 'required',
            'status' => 'required',
        ]);
        $validatedData['id_user'] = Auth::id();
        // Cek apakah NIK ada di dalam model DataKK
        $dataKK = DataKK::where('nik', $validatedData['nik'])->first();
        if (!$dataKK) {
            return redirect()->back()
                ->withInput()
                ->withErrors(['nik' => 'NIK tidak ditemukan di data Kepala Keluarga.']);
        }

        // Hapus pengecekan NIK sudah ada di tabel TindakLanjutKunjungan
        // $existingEntry = TindakLanjutKunjungan::where('nik', $validatedData['nik'])->first();
        // if ($existingEntry) {
        //     return redirect()->back()
        //         ->withInput()
        //         ->withErrors(['nik' => 'NIK sudah terdaftar dalam data kunjungan.']);
        // }

        TindakLanjutKunjungan::create($validatedData);

        return redirect()->route('tindak_lanjut_kunjungan.index')
            ->with('success', 'Data kunjungan berhasil disimpan.');
    }

    // Method untuk menampilkan form edit kunjungan
    public function edit($id)
    {
        $tindakLanjutKunjungan = TindakLanjutKunjungan::findOrFail($id);
        return view('tindak_lanjut_kunjungan.edit', compact('tindakLanjutKunjungan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'posyandu' => 'required|string|max:255',
            'nik' => 'required|string|max:16',
            'nama' => 'required|string|max:255',
            'waktu' => 'required|date',
            'tgl_lahir' => 'required|date',
            'alamat' => 'required|string',
            'no_telepon' => 'required|string|max:15',
            'masalah_kesehatan_yang_ditemukan' => 'required|string',
            'tindak_lanjut' => 'required|string',
            'edukasi' => 'required|string',
            'lapor_nakes' => 'required|string',
            'status' => 'required',
        ]);

        $tindakLanjutKunjungan = TindakLanjutKunjungan::findOrFail($id);
        $tindakLanjutKunjungan->update($request->all());

        return redirect()->route('tindak_lanjut_kunjungan.index')->with('success', 'Data berhasil diperbarui.');
    }


    public function checkNik(Request $request)
    {
        $nik = $request->input('nik');

        // Lakukan validasi NIK di sini, misalnya dengan mencari NIK di database atau service lainnya
        $dataKK = DataKK::where('nik', $nik)->first();

        if ($dataKK) {
            // Debugging
            logger()->info('DataKK ditemukan:', ['dataKK' => $dataKK]);

            // Ambil data alamat dari model JadwalPengumpulan
            $jadwalPengumpulan = JadwalPengumpulan::where('kk', $dataKK->kk)->first();

            if ($jadwalPengumpulan) {
                // Debugging
                logger()->info('JadwalPengumpulan ditemukan:', ['jadwalPengumpulan' => $jadwalPengumpulan]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'NIK Ditemukan',
                    'data' => [
                        'nama' => $dataKK->nama,
                        'tgl_lahir' => $dataKK->tgl_lahir,
                        'alamat' => $jadwalPengumpulan->alamat,
                        'posyandu' => $jadwalPengumpulan->posyandu
                    ]
                ]);
            } else {
                // Debugging
                logger()->info('JadwalPengumpulan tidak ditemukan untuk kk:', ['kk' => $dataKK->id]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'NIK Ditemukan, tetapi alamat tidak ditemukan',
                    'data' => [
                        'nama' => $dataKK->nama,
                        'tgl_lahir' => $dataKK->tgl_lahir
                    ]
                ]);
            }
        } else {
            // Debugging
            logger()->info('NIK tidak ditemukan:', ['nik' => $nik]);

            return response()->json(['status' => 'error', 'message' => 'NIK Tidak Ditemukan']);
        }
    }



    public function show($id)
    {
        $tindakLanjutKunjungan = TindakLanjutKunjungan::findOrFail($id);
        return view('tindak_lanjut_kunjungan.show', compact('tindakLanjutKunjungan'));
    }

    // Method untuk menghapus kunjungan
    public function destroy($id)
    {
        $tindakLanjutKunjungan = TindakLanjutKunjungan::findOrFail($id);
        $tindakLanjutKunjungan->delete();

        return redirect()->route('tindak_lanjut_kunjungan.index')
            ->with('success', 'Data kunjungan berhasil dihapus.');
    }
    // Di dalam method controller
    public function tindakLanjutKunjunganPDF($id)
    {
        try {
            // Mengambil data Tindak Lanjut Kunjungan berdasarkan ID
            $tindakLanjutKunjungan = TindakLanjutKunjungan::findOrFail($id);

            // Memuat view dan mengirimkan data yang diambil
            $pdf = Pdf::loadView('tindak_lanjut_kunjungan.pdf', ['tindakLanjutKunjungan' => $tindakLanjutKunjungan])
                ->setPaper('a4', 'landscape');
            // Mengirimkan file PDF yang dihasilkan
            return $pdf->stream('Data Tindak Lanjut Kunjungan.pdf');
        } catch (\Exception $e) {
            // Menangani error jika data tidak ditemukan atau terjadi kesalahan lain
            return redirect()->back()->withErrors(['msg' => 'Data Tindak Lanjut Kunjungan tidak ditemukan atau terjadi kesalahan.']);
        }
    }
    public function exportAllPDF()
    {
        try {
            // Mengambil semua data kunjungan
            $tindakLanjutKunjungans = TindakLanjutKunjungan::all();

            // Memuat view dan mengirimkan data yang diambil
            $pdf = PDF::loadView('tindak_lanjut_kunjungan.all_pdf', compact('tindakLanjutKunjungans'))
                ->setPaper('a4', 'landscape');

            // Mengirimkan file PDF yang dihasilkan
            return $pdf->stream('Semua Data Tindak Lanjut Kunjungan.pdf');
        } catch (\Exception $e) {
            // Menangani error jika terjadi kesalahan
            return redirect()->back()->withErrors(['msg' => 'Terjadi kesalahan dalam mengexport data kunjungan.']);
        }
    }
    public function exportAllPDF2(Request $request)
    {
        try {


            // Mengambil data kunjungan berdasarkan posyandu yang dipilih
            // Disesuaikan dengan kondisi yang tepat, misalnya menggunakan where() jika ada filter posyandu
            $tindakLanjutKunjungans = TindakLanjutKunjungan::all();

            // Memuat view dan mengirimkan data yang diambil
            $pdf = PDF::loadView('tindak_lanjut_kunjungan.all_pdf2', compact('tindakLanjutKunjungans'))
                ->setPaper('a4', 'landscape');

            // Mengirimkan file PDF yang dihasilkan
            return $pdf->stream('Data Tindak Lanjut Kunjungan.pdf');
        } catch (\Exception $e) {
            // Menangani error jika terjadi kesalahan
            return redirect()->back()->withErrors(['msg' => 'Terjadi kesalahan dalam mengexport data kunjungan.']);
        }
    }

    public function exportAllPDF3(Request $request)
    {
        try {
            // Mengambil parameter dari request
            $status = $request->input('status', 'ya'); // Default 'ya'
            $posyandu = $request->input('posyandu', null); // Default null

            // Query data kunjungan
            $tindakLanjutKunjungans = TindakLanjutKunjungan::query();

            // Filter berdasarkan status
            if ($status !== 'semua') {
                $tindakLanjutKunjungans->where('status', $status);
            }

            // Filter berdasarkan posyandu
            if (!empty($posyandu)) {
                $tindakLanjutKunjungans->where('posyandu', $posyandu);
            }

            $tindakLanjutKunjungans = $tindakLanjutKunjungans->get();

            // Memuat view dan mengirimkan data yang diambil
            $pdf = PDF::loadView('tindak_lanjut_kunjungan.all_pdfposyandu', compact('tindakLanjutKunjungans'))
                ->setPaper('a4', 'landscape');

            // Mengirimkan file PDF yang dihasilkan
            return $pdf->stream('Data Tindak Lanjut Kunjungan.pdf');
        } catch (\Exception $e) {
            // Menangani error jika terjadi kesalahan
            return redirect()->back()->withErrors(['msg' => 'Terjadi kesalahan dalam mengexport data kunjungan.']);
        }
    }
}
