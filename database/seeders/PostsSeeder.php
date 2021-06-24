<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            //category 1
            [
                'category_id' => 1,
                'user_id' => 1,
                'image' => "images//cheer.jpg",
                'created_at' => date("Y-m-d H:i:s")
            ],
            //category 2
            [
                'category_id' => 2,
                'user_id' => 1,
                'image' => "images//2-1.jpg",
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'category_id' => 2,
                'user_id' => 1,
                'image' => "images//2-2.jpg",
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'category_id' => 2,
                'user_id' => 1,
                'image' => "images//2-3.jpg",
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'category_id' => 2,
                'user_id' => 1,
                'image' => "images//2-4.jpg",
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'category_id' => 2,
                'user_id' => 1,
                'image' => "images//2-5.jpg",
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'category_id' => 2,
                'user_id' => 1,
                'image' => "images//2-6.jpg",
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'category_id' => 2,
                'user_id' => 1,
                'image' => "images//2-7.jpg",
                'created_at' => date("Y-m-d H:i:s")
            ], 
        ]);
    }
}
