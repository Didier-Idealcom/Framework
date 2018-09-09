<?php
$I = new FunctionalTester($scenario);
$I->wantTo('login as a user');

$I->dontSeeRecord('users', array('email' => 'taylor@laravel.com'));

$user = $I->haveRecord('App\User', [
    'name' =>  'Taylor Otwell',
    'email' =>  'taylor@laravel.com',
    'password' => bcrypt('secret'),
    'created_at' => new DateTime(),
    'updated_at' => new DateTime(),
]);

$I->amOnRoute('admin.login');
$I->fillField(['name' => 'email'], $user->email);
$I->fillField(['name' => 'password'], 'secret');
$I->click('Sign In');
$I->seeCurrentRouteIs('admin.dashboard');
$I->seeAuthentication();
$I->see('Dashboard');
