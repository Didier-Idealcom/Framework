<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Database\Seeders\DomainDatabaseSeeder;
use Modules\Core\Database\Seeders\LanguageDatabaseSeeder;
use Modules\Core\Database\Seeders\UserDatabaseSeeder;
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
