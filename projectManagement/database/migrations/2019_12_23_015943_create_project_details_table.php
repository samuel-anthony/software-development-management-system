<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progresses', function (Blueprint $table) {
            $table->bigIncrements('progress_id');
            $table->unsignedBigInteger('proj_id');
            $table->unsignedBigInteger('reporter_id');
            $table->unsignedBigInteger('assignee_id');
            $table->unsignedBigInteger('status_id');
            $table->timestamps();
            
            $table->foreign('proj_id')->references('proj_id')->on('projects');
            $table->foreign('reporter_id')->references('id')->on('users');
            $table->foreign('assignee_id')->references('id')->on('users')->nullable();
            $table->foreign('status_id')->references('status_id')->on('statuses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('progresses');
    }
}
