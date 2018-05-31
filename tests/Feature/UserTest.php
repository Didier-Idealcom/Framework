<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertDatabaseMissing('users', [
            'email' => 'd.largeron@ideal-com.com'
        ]);

        $user = factory(User::class)->create();

        $this->assertDatabaseHas('users', [
            'email' => $user->email
        ]);
    }
}
