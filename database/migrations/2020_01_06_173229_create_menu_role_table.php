<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuRoleTable extends Migration
{
    public function up()
    {
        Schema::create('menu_role', function (Blueprint $table) {
            
            $table->bigInteger('role_id')->unsigned()->index(); // this is working
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('restrict')->onUpdate('restrict');

            $table->bigInteger('menu_id')->unsigned()->index(); // this is working
            $table->foreign('menu_id')->references('id')->on('menus')->onDelete('cascade')->onUpdate('restrict');

            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
        });
    }

    public function down()
    {
        Schema::dropIfExists('menu_role');
    }
}
