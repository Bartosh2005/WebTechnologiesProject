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
        Schema::create('user_game_library', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('game_library_id');
            $table->timestamps();

            $table->unique(['user_id', 'game_id']); // prevent duplicates
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('game_library_id')->references('id')->on('games_library')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_game_library');
    }
};
