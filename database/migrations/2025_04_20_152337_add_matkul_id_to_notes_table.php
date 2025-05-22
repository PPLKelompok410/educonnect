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
            Schema::table('notes', function (Blueprint $table) {
                if (!Schema::hasColumn('notes', 'matkul_id')) {
                    $table->unsignedBigInteger('matkul_id')->nullable()->after('user_id');
                }
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('notes', function (Blueprint $table) {
            //
        });
    }
};
