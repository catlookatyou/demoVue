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
        DB::table('categories')->insert(
            [
                'name' => '作品1號'
            ],
            [
                'name' => '作品2號'
            ],
            [
                'name' => '作品3號'
            ]
        );
    }
}
