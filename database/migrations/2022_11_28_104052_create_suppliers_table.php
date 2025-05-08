<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('code', 100)->nullable();
            $table->string('name', 100);
            $table->string('contact_person', 100)->nullable();
            $table->string('description', 250)->nullable();
            $table->string('address', 150);
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->string('zip_code', 10)->nullable();
            $table->string('mobile_number', 50);
            $table->string('tel_number', 50)->nullable();
            $table->string('email', 100)->nullable();
            $table->longText('notes')->nullable();
            $table->boolean('is_supplier')->default(true);
            $table->boolean('is_manufacturer')->default(true);
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
        Schema::dropIfExists('suppliers');
    }
}
