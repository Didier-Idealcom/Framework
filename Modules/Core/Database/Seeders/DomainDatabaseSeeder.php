<?php

namespace Modules\Core\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Modules\Core\Entities\Domain;
use Modules\Core\Entities\DomainLanguage;

class DomainDatabaseSeeder extends Seeder
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
        Domain::truncate();
        Domain::create([
            'active' => 'Y',
            'title' => 'Laravel',
            'name' => 'laravel.test'
        ]);
        DomainLanguage::truncate();
        DomainLanguage::create([
            'domain_id' => 1,
            'language_id' => 1,
            'active' => 'Y'
        ]);
        Schema::enableForeignKeyConstraints();
    }
}
