<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Note;

class NoteSeeder extends Seeder
{
    public function run(): void
    {
        Note::create([
            'judul' => 'Catatan Test',
            'file_path' => 'Isi dari note ini...',
            'user_id' => 1,
            'matkul_id' => 1,
        ]);
    }
}