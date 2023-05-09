<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use DB;

class AdminsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admins')->insert([

            [               
                'email' => 'fabrice.dehoule@cegeptr.qc.ca',
                'name' => 'Fabrice',
                'lastname' => 'Dehoule',
                'password' => Hash::make('Password123'),
            ]
        ]);
    }
}
