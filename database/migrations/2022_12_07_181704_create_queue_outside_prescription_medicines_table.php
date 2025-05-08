<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQueueOutsidePrescriptionMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queue_outside_prescription_medicines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('queue_outside_prescription_id');
            $table->foreign('queue_outside_prescription_id', 'qopm_qop_id_foreign')->references('id')->on('queue_outside_prescriptions');
            $table->string('description', 250);
            $table->string('dosage', 100);
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
        Schema::dropIfExists('queue_outside_prescription_medicines');
    }
}
