<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPxCreditInQueue extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('queues', function (Blueprint $table) {
            $table->decimal('total_amount_before_px_credit', 18, 2)->nullable();
            $table->decimal('paid_amount_before_px_credit', 18, 2)->nullable();
            $table->decimal('px_credit', 18, 2)->nullable();
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
            $table->dropColumn('total_amount_before_px_credit');
            $table->dropColumn('paid_amount_before_px_credit');
            $table->dropColumn('px_credit');
        });
    }
}
