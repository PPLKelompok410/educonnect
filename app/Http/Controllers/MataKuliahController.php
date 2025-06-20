<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;
use App\Models\Pengguna;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class MataKuliahController
{
    public function index()
    {
        if (!session()->has('user_id')) {
            return redirect()->route('auth.login');
        }

        $user = Pengguna::find(session('user_id'));
        $mataKuliah = MataKuliah::all();
        $prodis = MataKuliah::select('prodi')->distinct()->pluck('prodi');

        return view('matkul.galleryMatkul', compact('user', 'mataKuliah', 'prodis'));
    }

    public function discussion($id)
    {
        // Cek login
        if (!session()->has('user_id')) {
            return redirect()->route('auth.login');
        }

        $matkul = MataKuliah::with(['comments.user'])->findOrFail($id);
        $user = Pengguna::find(session('user_id'));
        return view('matkul.discussion', compact('matkul', 'user'));
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
            'gambar' => 'nullable|image',
        ]);

        $data = $request->only(['nama', 'kode', 'prodi']);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/sampul'), $filename); // ⬅️ simpan ke public/images/sampul
            $data['gambar'] = $filename; // simpan nama file saja ke DB
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
            // Hapus gambar lama jika ada
            if ($matkul->gambar) {
                $oldPath = public_path('images/sampul/' . $matkul->gambar);
                if (File::exists($oldPath)) {
                    File::delete($oldPath);
                }
            }

            // Simpan gambar baru
            $file = $request->file('gambar');
            $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/sampul'), $filename);
            $data['gambar'] = $filename;
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
