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
            $table->unsignedBigInteger('comp_id');
            $table->date('due_date');
            $table->string('requirement')->nullable();
            $table->string('user_id')->references('user_id')->on('users')->nullable();
            $table->timestamps();
            
            $table->foreign('comp_id')->references('comp_id')->on('companies');
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