<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->string('first_name', 100)->nullable();
            $table->string('last_name', 100)->nullable();
            $table->string('mobile_no', 100)->nullable();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->string('prefix', 100)->nullable();
            $table->longText('details')->nullable();
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->unsignedBigInteger('appointment_category_id');
            $table->foreign('appointment_category_id')->references('id')->on('appointment_categories');
            $table->unsignedBigInteger('appointment_status_id');
            $table->foreign('appointment_status_id')->references('id')->on('appointment_statuses');
            $table->unsignedBigInteger('recurring_type_id')->nullable();
            $table->foreign('recurring_type_id')->references('id')->on('recurring_types');
            $table->integer('recurring_interval')->nullable();
            $table->date('recurring_end_date')->nullable();
            $table->string('recurring_dow', 25)->nullable();
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
        Schema::dropIfExists('appointments');
    }
}
