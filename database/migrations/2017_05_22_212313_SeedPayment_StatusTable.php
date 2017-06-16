<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedPaymentStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('payment_status')->insert(
            array(
                array('name' => 'created',
                    'description' =>'betaling werd gecreëerd'),
                array('name' => 'completed',
                    'description' =>'betaling werd ontvangen'),
                array('name' => 'error',
                    'description' =>'betalingstatus wordt onderzocht'),
                array('name' => 'free',
                    'description' =>'gratis geen betaling'),
                array('name' => 'stop',
                    'description' =>'account is stopgezet'),
                array('name' => 'overdue',
                    'description' =>'geen tijdige betaling gedaan'),
                array('name' => 'upgrade',
                    'description' =>'abonnement wordt omhoog aangepast'),
                array('name' => 'downgrade',
                    'description' =>'abonnement wordt omhoog aangepast'),
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
