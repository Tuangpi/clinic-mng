<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncompleteTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomplete_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('queue_transaction_id');
            $table->foreign('queue_transaction_id')->references('id')->on('queue_transactions');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products');
            $table->unsignedBigInteger('package_id')->nullable();
            $table->foreign('package_id')->references('id')->on('packages');
            $table->string('item_code', 100);
            $table->string('name', 250);
            $table->integer('session_count');
            $table->integer('remaining_session');
            $table->decimal('price', 18, 2);
            $table->decimal('remaining_balance', 18, 2);
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
        Schema::dropIfExists('incomplete_transactions');
    }
}
