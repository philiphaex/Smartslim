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
                array('name' => 'client-index',
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
                    'description' =>'Delete client'),
                array('name' => 'client-archive',
                    'display_name' =>'Archive client',
                    'description' =>'Archive client'),
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
