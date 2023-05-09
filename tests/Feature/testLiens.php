<?php

namespace Tests\Feature;

use App\Models\Usager;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\Concerns\InteractsWithAuthentication;
use Illuminate\Support\Facades\Hash;

use Tests\TestCase;
use Database\Factories\UsagerFactory;

class testLiens extends TestCase
{
    use DatabaseTransactions;
    use InteractsWithAuthentication;

    /**
     * A basic feature test example.
     */
    public function testHomePage(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    public function testLoginForm(): void
    {
        $response = $this->get('/formConnexion');

        $response->assertStatus(200);
    }
    public function testAdminPage(): void
    {
        $user = UsagerFactory::new()->create([
            'email' => 'johnsmith@edu.cegeptr.qc.ca',
            'password' => Hash::make('password'),
            'type' => 'Admin',
            'name' => 'John',
            'lastname' => 'Smith',
        ]);
        $response = $this->actingAs($user)->get(route('admins.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admins.index');
        $this->assertStringEndsWith('@edu.cegeptr.qc.ca', $user->email);
    }

}
