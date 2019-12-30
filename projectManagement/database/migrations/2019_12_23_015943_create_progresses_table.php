<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgressesTable extends Migration
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
            $table->unsignedBigInteger('assignee_id')->nullable();
            $table->string('comment')->nullable();
            $table->timestamps();
            
            $table->foreign('proj_id')->references('proj_id')->on('projects');
            $table->foreign('reporter_id')->references('id')->on('users');
            $table->foreign('assignee_id')->references('id')->on('users');
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
