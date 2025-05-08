<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->string('code', 100)->nullable();
            $table->string('code2', 50);
            $table->string('name', 250);
            $table->string('description', 500)->nullable();
            $table->unsignedBigInteger('product_type_id');
            $table->foreign('product_type_id')->references('id')->on('product_types');
            $table->unsignedBigInteger('product_category_id');
            $table->foreign('product_category_id')->references('id')->on('product_categories');
            $table->unsignedBigInteger('uom_id');
            $table->foreign('uom_id')->references('id')->on('uoms');
            $table->boolean('has_dosage')->default(false);
            $table->unsignedBigInteger('usage_id')->nullable();
            $table->foreign('usage_id')->references('id')->on('usages');
            $table->unsignedBigInteger('dosage_id')->nullable();
            $table->foreign('dosage_id')->references('id')->on('dosages');
            $table->unsignedBigInteger('dosage_uom_id')->nullable();
            $table->foreign('dosage_uom_id')->references('id')->on('uoms');
            $table->unsignedBigInteger('frequency_id')->nullable();
            $table->foreign('frequency_id')->references('id')->on('frequencies');
            $table->decimal('total_dosage', 18, 2)->nullable();
            $table->decimal('selling_price', 18, 2);
            $table->decimal('cost_price', 18, 2);
            $table->unsignedBigInteger('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->unsignedBigInteger('manufacturer_id');
            $table->foreign('supplier_id', 'manufacturer_product_id_foreign')->references('id')->on('suppliers');
            $table->decimal('current_stock', 18, 2);
            $table->boolean('is_stock_unlimited')->default(false);
            $table->decimal('critical_level', 18, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->string('photo_ext', 10)->nullable();
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
        Schema::dropIfExists('products');
    }
}
