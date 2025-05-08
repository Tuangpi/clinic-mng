<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQueueTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queue_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('queue_id');
            $table->foreign('queue_id')->references('id')->on('queues');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products');
            $table->unsignedBigInteger('package_id')->nullable();
            $table->foreign('package_id')->references('id')->on('packages');
            $table->string('item_code', 100);
            $table->string('name', 250);
            $table->decimal('unit_price', 18, 2);
            $table->decimal('qty', 18, 2);
            $table->string('uom', 100)->nullable();
            $table->unsignedBigInteger('usage_id')->nullable();
            $table->foreign('usage_id')->references('id')->on('usages');
            $table->unsignedBigInteger('dosage_id')->nullable();
            $table->foreign('dosage_id')->references('id')->on('dosages');
            $table->unsignedBigInteger('dosage_uom_id')->nullable();
            $table->foreign('dosage_uom_id')->references('id')->on('uoms');
            $table->unsignedBigInteger('frequency_id')->nullable();
            $table->foreign('frequency_id')->references('id')->on('frequencies');
            $table->decimal('price', 18, 2);
            $table->decimal('total_amount', 18, 2);
            $table->decimal('disc_percentage', 18, 2)->nullable();
            $table->decimal('disc_amount', 18, 2);
            $table->decimal('sub_total', 18, 2);
            $table->integer('session_count')->nullable();
            $table->integer('session_no')->nullable();
            $table->integer('total_session_count')->nullable();
            $table->decimal('amount_to_pay', 18, 2);
            $table->decimal('from_overall_discount', 18, 2)->nullable();
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
        Schema::dropIfExists('queue_transactions');
    }
}
