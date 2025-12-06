<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserController extends Controller
{
    public function getAllUsers(){
        $users = User::all();
        return $users;
    }
    public function create(Request $request) {
        try {
            $user = User::create($request->all());
            return redirect('/')->with('success', 'User created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'User creation failed. Please try again.']);
        }
    }
    public function update(Request $request, $id){
        $user = User::findOrFail($id);
        $imageName1 = time() . '.' . $request->profilepicture->extension();
        $request->profilepicture->move(public_path('uploaded'), $imageName1);
        $user->profilepicture = 'uploaded/' . $imageName1;
        $user->fullname = $request->fullname;
        $user->location = $request->location;
        $user->about = $request->about;
        $user->birthdate = $request->birthdate;
        $user->save();
        return redirect('/profile');
}
    public function delete($id){
        $user = User::findOrFail($id);
        $user->delete();
        return "user delete successfully";
    }
    public function show ($id){
        $user = User::findOrFail($id);
        return $user;

    }
    function login(Request $request) {
        try {
            $user = User::where('email', $request->email)->firstOrFail();
            if ($request->password == $user->password) {
                Auth::login($user);
                return redirect('/home');
            } else {
                return redirect()->back()->withErrors(['error' => 'Invalid password']);
            }
        } catch (ModelNotFoundException $e) {
            return redirect()->back()->withErrors(['error' => 'User not found']);
        }
    }
}
