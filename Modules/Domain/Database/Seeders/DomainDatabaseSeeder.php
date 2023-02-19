<?php

namespace Modules\Domain\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use Modules\Domain\Entities\Domain;

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
        Schema::enableForeignKeyConstraints();
    }
}
