<?php
$I = new FunctionalTester($scenario);
$I->wantTo('register a user');

$I->amLoggedAs(['email' => 'd.largeron@ideal-com.com', 'password' => 'laravel'], 'admin');

$I->amOnRoute('admin.users.create');
$I->selectOption('#role', ['1']);
$I->fillField('firstname', 'John');
$I->fillField('lastname', 'Doe');
$I->fillField('email', 'john@doe.com');
$I->fillField('password', 'password');
$I->fillField('password_confirmation', 'password');
$I->click('#kt_app_content button[type=submit]');

$I->amOnRoute('admin.users.index');
$I->seeRecord('users', ['email' => 'john@doe.com']);
