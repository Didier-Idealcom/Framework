<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Modules\Core\Entities\User;

class UserTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $payload = ['email' => 'largeron.didier@gmail.com', 'password' => 'laravel'];
        $result = $this->json('POST', 'api/login', $payload)
                       ->decodeResponseJson();
        $this->token = $result['success']['token'];
    }

    public function testUsersAreListedCorrectly()
    {
        $headers = ['Authorization' => 'Bearer ' . $this->token];
        $this->json('GET', '/api/users', [], $headers)
            ->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => ['id', 'active', 'firstname', 'lastname', 'email', 'created_at', 'updated_at', 'email_verified_at']
                ]
            ]);
    }

    public function testUsersAreCreatedCorrectly()
    {
        $headers = ['Authorization' => 'Bearer ' . $this->token];
        $payload = [
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'john@doe.fr',
            'password' => 'test'
        ];

        $this->json('POST', '/api/users', $payload, $headers)
            ->assertStatus(201)
            ->assertJson([
                'id' => 2,
                'firstname' => 'John',
                'lastname' => 'Doe',
                'email' => 'john@doe.fr'
            ]);
        $this->assertDatabaseHas('users', ['email' => 'john@doe.fr']);
    }

    public function testUsersAreUpdatedCorrectly()
    {
        $headers = ['Authorization' => 'Bearer ' . $this->token];
        $payload = [
            'firstname' => 'John',
            'lastname' => 'Doe'
        ];

        $user = User::first();
        $this->json('PUT', '/api/users/' . $user->id, $payload, $headers)
            ->assertStatus(200)
            ->assertJson([
                'id' => 1,
                'firstname' => 'John',
                'lastname' => 'Doe',
                'email' => 'largeron.didier@gmail.com'
            ]);
    }

    public function testUsersAreDeletedCorrectly()
    {
        $headers = ['Authorization' => 'Bearer ' . $this->token];
        $user = User::create([
            'firstname' => 'John',
            'lastname' => 'Doe',
            'email' => 'john@doe.fr',
            'password' => 'test'
        ]);

        $this->json('DELETE', '/api/users/' . $user->id, [], $headers)
            ->assertStatus(204);
        $this->assertDatabaseMissing('users', ['email' => 'john@doe.fr']);
    }
}
