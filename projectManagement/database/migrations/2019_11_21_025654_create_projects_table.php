<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('proj_id');
            $table->unsignedBigInteger('cl_id');
            $table->date('start_date');
            $table->date('due_date');
            $table->unsignedBigInteger('user_id');
            $table->string('requirement')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->nullable();
            $table->foreign('cl_id')->references('cl_id')->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}