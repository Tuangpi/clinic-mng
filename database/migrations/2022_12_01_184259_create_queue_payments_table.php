<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQueuePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queue_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('queue_id');
            $table->foreign('queue_id')->references('id')->on('queues');
            $table->unsignedBigInteger('payment_option_id');
            $table->foreign('payment_option_id')->references('id')->on('payment_options');
            $table->decimal('amount', 18, 2);
            $table->longText('remarks')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
            $table->unsignedBigInteger('updated_by');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('queue_payments');
    }
}
