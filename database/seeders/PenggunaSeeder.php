<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class PenggunaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('penggunas')->insert([
            'full_name' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
            'gender' => 'Male',
            'date_of_birth' => '1990-01-01',
            'security_question' => 'Nama hewan peliharaan pertama?',
            'security_answer' => 'admin',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
