<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdminLoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * Test du login admin
     *
     * @return void
     */
    public function testAdminLogin()
    {
        $user = factory(User::class)->create([
            'email' => 'taylor@laravel.com'
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/admin/login')
                    ->type('email', $user->email)
                    ->type('password', 'secret')
                    ->press('Sign In')
                    ->assertPathIs('/admin')
                    ->assertSee('Dashboard');
        });
    }
}
