<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIncompleteTransaction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('queue_transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('incomplete_transaction_id')->nullable();
            $table->foreign('incomplete_transaction_id')->references('id')->on('incomplete_transactions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('queue_transactions', function (Blueprint $table) {
            $table->dropForeign('queue_transactions_incomplete_transaction_id_foreign');
            $table->dropColumn('incomplete_transaction_id');
        });
    }
}
