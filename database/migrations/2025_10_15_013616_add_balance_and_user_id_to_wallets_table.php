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
        Schema::table('wallets', function (Blueprint $table) {
            if (!Schema::hasColumn('wallets', 'balance')) {
                $table->decimal('balance', 10, 2)->default(0);
            }

            // Elimina esta parte si user_id ya existe
            // if (!Schema::hasColumn('wallets', 'user_id')) {
            //     $table->unsignedBigInteger('user_id')->unique();
            //     $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // }
        });
    }

    public function down()
    {
        Schema::table('wallets', function (Blueprint $table) {
            $table->dropColumn('balance');
            // $table->dropForeign(['user_id']);
            // $table->dropColumn('user_id');
        });
    }


};
