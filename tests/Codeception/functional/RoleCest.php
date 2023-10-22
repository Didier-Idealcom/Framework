<?php

namespace Tests\Codeception\Functional;

use \FunctionalTester;
use Modules\Core\Entities\Role;

class RoleCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amLoggedAs(['email' => 'largeron.didier@gmail.com', 'password' => 'laravel'], 'admin');
    }

    public function tryIndex(FunctionalTester $I)
    {
        $I->amOnRoute('admin.roles.index');
        $I->seeCurrentRouteIs('admin.roles.index');
        $I->seeResponseCodeIs(200);
    }

    public function tryCreate(FunctionalTester $I)
    {
        $I->amOnRoute('admin.roles.create');
        $I->seeCurrentRouteIs('admin.roles.create');
        $I->seeResponseCodeIs(200);
    }

    public function tryStore(FunctionalTester $I)
    {
        $I->amOnRoute('admin.roles.create');
        $I->fillField('name', 'Role test');
        $I->selectOption('guard_name', 'admin');
        $I->click('#kt_app_content #save_close');

        $I->seeCurrentRouteIs('admin.roles.index');
        $I->seeElement('.alert-success');
        $I->seeRecord('roles', ['name' => 'Role test']);
    }

    public function tryEdit(FunctionalTester $I)
    {
        $role = Role::firstOrFail();
        $I->amOnRoute('admin.roles.edit', ['role' => $role]);
        $I->seeCurrentRouteIs('admin.roles.edit');
        $I->seeResponseCodeIs(200);
    }

    public function tryUpdate(FunctionalTester $I)
    {
        $role = Role::firstOrFail();
        $I->amOnRoute('admin.roles.edit', ['role' => $role]);
        $I->fillField('name', 'Role test');
        $I->click('#kt_app_content #save_close');

        $I->seeCurrentRouteIs('admin.roles.index');
        $I->seeElement('.alert-success');
        $I->dontSeeRecord('roles', ['name' => $role->name]);
        $I->seeRecord('roles', ['name' => 'Role test']);
    }

    public function tryDestroy(FunctionalTester $I)
    {
        $role = Role::factory()->create();
        $I->amOnRoute('admin.roles.index');
        $I->seeRecord('roles', ['name' => $role->name]);
        $I->sendAjaxRequest('DELETE', route('admin.roles.destroy', ['role' => $role]));

        $I->seeCurrentRouteIs('admin.roles.index');
        $I->dontSeeRecord('roles', ['name' => $role->name]);
    }
}
