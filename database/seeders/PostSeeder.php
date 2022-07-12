<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([[
            'title' => 'Programming',
            'url' => 'https://img.freepik.com/free-vector/laptop-with-program-code-isometric-icon-software-development-programming-applications-dark-neon_39422-971.jpg',
            'description' => 'Programming discussion about new ideas and implementations!',
            'category_id' => '1',
            'user_id' => '1'
        ],
        [
            'title' => 'Cars',
            'url' => 'https://imageio.forbes.com/specials-images/imageserve/5d35eacaf1176b0008974b54/2020-Chevrolet-Corvette-Stingray/0x0.jpg?format=jpg&crop=4560,2565,x790,y784,safe&width=960',
            'description' => 'Lets talk about cars!',
            'category_id' => '6',
            'user_id' => '2'
        ]]);
    }
}
