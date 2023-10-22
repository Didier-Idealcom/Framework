<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;
use Modules\Core\Database\Seeders\CoreDatabaseSeeder;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    public $token = '';

    protected function setUp(): void
    {
        parent::setUp();

        Artisan::call('passport:install');
        $this->seed(CoreDatabaseSeeder::class);
    }
}
