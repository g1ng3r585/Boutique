<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ProduitCouleurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('produit_couleur')->insert([

            [               
                'produit_id' => 1,
                'couleur_id' => 1
            ],
            [               
                'produit_id' => 1,
                'couleur_id' => 2
            ],         
            [               
                'produit_id' => 1,
                'couleur_id' => 3
            ],
            [               
                'produit_id' => 2,
                'couleur_id' => 4
            ]
        ]); 
    }
}
