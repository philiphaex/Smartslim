<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class LoginTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/login')
                    ->type('email','philip.haex@gmail.com')
                    ->type('password','Syntra2017')
                    ->press('Login')
                    ->assertSee('overzicht');

        });

        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Philip Haex');

        });
    }
}
