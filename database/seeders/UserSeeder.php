<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->delete();

        \Illuminate\Support\Facades\DB::table('users')->insert([
            'name' => 'Ahmed Abd Ellatif',
            'email' => 'ahmed@gmail.com',
            'password' => Hash::make('123456789'),
        ]);
    }
}
