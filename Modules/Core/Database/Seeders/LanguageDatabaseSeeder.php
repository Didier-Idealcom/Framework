<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Modules\Core\Entities\Language;

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
        Language::create([
            'active' => 'Y',
            'alpha2' => 'fr',
            'alpha3' => 'fra',
            'locale' => 'fr_FR',
            'name' => 'Français',
            'flag' => '/images/flags/fr.svg',
            'format_date_small' => '%d/%m/%Y',
            'format_date_long' => '%d %B %Y',
            'format_date_time' => '%d/%m/%Y %H:%i:%s'
        ]);
        Language::create([
            'alpha2' => 'en',
            'alpha3' => 'eng',
            'locale' => 'en_US',
            'name' => 'English',
            'flag' => '/images/flags/en.svg',
            'format_date_small' => '%m/%d/%Y',
            'format_date_long' => '%B %d %Y',
            'format_date_time' => '%m/%d/%Y %H:%i:%s'
        ]);
        Language::create([
            'alpha2' => 'es',
            'alpha3' => 'esp',
            'locale' => 'es_ES',
            'name' => 'Español',
            'flag' => '/images/flags/es.svg',
            'format_date_small' => '%d/%m/%Y',
            'format_date_long' => '%d %B %Y',
            'format_date_time' => '%d/%m/%Y %H:%i:%s'
        ]);
        Language::create([
            'alpha2' => 'it',
            'alpha3' => 'ita',
            'locale' => 'it_IT',
            'name' => 'Italian',
            'flag' => '/images/flags/it.svg',
            'format_date_small' => '%d/%m/%Y',
            'format_date_long' => '%d %B %Y',
            'format_date_time' => '%d/%m/%Y %H:%i:%s'
        ]);
        Language::create([
            'alpha2' => 'de',
            'alpha3' => 'deu',
            'locale' => 'de_DE',
            'name' => 'Deutch',
            'flag' => '/images/flags/de.svg',
            'format_date_small' => '%d/%m/%Y',
            'format_date_long' => '%d %B %Y',
            'format_date_time' => '%d/%m/%Y %H:%i:%s'
        ]);
        Schema::enableForeignKeyConstraints();
    }
}
