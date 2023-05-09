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

class testConnexion extends TestCase
{
    /* ========== Superadmin ========== */
/**
 * @test
 */
    public function testSuperAdminAccessToSuperAdminDashboard_ShouldWork(): void
    {
    $user = UsagerFactory::new()->create([
        'email' => 'johnsmith@edu.cegeptr.qc.ca',
        'password' => Hash::make('password'),
        'type' => 'SuperAdmin',
        'name' => 'John',
        'lastname' => 'Smith',
    ]);
    

    $response = $this->actingAs($user)
                     ->get(route('superadmins.index'));

    $response->assertStatus(200);
    $response->assertViewIs('superadmins.index');
    $this->assertStringEndsWith('@edu.cegeptr.qc.ca', $user->email);
    }
    public function testSuperAdminAccessToAdminDashboard_ShouldNotWork(): void
    {
        $user = UsagerFactory::new()->create([
            'email' => 'johnsmith@edu.cegeptr.qc.ca',
            'password' => Hash::make('password'),
            'type' => 'SuperAdmin',
            'name' => 'John',
            'lastname' => 'Smith',
        ]);
    
        $response = $this->actingAs($user)
                         ->get(route('admins.index'));
    
        $response->assertStatus(302);
        $response->assertRedirect(route('produits.index')); // ------------------ à corriger
        $this->assertStringEndsWith('@edu.cegeptr.qc.ca', $user->email);
    }
    public function testSuperAdminAccessToClientDashboard_ShouldWork(): void
    {
        $user = UsagerFactory::new()->create([
            'email' => 'johnsmith@edu.cegeptr.qc.ca',
            'password' => Hash::make('password'),
            'type' => 'SuperAdmin',
            'name' => 'John',
            'lastname' => 'Smith',
        ]);
    
        $response = $this->actingAs($user)
                         ->get(route('produits.index'));
    
        $response->assertStatus(200);
        $this->assertStringEndsWith('@edu.cegeptr.qc.ca', $user->email);
    }
    /* ========== Admin =========== */
    public function testAdminAccessToAdminDashboard_ShouldWork(): void
    {
        $user = UsagerFactory::new()->create([
            'email' => 'johnsmith@edu.cegeptr.qc.ca',
            'password' => Hash::make('password'),
            'type' => 'Admin',
            'name' => 'John',
            'lastname' => 'Smith',
        ]);
    
        $response = $this->actingAs($user)
                         ->get(route('admins.index'));
    
        $response->assertStatus(200);
        $response->assertViewIs('admins.index');
        $this->assertStringEndsWith('@edu.cegeptr.qc.ca', $user->email);
    }
    public function testAdminAccessToSuperAdminDashboard_ShouldNotWork(): void
    {
        $user = UsagerFactory::new()->create([
            'email' => 'johnsmith@edu.cegeptr.qc.ca',
            'password' => Hash::make('password'),
            'type' => 'Admin',
            'name' => 'John',
            'lastname' => 'Smith',
        ]);
    
        $response = $this->actingAs($user)
                         ->get(route('superadmins.index'));
    
        $response->assertStatus(302);
        $response->assertRedirect(route('produits.index')); // ------------- à corriger
        $this->assertStringEndsWith('@edu.cegeptr.qc.ca', $user->email);
    }
    public function testAdminAccessToClientDashboard_ShouldNotWork(): void
    {
        $user = UsagerFactory::new()->create([
            'email' => 'johnsmith@edu.cegeptr.qc.ca',
            'password' => Hash::make('password'),
            'type' => 'Admin',
            'name' => 'John',
            'lastname' => 'Smith',
        ]);
    
        $response = $this->actingAs($user)
                         ->get(route('produits.index'));
    
        $response->assertStatus(200);
        $response->assertViewIs('produits.index');
        $this->assertStringEndsWith('@edu.cegeptr.qc.ca', $user->email);
    }
    /* ========== Client ========== */
    public function testClientAccessToProduitDashboard_ShouldWork(): void
    {
        $user = UsagerFactory::new()->create([
            'email' => 'johnsmith@edu.cegeptr.qc.ca',
            'password' => Hash::make('password'),
            'type' => 'Client',
            'name' => 'John',
            'lastname' => 'Smith',
        ]);
    
        $response = $this->actingAs($user)
                         ->get(route('produits.index'));
    
        $response->assertStatus(200);
        $this->assertStringEndsWith('@edu.cegeptr.qc.ca', $user->email);
    }
    public function testClientAccessToAdminDashboard_ShouldNotWork(): void
    {
        $user = UsagerFactory::new()->create([
            'email' => 'johnsmith@edu.cegeptr.qc.ca',
            'password' => Hash::make('password'),
            'type' => 'Client',
            'name' => 'John',
            'lastname' => 'Smith',
        ]);
    
    
        $response = $this->actingAs($user)
                         ->get(route('admins.index'));
    
        $response->assertStatus(302);
        $response->assertRedirect(route('produits.index'));
        $this->assertStringEndsWith('@edu.cegeptr.qc.ca', $user->email);
    }
    public function testClientAccessToSuperAdminDashboard_ShouldNotWork(): void
    {
        $user = UsagerFactory::new()->create([
            'email' => 'johnsmith@edu.cegeptr.qc.ca',
            'password' => Hash::make('password'),
            'type' => 'Client',
            'name' => 'John',
            'lastname' => 'Smith',
        ]);
    
    
        $response = $this->actingAs($user)
                         ->get(route('superadmins.index'));
    
        $response->assertStatus(302);
        $response->assertRedirect(route('produits.index'));
        $this->assertStringEndsWith('@edu.cegeptr.qc.ca', $user->email);
    }
}