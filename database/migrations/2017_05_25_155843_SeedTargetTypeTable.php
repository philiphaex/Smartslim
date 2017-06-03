<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedTargetTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('target_types')->insert(
            array(
                array('name' => 'Normaal',
                    'description' =>'Standaard begeleiding'),
                array('name' => 'Vermageren',
                    'description' =>'Gewicht verliezen'),
                array('name' => 'Verdikken',
                    'description' =>'Gewicht bijkomen'),
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
