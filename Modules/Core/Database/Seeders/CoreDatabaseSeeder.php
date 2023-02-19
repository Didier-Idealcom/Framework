<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Domain\Database\Seeders\DomainDatabaseSeeder;
use Modules\Language\Database\Seeders\LanguageDatabaseSeeder;
use Modules\Menu\Database\Seeders\MenuDatabaseSeeder;
use Modules\User\Database\Seeders\UserDatabaseSeeder;

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
            DomainDatabaseSeeder::class,
            LanguageDatabaseSeeder::class,
            MenuDatabaseSeeder::class,
            UserDatabaseSeeder::class,
        ]);
    }
}
