<?php

namespace Database\Factories;

use App\Models\Note;
use App\Models\Pengguna;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteCommentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'note_id' => Note::inRandomOrder()->first()->id ?? Note::factory(),
            'pengguna_id' => Pengguna::inRandomOrder()->first()->id ?? Pengguna::factory(),
            'content' => $this->faker->paragraph(),
        ];
    }
}
