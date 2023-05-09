<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use DB;

class SuperAdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('superAdmins')->insert([

            [               
                'email' => 'super.admin.01@cegeptr.qc.ca',
                'password' => Hash::make('Password123'),
            ]
        ]);    
    }
}
