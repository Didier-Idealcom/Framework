<?php

namespace Modules\Language\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Modules\Language\Entities\Language;

class LanguageDatabaseSeeder extends Seeder
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
        Language::truncate();
        DB::table('languages')->insert([
            [
                'alpha2' => 'fr',
                'alpha3' => 'fra',
                'name' => 'Français',
                'locale' => 'fr_FR',
                'format_date_small' => '%d/%m/%Y',
                'format_date_long' => '%d %B %Y',
                'format_date_time' => '%d/%m/%Y %H:%i:%s'
            ],
            [
                'alpha2' => 'en',
                'alpha3' => 'eng',
                'name' => 'English',
                'locale' => 'fr_FR',
                'format_date_small' => '%m/%d/%Y',
                'format_date_long' => '%B %d %Y',
                'format_date_time' => '%m/%d/%Y %H:%i:%s'
            ],
            [
                'alpha2' => 'es',
                'alpha3' => 'esp',
                'name' => 'Español',
                'locale' => 'fr_FR',
                'format_date_small' => '%d/%m/%Y',
                'format_date_long' => '%d %B %Y',
                'format_date_time' => '%d/%m/%Y %H:%i:%s'
            ],
            [
                'alpha2' => 'it',
                'alpha3' => 'ita',
                'name' => 'Italian',
                'locale' => 'fr_FR',
                'format_date_small' => '%d/%m/%Y',
                'format_date_long' => '%d %B %Y',
                'format_date_time' => '%d/%m/%Y %H:%i:%s'
            ],
            [
                'alpha2' => 'de',
                'alpha3' => 'deu',
                'name' => 'Deutch',
                'locale' => 'fr_FR',
                'format_date_small' => '%d/%m/%Y',
                'format_date_long' => '%d %B %Y',
                'format_date_time' => '%d/%m/%Y %H:%i:%s'
            ]
        ]);
        Schema::enableForeignKeyConstraints();
    }
}
