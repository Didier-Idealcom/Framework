<?php

namespace Tests\Codeception\Functional;

use \FunctionalTester;
use Modules\Core\Entities\User;

class UserCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amLoggedAs(['email' => 'largeron.didier@gmail.com', 'password' => 'laravel'], 'admin');
    }

    public function tryIndex(FunctionalTester $I)
    {
        $I->amOnRoute('admin.users.index');
        $I->seeCurrentRouteIs('admin.users.index');
        $I->seeResponseCodeIs(200);
    }

    public function tryCreate(FunctionalTester $I)
    {
        $I->amOnRoute('admin.users.create');
        $I->seeCurrentRouteIs('admin.users.create');
        $I->seeResponseCodeIs(200);
    }

    public function tryStore(FunctionalTester $I)
    {
        $I->amOnRoute('admin.users.create');
        $I->selectOption('#role', ['1']);
        $I->selectOption('#domain', ['1']);
        $I->selectOption('#lang', 'fr');
        $I->fillField('firstname', 'John');
        $I->fillField('lastname', 'Doe');
        $I->fillField('email', 'john@doe.com');
        $I->fillField('password', 'password');
        $I->fillField('password_confirmation', 'password');
        $I->click('#kt_app_content #save_close');

        $I->seeCurrentRouteIs('admin.users.index');
        $I->seeElement('.alert-success');
        $I->seeRecord('users', ['email' => 'john@doe.com']);
    }

    public function tryEdit(FunctionalTester $I)
    {
        $user = User::firstOrFail();
        $I->amOnRoute('admin.users.edit', ['user' => $user]);
        $I->seeCurrentRouteIs('admin.users.edit');
        $I->seeResponseCodeIs(200);
    }

    public function tryUpdate(FunctionalTester $I)
    {
        $user = User::firstOrFail();
        $I->amOnRoute('admin.users.edit', ['user' => $user]);
        $I->fillField('email', 'john@doe.com');
        $I->click('#kt_app_content #save_close');

        $I->seeCurrentRouteIs('admin.users.index');
        $I->seeElement('.alert-success');
        $I->dontSeeRecord('users', ['email' => $user->email]);
        $I->seeRecord('users', ['email' => 'john@doe.com']);
    }

    public function tryDestroy(FunctionalTester $I)
    {
        $user = User::factory()->create();
        $I->amOnRoute('admin.users.index');
        $I->seeRecord('users', ['email' => $user->email]);
        $I->sendAjaxRequest('DELETE', route('admin.users.destroy', ['user' => $user]));

        $I->seeCurrentRouteIs('admin.users.index');
        $I->dontSeeRecord('users', ['email' => $user->email]);
    }
}
