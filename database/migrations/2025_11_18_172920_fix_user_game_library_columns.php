<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
       
        if (Schema::hasTable('user_game_library')) {
            Schema::rename('user_game_library', 'user_game_library_old');

            
            Schema::create('user_game_library', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('game_library_id');
                $table->timestamps();

                $table->unique(['user_id', 'game_library_id']);

                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('game_library_id')->references('id')->on('games_library')->onDelete('cascade');
            });

            
            $columns = Schema::getColumnListing('user_game_library_old');
            if (in_array('game_id', $columns)) {
                DB::statement("
                    INSERT INTO user_game_library (id, user_id, game_library_id, created_at, updated_at)
                    SELECT id, user_id, game_id AS game_library_id, created_at, updated_at
                    FROM user_game_library_old
                ");
            }

            
            Schema::drop('user_game_library_old');
        } else {
            
            Schema::create('user_game_library', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id');
                $table->unsignedBigInteger('game_library_id');
                $table->timestamps();

                $table->unique(['user_id', 'game_library_id']);

                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('game_library_id')->references('id')->on('games_library')->onDelete('cascade');
            });
        }
    }
    

   
    public function down(): void
    {
          Schema::dropIfExists('user_game_library');

        
        Schema::create('user_game_library', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('game_id'); 
            $table->timestamps();

            $table->unique(['user_id', 'game_id']);

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
        });
    }
};
