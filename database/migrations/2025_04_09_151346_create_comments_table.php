<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('matkul_id');
            $table->unsignedBigInteger('user_id');
            $table->text('comment');
            $table->timestamps();
    
            // Foreign Key Constraints
            $table->foreign('matkul_id')->references('id')->on('mata_kuliahs')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('comments');
    }
    
};
