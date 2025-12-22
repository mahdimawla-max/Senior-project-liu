<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function getAllComments(){
        $comments = Comment::all();
        return $comments;

    }
  public function create(Request $request)
{
    $request->validate([
        'postid' => 'required|exists:posts,id',
        'userid' => 'required|exists:users,id',
        'comment' => 'required|string|max:500',
    ]);

    $comment = Comment::create([
        'postid' => $request->postid,
        'userid' => $request->userid,
        'comment' => $request->comment,
    ]);

    // IMPORTANT: load user relation
    $comment->load('user');

    return response()->json([
        'comment' => $comment->comment,
        'user' => [
            'fullname' => $comment->user->fullname,
            'profilepicture' => $comment->user->profilepicture,
        ],
    ]);
}

    public function update(Request $request , $id){
        $comment = Comment::findOrFail($id);
        $comment->update($request->all());
        return "comments updated";
    }
    public function delete(Request $request , $id){
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return "comment deleted";
    }
    public function show($id){
        $comment = Comment::findOrFail($id);
        return $comment;
    }
}
