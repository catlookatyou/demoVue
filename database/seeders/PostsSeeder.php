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
                'image' => "images//1-2.jpg",
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'category_id' => 1,
                'user_id' => 1,
                'image' => "images//1-4.jpg",
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'category_id' => 1,
                'user_id' => 1,
                'image' => "images//1-3.jpg",
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'category_id' => 1,
                'user_id' => 1,
                'image' => "images//1-1.jpg",
                'created_at' => date("Y-m-d H:i:s")
            ],
            //category 2
            [
                'category_id' => 2,
                'user_id' => 1,
                'image' => "images//day.jpg",
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'category_id' => 2,
                'user_id' => 1,
                'image' => "images//night.jpg",
                'created_at' => date("Y-m-d H:i:s")
            ],
            //category 3
            [
                'category_id' => 3,
                'user_id' => 1,
                'image' => "images//fish.jpg",
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'category_id' => 3,
                'user_id' => 1,
                'image' => "images//2-1.jpg",
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'category_id' => 3,
                'user_id' => 1,
                'image' => "images//2-2.jpg",
                'created_at' => date("Y-m-d H:i:s")
            ],
            [
                'category_id' => 3,
                'user_id' => 1,
                'image' => "images//2-3.jpg",
                'created_at' => date("Y-m-d H:i:s")
            ],
        ]);
    }
}
