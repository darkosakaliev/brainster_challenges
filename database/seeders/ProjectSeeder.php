<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert([
            'url' => 'https://picsum.photos/640/480',
            'image_url' => 'https://picsum.photos/640/480',
            'title' => 'Example 1',
            'subtitle' => 'Example 1',
            'description' => 'Example 1'
        ]);

        DB::table('projects')->insert([
            'url' => 'https://picsum.photos/640/480',
            'image_url' => 'https://picsum.photos/640/480',
            'title' => 'Example 2',
            'subtitle' => 'Example 2',
            'description' => 'Example 2'
        ]);

        DB::table('projects')->insert([
            'url' => 'https://picsum.photos/640/480',
            'image_url' => 'https://picsum.photos/640/480',
            'title' => 'Example 3',
            'subtitle' => 'Example 3',
            'description' => 'Example 3'
        ]);

        DB::table('projects')->insert([
            'url' => 'https://picsum.photos/640/480',
            'image_url' => 'https://picsum.photos/640/480',
            'title' => 'Example 4',
            'subtitle' => 'Example 4',
            'description' => 'Example 4'
        ]);

        DB::table('projects')->insert([
            'url' => 'https://picsum.photos/640/480',
            'image_url' => 'https://picsum.photos/640/480',
            'title' => 'Example 5',
            'subtitle' => 'Example 5',
            'description' => 'Example 5'
        ]);

        DB::table('projects')->insert([
            'url' => 'https://picsum.photos/640/480',
            'image_url' => 'https://picsum.photos/640/480',
            'title' => 'Example 6',
            'subtitle' => 'Example 6',
            'description' => 'Example 6'
        ]);

        DB::table('projects')->insert([
            'url' => 'https://picsum.photos/640/480',
            'image_url' => 'https://picsum.photos/640/480',
            'title' => 'Example 7',
            'subtitle' => 'Example 7',
            'description' => 'Example 7'
        ]);

        DB::table('projects')->insert([
            'url' => 'https://picsum.photos/640/480',
            'image_url' => 'https://picsum.photos/640/480',
            'title' => 'Example 8',
            'subtitle' => 'Example 8',
            'description' => 'Example 8'
        ]);

        DB::table('projects')->insert([
            'url' => 'https://picsum.photos/640/480',
            'image_url' => 'https://picsum.photos/640/480',
            'title' => 'Example 9',
            'subtitle' => 'Example 9',
            'description' => 'Example 9'
        ]);
    }
}
