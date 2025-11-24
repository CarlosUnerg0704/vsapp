<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     
    public function up()
    {
        Schema::table('team_invitations', function (Blueprint $table) {
            $table->string('type')->default('invite'); // invite o response
            $table->string('message')->nullable();
        });
    }


    public function down(): void
    {
        Schema::table('team_invitations', function (Blueprint $table) {
            //
        });
    }*/
};
