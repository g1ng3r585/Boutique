<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ProduitTailleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('produit_taille')->insert([

            [               
                'produit_id' => 1,
                'Taille_id' => 1
            ],
            [               
                'produit_id' => 1,
                'Taille_id' => 2
            ],         [               
                'produit_id' => 1,
                'Taille_id' => 3
            ],
            [               
                'produit_id' => 2,
                'Taille_id' => 4
            ]
        ]); 
    }
}
