<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQueueVoid extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('queues', function (Blueprint $table) {
            $table->boolean('is_voided')->nullable();
            $table->datetime('voided_date')->nullable();
        });

        Schema::table('queue_transactions', function (Blueprint $table) {
            $table->boolean('is_session_used')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('queues', function (Blueprint $table) {
            $table->dropColumn('is_voided');
            $table->dropColumn('voided_date');
        });
        
        Schema::table('queue_transactions', function (Blueprint $table) {
            $table->dropColumn('is_session_used');
        });
    }
}
