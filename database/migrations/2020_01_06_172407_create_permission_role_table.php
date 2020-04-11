<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionRoleTable extends Migration
{
    public function up()
    {
        Schema::create('permission_role', function (Blueprint $table) {
            
            $table->bigInteger('role_id')->unsigned()->index(); // this is working
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('restrict')->onUpdate('restrict');

            $table->bigInteger('permission_id')->unsigned()->index(); // this is working
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('restrict')->onUpdate('restrict');
            
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
        });
    }

    public function down()
    {
        Schema::dropIfExists('permission_role');
    }
}
