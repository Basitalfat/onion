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
        Schema::create('tausiyahs', function (Blueprint $table) {
            $table->id();
            $table->string('pengisi');
            $table->string('tempat');
            $table->string('bulan');
            $table->string('holaqoh');
            $table->foreignid('user_id')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tausiyahs');
    }
};
