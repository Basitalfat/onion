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
        Schema::table('tausiyahs', function (Blueprint $table) {
            $table->dropColumn('holaqoh');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tausiyahs', function (Blueprint $table) {
            $table->string('holaqoh')->nullable();
        });
    }
};
