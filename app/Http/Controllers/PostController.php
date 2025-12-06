<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Reaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function getAllPosts(){
        $posts = Post::all();
        return $posts;
    }
    public function create(Request $request){
        $post = Post::create($request->all());
        return "post created";
    }
    public function update(Request $request, $id){
        $post = Post::findOrFail($id);
        $post->update($request->all());
        return"post updated";
    }
    public function delete( $id){
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect('/profile');
    }
    public function show($id){
        $post = Post::findOrFail($id);
        return $post;
    }
    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => 'User not authenticated.'], 401);
        }
        $imageName1 = time() . '.' . $request->photo->extension();
        $request->photo->move(public_path('uploaded'), $imageName1);
        $post = new Post();
        $category = Category::firstOrCreate(
            ['name' => $request->title],
        );
        $post->content = 'uploaded/' . $imageName1;
        $post->categoryid = $category->id;
        $post->userid = $user->id;
        $post->description = $request->description;
        $post->save();

        return redirect('/post');
    }
    public function search(Request $request)
    {
        $query = $request->input('query'); // The search term
        $categoryId = $request->input('category_id'); // The selected category

        // Build the query to filter posts by category and search term
        $posts = Post::query()
            ->when($categoryId, function ($queryBuilder) use ($categoryId) {
                return $queryBuilder->where('categoryid', $categoryId);
            })
            ->where(function ($queryBuilder) use ($query) {
                return $queryBuilder->where('content', 'like', '%' . $query . '%')
                                     ->orWhere('description', 'like', '%' . $query . '%');
            })
            ->get();

        $categories = Category::all(); // Get categories for the dropdown

        return view('pages.home', compact('posts', 'categories'));
    }
    public function react(Request $request, Post $post)
    {
        $user = Auth::user();
        $userId = $user->id;
        $reaction = Reaction::where('userid', $userId)->where('postid', $post->id)->first();
        if ($reaction) {
            $reaction->delete();
            return response()->json(['success' => 'unliked']);
        } else {
            Reaction::create(['status'=>'like','userid' => $userId, 'postid' => $post->id]);
            return response()->json(['success' => 'liked']);
        }

    }

}


