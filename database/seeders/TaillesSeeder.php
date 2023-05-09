<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class TaillesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tailles')->insert([

            [               
                'taille' => 'Très très grand'
            ],
                [               
                'taille' => 'Très grand'
            ],
            [               
                'taille' => 'Grand'
            ],
            [               
                'taille' => 'Moyen'
            ],
            [               
                'taille' => 'Petit'
            ],
            [               
                'taille' => 'Très petit'
            ],
        ]);
    }
}
