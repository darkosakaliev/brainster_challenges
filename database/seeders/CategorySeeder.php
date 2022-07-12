<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // general, entertainment, sports, movies, politics and cars.
        DB::table('categories')->insert([[
            'name' => 'General'
        ],
        [
            'name' => 'Entertainment'
        ],
        [
            'name' => 'Sports'
        ],
        [
            'name' => 'Movies'
        ],
        [
            'name' => 'Politics'
        ],
        [
            'name' => 'Cars'
        ]]);
    }
}
