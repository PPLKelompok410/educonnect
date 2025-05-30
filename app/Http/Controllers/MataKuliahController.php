<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;
use Illuminate\Support\Facades\Storage;

class MataKuliahController
{
    public function index()
    {
        $mataKuliah = MataKuliah::all();
        $prodis = MataKuliah::select('prodi')->distinct()->pluck('prodi');

        return view('matkul.galleryMatkul', compact('mataKuliah', 'prodis'));
    }

    public function discussion($id)
    {
        $matkul = MataKuliah::with(['comments.user'])->findOrFail($id);
        return view('matkul.discussion', compact('matkul'));
    }

    public function manage()
    {
        $mataKuliah = MataKuliah::all();
        return view('matkul.manage', compact('mataKuliah'));
    }

    public function create()
    {
        return view('matkul.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'kode' => 'required|unique:mata_kuliahs',
            'prodi' => 'required',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['nama', 'kode', 'prodi']); // hanya ambil yang dibutuhkan

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/sampul', $filename);
            $data['gambar'] = $filename;
            Storage::disk('public')->putFileAs('sampul', $file, $filename);
        }

        MataKuliah::create($data);

        return redirect()->route('matkul.manage')->with('success', 'Mata kuliah berhasil ditambahkan');
    }

    public function edit($id)
    {
        $matkul = MataKuliah::findOrFail($id);
        return view('matkul.edit', compact('matkul'));
    }

    public function update(Request $request, $id)
    {
        $matkul = MataKuliah::findOrFail($id);

        $request->validate([
            'nama' => 'required',
            'kode' => 'required|unique:mata_kuliahs,kode,' . $id,
            'prodi' => 'required',
            'gambar' => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['nama', 'kode', 'prodi']);

        if ($request->hasFile('gambar')) {
            if ($matkul->gambar) {
                Storage::delete('public/sampul/' . $matkul->gambar);
            }
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/sampul', $filename);
            $data['gambar'] = $filename;
            Storage::disk('public')->putFileAs('sampul', $file, $filename);
        }

        $matkul->update($data);

        return redirect()->route('matkul.manage')->with('success', 'Mata kuliah berhasil diperbarui');
    }

    public function destroy($id)
    {
        $matkul = MataKuliah::findOrFail($id);
        $matkul->delete();

        return redirect()->route('matkul.manage')->with('success', 'Mata kuliah berhasil dihapus');
    }
}
