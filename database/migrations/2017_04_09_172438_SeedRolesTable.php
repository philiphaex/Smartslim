<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('roles')->insert(
        array(
            array('name' => 'admin',
                  'display_name' =>'Admin',
                  'description' =>'Administrator toegang'),
            array('name' => 'level1',
                  'display_name' =>'Start',
                  'description' =>'Gratis pakket, cliëntbeheer, max 10 cliënten per maand'),
            array('name' => 'level2',
                'display_name' =>'Basis',
                'description' =>'Basis pakket, agenda, max 30 cliënten per maand' ),
            array('name' => 'level3',
                'display_name' =>'Professioneel',
                'description' =>'Professioneel pakket, cliëntenlogboek, max 60 cliënten per maand' ),
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
