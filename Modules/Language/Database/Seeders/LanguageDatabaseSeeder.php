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
                'name' => 'Français',
                'format_date_small' => '%d/%m/%Y',
                'format_date_long' => '%d %B %Y',
                'format_date_time' => '%d/%m/%Y %H:%i:%s'
            ],
            [
                'alpha2' => 'en',
                'name' => 'English',
                'format_date_small' => '%m/%d/%Y',
                'format_date_long' => '%B %d %Y',
                'format_date_time' => '%m/%d/%Y %H:%i:%s'
            ],
            [
                'alpha2' => 'es',
                'name' => 'Español',
                'format_date_small' => '%d/%m/%Y',
                'format_date_long' => '%d %B %Y',
                'format_date_time' => '%d/%m/%Y %H:%i:%s'
            ],
            [
                'alpha2' => 'it',
                'name' => 'Italian',
                'format_date_small' => '%d/%m/%Y',
                'format_date_long' => '%d %B %Y',
                'format_date_time' => '%d/%m/%Y %H:%i:%s'
            ],
            [
                'alpha2' => 'de',
                'name' => 'Deutch',
                'format_date_small' => '%d/%m/%Y',
                'format_date_long' => '%d %B %Y',
                'format_date_time' => '%d/%m/%Y %H:%i:%s'
            ]
        ]);
        Schema::disableForeignKeyConstraints();
    }
}
