<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
public function getProfilePage()
{
    $user = Auth::user();

    // ✅ ORIGINAL POSTS (created by user)
    $posts = Post::with([
            'comments' => function ($q) {
                $q->orderBy('created_at', 'desc')->with('user');
            },
            'sharedPost.user',
            'sharedPost.category'
        ])
        ->where('userid', $user->id)
        ->whereNull('shared_post_id')
        ->join('users', 'posts.userid', '=', 'users.id')
        ->select(
            'posts.*',
            'posts.id as post_id',
            'users.fullname',
            'users.profilepicture'
        )
        ->orderBy('posts.created_at', 'desc')
        ->get();

    // ✅ SHARED POSTS (created by user) — FIXED
    $sharePosts = Post::with([
            'comments' => function ($q) {
                $q->orderBy('created_at', 'desc')->with('user');
            },
            'sharedPost.user',
            'sharedPost.category'
        ])
        ->where('userid', $user->id)
        ->whereNotNull('shared_post_id')
        ->join('users', 'posts.userid', '=', 'users.id')   // ✅ ADD THIS
        ->select(
            'posts.*',
            'posts.id as post_id',
            'users.fullname',
            'users.profilepicture'
        )                                                   // ✅ ADD THIS
        ->orderBy('posts.created_at', 'desc')
        ->get();

    return view('pages.profile', [
        'user'   => $user,
        'posts'  => $posts,
        'shares' => $sharePosts
    ]);
}

 public function showSearchPage($catId = null)
{
    $categories = Category::all();

    $posts = Post::with([
            'comments' => function ($q) {
                $q->orderBy('created_at', 'desc')->with('user');
            },
            'sharedPost.user',
            'sharedPost.category',
            'category'
        ])
        ->when($catId, function ($q) use ($catId) {
            $q->where('categoryid', $catId);
        })
        ->join('users', 'posts.userid', '=', 'users.id')
        ->select(
            'posts.*',
            'posts.id as post_id',
            'users.id as user_id',   // ✅ FIX (do NOT remove)
            'users.fullname',
            'users.profilepicture as profilepicture'
        )
        ->orderBy('posts.created_at', 'desc')
        ->get();

    return view('pages.home', [
        'categories' => $categories,
        'posts'      => $posts
    ]);
}



    public function getLoginPage()
    {
        return view('pages.login');
    }

    public function getSignInPage()
    {
        return view('pages.register');
    }

    public function getEditProfile()
    {
        return view('pages.profileedit', [
            'user' => Auth::user()
        ]);
    }

    public function getPostPage()
    {
        return view('pages.post');
    }

    public function getCommentsPage($postId)
    {
        $comments = Comment::where('postid', $postId)
            ->join('users', 'comments.userid', '=', 'users.id')
            ->select(
                'comments.*',
                'comments.id as comment_id',
                'users.fullname',
                'users.profilepicture'
            )
            ->orderBy('comments.created_at', 'desc')
            ->get();

        return view('pages.comment', ['data' => $comments]);
    }
}
