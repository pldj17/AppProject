<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->bigIncrements('id');
            // $table->integer('role_id')->unsigned(); //no acepta valores negativos
            // $table->integer('user_id')->unsigned(); //no acepta valores negativos
            // $table->unsignedInteger('role_id');
            // $table->foreign('role_id', 'fk_roleuser_role')->references('id')->on('roles')->onDelete('restrict')->onUpdate('restrict');
            // $table->unsignedInteger('user_id');
            // $table->foreign('user_id', 'fk_roleuser_user')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
            
            $table->bigInteger('role_id')->unsigned()->index(); // this is working
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('restrict')->onUpdate('restrict');

            $table->bigInteger('user_id')->unsigned()->index(); // this is working
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('restrict');

            $table->string('state',30)->nullable();

            $table->timestamps();
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';

            // $table->foreign('role_id')->references('id')->on('roles');
            // $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_user');
    }
}
