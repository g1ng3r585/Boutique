<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CompagnesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('compagnes')->insert([

            [               
                'dateDebut' => '2023-04-01',
                'dateFin' => '2025-05-06',
                'debutPaiement' => '2023-05-02',
                'finPaiement' => '2023-06-03',
                'debutDistribution' => '2023-06-04',
                'finDistribution' => '2023-07-05',
                'statutCompagne' => 'enCours',
                'statutCommande' => 'enPaiement'
            ],
            [               
                'dateDebut' => '2022-01-01',
                'dateFin' => '2025-02-06',
                'debutPaiement' => '2023-05-02',
                'finPaiement' => '2023-06-03',
                'debutDistribution' => '2023-06-04',
                'finDistribution' => '2023-07-05',
                'statutCompagne' => 'terminer',
                'statutCommande' => 'terminer'
            ],
            [               
                'dateDebut' => '2022-01-01',
                'dateFin' => '2025-02-06',
                'debutPaiement' => '2023-05-02',
                'finPaiement' => '2023-06-03',
                'debutDistribution' => '2023-06-04',
                'finDistribution' => '2023-07-05',
                'statutCompagne' => 'terminer',
                'statutCommande' => 'terminer'
            ],
            [               
                'dateDebut' => '2022-01-01',
                'dateFin' => '2025-02-06',
                'debutPaiement' => '2023-05-02',
                'finPaiement' => '2023-06-03',
                'debutDistribution' => '2023-06-04',
                'finDistribution' => '2023-07-05',
                'statutCompagne' => 'terminer',
                'statutCommande' => 'terminer'
            ]
        ]);  
      }
}
