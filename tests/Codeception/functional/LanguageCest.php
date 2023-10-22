<?php

namespace Tests\Codeception\Functional;

use \FunctionalTester;
use Modules\Core\Entities\Language;

class LanguageCest
{
    public function _before(FunctionalTester $I)
    {
        $I->amLoggedAs(['email' => 'largeron.didier@gmail.com', 'password' => 'laravel'], 'admin');
    }

    public function tryIndex(FunctionalTester $I)
    {
        $I->amOnRoute('admin.languages.index');
        $I->seeCurrentRouteIs('admin.languages.index');
        $I->seeResponseCodeIs(200);
    }

    public function tryCreate(FunctionalTester $I)
    {
        $I->amOnRoute('admin.languages.create');
        $I->seeCurrentRouteIs('admin.languages.create');
        $I->seeResponseCodeIs(200);
    }

    public function tryStore(FunctionalTester $I)
    {
        $I->amOnRoute('admin.languages.create');
        $I->fillField('alpha2', 'af');
        $I->fillField('alpha3', 'afr');
        $I->fillField('locale', 'af_ZA');
        $I->fillField('name', 'Afrikaans');
        $I->fillField('format_date_small', '%d/%m/%Y');
        $I->fillField('format_date_long', '%d %B %Y');
        $I->fillField('format_date_time', '%d/%m/%Y %H:%i:%s');
        $I->click('#kt_app_content #save_close');

        $I->seeCurrentRouteIs('admin.languages.index');
        $I->seeElement('.alert-success');
        $I->seeRecord('languages', ['name' => 'Afrikaans']);
    }

    public function tryEdit(FunctionalTester $I)
    {
        $language = Language::firstOrFail();
        $I->amOnRoute('admin.languages.edit', ['language' => $language]);
        $I->seeCurrentRouteIs('admin.languages.edit');
        $I->seeResponseCodeIs(200);
    }

    public function tryUpdate(FunctionalTester $I)
    {
        $language = Language::firstOrFail();
        $I->amOnRoute('admin.languages.edit', ['language' => $language]);
        $I->fillField('name', 'Language test');
        $I->click('#kt_app_content #save_close');

        $I->seeCurrentRouteIs('admin.languages.index');
        $I->seeElement('.alert-success');
        $I->dontSeeRecord('languages', ['name' => $language->name]);
        $I->seeRecord('languages', ['name' => 'Language test']);
    }

    public function tryDestroy(FunctionalTester $I)
    {
        $language = Language::factory()->create();
        $I->amOnRoute('admin.languages.index');
        $I->seeRecord('languages', ['name' => $language->name]);
        $I->sendAjaxRequest('DELETE', route('admin.languages.destroy', ['language' => $language]));

        $I->seeCurrentRouteIs('admin.languages.index');
        $I->dontSeeRecord('languages', ['name' => $language->name]);
    }
}
