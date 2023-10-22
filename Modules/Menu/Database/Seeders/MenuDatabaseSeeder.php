<?php

namespace Modules\Menu\Database\Seeders;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Modules\Menu\Entities\Menu;
use Modules\Menu\Entities\Menuitem;
use Modules\Menu\Entities\MenuitemTranslation;
use Modules\Menu\Entities\MenuTranslation;

class MenuDatabaseSeeder extends Seeder
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
        Menu::truncate();
        MenuTranslation::truncate();
        Menuitem::truncate();
        MenuitemTranslation::truncate();
        Menu::create([
            'code' => 'main',
            'active' => 'Y',
            'en' => [
                'title' => 'Main menu',
            ],
            'fr' => [
                'title' => 'Menu principal',
            ],
        ]);
        Schema::enableForeignKeyConstraints();
    }
}
