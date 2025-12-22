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

        $posts = Post::with([
                'comments' => function ($q) {
                    $q->orderBy('created_at', 'desc')->with('user');
                }
            ])
            ->where('userid', $user->id)
            ->join('users', 'posts.userid', '=', 'users.id')
            ->select(
                'posts.*',
                'posts.id as post_id',
                'users.fullname',
                'users.profilepicture'
            )
            ->orderBy('posts.created_at', 'desc')
            ->get();

        $shares = $user->shares;
        $postIds = $shares->pluck('postid');

        $sharePosts = Post::with([
                'comments' => function ($q) {
                    $q->orderBy('created_at', 'desc')->with('user');
                }
            ])
            ->whereIn('id', $postIds)
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
                }
            ])
            ->when($catId, function ($q) use ($catId) {
                $q->where('categoryid', $catId);
            })
            ->join('users', 'posts.userid', '=', 'users.id')
            ->select(
                'posts.*',
                'posts.id as post_id',
                'users.fullname',
                'users.profilepicture'
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
