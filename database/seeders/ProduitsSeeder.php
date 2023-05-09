<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class ProduitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('produits')->insert([

            [               
                'image' => 'tshirt.jpg',
                'titre' => 'Shirt',
                'prix' => '1.19',
                'caracteristiques' => 'Chandail',
                'nombreMax' => 5

            ],
            [               
                'image' => 'short.png',
                'titre' => 'Short',
                'prix' => '2.20',
                'caracteristiques' => 'Short',
                'nombreMax' => 4

                
            ],
            [               
                'image' => 'tshirt.jpg',
                'titre' => 'Shirt',
                'prix' => '2.20',
                'caracteristiques' => 'Chandail',
                'nombreMax' => 4
                
            ],
            [               
                'image' => 'tshirt.jpg',
                'titre' => 'Shirt',
                'prix' => '2.20',
                'caracteristiques' => 'Chandail',
                'nombreMax' => 3
                
            ]
        ]);
    }
}
