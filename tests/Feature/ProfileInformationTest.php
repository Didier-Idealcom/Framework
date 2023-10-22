<?php

namespace Tests\Feature;

use Modules\Core\Entities\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Http\Livewire\CustomUpdateProfileInformationForm;
use Livewire\Livewire;
use Tests\TestCase;

class ProfileInformationTest extends TestCase
{
    use RefreshDatabase;

    public function test_current_profile_information_is_available(): void
    {
        $this->actingAs($user = User::factory()->create());

        $component = Livewire::test(CustomUpdateProfileInformationForm::class);

        $this->assertEquals($user->firstname, $component->state['firstname']);
        $this->assertEquals($user->lastname, $component->state['lastname']);
        $this->assertEquals($user->email, $component->state['email']);
    }

    public function test_profile_information_can_be_updated(): void
    {
        $this->actingAs($user = User::factory()->create());

        Livewire::test(CustomUpdateProfileInformationForm::class)
                ->set('state', ['firstname' => 'John', 'lastname' => 'Doe', 'email' => 'test@example.com'])
                ->call('updateProfileInformation');

        $this->assertEquals('John', $user->fresh()->firstname);
        $this->assertEquals('Doe', $user->fresh()->lastname);
        $this->assertEquals('test@example.com', $user->fresh()->email);
    }
}
