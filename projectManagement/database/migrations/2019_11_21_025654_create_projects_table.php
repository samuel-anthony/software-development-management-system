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
            $table->string('requirement')->nullable();
            $table->string('content')->nullable();
            $table->binary('media')->nullable();
            $table->timestamps();
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