<?php

namespace Tests\Codeception\Functional;

use \FunctionalTester;

class DashboardCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amLoggedAs(['email' => 'largeron.didier@gmail.com', 'password' => 'laravel'], 'admin');
    }

    public function tryDashboard(FunctionalTester $I)
    {
        $I->amOnRoute('admin.dashboard');
        $I->seeCurrentRouteIs('admin.dashboard');
        $I->seeResponseCodeIs(200);
    }
}
