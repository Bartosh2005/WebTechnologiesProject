<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('award_nominations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('game_id')->constrained('games_library')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('award_categories')->onDelete('cascade');
            $table->timestamps();

            $table->unique(['user_id', 'category_id']);
        });
    }
};
