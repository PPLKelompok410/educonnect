<?php

namespace Database\Factories;

use App\Models\Pengguna;
use App\Models\MataKuliah;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    public function definition(): array
    {
        return [
            'pengguna_id' => Pengguna::inRandomOrder()->first()->id ?? Pengguna::factory(),
            'judul' => $this->faker->sentence(4),
            'file_path' => 'uploads/notes/' . $this->faker->word() . '.pdf',
            'matkul_id' => MataKuliah::inRandomOrder()->first()->id ?? MataKuliah::factory(),
        ];
    }
}
