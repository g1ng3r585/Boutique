<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class CouleursSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('couleurs')->insert([
            
            [               
                'couleur' => 'Black',
                'hex' => '#000000'

            ],
            [               
                'couleur' => 'Navy',
                'hex' => '#000080'

            ],
            [               
                'couleur' => 'Red',
                'hex' => '#FF0000'

            ],
            [               
                'couleur' => 'Jade dome',
                'hex' => '#008E85'

            ],
            [               
                'couleur' => 'Purple',
                'hex' => '#800080'

            ],
            [               
                'couleur' => 'Antiq red cherry',
                'hex' => '#971B2F'

            ],
            [               
                'couleur' => 'Dark heather',
                'hex' => '#5C6278 '

            ],
            [               
                'couleur' => 'Forest green',
                'hex' => '#228B22'

                
            ],
            [               
                'couleur' => 'Military green',
                'hex' => '#4b5320'

            ],
            [               
                'couleur' => 'Royal',
                'hex' => '#4169E1'

            ],
            [               
                'couleur' => 'Dark chocolate',
                'hex' => '#490206 '

            ],
            [               
                'couleur' => 'Antique saphir',
                'hex' => '#56a3bf '

            ]
            
        ]);    }
}
