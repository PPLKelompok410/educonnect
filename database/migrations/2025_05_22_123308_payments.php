<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->enum('payment_method', ['GoPay', 'OVO', 'DANA', 'Transfer Bank BCA', 'Transfer Bank BRI', 'Transfer Bank BNI', 'Transfer Bank Mandiri', 'Credit Card']);
            $table->enum('package',['Genius', 'Professor']);
            $table->text('description')->nullable();
            $table->integer('price');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
