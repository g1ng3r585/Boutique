<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use DB;

class UsagersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usagers')->insert([

            [               
                'email' => 'fabrice.dehoule@cegeptr.qc.ca',
                'password' => Hash::make('Password123'),
                'name' => 'Fabrice',
                'lastname' => 'Dehoule',
                'type' => 'Admin'
            ],
            [               
                'email' => 'lyes.aidoun.01@edu.cegeptr.qc.ca',
                'password' => Hash::make('Password123'),
                'name' => 'Lyes',
                'lastname' => 'Aidoun',
                'type' => 'Client'

            ] ,
            [               
                'email' => 'super.admin.01@cegeptr.qc.ca',
                'password' => Hash::make('Password123'),
                'name' => 'Super',
                'lastname' => 'Admin',
                'type' => 'SuperAdmin'

            ]
        ]); 
    }
}
