<?php
namespace Database\Factories;

use App\Models\MataKuliah;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MataKuliah>
 */
class MataKuliahFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama' => $this->faker->word, // Menghasilkan nama mata kuliah acak
            'kode' => $this->faker->bothify('???-###'), // Menghasilkan kode mata kuliah acak seperti "MAT-101"
            'prodi' => $this->faker->word, // Menghasilkan nama prodi acak
        ];
    }
}