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
    public function create(Request $request){
        $comment = Comment::create($request->all());
        return response()->json(['success' => "comments created"]);

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
