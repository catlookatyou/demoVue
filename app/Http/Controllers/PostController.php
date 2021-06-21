<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Http\Resources\Post as PostResource;
use App\Http\Resources\Posts as PostCollection;
use App\Http\Resources\Categories as CategoryCollection;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Auth;

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

    public function show($id){
        $post = Post::findOrFail($id);
        return new PostResource(
            $post->load(['author:id,name,email', 'category'])
        );
    }

    public function store(Request $request){
        $data = $request->validate([
            'title' => 'nullable|string|max:100',
            'category_id' => [
                'required',
                Rule::in(Category::query()->pluck('id')->toArray())
            ],
            'image' => 'nullable|image|max:1024',
            'content' => 'nullable|string',
        ]);

        $post = new Post($data);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $local_path = $image->storePublicly('images', ['disk' => 'public']);
            $post->image = '/storage/' . $local_path;
        }

        //測試用戶發布文章
        try{
            $post->user_id = Auth::id();
            $post->save();
        }catch(\Exception $e){
            return response()->json(['success' => false, 'message' => 'post failed!']);
        }

        return response()->json(['success' => true, 'message' => 'post success!']);
    }

    public function categories(){
        return new CategoryCollection(
            Category::all()
        );
    }

    public function update(Request $request, $id){
        $data = $request->validate([
            'title' => 'nullable|string|max:100',
            'category_id' => [
                'required',
                Rule::in(Category::query()->pluck('id')->toArray())
            ],
            'image' => 'nullable|image|max:1024',
            'content' => 'nullable|string',
        ]);

        $post = Post::findOrFail($id);

        //delete original image
        if($request->hasFile('image')){
            //cut '/storage/' and add full url
            $url = substr($post->image, 9);
            $url = 'app/public/'.$url;
            //delete
            unlink(storage_path($url));
        }

        //validate完後可用request啦
        $post->fill($request->except('image'));

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $local_path = $image->storePublicly('images', ['disk' => 'public']);
            $post->image = '/storage/' . $local_path;
        }

        if ($post->save()){
            return ['success' => true, 'message' => 'update success!'];
        }
        return ['success' => false, 'message' => 'update failed!'];
    }

    public function delete($id){
        $post = Post::findOrFail($id);

        //delete image
        if($post->image){
            //check if file exist
            $url = substr($post->image, 9);
            $exists = Storage::disk('public')->has($url);
            if($exists){
                //cut '/storage/' and add full url
                $url = substr($post->image, 9);
                $url = 'app/public/'.$url;
                //delete
                unlink(storage_path($url));
            }
        }
        
        if ($post->delete()){
            return ['success' => true, 'message' => 'delete success!'];
        }
        return ['success' => false, 'message' => 'delete failed!'];
    }
}
