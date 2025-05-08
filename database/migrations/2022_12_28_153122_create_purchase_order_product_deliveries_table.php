<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrderProductDeliveriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_product_deliveries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('purchase_order_product_id')->nullable();
            $table->foreign('purchase_order_product_id', 'popd_pop_id_foreign')->references('id')->on('purchase_order_products');
            $table->date('delivery_date');
            $table->string('dr_no', 100);
            $table->decimal('delivered_qty', 18, 2);
            $table->integer('pack_size')->nullable();
            $table->string('batch_no', 100)->nullable();
            $table->date('expiry_date')->nullable();
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
        Schema::dropIfExists('purchase_order_product_deliveries');
    }
}
