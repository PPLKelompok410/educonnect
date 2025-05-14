<?php

namespace Database\Factories;

use App\Models\MataKuliah;
use App\Models\Pengguna;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'matkul_id' => MataKuliah::inRandomOrder()->first()->id ?? MataKuliah::factory(),
            'pengguna_id' => Pengguna::inRandomOrder()->first()->id ?? Pengguna::factory(),
            'comment' => $this->faker->sentence(10),
        ];
    }
}
