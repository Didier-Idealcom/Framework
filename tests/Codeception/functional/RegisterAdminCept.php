<?php
$I = new FunctionalTester($scenario);
$I->wantTo('register a user');

$user = $I->haveRecord('Modules\User\Entities\User', [
    'name' =>  'Didier Largeron',
    'email' =>  'd.largeron@ideal-com.com',
    'password' => bcrypt('laravel'),
    'created_at' => new DateTime(),
    'updated_at' => new DateTime(),
]);
$I->amLoggedAs($user, 'admin');

$I->amOnRoute('admin.users.create');
$I->fillField('name', 'John Doe');
$I->fillField('email', 'john@doe.com');
$I->fillField('password', 'password');
$I->fillField('password_confirmation', 'password');
$I->click('.m-content button[type=submit]');

$I->amOnRoute('admin.users.index');
$I->seeRecord('users', ['email' => 'john@doe.com']);
