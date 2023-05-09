<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {

        $this->call(AdminsSeeder::class);
        $this->call(SuperAdminsSeeder::class);
      
        $this->call(ClientsSeeder::class);
        $this->call(TaillesSeeder::class);
        
        $this->call(CouleursSeeder::class);
        $this->call(CompagnesSeeder::class);
        
        $this->call(ProduitsSeeder::class);
        $this->call(CompagneProduitSeeder::class);
        $this->call(ProduitTailleSeeder::class);
        $this->call(ProduitCouleurSeeder::class);
        $this->call(CouleurProduitSeeder::class);
        $this->call(UsagersSeeder::class);
        $this->call(CommandesSeeder::class);
        $this->call(CommandeProduitSeeder::class);


        
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
