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
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('region_id')->nullable();
            $table->integer('rank')->default(0);
            $table->integer('g_win')->default(0);
            $table->integer('g_lost')->default(0);
            $table->timestamps();

            // Relaciones
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('teams');
    }

};
