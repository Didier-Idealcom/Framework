<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminLoginTest extends DuskTestCase
{
    /**
     * Test du login admin
     *
     * @return void
     */
    public function testAdminLogin()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/admin/login')
                    ->type('email', 'largeron.didier@gmail.com')
                    //->type('password', 'secret')
                    ->type('password', 'laravel')
                    ->press('Sign In')
                    ->assertPathIs('/admin')
                    ->assertSee('Dashboard');
        });
    }
}
