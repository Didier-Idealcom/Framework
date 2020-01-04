<?php

namespace Modules\Menu\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Modules\Menu\Entities\Menu;
use Modules\Menu\Entities\MenuTranslation;
use Modules\Menu\Entities\Menuitem;
use Modules\Menu\Entities\MenuitemTranslation;

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
            'code' => 'home',
            'en' => [
                'title' => 'Home menu'
            ],
            'fr' => [
                'title' => 'Menu accueil'
            ]
        ]);
        Menu::create([
            'code' => 'main',
            'en' => [
                'title' => 'Main menu'
            ],
            'fr' => [
                'title' => 'Menu principal'
            ]
        ]);
        Schema::enableForeignKeyConstraints();
    }
}
