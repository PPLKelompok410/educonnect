<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoteRatingsTable extends Migration
{
    public function up()
    {
        Schema::create('note_ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('note_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained('penggunas')->onDelete('cascade'); // atau 'users' kalau pakai default
            $table->tinyInteger('rating');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('note_ratings');
    }
}
