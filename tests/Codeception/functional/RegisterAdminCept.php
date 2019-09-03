<?php
$I = new FunctionalTester($scenario);
$I->wantTo('register a user');

// Création de l'utilisateur
$user = $I->haveRecord('Modules\User\Entities\User', [
    'name' =>  'Didier Largeron',
    'email' =>  'd.largeron@ideal-com.com',
    'password' => bcrypt('laravel'),
    'created_at' => new DateTime(),
    'updated_at' => new DateTime()
]);
$I->amLoggedAs($user, 'admin');

// Création d'un rôle
$role = $I->haveRecord('Modules\User\Entities\Role', [
    'name' =>  'Rôle 1',
    'guard_name' =>  'admin',
    'created_at' => new DateTime(),
    'updated_at' => new DateTime()
]);

$I->amOnRoute('admin.users.create');
$I->selectOption('#role', array($role->id));
$I->fillField('name', 'John Doe');
$I->fillField('email', 'john@doe.com');
$I->fillField('password', 'password');
$I->fillField('password_confirmation', 'password');
$I->click('.m-content button[type=submit]');

$I->amOnRoute('admin.users.index');
$I->seeRecord('users', ['email' => 'john@doe.com']);
