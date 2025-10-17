<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('games', function (Blueprint $table) {
            $table->foreignId('player1_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('player2_id')->nullable()->constrained('users')->nullOnDelete();
            $table->foreignId('winner_player_id')->nullable()->constrained('users')->nullOnDelete();
            //$table->foreignId('tournament_id')->nullable()->constrained('tournaments')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('games', function (Blueprint $table) {
            $table->dropForeign(['player1_id']);
            $table->dropForeign(['player2_id']);
            $table->dropForeign(['winner_player_id']);
            $table->dropForeign(['tournament_id']);
            $table->dropColumn(['player1_id', 'player2_id', 'winner_player_id', 'tournament_id']);
        });
    }
};
