<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedPermissionRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('permission_role')->insert(
            array(
                array('permission_id' => '1',
                    'role_id' =>'4',),
                array('permission_id' => '2',
                    'role_id' =>'3',),
                array('permission_id' => '3',
                    'role_id' =>'2',),
            )
        );
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
