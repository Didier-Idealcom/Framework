<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Modules\Core\Entities\Permission;
use Modules\Core\Entities\Role;
use Modules\Core\Entities\User;

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

        Permission::truncate();
        Permission::create([
            'name' => 'User_read',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'User_edit',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'User_create',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'User_delete',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'Role_read',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'Role_edit',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'Role_create',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'Role_delete',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'Permission_read',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'Permission_edit',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'Permission_create',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'Permission_delete',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'Domain_read',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'Domain_edit',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'Domain_create',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'Domain_delete',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'Language_read',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'Language_edit',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'Language_create',
            'guard_name' => 'admin',
        ]);
        Permission::create([
            'name' => 'Language_delete',
            'guard_name' => 'admin',
        ]);

        Role::truncate();
        $role_admin = Role::create([
            'name' => 'Superviseur',
            'guard_name' => 'admin',
        ]);
        $role_admin->givePermissionTo(['User_read', 'User_edit', 'User_create', 'User_delete']);
        $role_admin->givePermissionTo(['Role_read', 'Role_edit', 'Role_create', 'Role_delete']);
        $role_admin->givePermissionTo(['Permission_read', 'Permission_edit', 'Permission_create', 'Permission_delete']);
        $role_admin->givePermissionTo(['Domain_read', 'Domain_edit', 'Domain_create', 'Domain_delete']);
        $role_admin->givePermissionTo(['Language_read', 'Language_edit', 'Language_create', 'Language_delete']);

        $role_client = Role::create([
            'name' => 'Client',
            'guard_name' => 'web',
        ]);

        User::truncate();
        $user = User::create([
            'lang' => 'fr',
            'active' => 'Y',
            'firstname' => 'Didier',
            'lastname' => 'Largeron',
            'email' => 'largeron.didier@gmail.com',
            'password' => 'laravel',
        ]);
        $user->assignRole($role_admin);
        $user->assignRole($role_client);
        $user->domains()->sync([1]);

        Schema::enableForeignKeyConstraints();
    }
}
