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
                'gambar' => 'https://images.pexels.com/photos/360591/pexels-photo-360591.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
                'deskripsi' => 'Belajar dasar logika dan pemrograman.',
            ],
            [
                'nama' => 'Sistem Enterprise',
                'kode' => 'SI201',
                'prodi' => 'Sistem Informasi',
                'gambar' => 'https://images.pexels.com/photos/6550172/pexels-photo-6550172.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
                'deskripsi' => 'Belajar dasar logika dan pemrograman.',
            ],
            [
                'nama' => 'Kalkulus Dasar',
                'kode' => 'TI301',
                'prodi' => 'Teknik Industri',
                'gambar' => 'https://images.pexels.com/photos/31486525/pexels-photo-31486525/free-photo-of-industrial-storage-tanks-against-clear-blue-sky.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
                'deskripsi' => 'Belajar dasar logika dan pemrograman.',
            ],
            [
                'nama' => 'Rekayasa Proses Bisnis',
                'kode' => 'SI202',
                'prodi' => 'Sistem Informasi',
                'gambar' => 'https://images.pexels.com/photos/6550172/pexels-photo-6550172.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
                'deskripsi' => 'Belajar dasar logika dan pemrograman.',
            ],
            [
                'nama' => 'Proyek Perangkat Lunak',
                'kode' => 'SI203',
                'prodi' => 'Sistem Informasi',
                'gambar' => 'https://images.pexels.com/photos/6550172/pexels-photo-6550172.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
                'deskripsi' => 'Belajar dasar logika dan pemrograman.',
            ],
            [
                'nama' => 'Sistem Operasi',
                'kode' => 'IF102',
                'prodi' => 'Teknik Informatika',
                'gambar' => 'https://images.pexels.com/photos/360591/pexels-photo-360591.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2',
                'deskripsi' => 'Belajar dasar logika dan pemrograman.',
            ],
        ]);
    }
}
