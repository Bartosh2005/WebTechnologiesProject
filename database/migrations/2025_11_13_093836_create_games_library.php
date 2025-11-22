<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('games_library', function (Blueprint $table) {

            $table->id();
            $table->string('title');
            $table->string('genre');
            $table->string('company');
            $table->text('description');
            $table->string('img')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('games_library');
    }
};
