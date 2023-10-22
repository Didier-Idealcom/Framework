<?php

namespace Tests\Codeception\Functional;

use FunctionalTester;

class LoginAdminCest
{
    public function _before(FunctionalTester $I)
    {
    }

    public function tryToLoginAsUser(FunctionalTester $I)
    {
        $I->dontSeeRecord('users', ['email' => 'taylor@laravel.com']);

        // Création de l'utilisateur
        $user = $I->haveRecord('Modules\Core\Entities\User', [
            'lang' => 'fr',
            'firstname' => 'Taylor',
            'lastname' => 'Otwell',
            'email' => 'taylor@laravel.com',
            'password' => 'secret',
            'created_at' => new \DateTime(),
            'updated_at' => new \DateTime(),
        ]);

        $I->seeRecord('users', ['email' => 'taylor@laravel.com']);

        $I->haveRecord('model_has_roles', [
            'role_id' => 1,
            'model_type' => 'Modules\Core\Entities\User',
            'model_id' => $user->id,
        ]);
        $I->haveRecord('model_has_domains', [
            'domain_id' => 1,
            'model_type' => 'Modules\Core\Entities\User',
            'model_id' => $user->id,
        ]);

        // Intéraction page Login
        $I->amOnRoute('admin.login');
        $I->fillField('email', $user->email);
        $I->fillField('password', 'secret');
        $I->click('#kt_sign_in_submit');

        $I->seeCurrentRouteIs('admin.dashboard');
        $I->seeAuthentication();
        $I->see('Dashboard');
    }
}
