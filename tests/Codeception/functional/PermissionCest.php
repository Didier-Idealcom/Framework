<?php

namespace Tests\Codeception\Functional;

use \FunctionalTester;
use Modules\Core\Entities\Permission;

class PermissionCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amLoggedAs(['email' => 'largeron.didier@gmail.com', 'password' => 'laravel'], 'admin');
    }

    public function tryIndex(FunctionalTester $I)
    {
        $I->amOnRoute('admin.permissions.index');
        $I->seeCurrentRouteIs('admin.permissions.index');
        $I->seeResponseCodeIs(200);
    }

    public function tryCreate(FunctionalTester $I)
    {
        $I->amOnRoute('admin.permissions.create');
        $I->seeCurrentRouteIs('admin.permissions.create');
        $I->seeResponseCodeIs(200);
    }

    public function tryStore(FunctionalTester $I)
    {
        $I->amOnRoute('admin.permissions.create');
        $I->fillField('name', 'Permission_test');
        $I->selectOption('guard_name', 'admin');
        $I->click('#kt_app_content #save_close');

        $I->seeCurrentRouteIs('admin.permissions.index');
        $I->seeElement('.alert-success');
        $I->seeRecord('permissions', ['name' => 'Permission_test']);
    }

    public function tryEdit(FunctionalTester $I)
    {
        $permission = Permission::firstOrFail();
        $I->amOnRoute('admin.permissions.edit', ['permission' => $permission]);
        $I->seeCurrentRouteIs('admin.permissions.edit');
        $I->seeResponseCodeIs(200);
    }

    public function tryUpdate(FunctionalTester $I)
    {
        $permission = Permission::firstOrFail();
        $I->amOnRoute('admin.permissions.edit', ['permission' => $permission]);
        $I->fillField('name', 'Permission_test');
        $I->click('#kt_app_content #save_close');

        $I->seeCurrentRouteIs('admin.permissions.index');
        $I->seeElement('.alert-success');
        $I->dontSeeRecord('permissions', ['name' => $permission->name]);
        $I->seeRecord('permissions', ['name' => 'Permission_test']);
    }

    public function tryDestroy(FunctionalTester $I)
    {
        $permission = Permission::factory()->create();
        $I->amOnRoute('admin.permissions.index');
        $I->seeRecord('permissions', ['name' => $permission->name]);
        $I->sendAjaxRequest('DELETE', route('admin.permissions.destroy', ['permission' => $permission]));

        $I->seeCurrentRouteIs('admin.permissions.index');
        $I->dontSeeRecord('permissions', ['name' => $permission->name]);
    }
}
