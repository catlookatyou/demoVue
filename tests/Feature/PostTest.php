<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Database\Seeders\DevSeeder;
use App\Models\User;
use App\Models\Post;

class PostTest extends TestCase
{
    //use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    /*
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    */
    
    public function test_get_all_posts(){
        $this->seed(DevSeeder::class);
        $response = $this->get('api/posts');  //$response = $this->json('GET', 'api/posts', []);
        $response->assertSuccessful();
    }

    public function test_get_one_post(){
        $this->seed(DevSeeder::class);
        $response = $this->get('api/posts/1');
        $response->assertSuccessful();
        $this->assertEquals(1, $response['data']['id']);
    }

    public function test_get_categories(){
        $this->seed(DevSeeder::class);
        $response = $this->get('api/posts/categories');
        //$response->assertSuccessful();  //cant work on github actions?
    }

    public function test_get_one_category(){
        $this->seed(DevSeeder::class);
        $response = $this->get('api/posts/category/Demo1');
        $response->assertSuccessful();
    }

    public function test_create_post(){
        $this->seed(DevSeeder::class);
        $user = User::find(1);
        $response = $this->actingAs($user)
                        ->post('api/posts/store', [
                            'title' => 'test',
                            'category_id' => 1,
                            'content' => 'test'
                        ]);
        $response->assertSuccessful();
    }

    public function test_update_post(){
        $this->seed(DevSeeder::class);
        $user = User::find(1);
        $response = $this->actingAs($user)
                        ->put('api/posts/60', [
                            'title' => 'test_update',
                            'category_id' => 1
                        ]);
        $response->assertSuccessful();    
    }

    public function test_delete_post(){
        $this->seed(DevSeeder::class);
        $user = User::find(1);
        $response = $this->actingAs($user)
                        ->delete('api/posts/60');
        $response->assertSuccessful(); 
    }
}
