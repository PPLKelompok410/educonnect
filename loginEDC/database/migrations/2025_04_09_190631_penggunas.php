<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('penggunas', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('full_name', 100); // Full Name
            $table->date('date_of_birth'); // Date of Birth
            $table->string('email', 255)->unique(); // Email, with unique constraint
            $table->string('password', 255); // Password
            $table->enum('gender', ['Male', 'Female']); // Gender
            $table->string('security_question', 255); // Security Question
            $table->string('security_answer', 255); // Security Answer
            $table->timestamps(); // Created_at and Updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggunas'); // Drop the table
    }
};
