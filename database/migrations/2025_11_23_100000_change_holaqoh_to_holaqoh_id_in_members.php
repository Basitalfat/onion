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
        Schema::table('members', function (Blueprint $table) {
            // Drop old holaqoh column if exists
            if (Schema::hasColumn('members', 'holaqoh')) {
                $table->dropColumn('holaqoh');
            }
            
            // Add holaqoh_id as foreign key
            $table->unsignedBigInteger('holaqoh_id')->nullable()->after('syubah');
            $table->foreign('holaqoh_id')->references('id')->on('holaqohs')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropForeign(['holaqoh_id']);
            $table->dropColumn('holaqoh_id');
            $table->string('holaqoh')->nullable();
        });
    }
};
