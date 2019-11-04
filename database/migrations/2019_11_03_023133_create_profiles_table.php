<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned(); //no acepta valores negativos 
            $table->text('descripcion', 45)->nullable()->default(null);
            $table->string('telefono', 45)->nullable()->default(null);
            $table->string('direccion', 45)->nullable()->default(null);
            $table->string('avatar', 45)->nullable()->default(null);
            $table->string('fecha_nac')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
