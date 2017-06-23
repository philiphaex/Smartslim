<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('permissions')->insert(
            array(
                array('name' => 'level1',
                    'display_name' =>'10',
                    'description' =>'clients/month'),
                array('name' => 'level2',
                    'display_name' =>'30',
                    'description' =>'clients/month'),
                array('name' => 'level3',
                    'display_name' =>'60',
                    'description' =>'clients/month'),
                /*array('name' => 'client-index',
                    'display_name' =>'Display all clients',
                    'description' =>'Shows a list of clients'),
                array('name' => 'client-create',
                    'display_name' =>'Create client',
                    'description' =>'Create a new client'),
                array('name' => 'client-edit',
                    'display_name' =>'Edit client',
                    'description' =>'Edit client'),
                array('name' => 'client-delete',
                    'display_name' =>'Delete client',
                    'description' =>'Delete client'),*/
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
