<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class CouleurProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('couleur_produit')->insert([

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
            ,
            [               
                'produit_id' => 2,
                'couleur_id' => 3
            ]
        ]);    
    }
}
