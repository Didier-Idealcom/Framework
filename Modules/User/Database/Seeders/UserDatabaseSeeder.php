<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Modules\User\Entities\User;

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
        User::truncate();
        DB::table('users')->insert([
            [
                'name' => 'Didier Largeron',
                'email' => 'd.largeron@ideal-com.com',
                'password' => bcrypt('laravel'),
                'created_at' => now(),
                'updated_at' => now(),
                'email_verified_at' => now()
            ]
        ]);
        factory(User::class, 50)->create();
        Schema::disableForeignKeyConstraints();
    }
}
