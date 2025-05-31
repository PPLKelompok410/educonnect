<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bookmarks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('note_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('penggunas')->onDelete('cascade');
            $table->foreign('note_id')->references('id')->on('notes')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bookmarks');
    }
};