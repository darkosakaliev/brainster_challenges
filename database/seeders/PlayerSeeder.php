<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('players')->insert([
            [
                'name' => 'Raheem',
                'surname' => 'Sterling',
                'date_of_birth' => '1994-12-08',
                'team_id' => 1
            ],
            [
                'name' => 'Cristiano',
                'surname' => 'Ronaldo',
                'date_of_birth' => '1985-02-05',
                'team_id' => 2
            ],
            [
                'name' => 'Mohamed',
                'surname' => 'Salah',
                'date_of_birth' => '1992-06-15',
                'team_id' => 3
            ]
        ]);
    }
}
