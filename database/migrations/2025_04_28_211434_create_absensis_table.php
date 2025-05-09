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
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['hadir', 'izin', 'sakit', 'tanpa_keterangan']);
            $table->string('ket')->nullable();
            $table->foreignId('member_id')->constrained('members')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignid('tausiyah_id')->constrained('tausiyahs')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
