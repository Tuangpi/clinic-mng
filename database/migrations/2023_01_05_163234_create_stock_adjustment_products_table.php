<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockAdjustmentProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_adjustment_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stock_adjustment_id')->nullable();
            $table->foreign('stock_adjustment_id')->references('id')->on('stock_adjustments');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products');
            $table->string('uom', 20);
            $table->decimal('qty', 18, 2);
            $table->string('batch_no', 100)->nullable();
            $table->date('expiry_date')->nullable();
            $table->longText('remarks')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users');
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
        Schema::dropIfExists('stock_adjustment_products');
    }
}
