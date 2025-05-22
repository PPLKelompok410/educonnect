<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('bookmarks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('note_id')->constrained('notes')->onDelete('cascade');
            $table->timestamps();
            
            // Mencegah duplikasi bookmark
            $table->unique(['user_id', 'note_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookmarks');
    }
};