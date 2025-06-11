<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('download_limits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('penggunas')->onDelete('cascade');
            $table->integer('download_count')->default(0);
            $table->timestamp('last_download_reset')->nullable();
            $table->timestamps();
            
            // Add index untuk performance
            $table->index(['user_id', 'last_download_reset']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('download_limits');
    }
};