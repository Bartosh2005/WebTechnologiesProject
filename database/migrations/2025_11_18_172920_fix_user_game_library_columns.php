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
         // Rename old table
        Schema::rename('user_game_library', 'user_game_library_old');

        // Recreate it with correct structure
        Schema::create('user_game_library', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('game_library_id'); // correct name
            $table->timestamps();

            $table->unique(['user_id', 'game_library_id']);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('game_library_id')->references('id')->on('games_library')->onDelete('cascade');
        });

        // Copy data from old table into new one
        DB::statement("
            INSERT INTO user_game_library (id, user_id, game_library_id, created_at, updated_at)
            SELECT id, user_id, game_id AS game_library_id, created_at, updated_at
            FROM user_game_library_old
        ");

        // Drop old table
        Schema::drop('user_game_library_old');
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
          Schema::dropIfExists('user_game_library');

        // Restore original table
        Schema::create('user_game_library', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('game_id'); // original column
            $table->timestamps();

            $table->unique(['user_id', 'game_id']);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
        });
    }
};
