<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCurrentAndUpdatedStock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stock_adjustment_products', function (Blueprint $table) {
            $table->decimal('current_stock', 18, 2)->after('uom');
            $table->decimal('updated_stock', 18, 2)->after('qty');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stock_adjustment_products', function (Blueprint $table) {
            $table->dropColumn('current_stock');
            $table->dropColumn('updated_stock');
        });
    }
}
