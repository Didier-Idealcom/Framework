<?php
$I = new FunctionalTester($scenario);
$I->wantTo('login as a user');

$I->dontSeeRecord('users', array('email' => 'taylor@laravel.com'));

// Création de l'utilisateur
$user = $I->haveRecord('Modules\User\Entities\User', [
    'firstname' => 'Taylor',
    'lastname' => 'Otwell',
    'email' => 'taylor@laravel.com',
    'password' => 'secret',
    'created_at' => new DateTime(),
    'updated_at' => new DateTime()
]);

$I->seeRecord('users', ['email' => 'taylor@laravel.com']);

// Intéraction page Login
$I->amOnRoute('admin.login');
$I->fillField(['name' => 'email'], $user->email);
$I->fillField(['name' => 'password'], 'secret');
$I->click('Sign In');

$I->seeCurrentRouteIs('admin.dashboard');
$I->seeAuthentication();
$I->see('Dashboard');
