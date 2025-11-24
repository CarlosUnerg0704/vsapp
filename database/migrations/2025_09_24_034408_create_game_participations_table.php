<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('game_participations', function (Blueprint $table) {
            $table->id();

            // games.id = BIGINT UNSIGNED
            $table->unsignedBigInteger('game_id');

            // teams.id = INT UNSIGNED
            $table->unsignedBigInteger('team_id')->nullable();

            // users.id = BIGINT UNSIGNED (si Jetstream está activo)
            $table->unsignedBigInteger('user_id');

            $table->string('role');
            $table->enum('result', ['win', 'loss']);
            $table->timestamps();

            // Foreign keys
            $table->foreign('game_id')->references('id')->on('games')->onDelete('cascade');
            $table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('game_participations');
    }
};
