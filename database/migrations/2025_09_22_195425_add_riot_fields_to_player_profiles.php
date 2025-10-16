<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('player_profiles', function (Blueprint $table) {
            $table->string('riot_game_name')->nullable();   // gameName
            $table->string('riot_tag_line')->nullable();    // tagLine
            $table->string('puuid')->nullable()->index();
            $table->string('summoner_id')->nullable()->index(); // encrypted summoner id
            $table->unsignedInteger('profile_icon_id')->nullable();
            $table->unsignedInteger('summoner_level')->nullable();

            // Rank (SoloQ por defecto; puedes guardar múltiples si quieres)
            $table->string('rank_queue')->nullable();      // ej. RANKED_SOLO_5x5
            $table->string('rank_tier')->nullable();       // GOLD, PLATINUM, etc.
            $table->string('rank_division')->nullable();   // I, II, III, IV
            $table->integer('rank_lp')->nullable();        // League Points

            // Plataforma y región utilizadas
            $table->string('platform')->nullable(); // la1, la2, na1, euw1...
            $table->string('region')->nullable();   // americas, europe, asia, sea
        });
    }

    public function down(): void
    {
        Schema::table('player_profiles', function (Blueprint $table) {
            $table->dropColumn([
                'riot_game_name','riot_tag_line','puuid','summoner_id',
                'profile_icon_id','summoner_level','rank_queue','rank_tier',
                'rank_division','rank_lp','platform','region'
            ]);
        });
    }
};
