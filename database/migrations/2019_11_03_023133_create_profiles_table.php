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
            // $table->integer('user_id')->unsigned(); //no acepta valores negativos 
            $table->integer('private')->nullable();
            $table->text('description', 45)->nullable()->default(null);
            $table->string('phone', 45)->nullable()->default(null);
            $table->string('correo')->nullable()->default(null);
            $table->string('avatar', 45)->nullable()->default(null);
            $table->string('date_born')->nullable()->default(null);
            $table->string('address_address')->nullable();
            $table->timestamps();

            $table->bigInteger('user_id')->unsigned()->index()->nullable(); 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
