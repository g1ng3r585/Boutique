<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CompagneProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('compagne_produit')->insert([

            [               
                'compagne_id' => 1,
                'produit_id' => 1
            ],            
            [               
                'compagne_id' => 1,
                'produit_id' => 2
            ],            
            [               
                'compagne_id' => 2,
                'produit_id' => 1
            ]
        ]);    
    }
}
