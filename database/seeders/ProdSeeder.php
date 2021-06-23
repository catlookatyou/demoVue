<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //admin
        DB::table('users')->insert([
            'name' => 'catlookatyou',
            'email' => 'cat@mail.com',
            'password' => bcrypt('cat12345678'),
        ]);

        //categories
        DB::table('categories')->insert([
            [
                'name' => 'Demo1'
            ],
            [
                'name' => 'Demo2'
            ],
            [
                'name' => 'Demo3'
            ],
            [
                'name' => 'Demo4'
            ],
            [
                'name' => 'Demo5'
            ],
        ]);

        //posts
        $this->call(PostsSeeder::class);
    }
}
