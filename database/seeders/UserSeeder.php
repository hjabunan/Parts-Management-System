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
        DB::table('pms_users')->insert([
            'name' => 'Henry Jabunan',
            'email' => 'it04@toyotaforklifts-philippines.com',
            'idnum' => 'admin',
            'email_verified_at' => now(),
            'password' => Hash::make('Hj@2023!'),
            'role' => 1,
            'first_time' => 1,
            'status' => 1,
            'remember_token' => '',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
