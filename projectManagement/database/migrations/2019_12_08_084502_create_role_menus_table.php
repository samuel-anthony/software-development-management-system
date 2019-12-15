<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_menus', function (Blueprint $table) {
            $table->bigIncrements('role_menu_id');
            $table->unsignedBigInteger('div_id');
            $table->unsignedBigInteger('menu_id');
            $table->timestamps();
            
            $table->foreign('div_id')->references('div_id')->on('divisions');
            $table->foreign('menu_id')->references('menu_id')->on('menus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_menus');
    }
}
