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
            $table->date('tanggal')->nullable();
            $table->enum('media', ['online', 'offline', 'hybrid'])->default('offline');
            $table->unsignedBigInteger('holaqoh_id')->nullable()->after('id');
            $table->foreign('holaqoh_id')->references('id')->on('holaqohs')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tausiyahs', function (Blueprint $table) {
            $table->dropForeign(['holaqoh_id']);
            $table->dropColumn(['tanggal', 'media', 'holaqoh_id']);
        });
    }
};
