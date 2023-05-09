<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class CommandeProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('commande_produit')->insert([
            [
                'commande_id' => 1,
                'produit_id' => 1,

            ],
        ]);
    }
}
