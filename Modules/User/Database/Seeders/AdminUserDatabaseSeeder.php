<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AdminUserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        DB::table('users')->insert([
            [
                'active' => 'Y',
                'firstname' => 'Didier',
                'lastname' => 'Largeron',
                'email' => 'd.largeron@ideal-com.com',
                'password' => bcrypt('laravel'),
                'created_at' => now(),
                'updated_at' => now(),
                'email_verified_at' => now()
            ]
        ]);
    }
}
