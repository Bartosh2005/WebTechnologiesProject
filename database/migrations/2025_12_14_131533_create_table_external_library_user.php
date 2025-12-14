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
        Schema::create('external_library_game_user', function (Blueprint $table) {
            $table->id();
            $table->decimal("user_id");//->foreign('user_id')->references('id')->on('users')
            $table->decimal("game_id");
            $table->string("database");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('external_library_game_user');
    }
};
