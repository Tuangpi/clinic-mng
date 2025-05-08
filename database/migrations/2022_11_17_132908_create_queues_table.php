<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQueuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('queues', function (Blueprint $table) {
            $table->id();
            $table->string('code', 100)->nullable();
            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->unsignedBigInteger('patient_id');
            $table->foreign('patient_id')->references('id')->on('patients');
            $table->unsignedBigInteger('queue_status_id');
            $table->foreign('queue_status_id')->references('id')->on('queue_statuses');
            $table->datetime('appointment_schedule')->nullable();
            $table->datetime('time_in');
            $table->datetime('time_out')->nullable();
            $table->longText('notes')->nullable();
            $table->string('ref_no', 100)->nullable();
            $table->string('attending_doctor', 150)->nullable();
            $table->longText('transaction_remarks')->nullable();
            $table->decimal('pre_total_amount', 18, 2)->nullable();
            $table->decimal('pre_paid_amount', 18, 2)->nullable();
            $table->decimal('overall_disc_percentage', 18, 2)->nullable();
            $table->decimal('overall_disc_amount', 18, 2)->nullable();
            $table->decimal('total_amount', 18, 2)->nullable();
            $table->decimal('paid_amount', 18, 2)->nullable();
            $table->boolean('is_draft')->default(true);
            $table->datetime('posted_date')->nullable();
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
        Schema::dropIfExists('queues');
    }
}
