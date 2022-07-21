<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('team_matches')->insert([
            [
                'home_team_id' => 1,
                'guest_team_id' => 2,
                'date' => '2022-07-21'
            ],
            [
                'home_team_id' => 2,
                'guest_team_id' => 3,
                'date' => '2022-07-22'
            ],
            [
                'home_team_id' => 1,
                'guest_team_id' => 3,
                'date' => '2022-07-23'
            ]
        ]);
    }
}
