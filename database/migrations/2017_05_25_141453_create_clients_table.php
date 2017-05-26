<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            //Basisgegevens
            $table->string('firstname');
            $table->string('lastname');
            $table->string('birthdate');
            $table->string('sex');
            $table->string('email')->nullable();
            $table->string('street')->nullable();
            $table->string('street_number')->nullable();
            $table->string('street_bus_number')->nullable();
            $table->string('zipcode')->nullable();
            $table->integer('phone')->nullable();
            //Fysische gegevens
            $table->integer('length');
            $table->integer('weight');
            //Dieetgegevens
            $table->string('activity');
            $table->string('target_id');
            $table->string('info');
            //Afspraakgegevens
            $table->string('login')->unique();
            $table->string('password');

        }); //
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
