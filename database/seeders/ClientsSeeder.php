<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use DB;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('clients')->insert([

            [               
                'email' => 'patate@edu.cegeptr.qc.ca',
                'name' => 'patate',
                'lastname' => 'chaude',
                'password' => Hash::make('Password123'),
            ]
        ]);
    }
}
