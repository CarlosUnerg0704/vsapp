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
        Schema::table('wallet_transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('wallet_id')->after('id');
            $table->foreign('wallet_id')->references('id')->on('wallets')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('wallet_transactions', function (Blueprint $table) {
            $table->dropForeign(['wallet_id']);
            $table->dropColumn('wallet_id');
        });
    }

};
