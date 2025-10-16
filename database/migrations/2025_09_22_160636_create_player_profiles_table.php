<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('player_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('summoner_name');
            $table->string('rank');
            $table->string('country');
            $table->string('phone');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('player_profiles');
    }
};
