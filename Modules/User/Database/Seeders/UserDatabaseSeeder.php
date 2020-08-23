<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Modules\User\Entities\User;
use Modules\User\Entities\Role;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        Schema::disableForeignKeyConstraints();
        Role::truncate();
        $role_admin = Role::create([
            'name' => 'Superviseur',
            'guard_name' => 'admin'
        ]);
        $role_client = Role::create([
            'name' => 'Client',
            'guard_name' => 'web'
        ]);
        User::truncate();
        $user = User::create([
            'active' => 'Y',
            'firstname' => 'Didier',
            'lastname' => 'Largeron',
            'email' => 'd.largeron@ideal-com.com',
            'password' => 'laravel'
        ]);
        $user->assignRole($role_admin);
        $user->assignRole($role_client);
        //factory(User::class, 50)->create();
        Schema::enableForeignKeyConstraints();
    }
}
