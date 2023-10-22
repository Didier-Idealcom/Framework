<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Modules\Menu\Database\Seeders\MenuDatabaseSeeder;

class CoreDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call([
            LanguageDatabaseSeeder::class,
            DomainDatabaseSeeder::class,
            UserDatabaseSeeder::class,
            MenuDatabaseSeeder::class,
        ]);
    }
}
