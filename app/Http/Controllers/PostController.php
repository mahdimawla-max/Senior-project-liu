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
        return "post updated";
    }

   public function delete($id)
{
    $post = Post::findOrFail($id);

    // ✅ delete related reactions
    $post->reactions()->delete();

    // ✅ delete related comments (if FK exists)
    $post->comments()->delete();

    // ✅ now safe to delete post
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

        $category = Category::firstOrCreate([
            'name' => $request->title,
        ]);

        $post->content = 'uploaded/' . $imageName1;
        $post->categoryid = $category->id;
        $post->userid = $user->id;
        $post->description = $request->description;
        $post->save();

        return redirect('/home');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $categoryId = $request->input('category_id');

        $posts = Post::with([
            'comments' => function ($q) {
                $q->latest()
                  ->take(3)
                  ->with('user'); // ✅ THIS IS THE IMPORTANT FIX
            }
        ])
        ->when($categoryId, function ($q) use ($categoryId) {
            return $q->where('categoryid', $categoryId);
        })
        ->where(function ($q) use ($query) {
            return $q->where('content', 'like', '%' . $query . '%')
                     ->orWhere('description', 'like', '%' . $query . '%');
        })
        ->latest()
        ->get();

        $categories = Category::all();

        return view('pages.home', compact('posts', 'categories'));
    }

   public function react(Request $request, $id)
{
    $userId = Auth::id();

    $reaction = Reaction::where('userid', $userId)
        ->where('postid', $id) // ✅ FIX HERE
        ->first();

    if ($reaction) {
        $reaction->delete();
    } else {
        Reaction::create([
            'status' => 'like',
            'userid' => $userId,
            'postid' => $id // ✅ FIX HERE
        ]);
    }

    // ✅ IMPORTANT: return empty 200 response
    return response()->noContent();
}

}
