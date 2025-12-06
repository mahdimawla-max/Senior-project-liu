<?php

namespace App\Http\Controllers;

use App\Models\Reaction;
use Illuminate\Http\Request;

class ReactionController extends Controller
{
    public function getAllReactions(){
        $reaction = Reaction::all();
        return $reaction;
    }
    public function create(Request $request){
        $reaction = Reaction::create($request->all());
        return "reaction created";


    }
    public function update(Request $request, $id){
        $reaction = Reaction::findOrFail($id);
        $reaction->update($request->all());
        return "reaction updated";
    }
    public function delete($request , $id){
        $reaction = Reaction::findOrFail($id);
        $reaction->delete();
        return "reaction deleted";


    }
    public function show($id){
        $reaction = Reaction::findOrFail($id);
        return $reaction;
    }
}
