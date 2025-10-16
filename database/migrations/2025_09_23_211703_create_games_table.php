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
        Schema::create('games', function (Blueprint $table) {
            $table->id();

           
            $table->unsignedBigInteger('team1_id');
            $table->unsignedBigInteger('team2_id');
            $table->unsignedInteger('winner_id')->nullable();

            $table->foreign('team1_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('team2_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('winner_id')->references('id')->on('teams')->onDelete('set null');

            $table->integer('score_team1')->default(0);
            $table->integer('score_team2')->default(0);
            $table->timestamp('played_at')->nullable();
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
