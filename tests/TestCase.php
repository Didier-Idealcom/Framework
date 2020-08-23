<?php

namespace Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Modules\Core\Database\Seeders\CoreDatabaseSeeder;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    public $token = '';

    protected function setUp(): void
    {
        parent::setUp();

        Artisan::call('passport:install');
        $this->seed(CoreDatabaseSeeder::class);

        $payload = ['email' => 'd.largeron@ideal-com.com', 'password' => 'laravel'];
        $result = $this->json('POST', 'api/login', $payload)
                       ->decodeResponseJson();
        $this->token = $result['success']['token'];
    }
}
