<?php

namespace Tests\Codeception\Functional;

use \FunctionalTester;
use Modules\Core\Entities\Domain;

class DomainCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amLoggedAs(['email' => 'largeron.didier@gmail.com', 'password' => 'laravel'], 'admin');
    }

    public function tryIndex(FunctionalTester $I)
    {
        $I->amOnRoute('admin.domains.index');
        $I->seeCurrentRouteIs('admin.domains.index');
        $I->seeResponseCodeIs(200);
    }

    public function tryCreate(FunctionalTester $I)
    {
        $I->amOnRoute('admin.domains.create');
        $I->seeCurrentRouteIs('admin.domains.create');
        $I->seeResponseCodeIs(200);
    }

    public function tryStore(FunctionalTester $I)
    {
        $I->amOnRoute('admin.domains.create');
        $I->fillField('title', 'Domaine test');
        $I->fillField('name', 'domaine.test');
        $I->click('#kt_app_content #save_close');

        $I->seeCurrentRouteIs('admin.domains.index');
        $I->seeElement('.alert-success');
        $I->seeRecord('domains', ['name' => 'domaine.test']);
    }

    public function tryEdit(FunctionalTester $I)
    {
        $domain = Domain::firstOrFail();
        $I->amOnRoute('admin.domains.edit', ['domain' => $domain]);
        $I->seeCurrentRouteIs('admin.domains.edit');
        $I->seeResponseCodeIs(200);
    }

    public function tryUpdate(FunctionalTester $I)
    {
        $domain = Domain::firstOrFail();
        $I->amOnRoute('admin.domains.edit', ['domain' => $domain]);
        $I->fillField('name', 'domain.test');
        $I->click('#kt_app_content #save_close');

        $I->seeCurrentRouteIs('admin.domains.index');
        $I->seeElement('.alert-success');
        $I->dontSeeRecord('domains', ['name' => $domain->name]);
        $I->seeRecord('domains', ['name' => 'domain.test']);
    }

    public function tryDestroy(FunctionalTester $I)
    {
        $domain = Domain::factory()->create();
        $I->amOnRoute('admin.domains.index');
        $I->seeRecord('domains', ['name' => $domain->name]);
        $I->sendAjaxRequest('DELETE', route('admin.domains.destroy', ['domain' => $domain]));

        $I->seeCurrentRouteIs('admin.domains.index');
        $I->dontSeeRecord('domains', ['name' => $domain->name]);
    }
}
