<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    public function testLoginFunctionFail()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(env('APP_AGENCY_URL') . '/login')
                ->type('email', 'test@gmail.com')
                ->type('password', '123456789')
                ->press('#button-login')
                ->assertPathIs('/login');
        });
    }

    public function testLoginFunctionSuccess()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit(env('APP_AGENCY_URL') . '/login')
                ->type('email', 'test@gmail.com')
                ->type('password', '123')
                ->press('#button-login')
                ->assertPathIs('/');
        });
    }
}
