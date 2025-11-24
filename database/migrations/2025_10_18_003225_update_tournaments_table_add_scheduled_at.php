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
        Schema::table('tournaments', function (Blueprint $table) {
            if (!Schema::hasColumn('tournaments', 'scheduled_at')) {
                $table->timestamp('scheduled_at')->nullable();
            }

            if (Schema::hasColumn('tournaments', 'date')) {
                $table->dropColumn('date');
            }

            if (Schema::hasColumn('tournaments', 'time')) {
                $table->dropColumn('time');
            }
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tournaments', function (Blueprint $table) {
            //
        });
    }
};
