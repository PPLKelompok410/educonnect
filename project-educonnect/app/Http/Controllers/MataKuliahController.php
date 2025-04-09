<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataKuliah;

class MataKuliahController
{
    public function index()
    {
        $mataKuliah = MataKuliah::all();
        $prodis = MataKuliah::select('prodi')->distinct()->pluck('prodi');
        
        return view('galleryMatkul', compact('mataKuliah', 'prodis'));
    }
}