<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataKK;
use App\Models\Ibu_Bersalin_Nifas;
use App\Models\Ibu_Hamil;
use App\Models\Kunjungan_Bayi_Balita_Prasekolah;
use App\Models\Kunjungan_Lansia;
use App\Models\Kunjungan_Rumah_Bayi;
use App\Models\Kunjungan_Usia_Dewasa;
use App\Models\Kunjungan_Usia_Sekolah;
use App\Models\Lingkungan_Rumah;
use App\Models\JadwalPengumpulan;
use App\Models\TargetDesa; // Tambahkan namespace untuk model JadwalPengumpulan
use Illuminate\Support\Facades\Auth;

class ProgresPendataanController extends Controller
{
    // JADWAL PENGUMPULAN DATA=======================================================================
    public function createjad()
    {
        $puskesmasList = TargetDesa::distinct()->pluck('puskesmas'); // Ambil daftar puskesmas yang unik
        // Ambil data provinsi, kota, kecamatan, dan desa untuk puskesmas pertama
        $firstPuskesmas = $puskesmasList->first();
        $targetDesa = TargetDesa::where('puskesmas', $firstPuskesmas)->get();

        return view('jadwalpengumpulandata.create', compact('puskesmasList', 'targetDesa'));
    }


    public function getDesaByPuskesmasjad(Request $request)
    {
        $desaList = TargetDesa::where('puskesmas', $request->puskesmas)->get();
        return response()->json($desaList);
    }

    public function storejad(Request $request)
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

        // Simpan id_user dan kk ke dalam sesi
        $data = $request->all();
        $data['id_user'] = Auth::id();
        JadwalPengumpulan::create($data);

        session(['kk' => $request->kk]); // Simpan kk ke dalam sesi

        return redirect()->route('lingkunganrumah.createling')->with('success', 'Berhasil Menambahkan Jadwal Pengumpulan .');
    }

    // PENDATAAN DATAKK =======================================================================================
    // Menampilkan form untuk menambahkan data KK baru
    public function createkkpgs(Request $request)
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
    public function storekkpgs(Request $request)
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

        // Add the logged-in user's ID to the request data
        $request->merge(['id_user' => Auth::id()]);

        // Save the data
        DataKK::create($request->all());

        // Store KK and nama in session
        session(['kk' => $request->kk]);
        session(['kepala_kk' => $request->nama]);

        // Determine the redirect route based on the kelompok_sasaran value
        $kelompokSasaran = $request->kelompok_sasaran;

        if ($kelompokSasaran == 'Ibu Hamil') {
            return redirect()->route('ibu_hamil.createibuham')->with('success', 'Data KK berhasil ditambahkan!');
        } elseif ($kelompokSasaran == 'Ibu Bersalin dan Lifas') {
            return redirect()->route('ibu_bersalin_nifas.createibuber')->with('success', 'Data KK berhasil ditambahkan!');
        } elseif ($kelompokSasaran == 'Bayi Balita (0 - 6 tahun)') {
            return redirect()->route('kunjungan_rumah_bayi.createbayi')->with('success', 'Data KK berhasil ditambahkan!');
        } elseif ($kelompokSasaran == 'Bayi, Balita Dan Anak Usia Prasekolah (Usia >6 - 71 Bulan)') {
            return redirect()->route('kunjungan_bayi_balita_prasekolah.createprase')->with('success', 'Data KK berhasil ditambahkan!');
        } elseif ($kelompokSasaran == 'Usia Sekolah dan Remaja (>6 - <18 tahun)') {
            return redirect()->route('kunjungan_usia_sekolah.createseko')->with('success', 'Data KK berhasil ditambahkan!');
        } elseif ($kelompokSasaran == 'Usia Dewasa (>18 - 59 tahun)') {
            return redirect()->route('kunjungan_usia_dewasa.createdewasa')->with('success', 'Data KK berhasil ditambahkan!');
        } elseif ($kelompokSasaran == 'Usia Lansia (Usia 60 Tahun Keatas)') {
            return redirect()->route('kunjungan_lansia.createlan')->with('success', 'Data KK berhasil ditambahkan!');
        }

        // Default redirect if no condition is met
        return redirect()->route('datakkpgs.create')->with('success', 'Data KK berhasil ditambahkan!');
    }


    //LINGKUNGAN RUMAH========================================================================================
    // Menampilkan form untuk menambahkan data lingkungan rumah baru
    public function createling(Request $request)
    {
        $kk = $request->session()->get('kk');
        return view('lingkunganrumah.create', compact('kk'));
    }

    public function storeling(Request $request)
    {
        $validatedData = $request->validate([
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

        // Add the authenticated user's ID to the validated data
        $validatedData['id_user'] = Auth::id();

        // Create the Lingkungan_Rumah record with the validated data, including id_user
        Lingkungan_Rumah::create($validatedData);

        // Store the kk value in the session
        session(['kk' => $request->kk]);

        return redirect()->route('datakk.createkkpgs')->with('success', 'Data lingkungan rumah berhasil ditambahkan.');
    }

    //IBU HAMIL========================================================================================
    // Menampilkan form untuk menambahkan data lingkungan rumah baru
    public function createibuham(Request $request)
    {
        $kk = $request->session()->get('kk');
        $nama = $request->session()->get('nama');
        return view('ibu_hamil.create', compact('kk', 'nama'));
    }

    // Menyimpan data lingkungan rumah baru ke dalam database
    public function storeibuham(Request $request)
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
            // Set all fields to null if status is 'Tidak'
            $request->merge([
                'nik' => null,
                'nama' => null,
                'kehamilan_ke' => null,
                'jarak_kehamilan_unit' => null,
                'jarak_kehamilan_bulan' => null,
                'jarak_kehamilan_tahun' => null,
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

        // Combine pregnancy duration based on the user's choice
        $jarakKehamilan = $request->jarak_kehamilan_unit === 'bulan'
            ? $request->jarak_kehamilan_bulan . ' bulan'
            : $request->jarak_kehamilan_tahun . ' tahun';

        $request->merge(['jarak_kehamilan' => $jarakKehamilan]);

        // Add the authenticated user's ID to the validated data
        $validatedData = $request->all();
        $validatedData['id_user'] = Auth::id();

        // Save the data
        Ibu_Hamil::create($validatedData);

        // Store KK and nama in session
        session(['kk' => $request->kk, 'nama' => $request->nama]);

        return redirect()->route('datakk.createkkpgs')->with('success', 'Data ibu hamil berhasil ditambahkan.');
    }

    //IBU BERSALIN DAN NIFAS========================================================================================
    public function createibuber(Request $request)
    {
        $kk = $request->session()->get('kk');
        $nama = $request->session()->get('nama');
        return view('ibu_bersalin_nifas.create', compact('kk', 'nama'));
    }

    public function storeibuber(Request $request)
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
        $validatedData = $request->all();
        $validatedData['id_user'] = Auth::id();
        Ibu_Bersalin_Nifas::create($validatedData);

        session(['kk' => $request->kk, 'nama' => $request->nama]);

        return redirect()->route('datakk.createkkpgs')->with('success', 'Data ibu hamil berhasil ditambahkan.');
    }
    //RUMAH BAYI========================================================================================
    // Menampilkan form untuk menambahkan data lingkungan rumah baru
    public function createbayi(Request $request)
    {
        $kk = $request->session()->get('kk');
        $nama = $request->session()->get('nama');
        return view('kunjungan_rumah_bayi.create', compact('kk', 'nama'));
    }

    // Menyimpan data lingkungan rumah baru ke dalam database
    public function storebayi(Request $request)
    {
        $request->validate([
            'kk' => 'required|string',
            'status' => 'required|string',
        ]);
        if ($request->status === 'Ya') {
            $request->validate([
                'nik' => 'required|string',
                'nama' => 'required|string',
                'tgl_lahir' => 'required|date',
                'tmp_lahir' => 'required|string',
                'gender' => 'required|string',
                'kunjungan' => 'required|string',
                'tgl_kunjungan' => 'required|date',
                'suhu' => 'required|string',
                'buku_kia' => 'required|string',
                'asi' => 'required|string',
                'lila' => 'required|string',
                'tgl_timbang' => 'required|date',
                'tmp_timbang' => 'required|string',
                'petugas_timbang' => 'required|string',
                'hasil_timbang_ukur_bb' => 'required|string',
                'hasil_timbang_ukur_pb' => 'required|string',
                'hasil_timbang_ukur_lk' => 'required|string',
                'jenis_kunjungan_pemeriksaan' => 'required|string',
                'tgl_pemeriksaan' => 'required|date',
                'tmp_pemeriksaan' => 'required|string',
                'petugas_pemeriksaan' => 'required|string',
                'jenis_imunisasi' => 'nullable|string',
                'hepatitis_b_0bln' => 'nullable|date',
                'bcg_0bln' => 'nullable|date',
                'polio_tetes_0bln' => 'nullable|date',
                'bcg_1bln' => 'nullable|date',
                'polio_tetes_1_1bln' => 'nullable|date',
                'dpt_hb_hib_1_2bln' => 'nullable|date',
                'polio_tetes_1_2bln' => 'nullable|date',
                'pcv_1_2bln' => 'nullable|date',
                'rv_1_2bln' => 'nullable|date',
                'dpt_hb_hib_2_3bln' => 'nullable|date',
                'polio_tetes_2_3bln' => 'nullable|date',
                'pcv_2_3bln' => 'nullable|date',
                'rv_2_3bln' => 'nullable|date',
                'dpt_hb_hib_3_4bln' => 'nullable|date',
                'polio_tetes_3_4bln' => 'nullable|date',
                'pcv_3_4bln' => 'nullable|date',
                'rv_3_4bln' => 'nullable|date',
                'edukasi_kunjungan' => 'required|string',
                'napas' => 'required|string',
                'aktifitas' => 'required|string',
                'warna_kulit' => 'required|string',
                'hisapan_bayi' => 'required|string',
                'kejang' => 'required|string',
                'suhu_tubuh' => 'required|string',
                'bab' => 'required|string',
                'jmhdanwarna_kencing' => 'required|string',
                'tali_pusar' => 'required|string',
                'mata' => 'required|string',
                'kulit' => 'required|string',
                'imunisasi' => 'required|string',
                'pengingat_pemeriksaan' => 'required|string',
                'tgl_lapor_nakes' => 'required|date',
            ]);
        } else {
            // Set all fields to '-' if status is 'Tidak'
            $request->merge([
                'nik' => null,
                'nama' => null,
                'tgl_lahir' => null,
                'tmp_lahir' => null,
                'gender' => null,
                'kunjungan' => null,
                'tgl_kunjungan' => null,
                'suhu' => null,
                'buku_kia' => null,
                'asi' => null,
                'tgl_timbang' => null,
                'tmp_timbang' => null,
                'petugas_timbang' => null,
                'hasil_timbang_ukur_bb' => null,
                'hasil_timbang_ukur_pb' => null,
                'hasil_timbang_ukur_lk' => null,
                'jenis_kunjungan_pemeriksaan' => null,
                'tgl_pemeriksaan' => null,
                'tmp_pemeriksaan' => null,
                'petugas_pemeriksaan' => null,
                'jenis_imunisasi' => null,
                'hepatitis_b_0bln' => null,
                'bcg_0bln' => null,
                'polio_tetes_0bln' => null,
                'bcg_1bln' => null,
                'polio_tetes_1_1bln' => null,
                'dpt_hb_hib_1_2bln' => null,
                'polio_tetes_1_2bln' => null,
                'pcv_1_2bln' => null,
                'rv_1_2bln' => null,
                'dpt_hb_hib_2_3bln' => null,
                'polio_tetes_2_3bln' => null,
                'pcv_2_3bln' => null,
                'rv_2_3bln' => null,
                'dpt_hb_hib_3_4bln' => null,
                'polio_tetes_3_4bln' => null,
                'pcv_3_4bln' => null,
                'rv_3_4bln' => null,
                'edukasi_kunjungan' => null,
                'kunjungan2' => null,
                'tgl_kunjungan2' => null,
                'napas' => null,
                'aktifitas' => null,
                'warna_kulit' => null,
                'hisapan_bayi' => null,
                'kejang' => null,
                'suhu_tubuh' => null,
                'bab' => null,
                'jmhdanwarna_kencing' => null,
                'tali_pusar' => null,
                'mata' => null,
                'kulit' => null,
                'imunisasi' => null,
                'pengingat_pemeriksaan' => null,
                'tgl_lapor_nakes' => null,
            ]);
        }
        $validatedData = $request->all();
        $validatedData['id_user'] = Auth::id();
        Kunjungan_Rumah_Bayi::create($validatedData);

        session(['kk' => $request->kk, 'nama' => $request->nama]);

        return redirect()->route('datakk.createkkpgs')->with('success', 'Data ibu hamil berhasil ditambahkan.');
    }
    //BAYI BALITA PRASEKOLAH========================================================================================
    // Menampilkan form untuk menambahkan data lingkungan rumah baru
    public function createprase(Request $request)
    {
        $kk = $request->session()->get('kk');
        $nama = $request->session()->get('nama');
        return view('kunjungan_bayi_balita_prasekolah.create', compact('kk', 'nama'));
    }


    // Menyimpan data lingkungan rumah baru ke dalam database
    public function storeprase(Request $request)
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
                'buku_kia' => 'required|string',
                'tgl_timbang_ukur' => 'required|date',
                'tempat_timbang_ukur' => 'required|string',
                'petugas_timbang_ukur' => 'required|string',
                'bb_hasil_timbang_ukur' => 'required|string',
                'pb_tb_hasil_timbang_ukur' => 'required|string',
                'lk_hasil_timbang_ukur' => 'required|string',
                'jenis_imunisasi' => 'nullable|string',
                'hepatitis_b_0bulan' => 'nullable|date',
                'bcg_0bulan' => 'nullable|date',
                'polio_0bulan' => 'nullable|date',
                'bcg_1bulan' => 'nullable|date',
                'polio_1bulan' => 'nullable|date',
                'dpt_hb_hib_1_2bulan' => 'nullable|date',
                'polio_2_2bulan' => 'nullable|date',
                'pcv_1_2bulan' => 'nullable|date',
                'rv_1_2bulan' => 'nullable|date',
                'dpt_hb_hib_2_3bulan' => 'nullable|date',
                'polio_3_3bulan' => 'nullable|date',
                'pcv_2_3bulan' => 'nullable|date',
                'rv_2_3bulan' => 'nullable|date',
                'dpt_hb_hib_3_4bulan' => 'nullable|date',
                'polio_4_4bulan' => 'nullable|date',
                'polio_suntik_4bulan' => 'nullable|date',
                'rv_3_4bulan' => 'nullable|date',
                'campak_rubelia_9bulan' => 'nullable|date',
                'polio_suntik_2_9bulan' => 'nullable|date',
                'je_10bulan' => 'nullable|date',
                'pv_3_12bulan' => 'nullable|date',
                'dpt_lanjut_1_18bulan' => 'nullable|date',
                'campak_lanjut_18bulan' => 'nullable|date',
                'makanan_pokok' => 'required|string',
                'makanan_protein_hewan' => 'required|string',
                'makanan_protein_nabati' => 'required|string',
                'makanan_lemak' => 'required|string',
                'sayur_buah' => 'required|string',
                'oc_ada' => 'required|string',
                'oc_tgl' => 'nullable|date',
                'kv_jenis' => 'nullable|string',
                'tgl_kv_mulai' => 'nullable|date',
                'tgl_kv_selesai' => 'nullable|date',
                'makan_tambah_ada' => 'required|string',
                'makan_tambah_kepatuhan' => 'required|string',
                'edukasi' => 'required|string',
                'tgl_kunjungan2' => 'nullable|date',
                'napas' => 'required|string',
                'batuk' => 'required|string',
                'diare' => 'required|string',
                'jmh_warna_kencing' => 'required|string',
                'warna_kulit' => 'required|string',
                'aktifitas' => 'required|string',
                'hisapan_bayi' => 'required|string',
                'pemberian_makan' => 'required|string',
                'pengingat_periksa_postu' => 'required|string',
                'lapor_nakes' => 'required|string',
                'created_at' => 'nullable|date',
                'updated_at' => 'nullable|date',
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
                'buku_kia' => null,
                'tgl_timbang_ukur' => null,
                'tempat_timbang_ukur' => null,
                'petugas_timbang_ukur' => null,
                'bb_hasil_timbang_ukur' => null,
                'pb_tb_hasil_timbang_ukur' => null,
                'lk_hasil_timbang_ukur' => null,
                'jenis_imunisasi' => null,
                'hepatitis_b_0bulan' => null,
                'bcg_0bulan' => null,
                'polio_0bulan' => null,
                'bcg_1bulan' => null,
                'polio_1bulan' => null,
                'dpt_hb_hib_1_2bulan' => null,
                'polio_2_2bulan' => null,
                'pcv_1_2bulan' => null,
                'rv_1_2bulan' => null,
                'dpt_hb_hib_2_3bulan' => null,
                'polio_3_3bulan' => null,
                'pcv_2_3bulan' => null,
                'rv_2_3bulan' => null,
                'dpt_hb_hib_3_4bulan' => null,
                'polio_4_4bulan' => null,
                'polio_suntik_4bulan' => null,
                'rv_3_4bulan' => null,
                'campak_rubelia_9bulan' => null,
                'polio_suntik_2_9bulan' => null,
                'je_10bulan' => null,
                'pv_3_12bulan' => null,
                'dpt_lanjut_1_18bulan' => null,
                'campak_lanjut_18bulan' => null,
                'makanan_pokok' => null,
                'makanan_protein_hewan' => null,
                'makanan_protein_nabati' => null,
                'makanan_lemak' => null,
                'sayur_buah' => null,
                'oc_ada' => null,
                'oc_tgl' => null,
                'kv_jenis' => null,
                'tgl_kv_mulai' => null,
                'tgl_kv_selesai' => null,
                'makan_tambah_ada' => null,
                'makan_tambah_kepatuhan' => null,
                'edukasi' => null,
                'napas' => null,
                'batuk' => null,
                'diare' => null,
                'jmh_warna_kencing' => null,
                'warna_kulit' => null,
                'aktifitas' => null,
                'hisapan_bayi' => null,
                'pemberian_makan' => null,
                'pengingat_periksa_postu' => null,
                'lapor_nakes' => null,
            ]);
        }
        $validatedData = $request->all();
        $validatedData['id_user'] = Auth::id();

        Kunjungan_Bayi_Balita_Prasekolah::create($validatedData);

        session(['kk' => $request->kk, 'nama' => $request->nama]);

        return redirect()->route('datakk.createkkpgs')->with('success', 'Data ibu hamil berhasil ditambahkan.');
    }
    //USIA SEKOLAH ========================================================================================
    // Menampilkan form untuk menambahkan data lingkungan rumah baru
    public function createseko(Request $request)
    {
        $kk = $request->session()->get('kk');
        $nama = $request->session()->get('nama');
        return view('kunjungan_usia_sekolah.create', compact('kk', 'nama'));
    }

    // Menyimpan data lingkungan rumah baru ke dalam database
    public function storeseko(Request $request)
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
        $validatedData = $request->all();
        $validatedData['id_user'] = Auth::id();
        Kunjungan_Usia_Sekolah::create($validatedData);

        session(['kk' => $request->kk, 'nama' => $request->nama]);

        return redirect()->route('datakk.createkkpgs')->with('success', 'Data ibu hamil berhasil ditambahkan.');
    }
    //USIA DEWASA ========================================================================================
    // Menampilkan form untuk menambahkan data lingkungan rumah baru
    public function createdewasa(Request $request)
    {
        $kk = $request->session()->get('kk');
        $nama = $request->session()->get('nama');
        return view('kunjungan_usia_dewasa.create', compact('kk', 'nama'));
    }

    // Menyimpan data lingkungan rumah baru ke dalam database
    public function storedewasa(Request $request)
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
        $validatedData = $request->all();
        $validatedData['id_user'] = Auth::id();
        Kunjungan_Usia_Dewasa::create($validatedData);

        session(['kk' => $request->kk, 'nama' => $request->nama]);

        return redirect()->route('datakk.createkkpgs')->with('success', 'Data ibu hamil berhasil ditambahkan.');
    }
    //USIA LANSIA ========================================================================================
    // Menampilkan form untuk menambahkan data lingkungan rumah baru
    public function createlan(Request $request)
    {
        $kk = $request->session()->get('kk');
        $nama = $request->session()->get('nama');
        return view('kunjungan_lansia.create', compact('kk', 'nama'));
    }

    // Menyimpan data lingkungan rumah baru ke dalam database
    public function storelan(Request $request)
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
        $validatedData = $request->all();
        $validatedData['id_user'] = Auth::id();

        // Save the data to the database
        Kunjungan_Lansia::create($validatedData);

        // Store KK and nama in session
        session(['kk' => $request->kk, 'nama' => $request->nama]);

        return redirect()->route('datakk.createkkpgs')->with('success', 'Data ibu hamil berhasil ditambahkan.');
    }
}
