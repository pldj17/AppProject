<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileSpecialtyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profile_specialty', function (Blueprint $table) {
            $table->bigIncrements('id');
            
            $table->bigInteger('profile_id')->unsigned()->index();
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('restrict')->onUpdate('restrict');

            $table->bigInteger('specialty_id')->unsigned()->index()->unique(); 
            $table->foreign('specialty_id')->references('id')->on('specialties')->onDelete('restrict')->onUpdate('restrict');

            $table->timestamps();
            $table->charset = 'utf8mb4';
            $table->collation = 'utf8mb4_spanish_ci';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profile_specialty');
    }
}
