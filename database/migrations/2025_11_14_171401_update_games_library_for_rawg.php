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
        Schema::table('games_library', function (Blueprint $table) {
            $table->string('title')->change();
            $table->text('description')->nullable()->change();
            $table->string('img')->nullable()->change();
            $table->string('genre')->nullable()->change();
            $table->string('company')->nullable()->change();
            $table->date('released_at')->nullable();
            $table->decimal('rating', 3, 1)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('games_library', function (Blueprint $table) {
            // revert changes if needed
        });
    }
};
