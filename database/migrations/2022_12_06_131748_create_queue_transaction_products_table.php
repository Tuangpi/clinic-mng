<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQueueTransactionProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queue_transaction_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('queue_transaction_id');
            $table->foreign('queue_transaction_id')->references('id')->on('queue_transactions');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');
            $table->string('item_code', 100);
            $table->string('name', 250);
            $table->decimal('qty', 18, 2)->nullable();
            $table->string('uom', 100);
            $table->unsignedBigInteger('usage_id')->nullable();
            $table->foreign('usage_id')->references('id')->on('usages');
            $table->unsignedBigInteger('dosage_id')->nullable();
            $table->foreign('dosage_id')->references('id')->on('dosages');
            $table->unsignedBigInteger('dosage_uom_id')->nullable();
            $table->foreign('dosage_uom_id')->references('id')->on('uoms');
            $table->unsignedBigInteger('frequency_id')->nullable();
            $table->foreign('frequency_id')->references('id')->on('frequencies');
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
        Schema::dropIfExists('queue_transaction_products');
    }
}
