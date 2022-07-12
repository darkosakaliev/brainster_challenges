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
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'johndoe',
            'email' => 'johndoe@example.com',
            'password' => Hash::make('John1234')
        ]);
        DB::table('users')->insert([
            'role_id' => '2',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('Admin1234')
        ]);
    }
}
