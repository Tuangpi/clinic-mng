<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('branch_id');
            $table->foreign('branch_id')->references('id')->on('branches');
            $table->string('code', 100)->nullable();
            $table->unsignedBigInteger('title_id')->nullable();
            $table->foreign('title_id')->references('id')->on('titles');
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->date('birth_date')->nullable();
            $table->string('birth_place', 200)->nullable();
            $table->unsignedBigInteger('gender_id')->nullable();
            $table->foreign('gender_id')->references('id')->on('genders');
            $table->unsignedBigInteger('nationality_id')->nullable();
            $table->foreign('nationality_id')->references('id')->on('nationalities');
            $table->unsignedBigInteger('marital_status_id')->nullable();
            $table->foreign('marital_status_id')->references('id')->on('marital_statuses');
            $table->string('nric', 100)->nullable();
            $table->string('address', 150)->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('cities');
            $table->string('zip_code', 10)->nullable();
            $table->string('mobile_number', 50);
            $table->string('email', 100)->nullable()->unique();
            $table->boolean('has_drug_allergies')->nullable();
            $table->string('drug_allergies', 150)->nullable();
            $table->boolean('has_food_allergies')->nullable();
            $table->string('food_allergies', 150)->nullable();
            $table->longText('notes')->nullable();
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
        Schema::dropIfExists('patients');
    }
}
