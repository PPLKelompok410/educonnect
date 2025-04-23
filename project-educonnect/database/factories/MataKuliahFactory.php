<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MataKuliahFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama' => $this->faker->word(),
            'kode' => $this->faker->unique()->bothify('MK###'),
            'prodi' => $this->faker->randomElement(['Informatika', 'Sistem Informasi']),
            'gambar' => null,
        ];
    }
}