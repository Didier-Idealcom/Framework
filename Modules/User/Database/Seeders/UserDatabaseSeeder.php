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
        DB::table('languages')->insert([
            [
                'name' => 'Didier Largeron',
                'email' => 'd.largeron@ideal-com.com',
                'password' => Hash::make('laravel')
            ]
        ]);
        //factory(User::class, 50)->create();
        Schema::disableForeignKeyConstraints();
    }
}
