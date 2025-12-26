<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Share;
use App\Models\User;

use Illuminate\Http\Request;

class ShareController extends Controller
{
    public function getAllShares()
    {
        $shares = Share::all();
        return $shares;

    }

public function create(Request $request, $userId)
{
    // 1️⃣ Get the post being shared
    $post = Post::findOrFail($request->postid);

    // 2️⃣ Resolve ORIGINAL post (Option 1: flatten)
    $originalPost = $post->shared_post_id
        ? Post::findOrFail($post->shared_post_id)
        : $post;

    // 3️⃣ BLOCK duplicate share (THIS WAS FAILING BEFORE)
    $alreadyShared = Post::where('userid', $userId)
        ->where('shared_post_id', $originalPost->id)
        ->exists();

    if ($alreadyShared) {
        return redirect('/home')->with('error', 'You already shared this post.');
    }

    // 4️⃣ Create the shared post (ONLY SOURCE OF TRUTH)
    Post::create([
        'userid' => $userId,
        'shared_post_id' => $originalPost->id,
        'content' => $originalPost->content,
        'categoryid' => $originalPost->categoryid,
        'description' => $request->description ?? null,
    ]);

    return redirect('/home');
}

    public function update(Request $request, $id)
    {
        $share = Share::findOrFail($id);
        $share->update($request->all());
        return "share updated";
    }

    public function delete(Request $request, $id)
    {
        $share = Share::findOrFail($id);
        $share->delete();
        return "share deleted";
    }

    public function show($id)
    {
        $share = Share::findOrFail($id);
        return $share;
    }

    public function attachShareToUser($userId, $shareId)
    {
        $user = User::findOrFail($userId);
        $share = Share::findOrFail($shareId);

        $user->shares()->attach($share);

        return 'Share attached successfully!';
    }

    public function getUserShares($userId)
    {
        $user = User::findOrFail($userId);
        $userShares = $user->shares;
        return $userShares;
    }

}
