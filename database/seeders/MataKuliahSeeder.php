<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MataKuliah;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        MataKuliah::insert([
            [
                'nama' => 'Algoritma dan Pemrograman',
                'kode' => 'IF101',
                'prodi' => 'Teknik Informatika',
                'gambar' => '1748339475_pexels-photo-2004161.webp',
                'deskripsi' => 'Belajar dasar logika dan pemrograman.',
            ],
            [
                'nama' => 'Sistem Enterprise',
                'kode' => 'SI201',
                'prodi' => 'Sistem Informasi',
                'gambar' => '1748339530_pexels-photo-5716001.webp',
                'deskripsi' => 'Belajar dasar logika dan pemrograman.',
            ],
            [
                'nama' => 'Kalkulus Dasar',
                'kode' => 'TI301',
                'prodi' => 'Teknik Industri',
                'gambar' => '1748339530_pexels-photo-5716001.webp',
                'deskripsi' => 'Belajar dasar logika dan pemrograman.',
            ],
            [
                'nama' => 'Rekayasa Proses Bisnis',
                'kode' => 'SI202',
                'prodi' => 'Sistem Informasi',
                'gambar' => '1748339530_pexels-photo-5716001.webp',
                'deskripsi' => 'Belajar dasar logika dan pemrograman.',
            ],
            [
                'nama' => 'Proyek Perangkat Lunak',
                'kode' => 'SI203',
                'prodi' => 'Sistem Informasi',
                'gambar' => '1748339530_pexels-photo-5716001.webp',
                'deskripsi' => 'Belajar dasar logika dan pemrograman.',
            ],
            [
                'nama' => 'Sistem Operasi',
                'kode' => 'IF102',
                'prodi' => 'Teknik Informatika',
                'gambar' => '1748339619_WhatsApp Image 2025-05-27 at 09.40.10.jpeg',
                'deskripsi' => 'Belajar dasar logika dan pemrograman.',
            ],
        ]);
    }
}
