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
            [
                'category_id' => 1,
                'user_id' => 1,
                'image' => "images//cheer.jpg",
                'created_at' => date("Y-m-d H:i:s")
            ],
            
        ]);
    }
}
