<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use DB;


class CommandesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Commandes')->insert([
            [               

            'produit_id' => 2,
            'taille_id' => 1,
            'couleur_id' => 1,
            'usager_id' => 1,
            'compagne_id' => 1,
            'quantite' => 1,
            'statut' => "attentionAchat",

        ]

        ]);
    }
}
