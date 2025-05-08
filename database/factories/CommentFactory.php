<?php
namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use App\Models\MataKuliah;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Menghubungkan ke factory User untuk membuat data user
            'matkul_id' => MataKuliah::factory(), // Menghubungkan ke factory MataKuliah untuk membuat data mata kuliah
            'comment' => $this->faker->sentence(10), // Menghasilkan komentar acak dengan 10 kata
        ];
    }
}

