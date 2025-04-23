<?php

namespace Database\Factories;

use App\Models\Pengguna;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PenggunaFactory extends Factory
{
    protected $model = Pengguna::class;

    public function definition(): array
    {
        return [
            'full_name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password123'), // jangan hash ulang saat login
            'gender' => fake()->randomElement(['Male', 'Female']),
            'date_of_birth' => '2000-01-01',
            'security_question' => 'Apa nama sekolah dasar Anda?',
            'security_answer' => 'Parapat',
        ];
    }
}
