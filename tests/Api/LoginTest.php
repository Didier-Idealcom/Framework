<?php

namespace Tests\Feature\Api;

use Tests\TestCase;

class LoginTest extends TestCase
{
    public function testLoginValidation()
    {
        $this->json('POST', 'api/login')
            ->assertStatus(400)
            ->assertJson([
                'message' => 'Bad Request.',
                'errors' => [
                    'email' => ['Le champ adresse courriel est obligatoire.'],
                    'password' => ['Le champ mot de passe est obligatoire.']
                ]
            ]);
    }

    public function testLoginSuccess()
    {
        $this->assertDatabaseHas('users', [
            'email' => 'd.largeron@ideal-com.com'
        ]);

        $payload = ['email' => 'd.largeron@ideal-com.com', 'password' => 'laravel'];
        $this->json('POST', 'api/login', $payload)
            ->assertStatus(202)
            ->assertJsonStructure([
                'success' => [
                    'token',
                    'user' => [
                        'id',
                        'firstname',
                        'lastname',
                        'email',
                        'created_at',
                        'updated_at'
                    ]
                ]
            ]);
    }

    public function testLoginError()
    {
        $payload = ['email' => 'd.largeron@ideal-com.com', 'password' => 'badpassword'];
        $this->json('POST', 'api/login', $payload)
            ->assertStatus(401)
            ->assertJson([
                'error' => 'Unauthenticated.'
            ]);
    }
}
