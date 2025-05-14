<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MataKuliahFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nama' => 'Pemrograman Web',
            'kode' => 'IF' . $this->faker->unique()->randomNumber(4),
            'prodi' => 'Informatika',
            'gambar' => 'web.jpg',
            'deskripsi' => $this->faker->paragraph(),
        ];
    }
}
