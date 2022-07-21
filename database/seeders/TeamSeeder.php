<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->insert([
            [
                'name' => 'Chelsea F.C.',
                'foundation_year' => 1905
            ],
            [
                'name' => 'Manchester United F.C.',
                'foundation_year' => 1878
            ],
            [
                'name' => 'Liverpool F.C.',
                'foundation_year' => 1892
            ]
        ]);
    }
}
