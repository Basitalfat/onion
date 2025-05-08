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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nas');
            $table->enum('syubah', ['AshShidiqqin', 'AsySyuhada', 'AshSholihin', 'AlMutaqien', 'AlMuhsinin', 'AshShobirin']);
            $table->string('holaqoh');
            $table->string('farah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
