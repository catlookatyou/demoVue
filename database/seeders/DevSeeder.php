<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;

class DevSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //清空數據表
        User::truncate();
        Category::truncate();
        Post::truncate();

        //創建測試用戶
        $user = User::factory([
            'name' => 'catlookatyou',
            'email' => 'cat@mail.com',
            'password'=>bcrypt('12345678'),
        ])->create();

        //創建分類
        $cnames = ['Demo1', 'Demo2', 'Demo3'];
        foreach($cnames as $cname){
            $category = Category::factory(['name' => $cname])->create();
            //每分類創建7篇文章
            Post::factory([
                'category_id' => $category->id,
                'user_id' => $user->id
            ])->count(20)->create();
        }
    }
}
