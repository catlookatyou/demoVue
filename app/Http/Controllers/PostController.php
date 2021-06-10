<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Http\Resources\Post as PostResource;
use App\Http\Resources\Posts as PostCollection;

class PostController extends Controller
{
    public function index(){
        return new PostCollection(
            Post::with(['author:id,name,email', 'category'])
                ->select(['id', 'title', 'image', 'category_id', 'user_id', 'created_at'])
                ->orderByDesc('id')->get()
        );
        
    }

    public function category($name){
        $category = Category::where('name', $name)->firstOrFail();
        return new PostCollection(
            $posts = Post::with(['author:id,name,email'])
                        ->where('category_id', $category->id)
                        ->orderByDesc('id')->get()
        );
    }

    public function show(Post $post){
        return new PostResource(
            $post->load(['author:id,name,email', 'category'])
        );
    }
}
