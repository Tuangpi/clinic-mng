<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModuleUserRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */    
     public function up()
     {
         Schema::create('module_user_role', function (Blueprint $table) {
             $table->bigIncrements('id');
             $table->unsignedBigInteger('module_id');
             $table->foreign('module_id')->references('id')->on('modules');
             $table->unsignedBigInteger('user_role_id');
             $table->foreign('user_role_id')->references('id')->on('user_roles');
             $table->timestamps();
         });
     }
 
     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::dropIfExists('module_user_role');
     }
}
