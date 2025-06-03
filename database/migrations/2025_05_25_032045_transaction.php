<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->unique();
            $table->foreignId('user_id')->constrained('penggunas')->onDelete('cascade');
            $table->foreignId('payment_id')->constrained('payments')->onDelete('cascade');
            $table->string('payment_method');
            $table->integer('subtotal');
            $table->integer('admin_fee')->default(0);
            $table->integer('tax')->default(0);
            $table->integer('total');
            $table->timestamps();
            
            // Indexes untuk performa
            $table->index(['user_id']);
            $table->index(['transaction_id']);
            $table->index(['created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};