<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('player_profiles', function (Blueprint $table) {
            // 1 perfil por usuario
            $table->unique('user_id');

            // Claves de Riot: suelen ser únicas
            $table->unique('puuid');
            $table->unique('summoner_id');

            // Búsquedas rápidas
            $table->index('riot_game_name');
            $table->index('riot_tag_line');
            $table->index('platform'); // la1 / la2
            $table->index('region');   // americas
        });
    }

    public function down(): void
    {
        Schema::table('player_profiles', function (Blueprint $table) {
            $table->dropUnique(['user_id']);
            $table->dropUnique(['puuid']);
            $table->dropUnique(['summoner_id']);
            $table->dropIndex(['riot_game_name']);
            $table->dropIndex(['riot_tag_line']);
            $table->dropIndex(['platform']);
            $table->dropIndex(['region']);
        });
    }
};
