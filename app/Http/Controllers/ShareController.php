<?php

namespace App\Http\Controllers;

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
        $share = Share::firstOrCreate(
            ['description' => $request['description'] , 'postid' => $request['postid']],
        );
        $user = User::findOrFail($userId);
        $user->shares()->attach($share);
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
