<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Http\Resources\Post as PostResource;
use App\Http\Resources\Posts as PostCollection;
use App\Http\Resources\Categories as CategoryCollection;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    public function index(){
        return new PostCollection(
            Post::with(['author:id,name,email', 'category'])
                ->select(['id', 'title', 'content', 'image', 'category_id', 'user_id', 'created_at'])
                ->orderByDesc('id')->paginate(10)
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

    public function store(Request $request){
        $data = $request->validate([
            'title' => 'required|string|max:100',
            'category_id' => [
                'required',
                Rule::in(Category::query()->pluck('id')->toArray())
            ],
            //'image' => 'required|image|max:1024',
            'content' => 'required|string',
        ]);

        $post = new Post($data);
        
        if ($request->hasFile('image')) {
            //$post = new Post(collect($data)->except('image'));
            $image = $request->file('image');
            $local_path = $image->storePublicly('images', ['disk' => 'public']);
            $post->image = '/storage/' . $local_path;
        }

        //測試用戶發布文章
        try{
            $post->user_id = 1;
            $post->save();
        }catch(\Exception $e){
            return response()->json(['success' => false, 'message' => 'post failed.']);
        }

        return response()->json(['success' => true, 'message' => 'post success.']);
    }

    public function categories(){
        return new CategoryCollection(
            Category::all()
        );
    }
}