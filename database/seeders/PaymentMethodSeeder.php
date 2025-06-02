<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentMethodSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('payments')->insert([
            ['payment_method' => 'Bank Transfer'],
            ['payment_method' => 'Credit Card'],
            ['payment_method' => 'E-Wallet'],
            ['payment_method' => 'PayPal'],
        ]);
    }
}
