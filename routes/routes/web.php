<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\StarterController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LingkunganRumahController;
use App\Http\Controllers\KunjunganBayiBalitaPrasekolahController;
use App\Http\Controllers\KunjunganUsiaDewasaController;
use App\Http\Controllers\KunjunganTBCController;
use App\Http\Controllers\KunjunganLansiController;
use App\Http\Controllers\KunjunganRumahBayiController;
use App\Http\Controllers\KunjunganUsiaSekolahController;
use App\Http\Controllers\IbuBersalinNifasController;
use App\Http\Controllers\DataKKController;
use App\Http\Controllers\IbuHamilController;
use App\Http\Controllers\JadwalPengumpulanController;
use App\Http\Controllers\TargetDesaController;
use App\Http\Controllers\BasicController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RekapitulasiController;
use App\Http\Controllers\TindakLanjutKunjunganController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PendataanController;
use App\Http\Controllers\ProgresPendataanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/profile', 'ProfileController@index')->name('profile');
// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
//     Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
// });
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit'); // Menambahkan route edit profile
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/jadwal', [JadwalPengumpulanController::class, 'index'])->name('jadwal.index');
    Route::get('/datakk', [DataKKController::class, 'index'])->name('datakk.index');
    Route::get('datakk/show/{id}', [DataKKController::class, 'show'])->name('datakk.show');
    Route::get('/lingkunganrumah', 'App\Http\Controllers\LingkunganRumahController@index')->name('lingkunganrumah.index');
    Route::get('/ibu_hamil', [IbuHamilController::class, 'index'])->name('ibu_hamil.index');
    Route::get('ibu_bersalin_nifas', [IbuBersalinNifasController::class, 'index'])->name('ibu_bersalin_nifas.index');
    Route::get('/kunjungan_rumah_bayi', [KunjunganRumahBayiController::class, 'index'])->name('kunjungan_rumah_bayi.index');
    Route::get('/kunjungan_bayi_balita_prasekolah', [KunjunganBayiBalitaPrasekolahController::class, 'index'])->name('kunjungan_bayi_balita_prasekolah.index');
    Route::get('/kunjungan_usia_sekolah', [KunjunganUsiaSekolahController::class, 'index'])->name('kunjungan_usia_sekolah.index');
    Route::get('/kunjungan_usia_dewasa', [KunjunganUsiaDewasaController::class, 'index'])->name('kunjungan_usia_dewasa.index');
    Route::get('/kunjungan_lansia', [KunjunganLansiController::class, 'index'])->name('kunjungan_lansia.index');
    Route::get('/kunjungan_tbc', [KunjunganTBCController::class, 'index'])->name('kunjungan_tbc.index');
    // show
    Route::get('/kunjungan_tbc/{id}', [KunjunganTBCController::class, 'show'])->name('kunjungan_tbc.show');
    Route::get('/kunjungan_lansia/{id}', [KunjunganLansiController::class, 'show'])->name('kunjungan_lansia.show');
    Route::get('/kunjungan_usia_dewasa/{id}', [KunjunganUsiaDewasaController::class, 'show'])->name('kunjungan_usia_dewasa.show');
    Route::get('/kunjungan_usia_sekolah/{id}', [KunjunganUsiaSekolahController::class, 'show'])->name('kunjungan_usia_sekolah.show');
    Route::get('/kunjungan_bayi_balita_prasekolah/{id}', [KunjunganBayiBalitaPrasekolahController::class, 'show'])->name('kunjungan_bayi_balita_prasekolah.show');
    Route::get('/kunjungan_rumah_bayi/{id}', [KunjunganRumahBayiController::class, 'show'])->name('kunjungan_rumah_bayi.show');
    Route::get('ibu_bersalin_nifas/{id}', [IbuBersalinNifasController::class, 'show'])->name('ibu_bersalin_nifas.show');
    Route::get('/ibu_hamil/{id}', [IbuHamilController::class, 'show'])->name('ibu_hamil.show'); // Added show route
    Route::get('/ibuHamil/pdf{id}', [IbuHamilController::class, 'ibuHamilPDF'])->name('ibuHamil.pdf');
    Route::get('/ibu_hamil/pdf/{id}', [IbuHamilController::class, 'ibuHamilPDF2'])->name('ibuHamil.tbc.pdf2');
    Route::get('/ibubersalinNifas/pdf{id}', [IbuBersalinNifasController::class, 'ibubersalinNifasPDF'])->name('ibubersalinNifas.pdf');
    Route::get('/ibu_bersalin_nifas/pdf/{id}', [IbuBersalinNifasController::class, 'ibubersalinNifasPDF2'])->name('ibubersalinNifas.tbc.pdf2');
    Route::get('/kunjunganrumahBayi/pdf{id}', [KunjunganRumahBayiController::class, 'kunjunganrumahBayiPDF'])->name('kunjunganrumahBayi.pdf');
    Route::get('/kunjungan_rumah_bayi/pdf/{id}', [KunjunganRumahBayiController::class, 'kunjunganrumahBayiPDF2'])->name('kunjunganrumahBayi.tbc.pdf2');
    Route::get('/kunjunganbayibalitaPrasekolah/pdf{id}', [KunjunganBayiBalitaPrasekolahController::class, 'kunjunganbayibalitaPrasekolahtbcPDF'])->name('kunjunganbayibalitaPrasekolah.pdf');
    Route::get('/kunjungan_bayi_balita_prasekolah/pdf/{id}', [KunjunganBayiBalitaPrasekolahController::class, 'kunjunganbayibalitaPrasekolahtbcPDF2'])->name('kunjunganbayibalitaPrasekolah.tbc.pdf2');
    Route::get('/kunjunganusiasekolah/pdf{id}', [KunjunganUsiaSekolahController::class, 'kunjunganusiasekolahPDF'])->name('kunjunganusiasekolah.pdf');
    Route::get('/kunjungan_usia_sekolah/pdf/{id}', [KunjunganUsiaSekolahController::class, 'kunjunganusiasekolahPDF2'])->name('kunjunganusiasekolah.tbc.pdf2');
    Route::get('/kunjunganusiadewasa/pdf{id}', [KunjunganUsiaDewasaController::class, 'kunjunganusiadewasaPDF'])->name('kunjunganusiadewasa.pdf');
    Route::get('/kunjungan_usia_dewasa/pdf/{id}', [KunjunganUsiaDewasaController::class, 'kunjunganusiadewasaPDF2'])->name('kunjunganusiadewasa.tbc.pdf2');
    Route::get('/kunjunganlansia/pdf{id}', [KunjunganLansiController::class, 'kunjunganlansiaPDF'])->name('kunjunganlansia.pdf');
    Route::get('/kunjungan_lansia/pdf/{id}', [KunjunganLansiController::class, 'kunjunganlansiaPDF2'])->name('kunjunganlansia.tbc.pdf2');
    Route::get('kunjungantbc/pdf/{id}', [KunjunganTBCController::class, 'kunjungantbcPDF'])->name('kunjungantbc.pdf');
    Route::get('/kunjungan_tbc/pdf/{id}', [KunjunganTBCController::class, 'kunjungantbcPDF2'])->name('kunjungan.tbc.pdf2');
    Route::get('/lingkunganrumah/pdf/{id}', [LingkunganRumahController::class, 'lingkunganRumahPDF2'])->name('lingkunganRumah.tbc.pdf2');
    Route::get('/pendataan-kk/{kk}/pdf', [DataKKController::class, 'pendataan_KKPDF'])->name('pendataan.kk.pdf');
    Route::get('/lingkungan-rumah', [LingkunganRumahController::class, 'index'])->name('lingkungan_rumah.index');

    // Route untuk menampilkan semua data kunjungan
    Route::get('/tindak_lanjut_kunjungan', [TindakLanjutKunjunganController::class, 'index'])
        ->name('tindak_lanjut_kunjungan.index');

    // Route untuk menampilkan form tambah kunjungan
    Route::get('/tindak_lanjut_kunjungan/create', [TindakLanjutKunjunganController::class, 'create'])
        ->name('tindak_lanjut_kunjungan.create');

    // Route untuk menyimpan data kunjungan baru
    Route::post('/tindak_lanjut_kunjungan/store', [TindakLanjutKunjunganController::class, 'store'])
        ->name('tindak_lanjut_kunjungan.store');

    // Route untuk menampilkan detail kunjungan
    Route::get('/tindak_lanjut_kunjungan/{id}', [TindakLanjutKunjunganController::class, 'show'])
        ->name('tindak_lanjut_kunjungan.show');

    // Route untuk menampilkan form edit kunjungan
    Route::get('/tindak_lanjut_kunjungan/{id}/edit', [TindakLanjutKunjunganController::class, 'edit'])
        ->name('tindak_lanjut_kunjungan.edit');

    // Route untuk menyimpan perubahan pada kunjungan yang di-edit
    Route::put('/tindak_lanjut_kunjungan/{id}', [TindakLanjutKunjunganController::class, 'update'])
        ->name('tindak_lanjut_kunjungan.update');

    // Route untuk menghapus kunjungan
    Route::delete('/tindak_lanjut_kunjungan/{id}', [TindakLanjutKunjunganController::class, 'destroy'])
        ->name('tindak_lanjut_kunjungan.destroy');
    Route::post('/check-nik', [TindakLanjutKunjunganController::class, 'checkNik'])->name('check-nik');
    Route::get('/tindak-lanjut-kunjungan/pdf/{id}', [TindakLanjutKunjunganController::class, 'tindakLanjutKunjunganPDF'])->name('tindak_lanjut_kunjungan.pdf');
    Route::get('/tindak-lanjut-kunjungan/export-pdf', [TindakLanjutKunjunganController::class, 'exportAllPDF'])
        ->name('tindak_lanjut_kunjungan.export_pdf');
    Route::get('/export-all-pdf', [TindakLanjutKunjunganController::class, 'exportAllPDF2'])->name('tindak_lanjut_kunjungan.exportAllPDF2');
    Route::get('/export-all-pdf', [TindakLanjutKunjunganController::class, 'exportAllPDF3'])->name('tindak_lanjut_kunjungan.exportAllPDF3');
    Route::get('/export-pdf', 'TindakLanjutKunjunganController@exportAllPDF3')->name('export-pdf');

    // export excel
    Route::get('/kunjungan_tbc/export', [KunjunganTBCController::class, 'export'])->name('kunjungan_tbc.export');
    Route::get('/jadwalpengumpulan', [JadwalPengumpulanController::class, 'index'])->name('jadwalpengumpulan.index');
    Route::get('/datakk', [DataKKController::class, 'index'])->name('datakk.index');
    Route::get('/datakk/{id}', [DataKKController::class, 'show'])->name('datakk.show');
    Route::get('/ibu-hamil', [IbuHamilController::class, 'index'])->name('ibu_hamil.index');
    Route::get('/ibu-hamil/{id}', [IbuHamilController::class, 'show'])->name('ibu_hamil.show');
    Route::get('/ibu-bersalin-nifas/export', [IbuBersalinNifasController::class, 'index'])->name('ibu_bersalin_nifas.export');
    Route::get('/ibu-bersalin-nifas/{id}/export', [IbuBersalinNifasController::class, 'show'])->name('ibu_bersalin_nifas.show_export');

    Route::get('/kunjungan-rumah-bayi/export', [KunjunganRumahBayiController::class, 'index'])->name('kunjungan_rumah_bayi.export');
    Route::get('/kunjungan-rumah-bayi/{id}/export', [KunjunganRumahBayiController::class, 'show'])->name('kunjungan_rumah_bayi.show_export');

    Route::get('/kunjungan-bayi-balita-prasekolah/export', [KunjunganBayiBalitaPrasekolahController::class, 'index'])->name('kunjungan_bayi_balita_prasekolah.export');
    Route::get('/kunjungan-bayi-balita-prasekolah/{id}/export', [KunjunganBayiBalitaPrasekolahController::class, 'show'])->name('kunjungan_bayi_balita_prasekolah.show_export');
    Route::get('/kunjungan-usia-sekolah/export', [KunjunganUsiaSekolahController::class, 'index'])->name('kunjungan_usia_sekolah.export');
    Route::get('/kunjungan-usia-sekolah/{id}/export', [KunjunganUsiaSekolahController::class, 'show'])->name('kunjungan_usia_sekolah.show_export');
    Route::get('/kunjungan-usia-dewasa/export', [KunjunganUsiaDewasaController::class, 'index'])->name('kunjungan_usia_dewasa.export');
    Route::get('/kunjungan-usia-dewasa/{id}/export', [KunjunganUsiaDewasaController::class, 'show'])->name('kunjungan_usia_dewasa.show_export');
    Route::get('/kunjungan-lansia/export', [KunjunganLansiController::class, 'index'])->name('kunjungan_lansia.export');
    Route::get('/kunjungan-lansia/{id}/export', [KunjunganLansiController::class, 'show'])->name('kunjungan_lansia.show_export');
    Route::get('/tindak-lanjut-kunjungan/export', [TindakLanjutKunjunganController::class, 'index'])->name('tindak_lanjut_kunjungan.export');
    Route::get('/rekapitulasi/export', [RekapitulasiController::class, 'index'])->name('rekapitulasi.export');
});




Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/blank', function () {
    return view('blank');
})->name('blank');

Route::get('/', function () {
    return view('auth.login');
});

// Auth::routes();
// Custum Authenticate 
Route::get('/login', [AuthController::class, 'showlogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showregister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// // admin======================================================================================================================
Route::middleware(['checkrole:admin'])->group(function () {

    Route::get('/pendataan', [PendataanController::class, 'index'])->name('pendataan.index');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/starter', [StarterController::class, 'index'])->name('starter');
    Route::get('/get-target-by-desa', [StarterController::class, 'getTargetByDesa'])->name('getTargetByDesa');
    // Route di web.php
    Route::get('/getDataByDesa', [StarterController::class, 'getTargetByDesa']);
    // Route::resource('basic', BasicController::class);
    // Route::post('/users/{user}/reset-password', [BasicController::class, 'resetPassword'])->name('basic.reset-password');
    Route::get('/users', [BasicController::class, 'index'])->name('basic.index');
    Route::get('/users/create', [BasicController::class, 'create'])->name('basic.create');
    Route::post('/users', [BasicController::class, 'store'])->name('basic.store');
    Route::get('/users/{basic}/edit', [BasicController::class, 'edit'])->name('basic.edit');
    Route::put('/users/{basic}', [BasicController::class, 'update'])->name('basic.update');
    Route::delete('/users/{basic}', [BasicController::class, 'destroy'])->name('basic.destroy');
    Route::post('/users/{id}/reset-password', [BasicController::class, 'resetPassword'])->name('basic.reset-password');


    // TARGET DESA
    Route::get('/target-desa', [TargetDesaController::class, 'index'])->name('target-desa.index');
    Route::get('/target-desa/create', [TargetDesaController::class, 'create'])->name('target-desa.create');
    Route::post('/target-desa', [TargetDesaController::class, 'store'])->name('target-desa.store');
    Route::get('/target-desa/{id}/edit', [TargetDesaController::class, 'edit'])->name('target-desa.edit');
    Route::put('/target-desa/{id}', [TargetDesaController::class, 'update'])->name('target-desa.update');
    Route::delete('/target-desa/{id}', [TargetDesaController::class, 'destroy'])->name('target-desa.destroy');
    // 
    // rekapitulasi
    Route::get('/rekapitulasi-kunjungan-rumah', [RekapitulasiController::class, 'index'])->name('rekapitulasi_kunjungan_rumah.index');
    Route::get('/rekapitulasi', [RekapitulasiController::class, 'index'])->name('rekapitulasi.index');
    Route::get('/rekapitulasi_kunjungan_rumah/pdf', [RekapitulasiController::class, 'exportAllPDF'])->name('rekapitulasi_kunjungan_rumah.pdf');
    // Route::get('/export-all-pdf', [RekapitulasiController::class, 'exportAllPDF'])->name('export.all.pdf');

    // 
    // Route untuk menampilkan semua data kunjungan

});

Route::middleware(['checkrole:kader'])->group(function () {

    //JADWAL PENGUMPULAN DATA

    Route::get('/jadwal/create', [JadwalPengumpulanController::class, 'create'])->name('jadwal.create');
    Route::post('/jadwal', [JadwalPengumpulanController::class, 'store'])->name('jadwal.store');
    Route::get('/jadwal/{jadwal}/edit', [JadwalPengumpulanController::class, 'edit'])->name('jadwal.edit');
    Route::put('/jadwal/{jadwal}', [JadwalPengumpulanController::class, 'update'])->name('jadwal.update');
    Route::delete('/jadwal/{jadwal}', [JadwalPengumpulanController::class, 'destroy'])->name('jadwal.destroy');
    Route::get('/jadwal/get-related-data/{puskesmas}', [JadwalPengumpulanController::class, 'getRelatedData']);
    Route::get('/getDesaByPuskesmas', [JadwalPengumpulanController::class, 'getDesaByPuskesmas']);


    // 
    // DATA_KELUARGA
    Route::get('datakk/createvalidate', 'App\Http\Controllers\DataKKController@createvalidate')->name('datakk.createvalidate');
    Route::post('datakk/storevalidate', 'App\Http\Controllers\DataKKController@storevalidate')->name('datakk.storevalidate');
    Route::post('datakk/checkKK', 'App\Http\Controllers\DataKKController@checkKK')->name('datakk.checkKK');
    Route::get('/datakk/create', [DataKKController::class, 'create'])->name('datakk.create');
    Route::post('/datakk/store', [DataKKController::class, 'store'])->name('datakk.store');
    Route::post('/datakk/store3', [DataKKController::class, 'store3'])->name('datakk.store3');
    Route::get('/createkk', 'DataKKController@create1')->name('datakk.createkk');
    Route::post('/datakk/store', [DataKKController::class, 'store'])->name('datakk.store');
    Route::get('/datakk/{id}/edit', [DataKKController::class, 'edit'])->name('datakk.edit');
    Route::get('/pendataan_kk/{id}/editdetail', [DataKKController::class, 'edit2'])->name('pendataan_kk.editdetail');
    Route::put('/datakk/{id}/update', [DataKKController::class, 'update'])->name('datakk.update');
    Route::put('/pendataan_kk/{id}/updatedetail', [DataKKController::class, 'update2'])->name('pendataan_kk.updatedetail');
    Route::delete('/datakk/{id}/delete', [DataKKController::class, 'destroy'])->name('datakk.destroy');
    Route::delete('/datakk/{id}', [DataKKController::class, 'destroy2'])->name('datakk.destroy2');
    Route::get('/pendataan_kk/{id}/detail', [DataKKController::class, 'show'])->name('pendataan_kk.detail');
    Route::get('/pendataan_kk/{id}/createdetail', [DataKKController::class, 'create2'])->name('pendataan_kk.createdetail');

    Route::post('/pendataan_kk/store2', [DataKKController::class, 'store2'])->name('pendataan_kk.store2');
    // 
    // LINGKUNGAN RUMAH

    Route::get('/lingkunganrumah/create', 'App\Http\Controllers\LingkunganRumahController@create')->name('lingkunganrumah.create');
    Route::post('/lingkunganrumah/store', 'App\Http\Controllers\LingkunganRumahController@store')->name('lingkunganrumah.store');
    Route::get('/lingkunganrumah/{id}/edit', 'App\Http\Controllers\LingkunganRumahController@edit')->name('lingkunganrumah.edit');
    Route::put('/lingkunganrumah/{id}', 'App\Http\Controllers\LingkunganRumahController@update')->name('lingkunganrumah.update');
    Route::delete('/lingkunganrumah/{id}', 'App\Http\Controllers\LingkunganRumahController@destroy')->name('lingkunganrumah.destroy');



    Route::get('lingkunganrumah/createvalidate', [LingkunganRumahController::class, 'createvalidate'])->name('lingkunganrumah.createvalidate');

    // Route untuk menyimpan data validasi
    Route::post('lingkunganrumah/storevalidate', [LingkunganRumahController::class, 'storevalidate'])->name('lingkunganrumah.storevalidate');

    // Route untuk memeriksa KK menggunakan AJAX
    Route::post('lingkunganrumah/checkKK', [LingkunganRumahController::class, 'checkKK'])->name('lingkunganrumah.checkKK');
    // 


    // IBU HAMIL
    Route::get('ibu_hamilinput/createvalidate', 'App\Http\Controllers\IbuHamilController@createvalidate')->name('ibu_hamil.createvalidate');
    Route::post('ibu_hamilinput/storevalidate', 'App\Http\Controllers\IbuHamilController@storevalidate')->name('ibu_hamil.storevalidate');
    Route::post('ibu_hamilinput/checkKK', 'App\Http\Controllers\IbuHamilController@checkKK')->name('ibu_hamil.checkKK');

    Route::get('/ibu_hamilinput/create', [IbuHamilController::class, 'create'])->name('ibu_hamil.create');
    Route::post('/ibu_hamil', [IbuHamilController::class, 'store'])->name('ibu_hamil.store');
    Route::get('/ibu_hamil/{id}/edit', [IbuHamilController::class, 'edit'])->name('ibu_hamil.edit');
    Route::put('/ibu_hamil/{id}', [IbuHamilController::class, 'update'])->name('ibu_hamil.update');
    Route::delete('/ibu_hamil/{id}', [IbuHamilController::class, 'destroy'])->name('ibu_hamil.destroy');

    Route::post('/ibu_hamil/store', [IbuHamilController::class, 'store2'])->name('ibu_hamil.store2');
    Route::get('/ibuhamil/create-detail/{kk}', [IbuHamilController::class, 'createDetail'])->name('ibu_hamil.create_detail');
    Route::get('/ibu_hamil/create/{id?}', [IbuHamilController::class, 'create2'])->name('ibu_hamil.createdetail');
    Route::get('/ibu_hamil/{id}/editdetail', [IbuHamilController::class, 'edit2'])->name('ibu_hamil.editdetail');
    Route::put('/ibu_hamil/{id}/updatedetail', [IbuHamilController::class, 'update2'])->name('ibu_hamil.updatedetail');
    Route::delete('/ibu_hamil/{id}/destroy', [IbuHamilController::class, 'destroy2'])->name('ibu_hamil.destroy2');





    // 
    // ibu_bersalin_nifas

    Route::get('/ibu_bersalin_nifasinput/createvalidate', [IbuBersalinNifasController::class, 'createvalidate'])->name('ibu_bersalin_nifas.createvalidate');
    Route::post('/ibu_bersalin_nifasinput/storevalidate', [IbuBersalinNifasController::class, 'storevalidate'])->name('ibu_bersalin_nifas.storevalidate');
    Route::post('/ibu_bersalin_nifasinput/checkKK', [IbuBersalinNifasController::class, 'checkKK'])->name('ibu_bersalin_nifas.checkKK');


    Route::get('ibu_bersalin_nifasinput/create', [IbuBersalinNifasController::class, 'create'])->name('ibu_bersalin_nifas.create');
    Route::post('ibu_bersalin_nifas', [IbuBersalinNifasController::class, 'store'])->name('ibu_bersalin_nifas.store');

    Route::get('ibu_bersalin_nifas/{id}/edit', [IbuBersalinNifasController::class, 'edit'])->name('ibu_bersalin_nifas.edit');
    Route::put('ibu_bersalin_nifas/{id}', [IbuBersalinNifasController::class, 'update'])->name('ibu_bersalin_nifas.update');
    Route::delete('ibu_bersalin_nifas/{id}', [IbuBersalinNifasController::class, 'destroy'])->name('ibu_bersalin_nifas.destroy');
    Route::get('/ibu_bersalin_nifas/create/{id?}', [IbuBersalinNifasController::class, 'create2'])->name('ibu_bersalin_nifas.createdetail');
    Route::post('/ibu_bersalin_nifas/store', [IbuBersalinNifasController::class, 'store2'])->name('ibu_bersalin_nifas.store2');
    Route::get('ibu_bersalin_nifas/edit2/{id}', [IbuBersalinNifasController::class, 'edit2'])->name('ibu_bersalin_nifas.editdetail');
    Route::put('ibu_bersalin_nifas/update2/{id}', [IbuBersalinNifasController::class, 'update2'])->name('ibu_bersalin_nifas.updatedetail');
    Route::delete('ibu_bersalin_nifas/destroy2/{id}', [IbuBersalinNifasController::class, 'destroy2'])->name('ibu_bersalin_nifas.destroy2');

    // 

    // KUNJUNGAN RUMAH BAYI
    // Route untuk menampilkan daftar data kunjungan rumah bayi


    Route::get('/kunjungan_rumah_bayiinput/createvalidate', [KunjunganRumahBayiController::class, 'createvalidate'])->name('kunjungan_rumah_bayi.createvalidate');
    Route::post('/kunjungan_rumah_bayiinput/storevalidate', [KunjunganRumahBayiController::class, 'storevalidate'])->name('kunjungan_rumah_bayi.storevalidate');
    Route::post('/kunjungan_rumah_bayiinput/checkKK', [KunjunganRumahBayiController::class, 'checkKK'])->name('kunjungan_rumah_bayi.checkKK');


    Route::get('/kunjungan_rumah_bayiinput/create', [KunjunganRumahBayiController::class, 'create'])->name('kunjungan_rumah_bayi.create');
    Route::post('/kunjungan_rumah_bayi', [KunjunganRumahBayiController::class, 'store'])->name('kunjungan_rumah_bayi.store');

    Route::get('/kunjungan_rumah_bayi/create2/{id?}', [KunjunganRumahBayiController::class, 'create2'])->name('kunjungan_rumah_bayi.createdetail');
    Route::post('/kunjungan_rumah_bayi/store2', [KunjunganRumahBayiController::class, 'store2'])->name('kunjungan_rumah_bayi.store2');
    Route::get('/kunjungan_rumah_bayi/{id}/edit', [KunjunganRumahBayiController::class, 'edit'])->name('kunjungan_rumah_bayi.edit');
    Route::put('/kunjungan_rumah_bayi/{id}', [KunjunganRumahBayiController::class, 'update'])->name('kunjungan_rumah_bayi.update');
    Route::get('/kunjungan_rumah_bayi/edit2/{id}', [KunjunganRumahBayiController::class, 'edit2'])->name('kunjungan_rumah_bayi.editdetail');
    Route::put('/kunjungan_rumah_bayi/update2/{id}', [KunjunganRumahBayiController::class, 'update2'])->name('kunjungan_rumah_bayi.updatedetail');
    Route::delete('/kunjungan_rumah_bayi/{id}', [KunjunganRumahBayiController::class, 'destroy'])->name('kunjungan_rumah_bayi.destroy');
    Route::delete('/kunjungan_rumah_bayi/destroy2/{id}', [KunjunganRumahBayiController::class, 'destroy2'])->name('kunjungan_rumah_bayi.destroy2');

    // 

    // KUNJUNGAN BAYI, BALITA DAN PRASEKOLAH
    Route::get('/kunjungan_bayi_balita_prasekolahinput/createvalidate', [KunjunganBayiBalitaPrasekolahController::class, 'createvalidate'])->name('kunjungan_bayi_balita_prasekolah.createvalidate');
    Route::post('/kunjungan_bayi_balita_prasekolahinput/storevalidate', [KunjunganBayiBalitaPrasekolahController::class, 'storevalidate'])->name('kunjungan_bayi_balita_prasekolah.storevalidate');
    Route::post('/kunjungan_bayi_balita_prasekolahinput/checkKK', [KunjunganBayiBalitaPrasekolahController::class, 'checkKK'])->name('kunjungan_bayi_balita_prasekolah.checkKK');


    Route::get('/kunjungan_bayi_balita_prasekolahinput/create', [KunjunganBayiBalitaPrasekolahController::class, 'create'])->name('kunjungan_bayi_balita_prasekolah.create');
    Route::post('/kunjungan_bayi_balita_prasekolah', [KunjunganBayiBalitaPrasekolahController::class, 'store'])->name('kunjungan_bayi_balita_prasekolah.store');

    Route::get('/kunjungan_bayi_balita_prasekolah/create2/{id?}', [KunjunganBayiBalitaPrasekolahController::class, 'create2'])->name('kunjungan_bayi_balita_prasekolah.createdetail');
    Route::post('/kunjungan_bayi_balita_prasekolah/store2', [KunjunganBayiBalitaPrasekolahController::class, 'store2'])->name('kunjungan_bayi_balita_prasekolah.store2');
    Route::get('/kunjungan_bayi_balita_prasekolah/{id}/edit', [KunjunganBayiBalitaPrasekolahController::class, 'edit'])->name('kunjungan_bayi_balita_prasekolah.edit');
    Route::put('/kunjungan_bayi_balita_prasekolah/{id}', [KunjunganBayiBalitaPrasekolahController::class, 'update'])->name('kunjungan_bayi_balita_prasekolah.update');
    Route::get('/kunjungan_bayi_balita_prasekolah/edit2/{id}', [KunjunganBayiBalitaPrasekolahController::class, 'edit2'])->name('kunjungan_bayi_balita_prasekolah.editdetail');
    Route::put('/kunjungan_bayi_balita_prasekolah/update2/{id}', [KunjunganBayiBalitaPrasekolahController::class, 'update2'])->name('kunjungan_bayi_balita_prasekolah.updatedetail');
    Route::delete('/kunjungan_bayi_balita_prasekolah/{id}', [KunjunganBayiBalitaPrasekolahController::class, 'destroy'])->name('kunjungan_bayi_balita_prasekolah.destroy');
    Route::delete('/kunjungan_bayi_balita_prasekolah/destroy2/{id}', [KunjunganBayiBalitaPrasekolahController::class, 'destroy2'])->name('kunjungan_bayi_balita_prasekolah.destroy2');

    // 

    // KUNJUNGAN USIA SEKOLAH
    Route::get('/kunjungan_usia_sekolahinput/createvalidate', [KunjunganUsiaSekolahController::class, 'createvalidate'])->name('kunjungan_usia_sekolah.createvalidate');
    Route::post('/kunjungan_usia_sekolahinput/storevalidate', [KunjunganUsiaSekolahController::class, 'storevalidate'])->name('kunjungan_usia_sekolah.storevalidate');
    Route::post('/kunjungan_usia_sekolahinput/checkKK', [KunjunganUsiaSekolahController::class, 'checkKK'])->name('kunjungan_usia_sekolah.checkKK');


    Route::get('/kunjungan_usia_sekolahinput/create', [KunjunganUsiaSekolahController::class, 'create'])->name('kunjungan_usia_sekolah.create');

    Route::post('/kunjungan_usia_sekolah', [KunjunganUsiaSekolahController::class, 'store'])->name('kunjungan_usia_sekolah.store');
    Route::get('/kunjungan_usia_sekolah/create2/{id?}', [KunjunganUsiaSekolahController::class, 'create2'])->name('kunjungan_usia_sekolah.createdetail');
    Route::post('/kunjungan_usia_sekolah/store2', [KunjunganUsiaSekolahController::class, 'store2'])->name('kunjungan_usia_sekolah.store2');
    Route::get('/kunjungan_usia_sekolah/{id}/edit', [KunjunganUsiaSekolahController::class, 'edit'])->name('kunjungan_usia_sekolah.edit');
    Route::put('/kunjungan_usia_sekolah/{id}', [KunjunganUsiaSekolahController::class, 'update'])->name('kunjungan_usia_sekolah.update');
    Route::get('/kunjungan_usia_sekolah/edit2/{id}', [KunjunganUsiaSekolahController::class, 'edit2'])->name('kunjungan_usia_sekolah.editdetail');
    Route::put('/kunjungan_usia_sekolah/update2/{id}', [KunjunganUsiaSekolahController::class, 'update2'])->name('kunjungan_usia_sekolah.updatedetail');
    Route::delete('/kunjungan_usia_sekolah/{id}', [KunjunganUsiaSekolahController::class, 'destroy'])->name('kunjungan_usia_sekolah.destroy');
    Route::delete('/kunjungan_usia_sekolah/destroy2/{id}', [KunjunganUsiaSekolahController::class, 'destroy2'])->name('kunjungan_usia_sekolah.destroy2');

    // 

    // KUNJUNGAN USIA DEWASA
    Route::get('/kunjungan_usia_dewasainput/createvalidate', [KunjunganUsiaDewasaController::class, 'createvalidate'])->name('kunjungan_usia_dewasa.createvalidate');
    Route::post('/kunjungan_usia_dewasainput/storevalidate', [KunjunganUsiaDewasaController::class, 'storevalidate'])->name('kunjungan_usia_dewasa.storevalidate');
    Route::post('/kunjungan_usia_dewasainput/checkKK', [KunjunganUsiaDewasaController::class, 'checkKK'])->name('kunjungan_usia_dewasa.checkKK');


    Route::get('/kunjungan_usia_dewasainput/create', [KunjunganUsiaDewasaController::class, 'create'])->name('kunjungan_usia_dewasa.create');

    Route::post('/kunjungan_usia_dewasa', [KunjunganUsiaDewasaController::class, 'store'])->name('kunjungan_usia_dewasa.store');
    Route::get('/kunjungan_usia_dewasa/create2/{id?}', [KunjunganUsiaDewasaController::class, 'create2'])->name('kunjungan_usia_dewasa.createdetail');
    Route::post('/kunjungan_usia_dewasa/store2', [KunjunganUsiaDewasaController::class, 'store2'])->name('kunjungan_usia_dewasa.store2');
    Route::get('/kunjungan_usia_dewasa/{id}/edit', [KunjunganUsiaDewasaController::class, 'edit'])->name('kunjungan_usia_dewasa.edit');
    Route::put('/kunjungan_usia_dewasa/{id}', [KunjunganUsiaDewasaController::class, 'update'])->name('kunjungan_usia_dewasa.update');
    Route::get('/kunjungan_usia_dewasa/edit2/{id}', [KunjunganUsiaDewasaController::class, 'edit2'])->name('kunjungan_usia_dewasa.editdetail');
    Route::put('/kunjungan_usia_dewasa/update2/{id}', [KunjunganUsiaDewasaController::class, 'update2'])->name('kunjungan_usia_dewasa.updatedetail');
    Route::delete('/kunjungan_usia_dewasa/{id}', [KunjunganUsiaDewasaController::class, 'destroy'])->name('kunjungan_usia_dewasa.destroy');
    Route::delete('/kunjungan_usia_dewasa/destroy2/{id}', [KunjunganUsiaDewasaController::class, 'destroy2'])->name('kunjungan_usia_dewasa.destroy2');

    // 

    // KUNJUNGAN USIA LANSIA
    Route::get('/kunjungan_lansiainput/createvalidate', [KunjunganLansiController::class, 'createvalidate'])->name('kunjungan_lansia.createvalidate');
    Route::post('/kunjungan_lansiainput/storevalidate', [KunjunganLansiController::class, 'storevalidate'])->name('kunjungan_lansia.storevalidate');
    Route::post('/kunjungan_lansiainput/checkKK', [KunjunganLansiController::class, 'checkKK'])->name('kunjungan_lansia.checkKK');


    Route::get('/kunjungan_lansiainput/create', [KunjunganLansiController::class, 'create'])->name('kunjungan_lansia.create');

    Route::post('/kunjungan_lansia', [KunjunganLansiController::class, 'store'])->name('kunjungan_lansia.store');
    Route::get('/kunjungan_lansia/create2/{id?}', [KunjunganLansiController::class, 'create2'])->name('kunjungan_lansia.createdetail');
    Route::post('/kunjungan_lansia/store2', [KunjunganLansiController::class, 'store2'])->name('kunjungan_lansia.store2');
    Route::get('/kunjungan_lansia/{id}/edit', [KunjunganLansiController::class, 'edit'])->name('kunjungan_lansia.edit');
    Route::put('/kunjungan_lansia/{id}', [KunjunganLansiController::class, 'update'])->name('kunjungan_lansia.update');
    Route::get('/kunjungan_lansia/edit2/{id}', [KunjunganLansiController::class, 'edit2'])->name('kunjungan_lansia.editdetail');
    Route::put('/kunjungan_lansia/update2/{id}', [KunjunganLansiController::class, 'update2'])->name('kunjungan_lansia.updatedetail');
    Route::delete('/kunjungan_lansia/{id}', [KunjunganLansiController::class, 'destroy'])->name('kunjungan_lansia.destroy');
    Route::delete('/kunjungan_lansia/destroy2/{id}', [KunjunganLansiController::class, 'destroy2'])->name('kunjungan_lansia.destroy2');

    // 

    // KUNJUNGAN TBC
    Route::get('/kunjungan_tbcinput/createvalidate', [KunjunganTBCController::class, 'createvalidate'])->name('kunjungan_tbc.createvalidate');
    Route::post('/kunjungan_tbcinput/storevalidate', [KunjunganTBCController::class, 'storevalidate'])->name('kunjungan_tbc.storevalidate');
    Route::post('/kunjungan_tbcinput/checkKK', [KunjunganTBCController::class, 'checkKK'])->name('kunjungan_tbc.checkKK');


    Route::get('/kunjungan_tbcinput/create', [KunjunganTBCController::class, 'create'])->name('kunjungan_tbc.create');

    Route::post('/kunjungan_tbc', [KunjunganTBCController::class, 'store'])->name('kunjungan_tbc.store');
    Route::get('/kunjungan_tbc/create2/{id?}', [KunjunganTBCController::class, 'create2'])->name('kunjungan_tbc.createdetail');
    Route::post('/kunjungan_tbc/store2', [KunjunganTBCController::class, 'store2'])->name('kunjungan_tbc.store2');
    Route::get('/kunjungan_tbc/{id}/edit', [KunjunganTBCController::class, 'edit'])->name('kunjungan_tbc.edit');
    Route::put('/kunjungan_tbc/{id}', [KunjunganTBCController::class, 'update'])->name('kunjungan_tbc.update');
    Route::get('/kunjungan_tbc/edit2/{id}', [KunjunganTBCController::class, 'edit2'])->name('kunjungan_tbc.editdetail');
    Route::put('/kunjungan_tbc/update2/{id}', [KunjunganTBCController::class, 'update2'])->name('kunjungan_tbc.updatedetail');
    Route::delete('/kunjungan_tbc/{id}', [KunjunganTBCController::class, 'destroy'])->name('kunjungan_tbc.destroy');
    Route::delete('/kunjungan_tbc/destroy2/{id}', [KunjunganTBCController::class, 'destroy2'])->name('kunjungan_tbc.destroy2');
    // Route::get('/kunjungan-tbc-pdf', [KunjunganTBCController::class, 'kunjungantbcPDF'])->name('kunjungan.tbc.pdf');

    // 
    // 
    // PROGRES PENDATAAN

    Route::get('createjad', [ProgresPendataanController::class, 'createjad'])->name('jadwal.createjad');

    Route::post('storejad', [ProgresPendataanController::class, 'storejad'])->name('jadwal.storejad');
    Route::get('desa', [ProgresPendataanController::class, 'getDesaByPuskesmasjad'])->name('jadwal.getDesaByPuskesmasjad');
    Route::get('createkkpgs', [ProgresPendataanController::class, 'createkkpgs'])->name('datakk.createkkpgs');
    Route::post('storekkpgs', [ProgresPendataanController::class, 'storekkpgs'])->name('datakk.storekkpgs');
    Route::get('createling', [ProgresPendataanController::class, 'createling'])->name('lingkunganrumah.createling');
    Route::post('storeling', [ProgresPendataanController::class, 'storeling'])->name('lingkunganrumah.storeling');
    Route::get('createibuham', [ProgresPendataanController::class, 'createibuham'])->name('ibu_hamil.createibuham');
    Route::post('storeibuham', [ProgresPendataanController::class, 'storeibuham'])->name('ibu_hamil.storeibuham');
    Route::get('createibuber', [ProgresPendataanController::class, 'createibuber'])->name('ibu_bersalin_nifas.createibuber');
    Route::post('storeibuber', [ProgresPendataanController::class, 'storeibuber'])->name('ibu_bersalin_nifas.storeibuber');
    Route::get('createbayi', [ProgresPendataanController::class, 'createbayi'])->name('kunjungan_rumah_bayi.createbayi');
    Route::post('storebayi', [ProgresPendataanController::class, 'storebayi'])->name('kunjungan_rumah_bayi.storebayi');
    Route::get('createprase', [ProgresPendataanController::class, 'createprase'])->name('kunjungan_bayi_balita_prasekolah.createprase');
    Route::post('storeprase', [ProgresPendataanController::class, 'storeprase'])->name('kunjungan_bayi_balita_prasekolah.storeprase');
    Route::get('createseko', [ProgresPendataanController::class, 'createseko'])->name('kunjungan_usia_sekolah.createseko');
    Route::post('storeseko', [ProgresPendataanController::class, 'storeseko'])->name('kunjungan_usia_sekolah.storeseko');
    Route::get('createdewasa', [ProgresPendataanController::class, 'createdewasa'])->name('kunjungan_usia_dewasa.createdewasa');
    Route::post('storedewasa', [ProgresPendataanController::class, 'storedewasa'])->name('kunjungan_usia_dewasa.storedewasa');
    Route::get('createlan', [ProgresPendataanController::class, 'createlan'])->name('kunjungan_lansia.createlan');
    Route::post('storelan', [ProgresPendataanController::class, 'storelan'])->name('kunjungan_lansia.storelan');
});



// Route::get('/login', 'AuthController@showlogin')->name('login');
// Route::post('/login', 'AuthController@login')->name('login');
// Route::get('/register', 'AuthController@showregister')->name('register');
// Route::post('/register', 'AuthController@register')->name('register');
// Route::post('/logout', 'AuthController@logout')->name('logout');



// =============================================
