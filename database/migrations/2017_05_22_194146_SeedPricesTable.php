<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()

    {
        DB::table('prices')->insert(
            array(
                array('price' => '0',
                    'role_id' =>'4',
                    'active' => true,
                    'description' =>'prijs per maand'),
                array('price' => '25',
                    'role_id' =>'3',
                    'active' => true,
                    'description' =>'prijs per maand'),
                array('price' => '75',
                    'role_id' =>'2',
                    'active' => true,
                    'description' =>'prijs per maand'),
            ));
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
