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
                array('name' => 'normaal',
                    'description' =>'standaard begeleiding'),
                array('name' => 'vermageren',
                    'description' =>'gewicht verliezen'),
                array('name' => 'verdikken',
                    'description' =>'gewicht bijkomen'),
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
