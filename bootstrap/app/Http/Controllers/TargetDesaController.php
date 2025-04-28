<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TargetDesa;

class TargetDesaController extends Controller
{
    // Menampilkan daftar target desa
    public function index()
    {

        $targetDesas = TargetDesa::paginate(10);

        return view('targetdesa.list', compact('targetDesas'));
    }

    // Menampilkan form untuk menambahkan target desa baru
    public function create()
    {
        return view('targetdesa.create');
    }

    // Menyimpan target desa baru ke dalam database
    public function store(Request $request)
    {
        $request->validate([
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'puskesmas' => 'required',
            'target_penduduk' => 'required',
        ]);

        TargetDesa::create($request->all());

        return redirect()->route('target-desa.index')->with('success', 'Tambah Target Desa berhasil.');
    }

    // Menampilkan form untuk mengedit target desa
    public function edit($id)
    {
        $targetDesa = TargetDesa::findOrFail($id);

        return view('targetdesa.edit', ['data' => $targetDesa]); // Mengirimkan data target desa ke dalam halaman update
    }

    // Menyimpan perubahan pada target desa ke dalam database
    public function update(Request $request, $id)
    {
        $request->validate([
            'provinsi' => 'required',
            'kota' => 'required',
            'kecamatan' => 'required',
            'desa' => 'required',
            'puskesmas' => 'required',
            'target_penduduk' => 'required',
        ]);

        $targetDesa = TargetDesa::findOrFail($id);
        $targetDesa->update($request->all());

        return redirect()->route('target-desa.index')->with('success', 'Edit Target Desa  Berhasil.');
    }



    // Menghapus target desa dari database
    public function destroy($id)
    {
        $targetDesa = TargetDesa::findOrFail($id);
        $targetDesa->delete();

        return redirect()->route('target-desa.index')->with('success', 'Hapus Target Desa Berhasil.');
    }
}
