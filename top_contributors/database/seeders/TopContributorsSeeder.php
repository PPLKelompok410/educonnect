<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengguna;
use App\Models\Note;
use App\Models\NoteComment;
use App\Models\Comment;
use App\Models\MataKuliah;
use Carbon\Carbon;

class TopContributorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mataKuliahs = MataKuliah::factory(5)->create();

        $penggunas = Pengguna::factory(10)->create();

        foreach ($penggunas as $pengguna) {
            $notes = Note::factory(rand(1, 5))->create([
                'pengguna_id' => $pengguna->id,
                'matkul_id' => $mataKuliahs->random()->id,
                'created_at' => Carbon::now()->subDays(rand(1, 30)),
            ]);

            foreach (range(1, rand(1, 5)) as $i) {
                NoteComment::factory()->create([
                    'pengguna_id' => $pengguna->id,
                    'note_id' => $notes->random()->id,
                    'created_at' => Carbon::now()->subDays(rand(1, 30)),
                ]);
            }

            foreach (range(1, rand(1, 5)) as $i) {
                Comment::factory()->create([
                    'pengguna_id' => $pengguna->id,
                    'matkul_id' => $mataKuliahs->random()->id,
                    'created_at' => Carbon::now()->subDays(rand(1, 30)),
                ]);
            }
        }
    }
}
